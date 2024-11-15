<?php

namespace App\Observers;

use App\Models\Product;
use App\Models\Trash;
use Illuminate\Support\Facades\Auth;


class ProductObserver
{
    /**
     * Handle the Product "created" event.
     */
    public function created(Product $product): void
    {
        //
    }

    /**
     * Handle the Product "updated" event.
     */
    public function updated(Product $product): void
    {
        //
    }

    /**
     * Handle the Product "deleted" event.
     */
    public function deleted(Product $product): void
    {
        //
        if (!$product->isForceDeleting()) {
            $trash = new Trash();
            $trash->business_id = $product->business_id;
            $trash->user_id = Auth::id();
            $trash->data = [
                'name' => $product->name,
                'description' => $product->description,
            ];
            $trash->trashable()->associate($product);
            $trash->save();
        }
    }

    /**
     * Handle the Product "restored" event.
     */
    public function restored(Product $product): void
    {
        //
    }

    /**
     * Handle the Product "force deleted" event.
     */
    public function forceDeleted(Product $product): void
    {
        //
    }
}
