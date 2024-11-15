<?php

namespace App\Livewire\Master\Features\Partials;

use App\Livewire\Master\Features\EditFeature;
use App\Models\Module;
use Livewire\Component;

class SelectModule extends Component
{

    public $modules = [];
    public $selectedModule;
    public $searchTerm = '';


    public function mount()
    {
        $this->modules = Module::all()->toArray(); // Convertimos la colección a un array


    }


    public function selectModule($moduleId)
    {
        if ($this->selectedModule && $moduleId == $this->selectedModule->id) {
            $this->reset('selectedModule');
        } else {

            $this->selectedModule = Module::findOrFail($moduleId);
            $this->dispatch('changeModule', moduleId: $this->selectedModule->id)->to(EditFeature::class);
        }
    }
    public function updatedSearchTerm()
    {
        if (strlen($this->searchTerm) > 1) {
            $this->modules = Module::where('name', 'like', '%' . $this->searchTerm . '%')->get()->toArray();
        } else {
            $this->modules = Module::all()->toArray(); // Reset modules to all if search term is too short
        }
    }
    public function render()
    {
        return view('livewire.master.features.partials.select-module');
    }
}
