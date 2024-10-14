<?php

namespace App\Observers;

use App\Models\Service;
use App\Models\Trash;
use Illuminate\Contracts\Events\ShouldHandleEventsAfterCommit;
use Illuminate\Support\Facades\Auth;


class ServiceObserver
{
    /**
     * Handle the Service "created" event.
     */
    public function created(Service $service): void
    {
        //
    }

    /**
     * Handle the Service "updated" event.
     */
    public function updated(Service $service): void
    {
        //
    }

    /**
     * Handle the Service "deleted" event.
     */
    public function deleted(Service $service): void
    {
        //
        if(!$service->isForceDeleting()){
            $trash = new Trash();
            $trash->business_id = $service->business_id;
            $trash->user_id = Auth::id();
            $trash->data = [
                'name' => $service->name,
                'address' => $service->address ?? null,
            ];
            $trash->trashable()->associate($service);
            $trash->save();
        }

    }

    /**
     * Handle the Service "restored" event.
     */
    public function restored(Service $service): void
    {
        //
    }

    /**
     * Handle the Service "force deleted" event.
     */
    public function forceDeleted(Service $service): void
    {
        //
    }
}
