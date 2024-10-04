<?php

namespace App\Livewire\Panel\Settings\Roles;

use Livewire\Component;
use App\Models\Role;
use Livewire\Attributes\On;
use App\Traits\ValidateNotificationTrait;

class AddRole extends Component
{

    use ValidateNotificationTrait;

    public $name;
    public $description;
    public $on = false;


    public $roles;
    public $selectedRole;




    public function mount()
    {

        $this->authorize('access-function', 'role-add');
        $this->roles = Role::where('business_id', auth()->user()->business->id)->get()->map(function ($role) {
            return [
                'id' => $role->id,
                'name' => $role->name,
            ];
        });
    }



    public function rules()
    {
        return [
            'name' => 'required|string|max:120',
            'description' => 'nullable|string|max:120',
            'selectedRole' => 'nullable'

        ];
    }

    public function messages()
    {
        return [
           'name.required' => 'El rol debe tener un nombre',
           'name.string' => 'El nombre debe ser formato texto',
           'name.max' => 'El nombre debe tener un maximo de 120 caracteres',
           'description.string' => 'La descripción debe ser texto',
           'description.max' => 'La descripción no debe superar los 120 caracteres'

          
           
        ];
    }

    public function save($typeSave)
    {
        
        $this->validate();

        $role = Role::create([
            'name' => $this->name,
            'description' => $this->description,
            'created_by' => auth()->id(),
            'business_id' => auth()->user()->business->id
        ]);


        if ($this->on && $this->selectedRole) {
            $this->copyFeaturesOfRole($role);
        }

        if ($typeSave == 'save') {
            return redirect()->route('panel.settings.roles.edit', $role->id);
        } elseif ($typeSave == 'save-new') {
            return redirect()->route('panel.settings.roles.add');
        } else {
            return redirect()->route('panel.settings.roles.list');
        }
    }




    #[On('update-selected-value-roles')]
    public function updateSelectedRole($value)
    {


        $this->selectedRole = Role::findOrFail($value['id']);
    }

    #[On('update-search-roles')]
    public function searchRole($value)
    {

        $this->roles = Role::where('business_id', auth()->user()->business->id)->when($value, function ($query) use ($value) {
            $query->where('name', 'like', '%' . $value . '%');
        })->get()->map(function ($role) {
            return [
                'id' => $role->id,
                'name' => $role->name,
            ];
        });

        $this->dispatch('update-values-roles', $this->roles);
    }


    public function copyFeaturesOfRole($role)
    {
        //Copiar funciones al rol creado actual
        $copyFeatures = $role->features()->sync($this->selectedRole->features->pluck('id'));
    }

    public function render()
    {
        return view('livewire.panel.settings.roles.add-role')
            ->layout('layouts.panel', ['title' => 'Agregar Rol']);
    }
}
