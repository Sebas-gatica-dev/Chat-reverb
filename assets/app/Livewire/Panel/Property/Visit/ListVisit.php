<?php

namespace App\Livewire\Panel\Property\Visit;

use Livewire\Component;

class ListVisit extends Component
{

    public $visit;
    public $first;
    public $principalComment;


    public function mount($visit, $first)
    {
        $this->authorize('access-function', 'visit-list');
        $this->visit = $visit;
        $this->first = $first;

        $this->principalComment = $this->visit->comments->first();
    }


    public function render()
    {
        return view('livewire.panel.property.visit.list-visit');
    }
}
