<?php

namespace App\Observers;

use App\Models\Property;
use App\Models\Trash;
use Illuminate\Contracts\Events\ShouldHandleEventsAfterCommit;
use Illuminate\Support\Facades\Auth;

class PropertyObserver implements ShouldHandleEventsAfterCommit
{
    /**
     * Handle the Property "created" event.
     */
    public function created(Property $property): void
    {
        //
    }

    /**
     * Handle the Property "updated" event.
     */
    public function updated(Property $property): void
    {
        //
    }

    /**
     * Handle the Property "deleted" event.
     */
    public function deleted(Property $property): void
    {
        if (!$property->isForceDeleting()) {
            $trash = new Trash();
            $trash->business_id = $property->business_id;
            $trash->user_id = Auth::id();
            $trash->data = [
                'name' => $property->name,
                'address' => $property->address,
            ];
            $trash->trashable()->associate($property);
            $trash->save();
        }
    }

    /**
     * Handle the Property "restored" event.
     */
    public function restored(Property $property): void
    {
        //
    }

    /**
     * Handle the Property "force deleted" event.
     */
    public function forceDeleted(Property $property): void {}
}
