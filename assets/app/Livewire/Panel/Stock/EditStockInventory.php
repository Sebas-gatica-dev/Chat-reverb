<?php

namespace App\Livewire\Panel\Stock;

use App\Enums\Units\UnitsHistoryTypeEnum;
use App\Enums\Units\UnitsStatusEnum;
use App\Helpers\Notifications;
use App\Models\Product;
use App\Models\Warehouse;
use Livewire\Component;
use App\Models\Unit;
use App\Models\UnitHistory;
use Livewire\Attributes\On;
use App\Traits\ValidateNotificationTrait;






class EditStockInventory extends Component
{

    use ValidateNotificationTrait;

    public ?Unit $unit;
    public ?Product $product;
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
    public $unitsCount;
    



    public function mount(){

        // dd($this->product);
        $this->warehouses = Warehouse::where('business_id', auth()->user()->business->id)->get();

        // $this->entryDate = $product->;
        $this->entryDate = now()->format('Y-m-d');

        $this->unitsCount = Unit::where('product_id', $this->product->id)->count();
        
        

    }
    

    public function save(){

        $warehouse = $this->selectedWarehouse;


        for($i = 0; $i < $this->quantity; $i++){
          $unit = Unit::create([
                'product_id' => $this->product->id,
                'warehouse_id' => $warehouse['id'],
                'cost' => $this->cost,
                'profit_margin' => $this->profit,
                'batch' => $this->batch,
                'tag' => uniqid(),
                'type' => $this->product->type,
                'expiration_date' => $this->expirationDate,
                'entry_date' => $this->entryDate,
                'initial_quantity' => $this->product->measure,
                'current_quantity' => $this->product->measure,
                'created_by' => auth()->user()->id,
                'status' => strval(UnitsStatusEnum::NEW->value),
            ]);

            
            UnitHistory::create([
                'unit_id' => $unit->id,
                'type' => strval(UnitsHistoryTypeEnum::Alta->value),
                'destinationable_id' => $warehouse['id'],
                'destinationable_type' => 'App\Models\Warehouse',
                'created_by' => auth()->user()->id
            ]);

        }

// MEASURE ES LA MEDIDA EN SI, Y CUANTITI ES LA CANTIDAD DE UNIDADES


      

 $this->product->update([
          'quantity' => $this->product->quantity + $this->quantity,
       ]);

         // Mostrar mensaje de éxito
         session()->flash('notification', [
            'message' => 'Unidades de inventario agregadas exitosamente.',
            'type' => Notifications::icons('success')
        ]);

        // Resetear los campos del formulario
        // $this->reset([
        //     'selectedProduct', 'selectedWarehouse', 'quantity', 'cost', 'profit', 'batch', 'tag', 'type', 'expirationDate', 'entryDate', 'weight', 'initial_quantity'
        // ]);

        return $this->redirectRoute('panel.stock.list', true, true);


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
        return view('livewire.panel.stock.edit-stock-inventory')->layout('layouts.panel');
    }
}
