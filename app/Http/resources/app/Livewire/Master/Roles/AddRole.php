<?php

namespace App\Livewire\Master\Roles;

use App\Models\Role;
use Livewire\Component;

class AddRole extends Component
{

    public $name;
    public $description;

    public function rules()
    {
        return [
            'name' => 'required|string|max:120',
            'description' => 'nullable|string',
        ];
    }

    public function save($typeSave)
    {


        $this->validate();

        $role = Role::create([
            'name' => $this->name,
            'description' => $this->description,
            'created_by' => auth()->id(),
            'business_id' => null,
        ]);



        if ($typeSave == 'save') {
            return redirect()->route('master.roles.edit', $role->id);
        }elseif ($typeSave == 'save-new') {
            return redirect()->route('master.roles.create');
        }else{
            return redirect()->route('master.roles.index');
        }

    }

    public function render()
    {
        return view('livewire.master.roles.add-role')
            ->layout('layouts.master');
    }
}
