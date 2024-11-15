<?php

namespace App\Livewire\Panel\Property\Budgets;

use App\Models\Budget;
use App\Models\Customer;
use App\Models\Property;
use Livewire\Component;

class EditBudgetProperty extends Component
{

    public $customer;
    public $property;
    public $budget;

    public array $data = [];

    public function mount(){



        $this->customer = Customer::where('id', $this->customer)
        ->select('id', 'name', 'surname',  'business_id', 'business_name', 'service_id')
        ->with([
            'properties' => function ($query) {
                $query->select('id', 'property_name', 'customer_id')->where('id', $this->property);
            },
        ])->firstOrFail();

        $this->property = Property::where('id', $this->property)->firstOrFail();

        $this->budget = Budget::where('id', $this->budget)->where('customer_id', $this->customer->id)->where('property_id', $this->property->id)
        ->with([ // Include budget and related budgetems
            'budgetems',
            'products',
            'products.units',
            'privateBudgetems',
            'publicBudgetems', // Include budget
        ])->firstOrFail();

        $this->data = $this->budget->toArray();
    
    }



    public function render()
    {
        return view('livewire.panel.property.budgets.edit-budget-property')
        ->layout('layouts.panel');
    }
}
