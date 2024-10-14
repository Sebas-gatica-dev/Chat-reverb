<?php

namespace App\Livewire\Master\Modules;

use App\Models\Module;
use Livewire\Attributes\Validate;
use Livewire\Component;

class AddModule extends Component
{
    #[Validate('required|string|max:120')]
    public $name;

    #[Validate('required|string|max:255|unique:modules|regex:/^[a-zA-Z0-9-]+$/u')]
    public $slug;

    #[Validate('required|string|max:1000')]
    public $description;

    // #[Validate('required|boolean')]
    // public $status = null;



    public function save()
    {
        $this->validate();

      $module =  Module::create(
            $this->only(['name', 'slug', 'description'])
        );


        return redirect()->route('master.modules.edit' , $module->id);
    }




    public function render()
    {
        return view('livewire.master.modules.add-module')
            ->layout('layouts.master', ['title' => 'Create Module']);
    }
}
