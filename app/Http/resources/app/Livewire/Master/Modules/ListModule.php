<?php

namespace App\Livewire\Master\Modules;

use App\Models\Module;
use Livewire\Component;

class ListModule extends Component
{

    public $modules;


    public function mount()
    {


        $this->modules = Module::all();

    }

    public function render()
    {
        return view('livewire.master.modules.list-module')
            ->layout('layouts.master');
    }
}
