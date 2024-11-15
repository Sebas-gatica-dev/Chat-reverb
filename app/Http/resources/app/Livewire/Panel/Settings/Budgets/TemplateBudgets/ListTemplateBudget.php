<?php
namespace App\Livewire\Panel\Settings\Budgets\TemplateBudgets;

use App\Helpers\Notifications;
use App\Models\BudgetTemplate;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;

class ListTemplateBudget extends Component
{
    use WithPagination, WithoutUrlPagination;

    public function mount()
    {
        // Cualquier inicialización necesaria
    }

    // Método para eliminar una plantilla de presupuesto
    public function deleteTemplate($id)
    {
        $template = BudgetTemplate::find($id);

        if (!$template) {
            $this->dispatch('notification', [
                'message' => 'Plantilla presupuestaria inexistente',
                'type' => Notifications::icons('error')
            ]);
            return;
        }

        $template->delete();
    }

    // Método para restaurar una plantilla de presupuesto eliminada
    public function restoreTemplate($id)
    {
        BudgetTemplate::withTrashed()->find($id)->restore();
    }

    // Método para eliminar definitivamente una plantilla de presupuesto
    public function forceDeleteTemplate($id)
    {
        $template = BudgetTemplate::withTrashed()->find($id);

        // Verificar si la plantilla está asignada a algún presupuesto
        $isUsed = $template->budgetems()->exists();

        if (!$isUsed) {
            $template->forceDelete();

            $this->dispatch('notification', [
                'message' => 'Plantilla presupuestaria eliminada correctamente',
                'type' => Notifications::icons('success')
            ]);
        } else {
            // Notificación de error si la plantilla está asignada
            $this->dispatch('notification', [
                'message' => 'No puedes eliminar esta plantilla porque está asignada a presupuestos',
                'type' => Notifications::icons('error')
            ]);
        }
    }

    public function render()
    {
        // Cargar todas las plantillas de presupuesto
        $templates = BudgetTemplate::withTrashed()
            ->where('business_id', auth()->user()->business->id)
            ->orderBy('deleted_at', 'asc')
            ->orderBy('name', 'asc')
            ->paginate(10);

        return view('livewire.panel.settings.budgets.template-budgets.list-template-budget', compact('templates'))
            ->layout('layouts.panel', ['title' => 'Lista de plantillas presupuestarias']);
    }
}
