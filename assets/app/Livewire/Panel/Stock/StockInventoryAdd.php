<?php

namespace App\Livewire\Panel\Stock;

use Livewire\Component;

class StockInventoryAdd extends Component
{
    public function render()
    {
        return view('livewire.panel.stock.stock-inventory-add')->layout('layouts.panel');
    }
}
