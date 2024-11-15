<?php

namespace App\Livewire\Panel\Property\Files;

use App\Models\Comment;
use App\Models\File;
use App\Models\Property;
use App\Models\Visit;
use Illuminate\Support\Facades\Bus;
use Livewire\Component;
use Intervention\Image\ImageManager;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use App\Jobs\ImageOptimizationScale;
use App\Jobs\ImageDeleteJob;
use App\Enums\FileTypeEnum;

class ListFiles extends Component
{

    public $property;

    public bool $sourceLead = false;

    // public $files;

    public function mount()
    {
        if (is_array($this->property)) {
            $this->property = collect($this->property);
        }

        $this->authorize('access-function', 'property-file-list');
    }






    #[On('change-files-property-files')]
    public function addNewFiles($values)
    {

        $this->authorize('access-function', 'property-file-add');
        $files = $this->getFileValues($values);

        foreach ($files as $file) {
            $filename = null;

            if (in_array($file->extension(), ['jpg', 'jpeg', 'png', 'webp', 'bmp', 'svg', 'tiff'])) {
                // Redimensionar y optimizar la imagen
                // $manager = new ImageManager(new Driver());
                // $uploadFile = $manager->read($file->getRealPath())
                //     ->coverDown(500, 500, 'center')->toWebp(60);
                // // Crear un nombre único para la imagen
                // $filename =  Str::slug(auth()->user()->business->name) . '/properties/' . $this->property->id . '/' . '/files/' . uniqid() . '.webp';

                // Storage::put($filename, (string) $uploadFile);

                $filePath = Str::slug(auth()->user()->business->name) . '/properties/' . $this->property->id . '/files/';
                $filename = uniqid() . '.' . $file->extension();
                $filenameComplete = $filePath . $filename;

                // Guarda el archivo
                $file->storeAs($filePath, $filename);


                $storedFilePath = storage_path('app/public/' . $filenameComplete);
                $fileSize = filesize($storedFilePath); // Obtener el tamaño desde el archivo guardado
                $fileExtension = pathinfo($storedFilePath, PATHINFO_EXTENSION); // Obtener la extensión del archivo guardado
                $typesEnumInstance = FileTypeEnum::getTypeForExtension($fileExtension);

                // Crea el registro del archivo en la base de datos
                $fileSaved = $this->property->files()->create([
                    'name' => $filename,
                    'path' => $filenameComplete,
                    'size' => $fileSize,
                    'extension' => $fileExtension,
                    'type' => $typesEnumInstance->value,
                    'user_id' => auth()->id(),
                ]);

                // Elimina el archivo temporal de Livewire
                // $file->delete();

                // Despacha el Job para optimización de imágenes
                Bus::dispatch(new ImageOptimizationScale($filenameComplete, $fileSaved, 500, 500));
            } else {
                $filename =  Str::slug(auth()->user()->business->name) . '/properties/' . $this->property->id . '/' . '/files/' . uniqid() . '.' . $file->extension();
                $uploadFile = $file->getRealPath();
                Storage::put($filename, file_get_contents($uploadFile));
                $fileExtension = $file->extension();
                $typesEnumInstance = FileTypeEnum::getTypeForExtension($fileExtension);


                $this->property->files()->create([
                    'name' => $file->getClientOriginalName(),
                    'path' => $filename,
                    'size' => $file->getSize(),
                    'extension' => $fileExtension,
                    'type' => $typesEnumInstance->value,
                    'user_id' => auth()->id(),
                ]);
            }
        }


        $this->dispatch('update-files-refresh-property-files');


       $this->updateStepIfSourceIsLead();
    }


    public function getFileValues($values)
    {

        $newFiles = [];

        foreach ($values as $value) {
            $file = TemporaryUploadedFile::unserializeFromLivewireRequest($value);
            $newFiles[] = $file;
        }

        return $newFiles;
    }


    public function deleteFile($file)
    {

        $this->authorize('access-function', 'property-file-delete');
        $file = File::find($file);
        $filePath = $file->getRawOriginal('path');

        // Storage::delete($file->path);
        Bus::dispatch(new ImageDeleteJob($file, $filePath));


        $file->delete();
        $this->updateStepIfSourceIsLead();
    }


    public function updateStepIfSourceIsLead()
    {
        if ($this->sourceLead) {

            $this->dispatch('updateDataLeadAndStep', step: 4);
        }
    }


    public function render()
    {

        if (!isset($this->property->visits) || $this->property->visits->isEmpty()) {
            return view('livewire.panel.property.files.list-files', [
                'files' =>  File::where('fileable_type', Property::class)->where('fileable_id', $this->property->id)->with('user')->get()
            ]);
        }

        $comments = Comment::where('commentable_type', Visit::class)
            ->whereIn('commentable_id', $this->property->visits->pluck('id'))
            ->pluck('id');

        return view('livewire.panel.property.files.list-files', [

            'files' =>  File::whereHas('fileable', function ($query) use ($comments) {
                $query->where('fileable_type', Comment::class)->whereIn('id', $comments);
            })->orWhereHas('fileable', function ($query) {
                $query->where('fileable_type', Property::class)->where('id', $this->property->id);
            })->with('user')->get()


        ]);
    }
}
