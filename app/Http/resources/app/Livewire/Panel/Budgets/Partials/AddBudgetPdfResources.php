<?php

namespace App\Livewire\Panel\Budgets\Partials;

use App\Models\PdfResource;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;

class AddBudgetPdfResources extends Component
{

    public $pdfResources; // Todas las opciones disponibles
    public $selectedPdfResources = []; // IDs de los PDFs seleccionados
    public $orderedPdfResources = []; // PDFs seleccionados y ordenados
    public $model; //Puede ser Budget o BudgetTemplate

    public function mount()
    {
        // Cargar todos los recursos PDF disponibles
        $this->pdfResources = PdfResource::where('business_id', auth()->user()->business_id)->get()->toArray();

        // Include the main budget PDF
        $this->orderedPdfResources = [];

        if ($this->model) {
            $this->loadSelectedPdfResources();
        } else {
            // New budget, add main budget PDF
            $this->orderedPdfResources[] = [
                'id' => 'main_budget_pdf',
                'name' => 'Presupuesto Principal',
                'order' => 0,
            ];
        }
    }


    public function loadSelectedPdfResources()
    {
      
        // Get PDFs associated with the budget, including the main budget PDF
        $pivotEntries = DB::table('budget_pdf_resource')
            ->where('budgetable_id', $this->model->id)
            ->orderBy('order')
            ->get();

        

        foreach ($pivotEntries as $entry) {
            if ($entry->pdf_resource_id === 'main_budget_pdf') {
                $this->orderedPdfResources[] = [
                    'id' => 'main_budget_pdf',
                    'name' => 'Presupuesto Principal',
                    'order' => $entry->order,
                ];
            } else {
                $pdfResource = PdfResource::find($entry->pdf_resource_id);
                if ($pdfResource) {
                    $this->orderedPdfResources[] = [
                        'id' => $pdfResource->id,
                        'name' => $pdfResource->name,
                        'order' => $entry->order,
                    ];
                    $this->selectedPdfResources[] = $pdfResource->id;
                }
            }
        }

        // Sort the ordered PDFs
        usort($this->orderedPdfResources, function ($a, $b) {
            return $a['order'] <=> $b['order'];
        });
    }





    #[On('update-selected-values-pdf_resources')]
    public function updatedSelectedPdfResources($values)
    {



        $this->selectedPdfResources = collect($values)->pluck('id')->toArray();


        // Actualizar la lista ordenada cuando cambian las selecciones
        $this->syncOrderedPdfResources();

        $this->dispatch('updatePdfResources', $this->orderedPdfResources);
    }


    public function syncOrderedPdfResources()
    {
        // Get IDs of currently ordered PDFs
        $existingPdfIds = array_column($this->orderedPdfResources, 'id');
    
        //dd($existingPdfIds);
        // Find newly selected PDFs
        $newPdfIds = array_diff($this->selectedPdfResources, $existingPdfIds);
    
       // dd($newPdfIds);
        // Find PDFs that have been unselected
        $unselectedPdfIds = array_diff($existingPdfIds, $this->selectedPdfResources);
    
       // dd($unselectedPdfIds);

        // Remove unselected PDFs from orderedPdfResources, but do not remove 'main_budget_pdf'
        $this->orderedPdfResources = array_filter($this->orderedPdfResources, function ($resource) use ($unselectedPdfIds) {
            if ($resource['id'] === 'main_budget_pdf') {
                return true; // Keep the main budget PDF
            }
            return !in_array($resource['id'], $unselectedPdfIds);
        });

   
    
        // Reindex orderedPdfResources
        $this->orderedPdfResources = array_values($this->orderedPdfResources);
    
        // Add new PDFs at the end
        foreach ($newPdfIds as $pdfResourceId) {
            // Skip if it's the main budget PDF (already included)
            if ($pdfResourceId === 'main_budget_pdf') {
                continue;
            }
    
            $resource = collect($this->pdfResources)->firstWhere('id', $pdfResourceId);
    
            if ($resource) {
                $this->orderedPdfResources[] = [
                    'id' => $resource['id'],
                    'name' => $resource['name'],
                    // Assign a temporary order; will reassign later
                    'order' => null,
                ];
            }
        }
    
        // Reassign order values sequentially
        foreach ($this->orderedPdfResources as $index => &$resource) {
            $resource['order'] = $index;
        }
        unset($resource);
    
        // Ensure "Presupuesto principal" is first if required
        foreach ($this->orderedPdfResources as $index => &$resource) {
            if ($resource['id'] === 'main_budget_pdf' && $index !== 0) {
                // Remove from current position
                array_splice($this->orderedPdfResources, $index, 1);
                // Add at the beginning
                array_unshift($this->orderedPdfResources, $resource);
                break;
            }
        }
        unset($resource);
    
        // Reassign order values again after rearrangement
        foreach ($this->orderedPdfResources as $index => &$resource) {
            $resource['order'] = $index;
        }
        unset($resource);
    
        // Emit the updated PDFs to the parent component
        $this->dispatch('updatePdfResources', $this->orderedPdfResources);
    }
    

    public function sortOrderedPdfResources($resourceId, $newPosition)
    {
        // Encontrar el índice actual del recurso
        $currentIndex = array_search($resourceId, array_column($this->orderedPdfResources, 'id'));

        if ($currentIndex !== false) {
            $resource = $this->orderedPdfResources[$currentIndex];
            unset($this->orderedPdfResources[$currentIndex]);
            $this->orderedPdfResources = array_values($this->orderedPdfResources);
            array_splice($this->orderedPdfResources, $newPosition, 0, [$resource]);
            $this->orderedPdfResources = array_values($this->orderedPdfResources);

            // Actualizar el orden
            foreach ($this->orderedPdfResources as $index => &$resource) {
                $resource['order'] = $index;
            }
            unset($resource);
        }
        $this->dispatch('updatePdfResources', $this->orderedPdfResources);
        // dd($this->orderedPdfResources);
    }

    #[On('loadTemplatePdfs')]
    public function onLoadTemplatePdfs($pdfResources)
    {


        $this->selectedPdfResources = collect($pdfResources)->pluck('id')->toArray();

        $this->dispatch('update-selectedIds-values-pdf_resources',  $this->selectedPdfResources);


        $this->orderedPdfResources = $pdfResources;
    }






    #[On('offTemplatePdfs')]
    public function offLoadTemplatePdfs($pdfResources)
    {
     

        $this->selectedPdfResources = collect($pdfResources)->pluck('id')->toArray();

        $this->dispatch('update-selectedIds-values-pdf_resources',  $this->selectedPdfResources);

        $this->orderedPdfResources = $pdfResources;

    }


    public function render()
    {
        return view('livewire.panel.budgets.partials.add-budget-pdf-resources');
    }
}
