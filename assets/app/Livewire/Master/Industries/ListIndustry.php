<?php

namespace App\Livewire\Master\Industries;

use App\Models\Industry;
use Livewire\Component;

class ListIndustry extends Component
{

    public $industries;

    public function mount()
    {


            $this->industries = Industry::all();

    }
    public function render()
    {
        return view('livewire.master.industries.list-industry')
            ->layout('layouts.master', ['header' => 'Industries']);
    }
}
