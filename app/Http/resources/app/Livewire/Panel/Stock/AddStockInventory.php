<?php

namespace App\Livewire\Panel\Stock;

use App\Enums\ProductTypeEnum;
use App\Helpers\Notifications;
use App\Models\Product;
use App\Models\Unit;
use App\Models\UnitHistory;
use App\Models\Warehouse;
use Livewire\Attributes\On;
use Livewire\Component;
use App\Traits\ValidateNotificationTrait;
use App\Enums\Units\UnitsHistoryTypeEnum;
use App\Enums\Units\UnitsStatusEnum;

class AddStockInventory extends Component
{
    use ValidateNotificationTrait;

    public $products = [];
    public $selectedProduct;
    public $warehouses = [];
    public $selectedWarehouse;
    public $quantity;
    public $cost;
    public $profit;
    public $batch;
    public $tag;
    public $type;
    public $expirationDate;
    public $entryDate;
    public $weight;
    public $initial_quantity;
    public $search;


    public function mount()
    {

        $this->products = Product::where('business_id', auth()->user()->business->id)
            ->whereDoesntHave('units')
            ->get()
            ->toArray();


        $this->warehouses = Warehouse::where('business_id', auth()->user()->business->id)->get()
            ->map(function ($warehouse) {
                return [
                    'id' => $warehouse->id,
                    'name' => $warehouse->name,
                ];
            })->toArray();
            
        $this->entryDate = now()->format('Y-m-d');
    }

    public function updatedExpirationDate($value)
    {
        $this->expirationDate = $value;
    }

    protected function rules()
    {
        return [
            'quantity' => 'required|integer',
            'cost' => 'nullable|integer',
            'batch' => 'nullable|string|max:255',
            'profit' => 'nullable|integer',
            'selectedProduct.id' => 'required|exists:products,id',
            'selectedWarehouse' => 'required|exists:warehouses,id',
        ];
    }

    protected function messages()
    {
        return [
            'quantity.required' => 'La cantidad de unidades es obligatoria.',
            'quantity.integer' => 'La cantidad debe ser un número entero.',
            'cost.integer' => 'El costo debe ser un número entero.',
            'batch.string' => 'El lote debe ser texto.',
            'profit.integer' => 'El margen de ganancia debe ser un número entero.',
            'selectedProduct.id.required' => 'El producto es obligatorio.',
            'selectedWarehouse.required' => 'Seleccionar un deposito es obligatorio.',
        ];
    }

    public function save()
    {

        $this->validate();

        

        for ($i = 0; $i < $this->quantity; $i++) {


            $unit = Unit::create([
                'product_id' => $this->selectedProduct['id'],
                'warehouse_id' => $this->selectedWarehouse,
                'cost' => $this->cost,
                'profit_margin' => $this->profit,
                'batch' => $this->batch,
                'tag' => uniqid(),
                'type' => $this->selectedProduct['type'],
                'expiration_date' => $this->expirationDate,
                'entry_date' => $this->entryDate,
                'initial_quantity' => $this->selectedProduct['measure'],
                'current_quantity' => $this->selectedProduct['measure'],
                'created_by' => auth()->user()->id,
                'status' => UnitsStatusEnum::NEW->value,
            ]);

       

            UnitHistory::create([
                'unit_id' => $unit->id,
                'type' => UnitsHistoryTypeEnum::Alta->value,
                'destinationable_id' => $this->selectedWarehouse,
                'destinationable_type' => 'App\Models\Warehouse',
                'created_by' => auth()->user()->id,
                'initial_quantity' => $this->selectedProduct['measure'],
                'current_quantity' => $this->selectedProduct['measure']
            ]);
        }

        $unit->product->update([
            'quantity' => $unit->product->quantity + $this->quantity,
        ]);

        // Mostrar mensaje de éxito
        session()->flash('notification', [
            'message' => 'Producto agregado al inventario exitosamente.',
            'type' => Notifications::icons('success')
        ]);


        // Resetear los campos del formulario
        $this->reset([
            'selectedProduct',
            'selectedWarehouse',
            'quantity',
            'cost',
            'profit',
            'batch',
            'tag',
            'type',
            'expirationDate',
            'entryDate',
            'weight',
            'initial_quantity'
        ]);

        return $this->redirectRoute('panel.stock.list', true, true);
    }

    #[On('update-selected-value-products')]
    public function updateSelectedProduct($value)
    {

        $this->selectedProduct = $value;
        if ($value) {
            $this->cost = $value['cost'];
            $this->profit = $value['profit'];
        } else {
            $this->cost = '';
            $this->profit = '';
        }
    }

    #[On('update-search-products')]
    public function searchProducts($search)
    {
        $searchProducts = $search;

        $this->products = auth()->user()->business->branches()
            ->when($searchProducts, function ($query) use ($searchProducts) {
                $query->where('name', 'like', '%' . $searchProducts . '%');
            })->get()->map(function ($product) {
                return [
                    'id' => $product->id,
                    'name' => $product->name,
                ];
            });

        $this->dispatch('update-values-products', $this->products);
    }

    #[On('update-selected-value-warehouses')]
    public function updateSelectedWarehouse($value)
    {
        $this->selectedWarehouse = $value;
    }

    #[On('update-search-warehouses')]
    public function searchWarehouses($search)
    {
        $searchWarehouses = $search;

        $this->warehouses = auth()->user()->business->warehouses()
            ->when($searchWarehouses, function ($query) use ($searchWarehouses) {
                $query->where('name', 'like', '%' . $searchWarehouses . '%');
            })->get()->map(function ($warehouse) {
                return [
                    'id' => $warehouse->id,
                    'name' => $warehouse->name,
                ];
            });

        $this->dispatch('update-values-warehouses', $this->warehouses);
    }

    public function render()
    {
        return view('livewire.panel.stock.add-stock-inventory')->layout('layouts.panel');
    }
}
