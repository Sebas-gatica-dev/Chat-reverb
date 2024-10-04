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

class ShowOrganizerPreview extends Component
{
    public $routeId; // ID de la ruta
    public $routeOrganizer = []; // Estructura de las rutas
    public $selectedDate = null; // Fecha seleccionada
    public $uncoordinatedVisits = [];
    public $selectedPoint;
    public $unsaved = false;
    public $selectedOperator;
    public $eliminationHistoryByOperario = []; // Historial de eliminaciones por operario


    // Propiedades para manejar el modal de mover visitas
    public $showMoveModal = false;
    public $moveToDate;
    public $moveToOperator;
    public $selectedVisitId;
    public $currentDate;
    public $currentOperatorId;
    public $availableDates = [];
    public $availableOperators = [];


    public $routeOrganizerCopy = [];










    // Para inicializar el componente con la ruta específica
    public function mount($routeId)
    {

        $route = AutomaticRoute::findOrFail($routeId);

        $this->routeOrganizer = json_decode($route->modified_routes, true) ?: json_decode($route->routes, true);
        
        $this->routeOrganizerCopy =  json_decode($route->routes, true);
        // $this->organizedVisits = json_decode($route->selected_visits, true) ?? []; // Las visitas seleccionadas
        $this->uncoordinatedVisits = json_decode($route->uncoordinated_visits, true) ?? []; // Visitas no organizadas


        // dd($this->routeOrganizer);

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

        $this->updateMap();
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
        $this->uncoordinatedVisits = Visit::whereIn('id', $this->uncoordinatedVisits)->with('property', 'customer')->get();
    }



    //Modal para mover visitas

    // Método para abrir el modal de mover visita
    public function openMoveModal($visitId, $operatorId, $date)
    {
        $this->selectedVisitId = $visitId;
        $this->currentOperatorId = $operatorId;
        $this->currentDate = $date;

        // Preparar listas de fechas y operadores
        $this->availableDates = array_keys($this->routeOrganizer);

       // Obtener la propiedad de la visita seleccionada
        $propertyVisit = null;
        
        foreach($this->routeOrganizer as $date => $dataDate){
            foreach($dataDate['workers'] as $operatorId => $operatorData){
                foreach($operatorData['visits'] as $visit){
                    if($visit['id'] === $visitId){
                        $propertyVisit = $visit['property'];
                    }
                }
            }
        }

        $this->availableOperators = User::all()
        ->filter(function ($employee) use($propertyVisit) {
            return $employee->worksInZone($propertyVisit);
        })
        ->map(function ($employee) {
            return [
                'id' => $employee->id,
                'name' => $employee->name,
            ];
        })->toArray();
        

        $this->availableOperators = array_column($this->availableOperators, 'name', 'id');



        // Establecer valores por defecto
        $this->moveToDate = $this->availableDates[0] ?? null;
        $this->moveToOperator = array_key_first($this->availableOperators) ?? null;

        $this->showMoveModal = true;
    }


    // Método para cerrar el modal
    public function closeMoveModal()
    {
        $this->showMoveModal = false;
        $this->reset(['moveToDate', 'moveToOperator', 'selectedVisitId', 'currentDate', 'currentOperatorId']);
    }



    public function moveVisit()
    {
        // Validaciones básicas
        if (!$this->selectedVisitId || !$this->moveToDate || !$this->moveToOperator) {


            session()->flash('notification', [
                'message' => 'Por favor, selecciona una fecha y un operario válidos.',
                'type' => Notifications::icons('error')
            ]);
            return;
        }

        // Evitar mover a la misma fecha y operario
        if ($this->moveToDate === $this->currentDate && $this->moveToOperator === $this->currentOperatorId) {

            session()->flash('notification', [
                'message' => 'La visita ya está en la fecha y operario seleccionados.',
                'type' => Notifications::icons('warning')
            ]);

            return;
        }

        // Buscar y remover la visita de la ubicación actual
        $visit = null;


        // dd($this->routeOrganizer[$this->currentDate]['workers'][$this->currentOperatorId]['visits']);
        if (isset($this->routeOrganizer[$this->currentDate]['workers'][$this->currentOperatorId]['visits'])) {
            foreach ($this->routeOrganizer[$this->currentDate]['workers'][$this->currentOperatorId]['visits'] as $key => $v) {
                // Validar que $v es un arreglo y contiene 'id'


                if ($v['id'] === $this->selectedVisitId) {
                    $visit = $v;

                    // dd($this->routeOrganizer[$this->currentDate]['workers'][$this->currentOperatorId]['visits'][$key]);

                    unset($this->routeOrganizer[$this->currentDate]['workers'][$this->currentOperatorId]['visits'][$key]);

                    // Reindexar el array para mantener índices consecutivos
                    $this->routeOrganizer[$this->currentDate]['workers'][$this->currentOperatorId]['visits'] = array_values($this->routeOrganizer[$this->currentDate]['workers'][$this->currentOperatorId]['visits']);


                    break;
                }
            }
        }


        foreach ($this->routeOrganizer as &$dataDate) {
            foreach ($dataDate['workers'] as &$operatorData) {
                foreach ($operatorData['visits'] as &$visitt) {
                   // dump($visitt['id']);
                }
            }
        }



        if (!$visit) {


            session()->flash('notification', [
                'message' => 'Visita no encontrada',
                'type' => Notifications::icons('error')
            ]);


            return;
        }


        // Verificar que la fecha y operario destino existan en routeOrganizer
        if (!isset($this->routeOrganizer[$this->moveToDate])) {
            $this->routeOrganizer[$this->moveToDate] = [
                'workers' => []
            ];
        }


        if (!isset($this->routeOrganizer[$this->moveToDate]['workers'][$this->moveToOperator])) {
            $this->routeOrganizer[$this->moveToDate]['workers'][$this->moveToOperator] = [
                'name' => User::find($this->moveToOperator)->name ?? 'Nombre no disponible',
                'visits' => []
            ];
        }

        //dd( $this->routeOrganizer[$this->moveToDate]['workers'][$this->moveToOperator]);


        // Agregar la visita a la nueva ubicación

        $this->routeOrganizer[$this->moveToDate]['workers'][$this->moveToOperator]['visits'][] = $visit;
  


        // Marcar cambios como no guardados
        $this->unsaved = true;


       $this->checkDateHasVisits();
        // Cerrar el modal
        $this->closeMoveModal();



        // Recalcular tiempos y actualizar el mapa
        // $this->recalculateTimes($this->moveToOperator, $this->moveToDate);
        //$this->updateMap();


        session()->flash('notification', [
            'message' => 'La visita ha sido movida exitosamente',
            'type' => Notifications::icons('success')
        ]);
    }









    //Final del modal para mover visita 


    public function selectVisitFromList($index, $operator)
    {
        // Despachar un evento a JavaScript para marcar el punto en el mapa
        $this->dispatch('markVisitOnMap', index: $index, operator: $operator);
    }


    public function updateMap()
    {
        $routes = collect($this->routeOrganizer)
            ->filter(function ($data, $date) {
                return $date === $this->selectedDate;
            })
            ->map(function ($data, $date) {
                // dd($data, $date);

                return collect($data['workers'])->map(function ($operatorData, $operatorId) use ($date) {
                    return [


                        'date' => $date,
                        'operator' => $operatorId,
                        'operator_name' => $operatorData['name'],
                        'points' => collect($operatorData['visits'])->map(function ($point) {
                            return [
                                'lat' => (float) $point['latitud'],
                                'lng' => (float) $point['longitude'],
                            ];
                        })->toArray(),
                    ];
                })->values()->toArray();
            })
            ->flatten(1)
            ->toArray();

        $this->dispatch('initMaps', ...$routes);
    }

    #[On('visitPointClicked')]
    public function selectVisit($point, $operator)
    {
        if ($this->selectedPoint === $point && $this->selectedOperator === $operator) {
            $this->selectedPoint = null;
            $this->selectedOperator = null;
            return;
        }

        $this->selectedPoint = $point;
        $this->selectedOperator = $operator;
    }

    // Método para cambiar la fecha seleccionada
    public function selectDate($date)
    {
        $this->selectedDate = $date;
        $this->updateMap();
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


        // $this->assignedVisitsToUsers();


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
        // return rand(100, 200);
    }



    private function calculateEstimatedTravelTime($originLat, $originLng, $destinationLat, $destinationLng)
    {
        // Implementar una estimación básica usando la fórmula de Haversine
        $radioTierra = 6371; // en km

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

        $distancia = $radioTierra * $c * 1000; // en metros

        // Supongamos una velocidad promedio de 40 km/h (11.11 m/s)
        $velocidad = 11.11; // en m/s
        $tiempoSegundos = $distancia / $velocidad;
        $tiempoMinutos = (int) round($tiempoSegundos / 60);

        return $tiempoMinutos;
    }







    public function assignedVisitsToUsers()
    {
        foreach ($this->routeOrganizer as $date => $data) {
            foreach ($data['workers'] as $operator => $visits) {
                if (isset($data['workers'][$operator])) {

                    $visitIds = collect($data['workers'][$operator])->pluck('id');

                    Visit::whereIn('id', $visitIds)->get()->each(function ($visit) use ($date, $operator, $data) {
                        $visitaData = collect($data['workers'][$operator])->firstWhere('id', $visit->id);

                        $visit->date = $date;
                        $visit->time = $visitaData['start_time'];
                        $visit->save();

                        $operarioModel = User::where('name', $operator)->first();
                        // Sincronizar el operario sin eliminar otras relaciones
                        $visit->users()->sync([$operarioModel->id]);
                    });
                }
            }
        }
    }





    public function sortVisits($visitId, $newPosition, $operatorId, $date)
    {
        // Obtener las visitas actuales para el operario en la fecha seleccionada
        $visits = $this->routeOrganizer[$date]['workers'][$operatorId]['visits'];

        $hourInitialFirstVisit = $newPosition === 0
            ? $visits[0]['start_time'] // La hora de inicio de la primera visita
            : null;

        // Buscar la visita que fue movida por su ID
        $movedVisit = collect($visits)->firstWhere('id', $visitId);

        // Si no se encuentra la visita, finalizar
        if (!$movedVisit) {
            return;
        }

        // Remover la visita de su posición actual
        $visits = collect($visits)->filter(function ($visit) use ($visitId) {
            return $visit['id'] !== $visitId;
        })->values()->toArray();

        // Insertar la visita en la nueva posición
        array_splice($visits, $newPosition, 0, [$movedVisit]);

        // Actualizar el array de visitas con el nuevo orden
        $this->routeOrganizer[$date]['workers'][$operatorId]['visits'] = $visits;

        // Recalcular los tiempos desde la nueva posición
        $this->recalculateTimes($operatorId, $date, $hourInitialFirstVisit, $newPosition);

        // Verificar si alguna visita excede el horario laboral del operario
        $this->verifyWorkingSchedule($operatorId, $date);

        // Restablecer el punto seleccionado y marcar los cambios como no guardados
        $this->selectedPoint = null;
        $this->unsaved = true;

        // Actualizar el mapa
        $this->updateMap();
    }




    public function recalculateTimes($operatorId, $date, $hourInitialFirstVisit = null, $startIndex = 0)
    {
        // Obtener todas las visitas del operario en la fecha seleccionada
        $visits = $this->routeOrganizer[$date]['workers'][$operatorId]['visits'];

        // Si la reorganización comienza desde la primera visita, no hay visita anterior
        $previousVisit = $startIndex === 0 ? null : $visits[$startIndex - 1];

        // Recorrer las visitas a partir del índice de inicio
        foreach ($visits as $index => &$visit) {
            if ($index < $startIndex) {
                continue; // Saltar las visitas anteriores al índice de inicio
            }

            if ($index === 0 && !$previousVisit) {
                // Caso especial para la primera visita
                // Tomar la hora inicial proporcionada o la hora de inicio existente si no se proporcionó una nueva
                $visit['start_time'] = $hourInitialFirstVisit ?? $visit['start_time'];

                // Obtener la ubicación del operario
                $operatorData = User::find($operatorId);

                if ($operatorData) {
                    // Calcular el tiempo de viaje desde la ubicación inicial del operario a la primera visita
                    $visit['travel_time'] = $this->getTravelTime(
                        $operatorData->start_lat,
                        $operatorData->start_lng,
                        $visit['latitud'],
                        $visit['longitude']
                    );
                }
            } else {
                // Para las visitas posteriores, el origen es la visita anterior
                $visit['travel_time'] = $this->getTravelTime(
                    $previousVisit['latitud'],
                    $previousVisit['longitude'],
                    $visit['latitud'],
                    $visit['longitude']
                );

                // La hora de inicio de la visita actual es la hora de fin de la visita anterior + travel_time
                $visit['start_time'] = date(
                    'H:i:s',
                    strtotime($previousVisit['end_time']) + $visit['travel_time'] * 60
                );
            }

            // La hora de fin es la hora de inicio + duración de la visita
            $visit['end_time'] = date(
                'H:i:s',
                strtotime($visit['start_time']) + $visit['duration_time'] * 60
            );

            // Actualiza la visita anterior para la próxima iteración
            $previousVisit = $visit;
        }

        // Actualiza la estructura de rutas con las nuevas horas
        $this->routeOrganizer[$date]['workers'][$operatorId]['visits'] = $visits;

        // Emitir evento para actualizar el mapa
        $this->updateMap();
    }

    public function verifyWorkingSchedule($operatorId, $date)
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
                'start' => $availability->start,
                'end' => $availability->end
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

    public function deleteVisit($visitId, $operatorId, $date)
    {
        // Access the visits array for the specified operator and date
        $visits = $this->routeOrganizer[$date]['workers'][$operatorId]['visits'];

        // Find the index of the visit to delete
        $index = array_search($visitId, array_column($visits, 'id'));

        if ($index !== false) {
            // Store the hora_inicio (start time) of the visit being deleted (if needed)
            $deletedVisitHoraInicio = $visits[$index]['start_time'];

            // Save the visit in the elimination history for the specific operator
            $this->eliminationHistoryByOperario[$operatorId][] = [
                'index' => $index,
                'visit' => $visits[$index]
            ];

            // Remove the visit from the visits array
            array_splice($visits, $index, 1);

            // Update the visits array in the main data structure
            $this->routeOrganizer[$date]['workers'][$operatorId]['visits'] = $visits;

            // Add the visit to the list of uncoordinated visits
            $this->uncoordinatedVisits[] = Visit::find($visitId);

            // Recalculate the times starting from the appropriate index
            if (count($visits) > 0) {
                if ($index > 0) {
                    // Get hora_inicio from the previous visit
                    $hourInitialFirstVisit = $visits[$index - 1]['start_time'];
                    $this->recalculateTimes($operatorId, $date, $hourInitialFirstVisit, $index);
                } elseif ($index === 0) {
                    // For the first visit, use null to let recalculateTimes handle the operator's start time
                    $this->recalculateTimes($operatorId, $date, null, $index);
                }
            }

            // Update the map to reflect changes
            $this->updateMap();
        }

        // Reset selected point and mark changes as unsaved
        $this->selectedPoint = null;
        $this->unsaved = true;
    }


    public function undoDeletion($operatorId, $date)
    {
        // Verificar si hay algo en el historial para este operario
        if (empty($this->eliminationHistoryByOperario[$operatorId])) {
            return;
        }

        // Obtener el último estado de eliminación desde el historial del operario
        $lastElimination = array_pop($this->eliminationHistoryByOperario[$operatorId]);

        // Recuperar la visita eliminada y restaurarla en la posición anterior
        $visits = $this->routeOrganizer[$date]['workers'][$operatorId]['visits'];
        $index = $lastElimination['index'];
        $visit = $lastElimination['visit'];

        // Restaurar la visita eliminada en la posición anterior
        $visits = array_merge(
            array_slice($visits, 0, $index),
            [$visit],
            array_slice($visits, $index)
        );

        // Actualizar la lista de visitas del operario en la estructura principal
        $this->routeOrganizer[$date]['workers'][$operatorId]['visits'] = $visits;

        // Eliminar la visita de las no organizadas
        $this->uncoordinatedVisits = $this->uncoordinatedVisits->filter(function ($uncoordinatedVisit) use ($visit) {
            return $uncoordinatedVisit->id !== $visit['id'];
        });

        // Reorganizar desde la visita restaurada
        $this->recalculateTimes($operatorId, $date, $visits[$index]['start_time'], $index);

        // Reiniciar el punto seleccionado y marcar cambios no guardados
        $this->selectedPoint = null;
        $this->unsaved = true;

        // Actualizar el mapa de Google Maps
        $this->updateMap();
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
