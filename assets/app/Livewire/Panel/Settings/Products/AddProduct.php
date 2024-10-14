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
use App\Enums\Units\UnitMeditionTypeEnum;



class AddProduct extends Component
{


    use ValidateNotificationTrait;

    #[Validate('required|string|max:255')]
    public $name;
    public $description;
    public $images = [];
    public $documents;
    public $radioGroupSelectedValue;
    public $profit;
    public $cost;
    public $quantity;
    public $unit_of_measurement;
    public $unitMeditionTypes = [];
    public $measure;


    public function mount()
    {
        // $this->authorize('access-function','stock-product-create');


        //Crear un array con los tipos de unidades de medida los values deben ser 

        // $this->unitMeditionTypes = UnitMeditionTypeEnum::values();

        //  dd(collect(UnitMeditionTypeEnum::cases()));
        $this->unitMeditionTypes = collect(UnitMeditionTypeEnum::cases())->map(function ($unitMeditionType) {
            return [
                'id' => $unitMeditionType->value,
                'name' => UnitMeditionTypeEnum::getUnit($unitMeditionType)
                // 'name' => UnitMeditionTypeEnum::getUnit($unitMeditionType),
            ];
        })->toArray();

        // dd($this->unitMeditionTypes);

    }





    public function save($typeSave)
    {
        $this->validate();

        // dd([
        //     'business_id' => auth()->user()->business->id, // Obtener el id del negocio del usuario autenticado
        //     'name' => $this->name,
        //     'slug' => Str::slug('product-' . $this->name),
        //     'description' => $this->description,
        //     'type' => $this->radioGroupSelectedValue,  
        // ]);

        $product = Product::create([
            'business_id' => auth()->user()->business->id, // Obtener el id del negocio del usuario autenticado
            'name' => $this->name,
            'slug' => Str::slug('product-' . $this->name),
            'description' => $this->description,
            'type' => $this->radioGroupSelectedValue,
            'created_by' => auth()->user()->id,
            'profit' => $this->profit,
            'cost' => $this->cost,
            'unit_of_measurement' => $this->unit_of_measurement,
            'measure' => $this->measure,
        ]);

        // dd($product);

        $this->saveFiles($product);

        if ($typeSave == 'save') {
            session()->flash('notification', [
                'message' => 'Producto creado correctamente',
                'type' => Notifications::icons('success')
            ]);

            return $this->redirectRoute('panel.settings.stock.product.list', true, true);
        } elseif ($typeSave == 'save-new') {

            session()->flash('notification', [
                'message' => 'Producto creado correctamente',
                'type' => Notifications::icons('success')
            ]);

            return $this->redirectRoute('panel.settings.stock.product.create', true, true);
        }
    }


    protected function saveFiles($product)
    {

        if ($this->images) {
            foreach ($this->images as $image) {
                $imageName = null;

                if (in_array($image->extension(), ['jpg', 'jpeg', 'png', 'gif', 'webp', 'bmp', 'tiff'])) {

                    $imagePath = Str::slug(auth()->user()->business->name) . '/images/' . $product->id . '/files/';
                    $imageName = uniqid() . '.' . $image->extension();
                    $imageNameComplete = $imagePath . $imageName;

                    $image->storeAs($imagePath, $imageName);

                    $storedImagePath = storage_path('app/public/' . $imageNameComplete);
                    $imageSize = filesize($storedImagePath);
                    $fileExtension = pathinfo($storedImagePath, PATHINFO_EXTENSION);
                    $typesEnumInstance = FileTypeEnum::getTypeForExtension($fileExtension);



                    $imageSaved = $product->files()->create([
                        'name' => $imageName,
                        'path' => $imageNameComplete,
                        'size' => $imageSize,
                        'type' => $typesEnumInstance->value,
                        'extension' => $fileExtension,
                        'user_id' => auth()->id(),
                    ]);

                    $image->delete();

                    Bus::dispatch(new ImageOptimizationScale($imageNameComplete, $imageSaved));
                }
            }

            $this->dispatch('update-files-refresh-product-images');
        }

        if ($this->documents) {

            foreach ($this->documents as $document) {



                $documentName = Str::slug(auth()->user()->business->name) . '/products/' . $product->id . '/documents/' . uniqid() . '.' . $document->extension();
                Storage::put($documentName, file_get_contents($document->getRealPath()));
                $documentExtension = $document->extension();
                $typesEnumInstance = FileTypeEnum::getTypeForExtension($documentExtension);

                $product->files()->create([
                    'name' => $document->getClientOriginalName(),
                    'path' => $documentName,
                    'size' => $document->getSize(),
                    'extension' => $documentExtension,

                    'type' => $typesEnumInstance->value,
                    'user_id' => auth()->id(),
                ]);
            }

            $this->dispatch('update-files-refresh-product-documents');
        }
    }



    #[On('update-selected-value-unit-of-measurement')]
    public function updateSelectedProduct($value)
    {

        $this->unit_of_measurement = $value['id'];
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
        return view('livewire.panel.settings.products.add-product')->layout('layouts.panel');
    }
}
