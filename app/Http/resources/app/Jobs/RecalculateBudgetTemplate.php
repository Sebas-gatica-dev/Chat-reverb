<?php

namespace App\Jobs;

use App\Models\Budgetem;
use App\Models\BudgetTemplate;
use App\Models\Product;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class RecalculateBudgetTemplate implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;


    protected ?BudgetTemplate $budgetTemplate;
    protected ?Product $product;
    protected ?Budgetem $budgetem; // Made nullable
    protected $cost;
    protected $profit;
    protected $visible_doc;
    protected $value;



    /**
     * Create a new job instance.
     */
    public function __construct(
        ?BudgetTemplate $budgetTemplate = null,
        ?Product $product = null,
        ?Budgetem $budgetem = null,
        $cost = null,
        $profit = null,
        $visible_doc = null,
        $value = null
    ) {

        $this->budgetTemplate = $budgetTemplate;
        $this->product = $product;
        $this->budgetem = $budgetem;
        $this->cost = $cost;
        $this->profit = $profit;
        $this->visible_doc = $visible_doc;
        $this->value = $value;
    }


    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Iniciar accumulatedSubtotal en 0
        $accumulatedSubtotal = 0;
        // Obtener todos los items (variables y productos) asociados al presupuesto, incluyendo los datos del pivote
        $budgetems = $this->budgetTemplate->budgetems()->withPivot('quantity', 'value', 'total', 'order', 'visible_doc', 'private')->get();
        $products = $this->budgetTemplate->products()->withPivot('quantity', 'value', 'total', 'order', 'visible_doc', 'private')->get();


        // Combinar las colecciones y ordenar por 'order'
        $items = $budgetems->merge($products)->sortBy(function ($item) {
            return $item->pivot->order;
        });

        // Recalcular cada item del presupuesto
        foreach ($items as $item) {
            $subtotal = $this->applyItem($accumulatedSubtotal, $item);
        }

        // Actualizar el total del presupuesto
        $total = $subtotal;

        $this->budgetTemplate->update([
            'total' => $total
        ]);

    }




    /**
     * Aplicar un item (variable o producto) al subtotal del presupuesto.
     *
     * @param float $subtotal
     * @param mixed $item
     * @return float
     */
    protected function applyItem(float $accumulatedSubtotal, $item): float
    {

        // Si el item es el producto actualizado, actualizar los valores del pivote 
        if ($item instanceof Product && isset($this->product) && $item->id == $this->product->id) {
            $item->pivot->value = ($this->cost || $this->profit) ?
                $this->cost + ($this->cost * ($this->profit / 100)) : $item->pivot->value;
            $item->pivot->save();
        }


        // Si el item es la variable actualizada, actualizar los valores del pivote
        if ($item instanceof Budgetem && isset($this->budgetem) && $item->id == $this->budgetem->id) {
            if ($item->type == 'fixed' || $item->type == 'countable') {
                $item->pivot_visible_doc = $this->visible_doc ?? $item->pivot->visible_doc;
                $item->pivot->value = $this->value ?? $item->pivot->value;
            }
            $item->pivot->save();
        }


        $type = $item->type ?? 'countable'; // Por defecto, los productos se tratan como contables
        $operator = $item->operator ?? true;
        $subtotal = 0;

        // Calcular el subtotal según el tipo
        switch ($type) {
            case 'fixed':
                $subtotal = $item->pivot->value;
                break;
            case 'countable':
                $quantity = $item->pivot->quantity ?? 1;
                $value = $item->pivot->value;
                $subtotal = $quantity * $value;
                break;
            case 'percentage':
                $quantity = $item->pivot->quantity ?? $item->pivot->value;
                $percentage = $quantity / 100;
                $subtotal = $accumulatedSubtotal * $percentage;
                break;
        }
        // Actualizar el total en el pivote
        $item->pivot->total = $subtotal;
        $item->pivot->save();
        // Sumar o restar al subtotal acumulado según el operador
        if ($operator) {
            $accumulatedSubtotal += $subtotal;
        } else {
            $accumulatedSubtotal -= $subtotal;
        }
        return $accumulatedSubtotal;
    }
}
