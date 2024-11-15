<?php

namespace App\Livewire\Panel\Settings\Roles;

use App\Helpers\Notifications;
use App\Models\Role;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class ListRoles extends Component
{
    use WithPagination, WithoutUrlPagination;

    public Role $editRole;


    public function mount()
        {
            $this->authorize('access-function', 'role-list');
        }




    public function deleteRole($id)
    {
        $this->authorize('access-function', 'role-soft');
        $role = Role::find($id);

        if ($role->users->count() > 0) {

            $this->dispatch('notification', [
                'message' => 'No puedes desactivar este rol porque tiene usuarios asignados',
                'type' => Notifications::icons('error')
            ]);

        } else {
            $role->delete();

            $this->dispatch('notification', [
                'message' => 'Rol eliminado correctamente',
                'type' => Notifications::icons('success')
            ]);
        }
      
    }

    public function restoreRole($id)
    {
        $this->authorize('access-function', 'role-restore');
        $role = Role::withTrashed()->find($id);
        
        if($role){

            $role->restore();

            $this->dispatch('notification', [
                'message' => 'Rol restaurado correctamente',
                'type' => Notifications::icons('success')
            ]);
        }

        
    }



    public function forceDeleteRole($id)
    {
        $this->authorize('access-function', 'role-delete');
        $this->editRole = Role::withTrashed()->find($id);

        if ($this->editRole->users->count() > 0) {

            $this->dispatch('notification', [
                'message' => 'No puedes eliminar este rol porque tiene usuarios asignados',
                'type' => Notifications::icons('error')
            ]);


        } else {
            $this->editRole->forceDelete();
        }
    }

    public function render()
    {
        return view(
            'livewire.panel.settings.roles.list-roles',
            [
                'roles' => Role::withTrashed()->where('business_id', auth()->user()->business->id)->orderBy('deleted_at', 'asc')->orderBy('name', 'asc')->paginate(10)
            ]
        )
            ->layout('layouts.panel');
    }
}
