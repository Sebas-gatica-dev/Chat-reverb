<?php

namespace App\Livewire\Panel\Settings\Budgets\Documents;

use App\Enums\FileTypeEnum;
use App\Helpers\Notifications;
use App\Models\PdfResource;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AddPdfResources extends Component
{


    public $file;

    public $name;

    public $description;




    public function rules()
    {
        return [
            'name' => 'required|string|max:120',
            'description' => 'nullable|string|max:255',
            'file' => 'required',
        ];
    }


    public function messages()
    {
        return [
            'name.required' => 'El nombre de usuario es obligatorio.',
            'name.string' => 'El nombre de usuario debe ser una cadena de texto.',
            'name.max' => 'El nombre no debe tener más de 120 caracteres.',
            'description.string' => 'La descripción debe ser una cadena de texto.',
            'description.max' => 'La descripción no debe exceder 255 caracteres.',
            'file.required' => 'El archivo es obligatorio.',
        ];
    }



    public function save($typeSave)
    {

        $this->validate();

        $businessSlug = Str::slug(auth()->user()->business->name);
        $pdfFileName = 'documento-' . $this->name . uniqid() . '.' . $this->file->extension();
        $pdfPath = $businessSlug . '/pdf-resources/' . $pdfFileName;
        Storage::put($pdfPath, file_get_contents($this->file->getRealPath()));

        $pdfResource = PdfResource::create([
            'business_id' => auth()->user()->business->id,
            'name' => $this->name,
            'description' => $this->description,
            'path' => $pdfPath,
        ]);

        if ($typeSave == 'save') {
            session()->flash('notification', [
                'message' => 'Documento creado correctamente',
                'type' => Notifications::icons('success')
            ]);
            return redirect()->route('panel.settings.budgets.documents.list');
        } elseif ($typeSave == 'save-new') {

            session()->flash('notification', [
                'message' => 'Documento creado correctamente',
                'type' => Notifications::icons('success')
            ]);

            return redirect()->route('panel.settings.budgets.documents.create');
        } else {
            return redirect()->route('panel.settings.budgets.documents.list');
        }
    }


    #[On('remove-files-budget-document')]
    public function removeDocument()
    {
        $this->file = null;
    }


    #[On('change-files-budget-document')]
    public function changeDocument($value)
    {

        $file = TemporaryUploadedFile::unserializeFromLivewireRequest($value);
        $this->file = $file;
    }




    public function render()
    {
        return view('livewire.panel.settings.budgets.documents.add-pdf-resources')
            ->layout('layouts.panel');
    }
}
