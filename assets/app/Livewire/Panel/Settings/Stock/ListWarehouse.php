<?php

namespace App\Livewire\Panel\Settings\Stock;

use App\Models\Warehouse;
use Livewire\Component;
use Livewire\WithPagination;
use App\Helpers\Notifications;
use Livewire\WithoutUrlPagination;



class ListWarehouse extends Component
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
      
         if($warehouse->units->count() > 0){
 
             $this->dispatch('notification', ['type' => Notifications::icons('error'), 'message' => 'No se puede desactivar la sucursal porque tiene unidades de inventario asociadas.']);

         } else {
             $warehouse->delete(); //Mandar a softdelete
             $this->dispatch('notification', ['type' => Notifications::icons('success'), 'message' => 'Sucursal desactivada']);
         }
     }
 
    public function render()
    {
        return view('livewire.panel.settings.stock.list-warehouse',[

            'warehouses' => auth()->user()->business->warehouses()->with('createdBy')->orderBy('deleted_at', 'asc')->orderBy('name', 'asc')->paginate(15)
        ])
            ->layout('layouts.panel');
    }
}
