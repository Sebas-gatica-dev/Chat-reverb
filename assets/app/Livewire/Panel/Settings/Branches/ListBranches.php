<?php

namespace App\Livewire\Panel\Settings\Branches;

use App\Helpers\Notifications;
use App\Models\Branch;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class ListBranches extends Component
{
    use WithPagination, WithoutUrlPagination;


   public function mount()
    {
        $this->authorize('access-function', 'branch-list');
    }



    //Ponerlo en softdelete
    public function deleteBranch($id)
    {
        $this->authorize('access-function', 'branch-soft');
        $branch = Branch::find($id);
        $branch_has_users = $branch->users->count() > 0;
        $branch_has_bank_accounts = $branch->bankAccounts->count() > 0;

        // dd($branch_has_bank_accounts);



        if ($branch && $branch_has_users) {
            $this->dispatch('notification', ['type' => Notifications::icons('error'), 'message' => 'No se puede desactivar la sucursal porque tiene usuarios asociadas']);
        }elseif($branch_has_bank_accounts){

            $this->dispatch('notification', ['type' => Notifications::icons('error'), 'message' => 'No se puede desactivar la sucursal porque tiene cuentas bancarias asociadas']);

        } else {
            $branch->delete(); //Mandar a softdelete
            $this->dispatch('notification', ['type' => Notifications::icons('success'), 'message' => 'Sucursal desactivada']);
        }
    }

    //Restaurar sucursal
    public function restoreBranch($id)
    {
        $this->authorize('access-function','branch-restore');
        $branch = Branch::withTrashed()->find($id); //Buscar en softdelete
        if ($branch->trashed()) { //Verificar si esta en softdelete
            $branch->restore(); //Restaurar
            $this->dispatch('notification', ['type' => Notifications::icons('success'), 'message' => 'Sucursal restaurada']);
        }
    }


    //Eliminar sucursal definitivamente
    public function forceDeleteBranch($id)
    {
        $this->authorize('access-function', 'branch-delete');
        $branch = Branch::withTrashed()->find($id); //Buscar en softdelete

        if ($branch && $branch->users->count() > 0) {
            $this->dispatch('notification', ['type' => Notifications::icons('error'), 'message' => 'No se puede eliminar sucursal porque tiene visitas asociadas']);
        } else {
            $branch->forceDelete(); //Eliminar definitivamente
            $this->dispatch('notification', ['type' => Notifications::icons('success'), 'message' => 'Sucursal eliminada']);
        };
    }


    public function render()
    {
        return view('livewire.panel.settings.branches.list-branches', [

            'branches' => auth()->user()->business->branches()->withTrashed()->with('createdBy')->orderBy('deleted_at', 'asc')->orderBy('name', 'asc')->paginate(15)
        ])
            ->layout('layouts.panel', ['title' => 'Lista de sucursales']);
    }
}
