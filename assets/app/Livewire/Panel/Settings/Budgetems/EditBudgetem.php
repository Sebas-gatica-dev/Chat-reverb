<?php

namespace App\Livewire\Panel\Settings\Budgetems;

use App\Enums\OperatorBudgetemEnum;
use App\Helpers\Notifications;
use App\Models\Budgetem;
use Illuminate\Validation\Rule;
use Livewire\Component;

class EditBudgetem extends Component
{
    public ?Budgetem $budgetem;

    public $name;
    public $description;
    public $description_item;
    public $min;
    public $max;
    public $value;
    public $default_quantity;
    public $operator = "";
    public $visible_doc = true; // Por defecto verdadero
    public $private = true; // Por defecto público (true)

    public function mount()
    {

        $this->name = $this->budgetem->name;
        $this->description = $this->budgetem->description;
        $this->description_item = $this->budgetem->description_item;
        $this->min = $this->budgetem->min;
        $this->max = $this->budgetem->max;
        $this->value = $this->budgetem->value;
        $this->default_quantity = $this->budgetem->default_quantity;
        $this->operator = $this->budgetem->operator;
        $this->visible_doc = $this->budgetem->visible_doc;
        $this->private = $this->budgetem->private;
    }

    public function rules()
    {
        $rules = [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'description_item' => 'nullable|string|max:255',
            'operator' => ['required', Rule::in(array_column(OperatorBudgetemEnum::cases(), 'name'))],
            'visible_doc' => 'required|boolean',
            'private' => 'required|boolean',
            'min' => 'nullable|required_if:operator,COUNTABLE,PERCENTAGE|numeric|min:0',
            'max' => 'nullable|required_if:operator,COUNTABLE,PERCENTAGE|numeric|min:0',
            'value' => 'nullable|required_if:operator,COUNTABLE,FIXED|numeric|min:0',
            'default_quantity' => 'nullable|required_if:operator,COUNTABLE,PERCENTAGE|integer|min:0',
        ];

        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => 'El nombre es obligatorio.',
            'name.string' => 'El nombre debe ser una cadena de texto.',
            'name.max' => 'El nombre no debe exceder 255 caracteres.',
            'description.string' => 'La descripción debe ser una cadena de texto.',
            'description.max' => 'La descripción no debe exceder 255 caracteres.',
            'description_item.string' => 'La descripción del ítem debe ser una cadena de texto.',
            'description_item.max' => 'La descripción del ítem no debe exceder 255 caracteres.',
            'min.required' => 'El valor mínimo es obligatorio.',
            'min.numeric' => 'El valor mínimo debe ser numérico.',
            'min.min' => 'El valor mínimo no puede ser negativo.',
            'max.required' => 'El valor máximo es obligatorio.',
            'max.numeric' => 'El valor máximo debe ser numérico.',
            'max.min' => 'El valor máximo no puede ser negativo.',
            'value.required' => 'El valor es obligatorio.',
            'value.numeric' => 'El valor debe ser numérico.',
            'value.min' => 'El valor no puede ser negativo.',
            'default_quantity.integer' => 'La cantidad por defecto debe ser un número entero.',
            'default_quantity.min' => 'La cantidad por defecto no puede ser negativa.',
            'operator.required' => 'Debe seleccionar un operador.',
            'operator.in' => 'Operador inválido.',
            'visible_doc.required' => 'Debe indicar si es visible en el documento.',
            'visible_doc.boolean' => 'Valor inválido para visibilidad.',
            'private.required' => 'Debe seleccionar el tipo (público o privado).',
            'private.boolean' => 'Valor inválido para el tipo.',
        ];
    }

    public function update()
    {
        $this->validate();

        $this->budgetem->update([
            'name' => $this->name,
            'description' => $this->description ?? null,
            'description_item' => $this->description_item ?? null,
            'min' => $this->min ?? null,
            'max' => $this->max ?? null,
            'value' => $this->value ?? null,
            'default_quantity' => $this->default_quantity ?? null,
            'operator' => $this->operator,
            'visible_doc' => $this->visible_doc,
            'private' => $this->private,
        ]);

        session()->flash('notification', [
            'message' => 'Variable presupuestaria actualizada correctamente',
            'type' => Notifications::icons('success')
        ]);

        return redirect()->route('panel.settings.budgetems.list');
    }

    public function render()
    {
        return view('livewire.panel.settings.budgetems.edit-budgetem')
            ->layout('layouts.panel', ['title' => 'Editar Variable Presupuestaria']);
    }
}
