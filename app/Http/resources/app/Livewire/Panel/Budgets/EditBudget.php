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
use App\Models\Template;
use Database\Seeders\TemplatesSeeder;
use Illuminate\Container\Attributes\DB;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB as FacadesDB;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\Attributes\On;

class EditBudget extends Component
{

    public ?Customer $lead;

    public $openDrawer = false;

    public Budget $budget;

    public Collection $budgetems; // Public variables from budgetems table
    public Collection $privateBudgetems; // Private variables from budgetems table
    public array $selectedBudgetemIds = []; // IDs of selected public variables
    public array $budgetVariables = []; // Public variables in the budget
    public array $privateVariables = []; // Private variables in the budget
    public bool $addPrivateVariables = false; // Toggle for private variables
    public bool $updateBudget = false; // Toggle for updating budget
    public bool $iva; // Include IVA
    public float $subtotal = 0;
    public float $total = 0;




    public $selectedTemplate = null; // Selected template
    public Collection $templates; // Available templates
    public Template $template;


    public array $budgetVariablesOrder = []; // Order of the variables


    public $pdfResources = []; // Available PDF resources
    public $orderedPdfResources = []; // Ordered PDF resources

    public function mount()
    {

        $this->budget = $this->lead->budget()->with('budgetems')->firstOrFail();
        $this->iva = $this->budget->iva;
        $this->addPrivateVariables = $this->budget->budgetems_private;

        $this->loadBudgetems();
        $this->loadTemplates();
        $this->initializeVariables();
        $this->loadEntryPdfs();
    }




    public function loadBudgetems()
    {
        $this->budgetems = Budgetem::where('business_id', auth()->user()->business_id)
            ->where('private', false)
            ->get();

        $this->privateBudgetems = Budgetem::where('business_id', auth()->user()->business_id)
            ->where('private', true)
            ->get();
    }


    public function loadEntryPdfs()
    {

        $this->pdfResources = [];

        // Load existing PDFs associated with the budget
        $pivotEntries = FacadesDB::table('budget_pdf_resource')
            ->where('budgetable_id', $this->budget->id)
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




    #[On('updatePdfResources')]
    public function updatePdfResources($pdfResources)
    {
        $this->pdfResources = $pdfResources;
    }



    public function loadTemplates()
    {
        $this->templates = BudgetTemplate::where('business_id', auth()->user()->business_id)->get();
    }

    public function initializeVariables()
    {
        // Public variables from the pivot table
        $this->budgetVariables = $this->budget->publicBudgetems->map(function ($budgetem) {
            return $this->mapPivotVariable($budgetem);
        })->toArray();

        $this->selectedBudgetemIds = array_column($this->budgetVariables, 'id');

        // Private variables from the pivot table
        if ($this->addPrivateVariables) {
            $this->privateVariables = $this->budget->privateBudgetems->map(function ($budgetem) {
                return $this->mapPivotVariable($budgetem);
            })->toArray();
        }


        // Initialize the order of variables
        $this->budgetVariablesOrder = array_column($this->budgetVariables, 'id');

        $this->calculateTotals();
    }

    private function mapPivotVariable($budgetem)
    {
        return [
            'id' => $budgetem->id,
            'name' => $budgetem->name,
            'type' => $budgetem->type->value,
            'type_name' => $budgetem->type->getName(),
            'private' => $budgetem->pivot->private,
            'visible_doc' => $budgetem->pivot->visible_doc,
            'operator' => $budgetem->operator,
            'value' => $budgetem->pivot->value,
            'cantidad' => $budgetem->pivot->quantity,
            'min' => $budgetem->min,
            'max' => $budgetem->max,
            'subtotal' => $budgetem->pivot->total,
            'type_badge' => TypeBudgetemEnum::from($budgetem['type'])->getBadgeClasses(),
            'order' => $budgetem->pivot->order ?? 0, // Incluir el orden
        ];
    }


    #[On('update-checked')]
    public function updatedAddPrivateVariables($value)
    {
        $this->addPrivateVariables = $value;

        if ($value) {
            // Cargar todas las variables privadas disponibles
            $this->privateVariables = $this->privateBudgetems->map(function ($budgetem) {
                if ($this->updateBudget) {
                    // Si el toggle de actualizar presupuesto está activado, usamos los valores actuales
                    return $this->mapCurrentVariable($budgetem);
                } else {
                    // Verificar si la variable existe en la tabla pivote
                    $pivotVariable = $this->budget->budgetems->firstWhere('id', $budgetem->id);
                    if ($pivotVariable) {
                        return $this->mapPivotVariable($pivotVariable);
                    } else {
                        return $this->mapCurrentVariable($budgetem);
                    }
                }
            })->toArray();
        } else {
            // Eliminar variables privadas de los cálculos
            $this->privateVariables = [];
        }

        $this->calculateTotals();
    }

    #[On('update-checked-budgets')]
    public function updatedUpdateBudget($value)
    {

        $this->updateBudget = $value;

        if ($value) {
            $this->loadBudgetems();
            $this->updateVariablesToCurrentValues();
        } else {

            $this->resetToInitialState();
        }

        $this->calculateTotals();
    }

    public function updateVariablesToCurrentValues()
    {
        // Update public variables
        foreach ($this->budgetVariables as &$variable) {
            $currentBudgetem = $this->budgetems->firstWhere('id', $variable['id']);
            if ($currentBudgetem) {
                $variable = $this->mapCurrentVariable($currentBudgetem);
            }
        }

        // Update private variables
        foreach ($this->privateVariables as &$variable) {
            $currentBudgetem = $this->privateBudgetems->firstWhere('id', $variable['id']);
            if ($currentBudgetem) {
                $variable = $this->mapCurrentVariable($currentBudgetem);
            }
        }
    }

    private function mapCurrentVariable($budgetem)
    {
        $cantidad = null;
        switch ($budgetem->type) {
            case 'percentage':
                $cantidad = $budgetem->default_quantity ?? $budgetem->value;
                break;
            case 'countable':
                $cantidad = $budgetem->default_quantity ?? 1;
                break;
            case 'fixed':
                $cantidad = null;
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
            'cantidad' => $cantidad,
            'min' => $budgetem->min,
            'max' => $budgetem->max,
            'subtotal' => 0, // Se recalculará
            'type_badge' => TypeBudgetemEnum::from($budgetem['type'])->getBadgeClasses(),
            'order' => $budgetem->order ?? 0, // Asignar orden, predeterminado 0 si no existe
        ];
    }

    #[On('update-selected-values-budgetems')]
    public function updateSelectedBudgetems($selectedValues)
    {

        $this->selectedBudgetemIds = array_column($selectedValues, 'id');
        $this->syncBudgetVariables();
    }



    public function syncBudgetVariables()
    {
        // Remove variables that are no longer selected
        $this->budgetVariables = array_filter($this->budgetVariables, function ($variable) {
            return in_array($variable['id'], $this->selectedBudgetemIds);
        });

        // Reindex array
        $this->budgetVariables = array_values($this->budgetVariables);

        // dump($this->selectedBudgetemIds);
        // Add new variables
        foreach ($this->selectedBudgetemIds as $budgetemId) {
            if (!collect($this->budgetVariables)->pluck('id')->contains($budgetemId)) {

                // $budgetem = $this->budgetems->firstWhere('id', $budgetemId);

                $budgetem = $this->template? $this->selectedTemplate->budgetems->firstWhere('id', $budgetemId) : null;

                if ($budgetem && $this->template&& $this->updateBudget) {
                    $variableData = $this->mapCurrentVariable($budgetem);
                } elseif ($budgetem && $this->selectedTemplate) {
                    $variableData = $this->mapPivotVariable($budgetem);
                } else {
                    $budgetem = $this->budgetems->firstWhere('id', $budgetemId);
                    $variableData = $this->mapCurrentVariable($budgetem);
                }
                $this->budgetVariables[] = $variableData;
            }
        }

        // Update the order of the variables
        $this->budgetVariablesOrder = array_column($this->budgetVariables, 'id');

        $this->calculateTotals();
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
                    if ($variable['cantidad'] < $min) {
                        $variable['cantidad'] = $min;
                    } elseif ($variable['cantidad'] > $max) {
                        $variable['cantidad'] = $max;
                    }
                    break;
                case 'countable':
                    if ($variable['cantidad'] < $min) {
                        $variable['cantidad'] = $min;
                    } elseif ($variable['cantidad'] > $max) {
                        $variable['cantidad'] = $max;
                    }
                    break;
                case 'fixed':
                    // No constraints
                    break;
            }
        }
        foreach ($this->privateVariables as &$variable) {
            $min = $variable['min'];
            $max = $variable['max'];
            switch ($variable['type']) {
                case 'percentage':
                    if ($variable['cantidad'] < $min) {
                        $variable['cantidad'] = $min;
                    } elseif ($variable['cantidad'] > $max) {
                        $variable['cantidad'] = $max;
                    }
                    break;
                case 'countable':
                    if ($variable['cantidad'] < $min) {
                        $variable['cantidad'] = $min;
                    } elseif ($variable['cantidad'] > $max) {
                        $variable['cantidad'] = $max;
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

        // Combinar variables públicas y privadas
        $allVariables = $this->budgetVariables;

        if ($this->addPrivateVariables) {
            $allVariables = array_merge($allVariables, $this->privateVariables);
        }

        // Ordenar todas las variables según su propiedad 'order'
        usort($allVariables, function ($a, $b) {
            return ($a['order'] ?? 0) <=> ($b['order'] ?? 0);
        });
        

        // Procesar todas las variables en orden
        list($accumulatedSubtotal, $allVariables) = $this->sumBudgetems($accumulatedSubtotal, $allVariables);

        
        // Actualizar las variables públicas con los nuevos subtotales
        $this->budgetVariables = array_filter($allVariables, function ($variable) {
            return !$variable['private']; // Solo variables públicas
        });

        // Reindexar el array de variables públicas
        $this->budgetVariables = array_values($this->budgetVariables);

        // No es necesario mantener las variables privadas separadas si no se muestran en la vista

        // Actualizar el subtotal acumulado
        $this->subtotal = $accumulatedSubtotal;

      
        // Incluir IVA si corresponde
        if ($this->iva) {
            $this->total = $this->subtotal * 1.21; // Sumar 21% de IVA
        } else {
            $this->total = $this->subtotal;
        }
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
                    $cantidad = $budgetem['cantidad'] ?? 1;
                    $valor = $budgetem['value'];
                    $subtotal = $cantidad * $valor;
                    $budgetem['subtotal'] = $subtotal;
                    break;
                case 'percentage':
                    $cantidad = $budgetem['cantidad'] ?? $budgetem['value'];
                    $percentage = $cantidad / 100;
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



    public function removeVariable($index)
    {
        $variableId = $this->budgetVariables[$index]['id'];
        unset($this->budgetVariables[$index]);
        $this->budgetVariables = array_values($this->budgetVariables); // Reindex array

        // Remove from selectedBudgetemIds
        if (($key = array_search($variableId, $this->selectedBudgetemIds)) !== false) {
            unset($this->selectedBudgetemIds[$key]);
            $this->selectedBudgetemIds = array_values($this->selectedBudgetemIds);
        }

        // Update the MultiSelectGeneral component
        $this->dispatch('dispatch-selected-values-budgetems', $variableId);

        $this->calculateTotals();
    }

    public function updatedIva()
    {
        $this->calculateTotals();
    }

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

        $this->template = BudgetTemplate::with('budgetems', 'pdfResources')->find($templateId);
        $this->selectedTemplate = $templateId;

        if ($this->template) {

            //Template variables
            $this->selectedBudgetemIds = $this->template->budgetems->pluck('id')->toArray();
            $this->syncBudgetVariablesFromTemplate($this->template);
            $this->dispatch('update-selectedIds-values-budgetems', $this->selectedBudgetemIds);

            //Template PDFs

            $this->syncBudgetPdfFromTemplate($this->template);



            $this->dispatch('loadTemplatePdfs', $this->pdfResources);
        }
    }

    public function syncBudgetVariablesFromTemplate($template)
    {
        $this->budgetVariables = [];

        foreach ($template->budgetems as $budgetem) {
            $variableData = null;

            if ($this->updateBudget) {
                $variableData = $this->mapCurrentVariable($budgetem);
            } else {
                // Check if variable exists in pivot table
                // $pivotVariable = $this->budget->budgetems->firstWhere('id', $budgetem->id);

                //La variable del template, existe en el presupuesto actual?
                $budgetemDefault = Budgetem::firstWhere('id', $budgetem->id);

                //Si existe, se mapea la variable actual
                if ($budgetemDefault) {
                    $variableData = $this->mapPivotVariable($budgetem);
                    //Si no existe, se mapea la variable del template
                } else {
                    $variableData = $this->mapCurrentVariable($budgetemDefault);
                }
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
        $pivotEntries = FacadesDB::table('budget_pdf_resource')
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


    public function sortBudgetVariables($variableId, $newPosition)
    {
        $currentIndex = array_search($variableId, array_column($this->budgetVariables, 'id'));

        if ($currentIndex !== false) {
            $variable = $this->budgetVariables[$currentIndex];
            unset($this->budgetVariables[$currentIndex]);
            $this->budgetVariables = array_values($this->budgetVariables);
            array_splice($this->budgetVariables, $newPosition, 0, [$variable]);
            $this->budgetVariables = array_values($this->budgetVariables);

            // Actualizar el orden de las variables
            foreach ($this->budgetVariables as $index => &$variable) {
                $variable['order'] = $index;
            }
            unset($variable);

            $this->calculateTotals();
        }
    }



    public function update()
    {
        
        // Validar que haya al menos una variable en el presupuesto
        if (empty($this->budgetVariables) && !$this->addPrivateVariables) {
            session()->flash('notification', [
                'message' => 'Debe agregar al menos una variable al presupuesto.',
                'type' => Notifications::icons('warning'),
            ]);
            return;
        }

        // Actualizar el presupuesto
        $this->budget->update([
            'total' => $this->subtotal,
            'iva' => $this->iva,
            'budgetems_private' => $this->addPrivateVariables,
        ]);

        // Asociar variables públicas al presupuesto
        $publicVariables = [];
        foreach ($this->budgetVariables as $index => $variable) {
            $publicVariables[$variable['id']] = [
                'quantity' => $variable['cantidad'] ?? null,
                'total' => $variable['subtotal'],
                'value' => $variable['value'],
                'visible_doc' => $variable['visible_doc'],
                'private' => $variable['private'],
                'order' => $index,
            ];
        }

        // Asociar variables privadas al presupuesto si el toggle está activado
        $privateVariables = [];
        if ($this->addPrivateVariables) {
            foreach ($this->privateBudgetems as $index => $privateVariable) {
                $privateVariables[$privateVariable['id']] = [
                    'quantity' => $privateVariable['default_quantity'] ?? null,
                    'total' => $privateVariable['subtotal'], // O el subtotal calculado
                    'value' => $privateVariable['value'],
                    'visible_doc' => $privateVariable['visible_doc'],
                    'private' => $privateVariable['private'],
                    'order' => $index + count($publicVariables),
                ];
            }
        }

        // Sincronizar todas las variables en la tabla pivote
        $this->budget->budgetems()->sync($publicVariables + $privateVariables);


        // Prepare data to sync PDFs including the budget PDF
        $pdfResourcesToAttach = [];
        foreach ($this->pdfResources as $resource) {
            $pdfResourcesToAttach[$resource['id']] = [
                'order' => $resource['order'],
            ];
        }

        if (!empty($pdfResourcesToAttach)) {
            // Sync PDFs with the budget, including the budget PDF
            $this->budget->pdfResources()->sync($pdfResourcesToAttach);
        }



        // Marcar el cliente como generando PDF
        $this->budget->update([
            'generating_pdf' => 1,
        ]);



        dispatch(new \App\Jobs\GenerateBudgetPdf($this->budget->id));



        // Redirigir a la lista de leads con mensaje de éxito
        session()->flash('notification', [
            'message' => 'Presupuesto actualizado correctamente. El PDF se generará en breve.',
            'type' => Notifications::icons('success'),
        ]);


        
        return $this->redirectToCustomerPage($this->lead->id);

        // return redirect()->route('panel.leads.list');
    }


    public function resetToInitialState()
    {
        $this->updateBudget = false;
        $this->addPrivateVariables = $this->budget->budgetems_private;

        // Cargar las variables de presupuesto originales desde la tabla pivote
        $this->selectedBudgetemIds = [];

        $this->initializeVariables();

        $this->selectedTemplate = null;

        $this->template = null;



        // Actualizar el multiselect para reflejar las variables seleccionadas
        $this->dispatch('update-selectedIds-values-budgetems', $this->selectedBudgetemIds);

        // $this->dispatch('update-selected-value-template', null);

        $this->loadEntryPdfs();
        // Asegurarse de que todas las variables están disponibles en el multiselect
        $this->dispatch('offTemplatePdfs', $this->pdfResources);

        $this->loadBudgetems();

        // Recalcular los totales
        $this->calculateTotals();
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
        return view('livewire.panel.budgets.edit-budget')
            ->layout('layouts.panel', ['title' => 'Editar presupuesto']);
    }
}
