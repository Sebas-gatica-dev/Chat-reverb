<?php

namespace App\Observers;

use App\Models\Trash;
use App\Models\Warehouse;
use Illuminate\Support\Facades\Auth;



class WarehouseObserver
{
    /**
     * Handle the Warehouse "created" event.
     */
    public function created(Warehouse $warehouse): void
    {
        //
    }

    /**
     * Handle the Warehouse "updated" event.
     */
    public function updated(Warehouse $warehouse): void
    {
        //
    }

    /**
     * Handle the Warehouse "deleted" event.
     */
    public function deleted(Warehouse $warehouse): void
    {
        //
        if (!$warehouse->isForceDeleting()) {
            $trash = new Trash();
            $trash->business_id = $warehouse->business_id;
            $trash->user_id = Auth::id();
            $trash->data = [
                'name' => $warehouse->name,
                'address' => $warehouse->address,
            ];
            $trash->trashable()->associate($warehouse);
            $trash->save();
        }
    }

    /**
     * Handle the Warehouse "restored" event.
     */
    public function restored(Warehouse $warehouse): void
    {
        //
    }

    /**
     * Handle the Warehouse "force deleted" event.
     */
    public function forceDeleted(Warehouse $warehouse): void
    {
        //
    }
}
