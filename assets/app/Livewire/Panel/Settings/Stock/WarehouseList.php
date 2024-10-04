<?php

namespace App\Livewire\Panel\Settings\Stock;

use App\Models\Warehouse;
use Livewire\Component;
use Livewire\WithPagination;
use App\Helpers\Notifications;
use Livewire\WithoutUrlPagination;



class WarehouseList extends Component
{

    use WithPagination, WithoutUrlPagination;


    public function mount()
     {
         $this->authorize('access-function', 'stock-warehouse-list');
     }
 
 
 
     //Ponerlo en softdelete
     public function deleteWarehouse($id)
     {
         $this->authorize('access-function', 'stock-warehouse-soft');
         $warehouse = Warehouse::find($id);
        //  $warehouse_has_users = $warehouse->users->count() > 0;
        // $warehouse_has_products = $warehouse->products->count() > 0;
 
        //  // dd($Warehouse_has_products);
 
 
 
        //  if ($warehouse && $warehouse_has_users) {
        //      $this->dispatch('notification', ['type' => Notifications::icons('error'), 'message' => 'No se puede desactivar la sucursal porque tiene usuarios asociadas']);
        //  }else
        //  if($warehouse_has_products){
 
        //      $this->dispatch('notification', ['type' => Notifications::icons('error'), 'message' => 'No se puede desactivar la sucursal porque tiene cuentas bancarias asociadas']);
 
        //  } else {
        //      $warehouse->delete(); //Mandar a softdelete
        //      $this->dispatch('notification', ['type' => Notifications::icons('success'), 'message' => 'Sucursal desactivada']);
        //  }



         $warehouse->delete(); //Mandar a softdelete
         $this->dispatch('notification', ['type' => Notifications::icons('success'), 'message' => 'Sucursal desactivada']);
     }
 
     //Restaurar sucursal
     public function restoreWarehouse($id)
     {
         $this->authorize('access-function','stock-warehouse-restore');
         $warehouse = Warehouse::withTrashed()->find($id); //Buscar en softdelete
         if ($warehouse->trashed()) { //Verificar si esta en softdelete
             $warehouse->restore(); //Restaurar
             $this->dispatch('notification', ['type' => Notifications::icons('success'), 'message' => 'Deposito restaurada']);
         }
     }
 
 
     //Eliminar sucursal definitivamente
     public function forceDeleteWarehouse($id)
     {
         $this->authorize('access-function', 'stock-warehouse-delete');
         $warehouse = Warehouse::withTrashed()->find($id); //Buscar en softdelete
 
         if ($warehouse && $warehouse->users->count() > 0) {
             $this->dispatch('notification', ['type' => Notifications::icons('error'), 'message' => 'No se puede eliminar el deposito porque tiene productos asociados']);
         } else {
             $warehouse->forceDelete(); //Eliminar definitivamente
             $this->dispatch('notification', ['type' => Notifications::icons('success'), 'message' => 'Deposito eliminada']);
         };
     }






    public function render()
    {
        return view('livewire.panel.settings.stock.warehouse-list',[

            'warehouses' => auth()->user()->business->warehouses()->withTrashed()->with('createdBy')->orderBy('deleted_at', 'asc')->orderBy('name', 'asc')->paginate(15)
        ])
            ->layout('layouts.panel');
    }
}
