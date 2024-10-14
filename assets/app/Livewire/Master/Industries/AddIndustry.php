<?php

namespace App\Livewire\Master\Industries;

use App\Models\Industry;
use Livewire\Attributes\Validate;
use Livewire\Component;

class AddIndustry extends Component
{

    #[Validate('required|string|max:120')]
    public $name;


    public function save()
    {
        $this->validate();

        $industry = Industry::create(
            $this->only(['name'])
        );

        return redirect()->route('master.industries.edit', $industry->id);
    }

    public function render()
    {
        return view('livewire.master.industries.add-industry')
            ->layout('layouts.master', ['header' => 'Add Industry']);
    }
}
