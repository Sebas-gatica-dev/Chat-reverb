<?php

namespace App\Livewire\Panel\Subscriptions\Payments;

use Livewire\Component;

class PaymentsList extends Component
{
    public function render()
    {
        return view('livewire.panel.subscriptions.payments.payments-list')
        ->layout('layouts.panel');
    }
}
