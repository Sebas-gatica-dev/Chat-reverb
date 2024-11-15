<?php

namespace App\Livewire\Panel\Settings\Budgets\TemplateBudgets;

use App\Enums\TypeBudgetemEnum;
use App\Helpers\Notifications;
use App\Models\BudgetTemplate;
use App\Models\Budgetem;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\PdfResource;
use App\Models\Product;
use App\Models\Template;

class AddTemplateBudget extends Component
{
    public Collection $budgetems; // Lista de variables presupuestarias disponibles (no privadas)
    public array $selectedBudgetemIds = []; // IDs de variables seleccionadas

    public array $budgetVariables = []; // Variables agregadas a la plantilla
    public array $budgetVariablesOrder = []; // Orden de las variables

    public array $items = []; // Lista de items seleccionados

    public array $itemsOrder = []; // Orden de los items

    public $template;

    public bool $iva = false;
    public float $subtotal = 0;
    public float $total = 0;

    public $pdfResources = [];
    public bool $openDrawer = false;



    public Collection $products; // Lista de productos disponibles
    public array $selectedProductIds = []; // IDs de productos seleccionados

    public $templateName;
    public $templateDescription;

    public $addPrivateVariables = false;

    // public array $pdfResources = []; // All available PDF resources
    public array $orderedPdfResources = []; // Selected and ordered PDFs

    public array $privateBudgetems = [];

    public function mount()
    {
        $this->loadBudgetems();
        $this->loadProducts();
        $this->loadPrivateBudgetems();
        $this->pdfResources = [
            [
                'id' => 'main_budget_pdf',
                'name' => 'Presupuesto Principal',
                'order' => 0,
            ],
        ];
    }




    protected function rules()
    {
        return [
            'templateName' => 'required|string|max:255',
            'templateDescription' => 'nullable|string|max:255',
        ];
    }

    public function loadBudgetems()
    {
        $this->budgetems = Budgetem::where('business_id', auth()->user()->business_id)
            ->where('private', false)
            ->get();
    }

    public function loadPrivateBudgetems()
    {
        $this->privateBudgetems = Budgetem::where('business_id', auth()->user()->business_id)
            ->where('private', true)->get()->map(function ($budgetem) {
                return [
                    'id' => $budgetem->id,
                    'name' => $budgetem->name,
                    'type' => $budgetem->type->value,
                    'type_name' => $budgetem->type->getName(),
                    'type_badge' => $budgetem->type->getBadgeClasses(),
                    'private' => $budgetem->private,
                    'visible_doc' => $budgetem->visible_doc,
                    'sum' => true, // Por defecto, incluir en la suma
                    'operator' => $budgetem->operator,
                    'value' => $budgetem->value,
                    'default_quantity' => $budgetem->default_quantity,
                    'min' => $budgetem->min,
                    'max' => $budgetem->max,
                    'business_id' => auth()->user()->business_id,
                    'subtotal' => null
                ];
            })->toArray();
    }


    private function loadProducts()
    {
        $this->products = Product::where('business_id', auth()->user()->business_id)
            ->whereHas('units', function ($query) {
                $query->where('current_quantity', '>', 0);
            })
            ->with(['units' => function ($query) {
                $query->where('current_quantity', '>', 0);
            }])
            ->get();
    }



    #[On('update-checked')]
    public function updatedAddPrivateVariables($value)
    {
        $this->addPrivateVariables = $value;
        $this->calculateTotals();
    }


    public function sortBudgetItems($variableId, $newPosition)
    {

        $currentIndex = array_search($variableId, array_column($this->items, 'id'));

        if ($currentIndex !== false) {
            $variable = $this->items[$currentIndex];
            unset($this->items[$currentIndex]);
            $this->items = array_values($this->items);
            array_splice($this->items, $newPosition, 0, [$variable]);
            $this->items = array_values($this->items);

            // Actualizar el orden de las variables
            foreach ($this->items as $index => &$variable) {
                $variable['order'] = $index;
            }
            unset($variable);
            $this->calculateTotals();
        }
    }



    #[On('update-selected-values-budgetems')]
    public function updateSelectedBudgetems($selectedValues)
    {
        if ($selectedValues) {
            $this->selectedBudgetemIds = array_column($selectedValues, 'id');
        } else {
            $this->selectedBudgetemIds = [];
        }

        $this->syncItems();
    }


    #[On('update-selected-values-products')]
    public function updateSelectedProducts($selectedValues)
    {
        if ($selectedValues) {
            $this->selectedProductIds = array_column($selectedValues, 'id');
        } else {
            $this->selectedProductIds = [];
        }

        $this->syncItems();
    }



    #[On('update-search-budgetems')]
    public function searchBudgetems($search)
    {
        $this->budgetems = Budgetem::where('business_id', auth()->user()->business_id)
            ->where('private', false)
            ->when($search, function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            })
            ->get();

        $this->updateBudgetemsInSelect();
    }

    public function updateBudgetemsInSelect()
    {
        $values = $this->budgetems->map(function ($budgetem) {
            return [
                'id' => $budgetem->id,
                'name' => $budgetem->name,
            ];
        })->toArray();

        $this->dispatch('update-values-budgetems', $values);
    }

    public function syncBudgetVariables()
    {
        $this->budgetVariables = array_filter($this->budgetVariables, function ($variable) {
            return in_array($variable['id'], $this->selectedBudgetemIds);
        });

        $this->budgetVariables = array_values($this->budgetVariables);

        foreach ($this->selectedBudgetemIds as $budgetemId) {
            if (!collect($this->budgetVariables)->pluck('id')->contains($budgetemId)) {
                $budgetem = $this->budgetems->where('id', $budgetemId)->first();
                if ($budgetem) {
                    $variableData = [
                        'id' => $budgetem->id,
                        'name' => $budgetem->name,
                        'type' => $budgetem->type->value,
                        'type_name' => $budgetem->type->getName(),
                        'quantity' => $budgetem->default_quantity ?? null,
                        'private' => $budgetem->private,
                        'visible_doc' => $budgetem->visible_doc,
                        'operator' => $budgetem->operator,
                        'value' => $budgetem->value,
                        'type_badge' => $budgetem->type->getBadgeClasses(),
                        'min' => $budgetem->min,
                        'max' => $budgetem->max,
                        'business_id' => auth()->user()->business_id,
                    ];

                    switch ($budgetem->type) {
                        case 'percentage':
                            $variableData['quantity'] = $budgetem->default_quantity ?? $budgetem->value;
                            break;
                        case 'fixed':
                            $variableData['quantity'] = null;
                            break;
                        case 'countable':
                            $variableData['quantity'] = $budgetem->default_quantity ?? 1;
                            break;
                    }

                    $this->budgetVariables[] = $variableData;
                }
            }
        }

        $this->budgetVariablesOrder = array_column($this->budgetVariables, 'id');
        $this->calculateTotals();
    }


    private function syncItems()
    {
        // Remover items que ya no están seleccionados

        $this->items = array_filter($this->items, function ($item) {
            return in_array($item['id'], array_merge($this->selectedBudgetemIds, $this->selectedProductIds));
        });


        // Reindexar el array
        $this->items = array_values($this->items);


        // Agregar nuevas variables seleccionadas
        foreach ($this->selectedBudgetemIds as $budgetemId) {
            if (!collect($this->items)->pluck('id')->contains($budgetemId)) {
                $budgetem = $this->budgetems->firstWhere('id', $budgetemId);
                if ($budgetem) {
                    $itemData = $this->mapBudgetemToItem($budgetem);
                    $this->items[] = $itemData;
                }
            }
        }

        // Agregar nuevos productos seleccionados
        foreach ($this->selectedProductIds as $productId) {
            if (!collect($this->items)->pluck('id')->contains($productId)) {
                $product = $this->products->firstWhere('id', $productId);
                if ($product) {
                    $itemData = $this->mapProductToItem($product);
                    $this->items[] = $itemData;
                }
            }
        }
        // Recalcular totales
        $this->calculateTotals();
    }




    private function mapBudgetemToItem($budgetem)
    {

        return [
            'id' => $budgetem->id,
            'name' => $budgetem->name,
            'type' => $budgetem->type->value,
            'type_name' => $budgetem->type->getName(),
            'private' => $budgetem->private,
            'visible_doc' => $budgetem->visible_doc,
            'operator' => $budgetem->operator,
            'value' => $budgetem->value,
            'quantity' => $budgetem->default_quantity ?? 1,
            'min' => $budgetem->min,
            'max' => $budgetem->max,
            'subtotal' => 0,
            'type_badge' => $budgetem->type->getBadgeClasses(),
            'order' => 0,
            'itemable_type' => Budgetem::class,
        ];
    }

    private function mapProductToItem($product)
    {

        // Calcular el valor como costo + porcentaje de ganancia
        $cost = $product->cost;
        $profitMargin = $product->profit;
        $value = $cost + ($cost * $profitMargin / 100);

        // Obtener la cantidad máxima disponible
        $maxQuantity = $product->units->sum('current_quantity');

        return [
            'id' => $product->id,
            'name' => $product->name,
            'type' => 'countable',
            'type_name' => 'Contable',
            'private' => false,
            'visible_doc' => true,
            'operator' => true,
            'value' => $value,
            'quantity' => 1,
            'min' => 1,
            'max' => $maxQuantity,
            'subtotal' => 0,
            'type_badge' => 'bg-blue-100 text-blue-800',
            'order' => 0,
            'itemable_type' => Product::class,
        ];
    }


    public function removeItem($index)
    {
        $itemId = $this->items[$index]['id'];
        $itemType = $this->items[$index]['itemable_type'];

        unset($this->items[$index]);
        $this->items = array_values($this->items); // Reindex array

        if ($itemType === Budgetem::class) {
            // Remover de selected_budgetem_ids
            if (($key = array_search($itemId, $this->selectedBudgetemIds)) !== false) {
                unset($this->selectedBudgetemIds[$key]);
                $this->selectedBudgetemIds = array_values($this->selectedBudgetemIds);
            }
            // Actualizar el MultiSelect
            $this->dispatch('dispatch-selected-values-data.selected_budgetem_ids', $itemId);
        } elseif ($itemType === Product::class) {
            // Remover de selected_product_ids
            if (($key = array_search($itemId, $this->selectedProductIds)) !== false) {
                unset($this->selectedProductIds[$key]);
                $this->selectedProductIds = array_values($this->selectedProductIds);
            }
            // Actualizar el MultiSelect
            $this->dispatch('dispatch-selected-values-data.selected_product_ids', $itemId);
        }

        $this->calculateTotals();
    }
    public function updatedItems()
    {
        $this->applyConstraints();
        $this->calculateTotals();
    }

    public function applyConstraints()
    {
        foreach ($this->items as &$variable) {
            $min = $variable['min'];
            $max = $variable['max'];
            switch ($variable['type']) {
                case 'percentage':
                    if ($variable['quantity'] < $min) {
                        $variable['quantity'] = $min;
                    } elseif ($variable['quantity'] > $max) {
                        $variable['quantity'] = $max;
                    }
                    break;
                case 'countable':
                    if ($variable['quantity'] < $min) {
                        $variable['quantity'] = $min;
                    } elseif ($variable['quantity'] > $max) {
                        $variable['quantity'] = $max;
                    }
                    break;
                case 'fixed':
                    break;
            }
        }
    }

    public function calculateTotals()
    {
        $this->subtotal = 0;
        $this->total = 0;

        $accumulatedSubtotal = 0;

        $allItems = $this->items;


        if ($this->addPrivateVariables) {
            $allItems = array_merge($allItems, $this->privateBudgetems);
        }



        $publicVariables = array_filter($allItems, function ($variable) {
            return !$variable['private'];
        });

        $publicOrders = array_column($publicVariables, 'order');
        $maxPublicOrder = !empty($publicOrders) ? max($publicOrders) : 0;
        $orderCounter = $maxPublicOrder + 1;

        foreach ($allItems as &$variable) {
            if ($variable['private']) {
                $variable['order'] = $orderCounter++;
            }
        }

        unset($variable);

        $allOrders = array_column($allItems, 'order');
        $maxOrder = !empty($allOrders) ? max($allOrders) : 0;

        $orderCounter = $maxOrder + 1;
        foreach ($allItems as &$variable) {
            if ($variable['type'] == 'PERCENTAGE') {
                $variable['order'] = $orderCounter++;
            }
        }
        unset($variable);


        usort($allItems, function ($a, $b) {
            return $a['order'] <=> $b['order'];
        });

        // Procesar las variables en orden
        list($accumulatedSubtotal, $allItems) = $this->sumBudgetems($accumulatedSubtotal, $allItems);



        // Actualizar las variables públicas con los nuevos subtotales
        $this->items = array_filter($allItems, function ($variable) {
            return !$variable['private']; // Solo variables públicas
        });

        // Reindexar el array de variables públicas
        $this->items = array_values($this->items);


        //Actualizar las variables privadas
        $this->privateBudgetems = array_filter($allItems, function ($variable) {
            return $variable['private']; // Solo variables privadas
        });
        // Reindexar el array
        $this->privateBudgetems = array_values($this->privateBudgetems);



        $this->subtotal = $accumulatedSubtotal;

        // Actualizar el subtotal acumulado
        $this->subtotal = $accumulatedSubtotal;
    }


    public function sumBudgetems($accumulatedSubtotal, $budgetems)
    {

        foreach ($budgetems as &$budgetem) {
            $type = $budgetem['type'];
            $operator = $budgetem['operator']; // Operador de suma/resta
            $subtotal = 0;

            // Calcular el subtotal de la variable
            switch ($type) {
                case 'fixed':
                    $subtotal = $budgetem['value'];
                    $budgetem['subtotal'] = $subtotal;
                    break;
                case 'countable':
                    $quantity = $budgetem['quantity'] ?? 1;
                    $valor = $budgetem['value'];
                    $subtotal = $quantity * $valor;
                    $budgetem['subtotal'] = $subtotal;
                    break;
                case 'percentage':
                    $quantity = $budgetem['quantity'] ?? $budgetem['value'];
                    $percentage = $quantity / 100;
                    $subtotal = $accumulatedSubtotal * $percentage;
                    $budgetem['subtotal'] = $subtotal;
                    break;
            }

            // Incluir siempre la variable en el cálculo
            if ($operator) {
                $accumulatedSubtotal += $subtotal;
            } else {
                $accumulatedSubtotal -= $subtotal;
            }
        }


        unset($budgetem);

        return [$accumulatedSubtotal, $budgetems];
    }




    public function saveTemplateBudget()
    {
        $this->validate();


        $this->template = BudgetTemplate::create([
            'name' => $this->templateName,
            'description' => $this->templateDescription,
            'business_id' => auth()->user()->business->id,
            'total' => $this->subtotal,
            'budgetems_private' => $this->addPrivateVariables,

        ]);

        $this->attachItemsToBudgetTemplate();


        // Prepare PDFs to attach
        $pdfResourcesToAttach = [];
        foreach ($this->pdfResources  as $index => $resource) {
            $pdfResourcesToAttach[$resource['id']] = [
                'order' => $resource['order'],
            ];
        }

        if (!empty($pdfResourcesToAttach)) {
            // Attach PDFs to the template
            $this->template->pdfResources()->sync($pdfResourcesToAttach);
        }


        session()->flash('notification', [
            'message' => 'Plantilla creada correctamente.',
            'type' => Notifications::icons('success'),
        ]);

        return redirect()->route('panel.settings.budgets.template.list');
    }



    private function attachItemsToBudgetTemplate()
    {
        // Eliminar relaciones existentes
        $this->template->budgetems()->detach();
        $this->template->products()->detach();

        $budgetemsToAttach = [];
        $productsToAttach = [];


        // Adjuntar variables y productos
        foreach ($this->items as $index => $item) {
            $attachData = [
                'quantity' => $item['quantity'] ?? null,
                'total' => $item['subtotal'],
                'value' => $item['value'],
                'visible_doc' => $item['visible_doc'],
                'private' => $item['private'],
                'order' => $index,
                'itemable_type' => $item['itemable_type'],
            ];

            if ($item['itemable_type'] === Budgetem::class) {
                $budgetemsToAttach[$item['id']] = $attachData;
            } elseif ($item['itemable_type'] === Product::class) {
                $productsToAttach[$item['id']] = $attachData;
            }
        }
        // dd($budgetemsToAttach, $productsToAttach);

        // Variables privadas
        if ($this->addPrivateVariables) {

            foreach ($this->privateBudgetems as $index => $variable) {
                $attachData = [
                    'quantity' => $variable['quantity'] ?? null,
                    'total' => $variable['subtotal'],
                    'value' => $variable['value'],
                    'visible_doc' => $variable['visible_doc'],
                    'private' => $variable['private'],
                    'order' => $index + count($budgetemsToAttach),
                    'itemable_type' => Budgetem::class,
                ];

                $budgetemsToAttach[$variable['id']] = $attachData;
            }
        }



        // Sincronizar variables
        $this->template->budgetems()->syncWithoutDetaching($budgetemsToAttach);

        // Sincronizar productos
        $this->template->products()->syncWithoutDetaching($productsToAttach);
    }



    #[On('updatePdfResources')]
    public function updatePdfResources($pdfResources)
    {
        $this->pdfResources = $pdfResources;
    }




    public function render()
    {
        return view('livewire.panel.settings.budgets.template-budgets.add-template-budget')
            ->layout('layouts.panel', ['title' => 'Crear Plantilla de Presupuesto']);
    }
}
