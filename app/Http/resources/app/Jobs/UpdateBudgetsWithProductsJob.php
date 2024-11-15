<?php

namespace App\Jobs;

use App\Models\Budget;
use App\Models\Budgetem;
use App\Models\BudgetTemplate;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UpdateBudgetsWithProductsJob implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    protected $productId;
    protected $cost;
    protected $profit;
    protected $excludeLastDays;
    protected Product $product;

    protected bool $updateTemplates;
    
    /**
     * Create a new job instance.
     */
    public function __construct($productId, ?int $excludeLastDays = null, $cost, $profit,
    $updateTemplates
    )
    {
        $this->productId = $productId;
        $this->cost = $cost;
        $this->profit = $profit;
        $this->excludeLastDays = $excludeLastDays;
        $this->updateTemplates = $updateTemplates;

    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->product = Product::where('id', $this->productId)->first();


        // Obtener todos los presupuestos que contienen el producto
        $query = Budget::whereHas('products', function ($query) {
            $query->where('budget_budgetem.itemable_id', $this->product->id)
                ->where('budget_budgetem.itemable_type', Product::class);
        })->with('products', 'budgetems', 'business', 'customer');


        if($this->updateTemplates){
            // Filtrar plantillas que contienen la variable `Budgetem` afectada
            $templateQuery = BudgetTemplate::whereHas('budgetems', function ($query) {
                $query->where('budget_budgetem.itemable_id', $this->product->id)
                    ->where('budget_budgetem.itemable_type', Product::class);
            });
        }



        // Si se excluyen presupuestos creados en los últimos X días, aplicar el filtro
        if ($this->excludeLastDays) {
            $dateLimit = Carbon::now()->subDays($this->excludeLastDays);
            $query->where('created_at', '<', $dateLimit);
        }


        // Recalcular cada presupuesto
        $budgetsToUpdate = $query->get();


        // Recalcular cada presupuesto
        foreach ($budgetsToUpdate as $budget) {
            
            dispatch(new RecalculateBudget(
                budget: $budget,
                product: $this->product,
                cost: $this->cost,
                profit: $this->profit
            )); 
            
            
            dispatch(new DeleteBudgetPdf($budget));
        }

        if($this->updateTemplates){
       
            // Recalcular cada plantilla
            $templatesToUpdate = $templateQuery->get();
            foreach ($templatesToUpdate as $template) {
                dispatch(new RecalculateBudgetTemplate(
                    budgetTemplate: $template, 
                    product: $this->product,
                    cost: $this->cost,
                    profit: $this->profit, 
                    ));
            }
        }


    }


    // /**
    //  * Recalcular el presupuesto completo en base al nuevo costo y margen de ganancia del producto.
    //  *
    //  * @param Budget $budget
    //  */
    // protected function recalculateBudget(Budget $budget)
    // {

    //     // Iniciar accumulatedSubtotal en 0
    //     $accumulatedSubtotal = 0;

    //     // Obtener todos los items (variables y productos) asociados al presupuesto, incluyendo los datos del pivote
    //     $budgetems = $budget->budgetems()->withPivot('quantity', 'value', 'total', 'order', 'visible_doc', 'private')->get();
    //     $products = $budget->products()->withPivot('quantity', 'value', 'total', 'order', 'visible_doc', 'private')->get();


    //     // Combinar las colecciones y ordenar por 'order'
    //     $items = $budgetems->merge($products)->sortBy(function ($item) {
    //         return $item->pivot->order;
    //     });

    //     // Recalcular cada item
    //     foreach ($items as $item) {
    //         $subtotal = $this->applyItem($accumulatedSubtotal, $item);
    //     }

    //     // Actualizar el total del presupuesto
    //     $total = $subtotal;
    //     if ($budget->iva) {
    //         $total *= 1.21; // Si hay IVA, aplicar 21% de incremento
    //     }

    //     // Guardar el nuevo total en el presupuesto
    //     $budget->update(['total' => $total]);

        
    // }



    // /**
    //  * Eliminar el archivo PDF del presupuesto.
    //  *
    //  * @param Budget $budget
    //  */
    // protected function deleteBudgetsPdf(Budget $budget)
    // {
    //     $businessSlug = Str::slug($budget->business->name);
    //     $pdfFileName = 'presupuesto-' . Str::slug($budget->customer->id) . '.pdf';
    //     $pdfFilePath = '/' . $businessSlug . '/budgets/' . $pdfFileName;
    //     if (Storage::exists($pdfFilePath)) {
    //         Storage::delete($pdfFilePath);
    //     }

    // }

    // /**
    //  * Aplicar un item (variable o producto) al subtotal del presupuesto.
    //  *
    //  * @param float $subtotal
    //  * @param mixed $item
    //  * @return float
    //  */
    // protected function applyItem(float $accumulatedSubtotal, $item): float
    // {

    //     // Si el item es la variable actualizada, actualizar los valores del pivote
    //     if ($item instanceof Product && $item->id == $this->product->id) {
    //         $item->pivot->value = ($this->cost || $this->profit) ?
    //             $this->cost + ($this->cost * ($this->profit / 100)) : $item->pivot->value;
    //         $item->pivot->save();
    //     }


    //     $type = $item->type ?? 'COUNTABLE'; // Por defecto, los productos se tratan como contables
    //     $operator = $item->operator ?? true;
    //     $subtotal = 0;

    //     // Calcular el subtotal según el tipo
    //     switch ($type) {
    //         case 'FIXED':
    //             $subtotal = $item->pivot->value;
    //             break;
    //         case 'COUNTABLE':
    //             $quantity = $item->pivot->quantity ?? 1;
    //             $value = $item->pivot->value;
    //             $subtotal = $quantity * $value;
    //             break;
    //         case 'PERCENTAGE':
    //             $quantity = $item->pivot->quantity ?? $item->pivot->value;
    //             $percentage = $quantity / 100;
    //             $subtotal = $accumulatedSubtotal * $percentage;
    //             break;
    //     }
    //     // Actualizar el total en el pivote
    //     $item->pivot->total = $subtotal;
    //     $item->pivot->save();
    //     // Sumar o restar al subtotal acumulado según el operador
    //     if ($operator) {
    //         $accumulatedSubtotal += $subtotal;
    //     } else {
    //         $accumulatedSubtotal -= $subtotal;
    //     }
    //     return $accumulatedSubtotal;
    // }



}
