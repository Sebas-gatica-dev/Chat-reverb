<?php

namespace App\Livewire\Panel\Settings\Budgets\Budgetems;

use App\Enums\TypeBudgetemEnum;
use App\Helpers\Notifications;
use App\Jobs\UpdateBudgetsJob;
use App\Models\Budget;
use App\Models\Budgetem;
use App\Models\BudgetTemplate;
use App\Rules\QuantityWithinRange;
use Illuminate\Support\Facades\DB;
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
    public $type = "";
    public $visible_doc; // Por defecto verdadero
    public $private; // Por defecto público (true)
    public $operator;



    //Actualización de presupuestos
    public $updateTemplatesToggle = true;
    public $showUpdateModal = false; // Controla la visibilidad del modal
    public $keepOldPrice = false; // Checkbox 1: Mantener con precio antiguo los presupuestos
    public $timePeriod = null; // Período de tiempo seleccionado (7, 15, 30 días)
    public $timePeriods = [7, 15, 30]; // Opciones disponibles para el período de tiempo
    public $originalValue; // Valor original de 'value' para comparación
    public $originalDefaultQuantity; // Valor original de 'default_quantity' para comparación
    public $isInUse = false; // Indica si la variable está en uso en algún presupuesto


    //METODOS DEL MODAL

    public function confirmUpdate()
    {
        $this->validate();

        $this->showUpdateModal = true; // Muestra el modal
    }

    public function performUpdate()
    {
        // Validar las entradas del modal
        $this->validateModalInputs();


        // // Actualizar templates si corresponde
        // if ($this->updateTemplatesToggle) {
        //     $this->updateTemplates();
        // }

        
        //Actualizar presupuestos
        dispatch(new UpdateBudgetsJob($this->budgetem->id, $this->timePeriod, $this->visible_doc, $this->value, $this->updateTemplatesToggle));
       
    

        // Actualizar la variable presupuestaria
        $this->updateBudgetem();


        session()->flash('notification', [
            'message' => 'Variable y presupuestos actualizados correctamente',
            'type' => Notifications::icons('success'),
        ]);

        // Cerrar el modal y redirigir
        $this->showUpdateModal = false;
        return redirect()->route('panel.settings.budgets.budgetems.list');
    }

    protected function validateModalInputs()
    {
        $rules = [
            'keepOldPrice' => 'boolean',
            'updateTemplatesToggle' => 'boolean',
        ];

        if ($this->keepOldPrice) {
            $rules['timePeriod'] = 'required|in:7,15,30';
        }

        $this->validate($rules, [
            'timePeriod.required' => 'Debe seleccionar un período de tiempo.',
            'timePeriod.in' => 'Período de tiempo inválido.',
        ]);
    }

    //FIN DE LOS METODOS DEL MODAL

    public function mount()
    {


        $this->name = $this->budgetem->name;
        $this->description = $this->budgetem->description;
        $this->description_item = $this->budgetem->description_item;
        $this->min = $this->budgetem->min;
        $this->max = $this->budgetem->max;
        $this->value = $this->budgetem->value;
        $this->default_quantity = $this->budgetem->default_quantity;
        $this->type = $this->budgetem->type;
        $this->visible_doc = $this->budgetem->visible_doc;
        $this->private = $this->budgetem->private;
        $this->operator = $this->budgetem->operator;

        // Almacenar valores originales
        $this->originalValue = $this->budgetem->value;
        $this->originalDefaultQuantity = $this->budgetem->default_quantity;




        // dd($this->budgetem);
        $budgetemInBudget = Budget::whereHas('budgetems', function ($query) {
            $query->where('budgetems.id', $this->budgetem->id);
        })->exists();

        $budgetemInTemplate = BudgetTemplate::whereHas('budgetems', function ($query) {
            $query->where('budgetems.id', $this->budgetem->id);
        })->exists();

        $this->isInUse =  $budgetemInBudget || $budgetemInTemplate;
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
            'type.in' => 'Tipo de variable inválida.',
            'visible_doc.required' => 'Debe indicar si es visible en el documento.',
            'visible_doc.boolean' => 'Valor inválido para visibilidad.',
            'private.required' => 'Debe seleccionar el tipo (público o privado).',
            'private.boolean' => 'Valor inválido para el tipo.',
            'operator.required' => 'Debe seleccionar el tipo de operador.',
            'operator.boolean' => 'Valor inválido para el operador.'
        ];
    }

    public function update()
    {

        // Verificar si 'value' o 'default_quantity' han cambiado
        $valueChanged = $this->value != $this->originalValue;
        $defaultQuantityChanged = $this->default_quantity != $this->originalDefaultQuantity;

        if (($valueChanged || $defaultQuantityChanged) && $this->isInUse) {
            // Mostrar el modal
            $this->showUpdateModal = true;
        } else {

            $this->updateBudgetem();
            // Si no hubo cambios en 'value' o 'default_quantity', proceder normalmente
            session()->flash('notification', [
                'message' => 'Variable presupuestaria actualizada correctamente',
                'type' => Notifications::icons('success'),
            ]);

            return redirect()->route('panel.settings.budgets.budgetems.list');
        }
    }

    public function updateBudgetem()
    {
        $this->validate();

        if ($this->type == 'fixed') {

            $this->max = $this->min = $this->default_quantity = null;
        }

        // Si la variable está en uso, evitamos cambios en los campos restringidos
        if ($this->isInUse) {
            $this->visible_doc = $this->budgetem->visible_doc;
            $this->private = $this->budgetem->private;
            $this->operator = $this->budgetem->operator;
            $this->type = $this->budgetem->type;
        }


        $this->budgetem->update([
            'name' => $this->name,
            'description' => $this->description ?? null,
            'description_item' => $this->description_item ?? null,
            'min' => $this->min ?? null,
            'max' => $this->max ?? null,
            'value' => $this->value ?? null,
            'default_quantity' => $this->default_quantity ?? null,
            'type' => $this->type,
            'visible_doc' => $this->visible_doc,
            'private' => $this->private,
            'operator' => $this->operator,
        ]);
    }

    public function updateTemplates()
    {
        $budgetemId = $this->budgetem->id;
        $defaultQuantity = $this->default_quantity;
        $value = $this->value;
        $type = $this->type;

        // Recalcular el total según el tipo
        if ($type === 'countable') {
            $total = $defaultQuantity * $value;
        } elseif ($type === 'fixed') {
            $total = $value;
        } elseif ($type === 'percentage') {

            $quantity =   $defaultQuantity;
            $percentage = $quantity / 100;
            $total = $value * $percentage;
        } else {
            // Para otros tipos, el total puede depender de otros factores
            $total = null;
        }


        // Obtener todos los templates que utilizan esta variable
        $templates = $this->budgetem->budgetTemplates;

        foreach ($templates as $template) {
            // Actualizar los campos en la tabla pivote
            $template->budgetems()->updateExistingPivot($budgetemId, [
                'quantity' => $defaultQuantity,
                'value' => $value,
                'total' => $total,
            ]);

            //Actualizar el subtotal de la tabla de la plantilla
            // Recalcular el total del template
            $this->recalculateTemplateTotal($template);
        }
    }

    protected function recalculateTemplateTotal($template)
    {
        // Obtener todas las variables del template con sus totales
        $variables = $template->budgetems()->withPivot('total')->get();

        // Sumar los totales de las variables
        $totalTemplate = $variables->sum(function ($variable) {
            return $variable->pivot->total ?? 0;
        });

        // Actualizar el total en el template
        $template->update([
            'total' => $totalTemplate,
        ]);
    }

    public function render()
    {
        return view('livewire.panel.settings.budgets.budgetems.edit-budgetem')
            ->layout('layouts.panel', ['title' => 'Editar Variable Presupuestaria']);
    }
}
