<?php

namespace App\Livewire\Master\Plans;

use App\Enums\SubscriptionStatus;
use App\Models\Plan;
use Livewire\Component;

class ListPlan extends Component
{

    public $plans;

    public function mount()
    {


            $this->plans = Plan::all();

    }
    public function render()
    {
        return view('livewire.master.plans.list-plan')
            ->layout('layouts.master');
    }
}
