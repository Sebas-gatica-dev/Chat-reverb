<?php

namespace App\Jobs;

use App\Enums\AutomaticRoutesStatus;
use App\Models\AutomaticRoute;
use App\Models\JobStatus;
use App\Models\TravelTime;
use App\Models\User;
use App\Models\Visit;
use App\Traits\AutomaticRouteTrait;
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
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, AutomaticRouteTrait;
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
    private $contemplateOrganizedVisit;

    private $allVisits;

    private $employees;

    private $visitsForDay;
    private $routeOrganizedDay;

    private $organizedVisits;

    /**
     * Create a new job instance.
     */
    public function __construct($availabilityOperatorVisits, $startDate, $endDate, $automaticRoute, $contemplateOrganizedVisit)
    {
        $this->availabilityOperatorVisits = $availabilityOperatorVisits;
        $this->startDate = Carbon::parse($startDate);
        $this->endDate = Carbon::parse($endDate);
        $this->automaticRoute = $automaticRoute;
        $this->contemplateOrganizedVisit = $contemplateOrganizedVisit;
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
            Sleep::for(0.05)->seconds(); // Pausar 1 segundo entre cada incremento (puedes ajustar esto)
        }
    }


    private function generateRoutes()
    {
        $this->googleMapsApiKey = 'AIzaSyD3K3dBES7-pn0gkICbQyiQgfNHhlUU3W4'; //lucsnchz@gmail.com Protegel Filtros

        // Inicializar un array de fechas utilizando un rango
        $period = new DatePeriod($this->startDate, new DateInterval('P1D'), $this->endDate->copy()->addDay());

        // Inicializar el array de rutas organizadas con las fechas
        foreach ($period as $currentDate) {
            $formattedDate = $currentDate->format('Y-m-d');
            $this->routeOrganizer[$formattedDate]['workers'] = array_fill_keys(array_keys($this->availabilityOperatorVisits), []);
        }

        // Reiniciar la fecha de iteración con la fecha de inicio
        $currentDate = $this->startDate->copy();


        if (!$this->contemplateOrganizedVisit) {

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

                    if (isset($this->routeOrganizer[$dateNextDay]['workers'][$operatorId])) {
                        $routeWorker = $this->routeOrganizer[$dateNextDay]['workers'][$operatorId];
                    } else {
                        $routeWorker = [];
                    }

                    if ($this->checkSpaceForOtherWork($data['availability'], $dateNextDay, $routeWorker)) {
                        // Determinar el punto de origen
                        $operatorRoute  = $this->routeOrganizer[$dateNextDay]['workers'][$operatorId] ?? [];
                        $lastPoint = end($operatorRoute); // Obtener el último punto de la ruta, si existe

                        $originLat = $lastPoint['latitude'] ?? $data['start_lat'];
                        $originLng = $lastPoint['longitude'] ?? $data['start_lng'];

                        // Añadir la duración del viaje a cada visita
                        foreach ($data['visits'] as $index => $visit) {

                            $this->availabilityOperatorVisits[$operatorId]['visits'][$index]['travel_time'] = $this->getTravelTime($originLat, $originLng, $visit['latitude'], $visit['longitude']);
                        }

                        // Ordenar visitas por la duración del viaje desde el origen del operario
                        usort($this->availabilityOperatorVisits[$operatorId]['visits'], function ($a, $b) {
                            return $a['travel_time'] <=> $b['travel_time'];
                        });

                        //Agarrar las primeras 5 visitas y calcular el tiempo de viaje con la API de Google Maps para obtener un resultado más preciso y actualizado
                        $selectedVisits = array_slice($this->availabilityOperatorVisits[$operatorId]['visits'], 0, 5);

                        foreach ($selectedVisits as $index => &$visit) {
                            // Verificar si el tiempo de viaje ya está en caché
                            $visit['travel_time'] = $this->getTravelTime($originLat, $originLng, $visit['latitude'], $visit['longitude']);
                        }
                        unset($visit);

                        usort($selectedVisits, function ($a, $b) {
                            return $a['travel_time'] <=> $b['travel_time'];
                        });

                        //Unificar los resultados de las visitas seleccionadas con las visitas originales
                        $this->availabilityOperatorVisits[$operatorId]['visits'] = array_merge($selectedVisits, array_slice($this->availabilityOperatorVisits[$operatorId]['visits'], 5));

                        // Intentar obtener una visita disponible para el operario
                        $visit = $this->checkAvailabilityOfVisitOrProperty($this->availabilityOperatorVisits[$operatorId]['visits'], $dateNextDay, $this->routeOrganizer[$dateNextDay]['workers'][$operatorId], $this->availabilityOperatorVisits[$operatorId]['availability']);

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
        } else {

            $selectedEmployees = json_decode($this->automaticRoute->selected_employees, true);


            $visitsQuery = Visit::whereHas('users', function ($query) use ($selectedEmployees) {
                $query->whereIn('id', $selectedEmployees);
            })
                ->where('date', '>=', Carbon::parse($this->startDate)->startOfDay())
                ->where('date', '<=', Carbon::parse($this->endDate)->endOfDay())
                ->with(['property:id,latitude,longitude', 'users:id,name', 'avaliabilities', 'property.availabilities'])
                ->select('visits.id', 'visits.date', 'visits.time', 'visits.property_id', 'visits.duration_time');

            $this->allVisits = collect();

            $visitsQuery->chunk(100, function ($visits) {
                foreach ($visits as $visit) {
                    $visitData = [
                        'id' => $visit->id,
                        'date' => $visit->date,
                        'start_time' => $visit->time,
                        'end_time' => Carbon::parse($visit->time)->addMinutes($visit->duration_time)->format('H:i'),
                        'travel_time' => 0,
                        'latitude' => $visit->property->latitude,
                        'longitude' => $visit->property->longitude,
                        'duration_time' => $visit->duration_time,
                        'availability' => !is_null($visit->avaliabilities) && $visit->avaliabilities->isNotEmpty()
                            ? $visit->avaliabilities
                            : (!is_null($visit->property->avaliabilities) && $visit->property->avaliabilities->isNotEmpty()
                                ? $visit->property->avaliabilities
                                : null),
                        'user' => $visit->users->first(),
                    ];

                    // Agregar la visita a la colección allVisits
                    $this->allVisits->push($visitData);

                    // Insertar la visita en routeOrganizer
                    $date = $visitData['date'];
                    $workerId = $visitData['user']['id'];


                    // Asegurarse de que la fecha y el operario estén inicializados
                    if (!isset($this->routeOrganizer[$date]['workers'][$workerId])) {
                        $this->routeOrganizer[$date]['workers'][$workerId] = [];
                    }

                    // Agregar la visita al array del operario en la fecha correspondiente
                    $this->routeOrganizer[$date]['workers'][$workerId][] = $visitData;

                    // Ordenar las visitas de cada operario por start_time
                    $this->routeOrganizer[$date]['workers'][$workerId] = collect($this->routeOrganizer[$date]['workers'][$workerId])
                        ->sortBy('start_time')
                        ->values()  // Re-indexar los valores después de ordenar
                        ->toArray(); // Convertir de nuevo a array si lo necesitas
                }
            });







            $this->employees = User::whereIn(
                'id',
                $selectedEmployees
            )->get();


            $visitToOrganizer = [];




            foreach ($this->availabilityOperatorVisits as $workerId => $workerData) {
                foreach ($workerData['visits'] as $visitId => $visitData) {
                    // Si la visita no existe en el array invertido, la creamos con sus datos
                    if (!isset($visitToOrganizer[$visitId])) {
                        // Mezclamos la información de la visita y el array de workers directamente
                        $visitToOrganizer[$visitId] = $visitData;
                        $visitToOrganizer[$visitId]['workers'] = [];
                    }


                    // Añadimos al trabajador dentro de la visita
                    $visitToOrganizer[$visitId]['workers'][] = [
                        'id' => $workerId,
                        'start_lat' => $workerData['start_lat'],
                        'start_lng' => $workerData['start_lng'],
                        'availability' => $workerData['availability']
                    ];
                }
            }


            Log::info('Visit to Organizer', $visitToOrganizer);


            $this->organizedVisits = [];

            foreach ($visitToOrganizer as $visitId => $visitData) {
                $possibleDates = [];

                // Recorremos todas las visitas ya organizadas en allVisits
                foreach ($this->allVisits as $organizedVisit) {
                    // Verificamos si el operario de la visita organizada está en los workers de la visita a organizar
                    foreach ($visitData['workers'] as $worker) {


                        if ($organizedVisit['user']->id === $worker['id']) {
                            // Calculamos el tiempo de viaje entre la visita a organizar y la visita organizada
                            $travelTime = $this->getTravelTime(
                                $visitData['latitude'],
                                $visitData['longitude'],
                                $organizedVisit['latitude'],
                                $organizedVisit['longitude']
                            );

                            // Añadimos la fecha, el operario y el tiempo de viaje
                            $possibleDates[] = [
                                'date' => $organizedVisit['date'],
                                'worker' => $organizedVisit['user'],
                                'travel_time' => $travelTime,
                            ];



                            break; // Si ya encontramos un operario que puede hacer la visita, no necesitamos seguir buscando más en esta visita organizada
                        }
                    }
                }

                // Ordenamos las fechas posibles por el tiempo de viaje de menor a mayor
                usort($possibleDates, function ($a, $b) {
                    return $a['travel_time'] <=> $b['travel_time'];
                });

                // Guardamos la lista de fechas ordenadas para esta visita
                $this->organizedVisits[$visitData['id']] = $possibleDates;
            }





            // Recorremos todas las visitas organizadas

            foreach ($this->organizedVisits as $visit => $possibleDates) {
                // Log::info('Organizeded Visits', $this->organizedVisits);
                $organized = false; // Para saber si se pudo organizar la visita

                // Recorremos las fechas y operarios ordenados por proximidad
                foreach ($possibleDates as $index => $option) {
                    $date = $option['date'];
                    $workerId = $option['worker']['id'];



                    $this->visitsForDay = [];
                    // Obtengo las visitas de allVisits de la misma fecha y operario
                    $this->visitsForDay = collect($this->routeOrganizer[$date]['workers'][$workerId]);


                    $visitLoop = Visit::find($visit);

                    // Hago un push de la visita actual a las visitas de ese día
                    $this->visitsForDay->push([
                        'id' => $visitLoop->id,
                        'date' => $date,
                        'start_time' => null,
                        'latitude' => $visitLoop->property->latitude,
                        'longitude' => $visitLoop->property->longitude,
                        'travel_time' => null,
                        'duration_time' => $visitLoop->duration_time,
                        'availability' => !is_null($visitLoop->avaliabilities) && $visitLoop->avaliabilities->isNotEmpty()
                            ? $visitLoop->avaliabilities
                            : (!is_null($visitLoop->property->avaliabilities) && $visitLoop->property->avaliabilities->isNotEmpty()
                                ? $visitLoop->property->avaliabilities
                                : null),
                        'user' => $option['worker'],
                    ]);



                    $this->routeOrganizedDay = [];



                    $dayFinished = false;

                    $userRoute = User::where('id', $workerId)->select('id', 'name', 'start_lat', 'start_lng')->with('availabilities')->first();

                    $dayAvailability = $userRoute->availabilities->firstWhere('day.name', strtoupper(Carbon::parse($date)->format('l')));

                    while (!$dayFinished || $this->visitsForDay->isEmpty()) {

                        if ($dayFinished || $this->visitsForDay->isEmpty()) {
                            break; // Salir del bucle si cualquiera de las condiciones se cumple
                        }

                        if ($this->checkSpaceForOtherWork($userRoute->availabilities, $date, $this->routeOrganizedDay)) {


                            $lastPoint = end($this->routeOrganizedDay); // Obtener el último punto de la ruta, si existe

                            // si no hay visitas en la ruta, el punto de origen es la casa del empleado
                            $originLat = $lastPoint['latitude'] ?? $userRoute->start_lat;
                            $originLng = $lastPoint['longitude'] ?? $userRoute->start_lng;



                            // Calcular el tiempo de viaje para todas las visitas
                            $this->visitsForDay = $this->visitsForDay->map(function ($visit) use ($originLat, $originLng) {

                                // Verificar que el destino tiene coordenadas válidas

                                // Calcular el tiempo de viaje solo si las coordenadas están definidas
                                $visit['travel_time'] = $this->getTravelTime(
                                    $originLat,
                                    $originLng,
                                    $visit['latitude'],
                                    $visit['longitude']
                                );

                                return $visit;
                            });

                            // Ordenar las visitas filtradas por tiempo de viaje actualizado
                            $this->visitsForDay = $this->visitsForDay->sortBy('travel_time')->values();
                            // dump($this->filteredVisits, $originLat, $originLng, $this->newRoute);


                            // Verificar si hay disponibilidad para la visita o la propiedad
                            $availabilityVisit = $this->checkAvailabilityOfVisitOrProperty(
                                $this->visitsForDay,
                                $date,
                                $this->routeOrganizedDay,
                                $userRoute['availabilities']
                            );


                            // Si hay disponibilidad, asignar la visita a la ruta
                            if ($availabilityVisit) {


                                // agregarle end time, que seria la suma de la hora de inicio + el tiempo de la visita
                                $this->assignVisit($this->routeOrganizedDay, $availabilityVisit, $userRoute->availabilities, $date);

                                // Eliminar la visita asignada a newRoute del array de filteredVisits
                                $this->visitsForDay = $this->visitsForDay->filter(function ($v) use ($availabilityVisit) {

                                    return $v['id'] != $availabilityVisit['id'];
                                });
                            }
                        } else {

                            // Si no hay espacio para más visitas, finalizar la jornada
                            $dayFinished = true;
                        }
                    }





                    //agregar la visita de id que es un array con un id this a la variable
                    $visitaThis = collect($this->routeOrganizedDay)->firstWhere('id', $visitLoop->id);



                    if (!$visitaThis) {
                        // unset($this->organizedVisits[$visit][$index]); // Eliminar la visita actual del array de visitas organizadas
                        // $this->organizedVisits = array_values($this->organizedVisits); // Reindexamos
                        Log::info('no se pudo organizar la visita');

                        continue; // Va al siguiente $option dentro del mismo foreach

                        // eliminar las visitas que ya se encuentran en la ruta de allVisits solo si la encuentra en el array de filteredVisits y newRoute

                    } else {

                        Log::info('Ruta Organizada', $this->routeOrganizedDay);

                        unset($this->organizedVisits[$visit]); // Eliminar la visita actual del array de visitas organizadas
                        //replazar las visitas en routeOrganizer

                        $this->routeOrganizer[$date]['workers'][$workerId] = [];
                        $this->routeOrganizer[$date]['workers'][$workerId] = $this->routeOrganizedDay;

                        break; // Salta al siguiente foreach de la siguiente visita

                    }
                }
            }
        }




        // Sleep::for(0.5)->seconds();
    }


    // private function processVisit()
    // {

    //     // Filtrar las visitas que coinciden con la visita cercana, con el mejor empleado y la misma fecha

    //     // jornada finalizada 
    //     $dayFinished = false;

    //     $userRoute = User::where('id', $this->aproximateVisit['user']['id'])->select('id', 'name', 'start_lat', 'start_lng')->with('availabilities')->first();

    //     $dayAvailability = $userRoute->availabilities->firstWhere('day.name', strtoupper(Carbon::parse($this->aproximateVisit['date'])->format('l')));

    //     $this->newRoute = [];

    //     while (!$dayFinished || $this->filteredVisits->isEmpty()) {

    //         if ($dayFinished || $this->filteredVisits->isEmpty()) {
    //             break; // Salir del bucle si cualquiera de las condiciones se cumple
    //         }

    //         if ($this->checkSpaceForOtherWork($userRoute->availabilities, $this->aproximateVisit['date'], $this->newRoute)) {

    //             $lastPoint = end($this->newRoute); // Obtener el último punto de la ruta, si existe

    //             // si no hay visitas en la ruta, el punto de origen es la casa del empleado
    //             $originLat = $lastPoint['latitude'] ?? $userRoute->start_lat;
    //             $originLng = $lastPoint['longitude'] ?? $userRoute->start_lng;

    //             // Calcular el tiempo de viaje para todas las visitas
    //             $this->filteredVisits = $this->filteredVisits->map(function ($visit) use ($originLat, $originLng) {

    //                 $visit['travel_time'] = $this->getTravelTime(
    //                     $originLat,
    //                     $originLng,
    //                     $visit['latitude'],
    //                     $visit['longitude']
    //                 );
    //                 return $visit;
    //             });

    //             // Ordenar las visitas filtradas por tiempo de viaje actualizado
    //             $this->filteredVisits = $this->filteredVisits->sortBy('travel_time')->values();
    //             // dump($this->filteredVisits, $originLat, $originLng, $this->newRoute);

    //             // Verificar si hay disponibilidad para la visita o la propiedad
    //             $availabilityVisit = $this->checkAvailabilityOfVisitOrProperty(
    //                 $this->filteredVisits,
    //                 $this->aproximateVisit['date'],
    //                 $this->newRoute,
    //                 $userRoute['availabilities']
    //             );

    //             // Si hay disponibilidad, asignar la visita a la ruta
    //             if ($availabilityVisit) {
    //                 // agregarle end time, que seria la suma de la hora de inicio + el tiempo de la visita
    //                 $this->assignVisit($this->newRoute, $availabilityVisit, $userRoute->availabilities, $this->aproximateVisit['date']);
    //                 // Eliminar la visita asignada a newRoute del array de filteredVisits
    //                 $this->filteredVisits = $this->filteredVisits->filter(function ($v) use ($availabilityVisit) {
    //                     return $v['id'] != $availabilityVisit['id'];
    //                 });
    //             }
    //         } else {
    //             // Si no hay espacio para más visitas, finalizar la jornada
    //             $dayFinished = true;
    //         }
    //     }

    //     // Ordenar las visitas filtradas por tiempo de viaje actualizado
    //     $this->filteredVisits = $this->filteredVisits->sortBy('travel_time')->values();

    //     //agregar la visita de id que es un array con un id this a la variable
    //     $visitaThis = collect($this->newRoute)->firstWhere('id', 'this');

    //     if (!$visitaThis) {

    //         // eliminar las visitas que ya se encuentran en la ruta de allVisits solo si la encuentra en el array de filteredVisits y newRoute
    //         $this->allVisits = $this->allVisits->reject(function ($visit) {
    //             return collect($this->newRoute)->contains('id', $visit['id']) ||
    //                 collect($this->filteredVisits)->contains('id', $visit['id']);
    //         });

    //         //reacer los values de all visits
    //         $this->allVisits = $this->allVisits->values();
    //         $this->searchOtherRoute();
    //         return;
    //     }

    //     if ($this->filteredVisits->isNotEmpty()) {

    //         foreach ($this->filteredVisits as $visit) {


    //             $availabilityVisit = $this->checkAvailabilityOfVisitOrProperty(
    //                 $this->filteredVisits,
    //                 $this->aproximateVisit['date']
    //             );

    //             if ($availabilityVisit) {
    //                 $this->assignOutVisit($visit, $userRoute);
    //             }
    //         }
    //     }

    //     $this->allVisits = $this->allVisits->reject(function ($visit) {
    //         return collect($this->newRoute)->contains('id', $visit['id']);
    //     });

    //     //reacer los values de all visits
    //     $this->allVisits = $this->allVisits->values();

    //     //eliminar los inicios de la casa
    //     $this->newRoute = collect($this->newRoute)->filter(function ($visit) {
    //         return !str_starts_with($visit['id'], 'HOME');
    //     })->values()->toArray();

    //     $this->routesOrganized[] = [
    //         'visit' => $visitaThis ?? null,
    //         'route' => $this->newRoute
    //     ];

    //     $this->dispatch('select-visit', date: $visitaThis['date'], time: $visitaThis['start_time'], worker: $visitaThis['user']['id']);
    // }



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
                if ($this->checkAvailabilityOfVisitOrProperty($data['visits'], $dateNextDay, $this->routeOrganizer[$dateNextDay]['workers'][$operatorId], $this->availabilityOperatorVisits[$operatorId]['availability']) != null) {
                    $winningVisits[$operatorId] = $this->checkAvailabilityOfVisitOrProperty($data['visits'], $dateNextDay, $this->routeOrganizer[$dateNextDay]['workers'][$operatorId], $this->availabilityOperatorVisits[$operatorId]['availability']);
                }
            }
        }
        return $winningVisits;
    }

    // Función para procesar visitas en común
    private function processCommonVisits($visitasGanadorasEnComun, $dateNextDay, $dayOfWeek)
    {
        foreach ($visitasGanadorasEnComun as $visitaId) {
            $operatorId = $visitaId['name'];
            $visit = $this->availabilityOperatorVisits[$operatorId]['visits'][0];


            $this->assignVisit($this->routeOrganizer[$dateNextDay]['workers'][$operatorId], $visit, $this->availabilityOperatorVisits[$operatorId]['availability'], $dateNextDay);
            $this->deleteVisitFromOtherOperators($visit['id']);
        }
    }

    // Función para procesar visitas individuales
    private function processIndividualVisits($winningVisits, $dateNextDay, $dayOfWeek)
    {
        foreach ($winningVisits as $operatorId => $visit) {
            $this->assignVisit($this->routeOrganizer[$dateNextDay]['workers'][$operatorId], $visit, $this->availabilityOperatorVisits[$operatorId]['availability'], $dateNextDay);
            $this->deleteVisitFromOtherOperators($visit['id']);
        }
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

    protected function updateProgress($percentage)
    {
        $this->automaticRoute->update(['progress' => $percentage]);
    }
}
