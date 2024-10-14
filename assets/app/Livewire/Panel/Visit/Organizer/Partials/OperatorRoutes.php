<?php

namespace App\Livewire\Panel\Visit\Organizer\Partials;

use App\Helpers\Notifications;
use App\Models\TravelTime;
use App\Models\User;
use App\Models\Visit;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Livewire\Attributes\On;
use Livewire\Component;
use Illuminate\Support\Str;

class OperatorRoutes extends Component
{
    public $operatorId;
    public $operatorData;
    public $selectedDate;
    public $eliminationHistoryByOperario;
    public $availableDates = [];
    public $availableOperators = [];
    public $showMoveModal = false;
    public $moveToDate;
    public $moveToOperator;
    public $selectedVisitId;
    public $currentDate;
    public $currentOperatorId;
    public $unsaved = false;
    public $routeOrganizer;
    public $selectedOperator;
    public $componenteId;

    public $mapId;

    public  $selectedPoint;

    public $markVisitOnMap;





    public function mount()
    {
        $this->initialMap();
    }






    public function updateMap($mapId = null, $selectedOperatorId = null, $visitsUpdate = null, $nameOperator = null, $date = null, $colorScheme = 'LIGHT')
    {
       
        $this->mapId = $mapId;

        $routes = [
            [
                'date' => $date,
                'operator' => $selectedOperatorId,
                'operator_name' => $nameOperator,
                'points' => collect($visitsUpdate)->map(function ($visit) {
                    return [
                        'lat' => (float) $visit['latitud'],
                        'lng' => (float) $visit['longitude'],
                    ];
                })->toArray(),
        
            ]
        ];


        $this->dispatch('initMaps', ...$routes);
    }



    public function initialMap()
    {


        $routes = [
            [
                'date' => $this->selectedDate,
                'operator' => $this->operatorId,
                'operator_name' => $this->operatorData['name'],
                'points' => collect($this->operatorData['visits'])->map(function ($visit) {
                    return [
                        'lat' => (float) $visit['latitud'],
                        'lng' => (float) $visit['longitude'],
                    ];
                })->toArray(),
             
            ]
        ];


        $this->dispatch('initMaps', ...$routes);
    }



    #[On('visitPointClicked')]
    public function handleMarkVisitOnMap($point, $operator)
    {
        // dump($point, $operator);

        if ($this->selectedPoint === $point && $this->selectedOperator === $operator) {
            $this->selectedPoint = null;
            $this->selectedOperator = null;
            return;
        }

        $this->selectedPoint = $point;
        $this->selectedOperator = $operator;
    }


    public function selectVisitFromList($index, $operator, $date, $lat, $lng)
    {

        $mapId = 'map-' . $date . '-' . $operator;


        $this->dispatch('markVisitOnMap', index: $index, operator: $operator, date: $date, mapId: $mapId, lat: $lat, lng: $lng);
    }

    //Fin de metodos del mapa de Google Maps

    //Acciones sobre las visitas de los operarios
    public function deleteVisit($visitId, $operatorId, $date)
    {
        // Acceder a las visitas del operario en la fecha seleccionada
        $visits = $this->operatorData['visits'];

        // Encontrar el índice de la visita a eliminar
        $index = array_search($visitId, array_column($visits, 'id'));

        if ($index !== false) {
            // Guardar la hora de inicio de la visita que se está eliminando (si es necesario)
            $deletedVisitHoraInicio = $visits[$index]['start_time'];

            // Guardar la visita eliminada en el historial de eliminación
            $this->eliminationHistoryByOperario[$operatorId][$date][] = [
                'index' => $index,
                'visit' => $visits[$index]
            ];

            //  dd($this->eliminationHistoryByOperario);

            // Eliminar la visita del array
            array_splice($visits, $index, 1);

            // Actualizar el array de visitas en la estructura principal
            $this->dispatch('updateTimes', [
                'date' => $date,
                'operatorId' => $operatorId,
                'visits' => $visits
            ]);


            // Actualizar la lista de visitas del operario
            $this->operatorData['visits'] = $visits;


            // Eliminar la visita de las no organizadas
            $this->dispatch(
                'updateUnCoordination',
                id: $visitId,
                operarioId: $operatorId,
                date: $date
            );

            // Recalcular los tiempos desde el índice de eliminación
            if (count($visits) > 0) {
                if ($index > 0) {
                    // Obtener la hora de inicio de la visita anterior
                    $hourInitialFirstVisit = $visits[$index - 1]['start_time'];
                    $this->recalculateTimesPostDeleteVisit($operatorId, $date, $hourInitialFirstVisit, $index);
                } elseif ($index === 0) {
                    // Para la primera visita, el inicio es la jornada laboral del operario
                    $this->recalculateTimesPostDeleteVisit($operatorId, $date, null, $index);
                }
            }

            // Actualizar el mapa para reflejar los cambios
            $this->updateMap(null, $operatorId, $this->operatorData['visits'], $this->operatorData['name'], $date);
            // $this->updateMap(null, $operatorId, $this->operatorData['visits'], $this->operatorData['name'], $date);
        }

        // Restablecer el punto seleccionado y marcar los cambios como no guardados
        $this->selectedPoint = null;
        $this->selectedOperator = null;
        $this->dispatch('updateUnSaved', true);
    }


    #[On('updateHistoryDeleteVisit')]
    public function updateHistoryDeleteVisit($operatorId, $visitId, $date)
    {
        // dd($operatorId, $visitId, $date);
        if ($this->operatorId == $operatorId && $this->selectedDate == $date) {
            if (isset($this->eliminationHistoryByOperario[$operatorId][$date])) {
                $this->eliminationHistoryByOperario[$operatorId][$date] = array_filter(
                    $this->eliminationHistoryByOperario[$operatorId][$date],
                    function ($item) use ($visitId) {
                        return $item['visit']['id'] !== $visitId;
                    }
                );
            }
        }


    }


    public function undoDeletion($operatorId, $date)
    {
        // Verificar si hay algo en el historial para este operario
        if (empty($this->eliminationHistoryByOperario[$operatorId][$date])) {
            return;
        }


        // Obtener el último estado de eliminación desde el historial del operario
        $lastElimination = array_pop($this->eliminationHistoryByOperario[$operatorId][$date]);

        // Recuperar la visita eliminada y restaurarla en la posición anterior
        $visits = $this->operatorData['visits'];
        $index = $lastElimination['index'];
        $visit = $lastElimination['visit'];

        // Restaurar la visita eliminada en la posición anterior
        $visits = array_merge(
            array_slice($visits, 0, $index),
            [$visit],
            array_slice($visits, $index)
        );


        // Actualizar la lista de visitas del operario en la estructura principal
        $this->dispatch('updateUndoVisit', [
            'date' => $date,
            'operatorId' => $operatorId,
            'visits' => $visits
        ]);


        // Update the map to reflect changes
        $this->operatorData['visits'] = $visits;





        // Eliminar la visita de las no organizadas
        $this->dispatch('updateUndoUnCoordination', id: $visit['id']);


        // Reorganizar desde la visita restaurada
        $this->recalculateTimesPostSortVisit($operatorId, $date, $visits[$index]['start_time'], $index);

        // Reiniciar el punto seleccionado y marcar cambios no guardados
        $this->selectedPoint = null;
        $this->dispatch('updateUnSaved', true);

        // Actualizar el mapa de Google Maps
        // $this->updateMap(null, $operatorId, $this->operatorData['visits'], $this->operatorData['name'], $date);
    }

    //Fin de acciones sobre las visitas de los operarios


    //Inicio de acciones del modal de mover visitas
    public function openMoveModal($visitId, $operatorId, $date)
    {
        $this->selectedVisitId = $visitId;
        $this->currentOperatorId = $operatorId;
        $this->currentDate = $date;

        $propertyVisit = null;




        foreach ($this->operatorData['visits'] as $visit) {
            if ($visit['id'] === $visitId) {
                $propertyVisit = $visit['property'];
                break;
            }
        }


        // Filtrar operarios que trabajan en la zona de la propiedad
        $this->availableOperators = User::all()
            ->filter(function ($employee) use ($propertyVisit) {
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
        $this->moveToDate =  null;
        $this->moveToOperator =  null;

        $this->showMoveModal = true;
    }

    public function closeMoveModal()
    {
        $this->showMoveModal = false;
        $this->selectedPoint = null;
        $this->selectedOperator = null;
        $this->reset([
            'moveToDate',
            'moveToOperator',
            'selectedVisitId',
            'currentDate',
            'currentOperatorId'
        ]);
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
        // if ($this->moveToDate === $this->currentDate && $this->moveToOperator === $this->currentOperatorId) {

        //     session()->flash('notification', [
        //         'message' => 'La visita ya está en la fecha y operario seleccionados.',
        //         'type' => Notifications::icons('warning')
        //     ]);

        //     return;
        // }



        if (is_null($this->checkAvailabilityWorkerFromRoutes($this->moveToOperator, $this->moveToDate))) {

            session()->flash('status',  'El operario no tiene horario laboral asignado para la fecha seleccionada');
            return;
        }

        // Buscar y remover la visita de la ubicación actual




        $this->dispatch('updateMoveVisit', [
            'currentDate' => $this->currentDate,
            'currentOperatorId' => $this->currentOperatorId,
            'selectedVisitId' => $this->selectedVisitId,
            'moveToDate' => $this->moveToDate,
            'moveToOperator' => $this->moveToOperator
        ]);




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


    #[On('updateVisitsInChild')]
    public function updateVisitsPostCloseModal($visitsUpdate, $operatorId, $date)
    {



        // Asegurarse de que este componente es el correspondiente al operador y fecha
        if ($this->operatorId === $operatorId && $this->selectedDate === $date) {


            //Eliminar la visita con visitId de $this->operadorData['visits']

            $this->operatorData['visits'] = $visitsUpdate;

            //   dd($this->operatorData['visits']);
            $this->updateMap(null, $operatorId, $this->operatorData['visits'], $this->operatorData['name'], $date);
        }
    }



    public function sortVisits($visitId, $newPosition, $operatorId, $date)
    {
        // dd($visitId, $newPosition, $operatorId, $date, $this->routesForOperario);


        // Obtener las visitas actuales para el operario en la fecha seleccionada
        $visits = $this->operatorData['visits'];

        //dd($visits);
        $hourInitialFirstVisit = $newPosition === 0
            ? $visits[0]['start_time'] // La hora de inicio de la primera visita
            : null;

        //  dd($hourInitialFirstVisit);
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
        // $this->routeOrganizer[$date]['workers'][$operatorId]['visits'] = $visits;

        $this->operatorData['visits'] = $visits;

        // Emitir evento para actualizar el mapa y la vista en el frontend






        // Recalcular los tiempos desde la nueva posición
        $this->recalculateTimesPostSortVisit($operatorId, $date, $hourInitialFirstVisit, $newPosition);

        // Verificar si alguna visita excede el horario laboral del operario
        if ($this->verifyWorkingSchedule($operatorId, $date)) {

            $this->dispatch('updateExceedsWorkingHours', [
                'date' => $date,
                'operatorId' => $operatorId,
                'visits' => $this->operatorData['visits']
            ]);
        }




        // // Restablecer el punto seleccionado y marcar los cambios como no guardados
        $this->selectedPoint = null;

        $this->dispatch('updateUnSaved', true);
        // $this->unsaved = true;

        // // Actualizar el mapa
        // $this->updateMap(null, $operatorId);


    }



    public function recalculateTimesPostDeleteVisit($operatorId, $date, $hourInitialFirstVisit = null, $startIndex = 0)
    {
        // Obtener todas las visitas del operario en la fecha seleccionada
        $visits = $this->operatorData['visits'];

        // Si no hay visitas o el índice está fuera de rango, no hay nada que recalcular
        if (empty($visits) || !isset($visits[$startIndex])) {
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
            $previousLat = $previousVisit['latitud'];
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
                    $visit['latitud'],
                    $visit['longitude']
                );

                // El tiempo de inicio de la visita actual es el tiempo de fin de la visita anterior más el travel_time
                $visit['start_time'] = date('H:i:s', strtotime($previousEndTime) + $visit['travel_time'] * 60);
            }

            // El tiempo de fin es el tiempo de inicio más la duración de la visita
            $visit['end_time'] = date('H:i:s', strtotime($visit['start_time']) + $visit['duration_time'] * 60);

            // Actualizar la referencia para la siguiente iteración
            $previousEndTime = $visit['end_time'];
            $previousLat = $visit['latitud'];
            $previousLng = $visit['longitude'];
        }

        // Guardar las visitas actualizadas en la estructura principal
        $this->operatorData['visits'] = $visits;
    }




    public function recalculateTimesPostSortVisit($operatorId, $date, $hourInitialFirstVisit = null, $startIndex = 0)
    {

        // Obtener todas las visitas del operario en la fecha seleccionada
        $visits = $this->operatorData['visits'];


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

        unset($visit); // Liberar la referencia








        $this->dispatch('updateTimes', [
            'date' => $date,
            'operatorId' => $operatorId,
            'visits' => $visits
        ]);

        //dd($visits);

        $this->operatorData['visits'] = $visits;

        //reindexar el array


        // Emitir evento para actualizar el mapa
        // $this->updateMap(null, $operatorId);

        // dd($this->operatorData['visits']);
        $this->updateMap(null, $operatorId, $this->operatorData['visits'], $this->operatorData['name'], $date);
    }



    //Verificaciones de horario laboral

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
        foreach ($this->operatorData['visits'] as &$visit) {
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


    //CALCULO DE DISTANCIA ENTRE DOS PUNTOS

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

    //FIN DE CALCULO DE DISTANCIA ENTRE DOS PUNTOS




    // public function arrangeVisitsPostMove($visits, $operatorId, $date)
    // {
    //     // Actualizar la estructura de rutas con las nuevas visitas
    //     $this->routeOrganizer[$date]['workers'][$operatorId]['visits'] = $visits;

    //     // Recalcular los tiempos y actualizar el mapa
    //     $this->recalculateTimes($operatorId, $date);

    //     // Marcar los cambios como no guardados
    //     $this->unsaved = true;

    //     // Actualizar el mapa
    //     $this->updateMap();
    // }
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

    // #[On('updateVisitHistory')]
    // public function removeVisitFromHistory($operatorId)
    // {
    //     dd($this->eliminationHistoryByOperario[$operatorId]);
    //     // Eliminar la visita del historial de eliminaciones
    //     $this->eliminationHistoryByOperario[$operatorId] = array_filter(
    //         $this->eliminationHistoryByOperario[$operatorId],
    //         function ($elimination) use ($visitId) {
    //             return $elimination['visit']['id'] !== $visitId;
    //         }
    //     );
    // }

    // Eliminar la visita de las no organizadas
    // dd('eliminado');




    public function checkAvailabilityWorkerFromRoutes($workerId, $date)
    {

        // Obtener el operario para acceder a su origen y horario laboral
        $worker = User::find($workerId);

        // Obtener la hora de inicio de la jornada laboral del operario en el día específico
        $dayOfWeek = strtoupper(Carbon::parse($date)->format('l'));

        $startWorkTime = $worker->availabilities->where('day.name', $dayOfWeek)->first()->start ?? null;

        return $startWorkTime;
    }


    public function travelTimeTotal()
    {
        $travelTotal = array_sum(array_column($this->operatorData['visits'], 'travel_time'));

        $travelTotal = $this->convertMinutesToHours($travelTotal, 'total_travel_time');

        return ($travelTotal);
    }


    public function totalTravelAndWorkTime()
    {
        //dd($this->operatorData['visits']);
        // Cálculo del tiempo total de viaje + trabajo
        $totalTravelAndWorkTime = array_sum(array_column($this->operatorData['visits'], 'travel_time')) + array_sum(array_column($this->operatorData['visits'], 'duration_time'));
        //dd($totalTravelAndWorkTime);
        // dd(array_sum(array_column($this->operatorData['visits'], 'duration_time')));
        // dd( array_sum(array_column($this->operatorData['visits'], 'travel_time'))); 



        $totalTravelAndWorkTime = $this->convertMinutesToHours($totalTravelAndWorkTime, 'total_travel_work_time');

        return ($totalTravelAndWorkTime);
    }

    // Convertir minutos a horas y minutos
    function convertMinutesToHours($minutes, $type)
    {
        // $hours = ($minutes / 60);
        $hours = number_format($minutes / 60, 1);

        $remainingMinutes = $minutes % 60;

        if ($type === 'total_travel_time') {
            return "$hours horas, $remainingMinutes minutos de viaje";
        } elseif ($type === 'total_travel_work_time') {

            return "$hours horas, $remainingMinutes minutos de viaje y trabajo";
        }

        return "$hours:$remainingMinutes";
    }

    public function render()
    {
        return view('livewire.panel.visit.organizer.partials.operator-routes');
    }
}
