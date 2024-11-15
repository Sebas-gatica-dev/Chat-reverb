<?php

namespace App\Livewire\Components;

use Livewire\Component;

class ListProductsAndUnits extends Component
{
    public $units; 
    public $products;
    public $model;



    public function mount()
    {
    //    PODRIAMOS COMPONENTIZAR  LA LISTA DE UNIDADES
    }




    public function render()
    {
        return view('livewire.components.list-products-and-units');
    }
}
