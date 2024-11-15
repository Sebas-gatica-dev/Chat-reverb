<?php

namespace App\Livewire\Panel\Settings\Salaries;

use Livewire\Component;

class EditSalary extends Component
{
    public function render()
    {
        return view('livewire.panel.settings.salaries.edit-salary')->layout('layouts.panel');
    }
}
