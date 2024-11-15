<?php

namespace App\Livewire\Panel\Visit\Organizer;

use App\Helpers\Notifications;
use App\Models\AutomaticRoute;
use App\Models\Property;
use App\Models\TravelTime;
use App\Models\User;
use App\Models\Visit;
use Carbon\Carbon;
use Livewire\Attributes\On;
use Livewire\Component;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class ShowOrganizerPreview extends Component
{
    public $routeId; // ID de la ruta
    public $routeOrganizer = []; // Estructura de las rutas
    public $selectedDate = null; // Fecha seleccionada
    public $uncoordinatedVisits = [];
    public $selectedPoint;
    public $unsaved = false;
    public $selectedOperator;


    public $previousDate = null;
    public $previousOperatorId = null;
    // Propiedades para manejar el modal de mover visitas
    public $showMoveModal = false;
    public $moveToDate;
    public $moveToOperator;
    public $selectedVisitId;
    public $currentDate;
    public $currentOperatorId;
    public $availableDates = [];
    public $availableOperators = [];



    // Para inicializar el componente con la ruta específica
    public function mount($routeId)
    {

        $route = AutomaticRoute::findOrFail($routeId);

        $this->routeOrganizer = json_decode($route->modified_routes, true) ?: json_decode($route->routes, true);



        //dd($this->routeOrganizer);

        // $this->organizedVisits = json_decode($route->selected_visits, true) ?? []; // Las visitas seleccionadas
        $this->uncoordinatedVisits = json_decode($route->uncoordinated_visits, true) ?? []; // Visitas no organizadas

        $this->availableDates = array_keys($this->routeOrganizer);

        // dd($this->routeOrganizer);

        // Iterar sobre las fechas
        foreach ($this->routeOrganizer as &$data) {
            if (isset($data['workers'])) {

                //dump($data);
                // Iterar sobre los operarios (workers)
                foreach ($data['workers'] as $workerId => $workerData) {
                    // Si el worker no tiene visitas, lo eliminamos
                    //dd($workerData);
                    if (empty($workerData)) {
                        unset($data['workers'][$workerId]);
                    }
                }

                // Si después de eliminar no quedan workers, puedes también eliminar la fecha si lo deseas
                // if (empty($data['workers'])) {
                //     unset($this->routeOrganizer[$date]);
                // }
            }
        }




        $operators = $this->loadOperatorsLote();

        // Reemplazar los nombres de los operarios
        $this->replaceNameOperators($operators);

        // Optimización para cargar visitas en lote
        $visits = $this->loadVisitsLote();

        // Añadir detalles a las visitas
        $this->addDetailsVisits($visits);

        // Determinar si cada fecha tiene visitas
        $this->checkDateHasVisits();



        // Cargar visitas no organizadas
        $this->loadVisitsNotOrganized();

        // Seleccionar la primera fecha por defecto con visitas
        $this->selectFirstDate();

        //$this->selectedDate = '2024-09-23';
        //dd($this->selectedDate);

        // $this->updateMap();


    }




    public function replaceNameOperators($operators)
    {

        foreach ($this->routeOrganizer as &$dataDate) {
            $newWorkers = [];
            foreach ($dataDate['workers'] as $operatorId => $visits) {
                $operatorName = $operators[$operatorId] ?? 'Nombre no disponible';
                $newWorkers[$operatorId] = [
                    'name' => $operatorName,
                    'visits' => $visits,
                ];
            }
            $dataDate['workers'] = $newWorkers;
        }
    }




    public function loadOperatorsLote()
    {

        // Optimización para cargar operarios en lote
        $operatorIds = [];
        foreach ($this->routeOrganizer as $dataDate) {
            $operatorIds = array_merge($operatorIds, array_keys($dataDate['workers']));
        }
        $operatorIds = array_unique($operatorIds);
        $operators = User::whereIn('id', $operatorIds)->pluck('name', 'id');


        return $operators;
    }



    public function loadVisitsLote()
    {

        $visitIds = [];
        foreach ($this->routeOrganizer as $dataDate) {
            foreach ($dataDate['workers'] as $operatorData) {
                foreach ($operatorData['visits'] as $visit) {
                    if (is_array($visit) && isset($visit['id'])) {
                        $visitIds[] = $visit['id'];
                    }
                }
            }
        }
        $visitIds = array_unique($visitIds);
        $visits = Visit::with('customer', 'property')->whereIn('id', $visitIds)->get()->keyBy('id');


        return $visits;
    }



    public function addDetailsVisits($visits)
    {

        foreach ($this->routeOrganizer as &$dataDate) {
            foreach ($dataDate['workers'] as &$operatorData) {
                foreach ($operatorData['visits'] as &$visit) {
                    if (is_array($visit) && isset($visit['id'])) {
                        $visitModel = $visits[$visit['id']] ?? null;
                        if ($visitModel) {
                            $visit['customer_name'] = $visitModel->customer->name;
                            $visit['address'] = $visitModel->property->address;
                            $visit['property'] = $visitModel->property;
                            $visit['exceeds_working_hours'] = false;
                        }
                    }
                }
            }
        }
    }



    public function checkDateHasVisits()
    {

        foreach ($this->routeOrganizer as $date => $data) {
            $workers = $data['workers'];
            $hasVisits = false;

            foreach ($workers as $operatorData) {
                if (!empty($operatorData['visits'])) {
                    $hasVisits = true;
                    break;
                }
            }

            $this->routeOrganizer[$date]['hasVisits'] = $hasVisits;
        }
    }


    public function selectFirstDate()
    {

        $this->selectedDate = array_key_first($this->routeOrganizer);
        foreach ($this->routeOrganizer as $date => $data) {
            if ($data['hasVisits']) {
                $this->selectedDate = $date;
                break;
            }
        }
    }





    public function loadVisitsNotOrganized()
    {
        $this->uncoordinatedVisits = Visit::whereIn('id', $this->uncoordinatedVisits)->with('property', 'customer')->get()->toArray();
        // dd($this->uncoordinatedVisits);
    }




    // Método para cambiar la fecha seleccionada
    public function selectDate($date)
    {



        $this->selectedDate = $date;
        // $this->updateMap();
    }

    // Método para guardar las rutas
    public function saveRoutes()
    {

        // Validar que hay cambios para guardar
        if (!$this->unsaved) {

            session()->flash('notification', [
                'message' => 'No hay cambios para guardar.',
                'type' => Notifications::icons('info')
            ]);
        }



        // Obtener la ruta actual desde la base de datos
        $route = AutomaticRoute::findOrFail($this->routeId);


        $route->modified_routes = json_encode($this->restoreDefaultStructureRoutes());



        $route->save();


        $this->assignedVisitsToUsers();

        // Route::get('{year}/{month}/{day}', ListRoute::class)->name('daily'); //formato lista

        //Obtener año, mes y día de la fecha seleccionada

        $date = Carbon::parse($this->selectedDate);
        $year = $date->year;
        $month = $date->month;
        $day = $date->day;



        $this->redirectRoute('panel.routes.daily', [
            'year' => $year,
            'month' => $month,
            'day' => $day
        ], true, true);
    }


    public function restoreDefaultStructureRoutes()
    {
        $structureOriginal = [];

        foreach ($this->routeOrganizer as $date => $dateData) {
            // Inicializamos la estructura para cada fecha
            $structureOriginal[$date] = [
                "workers" => []
            ];

            // Recorremos cada worker dentro de la fecha
            foreach ($dateData['workers'] as $workerId => $workerData) {
                // Asignamos directamente el array de visitas al worker
                $structureOriginal[$date]['workers'][$workerId] = $workerData['visits'];
            }
        }

        return $structureOriginal;
    }


    public function assignedVisitsToUsers()
    {
        foreach ($this->routeOrganizer as $date => $data) {
            foreach ($data['workers'] as $operator => $visits) {
                if (isset($data['workers'][$operator])) {

                    $visitIds = collect($data['workers'][$operator]['visits'])->pluck('id');

                    Visit::whereIn('id', $visitIds)->get()->each(function ($visit) use ($date, $operator, $data) {
                        $visitaData = collect($data['workers'][$operator]['visits'])->firstWhere('id', $visit->id);

                        $visit->date = $date;
                        $visit->time = $visitaData['start_time'];
                        $visit->save();

                        $operarioModel = User::where('id', $operator)->first();
                        // Sincronizar el operario sin eliminar otras relaciones
                        $visit->users()->sync([$operarioModel->id]);
                    });
                }
            }
        }
    }



    #[On('updateTimes')]
    public function updateTimesRouteOrganizer($data)
    {
        //dd($data);

        $this->routeOrganizer[$data['date']]['workers'][$data['operatorId']]['visits'] = $data['visits'];
    }


    #[On('updateExceedsWorkingHours')]
    public function updateExceedsWorkingHours($data)
    {
        $this->routeOrganizer[$data['date']]['workers'][$data['operatorId']]['visits'] = $data['visits'];
    }


    #[On('updateDeleteVisit')]
    public function updateDeleteVisit($data)
    {
        $this->routeOrganizer[$data['date']]['workers'][$data['operatorId']]['visits'] = $data['visits'];
    }





    #[On('updateUnSaved')]
    public function updateUnSaved($value)
    {

        //  dd($value);
        $this->unsaved = $value;
    }

    #[On('updateUnCoordination')]
    public function updateUnCoordination($id, $operarioId, $date)
    {
        $visit = Visit::with('property', 'customer')->find($id);

        // Convert the model to an array, including relationships
        $visitArray = $visit->toArray();

        // Add custom attributes
        $visitArray['previous_operator_id'] = $operarioId;
        $visitArray['previous_date'] = $date;

        $this->uncoordinatedVisits[] = $visitArray;
    }


    #[On('updateUndoVisit')]
    public function updateCoordination($data)
    {
        $this->routeOrganizer[$data['date']]['workers'][$data['operatorId']]['visits'] = $data['visits'];
    }


    #[On('updateUndoUnCoordination')]
    public function updateUndoUnCoordination($id)
    {


        $this->uncoordinatedVisits = array_values(array_filter($this->uncoordinatedVisits, function ($uncoordinatedVisit) use ($id) {
            return $uncoordinatedVisit['id'] !== $id;
        }));
    }


    #[On('updateMoveVisit')]
    public function updateMoveVisit($data)
    {


        $currentDate = $data['currentDate'];
        $currentOperatorId = $data['currentOperatorId'];
        $selectedVisitId = $data['selectedVisitId'];
        $moveToDate = $data['moveToDate'];
        $moveToOperator = $data['moveToOperator'];

        $visit = null;
        $removedVisitIndex = null;

        $visitsUpdateOrigin = null;

        // Buscar y remover la visita que queremos mover de su ubicación actual
        if (isset($this->routeOrganizer[$currentDate]['workers'][$currentOperatorId]['visits'])) {
            foreach ($this->routeOrganizer[$currentDate]['workers'][$currentOperatorId]['visits'] as $key => $v) {
                if ($v['id'] === $selectedVisitId) {
                    $visit = $v;
                    $removedVisitIndex = $key; // Guardamos el índice de la visita removida

                    // Removemos la visita del array
                    unset($this->routeOrganizer[$currentDate]['workers'][$currentOperatorId]['visits'][$key]);

                    // Reindexamos el array para mantener índices consecutivos
                    $this->routeOrganizer[$currentDate]['workers'][$currentOperatorId]['visits'] = array_values($this->routeOrganizer[$currentDate]['workers'][$currentOperatorId]['visits']);

                    break;
                }
            }
        }

        // Verificar que la visita exista
        if (!$visit) {



            session()->flash('notification', [
                'message' => 'Visita no encontrada',
                'type' => Notifications::icons('error')
            ]);
            return;
        }



        // dd($this->routeOrganizer);

        // Verificar que la fecha y operario destino existan en routeOrganizer
        if (!isset($this->routeOrganizer[$moveToDate])) {
            $this->routeOrganizer[$moveToDate] = [
                'workers' => []
            ];
        }


        // Verificar que el operario destino exista en routeOrganizer

        if (!isset($this->routeOrganizer[$moveToDate]['workers'][$moveToOperator])) {
            $this->routeOrganizer[$moveToDate]['workers'][$moveToOperator] = [
                'name' => User::find($moveToOperator)->name ?? 'Nombre no disponible',
                'visits' => []
            ];
        }


        // Agregar la visita a la nueva ubicación
        $this->routeOrganizer[$moveToDate]['workers'][$moveToOperator]['visits'][] = $visit;

        // Reordenar las visitas del operario en la fecha de destino
        $this->reorderVisitsFromOrigin($moveToDate, $moveToOperator);

        // Reordenar las visitas del operario en la fecha de origen desde donde se eliminó la visita
        if ($removedVisitIndex !== null) {
            // dd('hola');
            $visitsUpdateOrigin =  $this->recalculateTimesFromIndex($currentDate, $currentOperatorId, $removedVisitIndex);
            // dd($visitsUpdateOrigin);
        }

        $this->verifyWorkingSchedulePostMovedVisit($moveToDate, $moveToOperator);

        // Marcar cambios como no guardados
        $this->unsaved = true;

        $this->checkDateHasVisits();


        //    dd($this->routeOrganizer[$moveToDate]['workers'][$moveToOperator]['visits']);

        //  dd($this->routeOrganizer[$currentDate]['workers'][$currentOperatorId]['visits']);
        if ($this->selectedDate == $currentDate) {
            $this->dispatch(
                'updateVisitsInChild',
                visitsUpdate: $visitsUpdateOrigin,
                operatorId: $currentOperatorId,
                date: $currentDate
            );
        }
    }



    public function reorderVisitsFromOrigin($date, $operatorId)
    {
        //dd($date, $operatorId);

        // dd($date, $operatorId);
        // Obtener el operario para acceder a su origen
        $operator = User::find($operatorId);

        if (!$operator) {
            throw new \Exception('Operario no encontrado');
        }

        // Obtener todas las visitas del operario en la fecha seleccionada
        $visits = $this->routeOrganizer[$date]['workers'][$operatorId]['visits'] ?? [];

        // dd($visits);

        // Si no hay visitas, no hay nada que reorganizar
        if (empty($visits)) {
            // dd('No hay visitas');
            return;
        }

        // Paso 1: Recalcular el travel_time desde el origen del operario para todas las visitas
        foreach ($visits as &$visit) {
            $visit['travel_time'] = $this->getTravelTime(
                $operator->start_lat,
                $operator->start_lng,
                $visit['latitude'],
                $visit['longitude']
            );
        }

        // Paso 2: Ordenar las visitas según el travel_time desde el origen del operario
        usort($visits, function ($a, $b) {
            return $a['travel_time'] <=> $b['travel_time'];
        });


        // dd($visits);

        // Inicializar la ruta final con la primera visita (la más cercana al origen)
        $orderedVisits = [];
        $firstVisit = array_shift($visits);  // Eliminar la primera visita del array
        $orderedVisits[] = $firstVisit;  // Añadir la primera visita a la ruta final




        // Paso 3: Iterar para calcular el travel_time desde la última visita añadida a la ruta
        while (!empty($visits)) {
            // Obtener la última visita de la ruta ordenada
            $lastVisit = end($orderedVisits);

            // Calcular el travel_time desde la última visita para las visitas restantes
            foreach ($visits as &$visit) {
                $visit['travel_time'] = $this->getTravelTime(
                    $lastVisit['latitude'],
                    $lastVisit['longitude'],
                    $visit['latitude'],
                    $visit['longitude']
                );
            }

            // Ordenar las visitas restantes según el travel_time desde la última visita
            usort($visits, function ($a, $b) {
                return $a['travel_time'] <=> $b['travel_time'];
            });

            // Seleccionar la siguiente visita (la más cercana a la última visita en la ruta)
            $nextVisit = array_shift($visits);  // Eliminar la visita seleccionada del array
            $orderedVisits[] = $nextVisit;  // Añadir la visita a la ruta final
        }

        // Asignar las visitas ordenadas a la estructura principal
        $this->routeOrganizer[$date]['workers'][$operatorId]['visits'] = $orderedVisits;

        // Paso 4: Recalcular los tiempos de inicio y fin para todas las visitas
        $this->recalculateTimesForAllVisits($date, $operatorId);
    }


    public function recalculateTimesForAllVisits($date, $operatorId)
    {


        // Obtener el operario para acceder a su origen y horario laboral
        $operator = User::find($operatorId);

        // Obtener la hora de inicio de la jornada laboral del operario en el día específico
        $dayOfWeek = strtoupper(Carbon::parse($date)->format('l'));

        $startWorkTime = $operator->availabilities->where('day.name', $dayOfWeek)->first()->start;

        // Obtener las visitas del operario ya ordenadas en la fecha seleccionada
        $visits = $this->routeOrganizer[$date]['workers'][$operatorId]['visits'] ?? [];

        // Si no hay visitas, no hay nada que recalcular
        if (empty($visits)) {
            return;
        }

        // Paso 1: Establecer el tiempo de inicio para la primera visita desde el inicio de la jornada laboral
        $previousEndTime = $startWorkTime;
        $previousLat = $operator->start_lat;
        $previousLng = $operator->start_lng;

        foreach ($visits as $index => &$visit) {
            if ($index === 0) {
                // Primera visita: El inicio es el inicio del horario laboral
                $visit['start_time'] = $startWorkTime;

                // Calcular el tiempo de viaje desde el origen del operario a la primera visita
                $visit['travel_time'] = $this->getTravelTime(
                    $operator->start_lat,
                    $operator->start_lng,
                    $visit['latitude'],
                    $visit['longitude']
                );
            } else {
                // Para las visitas siguientes, el tiempo de inicio es el tiempo de fin de la anterior + travel_time
                $visit['travel_time'] = $this->getTravelTime(
                    $previousLat,
                    $previousLng,
                    $visit['latitude'],
                    $visit['longitude']
                );

                $visit['start_time'] = date('H:i:s', strtotime($previousEndTime) + $visit['travel_time'] * 60);
            }

            // Paso 2: El tiempo de fin es el tiempo de inicio más la duración de la visita
            $visit['end_time'] = date('H:i:s', strtotime($visit['start_time']) + $visit['duration_time'] * 60);

            // Paso 3: Actualizar los valores para la próxima iteración
            $previousEndTime = $visit['end_time'];  // Actualiza el tiempo de fin para la próxima visita
            $previousLat = $visit['latitude'];  // Actualiza la latitud de la visita para el próximo cálculo
            $previousLng = $visit['longitude'];  // Actualiza la longitud de la visita para el próximo cálculo
        }

        // Guardar las visitas actualizadas en la estructura principal
        $this->routeOrganizer[$date]['workers'][$operatorId]['visits'] = $visits;

        // Emitir evento para actualizar el mapa y la vista en el frontend
        // $this->dispatch('updateTimes', [
        //     'date' => $date,
        //     'operatorId' => $operatorId,
        //     'visits' => $visits
        // ]);




        $this->dispatch(
            'updateVisitsInChild',
            visitsUpdate: $this->routeOrganizer[$date]['workers'][$operatorId]['visits'],
            operatorId: $operatorId,
            date: $date
        );
    }



    function getTravelTime($originLat, $originLng, $destinationLat, $destinationLng, $mode = 'driving')
    {
        $googleMapsApiKey = 'AIzaSyD3K3dBES7-pn0gkICbQyiQgfNHhlUU3W4';
        // Redondear las coordenadas a 6 decimales
        $originLat = round($originLat, 6);
        $originLng = round($originLng, 6);
        $destinationLat = round($destinationLat, 6);
        $destinationLng = round($destinationLng, 6);

        // Intentar obtener el tiempo de viaje de la base de datos
        $travelTimeRecord = TravelTime::where('origin_latitude', $originLat)
            ->where('origin_longitude', $originLng)
            ->where('destination_latitude', $destinationLat)
            ->where('destination_longitude', $destinationLng)
            ->first();

        // dump($travelTimeRecord);
        if ($travelTimeRecord) {
            return $travelTimeRecord->travel_time_minutes;
        }


        // Si no se encuentra en la base de datos, hacer una solicitud a la API de Google Maps


        $url = 'https://maps.googleapis.com/maps/api/distancematrix/json?units=metric'
            . '&origins=' . $originLat . ',' . $originLng
            . '&destinations=' . $destinationLat . ',' . $destinationLng
            . '&mode=' . $mode
            . '&key=' . $googleMapsApiKey;

        $response = Http::get($url);
        $data = $response->json();


        if ($data['status'] == 'OK' && $data['rows'][0]['elements'][0]['status'] == 'OK') {
            // $this->requests++;
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



    public function verifyWorkingSchedulePostMovedVisit($date, $operatorId)
    {

        // Obtener el día de la semana en formato string (por ejemplo, MONDAY, TUESDAY)
        $dayOfWeek = strtoupper(Carbon::parse($date)->format('l'));


        // Obtener el operario y sus disponibilidades
        $operator = User::find($operatorId);

        if (!$operator) {
            // Manejar el caso en que no se encuentra el operario
            return true; // Asumir que no hay restricciones si el operario no existe
        }

        // Mapear las disponibilidades del operario en un formato más manejable
        $availabilitiesOperario = $operator->availabilities->map(function ($availability) {
            return [
                'day' => $availability->day->name, // Acceder al name del enum AvailabilityDayEnums
                'start_time' => $availability->start_time,
                'end_time' => $availability->end_time
            ];
        })->toArray();

        // Buscar la disponibilidad para el día específico (por ejemplo, MONDAY)
        $dayAvailability = collect($availabilitiesOperario)->firstWhere('day', $dayOfWeek);

        // Si no se encuentra disponibilidad para ese día, se asume que no trabaja ese día
        if (!$dayAvailability) {
            return true; // No hay restricciones, el operario no trabaja ese día
        }

        // Obtener la hora de fin del horario laboral
        $EndWorkTime = Carbon::createFromFormat('H:i:s', $dayAvailability['end'])->format('H:i:s');

        $exceedsWorkHours = false;

        // Iterar sobre todas las visitas del día para verificar si alguna excede el horario laboral
        foreach ($this->routeOrganizer[$date]['workers'][$operatorId]['visits'] as &$visit) {
            $EndVisitTime = Carbon::createFromFormat('H:i:s', $visit['end_time']);

            // Si alguna visita excede el horario laboral, marcarla y todas las siguientes
            if ($exceedsWorkHours || $EndVisitTime->greaterThan($EndWorkTime)) {
                $visit['exceeds_working_hours'] = true; // Marcar visita como excedida
                $exceedsWorkHours = true;
            } else {
                $visit['exceeds_working_hours'] = false; // Marcar visita como dentro del horario
            }
        }

        // No es necesario actualizar la estructura de rutas ya que hemos modificado por referencia
        return !$exceedsWorkHours; // Retorna true si ninguna visita excede el horario
    }




    public function recalculateTimesFromIndex($date, $operatorId, $startIndex)
    {


        // Obtener las visitas del operario en la fecha seleccionada
        $visits = $this->routeOrganizer[$date]['workers'][$operatorId]['visits'] ?? [];
        // dd($visits);

        if (empty($visits)) {
            return $visits;
        }

        // Si startIndex es mayor que 0, verifica el elemento anterior
        if ($startIndex > 0 && !isset($visits[$startIndex - 1])) {
            return;
        }

        // Obtener la visita anterior al índice de inicio, o el origen del operario si es la primera visita
        if ($startIndex === 0) {

            // Si es la primera visita, el "origen" es el operario y el inicio es el de la jornada laboral
            $previousEndTime = $this->getOperatorStartTime($operatorId, $date); // Obtener el inicio de jornada laboral
            $previousLat = User::find($operatorId)->start_lat;
            $previousLng = User::find($operatorId)->start_lng;
        } else {
            // La visita anterior es la que precede al índice de inicio
            $previousVisit = $visits[$startIndex - 1];
            $previousEndTime = $previousVisit['end_time'];
            $previousLat = $previousVisit['latitude'];
            $previousLng = $previousVisit['longitude'];
        }


        // Iterar sobre las visitas a partir del índice de inicio
        for ($i = $startIndex; $i < count($visits); $i++) {
            $visit = &$visits[$i]; // Referencia a la visita actual para modificarla directamente

            // Si es la primera visita, usar el inicio de la jornada laboral
            if ($i === 0) {
                $visit['start_time'] = $previousEndTime; // El inicio es la jornada laboral
            } else {
                // Para las visitas subsiguientes, calcular el tiempo de viaje desde la visita anterior
                $visit['travel_time'] = $this->getTravelTime(
                    $previousLat,
                    $previousLng,
                    $visit['latitude'],
                    $visit['longitude']
                );

                // El tiempo de inicio de la visita actual es el tiempo de fin de la visita anterior más el travel_time
                $visit['start_time'] = date('H:i:s', strtotime($previousEndTime) + $visit['travel_time'] * 60);
            }

            // El tiempo de fin es el tiempo de inicio más la duración de la visita
            $visit['end_time'] = date('H:i:s', strtotime($visit['start_time']) + $visit['duration_time'] * 60);

            // Actualizar la referencia para la siguiente iteración
            $previousEndTime = $visit['end_time'];
            $previousLat = $visit['latitude'];
            $previousLng = $visit['longitude'];
        }

        // Guardar las visitas actualizadas en la estructura principal
        $this->routeOrganizer[$date]['workers'][$operatorId]['visits'] = $visits;


        return $visits;

        //return $visits;
        // Emitir evento con el operador específico
        // $this->dispatch(
        //     'updateVisitsInChild',
        //     visitsUpdate: $this->routeOrganizer[$date]['workers'][$operatorId]['visits'],
        //     operatorId: $operatorId,
        //     date: $date
        // );
    }




    public function getOperatorStartTime($operatorId, $date)
    {
        // Obtener el operario y sus disponibilidades
        $operator = User::find($operatorId);

        // if (!$operator) {
        //     // Manejar el caso en que no se encuentra el operario
        //     return '08:00:00'; // Asumir que el horario laboral empieza a las 8:00 AM
        // }

        // Obtener el día de la semana en formato string (por ejemplo, MONDAY, TUESDAY)
        $dayOfWeek = strtoupper(Carbon::parse($date)->format('l'));

        // Buscar la disponibilidad para el día específico (por ejemplo, MONDAY)
        $dayAvailability = $operator->availabilities->where('day.name', $dayOfWeek)->first();

        // Si no se encuentra disponibilidad para ese día, se asume que no trabaja ese día
        // if (!$dayAvailability) {
        //     return '08:00:00'; // Asumir que el horario laboral empieza a las 8:00 AM
        // }
        //dd($dayAvailability->start);
        return $dayAvailability->start;
    }




    //Propiedades para manejar el modal de mover visitas

    public $showMoveModalVisitNotOrganized = false;


    public function openMoveModalVisitNotOrganized($visitId, $propertyId)
    {


        $this->selectedVisitId = $visitId;
        // dd($this->uncoordinatedVisits) ;
        $property = array_map(function ($visit) {
            return $visit['property'];
        }, $this->uncoordinatedVisits);

        //dd($property);
        $property = $property[array_search($propertyId, array_column($property, 'id'))];


        $this->availableOperators = User::all()
            ->filter(function ($employee) use ($property) {
                return $employee->worksInZone($property);
            })
            ->map(function ($employee) {
                return [
                    'id' => $employee->id,
                    'name' => $employee->name,
                ];
            })->toArray();

        $this->availableOperators = array_column($this->availableOperators, 'name', 'id');

        $this->moveToDate = null;
        $this->moveToOperator = null;
        // $this->moveToOperator = array_key_first($this->availableOperators) ?? null;

        $this->showMoveModalVisitNotOrganized = true;
    }


    public function closeMoveModalVisitNotOrganized()
    {

        $this->showMoveModalVisitNotOrganized = false;
        $this->previousOperatorId = null;
        $this->previousDate = null;
        $this->reset(['moveToDate', 'moveToOperator', 'selectedVisitId', 'currentDate', 'currentOperatorId']);
    }




    public function moveVisitNotOrganized()
    {

        // Validaciones básicas
        if (!$this->selectedVisitId || !$this->moveToDate || !$this->moveToOperator) {


            session()->flash('notification', [
                'message' => 'Por favor, selecciona una fecha y un operario válidos.',
                'type' => Notifications::icons('error')
            ]);
            return;
        }

        // dd('hola');
        if (is_null($this->checkAvailabilityWorker($this->moveToOperator, $this->moveToDate))) {

            session()->flash('status',  'El operario no tiene horario laboral asignado para la fecha seleccionada');
            return;
        }



        $keyVisit = array_search($this->selectedVisitId, array_column($this->uncoordinatedVisits, 'id'));

        $unCoordinatedVisit = $this->uncoordinatedVisits[$keyVisit];




        $modelVisit = Visit::where('id', $this->selectedVisitId)->first();
        $arrayVisit = $this->structureVisit($modelVisit);


        //Sacar la visita del array de visitas no coordinadas
        $this->uncoordinatedVisits = array_values(array_filter($this->uncoordinatedVisits, function ($uncoordinatedVisit) use ($unCoordinatedVisit) {
            return $uncoordinatedVisit['id'] !== $unCoordinatedVisit['id'];
        }));


        //    dd($unCoordinatedVisit);

        // Dispatch the event if the visit has a previous operator
        if (!empty($unCoordinatedVisit['previous_operator_id'])) {
            $this->dispatch(
                'updateHistoryDeleteVisit',
                operatorId: $unCoordinatedVisit['previous_operator_id'],
                visitId: $arrayVisit['id'],
                date: $unCoordinatedVisit['previous_date']
            );
        }




        // Verificar que la fecha y operario destino existan en routeOrganizer
        if (!isset($this->routeOrganizer[$this->moveToDate])) {
            $this->routeOrganizer[$this->moveToDate] = [
                'workers' => []
            ];
        }


        // Verificar que el operario destino exista en routeOrganizer
        if (!isset($this->routeOrganizer[$this->moveToDate]['workers'][$this->moveToOperator])) {
            $this->routeOrganizer[$this->moveToDate]['workers'][$this->moveToOperator] = [
                'name' => User::find($this->moveToOperator)->name ?? 'Nombre no disponible',
                'visits' => []
            ];
        }






        // Agregar la visita a la nueva ubicación
        $this->routeOrganizer[$this->moveToDate]['workers'][$this->moveToOperator]['visits'][] = $arrayVisit;



        // Reordenar las visitas del operario en la fecha de destino
        $this->reorderVisitsFromOrigin($this->moveToDate, $this->moveToOperator);


        $this->verifyWorkingSchedulePostMovedVisit($this->moveToDate, $this->moveToOperator);



        // Marcar cambios como no guardados
        $this->unsaved = true;

        $this->checkDateHasVisits();


        if ($this->selectedDate == $this->moveToDate) {
            $this->dispatch(
                'updateVisitsInChild',
                visitsUpdate: $this->routeOrganizer[$this->moveToDate]['workers'][$this->moveToOperator]['visits'],
                operatorId: $this->moveToOperator,
                date: $this->moveToDate
            );
        }

        // Cerrar el modal
        $this->closeMoveModalVisitNotOrganized();




        session()->flash('notification', [
            'message' => 'La visita ha sido movida exitosamente',
            'type' => Notifications::icons('success')
        ]);
    }




    public function checkAvailabilityWorker($workerId, $date)
    {

        // Obtener el operario para acceder a su origen y horario laboral
        $worker = User::find($workerId);

        // Obtener la hora de inicio de la jornada laboral del operario en el día específico
        $dayOfWeek = strtoupper(Carbon::parse($date)->format('l'));

        $startWorkTime = $worker->availabilities->where('day.name', $dayOfWeek)->first()->start ?? null;

        return $startWorkTime;
    }





    public function structureVisit($visit)
    {


        $visitArray = [
            'id' => $visit->id,
            'latitude' => $visit->property->latitude ?? null, // Se toma la latitud desde la propiedad
            'longitude' => $visit->property->longitude ?? null, // Se toma la longitud desde la propiedad
            'start_time' => "",
            'travel_time' => "",
            'availability' => $visit->availability ?? null, // Este valor depende de cómo manejes la disponibilidad
            'duration_time' => $visit->duration_time,
            'customer_name' => $visit->customer->name ?? 'No customer', // El nombre del cliente asociado
            'address' => $visit->property->address ?? 'No address', // La dirección de la propiedad
            'property' => $visit->property, // La relación completa de la propiedad
            'exceeds_working_hours' => false // Supongo que tienes una lógica para este campo
        ];


        return $visitArray;
    }




    public function render()
    {
        return view(
            'livewire.panel.visit.organizer.show-organizer-preview',

            [
                'routeOrganizer' => $this->routeOrganizer, // Pasamos las rutas organizadas a la vista
                'selectedDate' => $this->selectedDate // Fecha seleccionada
            ]

        )->layout('layouts.panel', ['title' => 'Ruta organizada']);
    }
}
