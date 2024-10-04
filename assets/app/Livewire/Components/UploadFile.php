<?php

namespace App\Livewire\Components;

use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Enums\FileTypeEnum;

class UploadFile extends Component
{
    use WithFileUploads;

    public $files = [];
    public $newFiles = [];
    public $name;
    public $multiple = true;
    public $extensions = [];
    public $types = [];
    public $maxSize = 402400; // in KB
    public $existingFiles = [];
    public $showPreview = true;

    public function mount()
    {
        foreach ($this->types as $type) {
            $fileTypeEnum = FileTypeEnum::tryFrom(strtolower($type));
            if ($fileTypeEnum) {
                $extensions = FileTypeEnum::getExtensions($fileTypeEnum);
                $this->extensions = array_merge($this->extensions, $extensions);
            }
        }
    }

    public function getListeners()
    {
        return [
            "update-files-refresh-{$this->name}" => 'refreshFiles',
        ];
    }


    public function rules()
    {   //usar las extensiones y el tamaño máximo que se pasan por parámetro
        return [
            'files.*' => 'file|mimes:' . implode(',', $this->extensions) . '|max:' . $this->maxSize,
            'newFiles.*' => 'file|mimes:' . implode(',', $this->extensions) . '|max:' . $this->maxSize,
        ];
    }


    public function removeFile($index) //Remover files temporales
    {

  
        unset($this->files[$index]);

        $this->files = array_values($this->files); // reindex array

        //Enviar los archivos al componente padre
        if ($this->multiple) {
            $this->dispatch(sprintf('remove-files-%s',$this->name), $this->getSerializeFiles($this->files));
        } else {
            $this->dispatch(sprintf('remove-files-%s',$this->name));
        }
    }

    public function getSerializeFiles($files)
    {

        $values = [];

        foreach ($files as $file) {
            $values[] = $file->serializeForLivewireResponse();
        }
        return $values;
    }

    public function updatedNewFiles()
    {

        $this->validate();

        // Combinar las nuevos archivos con los archivos existentes
        $this->files = array_merge($this->files, $this->newFiles);
        $this->newFiles = [];


        //Enviar los archivos al componente padre
     $this->dispatch(sprintf('change-files-%s', $this->name), $this->getSerializeFiles($this->files));

    }

    public function updatedFiles()
    {
        $this->validate();
        $this->dispatch(sprintf('change-files-%s', $this->name), $this->files[0]->serializeForLivewireResponse());
    }


    public function removeFileExisting($index) //Remover files existentes
    {
        unset($this->existingFiles[$index]);
        // $this->existingFiles = array_values($this->existingFiles); // reindex array
        //Enviar los archivos al componente padre
        if ($this->multiple) {
            $this->dispatch(sprintf('remove-files-existing-%s',$this->name), $this->existingFiles);
        } else {
            $this->dispatch(sprintf('remove-files-existing-%s',$this->name));
        }
    }


  
    public function getTypeByExtension($extension)
    {
        $type = FileTypeEnum::getTypeForExtension($extension);
        return $type ? $type->value : null;
    }



    #[On('update-files-refresh')]
    public function refreshFiles()
    {
        $this->files = [];

    }


    public function render()
    {

        return view('livewire.components.upload-file');
    }
}
