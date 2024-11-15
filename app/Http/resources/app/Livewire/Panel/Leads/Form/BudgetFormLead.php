<?php

namespace App\Livewire\Panel\Leads\Form;

use App\Enums\StatusBudgetEnum;
use App\Enums\StatusCustomerEnum;
use App\Enums\TypeBudgetemEnum;
use App\Helpers\Notifications;
use App\Models\Budget;
use App\Models\Budgetem;
use App\Models\BudgetItem;
use App\Models\BudgetTemplate;
use App\Models\Customer;
use App\Models\PdfResource;
use App\Models\Product;
use App\Models\Property;
use DragonCode\Support\Facades\Helpers\Boolean;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\On;
use Livewire\Component;
use Illuminate\Support\Facades\DB as FacadesDB;
use Illuminate\Validation\Rule;

class BudgetFormLead extends Component
{


    public ?Customer $lead;

    // Data array to store form data
    public array $data = [];

    public Collection $budgetems;          // Public variables from budgetems table
    public Collection $privateBudgetems;   // Private variables from budgetems table

    public Collection $products;           // Productos disponibles

    public Collection $templates;          // Available templates

    public bool $openDrawer = false;

    public Budget $budget;
    public $idModel = 'budget-form-lead'; // Identifier for components

    public $selectedTemplateId = null;

    public int $progress = 0;
    public int $generatingPdf = 0;

    public bool $allItemsInvisible = false;

    public float $privateSubtotal = 0;


    public $propertyId;

    public bool $closed = false;

    public $name = '';

    
    public function rules()
    {
        return
     [
            'name' => Rule::requiredIf( $this->closed == true) . '|string|max:120',
     ];
    }

    public function messages(){

        return [
            'name.required_if' => 'El nombre es requerido',
            'name.string' => 'El nombre debe ser un texto',
            'name.max' => 'El nombre no debe superar los 120 caracteres',
        ];

    }


    public function mount()
    {

    


        // Load budgetems, products, and templates
        $this->loadBudgetems();
        $this->loadProducts();
        $this->loadTemplates();



        if (!empty($this->data)) {
            // Existing budget, prepare for editing
            $this->loadExistingBudget();
            $this->loadEntryPdfs();
            $this->loadProgressBudget();
            $this->checkIfBudgetIsGenerating();


        } else {
            // No budget exists, prepare for creation
            $this->prepareForCreation();
            $this->generatingPdf = false;
            $this->progress = 0;
        }

        

    }

    public function checkIfBudgetIsGenerating(){
        // $this->budget = Budget::find($this->data['id']);
    }


    //*--METODOS DE CARGA DE DATOS--*//
    private function loadProgressBudget()
    {
  
        // Verificar si el presupuesto está siendo generado
        if ($this->lead->budget->status == StatusBudgetEnum::GENERATING->value) { 
           
            $this->generatingPdf = true;
            $this->progress = $this->lead->budget->progress;
        } else {
            $this->generatingPdf = false;
            $this->progress = 0;
        }
    }

    private function loadBudgetems()
    {
        $this->budgetems = Budgetem::where('business_id', auth()->user()->business_id)
            ->where('private', false)
            ->get();


        $this->privateBudgetems = Budgetem::where('business_id', auth()->user()->business_id)
            ->where('private', true)
            ->get();
    }

    private function loadProducts()
    {
        $this->products = Product::where('business_id', auth()->user()->business_id)
            // ->whereNotIn('id', $this->data['selected_product_ids'])
            ->whereHas('units', function ($query) {
                $query->where('current_quantity', '>', 0);
            })
            ->with(['units' => function ($query) {
                $query->where('current_quantity', '>', 0);
            }])
            ->get();
    }


    private function loadTemplates()
    {
        $this->templates = BudgetTemplate::where('business_id', auth()->user()->business_id)->get();
    }

    private function loadExistingBudget()
    {

        // dd($this->data);
        $this->data['budget_id'] = $this->data['id'];
        $this->data['iva'] = $this->data['iva'] ? true : false;

        $this->data['add_private_variables'] = $this->data['budgetems_private'] ?? false;


        $this->data['once_item_title'] = $this->data['once_item_title'] ?? $this->budget->once_item_title ?? '';



        $this->data['budget_items'] = array_merge($this->data['public_budgetems'], $this->data['products']);

        // Load items (variables y productos)
        $this->data['items'] = array_map(function ($item) {
            if ($item['pivot']['itemable_type'] === Budgetem::class) {
                return $this->mapPivotBudgetemToItem($item);
            } elseif ($item['pivot']['itemable_type'] === Product::class) {
                return $this->mapPivotProductToItem($item);
            }
        }, $this->data['budget_items']);



        //ordenar por order las variables de menor a mayor

        usort($this->data['items'], function ($a, $b) {
            return $a['order'] <=> $b['order'];
        });


        // Separar IDs de variables y productos seleccionados
        $this->data['selected_budgetem_ids'] = [];
        $this->data['selected_product_ids'] = [];


        foreach ($this->data['items'] as $item) {
            if ($item['itemable_type'] === Budgetem::class) {
                $this->data['selected_budgetem_ids'][] = $item['id'];
            } elseif ($item['itemable_type'] === Product::class) {
                $this->data['selected_product_ids'][] = $item['id'];
            }
        }



        // Load private variables if any
        if ($this->data['add_private_variables']) {
            $this->data['private_variables'] = collect($this->data['private_budgetems'])->map(function ($budgetem) {
                return $this->mapPivotBudgetemToItem($budgetem);
            })->toArray();
        } else {
            $this->data['private_variables'] = [];
        }
        $this->data['update_budget'] = false;
        $this->calculateTotals();
    }


    private function prepareForCreation()
    {
        $this->data['budget_id'] = null;
        $this->data['iva'] = false;
        $this->data['add_private_variables'] = false;
        $this->data['update_budget'] = false;
        $this->data['budget_variables'] = [];      // Ahora usaremos 'items' en lugar de 'budget_variables'
        $this->data['private_variables'] = [];

        // ... código existente ...
        $this->data['selected_budgetem_ids'] = [];
        $this->data['selected_product_ids'] = [];
        $this->data['items'] = []; // Para almacenar variables y productos seleccionados

        $this->data['once_item_title'] = '';


        $this->data['budget_variables_order'] = [];
        $this->data['subtotal'] = 0;
        $this->data['total'] = 0;
        $this->data['pdf_resources'] = [];
        $this->data['selected_template'] = [];
        $this->data['template'] = [];
        $this->data['templates'] = [];

        // Load default PDF resources (main budget PDF)
        $this->data['pdf_resources'][] = [
            'id' => 'main_budget_pdf',
            'name' => 'Presupuesto Principal',
            'order' => 0,
        ];

        $this->data['once_item_title'] = '';
    }



    public function updated($propertyName)
    {

        if (strpos($propertyName, 'data.') === 0) {
            // If a budget variable was updated, recalculate totals
            if (strpos($propertyName, 'data.budget_variables') === 0 || $propertyName === 'data.iva') {
                $this->calculateTotals();
            }
        }
    }

    //*--FIN DE METODOS DE CARGA DE DATOS--*//



    //*--METODOS DE TOGGLES DE ACTUALIZACIÓN DE PRESUPUESTO Y VARIABLES PRIVADAS--*//

    #[On('update-checked-data.add_private_variables')]
    public function updatedAddPrivateVariables($value)
    {


        $this->data['add_private_variables'] = $value;

        if ($value) {
            // Cargar todas las variables privadas disponibles
            $this->data['private_variables'] = $this->privateBudgetems->map(function ($budgetem) {

                if ($this->data['update_budget']) {
                    // Si el toggle de actualizar presupuesto está activado, usamos los valores actuales
                    return $this->mapBudgetemToItem($budgetem);
                } else {

                    $pivotVariable = null;

                    if ($this->data['budget_id']) {
                        $pivotVariable = $this->budgetems->firstWhere('id', $budgetem->id);
                    
                    }


                    if ($pivotVariable) {

                        return $this->mapPivotBudgetemToItem($pivotVariable->toArray());
                    } else {

                        return $this->mapBudgetemToItem($budgetem);
                    }
                }
            })->toArray();
        } else {
            // Eliminar variables privadas de los cálculos
            $this->data['private_variables'] = [];
        }


        $this->calculateTotals();
    }


    #[On('update-checked-budgets')]
    public function updatedUpdateBudget($value)
    {
        $this->data['update_budget'] = $value;
        if ($value) {
            // $this->loadBudgetems();
            $this->updateVariablesToCurrentValues();
        } else {

            $this->resetToInitialState();
        }

        $this->calculateTotals();
    }


    #[On('update-checked-toggle-id')]
    public function updateVisibleDocToggle($value, $id)
    {

        // dump($value, $id);


        $this->data['items'][array_search($id, array_column($this->data['items'], 'id'))]['visible_doc'] = $value;

        $this->calculateTotals();
    }

    //*--FIN DE METODOS DE TOGGLES DE ACTUALIZACIÓN DE PRESUPUESTO Y VARIABLES PRIVADAS--*//


    //*--METODOS DE ACTUALIZACIÓN DE VARIABLES--*//

    public function updateVariablesToCurrentValues()
    {
        // Update public variables
        foreach ($this->data['items'] as &$variable) {

            if ($variable['itemable_type'] === Budgetem::class) {
                $currentBudgetem = $this->budgetems->firstWhere('id', $variable['id']);
                if ($currentBudgetem) {
                    $variable = $this->mapBudgetemToItem($currentBudgetem);
                }
            }
        }



        //Update products
        foreach ($this->data['items'] as &$product) {
            if ($product['itemable_type'] === Product::class) {
                $currentProduct = $this->products->firstWhere('id', $variable['id']);
                if ($currentProduct) {
                    $product = $this->mapProductToItem($currentProduct);
                }
            }
        }

        foreach ($this->data['private_variables'] as &$variable) {
            $currentBudgetem = $this->privateBudgetems->firstWhere('id', $variable['id']);
            if ($currentBudgetem) {
                $variable = $this->mapBudgetemToItem($currentBudgetem);
            }
        }
    }


    //*--FIN DE METODOS DE ACTUALIZACIÓN DE VARIABLES--*//



    //reset to initial state
    public function resetToInitialState()
    {

        if (isset($this->data['id'])) {


            // Reset all data to initial state
            $idBudget = $this->data['id'];
            $this->data = [];
            $this->dispatch('clear-selected-values-data.selected_budgetem_ids');
            $this->selectedTemplateId = null;

            // Load budget variables
            $this->data = Budget::with(
                [
                    'budgetems',
                    'products',
                    'products.units',
                    'privateBudgetems',
                    'publicBudgetems'
                ]
            )->where('id', $idBudget)->first()->toArray();


            //Volvemos a cargar los datos.
            $this->loadExistingBudget();


            $this->loadEntryPdfs();
            $this->dispatch('update-selectedIds-values-data.selected_budgetem_ids', $this->data['selected_budgetem_ids']);
            $this->dispatch('update-selectedIds-values-data.selected_product_ids', $this->data['selected_product_ids']);
            $this->dispatch('offTemplatePdfs', $this->data['pdf_resources']);
            $this->dispatch('update-from-parent-data.add_private_variables', $this->data['add_private_variables']);
        } else {

            $this->prepareForCreation();
            $this->dispatch('clear-selected-values-data.selected_budgetem_ids', $this->data['selected_budgetem_ids']);
            $this->dispatch('clear-selected-values-data.selected_product_ids', $this->data['selected_product_ids']);
            $this->dispatch('update-from-parent-data.add_private_variables', false);
        }
    }



    //*--METODOS DE MAPEO DE VARIABLES DE PRESUPUESTO ACTUALIZADAS / PIVOT--*//

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
            'order' => count($this->data['items']),
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
            'order' => count($this->data['items']),
            'itemable_type' => Product::class,
        ];
    }


    private function mapPivotProductToItem($product)
    {

        // $cost = $product['cost'];
        // $profitMargin = $product['profit'];
        // $value = $cost + ($cost * $profitMargin / 100);

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
    }


    //*--FIN DE METODOS DE MAPEO DE VARIABLES DE PRESUPUESTO ACTUALIZADAS / PIVOT--*//


    //*--METODOS DE SELECCIÓN DE VARIABLES--*//

    #[On('update-selected-values-data.selected_budgetem_ids')]
    public function updateSelectedBudgetems($selectedValues)
    {
        $this->data['selected_budgetem_ids'] = array_column($selectedValues, 'id');
        if (empty($this->data['id'])) {
            $this->syncItemsInCreate();
        } else {
            $this->syncItemsEdit();
        }
    }

    #[On('update-selected-values-data.selected_product_ids')]
    public function updateSelectedProducts($selectedValues)
    {
        $this->data['selected_product_ids'] = array_column($selectedValues, 'id');


        if (empty($this->data['id'])) {
            $this->syncItemsInCreate();
        } else {
            $this->syncItemsEdit();
        }
    }


    private function syncItemsEdit()
    {
        // Remover items que ya no están seleccionados
        $this->data['items'] = array_filter($this->data['items'], function ($item) {
            return in_array($item['id'], array_merge($this->data['selected_budgetem_ids'], $this->data['selected_product_ids']));
        });

        // Reindexar el array
        $this->data['items'] = array_values($this->data['items']);

        // Agregar nuevas variables seleccionadas
        foreach ($this->data['selected_budgetem_ids'] as $budgetemId) {
            if (!collect($this->data['items'])->pluck('id')->contains($budgetemId)) {
                $variableData = null;
                if ($this->data['update_budget']) {

                    $budgetem = $this->budgetems->firstWhere('id', $budgetemId);

                    if ($budgetem) {
                        $variableData = $this->mapBudgetemToItem($budgetem);
                    }
                } else {

                    $pivotPosition = array_search($budgetemId, array_column($this->data['budgetems'], 'id'));


                    if ($pivotPosition !== false) {
                        $pivotVariable = $this->data['budgetems'][$pivotPosition];
                    } else {
                        $pivotVariable = null;
                    }

                    if ($pivotVariable) {

                        $variableData = $this->mapPivotBudgetemToItem($pivotVariable);
                    } else {
                        $budgetem = $this->budgetems->firstWhere('id', $budgetemId);
                        if ($budgetem) {
                            $variableData = $this->mapBudgetemToItem($budgetem);
                        }
                    }
                }

                if ($variableData) {
                    $this->data['items'][] = $variableData;
                }
            }
        }



        // Agregar nuevos productos seleccionados
        foreach ($this->data['selected_product_ids'] as $productId) {
            if (!collect($this->data['items'])->pluck('id')->contains($productId)) {
                $productData = null;

                if ($this->data['update_budget']) {

                    $product = $this->products->firstWhere('id', $productId);

                    if ($product) {
                        $productData = $this->mapProductToItem($product);
                    }
                } else {

                    $pivotProduct = null;

                    $pivotPositionProduct = array_search($productId, array_column($this->data['products'], 'id'));

                    if ($pivotPositionProduct !== false) {
                        $pivotProduct = $this->data['products'][$pivotPositionProduct];
                    }

                    if ($pivotProduct) {
                        $productData = $this->mapPivotProductToItem($pivotProduct);
                    } else {
                        $product = $this->products->firstWhere('id', $productId);
                        if ($product) {
                            $productData = $this->mapProductToItem($product);
                        }
                    }
                }

                if ($productData) {
                    $this->data['items'][] = $productData;
                }
            }
        }

        // Recalcular totales
        $this->calculateTotals();
    }


    private function syncItemsInCreate()
    {

        // Remover items que ya no están seleccionados
        $this->data['items'] = array_filter($this->data['items'], function ($item) {
            return in_array($item['id'], array_merge($this->data['selected_budgetem_ids'], $this->data['selected_product_ids']));
        });

        // Reindexar el array
        $this->data['items'] = array_values($this->data['items']);

        // Agregar nuevas variables seleccionadas
        foreach ($this->data['selected_budgetem_ids'] as $budgetemId) {
            if (!collect($this->data['items'])->pluck('id')->contains($budgetemId)) {
                $budgetem = $this->budgetems->firstWhere('id', $budgetemId);
                if ($budgetem) {
                    $itemData = $this->mapBudgetemToItem($budgetem);
                    $this->data['items'][] = $itemData;
                }
            }
        }

        // Agregar nuevos productos seleccionados
        foreach ($this->data['selected_product_ids'] as $productId) {
            if (!collect($this->data['items'])->pluck('id')->contains($productId)) {
                $product = $this->products->firstWhere('id', $productId);
                if ($product) {
                    $itemData = $this->mapProductToItem($product);
                    $this->data['items'][] = $itemData;
                }
            }
        }

        // Recalcular totales
        $this->calculateTotals();
    }

    //*--FIN DE METODOS DE SELECCIÓN DE VARIABLES--*//

    //*--METODOS DE SELECTOR DE PLANTILLAS--*//
    #[On('update-selected-value-template')]
    public function updatedSelectedTemplate($template)
    {
        if ($template) {
            $this->loadTemplateVariables($template);
        } else {
            $this->resetToInitialState();
        }
    }

    public function loadTemplateVariables($templateId)
    {

        $modelTemplate = BudgetTemplate::with([
            'budgetems',
            'publicBudgetems',
            'privateBudgetems',
            'pdfResources',
            'products',
            'products.units'
        ])->find($templateId);






        if ($modelTemplate) {


            $this->data['selected_template'] = $modelTemplate->toArray();
            $this->selectedTemplateId = $templateId;

            // dd($this->data['selected_template']);
            //Template variables
            $this->data['selected_budgetem_ids'] = array_column($this->data['selected_template']['public_budgetems'], 'id');
            $this->data['selected_product_ids'] = array_column($this->data['selected_template']['products'], 'id');

            if ($this->data['selected_template']['budgetems_private']) {

                $this->syncBudgetVariablesPrivatesFromTemplate($this->data['selected_template']);
                $this->data['add_private_variables'] = true;
                $this->dispatch('update-from-parent-data.add_private_variables', $this->data['add_private_variables']);
            }

            $this->syncBudgetItemsFromTemplate($this->data['selected_template']);


            // Limpiar las variables seleccionadas
            $this->dispatch('clear-selected-values-data.selected_budgetem_ids');


            //  Actualizar el multiselect para reflejar las variables seleccionadas
            $this->dispatch('update-selectedIds-values-data.selected_budgetem_ids', $this->data['selected_budgetem_ids']);
            $this->dispatch('update-selectedIds-values-data.selected_product_ids', $this->data['selected_product_ids']);


            //Template PDFs
            $this->syncBudgetPdfFromTemplate($this->data['selected_template']);
            $this->dispatch('loadTemplatePdfs', $this->data['pdf_resources']);

            $this->calculateTotals();
        } else {
            $this->data['selected_template'] = null;
            $this->selectedTemplateId = null;
        }
    }


    public function syncBudgetVariablesPrivatesFromTemplate($template)
    {


        // Cargar todas las variables privadas disponibles
        $this->data['private_variables'] = collect($template['private_budgetems'])->map(function ($budgetem) {
            $pivotVariable = null;

            if ($this->data['budget_id']) {
                $pivotVariable = $this->budgetems->firstWhere('id', $budgetem['id']);
            }


            if ($pivotVariable) {
                return $this->mapPivotBudgetemToItem($pivotVariable->toArray());
            } else {
                return $this->mapPivotBudgetemToItem($budgetem);
            }
        })->toArray();
    }


    public function syncBudgetItemsFromTemplate($template)
    {


        $this->data['items'] = [];

        $this->data['budget_items'] = array_merge($template['public_budgetems'], $template['products']);



        // Load items (variables y productos)
        $this->data['items'] = array_map(function ($item) {
            if ($item['pivot']['itemable_type'] === Budgetem::class) {
                return $this->mapPivotBudgetemToItem($item);
            } elseif ($item['pivot']['itemable_type'] === Product::class) {
                return $this->mapPivotProductToItem($item);
            }
        }, $this->data['budget_items']);




        // //Variables privadas del template
        // $this->updatedAddPrivateVariables($template['budgetems_private']);

        //Variables publicas del template
        // foreach ($template['budgetems'] as $budgetem) {
        //     $variableData = null;
        //     $budgetemDefault =  null;


        //     if ($budgetem['pivot']['itemable_type'] === Budgetem::class) {
        //         $budgetemDefault = $this->budgetems->firstWhere('id', $budgetem['id']);
        //     } else {
        //         $budgetemDefault = $this->products->firstWhere('id', $budgetem['id']);
        //     }


        //     //Si existe, se mapea la variable actual
        //     if ($budgetemDefault) {

        //         if ($budgetem['pivot']['itemable_type'] === Budgetem::class) {
        //             $variableData = $this->mapPivotBudgetemToItem($budgetemDefault->toArray());
        //         } else {

        //             $variableData = $this->mapPivotProductToItem($budgetemDefault->toArray());
        //         }
        //     } else {
        //         //Si no existe, se mapea la variable del template

        //         if ($budgetem['pivot']['itemable_type'] === Budgetem::class) {
        //             $variableData = $this->mapPivotBudgetemToItem($budgetem);
        //         } else {

        //             $variableData = $this->mapPivotProductToItem($budgetem);
        //         }
        //     }
        //     // }
        //     $this->data['budget_variables'][] = $variableData;
        // }
        // Update the order of the variables
        foreach ($this->data['items'] as $index => &$variable) {
            $variable['order'] = $index;
        }

        unset($variable);
    }

    public function syncBudgetPdfFromTemplate($template)
    {

        // Load PDFs
        $this->data['pdf_resources'] = [];


        // Get PDFs associated with the template, including the main budget PDF
        $pivotEntries = FacadesDB::table('budget_pdf_resource')
            ->where('budgetable_id', $template['id'])
            ->where('budgetable_type', BudgetTemplate::class)
            ->orderBy('order')
            ->get();

        foreach ($pivotEntries as $entry) {
            if ($entry->pdf_resource_id === 'main_budget_pdf') {
                $this->data['pdf_resources'][] = [
                    'id' => 'main_budget_pdf',
                    'name' => 'Presupuesto Principal',
                    'order' => $entry->order,
                ];
            } else {
                $pdfResource = PdfResource::find($entry->pdf_resource_id);
                if ($pdfResource) {
                    $this->data['pdf_resources'][] = [
                        'id' => $pdfResource->id,
                        'name' => $pdfResource->name,
                        'order' => $entry->order,
                    ];
                }
            }
        }

        // If no PDFs are associated, add the main budget PDF
        if (empty($this->data['pdf_resources'])) {
            $this->data['pdf_resources'][] = [
                'id' => 'main_budget_pdf',
                'name' => 'Presupuesto Principal',
                'order' => 0,
            ];
        }

        // Sort the pdfResources according to 'order'
        usort($this->data['pdf_resources'], function ($a, $b) {
            return $a['order'] <=> $b['order'];
        });
    }


    //*--FIN DE METODOS DE SELECTOR DE PLANTILLAS--*//


    //*--METODOS DE MANIPULACION DE VARIABLES EN LA TABLA--*//

    public function sortBudgetItems($variableId, $newPosition)
    {

        $currentIndex = array_search($variableId, array_column($this->data['items'], 'id'));



        if ($currentIndex !== false) {


            $variable = $this->data['items'][$currentIndex];
            unset($this->data['items'][$currentIndex]);
            $this->data['items'] = array_values($this->data['items']);
            array_splice($this->data['items'], $newPosition, 0, [$variable]);
            $this->data['items'] = array_values($this->data['items']);

            // Actualizar el orden de las variables
            foreach ($this->data['items'] as $index => &$variable) {
                $variable['order'] = $index;
            }

            unset($variable);
            $this->calculateTotals();
        }
    }



    public function removeItem($index)
    {
        $itemId = $this->data['items'][$index]['id'];
        $itemType = $this->data['items'][$index]['itemable_type'];

        unset($this->data['items'][$index]);
        $this->data['items'] = array_values($this->data['items']); // Reindex array

        if ($itemType === Budgetem::class) {
            // Remover de selected_budgetem_ids
            if (($key = array_search($itemId, $this->data['selected_budgetem_ids'])) !== false) {
                unset($this->data['selected_budgetem_ids'][$key]);
                $this->data['selected_budgetem_ids'] = array_values($this->data['selected_budgetem_ids']);
            }
            // Actualizar el MultiSelect
            $this->dispatch('dispatch-selected-values-data.selected_budgetem_ids', $itemId);
        } elseif ($itemType === Product::class) {
            // Remover de selected_product_ids
            if (($key = array_search($itemId, $this->data['selected_product_ids'])) !== false) {
                unset($this->data['selected_product_ids'][$key]);
                $this->data['selected_product_ids'] = array_values($this->data['selected_product_ids']);
            }
            // Actualizar el MultiSelect
            $this->dispatch('dispatch-selected-values-data.selected_product_ids', $itemId);
        }

        $this->calculateTotals();
    }


    public function calculateTotals()
    {
       

        $this->data['subtotal'] = 0;
        $this->data['total'] = 0;

        $accumulatedSubtotal = 0;
        $this->privateSubtotal = 0;

        // Combinar variables públicas y privadas
        $allItems = $this->data['items'];



        if ($this->data['add_private_variables']) {
            $allItems = array_merge($allItems, $this->data['private_variables']);
        }


        // Asignar órdenes apropiados a las variables
        // Obtener el máximo 'order' entre las variables públicas
        $publicVariables = array_filter($allItems, function ($variable) {
            return !$variable['private'];
        });



        $publicOrders = array_column($publicVariables, 'order');

        $maxPublicOrder = !empty($publicOrders) ? max($publicOrders) : 0;

        // Asignar 'order's a variables privadas
        $orderCounter = $maxPublicOrder + 1;
        foreach ($allItems as &$variable) {
            if ($variable['private']) {
                $variable['order'] = $orderCounter++;
            }
        }
        unset($variable);



        // Asignar 'order's a variables de porcentaje
        $allOrders = array_column($allItems, 'order');
        $maxOrder = !empty($allOrders) ? max($allOrders) : 0;

        $orderCounter = $maxOrder + 1;
        foreach ($allItems as &$variable) {
            if ($variable['type'] == 'percentage') {
                $variable['order'] = $orderCounter++;
            }
        }
        unset($variable);

        // Ordenar las variables
        usort($allItems, function ($a, $b) {
            return $a['order'] <=> $b['order'];
        });

        // Procesar las variables en orden
        list($accumulatedSubtotal, $allItems) = $this->sumBudgetems($accumulatedSubtotal, $allItems);

        // Verificar si todos los ítems son invisibles
        $this->allItemsInvisible = true;

        foreach ($publicVariables as $item) {
            if ($item['visible_doc']) {
                $this->allItemsInvisible = false;
                break;
            }
        }



        // Actualizar variables públicas con los nuevos subtotales
        $this->data['items'] = array_filter($allItems, function ($item) {
            return !$item['private'];
        });
        // Reindexar el array de variables públicas
        $this->data['items'] = array_values($this->data['items']);



        // Actualizar variables privadas con los nuevos subtotales
        $this->data['private_variables'] = array_filter($allItems, function ($item) {
            return $item['private'];
        });
        // Reindexar el array de variables privadas
        $this->data['private_variables'] = array_values($this->data['private_variables']);


        usort($this->data['items'], function ($a, $b) {
            return $a['order'] <=> $b['order'];
        });


        // Calcular el subtotal de las variables privadas
        foreach ($this->data['private_variables'] as $privateVariable) {
            $this->privateSubtotal += $privateVariable['subtotal'];
        }


        // Actualizar el subtotal acumulado
        $this->data['subtotal'] = $accumulatedSubtotal;

        // Incluir IVA si corresponde
        if ($this->data['iva']) {
            $this->data['total'] = $this->data['subtotal'] * 1.21; // Sumar 21% de IVA
        } else {
            $this->data['total'] = $this->data['subtotal'];
        }
    }


    public function sumBudgetems($accumulatedSubtotal, $items)
    {


        foreach ($items as &$item) {
            $type = $item['type'];
            $operator = $item['operator'];
            $subtotal = 0;

            // Calculate the subtotal of the item
            switch ($type) {
                case 'fixed':
                    $subtotal = $item['value'];
                    $value = $item['value'];
                    $item['subtotal'] = $subtotal;
                    break;
                case 'countable':
                    $quantity = $item['quantity'] ?? 1;
                    $value = $item['value'];
                    $subtotal = $quantity * $value;
                    $item['subtotal'] = $subtotal;
                    break;
                case 'percentage':
                    $quantity = $item['quantity'] ?? $item['value'];
                    $percentage = $quantity / 100;
                    $subtotal = $accumulatedSubtotal * $percentage;
                    $item['subtotal'] = $subtotal;
                    break;
            }

            // Include the item in the calculation
            if ($operator) {
                $accumulatedSubtotal += $subtotal;
            } else {
                $accumulatedSubtotal -= $subtotal;
            }
        }

        unset($item);

        return [$accumulatedSubtotal, $items];
    }


    public function updatedData($index, $field)
    {
        $this->applyConstraints();
        $this->calculateTotals();
    }


    public function applyConstraints()
    {
        foreach ($this->data['items'] as &$variable) {
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
        foreach ($this->data['private_variables'] as &$variable) {
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


    //*--FIN DE METODOS DE MANIPULACION DE VARIABLES EN LA TABLA--*//

    //*--METODOS DE MANIPULACION DE PDFS--*//

    #[On('updatePdfResources')]
    public function updatePdfResources($pdfResources)
    {
        $this->data['pdf_resources'] = $pdfResources;
    }

    public function loadEntryPdfs()
    {

        $this->data['pdf_resources'] = [];

        // Load existing PDFs associated with the budget
        $pivotEntries = FacadesDB::table('budget_pdf_resource')
            ->where('budgetable_id', $this->data['budget_id'])
            ->orderBy('order')
            ->get();

        foreach ($pivotEntries as $entry) {
            if ($entry->pdf_resource_id === 'main_budget_pdf') {
                $this->data['pdf_resources'][] = [
                    'id' => 'main_budget_pdf',
                    'name' => 'Presupuesto Principal',
                    'order' => $entry->order,
                ];
            } else {
                $pdfResource = PdfResource::find($entry->pdf_resource_id);
                if ($pdfResource) {
                    $this->data['pdf_resources'][] = [
                        'id' => $pdfResource->id,
                        'name' => $pdfResource->name,
                        'order' => $entry->order,
                    ];
                }
            }
        }

        // If no PDFs are associated, add the main budget PDF
        if (empty($this->pdfResources)) {
            $this->data['pdf_resources'][] = [
                'id' => 'main_budget_pdf',
                'name' => 'Presupuesto Principal',
                'order' => 0,
            ];
        }

        // Sort the pdfResources according to 'order'
        uasort($this->data['pdf_resources'], function ($a, $b) {
            return $a['order'] <=> $b['order'];
        });
    }


    //*--FIN DE METODOS DE MANIPULACION DE PDFS--*//



    //*--METODOS DE GUARDADO / ACTUALIZACIÓN DE PRESUPUESTO--*//

    public function saveBudget()
    {
  
        // Validate that at least one variable is added
        if (empty($this->data['items']) && !$this->data['add_private_variables']) {
            session()->flash('notification', [
                'message' => 'Debe agregar al menos una variable al presupuesto.',
                'type' => Notifications::icons('warning'),
            ]);
            return;
        }

        $this->validate();

        if ($this->data['budget_id']) {
            // Update existing budget
            $this->updateBudget();
        } else {
            // Create new budget
            $this->createBudget();
        }


        $pdfResourcesToAttach = [];
        foreach ($this->data['pdf_resources'] as $resource) {
            $pdfResourcesToAttach[$resource['id']] = [
                'order' => $resource['order'],
            ];
        }

        if (!empty($pdfResourcesToAttach)) {
            // Sync PDFs with the budget, including the budget PDF
            $this->lead->budget->pdfResources()->sync($pdfResourcesToAttach);
        }


        // Dispatch job to generate PDF
        $this->lead->budget->update(
        [
        'status' => StatusBudgetEnum::GENERATING->value,
        'progress' => 0
    
        ]);

        dispatch(new \App\Jobs\GenerateBudgetPdf($this->lead->budget->id));

        $this->generatingPdf = true;

        //Si el cliente no está cerrado, se cambia su estado a presupuestado
        if(!$this->closed){
            $this->lead->budget->customer->status = StatusCustomerEnum::BUDGETED->value;
        }

        $this->lead->budget->customer->save();
        
        $this->dispatch('update-status');

        $this->dispatch('updatedDataLeadAndStep', step: 6);

        // Provide feedback to the user
        session()->flash('notification', [
            'message' => 'Presupuesto guardado correctamente. El PDF se generará en breve.',
            'type' => Notifications::icons('success'),
        ]);
    }

    private function createBudget()
    {
        
      

        $this->lead->budget = Budget::create([
            'name' => $this->closed ? $this->name : 'Primer presupuesto',
            'total' => $this->data['subtotal'],
            'iva' => $this->data['iva'],
            'budgetems_private' => $this->data['add_private_variables'],
            'customer_id' => $this->lead->id,
            'business_id' => auth()->user()->business->id,

            'property_id' => $this->closed ? $this->propertyId : $this->lead->firstProperty->id,            

            'once_item_title' => $this->data['once_item_title'] ?? null,
        ]);

     

        $this->attachItemsToBudget();

        $this->data['budget_id'] = $this->lead->budget->id;

    
    }

    private function updateBudget()
    {
        // $this->budget = Budget::find($this->data['budget_id']);

        $this->lead->budget->update([
            'name' => $this->closed ? $this->name : 'Primer presupuesto',
            'total' => $this->data['subtotal'],
            'iva' => $this->data['iva'],
            'budgetems_private' => $this->data['add_private_variables'], 
            'once_item_title' => $this->data['once_item_title'] ?? null,
        ]);

        $this->attachItemsToBudget();
    }



    private function attachItemsToBudget()
    {
        // Eliminar relaciones existentes
        $this->lead->budget->budgetems()->detach();
        $this->lead->budget->products()->detach();


        $budgetemsToAttach = [];
        $productsToAttach = [];







        // Adjuntar variables y productos
        foreach ($this->data['items'] as $index => $item) {

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



        // Variables privadas
        if ($this->data['add_private_variables']) {
            foreach ($this->data['private_variables'] as $index => $variable) {
                $attachData = [
                    'quantity' => $variable['quantity'] ?? null,
                    'total' => $variable['subtotal'],
                    'value' => $variable['value'],
                    'visible_doc' => $variable['visible_doc'],
                    'private' => $variable['private'],
                    'order' => $index + count($this->data['items']),
                    'itemable_type' => Budgetem::class,
                ];

                $budgetemsToAttach[$variable['id']] = $attachData;
            }
        }

        // Adjuntar todos los items al presupuesto
        $this->lead->budget->budgetems()->syncWithoutDetaching($budgetemsToAttach);
        $this->lead->budget->products()->syncWithoutDetaching($productsToAttach);
    }



    public function checkProgress()
    {

        $this->progress = $this->lead->budget->progress;

        if ($this->lead->budget->status == StatusBudgetEnum::GENERATED->value) {
            $this->progress = 0;
            $this->lead->budget->update([
                'progress' => 0,
            ]);
        }

        if ($this->lead->budget->status == StatusBudgetEnum::ERROR->value) {
            $this->progress = 0;
            $this->lead->budget->update([
                'progress' => 0,
            ]);
        }
    }

    //*--FIN DE METODOS DE GUARDADO / ACTUALIZACIÓN DE PRESUPUESTO--*//

    public function render()
    {
        return view('livewire.panel.leads.form.budget-form-lead');
    }
}
