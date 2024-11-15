<?php

namespace App\Livewire\Master\Features;

use App\Livewire\Master\Modules\ModuleList;
use App\Models\Feature;
use App\Models\Module;
use Livewire\Attributes\On;
use Livewire\Component;

class EditFeature extends Component
{

    public ?Feature $feature;
    public ?Module $module;

    public $name;
    public $description;

    public $slug;

    public $modules;

    public $newModule;






    public function mount()
    {

        $this->modules = Module::all(); // Cargar todos los módulos

        $this->name = $this->feature->name;
        $this->description = $this->feature->description;
        $this->slug = $this->feature->slug;


    }


    public function rules()
    {
        return [
            'name' => 'required|string|max:120',
            'description' => 'required|string|max:1000',
            'slug' => 'required|string|max:255|unique:features,slug,' . $this->feature->id . '|regex:/^[a-zA-Z0-9-]+$/u',
            'module' => 'required|exists:modules,id', // Agregar regla de validación para el módulo
        ];
    }

    public function update()
    {
        $this->validate();

        $this->feature->update([
            'name' => $this->name,
            'description' => $this->description,
            'slug' => $this->slug,
        ]);

        $this->redirectRoute('master.modules.edit', $this->module, true, true);
    }
    #[On('changeModule')]
    public function changeModule($moduleId)
    {
        $this->newModule = Module::findOrFail($moduleId);
    }

    public function updateModule()
    {
        if ($this->newModule) {
            $this->feature->update(['module_id' => $this->newModule->id]);
        }

        $this->redirectRoute('master.modules.edit', $this->module, true, true);
    }
    public function render()
    {


        return view('livewire.master.features.edit-feature')
            ->layout('layouts.master');
    }
}
