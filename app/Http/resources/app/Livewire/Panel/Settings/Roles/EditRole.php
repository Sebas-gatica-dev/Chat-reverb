<?php

namespace App\Livewire\Panel\Settings\Roles;

use App\Livewire\Panel\Settings\Roles\Partials\Modals\ConfirmModalNextModuleUnSaved;
use App\Livewire\Panel\Settings\Roles\Partials\MultiSelectedFeaturesRoles;
use App\Livewire\Panel\Settings\Roles\Partials\MultiSelectedUsers;
use App\Models\Role;
use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Component;
use App\Traits\ValidateNotificationTrait;

class EditRole extends Component
{

    use ValidateNotificationTrait;

    public ?Role $role;

    public $name;
    public $description;
    public $created_by;

    public $selectedUsers = [];
    public $users;



    public function mount()
    {
        $this->authorize('access-function', 'role-edit');
        $this->name = $this->role->name;
        $this->description = $this->role->description;


        $this->selectedUsers = $this->role->users()->get()->map(function ($role) {
            return [
                'id' => $role->id,
                'name' => $role->name,
            ];
        })->toArray();

        $this->users = auth()->user()->business->users()->get()->map(function ($user) {
            return [
                'id' => $user->id,
                'name' => $user->name,
            ];
        });
    }


    public function rules()
    {
        return [
            'name' => 'required|string|max:120',
            'description' => 'nullable|string|max:120',
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

    public function update()
    {
        $this->validate();

        $this->role->update([
            'name' => $this->name,
            'description' => $this->description,
            'created_by' => $this->created_by,
        ]);

        $this->role->users()->sync(array_column($this->selectedUsers, 'id'));

        $this->resetErrorBag();


        return $this->redirectRoute('panel.settings.roles.list');
    }


    


    #[On('update-selected-values-users')]
    public function updateSelectedUsers($value)
    {
        $this->selectedUsers = $value;
    }

    #[On('update-search-users')]
    public function searchUser($search)
    {

        $this->users = User::where('business_id', auth()->user()->business->id)->when($search, function ($query) use ($search) {
            $query->where('name', 'like', '%' . $search . '%');
        })->get()->map(function ($user) {
            return [
                'id' => $user->id,
                'name' => $user->name,
            ];
        });



        $this->dispatch('update-values-users', $this->users);
    }




    // #[On('changeUser')]
    // public function changeUser($value)
    // {
    //     $this->created_by = $value;
    // }

    // #[On('addUsersToRole')]
    // public function associateUsersToRol($values)
    // {


    //     $usersIds = array_column($values['users'], 'id');


    //     $this->role->users()->sync($usersIds);
    //     $this->dispatch('refresh-users-for-rol')->to(MultiSelectedUsers::class);


    // }

    #[On('updateFeaturesRole')]
    public function updateFeaturesRole($values)
    {

        $this->role->features()->sync($values);

        flushCacheBusinessFunctions(auth()->user()->business_id);

        $this->dispatch('refresh-features-for-rol')->to(MultiSelectedFeaturesRoles::class);
    }


    public function render()
    {
        return view('livewire.panel.settings.roles.edit-role')
            ->layout('layouts.panel', ['title' => 'Editar Rol']);
    }
}
