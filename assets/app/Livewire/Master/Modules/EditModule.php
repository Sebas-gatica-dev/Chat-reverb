<?php

namespace App\Livewire\Master\Modules;

use App\Models\Business;
use App\Models\Feature;
use App\Models\Industry;
use App\Models\Module;
use App\Models\Plan;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Livewire\Attributes\On;

class EditModule extends Component
{

    public ?Module $module;

    public $name;

    public $slug;

    public $description;

    public $status;


    public function mount()
    {
        $this->name = $this->module->name;
        $this->slug = $this->module->slug;
        $this->description = $this->module->description;
        $this->status =  (int) $this->module->status;

    }


    public function rules()
    {
        return [
            'name' => 'required|string|max:120',
            'slug' => [
                'required',
                Rule::unique('modules')->ignore($this->module),
                'regex:/^[a-zA-Z0-9-]+$/u'
            ],
            'description' => 'required|string|max:1000',
            'status' => 'required|boolean',

        ];
    }



    public function update()
    {
        $this->validate();

        $this->module->update([
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description,
            'status' => $this->status,
        ]);



        return $this->redirectRoute('master.modules.index');
    }



    public function softDeleteFeature($id)
    {

        $this->module->features()->find($id)->delete();

    }

    public function forceDeleteFeature($id)
    {
        $this->module->features()->withTrashed()->find($id)->forceDelete();

    }

    public function restoreFeature($id)
    {

        $this->module->features()->withTrashed()->find($id)->restore();

    }




    public function render()
    {
        return view('livewire.master.modules.edit-module',[

            'features' => $this->module->features()->withTrashed()->orderBy('deleted_at', 'asc')->orderBy('name', 'asc')->paginate(10)
        ])->layout('layouts.master', ['title' => 'Edit Module']);
    }
}
