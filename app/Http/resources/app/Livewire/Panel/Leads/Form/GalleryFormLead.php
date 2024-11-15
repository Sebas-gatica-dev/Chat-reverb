<?php

namespace App\Livewire\Panel\Leads\Form;

use Livewire\Component;

class GalleryFormLead extends Component
{

    public $files = [];
    public $data = [];



    public function render()
    {
        return view('livewire.panel.leads.form.gallery-form-lead');
    }
}
