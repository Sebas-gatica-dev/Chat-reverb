<?php

namespace App\Livewire\Panel\Settings\Products;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use App\Helpers\Notifications;



class ListProduct extends Component
{
    use WithPagination;

public function mount()
    {
        $this->authorize('access-function', 'stock-product-list');
    }

    //Ponerlo en softdelete
    public function deleteProduct($id)
    {
        $this->authorize('access-function', 'stock-product-soft');
        $product = Product::find($id);
        if($product->units->count() > 0){
            $this->dispatch('notification', ['type' => Notifications::icons('warning'), 'message' => 'No se puede borrar el producto porque tiene unidades asociadas']);
           
        }else{
            $product->delete(); 
            $this->dispatch('notification', ['type' => Notifications::icons('info'), 'message' => 'Producto desactivado']);
        }

    }


    public function render()
    {

        return view('livewire.panel.settings.products.list-product',[
            'products' => Product::where('business_id', auth()->user()->business->id)->orderBy('id','desc')->paginate(10),
        ])->layout('layouts.panel',[
            'title' => 'Productos',
        ]);
    }
}
