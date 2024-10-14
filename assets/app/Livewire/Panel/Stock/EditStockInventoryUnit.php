<?php

namespace App\Livewire\Panel\Stock;

use Livewire\Component;

class EditStockInventoryUnit extends Component
{
    public function render()
    {
        return view('livewire.panel.stock.edit-stock-inventory-unit')->layout('layouts.panel'); 
    }
}
