<?php

namespace App\Livewire\Panel\Settings\Users;

use App\Helpers\Notifications;
use App\Models\Customer;
use App\Models\Property;
use App\Models\User;
use App\Models\Visit;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class ListUsers extends Component
{
    use WithPagination, WithoutUrlPagination;



    public function mount()
    {
        $this->authorize('access-function', 'user-list');


    }


    public function deleteUser($id)
    {

        $this->authorize('access-function', 'user-soft');
       $user = User::find($id);
       


       if(!$user){
           $this->dispatch('notification', [
               'message' => 'Usuario inexistente',
               'type' => Notifications::icons('error')
           ]);
           return;

       }

        $user->delete();
    }

    public function restoreUser($id)
    {
        $this->authorize('access-function', 'user-restore');
        User::withTrashed()->find($id)->restore();
    }



    public function forceDeleteUser($id)
{
    $this->authorize('access-function', 'user-delete');
    $user = User::withTrashed()->find($id);

    $user_visits = $user->visits->count() > 0;
    $user_has_customers = Customer::where('created_by', $user->id)->exists();
    $user_has_properties = Property::where('created_by', $user->id)->exists();
    $user_has_visits = Visit::where('created_by', $user->id)->exists();

    if (!$user_visits && !$user_has_customers && !$user_has_properties && !$user_has_visits) {

        $originalPath = $user->getRawOriginal('photo');
        if ($originalPath && Storage::exists($originalPath)) {
            Storage::delete($originalPath);
        }

       
        $user->availabilities()->delete(); 
        $user->subzones()->delete(); 
        $user->neighborhoods()->delete(); 
        $user->cities()->delete(); 
        $user->provinces()->delete(); 

        $user->forceDelete();

        $this->dispatch('notification', [
            'message' => 'Usuario eliminado correctamente',
            'type' => Notifications::icons('success')
        ]);

    } else {
        // Notificación de error si el usuario tiene asignaciones
        $this->dispatch('notification', [
            'message' => 'No puedes eliminar este usuario porque tiene visitas, clientes o propiedades asignadas',
            'type' => Notifications::icons('error')       
        ]);
    }
}

    
    public function render()
    {

        // Obtener los usuarios paginados
        $users = User::withTrashed()->where('business_id', auth()->user()->business->id)->orderBy('deleted_at', 'asc')->orderBy('name', 'asc')->paginate(10);

        // Pasar los usuarios a la vista
        return view('livewire.panel.settings.users.list-users', compact('users'))
            ->layout('layouts.panel');
    }
}
