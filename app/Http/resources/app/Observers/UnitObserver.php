<?php

namespace App\Observers;

use App\Models\Trash;
use App\Models\Product;
use App\Models\Unit;
use Illuminate\Support\Facades\Auth;





class UnitObserver
{
    /**
     * Handle the Unit "created" event.
     */
    public function created(Unit $unit): void
    {
        //LA INTECION ES QUE PERFECCIONAR ESTA LOGICA PERO QUE CIERTOS VALORES DE ACTUALIZEN DEPENDIENDO
       $product = Product::find($unit->product_id);
    
     
        
       $product->update([
              'cost' => $unit->cost,
              'profit' => $unit->profit_margin,
       ]);

    
       
      

    }

    /**
     * Handle the Unit "updated" event.
     */
    public function updated(Unit $unit): void
    {
      
       

    }

    /**
     * Handle the Unit "deleted" event.
     */
    public function deleted(Unit $unit): void
    {
        //

        if (!$unit->isForceDeleting()) {
            $trash = new Trash();
            $trash->business_id = $unit->product->business_id;
            $trash->user_id = Auth::id();
            $trash->data = [
                'name' => $unit->name,
                'description' => $unit->description,
            ];
            $trash->trashable()->associate($unit);
            $trash->save();
        }
    }

    /**
     * Handle the Unit "restored" event.
     */
    public function restored(Unit $unit): void
    {
        //
    }

    /**
     * Handle the Unit "force deleted" event.
     */
    public function forceDeleted(Unit $unit): void
    {
        //
    }
}
