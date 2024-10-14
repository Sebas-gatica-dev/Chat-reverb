<?php

namespace App\Livewire\Stock;

use App\Models\Product;
use Livewire\Component;
use App\Models\Unit;

class ShowStockInventoryUnit extends Component
{


    public ?Product $product;
    public ?Unit $unit;
    public $unit_histories = [];

    public function mount()
    {
    //   dd($this->product, $this->unit);
       $this->unit_histories = $this->unit->unit_histories()->get();

    }


    public function render()
    {


        return view('livewire.stock.show-stock-inventory-unit')->layout('layouts.panel');
    }
}
