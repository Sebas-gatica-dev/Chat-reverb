<?php

namespace App\Livewire\Panel\Settings\Stats;

use App\Models\Role;
use App\Models\Template;
use App\Models\User;
use App\Models\Widget;
use Livewire\Attributes\On;
use Livewire\Component;

class StatsEdit extends Component
{

    public $template;
    public $name;
    public $description;
    public $roles = [];
    public $selectedRoles = [];
    public $users = [];
    public $selectedUsers = [];
    public $searchUsers = '';
    public $searchRoles = '';
    public $dataWidget = [];



    // protected $listeners = ['refresh' => '$refresh'];

    public function mount()
    {


        $this->template = Template::where('id', $this->template)->firstOrFail();


        $this->name = $this->template->name;
        $this->description = $this->template->description;


        $this->roles = Role::where('business_id', auth()->user()->business_id)
            ->whereDoesntHave('templates')
            ->select('id', 'name')
            ->get()->map(function ($role) {
                return [
                    'id' => $role->id,
                    'name' => $role->name,
                ];
            });


        $this->users = User::where('business_id', auth()->user()->business_id)
            ->whereDoesntHave('templates')
            ->select('id', 'name')
            ->get()->map(function ($user) {
                return [
                    'id' => $user->id,
                    'name' => $user->name,
                    'image' => $user->photo,
                ];
            });



        $this->selectedRoles = $this->template->roles->map(function ($role) {
            return [
                'id' => $role->id,
                'name' => $role->name,
            ];
        })->toArray();




        $this->selectedUsers = $this->template->users->map(function ($user) {
            return [
                'id' => $user->id,
                'name' => $user->name,
                'image' => $user->photo,
            ];
        })->toArray();


        if($this->roles->isEmpty()){
            $this->roles = Role::where('business_id', auth()->user()->business_id)
            ->whereIn('id', array_column($this->selectedRoles, 'id'))
            ->select('id', 'name')
            ->get()->map(function ($role) {
                return [
                    'id' => $role->id,
                    'name' => $role->name,
                ];
            });
        }else{
            $this->roles = $this->roles->merge($this->selectedRoles);

        }

        if($this->users->isEmpty()){
            $this->users = User::where('business_id', auth()->user()->business_id)
            ->whereIn('id', array_column($this->selectedUsers, 'id'))
            ->select('id', 'name')
            ->get()->map(function ($user) {
                return [
                    'id' => $user->id,
                    'name' => $user->name,
                    'image' => $user->photo,
                ];
            });
        }else{
            $this->users = $this->users->merge($this->selectedUsers);
        }

    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:120',
            'description' => 'required|string|max:255',

        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El nombre de la estadística es obligatorio',
            'name.string' => 'El nombre de la estadística debe ser un texto',
            'name.max' => 'El nombre de la estadística no debe superar los 120 caracteres',
            'description.required' => 'La descripción de la estadística es obligatoria',
            'description.string' => 'La descripción de la estadística debe ser un texto',
            'description.max' => 'La descripción de la estadística no debe superar los 255 caracteres',
            'selectedRoles.required' => 'Debes seleccionar al menos un rol',
            'selectedUsers.required' => 'Debes seleccionar al menos un usuario'
        ];
    }


    #[On('update-selected-values-users')]
    public function updateSelectedUsers($value)
    {

        $this->selectedUsers = $value;
    }

    #[On('update-search-users')]
    public function searchUsers($search)
    {

        $this->searchUsers = $search;

        $this->users = User::where('business_id', auth()->user()->business_id)
            ->select('id', 'name')
            ->when($this->searchUsers, function ($query) {
                $query->where('name', 'like', '%' . $this->searchUsers . '%');
            })->get()->map(function ($user) {
                return [
                    'id' => $user->id,
                    'name' => $user->name,
                    'image' => $user->photo,
                ];
            });

        $this->dispatch('update-values-users', $this->users);
    }

    #[On('update-selected-values-roles')]
    public function updateSelectedRoles($value)
    {
        $this->selectedRoles = $value;

    }

    #[On('update-search-roles')]
    public function searchRoles($search)
    {

        $this->searchRoles = $search;

        $this->roles =  Role::where('business_id', auth()->user()->business_id)
            ->select('id', 'name')
            ->when($this->searchRoles, function ($query) {
                $query->where('name', 'like', '%' . $this->searchRoles . '%');
            })->get()->map(function ($role) {
                return [
                    'id' => $role->id,
                    'name' => $role->name,
                ];
            });

        $this->dispatch('update-values-roles', $this->roles);
    }


    public function edit()
    {
        $this->validate();

        $this->template->update([
            'name' => $this->name,
            'description' => $this->description
        ]);



            $this->template->roles()->sync(array_column($this->selectedRoles, 'id'));


    

            $this->template->users()->sync(array_column($this->selectedUsers, 'id'));

        

        session()->flash('success', 'Estadística editada correctamente');

        $this->redirectRoute('panel.settings.stats.list');
    }



    public function editWidget($widget)
    {

        $widget = Widget::where('id', $widget)->firstOrFail();

        $this->dispatch('fill-form-widget', $widget);
    }



    public function deleteWidget($widget)
    {
        $widget = Widget::where('id', $widget)->firstOrFail();
        $widget->delete();
    }
    public function render()
    {
        return view(
            'livewire.panel.settings.stats.stats-edit',
            [
                'widgets' => $this->template->widgets()->paginate(10),
            ]

        )->layout('layouts.panel');
    }
}
