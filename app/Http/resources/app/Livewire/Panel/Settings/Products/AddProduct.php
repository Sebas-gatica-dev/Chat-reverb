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
    public $unitOfMeasurement;
    public $unitMeditionTypes = [];
    public $measure;

    public function mount()
    {
        $this->unitMeditionTypes = collect(UnitMeditionTypeEnum::cases())->map(function ($unitMeditionType) {
            return [
                'id' => $unitMeditionType->value,
                'name' => UnitMeditionTypeEnum::getUnit($unitMeditionType->value)
            ];
        })->toArray();

        
    }

    protected function rules()
    {
        return [
            'name' => 'required|string|max:40',
            'description' => 'required|string|max:255',
            'radioGroupSelectedValue' => 'required',
            'unitOfMeasurement' => 'required',
            'measure' => 'required|numeric',
        ];
    }

    protected function messages()
    {
        return [
            'name.required' => 'El nombre del producto es obligatorio.',
            'name.string' => 'El nombre del producto debe ser una cadena de texto.',
            'name.max' => 'El nombre del producto no debe exceder los 40 caracteres.',
            'description.required' => 'La descripción del producto es obligatoria.',
            'description.string' => 'La descripción del producto debe ser una cadena de texto.',
            'description.max' => 'La descripción del producto no debe exceder los 255 caracteres.',
            'radioGroupSelectedValue.required' => 'El tipo de producto es obligatorio.',
            'unitOfMeasurement' => 'La unidad de medida es obligatoria.',
            'measure' => 'La cantidad del producto por unidad es obligatoria.',
        ];
    }

    public function save($typeSave)
    {
        $this->validate();

        $product = Product::create([
            'business_id' => auth()->user()->business->id,
            'name' => $this->name,
            'slug' => Str::slug('product-' . $this->name),
            'description' => $this->description,
            'type' => $this->radioGroupSelectedValue,
            'created_by' => auth()->user()->id,
            'profit' => $this->profit,
            'cost' => $this->cost,
            'unit_of_measurement' => $this->unitOfMeasurement,
            'measure' => $this->measure,
        ]);

        $this->saveFiles($product);

        session()->flash('notification', [
            'message' => 'Producto creado correctamente',
            'type' => Notifications::icons('success')
        ]);

        if ($typeSave == 'save') {
            return $this->redirectRoute('panel.settings.stock.product.list', true, true);
        } elseif ($typeSave == 'save-new') {
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
        $this->unitOfMeasurement = $value;
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