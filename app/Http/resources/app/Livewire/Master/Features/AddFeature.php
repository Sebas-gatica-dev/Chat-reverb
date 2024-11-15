<?php

namespace App\Livewire\Master\Features;

use App\Models\Feature;
use Livewire\Attributes\On;
use Livewire\Component;

class AddFeature extends Component
{

    public $name;
    public $description;
    public $status = 1;
    public $module;

    public $slug;

    public $newModule;

    public function mount($module)
    {
        $this->module = $module;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:120',
            'description' => 'required|string|max:1000',
            'slug' => 'required|string|max:255|unique:features|regex:/^[a-zA-Z0-9-]+$/u',
            'status' => 'required|boolean',
        ];
    }

    public function save()
    {
        $this->validate();

        Feature::create([
            'name' => $this->name,
            'description' => $this->description,
            'slug' => $this->slug,
            'module_id' => $this->module,
            // 'module_id' => $this->module ? $this->module->id : $this->newModule->id,

        ]);

        $this->redirectRoute('master.modules.edit', $this->module, true, true);
        $this->reset();

        // $this->emit('featureCreated');
    }


    // #[On('changeModule')]
    // public function changeUser($value)
    // {
    //     $this->newModule = $value;

    // }

    public function render()
    {
        return view('livewire.master.features.add-feature')
            ->layout('layouts.master');
    }
}
