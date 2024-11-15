<?php

namespace App\Livewire\Panel\Routes\Partials\Typeview;

use Livewire\Component;

class VisitsFormatList extends Component
{

    public $visits;
    public $year;
    public $month;
    public $day;
  
    public function mount()
    {   
       

    }


    public function dispatchToParentDateVisit($visits, $worker, $date){
        $this->dispatch('reOrganizerVisits', visits: $visits, worker: $worker, date: $date);
    }



    public function dispatchToParentShowRouteMap($visitsId){
        $this->dispatch('showRouteMap', visitsId: $visitsId);
    }

    public function render()
    {
  
        return view('livewire.panel.routes.partials.typeview.visits-format-list');
    }
}
