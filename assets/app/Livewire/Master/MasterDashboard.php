<?php

namespace App\Livewire\Master;

use Livewire\Component;

class MasterDashboard extends Component
{
    public $subroutes;

    public function mount()
    {
        $this->subroutes = [
            [
                'name' => 'Inicio',
                'url' => '#',

            ],
            [
                'name' => 'Item 1',
                'url' => '#',

            ],
            [
                'name' => 'Item 2',
                'url' => '#',

            ],
            [
                'name' => 'Item 3',
                'url' => '#',

            ],
        ];


    }
    public function render()
    {
        return view('livewire.master.master-dashboard')
            ->layout('layouts.master', ['subroutes' => $this->subroutes]);
    }
}
