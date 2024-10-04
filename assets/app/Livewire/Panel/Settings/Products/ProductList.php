<?php

namespace App\Livewire\Panel\Settings\Products;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use App\Helpers\Notifications;



class ProductList extends Component
{
    use WithPagination, WithoutUrlPagination;


public function mount()
    {
        $this->authorize('access-function', 'stock-product-list');
    }
    //Ponerlo en softdelete
    public function deleteProduct($id)
    {
        $this->authorize('access-function', 'stock-product-soft');
        $product = Product::find($id);
        $product->delete(); 
        $this->dispatch('notification', ['type' => Notifications::icons('success'), 'message' => 'Sucursal desactivada']);
    }

    //Restaurar sucursal
    public function restoreProduct($id)
    {
        $this->authorize('access-function','stock-product-restore');
        $product = Product::withTrashed()->find($id); //Buscar en softdelete
        if ($product->trashed()) { //Verificar si esta en softdelete
            $product->restore(); //Restaurar
            $this->dispatch('notification', ['type' => Notifications::icons('success'), 'message' => 'Sucursal restaurada']);
        }
    }


    //Eliminar sucursal definitivamente
    public function forceDeleteProduct($id)
    {
        $this->authorize('access-function', 'stock-product-delete');
        $product = Product::withTrashed()->find($id); //Buscar en softdelete
        $product->forceDelete(); //Eliminar definitivamente
        $this->dispatch('notification', ['type' => Notifications::icons('success'), 'message' => 'Sucursal eliminada']);
    }







    public function render()
    {

        return view('livewire.panel.settings.products.product-list',[
            'products' => Product::where('business_id', auth()->user()->business->id)->orderBy('id','desc')->paginate(10),
        ])->layout('layouts.panel',[
            'title' => 'Productos',
        ]);
    }
}
