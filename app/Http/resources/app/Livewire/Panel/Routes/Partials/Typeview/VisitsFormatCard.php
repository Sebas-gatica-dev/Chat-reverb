<?php

namespace App\Livewire\Panel\Routes\Partials\Typeview;

use Livewire\Component;

class VisitsFormatCard extends Component
{
    public $visits;



    
    public function dispatchToParentShowRouteMap($visitsId){
        $this->dispatch('showRouteMap', visitsId: $visitsId);
    }



    public function render()
    {
    
        return view('livewire.panel.routes.partials.typeview.visits-format-card')
        ->layout('layouts.panel');
    }
}
