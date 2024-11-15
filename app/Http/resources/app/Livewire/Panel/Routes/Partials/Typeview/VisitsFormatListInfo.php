<?php

namespace App\Livewire\Panel\Routes\Partials\Typeview;

use Livewire\Component;

class VisitsFormatListInfo extends Component
{
    public $visit;
    
    public function render()
    {
        return view('livewire.panel.routes.partials.typeview.visits-format-list-info');
    }
}
