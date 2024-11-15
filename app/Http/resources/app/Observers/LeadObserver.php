<?php

namespace App\Observers;

use App\Models\Lead;
use App\Models\LeadActivity;
use Illuminate\Support\Str;

class LeadObserver
{
    /**
     * Handle the Lead "created" event.
     */
    public function created(Lead $lead): void
    {
        LeadActivity::create([
            'lead_id' => $lead->id,
            'user_id' => $lead->created_by,
            'date' => $lead->date,
            'time' => $lead->time,
            'type_contact' => $lead->type_contact,
            'comment' => $lead->description,
            'is_initial' => true,
        ]);
    }

    /**
     * Handle the Lead "updated" event.
     */
    public function updated(Lead $lead): void
    {

       $leadActivity = LeadActivity::where('lead_id', $lead->id)->where('is_initial', true)->first();
       $leadActivity->update([
        'comment' => $lead->description,
       ]);
     
        
    }

    /**
     * Handle the Lead "deleted" event.
     */
    public function deleted(Lead $lead): void
    {
        //
    }

    /**
     * Handle the Lead "restored" event.
     */
    public function restored(Lead $lead): void
    {
        //
    }

    /**
     * Handle the Lead "force deleted" event.
     */
    public function forceDeleted(Lead $lead): void
    {
        //
    }
}
