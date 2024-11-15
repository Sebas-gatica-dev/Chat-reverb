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
use App\Jobs\UpdateBudgetsWithProductsJob;
use App\Models\Budget;
use App\Models\BudgetTemplate;

class EditProduct extends Component
{

    use ValidateNotificationTrait;

    public ?Product $product;

    #[Validate('required|string|max:255')]
    public $name;
    public $profit;
    public $description;
    public $cost;
    public $images;
    public $documents;
    public $productImagesExisting = [];
    public $productDocumentsExisting = [];
    public $initialImagesExisting = [];
    public $initialDocumentsExisting = [];
    public $radioGroupSelectedValue;

    //Actualizacion de presupuestos
    public $updateTemplatesToggle = true;
    public $showUpdateModal = false; // Controla la visibilidad del modal
    public $keepOldPrice = false; // Checkbox 1: Mantener con precio antiguo los presupuestos
    public $timePeriod = null; // Período de tiempo seleccionado (7, 15, 30 días)
    public $timePeriods = [7, 15, 30]; // Opciones disponibles para el período de tiempo
    public $originalCost; // Valor original de 'cost' para comparación
    public $originalProfit; // Valor original de 'profit' para comparación
    public $isInUse = false; // Indica si la variable está en uso en algún presupuesto




    public function mount()
    {
        $this->name = $this->product->name;
        $this->description = $this->product->description;
        $this->productImagesExisting = $this->product->files()->where('type', FileTypeEnum::Image)->get()->toArray();
        $this->productDocumentsExisting = $this->product->files()->where('type', FileTypeEnum::Document)->get()->toArray();
        $this->initialDocumentsExisting = $this->productDocumentsExisting;
        $this->initialImagesExisting = $this->productImagesExisting;
        $this->cost = $this->product->cost;
        $this->profit = $this->product->profit;
        $this->radioGroupSelectedValue = $this->product->type;


        // Almacenar valores originales
        $this->originalCost = $this->product->cost;
        $this->originalProfit = $this->product->profit;


        $productInBudget = Budget::whereHas('products', function ($query) {
            $query->where('products.id', $this->product->id);
        })->exists();

        $productInTemplate = BudgetTemplate::whereHas('products', function ($query) {
            $query->where('products.id', $this->product->id);
        })->exists();

        $this->isInUse =  $productInBudget || $productInTemplate;

      
    }


    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'radioGroupSelectedValue' => 'required',

        ];
    }

    protected function messages()
    {
        return [
            'name.required' => 'El campo nombre es obligatorio',
            'name.string' => 'El campo nombre debe ser un texto',
            'name.max' => 'El campo nombre no debe superar los 255 caracteres',
            'description.string' => 'El campo descripción debe ser un texto',
            'description.max' => 'El campo descripción no debe superar los 255 caracteres',
            'radioGroupSelectedValue.required' => 'El campo tipo de producto es obligatorio',
        ];
    }



    public function performUpdate()
    {
        // Validar las entradas del modal
        $this->validateModalInputs();

        //Actualizar presupuestos con productos
        dispatch(new UpdateBudgetsWithProductsJob($this->product->id, $this->timePeriod , $this->cost, $this->profit, $this->updateTemplatesToggle));

        // Actualizar la variable presupuestaria
        $this->updateProduct();


        session()->flash('notification', [
            'message' => 'Producto y presupuestos actualizados correctamente',
            'type' => Notifications::icons('success'),
        ]);

        // Cerrar el modal y redirigir
        $this->showUpdateModal = false;
        return $this->redirectRoute('panel.settings.stock.product.list', true, true);
    }


    protected function validateModalInputs()
    {
        $rules = [
            'keepOldPrice' => 'boolean',
            'updateTemplatesToggle' => 'boolean',
        ];

        if ($this->keepOldPrice) {
            $rules['timePeriod'] = 'required|in:7,15,30';
        }

        $this->validate($rules, [
            'timePeriod.required' => 'Debe seleccionar un período de tiempo.',
            'timePeriod.in' => 'Período de tiempo inválido.',
        ]);
    }



    public function update()
    {
    
        //Verificar si 'value' o 'default_quantity' han cambiado
        $costChanged = $this->cost != $this->originalCost;
        $profitChanged = $this->profit != $this->originalProfit;

        if (($costChanged || $profitChanged) && $this->isInUse) {
            // Mostrar el modal
         
            $this->showUpdateModal = true;
        } else {

            $this->updateProduct();
            // Si no hubo cambios en 'value' o 'default_quantity', proceder normalmente
            session()->flash('notification', [
                'message' => 'Producto actualizado correctamente',
                'type' => Notifications::icons('success'),
            ]);

            return $this->redirectRoute('panel.settings.stock.product.list', true, true);
        }
    }


    public function updateProduct()
    {

        $this->validate();

        $this->product->update([
            'name' => $this->name,
            'description' => $this->description,
            'type' => $this->radioGroupSelectedValue,
            'cost' => $this->cost,
            'profit' => $this->profit,
        ]);

        $this->handleFiles();
        $this->saveNewFiles();
    }


    protected function handleFiles()
    {
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

    public function saveNewFiles()
    {

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

                Bus::dispatch(new ImageOptimizationScale($filename, $fileSaved));
            }
        }

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
        return view('livewire.panel.settings.products.edit-product')->layout('layouts.panel');
    }
}
