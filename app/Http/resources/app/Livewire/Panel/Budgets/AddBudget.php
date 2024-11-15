<?php

namespace App\Livewire\Panel\Budgets;

use App\Enums\TypeBudgetemEnum;
use App\Enums\StatusCustomerEnum;
use App\Helpers\Notifications;
use App\Models\Budget;
use App\Models\Budgetem;
use App\Models\BudgetTemplate;
use App\Models\Customer;
use App\Models\Lead;
use App\Models\PdfResource;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Traits\RedirectItemToPageTrait;

class AddBudget extends Component
{

    use RedirectItemToPageTrait;

    public Customer $lead;
    public Collection $budgetems; // Lista de variables presupuestarias disponibles (no privadas)
    public $privateBudgetems = []; // Lista de variables privadas
    public array $selectedBudgetemIds = []; // IDs de variables seleccionadas
    public array $budgetVariables = []; // Variables agregadas al presupuesto
    public array $budgetVariablesOrder = []; // Orden de las variables

    // Control para sumar variables privadas
    public bool $addPrivateVariables = false;
    public bool $iva = false;

    public float $subtotal = 0;
    public float $total = 0;

    public $openDrawer = false;

    // Variables para las plantillas
    public $selectedTemplate = null; // El valor seleccionado para la plantilla
    public Collection $templates; // Lista de plantillas de presupuesto disponibles

    public $pdfResources = [];


    public function mount(Customer $lead)
    {
        $this->lead = $lead;
        $this->loadBudgetems();
        $this->loadPrivateBudgetems();
        $this->loadTemplates(); // Cargar las plantillas de presupuesto

        $this->pdfResources = [
            [
                'id' => 'main_budget_pdf',
                'name' => 'Presupuesto Principal',
                'order' => 0,
            ],
        ];
    }


    public function loadTemplateVariables($templateId)
    {
        $template = BudgetTemplate::with('budgetems', 'pdfResources', 'privateBudgetems')->find($templateId);
        $this->selectedTemplate = $template;

        if ($template) {
            // Load budget variables
            $this->selectedBudgetemIds = $template->budgetems->pluck('id')->toArray();
            $this->syncBudgetVariablesFromTemplate($template);
            $this->syncBudgetPdfFromTemplate($template);
            $this->dispatch('update-selectedIds-values-budgetems', $this->selectedBudgetemIds);


            // $this->budgetVariables = $template->budgetems->map(function ($budgetem) {
            //     return $this->mapPivotVariable($budgetem);
            // })->toArray();


            // // Load private budget variables
            // if ($template->budgetems_private) {
            //     $this->addPrivateVariables = true;
            //     $this->privateBudgetems = $template->privateBudgetems->map(function ($budgetem) {
            //         return $this->mapPivotVariable($budgetem);
            //     })->toArray();
            // }

            // Emit event to child component to update PDFs
            $this->dispatch('loadTemplatePdfs', $this->pdfResources);
        } else {
            $this->resetForm();
        }
    }



    public function syncBudgetVariablesFromTemplate($template)
    {

        $this->budgetVariables = [];

        foreach ($template->budgetems as $budgetem) {
            $variableData = null;
            // Check if variable exists in pivot table
            $pivotVariable = Budgetem::firstWhere('id', $budgetem->id);

            if ($pivotVariable) {
                $variableData = $this->mapPivotVariable($budgetem);
            } else {
                $variableData = $this->mapCurrentVariable($pivotVariable);
            }

            $this->budgetVariables[] = $variableData;
        }

        // Update the order of the variables
        $this->budgetVariablesOrder = array_column($this->budgetVariables, 'id');

        $this->calculateTotals();
    }



    public function syncBudgetPdfFromTemplate($template)
    {

        // Load PDFs
        $this->pdfResources = [];

        // Get PDFs associated with the template, including the main budget PDF
        $pivotEntries = DB::table('budget_pdf_resource')
            ->where('budgetable_id', $template->id)
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

        // If no PDFs are associated, add the main budget PDF
        if (empty($this->pdfResources)) {
            $this->pdfResources[] = [
                'id' => 'main_budget_pdf',
                'name' => 'Presupuesto Principal',
                'order' => 0,
            ];
        }

        // Sort the pdfResources according to 'order'
        usort($this->pdfResources, function ($a, $b) {
            return $a['order'] <=> $b['order'];
        });
    }



    private function mapPivotVariable($budgetem)
    {
        //dd($budgetem);
        return [
            'id' => $budgetem->id,
            'name' => $budgetem->name,
            'type' => $budgetem->type,
            'type_name' => TypeBudgetemEnum::from($budgetem['type'])->getName(),
            'private' => $budgetem->pivot->private,
            'visible_doc' => $budgetem->pivot->visible_doc,
            'operator' => $budgetem->operator,
            'value' => $budgetem->value,
            'quantity' => $budgetem->pivot->quantity,
            'min' => $budgetem->min,
            'max' => $budgetem->max,
            'subtotal' => null,
            'type_badge' => TypeBudgetemEnum::from($budgetem['type'])->getBadgeClasses(),
            'order' => $budgetem->pivot->order ?? 0, // Incluir el orden
        ];
    }

    private function mapCurrentVariable($budgetem)
    {
        $quantity = null;
        switch ($budgetem->type) {
            case 'percentage':
                $quantity = $budgetem->default_quantity ?? $budgetem->value;
                break;
            case 'countable':
                $quantity = $budgetem->default_quantity ?? 1;
                break;
            case 'fixed':
                $quantity = null;
                break;
        }

        return [
            'id' => $budgetem->id,
            'name' => $budgetem->name,
            'type' => $budgetem->type->value,
            'type_name' => $budgetem->type->getName(),
            'private' => $budgetem->private,
            'visible_doc' => $budgetem->visible_doc,
            'operator' => $budgetem->operator,
            'value' => $budgetem->value,
            'quantity' => $quantity,
            'min' => $budgetem->min,
            'max' => $budgetem->max,
            'subtotal' => 0, // Se recalculará
            'type_badge' => $budgetem->type->getBadgeClasses(),
            'order' => $budgetem->order ?? 0, // Asignar orden, predeterminado 0 si no existe
        ];
    }

    // Cargar plantillas de presupuesto
    public function loadTemplates()
    {
        $this->templates = BudgetTemplate::where('business_id', auth()->user()->business_id)->get();
    }

    // Cuando se selecciona una plantilla (evento del SelectGeneral)
    #[On('update-selected-value-template')]
    public function updatedSelectedTemplate($template)
    {

        if ($template) {
            $this->loadTemplateVariables($template);
        } else {
            $this->resetForm();
        }
    }


    public function resetForm()
    {
        $this->selectedBudgetemIds = [];
        $this->budgetVariables = [];
        $this->subtotal = 0;
        $this->total = 0;
        $this->selectedTemplate = null;
        $this->pdfResources = [
            [
                'id' => 'main_budget_pdf',
                'name' => 'Presupuesto Principal',
                'order' => 0,
            ],
        ];


        $this->dispatch('update-selectedIds-values-budgetems', null);

        $this->dispatch('loadTemplatePdfs', $this->pdfResources);
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
                    'type_name' =>  $budgetem->type->getName(),
                    'type_badge' =>  $budgetem->type->getBadgeClasses(),
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

    #[On('update-checked')]
    public function updatedAddPrivateVariables($value)
    {
        $this->addPrivateVariables = $value;
        $this->calculateTotals();
    }

    public function updatedIva()
    {

        $this->calculateTotals();
    }

    #[On('update-selected-values-budgetems')]
    public function updateSelectedBudgetems($selectedValues)
    {
        if ($selectedValues) {
            $this->selectedBudgetemIds = array_column($selectedValues, 'id');
        } else {
            $this->selectedBudgetemIds = [];
        }

        // dd($selectedValues);

        $this->syncBudgetVariables();
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
        // Remove variables that are no longer selected
        $this->budgetVariables = array_filter($this->budgetVariables, function ($variable) {
            return in_array($variable['id'], $this->selectedBudgetemIds);
        });




        // Reindex array
        $this->budgetVariables = array_values($this->budgetVariables);

        // dd($this->selectedBudgetemIds);
        // Add new variables
        // dump($this->selectedTemplate);



        foreach ($this->selectedBudgetemIds as $budgetemId) {
            if (!collect($this->budgetVariables)->pluck('id')->contains($budgetemId)) {


                $budgetem = $this->selectedTemplate ? $this->selectedTemplate->budgetems->firstWhere('id', $budgetemId) : null;

                if ($this->selectedTemplate && $budgetem) {
                    $variableData = $this->mapPivotVariable($budgetem);
                } else {
                    // Check if variable exists in pivot table
                    $budgetem = $this->budgetems->firstWhere('id', $budgetemId);
                    //dump($budgetem, 'default');
                    $variableData = $this->mapCurrentVariable($budgetem);
                }
                $this->budgetVariables[] = $variableData;
            }
        }

        // Update the order of the variables
        $this->budgetVariablesOrder = array_column($this->budgetVariables, 'id');

        $this->calculateTotals();
    }


    public function removeVariable($index)
    {
        $variableId = $this->budgetVariables[$index]['id'];
        unset($this->budgetVariables[$index]);
        $this->budgetVariables = array_values($this->budgetVariables); // Reindexar array

        // Eliminar de selectedBudgetemIds
        if (($key = array_search($variableId, $this->selectedBudgetemIds)) !== false) {
            unset($this->selectedBudgetemIds[$key]);
            $this->selectedBudgetemIds = array_values($this->selectedBudgetemIds);
        }

        // Actualizar el componente MultiSelectGeneral
        $this->dispatch('dispatch-selected-values-budgetems', $variableId);

        $this->calculateTotals();
    }

    public function getSelectedBudgetemsForDispatch()
    {
        return $this->budgetems->whereIn('id', $this->selectedBudgetemIds)->map(function ($budgetem) {
            return [
                'id' => $budgetem->id,
                'name' => $budgetem->name,
            ];
        })->toArray();
    }

    public function updatedBudgetVariables()
    {

        $this->applyConstraints();
        $this->calculateTotals();
    }

    public function applyConstraints()
    {

        foreach ($this->budgetVariables as &$variable) {

            $min = $variable['min'];
            $max = $variable['max'];
            switch ($variable['type']) {
                case 'percentage':
                    // 'cantidad' representa el porcentaje
                    if ($variable['quantity'] < $min) {
                        $variable['quantity'] = $min;
                    } elseif ($variable['quantity'] > $max) {
                        $variable['quantity'] = $max;
                    }
                    break;
                case 'countable':

                    //

                    // 'cantidad' está restringida por min y max
                    if ($variable['quantity'] < $min) {
                        $variable['quantity'] = $min;
                    } elseif ($variable['quantity'] > $max) {
                        $variable['quantity'] = $max;
                    }
                    break;
                case 'fixed':
                    // No hay restricciones
                    break;
            }
        }
    }


    public function calculateTotals()
    {
        $this->subtotal = 0;
        $this->total = 0;

        $accumulatedSubtotal = 0;


        $dataPublic = $this->sumBudgetems($accumulatedSubtotal, $this->budgetVariables);
        $accumulatedSubtotal = $dataPublic[0];
        $this->budgetVariables = $dataPublic[1];




        // Sumar variables privadas si el toggle está activado
        if ($this->addPrivateVariables) {
            $dataPrivate = $this->sumBudgetems($accumulatedSubtotal, $this->privateBudgetems);
            $accumulatedSubtotal = $dataPrivate[0];
            $this->privateBudgetems = $dataPrivate[1];
        }

        // Actualizar el subtotal acumulado
        $this->subtotal = $accumulatedSubtotal;

        // Incluir IVA si corresponde (booleano iva)
        if ($this->iva) {
            $this->total = $this->subtotal * 1.21; // Sumar 21% de IVA
        } else {
            $this->total = $this->subtotal;
        }
    }

    public function sumBudgetems($accumulatedSubtotal, $budgetems)
    {

        // dump($budgetems);
        foreach ($budgetems as &$budgetem) {
            $type = $budgetem['type'];   // Booleano que indica si se debe sumar/restar al presupuesto
            $operator = $budgetem['operator']; // Operador de suma/resta
            $subtotal = 0;

            // Calcular el subtotal de la variable privada
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
            // Si el operador es true, se suma al subtotal; si es false, se resta
            if ($operator) {
                $accumulatedSubtotal += $subtotal;
            } else {
                $accumulatedSubtotal -= $subtotal;
            }
        }

        unset($budgetem);

        return [$accumulatedSubtotal, $budgetems];
    }

    public function sortBudgetVariables($variableId, $newPosition)
    {
        // Encontrar el índice actual de la variable
        $currentIndex = array_search($variableId, array_column($this->budgetVariables, 'id'));

        // Verificar si el índice existe
        if ($currentIndex === false) {
            return; // Si no se encuentra el índice, salir de la función
        }

        // Sacar la variable del array
        $variable = $this->budgetVariables[$currentIndex];
        unset($this->budgetVariables[$currentIndex]);

        // Reindexar el array después de quitar el elemento
        $this->budgetVariables = array_values($this->budgetVariables);

        // Insertar la variable en la nueva posición
        array_splice($this->budgetVariables, $newPosition, 0, [$variable]);


        // Reindexar nuevamente para evitar huecos o errores en los índices
        $this->budgetVariables = array_values($this->budgetVariables);

        // Actualizar el orden de las variables
        $this->budgetVariablesOrder = array_column($this->budgetVariables, 'id');

        // Recalcular los totales
        $this->calculateTotals();
    }

    public function saveBudget()
    {

        // dd($this->budgetVariables);
        // Validar que haya al menos una variable en el presupuesto
        if (empty($this->budgetVariables) && !$this->addPrivateVariables) {
            session()->flash('notification', [
                'message' => 'Debe agregar al menos una variable al presupuesto.',
                'type' => Notifications::icons('warning'),
            ]);
            return;
        }

        // Crear presupuesto
        $budget = Budget::create([
            'id' => Str::uuid(),
            'name' => 'Presupuesto para ' . $this->lead->full_name,
            'total' => $this->subtotal,
            'iva' => $this->iva,
            'budgetems_private' => $this->addPrivateVariables,
            'customer_id' => $this->lead->id,
            'business_id' => auth()->user()->business->id,
        ]);

        // Asociar variables al presupuesto
        foreach ($this->budgetVariables as $index => $variable) {
            $budget->budgetems()->attach($variable['id'], [
                'quantity' => $variable['quantity'] ?? null,
                'total' => $variable['subtotal'],
                'value' => $variable['value'],
                'visible_doc' => $variable['visible_doc'],
                'private' => $variable['private'],
                'order' => $index,
            ]);
        }





        // Asociar variables privadas al presupuesto
        if ($this->addPrivateVariables) {
            foreach ($this->privateBudgetems as $index => $privateVariable) {

                //dd($privateVariable);
                $budget->budgetems()->attach($privateVariable['id'], [
                    'quantity' => $privateVariable['default_quantity'] ?? null,
                    'total' => $privateVariable['subtotal'], // O el subtotal calculado
                    'value' => $privateVariable['value'],
                    'visible_doc' => $privateVariable['visible_doc'],
                    'private' => $privateVariable['private'],
                    'order' => $index
                ]);
            }

            // dd($budget->budgetems);
        }

        // dd($budget->budgetems);

        // Actualizar estado del lead a 'Presupuestado'
        $this->lead->status = StatusCustomerEnum::BUDGETED->value;
        $this->lead->save();


        // Asociar los PDFs seleccionados al presupuesto
        // $pdfResourcesToAttach = [];
        // foreach ($this->pdfResources as $resource) {
        //     if ($resource['id'] != 'main_budget_pdf') {
        //         $pdfResourcesToAttach[$resource['id']] = [
        //             'order' => $resource['order'],
        //         ];
        //     }
        // }

        // if (!empty($pdfResourcesToAttach)) {
        //     $budget->pdfResources()->sync($pdfResourcesToAttach);
        // }

        $pdfResourcesToAttach = [];
        foreach ($this->pdfResources as $resource) {
            $pdfResourcesToAttach[$resource['id']] = [
                'order' => $resource['order'],
            ];
        }

        if (!empty($pdfResourcesToAttach)) {
            // Sync PDFs with the budget, including the budget PDF
            $budget->pdfResources()->sync($pdfResourcesToAttach);
        }

        // Marcar el cliente como generando PDF
        $budget->update([
            'generating_pdf' => 1,
        ]);



        dispatch(new \App\Jobs\GenerateBudgetPdf($budget->id));


        // Redirigir a la lista de leads con mensaje de éxito
        session()->flash('notification', [
            'message' => 'Presupuesto creado correctamente. El PDF se generará en breve.',
            'type' => Notifications::icons('success'),
        ]);


        return $this->redirectToCustomerPage($this->lead->id);
    }


    



    #[On('updatePdfResources')]
    public function updatePdfResources($pdfResources)
    {
        $this->pdfResources = $pdfResources;
    }


    #[On('update-checked-toggle-id')]
    public function updateVisibleDocToggle($value, $id)
    {

        // Si se encuentra el usuario, cambiar su estado
        if ($id) {
            // Alternar el estado entre 1 y 0
            $this->budgetVariables[$id]['visible_doc'] = $value;
        }
    }


    public function render()
    {
        return view('livewire.panel.budgets.add-budget')
            ->layout('layouts.panel', ['title' => 'Crear Presupuesto']);
    }
}
