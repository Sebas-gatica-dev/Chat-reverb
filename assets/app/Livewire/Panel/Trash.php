<?php

namespace App\Livewire\Panel;

use App\Models\Trash as ModelsTrash;
use Livewire\Component;

class Trash extends Component
{


    public function mount(){
        $this->authorize('access-function', 'trash-show');
    }

    public function restore($id)
    {
        $this->authorize('access-function', 'trash-restore');
        $trash = ModelsTrash::find($id); //Modelo de trash
        $model = $trash->trashable_type::withTrashed()->find($trash->trashable_id); //Modelo del registro que se elimino
    
        $model->restore();
        $trash->forceDelete();
    }

    public function delete($id)
    {
        $this->authorize('access-function', 'trash-destroy');
        $trash = ModelsTrash::find($id);


        $model = $trash->trashable_type::withTrashed()->find($trash->trashable_id);

        $model->forceDelete();
        $trash->delete();
    }

    public function render()
    {
        return view('livewire.panel.trash',
            [
                'trashes' => ModelsTrash::withTrashed()->where('business_id', auth()->user()->business_id)
                ->orderBy('created_at', 'desc')
                ->get()
            ])
            ->layout('layouts.panel', ['title' => 'Trash']);
    }
}
