<?php

namespace App\Livewire\Panel\Property\Budgets;

use App\Enums\StatusCustomerEnum;
use App\Models\Customer;
use App\Models\Property;
use Livewire\Component;

class AddBudgetProperty extends Component
{
    public $customer;
    public $property;
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

    }



    public function render()
    {
        return view('livewire.panel.property.budgets.add-budget-property')->layout('layouts.panel');
    }
}
