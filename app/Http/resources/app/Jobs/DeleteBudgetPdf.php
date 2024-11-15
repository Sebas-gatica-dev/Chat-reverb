<?php

namespace App\Jobs;

use App\Enums\StatusBudgetEnum;
use App\Models\Budget;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
class DeleteBudgetPdf implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    protected  Budget $budget;

    /**
     * Create a new job instance.
     */
    public function __construct( Budget $budget)
    {
        $this->budget = $budget;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
       
        $businessSlug = Str::slug($this->budget->business->name);
        $pdfFileName = 'presupuesto-' . Str::slug($this->budget->customer->id) . '.pdf';
        $pdfFilePath = '/' . $businessSlug . '/budgets/' . $pdfFileName;
        if (Storage::exists($pdfFilePath)) {
            Storage::delete($pdfFilePath);
        }

        $this->budget = $this->budget->update(
        [
            'status' => StatusBudgetEnum::NOT_GENERATED->value
        
        ]);


    }
}
