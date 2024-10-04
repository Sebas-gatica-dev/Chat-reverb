<?php

namespace App\Livewire\Panel\Budgets;

use App\Enums\OperatorBudgetemEnum;
use App\Enums\StatusLedEnum;
use App\Helpers\Notifications;
use App\Models\Budget;
use App\Models\Budgetem;
use App\Models\Lead;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\Attributes\On;

class AddBudget extends Component
{
    public Lead $lead;
    public Collection $budgetems; // Lista de variables presupuestarias disponibles (no privadas)
    public Collection $privateBudgetems; // Lista de variables privadas
    public array $selectedBudgetemIds = []; // IDs de variables seleccionadas
    public array $budgetVariables = []; // Variables agregadas al presupuesto
    public array $budgetVariablesOrder = []; // Orden de las variables

    // Control para sumar variables privadas
    public bool $addPrivateVariables = false;
    public bool $iva = false;

    public float $subtotal = 0;
    public float $total = 0;


    public function mount(Lead $lead)
    {
        $this->lead = $lead;
        $this->loadBudgetems();
        $this->loadPrivateBudgetems();
    }

    public function loadBudgetems()
    {
        $this->budgetems = Budgetem::where('business_id', auth()->user()->business_id)
            ->where('private', false)
            ->get();
    }

    public function loadPrivateBudgetems()
    {
        $this->privateBudgetems = Budgetem::where('business_id', auth()->user()->business_id)
            ->where('private', true)
            ->get();
    }

    #[On('update-checked')]
    public function updatedAddPrivateVariables($value)
    {
        $this->addPrivateVariables = $value;
        $this->calculateTotals();
    }

    public function updatedIva()
    {
    
        $this->calculateTotals();
    }

    #[On('update-selected-values-budgetems')]
    public function updateSelectedBudgetems($selectedValues)
    {
        if ($selectedValues) {
            $this->selectedBudgetemIds = array_column($selectedValues, 'id');
        } else {
            $this->selectedBudgetemIds = [];
        }

        $this->syncBudgetVariables();
    }

    #[On('update-search-budgetems')]
    public function searchBudgetems($search)
    {
        $this->budgetems = Budgetem::where('business_id', auth()->user()->business_id)
            ->where('private', false)
            ->when($search, function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            })
            ->get();

        $this->updateBudgetemsInSelect();
    }

    public function updateBudgetemsInSelect()
    {
        $values = $this->budgetems->map(function ($budgetem) {
            return [
                'id' => $budgetem->id,
                'name' => $budgetem->name,
            ];
        })->toArray();

        $this->dispatch('update-values-budgetems', $values);
    }

    public function syncBudgetVariables()
    {
        // Eliminar variables que no están en selectedBudgetemIds
        $this->budgetVariables = array_filter($this->budgetVariables, function ($variable) {
            return in_array($variable['id'], $this->selectedBudgetemIds);
        });

        // Reindexar array
        $this->budgetVariables = array_values($this->budgetVariables);

        // Agregar nuevas variables
        foreach ($this->selectedBudgetemIds as $budgetemId) {
            if (!collect($this->budgetVariables)->pluck('id')->contains($budgetemId)) {
                $budgetem = $this->budgetems->where('id', $budgetemId)->first();
                if ($budgetem) {
                    $variableData = [
                        'id' => $budgetem->id,
                        'name' => $budgetem->name,
                        'operator' => $budgetem->operator,
                        'private' => $budgetem->private,
                        'visible_doc' => $budgetem->visible_doc,
                        'sum' => true, // Por defecto, incluir en la suma
                        'value' => $budgetem->value,
                        'min' => $budgetem->min,
                        'max' => $budgetem->max,
                    ];

                    // Establecer 'cantidad' según el operador
                    switch ($budgetem->operator) {
                        case 'PERCENTAGE':
                            $variableData['cantidad'] = $budgetem->default_quantity ?? $budgetem->value;
                            break;
                        case 'FIXED':
                            $variableData['cantidad'] = null; // No aplica
                            break;
                        case 'COUNTABLE':
                            $variableData['cantidad'] = $budgetem->default_quantity ?? 1;
                            break;
                    }

                    $this->budgetVariables[] = $variableData;
                }
            }
        }

        // Actualizar el orden de las variables
        $this->budgetVariablesOrder = array_column($this->budgetVariables, 'id');

        $this->calculateTotals();
    }

    public function removeVariable($index)
    {
        $variableId = $this->budgetVariables[$index]['id'];
        unset($this->budgetVariables[$index]);
        $this->budgetVariables = array_values($this->budgetVariables); // Reindexar array

        // Eliminar de selectedBudgetemIds
        if (($key = array_search($variableId, $this->selectedBudgetemIds)) !== false) {
            unset($this->selectedBudgetemIds[$key]);
            $this->selectedBudgetemIds = array_values($this->selectedBudgetemIds);
        }

        // Actualizar el componente MultiSelectGeneral
        $this->dispatch('dispatch-selected-values-budgetems', $variableId);

        $this->calculateTotals();
    }

    public function getSelectedBudgetemsForDispatch()
    {
        return $this->budgetems->whereIn('id', $this->selectedBudgetemIds)->map(function ($budgetem) {
            return [
                'id' => $budgetem->id,
                'name' => $budgetem->name,
            ];
        })->toArray();
    }

    public function updatedBudgetVariables()
    {
        $this->applyConstraints();
        $this->calculateTotals();
    }

    public function applyConstraints()
    {

        foreach ($this->budgetVariables as &$variable) {
          
            $min = $variable['min'];
            $max = $variable['max'];
            switch ($variable['operator']) {
                case 'PERCENTAGE':
                    // 'cantidad' representa el porcentaje
                    if ($variable['cantidad'] < $min) {
                        $variable['cantidad'] = $min;
                    } elseif ($variable['cantidad'] > $max) {
                        $variable['cantidad'] = $max;
                    }
                    break;
                case 'COUNTABLE':

                    //

                    // 'cantidad' está restringida por min y max
                    if ($variable['cantidad'] < $min) {
                        $variable['cantidad'] = $min;
                    } elseif ($variable['cantidad'] > $max) {
                        $variable['cantidad'] = $max;
                    }
                    break;
                case 'FIXED':
                    // No hay restricciones
                    break;
            }
        }
    }

    public function calculateTotals()
    {
        $this->subtotal = 0;
        $this->total = 0;

        $accumulatedSubtotal = 0;

        foreach ($this->budgetVariables as &$variable) {
            $operator = $variable['operator'];
            $sum = $variable['sum'];
            $subtotal = 0;

            switch ($operator) {
                case 'FIXED':
                    $subtotal = $variable['value'];
                    break;
                case 'COUNTABLE':
                    $cantidad = $variable['cantidad'];
                    $valor = $variable['value'];
                    $subtotal = $cantidad * $valor;
                    break;
                case 'PERCENTAGE':
                    $cantidad = $variable['cantidad'];
                    $percentage = $cantidad / 100;
                    $subtotal = $accumulatedSubtotal * $percentage;
                    break;
            }

            $variable['subtotal'] = $subtotal;

            if ($sum) {
                $accumulatedSubtotal += $subtotal;
            }
        }

        // Sumar variables privadas si el toggle está activado
        if ($this->addPrivateVariables) {
            foreach ($this->privateBudgetems as $privateVariable) {
                $operator = $privateVariable->operator;
                $subtotal = 0;

                switch ($operator) {
                    case 'FIXED':
                        $subtotal = $privateVariable->value;
                        break;
                    case 'COUNTABLE':
                        $cantidad = $privateVariable->default_quantity ?? 1;
                        $valor = $privateVariable->value;
                        $subtotal = $cantidad * $valor;
                        break;
                    case 'PERCENTAGE':
                        $cantidad = $privateVariable->default_quantity ?? $privateVariable->value;
                        $percentage = $cantidad / 100;
                        $subtotal = $this->subtotal * $percentage;
                        break;
                }

                $accumulatedSubtotal += $subtotal;
            }
        }

        $this->subtotal = $accumulatedSubtotal;

        // Incluir IVA si corresponde
        if ($this->iva) {
            $this->total = $this->subtotal * 1.21; // Sumar 21% de IVA
        } else {
            $this->total = $this->subtotal;
        }
    }


    public function sortBudgetVariables($variableId, $newPosition)
    {

        // dd($variableId, $newPosition);
        // dd($variableId, $newPosition);

        // Encontrar el índice actual de la variable
        $currentIndex = array_search($variableId, array_column($this->budgetVariables, 'id'));

        // Sacar la variable del array
        $variable = $this->budgetVariables[$currentIndex];
        unset($this->budgetVariables[$currentIndex]);

        // Reindexar el array
        $this->budgetVariables = array_values($this->budgetVariables);

        // Insertar la variable en la nueva posición
        array_splice($this->budgetVariables, $newPosition, 0, [$variable]);

        // Actualizar el orden de las variables
        $this->budgetVariablesOrder = array_column($this->budgetVariables, 'id');

        $this->calculateTotals();
    }

    public function saveBudget()
    {
        if (empty($this->budgetVariables) && !$this->addPrivateVariables) {
            session()->flash('notification', [
                'message' => 'Debe agregar al menos una variable al presupuesto.',
                'type' => Notifications::icons('warning'),
            ]);
            return;
        }

        // Crear presupuesto
        $budget = Budget::create([
            'id' => Str::uuid(),
            'name' => 'Presupuesto para ' . $this->lead->full_name,
            'total' => $this->total,
            'iva' => $this->iva,
            'budgetable_type' => Lead::class,
            'budgetable_id' => $this->lead->id,
        ]);

        // Asociar variables al presupuesto
        foreach ($this->budgetVariables as $variable) {
            $budget->budgetems()->attach($variable['id'], [
                'quantity' => $variable['cantidad'] ?? null,
                'total' => $variable['subtotal'],
            ]);
        }

        // Asociar variables privadas al presupuesto
        if ($this->addPrivateVariables) {
            foreach ($this->privateBudgetems as $privateVariable) {
                $budget->budgetems()->attach($privateVariable->id, [
                    'quantity' => $privateVariable->default_quantity ?? null,
                    'total' => $privateVariable->value, // O el subtotal calculado
                ]);
            }
        }

        // Actualizar estado del lead a 'Presupuestado'
        $this->lead->status = StatusLedEnum::BUDGETED->value;
        $this->lead->save();

        // Redirigir a la lista de leads con mensaje de éxito
        session()->flash('notification', [
            'message' => 'Presupuesto creado correctamente.',
            'type' => Notifications::icons('success'),
        ]);

        return redirect()->route('panel.leads.list');
    }


    public function render()
    {
        return view('livewire.panel.budgets.add-budget')
            ->layout('layouts.panel', ['title' => 'Crear Presupuesto']);
    }
}
