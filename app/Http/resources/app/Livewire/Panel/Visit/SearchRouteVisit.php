<?php

namespace App\Livewire\Panel\Visit;

use App\Helpers\Notifications;
use App\Models\Availability;
use App\Models\TravelTime;
use App\Models\User;
use App\Models\Visit;
use App\Traits\AutomaticRouteTrait;
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
    use AutomaticRouteTrait;


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

        $this->employees = User::where('business_id', $this->property->business_id)
            ->with([
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
                    'availability' => !is_null($visit->avaliabilities) && $visit->avaliabilities->isNotEmpty()
                        ? $visit->avaliabilities
                        : (!is_null($visit->property->avaliabilities) && $visit->property->avaliabilities->isNotEmpty()
                            ? $visit->property->avaliabilities
                            : null),
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


        if ($this->allVisits->isNotEmpty()) {
            $this->aproximateVisit = $this->allVisits->first();
            $this->processVisit();
        } else {
            $this->dispatch('notification', [
                'message' => 'No hay ningun operario disponible para realizar la visita',
                'type' => Notifications::icons('error')
            ]);
        }
    }

    public function initMap()
    {
        $routes = $this->routesOrganized[0]['route'];
        $this->dispatch('initMap', $routes);
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
            'start' => Carbon::createFromFormat('H:i:s', $day['start_time']),
            'end' => Carbon::createFromFormat('H:i:s', $day['end_time'])
        ];
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

    public function searchOtherRoute()
    {

        if ($this->allVisits->has(0)) {

            $this->aproximateVisit = $this->allVisits[0];
            $this->processVisit();
        } else {


            $this->dispatch('notification', [
                'message' => 'No hay más visitas opciones para asignar',
                'type' => Notifications::icons('error')
            ]);

            return;
        }
    }


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
            'start_time' => null,
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

            if ($this->checkSpaceForOtherWork($userRoute->availabilities, $this->aproximateVisit['date'], $this->newRoute)) {

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
                    $this->aproximateVisit['date'],
                    $this->newRoute,
                    $userRoute['availabilities']
                );

                // Si hay disponibilidad, asignar la visita a la ruta
                if ($availabilityVisit) {
                    // agregarle end time, que seria la suma de la hora de inicio + el tiempo de la visita
                    $this->assignVisit($this->newRoute, $availabilityVisit, $userRoute->availabilities, $this->aproximateVisit['date'], true);
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

        if (!$visitaThis || ($this->allVisits->count() > 1 && $visitaThis['travel_time'] > $this->allVisits->get(1)['travel_time'])) {

            // eliminar las visitas que ya se encuentran en la ruta de allVisits solo si la encuentra en el array de filteredVisits y newRoute
            $this->allVisits = $this->allVisits->reject(function ($visit) {
                return collect($this->newRoute)->contains('id', $visit['id']) ||
                    collect($this->filteredVisits)->contains('id', $visit['id']);
            });

            //reacer los values de all visits
            $this->allVisits = $this->allVisits->sortBy([
                ['travel_time', 'asc'],
                ['date', 'asc']
            ])->values();
            $this->searchOtherRoute();
            return;
        }









        if ($this->filteredVisits->isNotEmpty()) {

            foreach ($this->filteredVisits as $visit) {


                $availabilityVisit = $this->checkAvailabilityOfVisitOrProperty(
                    $this->filteredVisits,
                    $this->aproximateVisit['date']
                );

                if ($availabilityVisit) {
                    $this->assignOutVisit($visit, $userRoute);
                }
            }
        }

        $this->allVisits = $this->allVisits->reject(function ($visit) {
            return collect($this->newRoute)->contains('id', $visit['id']);
        });

        //reacer los values de all visits
        $this->allVisits = $this->allVisits->sortBy([
            ['travel_time', 'asc'],
            ['date', 'asc']
        ])->values();


        //eliminar los inicios de la casa
        $this->newRoute = collect($this->newRoute)->filter(function ($visit) {
            return !str_starts_with($visit['id'], 'HOME');
        })->values()->toArray();

        $this->routesOrganized[] = [
            'visit' => $visitaThis ?? null,
            'route' => $this->newRoute
        ];

        $this->dispatch('select-visit', date: $visitaThis['date'], time: $visitaThis['start_time'], worker: $visitaThis['user']['id'], visits: $this->newRoute);
    }

    public function render()
    {
        return view('livewire.panel.visit.search-route-visit');
    }
}
