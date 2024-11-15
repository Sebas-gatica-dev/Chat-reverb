<?php

namespace App\Livewire\Panel\Routes\Partials;

use App\Models\User;
use App\Models\Visit;
use Livewire\Component;
use Livewire\WithPagination;
use App\Traits\AutomaticRouteTrait;
use Livewire\Attributes\On;

class AssignedVisits extends Component
{



    use WithPagination, AutomaticRouteTrait;

    public $year;
    public $month;
    public $day;
    public $perPage = 10;

    public $visitsToReorganizer;
    public $newRoute = [];
    public $travelTimeCache = [];
    public $openNewRoute = false;
    public $selectedVisitIndex = null;
    public $typeView;


    #[On('updateTypeView')]
    public function updateTypeView($view)
    {
        $this->typeView = $view;
    }



    #[On('showRouteMap')]
    public function showRouteMap($visitsId)
    {
        $visits = Visit::whereIn('id', $visitsId)
        ->with(['property:id,latitude,longitude'])   
        ->select('id', 'property_id')
        ->orderBy('time', 'asc')
        ->get();

        $this->dispatch('openNewTab', url: 'https://www.google.com/maps/dir/' . $visits->map(function ($visit) {
            return $visit->property->latitude . ',' . $visit->property->longitude;
        })->join('/'));

    }


    #[On('reOrganizerVisits')]
    public function reOrganizerVisits($visits, $worker, $date){
        
        $this->selectedVisitIndex = null;

        $this->visitsToReorganizer = Visit::whereIn('id', $visits)
        ->with(['property:id,latitude,longitude,address', 'avaliabilities', 'property.availabilities', 'users'])
        ->select('id', 'date', 'duration_time', 'property_id', 'time')
        ->get()
        ->map(function ($visit) {
            return [
                'id' => $visit->id,
                'date' => $visit->date,
                'start_time' => $visit->time,
                'latitude' => $visit->property->latitude,
                'longitude' => $visit->property->longitude,
                'address' => $visit->property->address,
                'duration_time' => $visit->duration_time,
                'availability' => !is_null($visit->avaliabilities) && $visit->avaliabilities->isNotEmpty()
                    ? $visit->avaliabilities
                    : (!is_null($visit->property->avaliabilities) && $visit->property->avaliabilities->isNotEmpty()
                        ? $visit->property->avaliabilities
                        : null),
                'user' => $visit->users->first(),
                'travel_time' => 0,
            ];
        });

        $dayFinished = false;

        $worker = User::find($worker);



        while (!$dayFinished || $this->visitsToReorganizer->isEmpty()) {

            if ($dayFinished || $this->visitsToReorganizer->isEmpty()) {
                break; // Salir del bucle si cualquiera de las condiciones se cumple
            }

            if ($this->checkSpaceForOtherWork($worker->availabilities, $date, $this->newRoute)) {

                $lastPoint = end($this->newRoute); // Obtener el último punto de la ruta, si existe

                // si no hay visitas en la ruta, el punto de origen es la casa del empleado
                $originLat = $lastPoint['latitude'] ?? $worker->start_lat;
                $originLng = $lastPoint['longitude'] ?? $worker->start_lng;

                // Calcular el tiempo de viaje para todas las visitas
                $this->visitsToReorganizer = $this->visitsToReorganizer->map(function ($visit) use ($originLat, $originLng) {

                    $visit['travel_time'] = $this->getTravelTime(
                        $originLat,
                        $originLng,
                        $visit['latitude'],
                        $visit['longitude']
                    );
                    return $visit;
                });

                // Ordenar las visitas filtradas por tiempo de viaje actualizado
                $this->visitsToReorganizer = $this->visitsToReorganizer->sortBy('travel_time')->values();
                // dump($this->filteredVisits, $originLat, $originLng, $this->newRoute);


                // Verificar si hay disponibilidad para la visita o la propiedad
                $availabilityVisit = $this->checkAvailabilityOfVisitOrProperty(
                    $this->visitsToReorganizer,
                    $date,
                    $this->newRoute,
                    $worker->availabilities
                );

                // Si hay disponibilidad, asignar la visita a la ruta
                if ($availabilityVisit) {
                    // agregarle end time, que seria la suma de la hora de inicio + el tiempo de la visita
                    $this->assignVisit($this->newRoute, $availabilityVisit, $worker->availabilities, $date, true);
                    // Eliminar la visita asignada a newRoute del array de filteredVisits
                    $this->visitsToReorganizer = $this->visitsToReorganizer->filter(function ($v) use ($availabilityVisit) {
                        return $v['id'] != $availabilityVisit['id'];
                    });
                }
            } else {
                // Si no hay espacio para más visitas, finalizar la jornada
                $dayFinished = true;
            }
        }


        if ($this->visitsToReorganizer->isNotEmpty()) {

            foreach ($this->visitsToReorganizer as $visit) {


                $availabilityVisit = $this->checkAvailabilityOfVisitOrProperty(
                    $this->visitsToReorganizer,
                    $date,
                );

                if ($availabilityVisit) {
                    $this->assignOutVisit($visit, $worker, $date);
                }
            }
        }

        $this->openNewRoute = true;
        $this->dispatch('refresh');

      
    }


    public function markAsOut($visitIndex)
    {
        // Verificar que el índice existe en el array y el índice de la visita también es válido
        if (isset($this->newRoute[$visitIndex])) {
            // Alternar el valor de 'out' entre true y false
            $this->newRoute[$visitIndex]['out'] =
                !$this->newRoute[$visitIndex]['out'];
        }

        $this->dispatch('markOut', $visitIndex);
        // Puedes emitir eventos u otras acciones aquí si es necesario
    }

    public function organized(){

     
        foreach ($this->newRoute as $visitOrganized) {
            $visit = Visit::find($visitOrganized['id']);

            
            if(!isset($visitOrganized['out']) || (isset($visitOrganized['out']) && $visitOrganized['out'] == false)){
                $visit->time = $visitOrganized['start_time'];
            }else{
                $visit->time = null;
                $visit->date = null;

                $visit->users()->detach();
            }
            $visit->save();
        }

        $this->openNewRoute = false;

    }

    public function selectVisit($index){
        

        if($this->selectedVisitIndex === $index){
            $this->selectedVisitIndex = null;
        }else{
        $this->selectedVisitIndex = $index;
        }
        $this->dispatch('selectVisit', $index);
    }

    public function render()
    {
     
        $assignedVisitsPaginated = Visit::where('business_id', auth()->user()->business_id)
            ->whereYear('date', $this->year)
            ->whereMonth('date', $this->month)
            ->whereDay('date', $this->day)
            ->whereHas('users')
            ->with([
                'users', 
                'property' => function ($query) {
                    $query->select('id', 'property_name');
                },
                'comments',

                'property' => function ($query) {
                    $query->select('id', 'address',
                    'latitude', 'longitude', 'property_name'
                
                );
                },

                'budget',

                'visitType' => function ($query) {
                    $query->select('id', 'name');
                },

                'customer' => function ($query) {
                    $query->select('id', 'name', 'email');
                },
                'customer.phones'=> function ($query) {
                    $query->select('id', 'number');
                },
                
                ])
            ->orderBy('time', 'asc')
            ->get();

        $assignedVisits = [];
        foreach ($assignedVisitsPaginated as $visit) {
            foreach ($visit->users as $user) {
                $assignedVisits[$user->id]['user'] = $user;
                $assignedVisits[$user->id]['visits'][] = $visit;
            }
        }

        return view('livewire.panel.routes.partials.assigned-visits', [
            'assignedVisits' => $assignedVisits,
            'assignedVisitsPaginated' => $assignedVisitsPaginated
        ]);
    }
}
