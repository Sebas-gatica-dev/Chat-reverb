<?php

namespace App\Livewire\Panel\Settings\Budgets\Documents;

use App\Helpers\Notifications;
use App\Jobs\ImageDeleteJob;
use App\Models\PdfResource;
use Illuminate\Support\Facades\Bus;
use Livewire\Component;
use Livewire\Features\SupportPagination\WithoutUrlPagination;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;

class ListPdfResources extends Component
{

    use WithPagination, WithoutUrlPagination;

    public function mount()
    {
        // Cualquier inicialización necesaria
    }



    public function deletePdfResource($id)
    {

        $pdfResource = PdfResource::find($id);

        if(!$pdfResource){
            $this->dispatch('notification', [
                'message' => 'Recurso PDF inexistente',
                'type' => Notifications::icons('error')
            ]);
            return;
        }
        

        $pdfResource->delete();
    }

    function render()
    {
        // Cargar todas las plantillas de presupuesto
        $pdfResources = PdfResource::where('business_id', auth()->user()->business->id)
            ->orderBy('deleted_at', 'asc')
            ->orderBy('name', 'asc')
            ->paginate(10);

        return view('livewire.panel.settings.budgets.documents.list-pdf-resources', compact('pdfResources'))
            ->layout('layouts.panel');
    }
}
