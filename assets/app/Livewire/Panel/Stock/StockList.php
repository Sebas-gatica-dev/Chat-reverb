<?php

namespace App\Livewire\Panel\Stock;

use Livewire\Component;

class StockList extends Component
{
  public function mount(){

  }

    



    public function render()
    {
        return view('livewire.panel.stock.stock-list')->layout('layouts.panel');
    }
}
