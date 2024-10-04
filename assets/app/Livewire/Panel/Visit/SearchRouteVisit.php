<?php

namespace App\Livewire\Panel\Visit;

use App\Helpers\Notifications;
use App\Models\Availability;
use App\Models\TravelTime;
use App\Models\User;
use App\Models\Visit;
use Carbon\Carbon;
use DateInterval;
use DatePeriod;
use Illuminate\Container\Attributes\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log as FacadesLog;
use Livewire\Component;
use Illuminate\Support\Str;


class SearchRouteVisit extends Component
{

    public $property;
    public $employees;
    public $selectedRoute;
    public $availabilityProperty = [];
    public $visits;
    public $allVisits;
    public $filteredVisits;
    public $travelTimeCache = [];
    public $googleMapsApiKey;
    public $aproximateVisit;
    public $newRoute;
    public $routesOrganized = [];
    public $currentVisitIndex = 0;

    public function mount()
    {

        $this->googleMapsApiKey = 'AIzaSyD3K3dBES7-pn0gkICbQyiQgfNHhlUU3W4'; //lucsnchz@gmail.com Protegel Filtros

        $this->employees = User::with([
            'availabilities',
            'visits' => function ($query) {
                $query->where('date', '>=', Carbon::now()->startOfDay())
                    ->where('date', '<=', Carbon::now()->addDays(7)->endOfDay())
                    ->select('id', 'date'); // Traer solo las fechas de las visitas y los campos necesarios
            }
        ])->get()
            ->filter(function ($employee) {
                return $employee->worksInZone($this->property);
            })
            ->map(function ($employee) {
                return [
                    'id' => $employee->id,
                    'name' => $employee->name,
                    'latitude' => $employee->start_lat,
                    'longitude' => $employee->start_lng,
                    'availabilities' => $employee->availabilities,
                    'visits' => $employee->visits->pluck('date'), // Solo la fecha de las visitas
                ];
            });




        $visitsQuery = Visit::whereHas('users', function ($query) {
            $query->whereIn('id', $this->employees->pluck('id'));
        })
            ->where('date', '>=', Carbon::now()->startOfDay())
            ->where('date', '<=', Carbon::now()->addDays(7)->endOfDay())
            ->with(['property:id,latitude,longitude', 'users:id,name', 'avaliabilities', 'property.availabilities'])
            ->select('visits.id', 'visits.date', 'visits.property_id', 'visits.duration_time');

        $this->allVisits = collect();


        $visitsQuery->chunk(100, function ($visits) {
            foreach ($visits as $visit) {
                $this->allVisits->push([
                    'id' => $visit->id,
                    'date' => $visit->date,
                    'latitude' => $visit->property->latitude,
                    'longitude' => $visit->property->longitude,
                    'duration_time' => $visit->duration_time,
                    'availability' => $visit->avaliabilities->isNotEmpty() ? $visit->avaliabilities : null,
                    'property_availability' => $visit->property->avaliabilities ? $visit->property->avaliabilities : null,
                    'user' => $visit->users->first()
                ]);
            }
        });



        $period = new DatePeriod(Carbon::now()->startOfDay(), new DateInterval('P1D'), Carbon::now()->addDays(7)->endOfDay());

        foreach ($period as $currentDate) {
            $formattedDate = $currentDate->format('Y-m-d');
            $dayOfWeek = strtoupper($currentDate->format('l'));

            $availableEmployees = $this->employees
                ->filter(function ($employee) use ($dayOfWeek) {
                    // Filtrar empleados según disponibilidad en el día de la semana
                    $isAvailable = collect($employee['availabilities'])->contains(function ($availability) use ($dayOfWeek) {
                        return $availability->day->name === $dayOfWeek;
                    });

                    // Solo incluir empleados disponibles
                    return $isAvailable;
                })
                ->pluck('id')
                ->values()
                ->toArray();



            foreach ($availableEmployees as $employeeId) {
                $employee = $this->employees->firstWhere('id', $employeeId);

                // Verificar si el empleado tiene visitas en ese día
                $hasVisits = $employee['visits']->contains(function ($visit) use ($formattedDate) {
                    return $visit === $formattedDate; // Verifica si alguna de las fechas es igual a la fecha actual
                });

                if (!$hasVisits) {

                    $this->allVisits->push([
                        'id' => 'HOME_' . $employeeId . '_' . $formattedDate,
                        'date' => $formattedDate,
                        'latitude' => $employee['latitude'],
                        'longitude' => $employee['longitude'],
                        'duration_time' => 0,
                        'availability' => $employee['availabilities'],
                        'property_availability' => null,
                        'user' => $employee
                    ]);
                }
            }
        }



        //resetear values de allVisits
        $this->allVisits = $this->allVisits->values();





        // Calcular el tiempo de viaje para todas las visitas
        $this->allVisits = $this->allVisits->map(function ($visit) {
            $visit['travel_time'] = $this->getTravelTime(
                $this->property->latitude,
                $this->property->longitude,
                $visit['latitude'],
                $visit['longitude']
            );
            return $visit;
        });







        // Ordenar todas las visitas por tiempo de viaje de menor a mayor
        $this->allVisits = $this->allVisits->sortBy([
            ['travel_time', 'asc'],
            ['date', 'asc']
        ])->values();



        $this->aproximateVisit = $this->allVisits->first();


        // dump('inicio de rutas');
        $this->processVisit();

// dump($this->routesOrganized);
   
    }



    public function initMap()
    {

        $routes = $this->routesOrganized[0]['route'];


        $this->dispatch('initMap', $routes);
    }
    private function assignOutVisit($visit, $worker = null)
    {
        $this->newRoute[] = $visit;

        $lastIndex = count($this->newRoute) - 1;


        if ($lastIndex > 0 && isset($this->newRoute[$lastIndex - 1]['end_time'])) {


            $visit['travel_time'] = $this->getTravelTime(
                $this->newRoute[$lastIndex]['latitude'],
                $this->newRoute[$lastIndex]['longitude'],
                $visit['latitude'],
                $visit['longitude']
            );

            $endTime = Carbon::createFromFormat('H:i:s', $this->newRoute[$lastIndex - 1]['end_time']);
            if (Str::startsWith($this->newRoute[$lastIndex - 1]['id'], 'HOME')) {
                $startTime = $endTime->copy();
            } else {
                $startTime = $endTime->copy()->addMinutes($visit['travel_time']);
            }
        } else {
            $startTimeString = $this->getStartTime($worker->availabilities, strtoupper(Carbon::parse($this->aproximateVisit['date'])->format('l')), $visit);
            if ($startTimeString == null) {
                return; // Operario no tiene disponibilidad
            }
            $startTime = Carbon::createFromFormat('H:i:s', $startTimeString);
        }





        // Redondear la hora de inicio a los 5 minutos más cercanos
        $startTime = $startTime->minute(ceil($startTime->minute / 5) * 5)->second(0);
        $this->newRoute[$lastIndex]['time'] = $startTime->format('H:i:s');

        // Calcular y redondear la hora de fin usando 'horaInicio' y 'duration_time'
        $endTime = $startTime->copy()->addMinutes($visit['duration_time']);
        $endTime = $endTime->minute(ceil($endTime->minute / 5) * 5)->second(0);
        $this->newRoute[$lastIndex]['end_time'] = $endTime->format('H:i:s');

        $this->newRoute[$lastIndex]['out'] = true;
    }

    private function assignVisit($worker, $visit)
    {
        $this->newRoute[] = $visit;



        $lastIndex = count($this->newRoute) - 1;

        if ($lastIndex > 0 && isset($this->newRoute[$lastIndex - 1]['end_time'])) {
            $endTime = Carbon::createFromFormat('H:i:s', $this->newRoute[$lastIndex - 1]['end_time']);
            if (Str::startsWith($this->newRoute[$lastIndex - 1]['id'], 'HOME')) {
                $startTime = $endTime->copy();
            } else {
                $startTime = $endTime->copy()->addMinutes($visit['travel_time']);
            }
        } else {


            $startTimeString = $this->getStartTime($worker->availabilities, strtoupper(Carbon::parse($this->aproximateVisit['date'])->format('l')), $visit);
            if ($startTimeString == null) {
                return; // Operario no tiene disponibilidad
            }
            $startTime = Carbon::createFromFormat('H:i:s', $startTimeString);
        }

        // Redondear la hora de inicio a los 5 minutos más cercanos
        $startTime = $startTime->minute(ceil($startTime->minute / 5) * 5)->second(0);
        $this->newRoute[$lastIndex]['time'] = $startTime->format('H:i:s');

        // Calcular y redondear la hora de fin usando 'horaInicio' y 'duration_time'
        $endTime = $startTime->copy()->addMinutes($visit['duration_time']);
        $endTime = $endTime->minute(ceil($endTime->minute / 5) * 5)->second(0);
        $this->newRoute[$lastIndex]['end_time'] = $endTime->format('H:i:s');
        // $this->newRoute[$lastIndex]['out'] = false; 
    }

    private function checkAvailabilityOfVisitOrProperty($visits, $dayOfWeek, $worker = null)
    {
        foreach ($visits as $visit) {
            $visitAvailability = $visit['availability'];
            $propertyAvailability = $visit['property_availability'];

            // Si no hay restricciones de disponibilidad para la visita ni para la propiedad, la visita es válida
            if ($visitAvailability == null && $propertyAvailability == null) {
                return $visit;
            }

            // Priorizar la disponibilidad de la visita
            $dayAvailability = $this->getDayAvailability($visitAvailability, $dayOfWeek);

            // Si no hay disponibilidad de visita, usar la disponibilidad de la propiedad
            if ($dayAvailability == null) {
                $dayAvailability = $this->getDayAvailability($propertyAvailability, $dayOfWeek);
            }

            // Si no hay disponibilidad para este día, pasar a la siguiente visita
            if ($dayAvailability == null) {
                continue;
            }

            if ($worker) {

                $lastIndex = count($this->newRoute) - 1;

                // Si hay al menos una visita en la ruta y tiene un 'end_time' definido
                if ($lastIndex >= 0 && isset($this->newRoute[$lastIndex]['end_time'])) {
                    $endTime = Carbon::createFromFormat('H:i:s', $this->newRoute[$lastIndex]['end_time']);
                    $startTime = $endTime->copy()->addMinutes($visit['travel_time']);


                    // Verificar si la visita puede realizarse dentro del horario disponible
                    if ($startTime->gte($dayAvailability['start']) && $startTime->addMinutes($visit['duration_time'])->lte($dayAvailability['end'])) {
                        $visit['time'] = $startTime->format('H:i:s');
                        return $visit;
                    }
                } else {
                    $startTimeString = $this->getStartTime($worker->availabilities, $dayOfWeek);

                    if ($startTimeString == null) {
                        continue; // El operario no tiene disponibilidad, pasar a la siguiente visita
                    }

                    $startTime = Carbon::createFromFormat('H:i:s', $startTimeString);
                    $startTime = $startTime->minute(ceil($startTime->minute / 5) * 5)->second(0);

                    // Verificar si la visita puede realizarse dentro del horario disponible

                    //si la visita empieza sus primeras 4 letras  con HOME osea su casa (no es una visita)
                    // if (Str::startsWith($visit['id'], 'HOME')) {
                    //     dd($startTime);
                    //     if ($startTime->gte($dayAvailability['start']) && $startTime->addMinutes($visit['duration_time'])->lte($dayAvailability['end'])) {
                    //         $visit['time'] = $startTime->format('H:i:s');
                    //         return $visit;
                    //     }
                    // }else{
                    if ($startTime->gte($dayAvailability['start']) && $startTime->addMinutes($visit['duration_time'])->lte($dayAvailability['end'])) {
                        $visit['time'] = $startTime->format('H:i:s');
                        return $visit;
                    }
                    // }


                }
            }
        }

        // Si no se encontró ninguna visita disponible, retornar null
        return null;
    }

    private function getDayAvailability($availability, $dayOfWeek)
    {
        if ($availability == null) {
            return null;
        }

        $day = collect($availability)->firstWhere('day.name', $dayOfWeek);

        if ($day == null) {
            return null;
        }

        return [
            'start' => Carbon::createFromFormat('H:i:s', $day['start']),
            'end' => Carbon::createFromFormat('H:i:s', $day['end'])
        ];
    }

    public function handleClick($index, $date, $time, $worker)
    {


        // Actualizar 'selectedRoute'
        $this->selectedRoute = $index;

        // Despachar el evento 'select-visit'
        $this->dispatch('select-visit', date: $date, time: $time, worker: $worker);
    }


    private function getStartTime($availability, $dayOfWeek)
    {
        // Usar firstWhere para encontrar el día especificado

        $day = $availability->firstWhere('day.name', $dayOfWeek);

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

    private function checkSpaceForOtherWork($availability, $worker)
    {




        if (!$availability) {
            return false; // Si no se encuentra el día, retorna false
        }


        $endTime = Carbon::createFromFormat('H:i:s', $availability['end']);


        if (!empty($this->newRoute)) {
            $lastPoint = end($this->newRoute);


            $endTimeOfCurrentDay = Carbon::createFromFormat('H:i:s', $lastPoint['end_time']);


            foreach ($this->newRoute as $visit) {
                $endTimeWithVisit = $endTimeOfCurrentDay->copy()->addMinutes($visit['duration_time'] + $visit['travel_time']);
                if ($endTimeWithVisit < $endTime) {
                    return true; // Retorna true si al menos una visita cabe en el tiempo disponible
                }
            }

            return false; // Retorna false si ninguna visita cabe
        }

        return true; // Retorna true si no hay visitas programadas y por lo tanto hay espacio
    }


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


        // Intentar obtener el tiempo de viaje de la base de datos
        $travelTimeRecord = TravelTime::where(function ($query) use ($originLat, $originLng, $destinationLat, $destinationLng) {
            $query->where(function ($subquery) use ($originLat, $originLng, $destinationLat, $destinationLng) {
                $subquery->where('origin_latitude', $originLat)
                    ->where('origin_longitude', $originLng)
                    ->where('destination_latitude', $destinationLat)
                    ->where('destination_longitude', $destinationLng);
            })->orWhere(function ($subquery) use ($originLat, $originLng, $destinationLat, $destinationLng) {
                $subquery->where('origin_latitude', $destinationLat)
                    ->where('origin_longitude', $destinationLng)
                    ->where('destination_latitude', $originLat)
                    ->where('destination_longitude', $originLng);
            });
        })->first();



        if ($travelTimeRecord) {
            return $travelTimeRecord->travel_time_minutes;
        }


        $url = 'https://maps.googleapis.com/maps/api/distancematrix/json?units=metric'
            . '&origins=' . $originLat . ',' . $originLng
            . '&destinations=' . $destinationLat . ',' . $destinationLng
            . '&mode=' . $mode
            . '&key=' . $this->googleMapsApiKey;

        $response = Http::get($url);
        $data = $response->json();


        if ($data['status'] == 'OK' && $data['rows'][0]['elements'][0]['status'] == 'OK') {
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


    public function placeholder()
    {
        return <<<'HTML'
         <div class="col-span-12 bg-white shadow-sm ring-1 ring-gray-900/5 -mx-4 sm:mx-0 py-4 px-6 rounded-b-lg">
                        <div class="border border-purple-100 shadow-md rounded-md p-4 w-full mx-auto">
                            <div class="animate-pulse flex space-x-4">
                              <div class="rounded-full bg-purple-100 h-10 w-10"></div>
                              <div class="flex-1 space-y-6 py-1">
                                <div class="h-2 bg-purple-100 rounded"></div>
                                <div class="space-y-3">
                                  <div class="grid grid-cols-3 gap-4">
                                    <div class="h-2 bg-purple-100 rounded col-span-2"></div>
                                    <div class="h-2 bg-purple-100 rounded col-span-1"></div>
                                  </div>
                                  <div class="h-2 bg-purple-100 rounded"></div>
                                </div>
                              </div>
                            </div>
                          </div>
                    </div>
        HTML;
    }



    public function selectPreviusVisit()
    {
    
        if ($this->currentVisitIndex > 0) {
            $this->currentVisitIndex--;
            $this->dispatch('refresh');
        } else {
            $this->dispatch('notification', [
                'message' => 'No hay más visitas opciones para asignar',
                'type' => Notifications::icons('error')
            ]);
        }
    }

    public function searchOtherRoute(){

        if ($this->allVisits->has(0)) {

        
            
            $this->aproximateVisit = $this->allVisits[0];
            $this->processVisit();

       
            // $this->dispatch('refresh');
        } else {


            $this->dispatch('notification', [
                'message' => 'No hay más visitas opciones para asignar',
                'type' => Notifications::icons('error')
            ]);

            return;
        }

    }



    // public function selectNextVisit()
    // {
    
    //     if ($this->currentVisitIndex < count($this->routesOrganized)-1) {
    //         $this->currentVisitIndex++;
    //         $this->dispatch('refresh');
    //         return;

    //     }else{
    //         $this->searchOtherRoute();

    //         // dump('ruta', $this->routesOrganized, $this->allVisits, $this->filteredVisits); 

    //         $this->currentVisitIndex++;
    //         $this->dispatch('refresh');
    //     }

    // }
    public function selectNextVisit()
    {
        if ($this->currentVisitIndex < count($this->routesOrganized) - 1) {
            $this->currentVisitIndex++;
            $this->dispatch('refresh');
            return;
        } else {
            $previousCount = count($this->routesOrganized);
    
            $this->searchOtherRoute();
    
            $newCount = count($this->routesOrganized);
    
            if ($newCount > $previousCount) {
                // Apuntar al primer elemento de las nuevas visitas
                $this->currentVisitIndex = $previousCount;
                $this->dispatch('refresh');
                return;
            } else {
                // No hay más visitas
                $this->dispatch('notification', [
                    'message' => 'No hay más visitas opciones para asignar',
                    'type' => Notifications::icons('error')
                ]);
                return;
            }
        }
    }
    
    

    public function markAsOut($currentVisitIndex, $visitIndex)
    {
        // Verificar que el índice existe en el array y el índice de la visita también es válido
        if (isset($this->routesOrganized[$currentVisitIndex]['route'][$visitIndex])) {  
            // Alternar el valor de 'out' entre true y false
            $this->routesOrganized[$currentVisitIndex]['route'][$visitIndex]['out'] = 
                !$this->routesOrganized[$currentVisitIndex]['route'][$visitIndex]['out'];
        }
        // Puedes emitir eventos u otras acciones aquí si es necesario
    }
    
    
    
    



    private function processVisit()
    {


        // Filtrar las visitas que coinciden con la visita cercana, con el mejor empleado y la misma fecha
        $this->filteredVisits = $this->allVisits->filter(function ($visit) {

            return $visit['user']['id'] == $this->aproximateVisit['user']['id'] &&
                Carbon::parse($visit['date'])->isSameDay(Carbon::parse($this->aproximateVisit['date']));
        })->values();

       
    

        $actualVisit = [
            'id' => 'this',
            'date' => $this->aproximateVisit['date'],
            'time' => null,
            'latitude' => $this->property->latitude,
            'longitude' => $this->property->longitude,
            'travel_time' => null,
            'duration_time' => 45,
            'availability' => null,
            'property_availability' => $this->property->avaliabilities,
            'user' => $this->aproximateVisit['user']
        ];



        $this->filteredVisits->push($actualVisit);


        // jornada finalizada 

        $dayFinished = false;



        $userRoute = User::where('id', $this->aproximateVisit['user']['id'])->select('id', 'name', 'start_lat', 'start_lng')->with('availabilities')->first();

        $dayAvailability = $userRoute->availabilities->firstWhere('day.name', strtoupper(Carbon::parse($this->aproximateVisit['date'])->format('l')));

        $this->newRoute = [];

        while (!$dayFinished || $this->filteredVisits->isEmpty()) {


            if ($dayFinished || $this->filteredVisits->isEmpty()) {
                break; // Salir del bucle si cualquiera de las condiciones se cumple
            }



            if ($this->checkSpaceForOtherWork($dayAvailability, $userRoute)) {

                $lastPoint = end($this->newRoute); // Obtener el último punto de la ruta, si existe

                // si no hay visitas en la ruta, el punto de origen es la casa del empleado
                $originLat = $lastPoint['latitude'] ?? $userRoute->start_lat;
                $originLng = $lastPoint['longitude'] ?? $userRoute->start_lng;


                // Calcular el tiempo de viaje para todas las visitas
                $this->filteredVisits = $this->filteredVisits->map(function ($visit) use ($originLat, $originLng) {

                    $visit['travel_time'] = $this->getTravelTime(
                        $originLat,
                        $originLng,
                        $visit['latitude'],
                        $visit['longitude']
                    );
                    return $visit;
                });


                // Ordenar las visitas filtradas por tiempo de viaje actualizado
                $this->filteredVisits = $this->filteredVisits->sortBy('travel_time')->values();
                // dump($this->filteredVisits, $originLat, $originLng, $this->newRoute);

                // Verificar si hay disponibilidad para la visita o la propiedad
                $availabilityVisit = $this->checkAvailabilityOfVisitOrProperty(
                    $this->filteredVisits,
                    strtoupper(Carbon::parse($this->aproximateVisit['date'])->format('l')),
                    $userRoute
                );

                // Si hay disponibilidad, asignar la visita a la ruta
                if ($availabilityVisit) {
                    // agregarle end time, que seria la suma de la hora de inicio + el tiempo de la visita
                    $this->assignVisit($userRoute, $availabilityVisit);

                    // Eliminar la visita asignada a newRoute del array de filteredVisits
                    $this->filteredVisits = $this->filteredVisits->filter(function ($v) use ($availabilityVisit) {
                        return $v['id'] != $availabilityVisit['id'];
                    });
                }
            } else {
                // Si no hay espacio para más visitas, finalizar la jornada
                $dayFinished = true;
            }
        }


        // Ordenar las visitas filtradas por tiempo de viaje actualizado
        $this->filteredVisits = $this->filteredVisits->sortBy('travel_time')->values();



        //agregar la visita de id que es un array con un id this a la variable

        $visitaThis = collect($this->newRoute)->firstWhere('id', 'this');


        if (!$visitaThis) {
       

            // eliminar las visitas que ya se encuentran en la ruta de allVisits solo si la encuentra en el array de filteredVisits y newRoute
            $this->allVisits = $this->allVisits->reject(function ($visit) {
                return collect($this->newRoute)->contains('id', $visit['id']) ||
                       collect($this->filteredVisits)->contains('id', $visit['id']);
            });
            
            //reacer los values de all visits
            $this->allVisits = $this->allVisits->values();

         
            $this->searchOtherRoute();
            return;
        }

        if ($this->filteredVisits->isNotEmpty()) {


            foreach ($this->filteredVisits as $visit) {

                $availabilityVisit = $this->checkAvailabilityOfVisitOrProperty(
                    $this->filteredVisits,
                    strtoupper(Carbon::parse($this->aproximateVisit['date'])->format('l'))
                );
                
                if ($availabilityVisit) {
                    $this->assignOutVisit($visit, $userRoute);
                }
            }
        }


        //agreg


        // eliminar las visitas que ya se encuentran en la ruta de allVisits solo si la encuentra en el array

        // $this->allVisits = $this->allVisits->filter(function ($visit) {
        //     return $visit['id'] !== $this->aproximateVisit['id'];
        // });

        
        $this->allVisits = $this->allVisits->reject(function ($visit) {
            return collect($this->newRoute)->contains('id', $visit['id']);
        });

        





        //reacer los values de all visits
        $this->allVisits = $this->allVisits->values();

        //eliminar los inicios de la casa
        $this->newRoute = collect($this->newRoute)->filter(function ($visit) {
            return !str_starts_with($visit['id'], 'HOME');
        })->values()->toArray();
        
        $this->routesOrganized[] = [
            'visit' => $visitaThis ?? null,
            'route' => $this->newRoute
        ];


        $this->dispatch('select-visit', date: $visitaThis['date'], time: $visitaThis['time'], worker: $visitaThis['user']['id']);


     
// dump($this->allVisits, $this->newRoute, $this->routesOrganized);
     


    }

    public function render()
    {
        return view('livewire.panel.visit.search-route-visit');
    }
}
