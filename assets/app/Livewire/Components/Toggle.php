<?php

namespace App\Livewire\Components;

use Livewire\Component;

class Toggle extends Component
{


    public $breakdown;

    public $answer;
    public $checked;
    public $title = 'Toggle';
    public $subtitle = 'Subtitle';
    public $content = 'Description';

    public $dark = false;


    public function mount(){

    }

    public function updatedChecked($value)
    {

        $this->checked = $value;

        $this->dispatch('update-checked', $this->checked);
    }


    public function render()
    {
        return view('livewire.components.toggle');
    }
}
