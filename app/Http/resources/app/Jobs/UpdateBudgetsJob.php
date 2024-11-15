<?php

namespace App\Jobs;

use App\Models\Budget;
use App\Models\Budgetem;
use App\Models\BudgetTemplate;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UpdateBudgetsJob implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */

    protected Budgetem $budgetem;
    protected bool $updateTemplates;


    protected $budgetemId;
    protected $excludeLastDays;
    protected $visible_doc;
    protected $value;


    public function __construct(
        $budgetemId,
        ?int $excludeLastDays = null,
        ?bool $visible_doc = null,
        ?float $value = null,
        $updateTemplates

    ) {
        $this->budgetemId = $budgetemId;
        $this->excludeLastDays = $excludeLastDays;
        $this->visible_doc = $visible_doc;
        $this->value = $value;
        $this->updateTemplates = $updateTemplates;
    }

    /**
     * Execute the job.
     */


    public function handle(): void
    {
        try {

            $this->budgetem = Budgetem::where('id', $this->budgetemId)->first();



            // Filtrar presupuestos que contienen la variable `Budgetem` afectada
            $query = Budget::whereHas('budgetems', function ($query) {
                $query->where('budget_budgetem.itemable_id', $this->budgetem->id)
                    ->where('budget_budgetem.itemable_type', Budgetem::class);
            });

            // Si se excluyen presupuestos creados en los últimos X días, aplicar el filtro
            if ($this->excludeLastDays) {
                $dateLimit = Carbon::now()->subDays($this->excludeLastDays);
                $query->where('created_at', '<', $dateLimit);
            }



            if ($this->updateTemplates) {
                // Filtrar plantillas que contienen la variable `Budgetem` afectada
                $templateQuery = BudgetTemplate::whereHas('budgetems', function ($query) {
                    $query->where('budget_budgetem.itemable_id', $this->budgetem->id)
                        ->where('budget_budgetem.itemable_type', Budgetem::class);
                });
            }



            // Obtener los presupuestos a actualizar
            $budgetsToUpdate = $query->get();

            // Recalcular cada presupuesto
            foreach ($budgetsToUpdate as $budget) {

                dispatch(new RecalculateBudget(
                    budget: $budget,
                    budgetem: $this->budgetem,
                    visible_doc: $this->visible_doc,
                    value: $this->value
                ));

                dispatch(new DeleteBudgetPdf($budget));
            }


            if ($this->updateTemplates) {
                // Obtener las plantillas a actualizar
                $templatesToUpdate = $templateQuery->get();

                // Recalcular cada plantilla
                foreach ($templatesToUpdate as $template) {
                    
                    dispatch(new RecalculateBudgetTemplate(
                        budgetTemplate: $template,
                        budgetem: $this->budgetem,
                        visible_doc: $this->visible_doc,
                        value: $this->value
                    ));
                }
            }
        } catch (\Exception $e) {
            dd($e);
        }
    }
}
