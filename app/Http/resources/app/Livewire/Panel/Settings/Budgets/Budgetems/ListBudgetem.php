<?php

namespace App\Livewire\Panel\Settings\Budgets\Budgetems;

use App\Helpers\Notifications;
use App\Models\Budgetem;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;

class ListBudgetem extends Component
{


    use WithPagination, WithoutUrlPagination;

    public function mount()
    {
        // Inicialización si es necesaria
    }

    public function deleteBudgetem($id)
    {
        $budgetem = Budgetem::find($id);

        if (!$budgetem) {
            $this->dispatch('notification', [
                'message' => 'Variable presupuestaria inexistente',
                'type' => Notifications::icons('error')
            ]);
            return;
        }

        $budgetem->delete();
    }

    public function restoreBudgetem($id)
    {
        Budgetem::withTrashed()->find($id)->restore();
    }

    public function forceDeleteBudgetem($id)
    {
        $budgetem = Budgetem::withTrashed()->find($id);

        // Verificar si la variable está asignada a algún presupuesto
        $isUsed = $budgetem->budgets()->exists();

        if (!$isUsed) {
            $budgetem->forceDelete();

            $this->dispatch('notification', [
                'message' => 'Variable presupuestaria eliminada correctamente',
                'type' => Notifications::icons('success')
            ]);
        } else {
            // Notificación de error si la variable está asignada
            $this->dispatch('notification', [
                'message' => 'No puedes eliminar esta variable porque está asignada a presupuestos',
                'type' => Notifications::icons('error')
            ]);
        }
    }



    public function render()
    {
        $budgetems = Budgetem::withTrashed()
            ->where('business_id', auth()->user()->business->id)
            ->orderBy('deleted_at', 'asc')
            ->orderBy('name', 'asc')
            ->paginate(10);
        return view('livewire.panel.settings.budgets.budgetems.list-budgetem', compact('budgetems'))
            ->layout('layouts.panel', ['title' => 'Variables Presupuestarias']);
    }
}
