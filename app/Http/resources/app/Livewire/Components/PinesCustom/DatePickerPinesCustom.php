<?php

namespace App\Livewire\Components\PinesCustom;

use Livewire\Component;

class DatePickerPinesCustom extends Component
{

    public $model; // Variable para recibir el nombre de la variable del padre
    public $datePickerValue = '';

    // Actualiza la variable del componente padre
    public function updatedDatePickerValue($value)
    {
      
        $this->dispatch('updateDateValue', $this->model, $value);
    }




    public function render()
    {
        return view('livewire.components.pines-custom.date-picker-pines-custom');
    }
}
