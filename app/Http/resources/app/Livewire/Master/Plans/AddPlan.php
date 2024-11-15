<?php

namespace App\Livewire\Master\Plans;

use App\Models\Plan;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Illuminate\Support\Str;

class AddPlan extends Component
{

    #[Validate('required|string|max:120')]
    public $name;
    public $slug;
    #[Validate('required|string|max:1000')]
    public $description;
    #[Validate('required|integer')]
    public $price;
    #[Validate('required|integer')]
    public $duration;
    #[Validate('required')]
    public $duration_unit;
    #[Validate('integer|numeric')]
    public $free_trial_days;
    #[Validate('boolean')]
    public $is_featured = false;



    public function save()
    {
        $this->validate();

        $this->slug = Str::slug($this->name);


        $plan = Plan::create(
            $this->only(['name', 'slug', 'description', 'price', 'duration', 'duration_unit', 'free_trial_days', 'is_featured'])
        );


        // return redirect()->route('master.plans.edit', ['plan' => $plan]);
        return $this->redirectRoute('master.plans.edit', ['plan' => $plan->id], true, true);
    }
    public function render()
    {
        return view('livewire.master.plans.add-plan')
            ->layout('layouts.master');
    }
}
