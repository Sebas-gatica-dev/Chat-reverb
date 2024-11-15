<?php

namespace App\Observers;

use App\Enums\StatusBudgetEnum;
use App\Models\Budget;
use App\Models\Trash;
use Illuminate\Support\Facades\Auth;

class BudgetObserver
{
    /**
     * Handle the Budget "created" event.
     */
    public function created(Budget $budget): void
    {
        //
    }

    /**
     * Handle the Budget "updated" event.
     */
    public function updated(Budget $budget): void
    {
        //
    }

    /**
     * Handle the Budget "deleted" event.
     */
    public function deleted(Budget $budget): void
    {
        if (!$budget->isForceDeleting()) {
            $trash = new Trash();
            $trash->business_id = $budget->business_id;
            $trash->user_id = Auth::id();
            $trash->data = [
                'amount' => $budget->total,
                'description' => $budget->name,
            ];
            $trash->trashable()->associate($budget);
            $trash->save();

            $budget->update(
                [
                    'status' => StatusBudgetEnum::INACTIVE->value
                ]
            );
        }
    }

    /**
     * Handle the Budget "restored" event.
     */
    public function restored(Budget $budget): void
    {
        $budget->update(
            [
                'status' => StatusBudgetEnum::GENERATED->value
            ]
        );
    }

    /**
     * Handle the Budget "force deleted" event.
     */
    public function forceDeleted(Budget $budget): void
    {
        dispatch(new \App\Jobs\DeleteBudgetPdf($budget));
    }
}
