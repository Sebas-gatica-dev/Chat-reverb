<?php

namespace App\Livewire\Panel\Property\Budgets;

use App\Models\Budget;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class ListBudgets extends Component
{

    use WithPagination, WithoutUrlPagination;

    public $property;
    public $customer;
    public $showAllBudgets = false;



    #[On('update-checked-allbudgets')]
    public function updateShowAllBudgets($value)
    {
        $this->showAllBudgets = $value;
    }

    public function deleteBudget($budgetId)
    {
    
        $budget = Budget::find($budgetId);
        $budget->delete();
    }


    public function render()
    {
        if ($this->showAllBudgets) {
            // Mostrar todos los presupuestos del cliente
            $budgets = $this->customer->budgets()->withTrashed()
                ->with([
                    'customer',
                    'property'
                ])
                ->orderBy('deleted_at')
                ->orderBy('created_at')
                ->orderBy('name', 'asc')
                
                ->paginate(15);
        } else {
            // Mostrar presupuestos de la propiedad actual
            $budgets = $this->property->budgets()->withTrashed()
                ->with([
                    'customer',
                    'property'
                ])
                ->orderBy('deleted_at')
                ->orderBy('created_at')
                ->orderBy('name', 'asc')
                ->paginate(15);
        }

        return view('livewire.panel.property.budgets.list-budgets', [
            'budgets' => $budgets,
        ]);
    }
}
