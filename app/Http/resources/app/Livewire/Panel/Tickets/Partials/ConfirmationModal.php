<?php

namespace App\Livewire\Panel\Tickets\Partials;

use App\Enums\Tickets\StatusTicketEnum;
use App\Models\Ticket;
use Livewire\Component;

class ConfirmationModal extends Component
{

    public Ticket $ticket;
    


    public function cancelAction(){

        $this->dispatch('cancelAction');

    }


    public function render()
    {
        return view('livewire.panel.tickets.partials.confirmation-modal');
    }
}
