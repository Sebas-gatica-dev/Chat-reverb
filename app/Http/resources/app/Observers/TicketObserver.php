<?php

namespace App\Observers;


use App\Models\Ticket;
use App\Models\Trash;
use Illuminate\Support\Facades\Auth;

class TicketObserver
{
    /**
     * Handle the Ticket "created" event.
     */
    public function created(Ticket $ticket): void
    {
        //
    }

    /**
     * Handle the Ticket "updated" event.
     */
    public function updated(Ticket $ticket): void
    {
        //
    }

    /**
     * Handle the Ticket "deleted" event.
     */
    public function deleted(Ticket $ticket): void
    {
        if (!$ticket->isForceDeleting()) {
            $trash = new Trash();
            $trash->business_id = $ticket->business_id;
            $trash->user_id = Auth::id();
            $trash->data = [
                'amount' => $ticket->amount,
                'description' => $ticket->description,
            ];
            $trash->trashable()->associate($ticket);
            $trash->save();
        }


    }

    /**
     * Handle the Ticket "restored" event.
     */
    public function restored(Ticket $ticket): void
    {
        //
    }

    /**
     * Handle the Ticket "force deleted" event.
     */
    public function forceDeleted(Ticket $ticket): void
    {
        //
    }
}
