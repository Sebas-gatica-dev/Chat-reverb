<?php

namespace App\Livewire\Panel\Customers;

use App\Models\Customer;
use App\Models\Visit;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Enums\FrequencyEnum;

class ShowCustomer extends Component
{
    public $customer;
    public $properties;

    public function mount()
    {

      $this->authorize('access-function', 'customer-show');
      $branchesIds = Auth::user()->branches->pluck('id');
        // dd($branchesIds);
       $this->customer = Customer::select(['id', 'name', 'email'])->where('id', $this->customer)->with([
           'properties' => fn ($query) => $query->select([
                'id',
                'address', 
                'photo', 
                'latitude',
                'longitude',
                'frequency',
                 'property_name',
                'customer_id',
                'city_id', 
                'neighborhood_id'
            ])->whereIn('branch_id', $branchesIds),
           'properties.city' => fn ($query) => $query->select(['id','name']),
           'properties.neighborhood' => fn ($query) => $query->select(['id','name']),
       ])->firstOrFail();

        // dd($this->customer);

        // $this->properties = $this->customer->properties()->whereIn('branch_id', $branchesIds)->get();

        if($this->customer->properties->count() == 0)
        {
            $this->redirectRoute('panel.customers.list');
        }elseif($this->customer->properties->count() == 1){
            $this->redirectRoute('panel.customers.property.show', [$this->customer->id, $this->customer->properties->first()->id]);
        }
    }
    public function render()
    {
        return view('livewire.panel.customers.show-customer')
            ->layout('layouts.panel');
    }
}
