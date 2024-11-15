<?php

namespace App\Livewire\Panel\Settings\Budgets\Documents;

use Livewire\Component;

class EditPdfResources extends Component
{
    public function render()
    {
        return view('livewire.panel.settings.budgets.documents.edit-pdf-resources')
            ->layout('layouts.panel');
    }
}
