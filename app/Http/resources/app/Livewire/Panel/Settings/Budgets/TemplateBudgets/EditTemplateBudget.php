<?php

namespace App\Livewire\Panel\Settings\Budgets\TemplateBudgets;

use App\Enums\TypeBudgetemEnum;
use App\Helpers\Notifications;
use App\Models\BudgetTemplate;
use App\Models\Budgetem;
use App\Models\PdfResource;
use App\Models\Product;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\Attributes\On;

class EditTemplateBudget extends Component
{

    //Template
    public $template;
    public $templateName;
    public $templateDescription;

    //Variables
    public Collection $budgetems; // Available budget variables (public)
    public array $selectedBudgetemIds = []; // IDs of selected variables

    //Productos
    public Collection $products;
    public array $selectedProductIds = [];

    //Variables privadas
    public array $privateBudgetems = [];
    public $addPrivateVariables = false;


    public array $items = [];
    public array $templateItems = [];

    // public array $budgetVariables = []; // Variables in the template
    // public array $budgetVariablesOrder = []; // Order of the variables
    // public Collection $templates;


    //Items de la plantilla
    public bool $iva = false;
    public float $subtotal = 0;
    public float $total = 0;


    //PDF resources
    public bool $openDrawer = false;
    public array $pdfResources = []; // All available PDF resources
    public array $orderedPdfResources = []; // Selected and ordered PDFs




    public function mount()
    {


        $this->template = BudgetTemplate::where('id', $this->template)->with(
            [
                'budgetems',
                'products',
                'products.units',
                'privateBudgetems',
                'publicBudgetems'
            ]
        )->first();




        $this->templateName = $this->template->name;
        $this->templateDescription = $this->template->description;


        $this->addPrivateVariables = $this->template->budgetems_private;

        $this->loadBudgetems();
        $this->loadProducts();
        $this->loadTemplatePdfs();
        $this->loadPrivateBudgetems();

        $this->initializeVariables();
    }

    // Load available budget variables
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



    private function initializeVariables()
    {


        $this->templateItems = array_merge($this->template->publicBudgetems->toArray(), $this->template->products->toArray());



        // Load items (variables y productos)
        $this->items = array_map(function ($item) {
            if ($item['pivot']['itemable_type'] === Budgetem::class) {
                return $this->mapPivotBudgetemToItem($item);
            } elseif ($item['pivot']['itemable_type'] === Product::class) {
                return $this->mapPivotProductToItem($item);
            }
        }, $this->templateItems);


        //ordenar por order las variables de menor a mayor

        usort($this->items, function ($a, $b) {
            return $a['order'] <=> $b['order'];
        });

        // dd($this->data['items']);

        // Separar IDs de variables y productos seleccionados
        $this->selectedBudgetemIds = [];
        $this->selectedProductIds = [];



        foreach ($this->items as $item) {
            if ($item['itemable_type'] === Budgetem::class) {
                $this->selectedBudgetemIds[] = $item['id'];
            } elseif ($item['itemable_type'] === Product::class) {
                $this->selectedProductIds[] = $item['id'];
            }
        }



        if ($this->addPrivateVariables) {
            $this->privateBudgetems = array_map(function ($item) {
                return $this->mapPivotBudgetemToItem($item);
            }, $this->template->privateBudgetems->toArray());
        } else {
            $this->privateBudgetems = [];
        }



        $this->calculateTotals();
    }




    //*--METODOS DE MAPEO DE VARIABLES DE PRESUPUESTO ACTUALIZADAS / PIVOT--*//

    private function mapBudgetemToItem($budgetem)
    {

        return [
            'id' => $budgetem->id,
            'name' => $budgetem->name,
            'type' => $budgetem->type->value,
            'type_name' =>  $budgetem->type->getName(),
            'private' => $budgetem->private,
            'visible_doc' => $budgetem->visible_doc,
            'operator' => $budgetem->operator,
            'value' => $budgetem->value,
            'quantity' => $budgetem->default_quantity ?? 1,
            'min' => $budgetem->min,
            'max' => $budgetem->max,
            'subtotal' => 0,
            'type_badge' => $budgetem->type->getBadgeClasses(),
            'order' => count($this->items),
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
            'order' => count($this->items),
            'itemable_type' => Product::class,
        ];
    }


    private function mapPivotProductToItem($product)
    {

      

        // Obtener la cantidad máxima disponible
        $maxQuantity = array_sum(array_column($product['units'], 'current_quantity'));

        return [
            'id' => $product['id'],
            'name' =>  $product['name'],
            'type' => 'countable',
            'type_name' => 'Contable',
            'private' => false,
            'visible_doc' => $product['pivot']['visible_doc'],
            'operator' => true,
            'value' => $product['pivot']['value'],
            'quantity' => $product['pivot']['quantity'],
            'min' => 1,
            'max' => $maxQuantity,
            'subtotal' => 0,
            'type_badge' => 'bg-blue-100 text-blue-800',
            'order' => $product['pivot']['order'] ?? 0,
            'itemable_type' => Product::class,
        ];
    }


    private function mapPivotBudgetemToItem($budgetem)
    {

        try {


            return [
                'id' => $budgetem['id'],
                'name' => $budgetem['name'],
                'type' => $budgetem['type'],
                'type_name' => TypeBudgetemEnum::from($budgetem['type'])->getName(),
                'private' => $budgetem['private'],
                'visible_doc' => $budgetem['pivot']['visible_doc'],
                'operator' => $budgetem['operator'],
                'value' => $budgetem['pivot']['value'],
                'quantity' => $budgetem['pivot']['quantity'],
                'min' => $budgetem['min'],
                'max' => $budgetem['max'],
                'subtotal' => $budgetem['pivot']['total'],
                'type_badge' => TypeBudgetemEnum::from($budgetem['type'])->getBadgeClasses(),
                'order' => $budgetem['pivot']['order'] ?? 0,
                'itemable_type' => Budgetem::class,
            ];
        } catch (\Exception $e) {
            dd($budgetem);
        }
    }



    //*--FIN DE METODOS DE MAPEO DE VARIABLES DE PRESUPUESTO ACTUALIZADAS / PIVOT--*//



    // Load PDFs associated with the template
    public function loadTemplatePdfs()
    {
        $this->pdfResources = [];

        $pivotEntries = DB::table('budget_pdf_resource')
            ->where('budgetable_id', $this->template->id)
            ->where('budgetable_type', BudgetTemplate::class)
            ->orderBy('order')
            ->get();



        foreach ($pivotEntries as $entry) {
            if ($entry->pdf_resource_id === 'main_budget_pdf') {
                $this->pdfResources[] = [
                    'id' => 'main_budget_pdf',
                    'name' => 'Presupuesto Principal',
                    'order' => $entry->order,
                ];
            } else {
                $pdfResource = PdfResource::find($entry->pdf_resource_id);
                if ($pdfResource) {
                    $this->pdfResources[] = [
                        'id' => $pdfResource->id,
                        'name' => $pdfResource->name,
                        'order' => $entry->order,
                    ];
                }
            }
        }

        // Sort the PDFs by 'order'
        usort($this->pdfResources, function ($a, $b) {
            return $a['order'] <=> $b['order'];
        });


        // dd($this->orderedPdfResources);
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





    // Listener methods
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


    public function updateSelectedPdfs($selectedPdfs)
    {
        $this->orderedPdfResources = $selectedPdfs;
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
                $itemData = null;

                $pivotVariable = $this->template->budgetems->firstWhere('id', $budgetemId);

                if ($pivotVariable) {
                    $itemData = $this->mapPivotBudgetemToItem($pivotVariable->toArray());
                } else {

                    $budgetem = $this->budgetems->firstWhere('id', $budgetemId);

                    if ($budgetem) {
                        $itemData = $this->mapBudgetemToItem($budgetem);
                    }
                }
                if ($itemData) {

                    $this->items[] = $itemData;
                }
            }
        }

        // Agregar nuevos productos seleccionados
        foreach ($this->selectedProductIds as $productId) {
            if (!collect($this->items)->pluck('id')->contains($productId)) {
                $itemData = null;
                $pivotProduct = $this->template->products()->with('units')->firstWhere('id', $productId);

                if ($pivotProduct) {
                    $itemData = $this->mapPivotProductToItem($pivotProduct->toArray());
                } else {
                    $product = $this->products->firstWhere('id', $productId);
                    if ($product) {
                        $itemData = $this->mapProductToItem($product);
                    }
                }
                if ($itemData) {
                    $this->items[] = $itemData;
                }
            }
        }
        // Recalcular totales
        $this->calculateTotals();
    }


    // Handle variable updates
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
                    // No constraints
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
            if ($variable['type'] == 'percentage') {
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
        // Reindexar el array
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


    // Update the template
    public function updateTemplateBudget()
    {
        // Validate input
        $this->validate([
            'templateName' => 'required|string|max:255',
            // Add any other validation rules as needed
        ]);


        $this->template->update([
            'name' => $this->templateName,
            'description' => $this->templateDescription,
            'budgetems_private' => $this->addPrivateVariables,
            'total' => $this->subtotal,
        ]);

        // Attach items to the template
        $this->attachItemsToBudgetTemplate();


        // Prepare PDFs to attach
        $pdfResourcesToAttach = [];
        foreach ($this->pdfResources as $index => $resource) {
            $pdfResourcesToAttach[$resource['id']] = [
                'order' => $resource['order'],
            ];
        }


        if (!empty($pdfResourcesToAttach)) {
            // Sync PDFs with the template
            $this->template->pdfResources()->sync($pdfResourcesToAttach);
        } else {
            // If no PDFs selected, detach all
            $this->template->pdfResources()->detach();
        }

        session()->flash('notification', [
            'message' => 'Plantilla actualizada correctamente.',
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
        return view('livewire.panel.settings.budgets.template-budgets.edit-template-budget')
            ->layout('layouts.panel', ['title' => 'Editar Plantilla de Presupuesto']);
    }
}
