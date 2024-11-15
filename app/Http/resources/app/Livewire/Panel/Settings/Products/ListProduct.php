<?php

namespace App\Livewire\Panel\Settings\Products;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use App\Helpers\Notifications;
use Illuminate\Support\Facades\Cache;

class ListProduct extends Component
{
    use WithPagination;

    public $warehousesCount;

    public function mount()
    {
        $this->authorize('access-function', 'stock-product-list');
        $this->warehousesCount = auth()->user()->business->warehouses->count();
    
    }

    public function deleteProduct($id)
    {
        $this->authorize('access-function', 'stock-product-soft');

        
        $product = Product::with('units')->find($id);

        if (!$product) {
            $this->dispatch('notification', ['type' => Notifications::icons('error'), 'message' => 'Producto no encontrado']);
            return;
        }

        if ($product->units->count() > 0) {
            $this->dispatch('notification', ['type' => Notifications::icons('warning'), 'message' => 'No se puede borrar el producto porque tiene unidades asociadas']);
        } else {
            $product->delete();
            $this->dispatch('notification', ['type' => Notifications::icons('info'), 'message' => 'Producto desactivado']);
        }
    }

    public function render()
    {
        $products =  Product::select('id', 'name', 'description', 'slug', 'type', 'created_at')
                ->where('business_id', auth()->user()->business->id)
                ->orderBy('id', 'desc')
                ->paginate(10);
      

        return view('livewire.panel.settings.products.list-product', [
            'products' => $products,
        ])->layout('layouts.panel', [
            'title' => 'Productos',
        ]);
    }
}