<?php

namespace App\Livewire\Panel\Settings\Salaries;

use App\Models\Salary;
use Livewire\Component;
use Livewire\WithPagination;

class ListSalary extends Component
{

    use WithPagination;


    public function mount()
    {
    }


    public function render()
    {
        return view('livewire.panel.settings.salaries.list-salary', [
            'salaries' => Salary::paginate(10),
            ])->layout('layouts.panel');
    }
}
