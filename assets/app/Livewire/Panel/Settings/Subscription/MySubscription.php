<?php

namespace App\Livewire\Panel\Settings\Subscription;

use Livewire\Component;

class MySubscription extends Component
{

    public $subscription;
    public $payments;

    public function mount()
    {
        $this->authorize('access-function', 'my-suscription');

        $this->subscription = auth()->user()->business->subscription;
        $this->payments = auth()->user()->business->payments;


        if(!$this->subscription) {
            return redirect()->route('panel.settings.my-subscription.changue-plan');
        }

    }

    public function render()
    {
        return view('livewire.panel.settings.subscription.my-subscription')
            ->layout('layouts.panel');
    }
}
