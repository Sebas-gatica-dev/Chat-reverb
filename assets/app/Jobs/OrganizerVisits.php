<?php

namespace App\Jobs;

use App\Enums\AutomaticRoutesStatus;
use App\Models\AutomaticRoute;
use App\Models\JobStatus;
use App\Models\TravelTime;
use App\Models\User;
use App\Models\Visit;
use Carbon\Carbon;
use DateInterval;
use DatePeriod;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Sleep;

class OrganizerVisits implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $startDate;
    public $endDate;

    private $googleMapsApiKey;
    private $availabilityOperatorVisits = [];
    private $routeOrganizer = [];
    private $travelTimeCacheAPI = [];
    private $travelTimeCache = [];


    private $requests = 0;

    private $selectedVisits = [];


    private $uniqueVisitIds;


    private $automaticRoute;


    /**
     * Create a new job instance.
     */
    public function __construct($availabilityOperatorVisits, $startDate, $endDate, $automaticRoute)
    {
        $this->availabilityOperatorVisits = $availabilityOperatorVisits;
        $this->startDate = Carbon::parse($startDate);
        $this->endDate = Carbon::parse($endDate);
        $this->automaticRoute = $automaticRoute;
        // $this->jobStatusId = $jobStatusId;  // Guardamos el ID de JobStatus
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {



        // Obtener el Job ID cuando el Job se ejecuta
        $jobId = $this->job->getJobId();

        // Actualizar el estado a "processing" y guardar el Job ID
        $this->automaticRoute->update([
            'status' => AutomaticRoutesStatus::PROCESSING->value,
            'job_id' => $this->job->getJobId(),
            'progress' => 0, // Iniciar en 0%
        ]);


        try {
            // Primera etapa: generar las rutas
            $this->updateProgress(30);
            $this->generateRoutes();

            // Segunda etapa: guardar las rutas
            $this->updateProgress(60); // 60% cuando se guarda la ruta
            $this->savedAutomaticRoutes();


            // Incremento gradual del 61% al 100%
            $this->incrementProgressGradually(60, 100);

            $this->updateProgress(100);
            Sleep::for(2)->seconds();

            // Actualizar el estado a "completed" cuando todo el proceso haya finalizado
            $this->automaticRoute->update([
                'status' => AutomaticRoutesStatus::COMPLETED->value,
                // 'progress' => 100, // 100% cuando se completa el proceso

            ]);
        } catch (\Exception $e) {
            //Manejar el fallo actualizando el estado
            $this->automaticRoute->update([
                'status' => AutomaticRoutesStatus::FAILURE->value,
                'progress' => 0 // Reiniciar el progreso
            ]);
            throw $e;  // Asegurarse de que el Job falle correctamente
        }
    }

    protected function incrementProgressGradually($from, $to)
    {
        for ($progress = $from; $progress <= $to; $progress++) {
            $this->updateProgress($progress);
            Sleep::for(0.2)->seconds(); // Pausar 1 segundo entre cada incremento (puedes ajustar esto)
        }
    }


    private function generateRoutes()
    {

        $this->googleMapsApiKey = 'AIzaSyD3K3dBES7-pn0gkICbQyiQgfNHhlUU3W4'; //lucsnchz@gmail.com Protegel Filtros

        // Inicializar un array de fechas utilizando un rango
        $period = new DatePeriod($this->startDate, new DateInterval('P1D'), $this->endDate->copy()->addDay());


        //  dd($this->availabilityOperatorVisits, $this->startDate, $this->endDate);
        // dd($this->availabilityOperatorVisits, $this->startDate, $this->endDate);

        // Inicializar el array de rutas organizadas con las fechas
        foreach ($period as $currentDate) {
            $formattedDate = $currentDate->format('Y-m-d');
            $this->routeOrganizer[$formattedDate]['workers'] = array_fill_keys(array_keys($this->availabilityOperatorVisits), []);
        }


        // Reiniciar la fecha de iteración con la fecha de inicio
        $currentDate = $this->startDate->copy();

        while ($currentDate->lte($this->endDate) || count($this->availabilityOperatorVisits) > 0) {
            if ($currentDate->gt($this->endDate) || count($this->availabilityOperatorVisits) == 0) {
                break; // Salir del bucle si cualquiera de las condiciones se cumple
            }

            $dateNextDay = $currentDate->format('Y-m-d');
            $dayOfWeek = strtoupper($currentDate->format('l'));

            $getWorkersWhoFinishedShift = [];
            $winningVisits = [];


            foreach ($this->availabilityOperatorVisits as $operatorId => $data) {
                // Verificar si el operatorId puede realizar otro trabajo en su día
                if ($this->checkSpaceForOtherWork($data['availability'], $dayOfWeek, $dateNextDay, $operatorId)) {
                    // Determinar el punto de origen
                    $operatorRoute  = $this->routeOrganizer[$dateNextDay]['workers'][$operatorId] ?? [];
                    $lastPoint = end($operatorRoute); // Obtener el último punto de la ruta, si existe

                    $originLat = $lastPoint['latitud'] ?? $data['start_lat'];
                    $originLng = $lastPoint['longitude'] ?? $data['start_lng'];

                    // Cache para evitar llamadas repetitivas a la km de Google Maps
                    $cacheTravelTimes = [];

                    //Cache para evitar llamadas repetitivas a la API de Google Maps
                    $cacheTravelTimesAPI = [];



                    // Añadir la duración del viaje a cada visita
                    foreach ($data['visits'] as $index => $visit) {

                        $this->availabilityOperatorVisits[$operatorId]['visits'][$index]['travel_time'] = $this->getTravelTime($originLat, $originLng, $visit['latitud'], $visit['longitude']);
                    }

                    // Ordenar visitas por la duración del viaje desde el origen del operario
                    usort($this->availabilityOperatorVisits[$operatorId]['visits'], function ($a, $b) {
                        return $a['travel_time'] <=> $b['travel_time'];
                    });



                    //    dump($this->availabilityOperatorVisits[$operatorId]['visits'], 'Visitas ordenadas por tiempo de viaje');


                    //Agarrar las primeras 5 visitas y calcular el tiempo de viaje con la API de Google Maps para obtener un resultado más preciso y actualizado

                    $selectedVisits = array_slice($this->availabilityOperatorVisits[$operatorId]['visits'], 0, 5);


                    //    dump($selectedVisits, 'Primeras 5 visitas');

                    foreach ($selectedVisits as $index => &$visit) {
                        // Verificar si el tiempo de viaje ya está en caché
                        $visit['travel_time'] = $this->getTravelTime($originLat, $originLng, $visit['latitud'], $visit['longitude']);
                    }
                    unset($visit);




                    // Ordenar las visitas seleccionadas por la duración del viaje

                    usort($selectedVisits, function ($a, $b) {
                        return $a['travel_time'] <=> $b['travel_time'];
                    });

                    //    dump($selectedVisits, 'ordenamos las 5 visitas calculadas de api de maps por travel_time'); 

                    //Unificar los resultados de las visitas seleccionadas con las visitas originales
                    $this->availabilityOperatorVisits[$operatorId]['visits'] = array_merge($selectedVisits, array_slice($this->availabilityOperatorVisits[$operatorId]['visits'], 5));

                    // dd($this->availabilityOperatorVisits[$operatorId]['visits'], 'Visitas unificadas');

                    // Intentar obtener una visita disponible para el operario
                    $visit = $this->checkAvailabilityOfVisitOrProperty($this->availabilityOperatorVisits[$operatorId]['visits'], $dateNextDay, $dayOfWeek, $operatorId);

                    if ($visit !== null) {
                        // Si hay una visita disponible, añadirla a las visitas ganadoras
                        $winningVisits[$operatorId] = $visit;
                    } else {
                        // Si no hay visitas disponibles para el operario, marcarlo como finalizando su jornada
                        $getWorkersWhoFinishedShift[] = $operatorId;
                    }
                } else {
                    // Si no puede realizar más trabajo, marcar al operario como finalizando su jornada
                    $getWorkersWhoFinishedShift[] = $operatorId;
                }
            }



            if (count($getWorkersWhoFinishedShift) < count($this->availabilityOperatorVisits) && count($this->availabilityOperatorVisits) > 0) {
                // Solo de los operarios que no terminaron su jornada laboral, tomamos la primera visita de cada uno
                $winningVisits = $this->getWinningVisits($getWorkersWhoFinishedShift, $dateNextDay, $dayOfWeek);



                // Ahora comparamos estas visitas ganadoras de cada operario y verificamos si tienen alguna visita en común
                $commonWinningVisits = $this->findOperatorsWithCommonId($winningVisits);

                if (count($commonWinningVisits) > 0) {
                    $this->processCommonVisits($commonWinningVisits, $dateNextDay, $dayOfWeek);
                } else {
                    $this->processIndividualVisits($winningVisits, $dateNextDay, $dayOfWeek);
                }

                $winningVisits = [];
            } else {



                $currentDate->addDay();
                $getWorkersWhoFinishedShift = [];
                // Reiniciar operarios que finalizaron jornada
            }
        }

        $this->uniqueVisitIds = $this->extractUniqueVisitIds();

        Sleep::for(5)->seconds();
    }



    private function extractUniqueVisitIds()
    {
        // Array to store visit IDs
        $visitIds = [];

        // Loop through operators and extract visit IDs
        foreach ($this->availabilityOperatorVisits as $operator) {
            if (isset($operator['visits']) && is_array($operator['visits'])) {
                foreach ($operator['visits'] as $visit) {
                    $visitIds[] = $visit['id'];
                }
            }
        }

        // Remove duplicate visits using array_unique
        return array_unique($visitIds);
    }




    private function savedAutomaticRoutes()
    {

        Sleep::for(2)->seconds();
        // Guardar todas las rutas organizadas en una sola fila

        $this->automaticRoute->update([
            'routes' => json_encode($this->routeOrganizer), // Guardar todo el array de rutas organizadas como JSON
            'uncoordinated_visits' => json_encode($this->uniqueVisitIds), // JSON con las visitas sin coordinar
            'requests' => $this->requests, // Número de peticiones realizadas a la API de Google Maps
        ]);
    }


    private function getWinningVisits($getWorkersWhoFinishedShift, $dateNextDay, $dayOfWeek)
    {
        $winningVisits = [];
        foreach ($this->availabilityOperatorVisits as $operatorId => $data) {
            if (!in_array($operatorId, $getWorkersWhoFinishedShift)) {

                if ($this->checkAvailabilityOfVisitOrProperty($data['visits'], $dateNextDay, $dayOfWeek, $operatorId) != null) {

                    $winningVisits[$operatorId] = $this->checkAvailabilityOfVisitOrProperty($data['visits'], $dateNextDay, $dayOfWeek, $operatorId);
                }
            }
        }
        return $winningVisits;
    }

    private function checkAvailabilityOfVisitOrProperty($data, $dateNextDay, $dayOfWeek, $operatorId)
    {
        // Recorremos todas las visitas para encontrar una que sea factible en el día dado
        foreach ($data as $visit) {
            // Si no hay restricciones de disponibilidad para la visita, asumimos que es válida
            if ($visit['availability'] == null) {
                return $visit;
            }

            // Buscamos la disponibilidad de la visita para el día de la semana actual
            $day = collect($visit['availability'])->firstWhere('day.name', $dayOfWeek);

            // Si no hay disponibilidad en este día, pasamos a la siguiente visita
            if ($day == null) {
                continue;
            }

            // Registro de información de depuración
            // Log::info('Estoy en el dia: ' . $dayOfWeek . ' '. $dateNextDay . ' y la visita es: ' . $visita['id'] . ' y el operario es: ' . $operario);
            // Log::info('visitas que quedan en total: ' . count($this->disponibilidadOperarioVisitas[$operario]['visitas']));

            $operatorRoute  = &$this->routeOrganizer[$dateNextDay]['workers'][$operatorId] ?? [];
            $lastIndex = count($operatorRoute) - 1;


            // Si hay al menos una visita en la ruta y tiene un 'hora_fin' definido
            if ($lastIndex > 0 && isset($operatorRoute[$lastIndex - 1]['end_time'])) {
                $endTime = Carbon::createFromFormat('H:i:s', $operatorRoute[$lastIndex - 1]['end_time']);
                $startTime = $endTime->copy()->addMinutes($visit['travel_time'])->addMinutes($visit['duration_time']);

                // Verificamos si la visita puede realizarse antes de la hora de fin del día
                if ($startTime->lte($day['end'])) {
                    return $visit; // Retornamos la visita factible
                }
            } else {
                $startTimeString = $this->getStartTime($this->availabilityOperatorVisits[$operatorId]['availability'], $dayOfWeek);
                if ($startTimeString == null) {
                    return null; // Operario no tiene disponibilidad
                }
                $startTime = Carbon::createFromFormat('H:i:s', $startTimeString);
                $startTime = $startTime->minute(ceil($startTime->minute / 5) * 5)->second(0);
                // verificar si la hora de inicio de la visita es menor o igual a la hora de inicio del operario
                if (Carbon::createFromFormat('H:i:s', $day['start'])->lte($startTime)) {
                    return $visit; // Retornamos la visita factible
                }
            }
        }

        // Si no se encontró ninguna visita disponible, retornamos null
        return null;
    }

    // Función para procesar visitas en común
    private function processCommonVisits($visitasGanadorasEnComun, $dateNextDay, $dayOfWeek)
    {
        foreach ($visitasGanadorasEnComun as $visitaId) {
            $operatorId = $visitaId['name'];
            $visit = $this->availabilityOperatorVisits[$operatorId]['visits'][0];

            $this->assignVisit($operatorId, $visit, $dateNextDay, $dayOfWeek);
            $this->deleteVisitFromOtherOperators($visit['id']);
        }
    }

    // Función para procesar visitas individuales
    private function processIndividualVisits($winningVisits, $dateNextDay, $dayOfWeek)
    {
        foreach ($winningVisits as $operatorId => $visit) {
            $this->assignVisit($operatorId, $visit, $dateNextDay, $dayOfWeek);
            $this->deleteVisitFromOtherOperators($visit['id']);
        }
    }

    // Función para asignar una visita a un operario y actualizar las horas de inicio y fin
    private function assignVisit($operatorId, $visit, $dateNextDay, $dayOfWeek)
    {


        $this->routeOrganizer[$dateNextDay]['workers'][$operatorId][] = $visit;

        $operatorRoute  = &$this->routeOrganizer[$dateNextDay]['workers'][$operatorId];
        $lastIndex = count($operatorRoute) - 1;

        if ($lastIndex > 0 && isset($operatorRoute[$lastIndex - 1]['end_time'])) {
            $endTime = Carbon::createFromFormat('H:i:s', $operatorRoute[$lastIndex - 1]['end_time']);
            $startTime = $endTime->copy()->addMinutes($visit['travel_time']);
        } else {
            $startTimeString = $this->getStartTime($this->availabilityOperatorVisits[$operatorId]['availability'], $dayOfWeek);
            if ($startTimeString == null) {
                return; // Operario no tiene disponibilidad
            }
            $startTime = Carbon::createFromFormat('H:i:s', $startTimeString);
        }

        // Redondear la hora de inicio a los 5 minutos más cercanos
        $startTime = $startTime->minute(ceil($startTime->minute / 5) * 5)->second(0);
        $operatorRoute[$lastIndex]['start_time'] = $startTime->format('H:i:s');

        // Calcular y redondear la hora de fin usando 'horaInicio' y 'duration_time'
        $endTime = $startTime->copy()->addMinutes($visit['duration_time']);
        $endTime = $endTime->minute(ceil($endTime->minute / 5) * 5)->second(0);
        $operatorRoute[$lastIndex]['end_time'] = $endTime->format('H:i:s');
    }


    public function findOperatorsWithCommonId($workers)
    {
        // Array para almacenar los IDs de visitas y los operarios asociados
        $commonVisits = [];


        // Recorrer cada operario
        foreach ($workers as $name => $data) {

            $id = $data['id'];

            // Añadir el operario al array de visitas comunes
            $commonVisits[$id][] = [
                'id' => $id,
                'name' => $name,
                'travel_time' => $data['travel_time'],
                'duration_time' => $data['duration_time']
            ];
        }

        // Filtrar el array para mantener solo los IDs que tienen más de un operario
        $results = array_filter($commonVisits, fn($workers) => count($workers) > 1);

        // Ordenar y dejar el operario con menor travel_time
        foreach ($results as $id => $workers) {
            $results[$id] = array_reduce($workers, function ($carry, $item) {
                return $carry === null || $item['travel_time'] < $carry['travel_time'] ? $item : $carry;
            });
        }

        return array_values($results); // Devuelve los results como un array reindexado
    }

    private function deleteVisitFromOtherOperators($visitaId)
    {
        foreach ($this->availabilityOperatorVisits as $operatorId => &$data) {
            // Filtrar las visitas para eliminar la visita con el ID especificado
            $data['visits'] = array_values(array_filter($data['visits'], fn($visit) => $visit['id'] !== $visitaId));

            // Si el operario ya no tiene visitas, eliminamos su entrada
            if (empty($data['visits'])) {
                unset($this->availabilityOperatorVisits[$operatorId]);
            }
        }
    }

    //Funcion que calcula el tiempo de viaje entre dos puntos
    function getTravelTime($originLat, $originLng, $destinationLat, $destinationLng)
    {
        $cacheKey = "{$originLat}-{$originLng}-{$destinationLat}-{$destinationLng}";

        if (isset($this->travelTimeCache[$cacheKey])) {
            return $this->travelTimeCache[$cacheKey];
        }
        // Radio de la Tierra en kilómetros
        $radioTierra = 6371;

        $lat1 = deg2rad($originLat);
        $lon1 = deg2rad($originLng);
        $lat2 = deg2rad($destinationLat);
        $lon2 = deg2rad($destinationLng);

        $diferenciaLat = $lat2 - $lat1;
        $diferenciaLon = $lon2 - $lon1;

        $a = sin($diferenciaLat / 2) * sin($diferenciaLat / 2) +
            cos($lat1) * cos($lat2) *
            sin($diferenciaLon / 2) * sin($diferenciaLon / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        // $distanciaEnKilometros = (int) round(($radioTierra * $c) * 1000);
        // return $distanciaEnKilometros;

        $distanciaDecimal =  ($radioTierra * $c) * 1000;
        $distanciaEntero = (int) round($distanciaDecimal);

        $velocidad = 2.50; // Velocidad en metros por segundo
        $tiempoSegundos = $distanciaEntero / $velocidad;
        $tiempoMinutos = (int) round(($tiempoSegundos / 60));
        $this->travelTimeCache[$cacheKey] = $tiempoMinutos; // Cachear el resultado

        return $tiempoMinutos; // Retornar la distancia en metros
    }



    private function getTravelTimeAPI($originLat, $originLng, $destinationLat, $destinationLng, $mode = 'driving')
    {
        // Redondear las coordenadas a 6 decimales
        $originLat = round($originLat, 6);
        $originLng = round($originLng, 6);
        $destinationLat = round($destinationLat, 6);
        $destinationLng = round($destinationLng, 6);

        // dd($originLat, $originLng, $destinationLat, $destinationLng);

        // Intentar obtener el tiempo de viaje de la base de datos
        $travelTimeRecord = TravelTime::where('origin_latitude', $originLat)
            ->where('origin_longitude', $originLng)
            ->where('destination_latitude', $destinationLat)
            ->where('destination_longitude', $destinationLng)
            ->first();


        if ($travelTimeRecord) {

            return $travelTimeRecord->travel_time_minutes;
        }

        // Si no existe, realizar la solicitud a la API
        // ... (llamada a la API de Google Maps)

        $url = 'https://maps.googleapis.com/maps/api/distancematrix/json?units=metric'
            . '&origins=' . $originLat . ',' . $originLng
            . '&destinations=' . $destinationLat . ',' . $destinationLng
            . '&mode=' . $mode
            . '&key=' . $this->googleMapsApiKey;

        $response = Http::get($url);
        $data = $response->json();


        if ($data['status'] == 'OK' && $data['rows'][0]['elements'][0]['status'] == 'OK') {
            $this->requests++;
            $travelTime = ($data['rows'][0]['elements'][0]['duration']['value']) / 60;
            $travelTimeEntero = (int) number_format($travelTime, 0, '.', '');

            // Guardar en la base de datos
            TravelTime::create([
                'origin_latitude' => $originLat,
                'origin_longitude' => $originLng,
                'destination_latitude' => $destinationLat,
                'destination_longitude' => $destinationLng,
                'travel_time_minutes' => $travelTimeEntero,
            ]);

            return $travelTimeEntero;
        }
    }



    private function checkSpaceForOtherWork($availability, $dayOfWeek, $dateNextDay, $operatorId)
    {

        $day = collect($availability)->firstWhere('day.name', $dayOfWeek);

        if (!$day) {
            return false; // Si no se encuentra el día, retorna false
        }

        $endTime = Carbon::createFromFormat('H:i:s', $day['end']);

        $routesCurrentDay = $this->routeOrganizer[$dateNextDay]['workers'][$operatorId] ?? [];
        if (!empty($routesCurrentDay)) {
            $lastPoint = end($routesCurrentDay);
            $endTimeOfCurrentDay = Carbon::createFromFormat('H:i:s', $lastPoint['end_time']);

            foreach ($this->availabilityOperatorVisits[$operatorId]['visits'] as $visit) {
                $endTimeWithVisit = $endTimeOfCurrentDay->copy()->addMinutes($visit['duration_time'] + $visit['travel_time']);
                if ($endTimeWithVisit < $endTime) {
                    return true; // Retorna true si al menos una visita cabe en el tiempo disponible
                }
            }

            return false; // Retorna false si ninguna visita cabe
        }

        return true; // Retorna true si no hay visitas programadas y por lo tanto hay espacio
    }


    private function getStartTime($availability, $dayOfWeek)
    {
        // Usar firstWhere para encontrar el día especificado
        $day = collect($availability)->firstWhere('day.name', $dayOfWeek);

        if ($day) {
            $startTime = Carbon::createFromFormat('H:i:s', $day['start']);

            // Solo redondear si los minutos no están ya alineados a los 5 minutos más cercanos
            $roundedMinute = ceil($startTime->minute / 5) * 5;
            if ($startTime->minute !== $roundedMinute) {
                $startTime = $startTime->copy()->minute($roundedMinute)->second(0);
            }

            return $startTime->format('H:i:s');
        }

        // Retornar null si no se encuentra el día especificado
        return null;
    }


    protected function updateProgress($percentage)
    {
        $this->automaticRoute->update(['progress' => $percentage]);
    }
}
