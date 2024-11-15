<?php

namespace App\Livewire\Panel\Settings\Budgets\Budgetems;

use App\Enums\TypeBudgetemEnum;
use App\Helpers\Notifications;
use App\Models\Budgetem;
use App\Rules\QuantityWithinRange;
use Illuminate\Validation\Rule;
use Livewire\Attributes\On;
use Livewire\Component;

class AddBudgetem extends Component
{

    public $name;
    public $description;
    public $description_item;
    public $min;
    public $max;
    public $value;
    public $default_quantity;
    public $type = "";
    public $visible_doc = true; // Por defecto verdadero
    public $private = false; // Por defecto público (true)
    public $operator = true; // Por defecto suma (true)

    public function mount()
    {
        // Inicialización si es necesaria
    }

    public function rules()
    {

        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'description_item' => 'nullable|string|max:255',
            'type' => ['required', Rule::in(array_column(TypeBudgetemEnum::cases(), 'value'))],
            'visible_doc' => 'required|boolean',
            'private' => 'required|boolean',
            'min' => 'nullable|required_if:type,countable|numeric|min:0',
            'max' => 'nullable|required_if:type,countable|numeric|min:0|gt:min',
            'value' => 'nullable|required_if:type,countable,fixed|numeric|min:0',
            'operator' => 'required|boolean',
            'default_quantity' => [
                'nullable',
                'required_if:type,countable,percentage',
                'integer',
                'min:0',
                new QuantityWithinRange($this->min, $this->max), // Usando la nueva regla
            ],
        ];

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
            'type.required' => 'Debe seleccionar un tipo de variable.',
            'type.in' => 'Tipo de variable inválido.',
            'visible_doc.required' => 'Debe indicar si es visible en el documento.',
            'visible_doc.boolean' => 'Valor inválido para visibilidad.',
            'private.required' => 'Debe seleccionar el tipo (público o privado).',
            'private.boolean' => 'Valor inválido para el tipo.',
            'operator.required' => 'Debe seleccionar el tipo de operador.',
            'operator.boolean' => 'Valor inválido para el operador.',
        ];
    }

    public function save($typeSave)
    {
        // dd($typeSave);
        $this->validate();

        $budgetem = Budgetem::create([
            'name' => $this->name,
            'description' => $this->description ?? null,
            'description_item' => $this->description_item ?? null,
            'min' => $this->min ?? null,
            'max' => $this->max ?? null,
            'value' => $this->value ?? null,
            'default_quantity' => $this->default_quantity ?? 1,
            'type' => $this->type,
            'visible_doc' => $this->visible_doc,
            'private' => $this->private,
            'operator' => $this->operator,
            'business_id' => auth()->user()->business->id,
          
        ]);

        if ($typeSave == 'save') {
            session()->flash('notification', [
                'message' => 'Variable presupuestaria creada correctamente',
                'type' => Notifications::icons('success')
            ]);
            return redirect()->route('panel.settings.budgets.budgetems.list');
        } elseif ($typeSave == 'save-new') {
            session()->flash('notification', [
                'message' => 'Variable presupuestaria creada correctamente',
                'type' => Notifications::icons('success')
            ]);
            return redirect()->route('panel.settings.budgets.budgetems.create');
        } else {
            return redirect()->route('panel.settings.budgets.budgetems.list');
        }
    }

    public function render()
    {
        return view('livewire.panel.settings.budgets.budgetems.add-budgetem')
        ->layout('layouts.panel', ['title' => 'Agregar Variable Presupuestaria']);
    }
}
