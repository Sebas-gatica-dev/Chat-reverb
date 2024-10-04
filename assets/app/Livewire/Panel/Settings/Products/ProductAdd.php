<?php

namespace App\Livewire\Panel\Settings\Products;

use App\Helpers\Notifications;
use App\Jobs\ImageOptimizationScale;
use App\Models\Product;
use Livewire\Component;
use App\Traits\ValidateNotificationTrait;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Bus;
use Livewire\Attributes\Validate;
use Illuminate\Support\Str;
use Livewire\Attributes\On;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use App\Enums\FileTypeEnum;



class ProductAdd extends Component
{


    use ValidateNotificationTrait;
    
    #[Validate('required|string|max:255')]
    public $name;

    public $description;

    public $images;
    public $documents;


    public function mount()
    {
        // $this->authorize('access-function','stock-product-create');
    }


    public function save($typeSave)
    {
        // Validate fields
        $this->validate();
        // dd($this->latitude, $this->longitude);
        // Create branch
        $product = Product::create([
            'business_id' => auth()->user()->business->id, // Obtener el id del negocio del usuario autenticado
            'name' => $this->name,
            'slug' => Str::slug('product-' . $this->name),
            'description' => $this->description,
         
        ]);

        if ($typeSave == 'save') {
            session()->flash('notification', [
                'message' => 'Sucursal creado correctamente',
                'type' => Notifications::icons('success')
            ]);

            return $this->redirectRoute('panel.settings.stock.product.edit', ['product' => $product->id], true, true);
        } elseif ($typeSave == 'save-new') {

            session()->flash('notification', [
                'message' => 'Sucursal creado correctamente',
                'type' => Notifications::icons('success')
            ]);

            return $this->redirectRoute('panel.settings.stock.product.create', true, true);
        } else {
            return $this->redirectRoute('panel.settings.srock.product.list', true, true);
        }
    }


    protected function saveFiles($product)
    {
        if ($this->images) {
            foreach ($this->files as $file) {
                $filename = null;

                if (in_array($file->extension(), ['jpg', 'jpeg', 'png', 'gif', 'webp', 'bmp', 'tiff'])) {

                    $filePath = Str::slug(auth()->user()->business->name) . '/images/' . $product->id . '/files/';
                    $filename = uniqid() . '.' . $file->extension();
                    $filenameComplete = $filePath . $filename;

                    $file->storeAs($filePath, $filename);

                    $storedFilePath = storage_path('app/public/' . $filenameComplete);
                    $fileSize = filesize($storedFilePath);
                    $fileExtension = pathinfo($storedFilePath, PATHINFO_EXTENSION);
                    $typesEnumInstance = FileTypeEnum::getTypeForExtension($fileExtension);


                    $fileSaved = $product->files()->create([
                        'name' => $filename,
                        'path' => $filenameComplete,
                        'size' => $fileSize,
                        'type' => $typesEnumInstance->value,
                        'extension' => $fileExtension, 
                        'user_id' => auth()->id(),
                    ]);

                    $file->delete();

                    Bus::dispatch(new ImageOptimizationScale($filenameComplete, $fileSaved));
                } elseif($this->documents) {

                    $filename = Str::slug(auth()->user()->business->name) . '/products/' . $product->id . '/documents/' . uniqid() . '.' . $file->extension();
                    Storage::put($filename, file_get_contents($file->getRealPath()));
                    $fileExtension = $file->extension();
                    $typesEnumInstance = FileTypeEnum::getTypeForExtension($fileExtension);

                    $product->files()->create([
                        'name' => $file->getClientOriginalName(),
                        'path' => $filename,
                        'size' => $file->getSize(),
                        'extension' => $fileExtension,
                        'type' => $typesEnumInstance->value,
                        'user_id' => auth()->id(),
                    ]);
                }
            }
        }


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
    public function removImages($values)
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
        return view('livewire.panel.settings.products.product-add')->layout('layouts.panel');
    }
}
