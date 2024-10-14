<?php

namespace App\Livewire\Master\Businesses;

use App\Models\Business;
use Livewire\Component;

class ListBusiness extends Component
{

    public $businesses;

    public function mount(){

        $this->businesses = Business::with('users')->get();
    }
    public function render()
    {
        return view('livewire.master.businesses.list-business')
        ->layout('layouts.master');
    }
}
