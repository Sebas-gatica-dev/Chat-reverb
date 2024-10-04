<?php

namespace App\Livewire\Panel\Settings\Products;

use Livewire\Component;
use App\Helpers\Notifications;
use App\Jobs\ImageDeleteJob;
use App\Models\BankAccount;
use Illuminate\Support\Str;
use Livewire\Attributes\On;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Bus;
use App\Jobs\ImageOptimizationScale;
use App\Models\Product;
use App\Rules\ValidCuitOrDni;
use App\Traits\ValidateNotificationTrait;
use Livewire\Attributes\Validate;
use App\Enums\FileTypeEnum;




class ProductEdit extends Component
{

    use ValidateNotificationTrait;

    public ?Product $product;
    
    #[Validate('required|string|max:255')]
    public $name;

    public $description;

    public $images;
    public $documents;
    public $productImagesExisting = [];
    public $productDocumentsExisting = [];
    public $initialImagesExisting = [];
    public $initialDocumentsExisting = [];


    public function mount()
    {
        $this->name = $this->product->name;
        $this->description = $this->product->description;
        $this->productImagesExisting = $this->product->files()->where('type', FileTypeEnum::Image)->get()->toArray();
        $this->productDocumentsExisting = $this->product->files()->where('type', FileTypeEnum::Document)->get()->toArray();
        // $this->authorize('access-function','stock-product-create');
        $this->initialDocumentsExisting = $this->productDocumentsExisting;
        $this->initialImagesExisting = $this->productImagesExisting;

    }




    protected function rules()
    {
      return [
        'name' => 'required|string|max:255',
        'description' => 'nullable|string|max:255',
      ];
    }


    protected function messages(){
        return [
            'name.required' => 'El campo nombre es obligatorio',
            'name.string' => 'El campo nombre debe ser un texto',
            'name.max' => 'El campo nombre no debe superar los 255 caracteres',
            'description.string' => 'El campo descripción debe ser un texto',
            'description.max' => 'El campo descripción no debe superar los 255 caracteres',
        ];
    }




    public function save($typeSave)
    {
        // Validate fields
        $this->validate();
        // dd($this->latitude, $this->longitude);
        // Create branch
        $this->product->update([
            'name' => $this->name,
            'description' => $this->description,
        ]);



         $this->handleFiles();
         $this->saveNewFiles(); 

        session()->flash('notification', [
            'message' => 'Cuenta bancaria actualizada correctamente',
            'type' => Notifications::icons('success')
        ]);
          
            return $this->redirectRoute('panel.settings.stock.product.list', true, true);
        
    }


    
    


    protected function handleFiles()
{
    // Eliminar archivos que ya no están
    if ($this->productImagesExisting != $this->initialImagesExisting) {
        foreach ($this->product->files()->where('type', FileTypeEnum::Image->value)->get() as $file) {
            if (!in_array($file->id, array_column($this->productImagesExisting, 'id'))) {
                $filePath = $file->getRawOriginal('path');
                Bus::dispatch(new ImageDeleteJob($file, $filePath));
                $file->delete();
            }
        }
    }

    if ($this->productDocumentsExisting != $this->initialDocumentsExisting) {
        foreach ($this->product->files()->where('type', FileTypeEnum::Document->value)->get() as $file) {
            if (!in_array($file->id, array_column($this->productDocumentsExisting, 'id'))) {
                $filePath = $file->getRawOriginal('path');
                Bus::dispatch(new ImageDeleteJob($file, $filePath));
                $file->delete();
            }
        }
    }

}

  






    public function saveNewFiles(){

          // Guardar nuevas imágenes
    if (!empty($this->images)) {
        foreach ($this->images as $image) {
            $filePath = Str::slug(auth()->user()->business->name) . '/images/' . $this->product->id . '/files/';
            $filename = uniqid() . '.' . $image->extension();
            $filenameComplete = $filePath . $filename;

            $image->storeAs($filePath, $filename);

            $storedFilePath = storage_path('app/public/' . $filenameComplete);
            $fileSize = filesize($storedFilePath);
            $fileExtension = pathinfo($storedFilePath, PATHINFO_EXTENSION);
            $typesEnumInstance = FileTypeEnum::getTypeForExtension($fileExtension);

            $fileSaved = $this->product->files()->create([
                'name' => $filename,
                'path' => $filenameComplete,
                'size' => $fileSize,
                'type' => $typesEnumInstance->value,
                'extension' => $fileExtension, 
                'user_id' => auth()->id(),
            ]);

            $image->delete();

            // Optimización de imágenes en segundo plano
            Bus::dispatch(new ImageOptimizationScale($filename, $fileSaved));
        }
    }

    // Guardar nuevos documentos
    if (!empty($this->documents)) {
        foreach ($this->documents as $document) {
            $filename = Str::slug(auth()->user()->business->name) . '/products/' . $this->product->id . '/documents/' . uniqid() . '.' . $document->extension();
                    Storage::put($filename, file_get_contents($document->getRealPath()));
                    $fileExtension = $document->extension();
                    $typesEnumInstance = FileTypeEnum::getTypeForExtension($fileExtension);

                    $this->product->files()->create([
                        'name' => $document->getClientOriginalName(),
                        'path' => $filename,
                        'size' => $document->getSize(),
                        'extension' => $fileExtension,
                        'type' => $typesEnumInstance->value,
                        'user_id' => auth()->id(),
                    ]);
        }
    }

    // Emitir eventos para actualizar los archivos en la vista
    $this->dispatch('update-files-refresh-product-images');
    $this->dispatch('update-files-refresh-product-documents');
}

    



    #[On('change-files-product-images')]
    public function changeImage($values)
    {
        $this->images = [];
        $this->getImagesValues($values);
    }

    #[On('remove-files-product-images')]
    public function removeImages($values)
    {
        $this->images = [];
        $this->getImagesValues($values);
    }

    #[On('change-files-product-documents')]
    public function changeDocuments($values)
    {
        $this->documents = [];
        $this->getDocumentsValues($values);
    }

    #[On('remove-files-product-documents')]
    public function removeDocument($values)
    {
        $this->documents = [];
        $this->getDocumentsValues($values);
    }

    
    #[On('remove-files-existing-product-images')]
    public function removeImagesExisting($values)
    {
        $this->productImagesExisting = $values;
    }

    
    #[On('remove-files-existing-product-documents')]
    public function removeDocumentsExisting($values)
    {
        $this->productDocumentsExisting = $values;
    }


    public function getImagesValues($values)
    {
        foreach ($values as $value) {
            $file = TemporaryUploadedFile::unserializeFromLivewireRequest($value);
            $this->images[] = $file;
        }
    }

    public function getDocumentsValues($values)
    {
        foreach ($values as $value) {
            $file = TemporaryUploadedFile::unserializeFromLivewireRequest($value);
            $this->documents[] = $file;
        }
    }




    public function render()
    {
        return view('livewire.panel.settings.products.product-edit')->layout('layouts.panel');
    }
}
