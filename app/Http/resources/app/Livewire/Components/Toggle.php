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

    public $colorTextAnswer = null;
    public $dark = false;

    public $name;

    public $toggleId = null;

    public $disabled = false;


    public function getListeners()
    {

        return [
            "update-from-parent-{$this->name}" => 'updatedChecked',
            "update-attribute-disabled-from-parent-{$this->name}" => 'updateDisabled',
        ];
    }

    public function mount() {

        // dump($this->toggleId);
    }

    public function updatedChecked($value)
    {
      
        $this->checked = $value;
     
        if ($this->name) {
            $this->dispatch(sprintf('update-checked-%s', $this->name), $this->checked);
        } elseif (!is_null($this->toggleId)) {
            $this->dispatch(sprintf('update-checked-toggle-id'), value: $this->checked, id: $this->toggleId);
        } else {
           
            $this->dispatch('update-checked', $this->checked);
        }
    }

    public function updateDisabled($value)
    {
        $this->disabled = $value;
    }   


    public function render()
    {
        return view('livewire.components.toggle');
    }
}
