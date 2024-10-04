<?php

namespace App\Livewire\Panel\Settings\BankAccounts;

use App\Helpers\Notifications;
use App\Jobs\ImageOptimizationScale;
use App\Models\BankAccount;
use App\Rules\ValidCuitOrDni;
use Illuminate\Support\Facades\Bus;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Traits\ValidateNotificationTrait;
use App\Enums\FileTypeEnum;

class AddBankAccount extends Component
{
    use WithFileUploads, ValidateNotificationTrait;

    // Properties
    public $name;
    public $cbu;
    public $alias;
    public $cuit;
    public $account_number;
    public $photos;
    public $bank;
    public $holder;
    public $branches;
    public $selectedBranches = [];

    // Lifecycle Hooks
    public function mount()
    {
        $this->branches = auth()->user()->business->branches()->get()->map(function ($branch) {
            return [
                'id' => $branch->id,
                'name' => $branch->name,
            ];
        });
    }

    // Validation Rules
    protected function rules()
    {
        return [
            'holder' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'cbu' => 'required|string|max:255',
            'alias' => 'nullable|string|max:255',
            'cuit' => ['required', 'string', new ValidCuitOrDni],
            'bank' => 'required|string|max:255',
            'account_number' => 'nullable|string|max:255',
            'photos.*' => 'nullable|file|mimes:jpg,jpeg,png,gif,webp,bmp,svg,tiff,ico,pdf,doc,docx,xls,xlsx,ppt,pptx,txt,zip,rar|max:10240',
            'selectedBranches' => 'required|array|min:1',
        ];
    }

    // Custom Validation Messages
    protected function messages()
    {
        return [
            'holder.required' => 'El nombre de cuenta es obligatorio.',
            'holder.string' => 'El nombre de cuenta debe ser texto.',
            'cbu.required' => 'El campo CBU es obligatorio.',
            'cuit.required' => 'El CUIL/CUIT es obligatorio.',
            'bank.required' => 'La entidad bancaria es obligatoria.',
            'name.required' => 'El titular de cuenta es obligatorio.',
            'selectedBranches.required' => 'Selecciona al menos una sucursal.',
            'selectedBranches.min' => 'Selecciona al menos una sucursal.',
        ];
    }

    // Save Bank Account
    public function save($typeSave)
    {
        $this->validate();

        $bankAccount = BankAccount::create([
            'business_id' => auth()->user()->business->id,
            'name' => $this->name,
            'bank' => $this->bank,
            'cbu' => $this->cbu,
            'alias' => $this->alias,
            'cuit' => $this->cuit,
            'account_number' => $this->account_number,
            'holder' => $this->holder,
        ]);

        $this->saveBranches($bankAccount);
        $this->savePhotos($bankAccount);

        $this->handleRedirect($typeSave);
    }

    // Save Branches
    protected function saveBranches($bankAccount)
    {
        if ($this->selectedBranches) {
            $bankAccount->branches()->attach(array_column($this->selectedBranches, 'id'));
        }
    }

    // Save Photos
    protected function savePhotos($bankAccount)
    {
        if ($this->photos) {
            foreach ($this->photos as $file) {
                $filename = null;

                if (in_array($file->extension(), ['jpg', 'jpeg', 'png', 'gif', 'webp', 'bmp', 'tiff'])) {
                    $filePath = Str::slug(auth()->user()->business->name) . '/bank_accounts/' . $bankAccount->id . '/files/';
                    $filename = uniqid() . '.' . $file->extension();
                    $filenameComplete = $filePath . $filename;

                    $file->storeAs($filePath, $filename);

                    $storedFilePath = storage_path('app/public/' . $filenameComplete);
                    $fileSize = filesize($storedFilePath);
                    $fileExtension = pathinfo($storedFilePath, PATHINFO_EXTENSION);
                    $typesEnumInstance = FileTypeEnum::getTypeForExtension($fileExtension);
                  
                    $fileSaved = $bankAccount->files()->create([
                        'name' => $filename,
                        'path' => $filenameComplete,
                        'size' => $fileSize,
                        'type' => $typesEnumInstance->value,
                        'extension' => $fileExtension,
                        'user_id' => auth()->id(),
                    ]);

                    $file->delete();

                    Bus::dispatch(new ImageOptimizationScale($filenameComplete, $fileSaved));
                } else {
                    $filename = Str::slug(auth()->user()->business->name) . '/bank_accounts/' . $bankAccount->id . '/files/' . uniqid() . '.' . $file->extension();
                    Storage::put($filename, file_get_contents($file->getRealPath()));
                    $fileExtension = $file->extension();
                    $typesEnumInstance = FileTypeEnum::getTypeForExtension($fileExtension);
                   


                    $bankAccount->files()->create([
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
    }

    // Handle Redirect
    protected function handleRedirect($typeSave)
    {
        session()->flash('notification', [
            'message' => 'Cuenta bancaria creada exitosamente.',
            'type' => Notifications::icons('success')
        ]);

        if ($typeSave == 'save') {
            return $this->redirectRoute('panel.settings.bank-accounts.list', true, true);
        } elseif ($typeSave == 'save-new') {
            return $this->redirectRoute('panel.settings.bank-accounts.create', true, true);
        } else {
            return $this->redirectRoute('panel.settings.bank-accounts.list', true, true);
        }
    }

    // Event Handlers
    #[On('update-selected-values-branches')]
    public function updateSelectedBranches($value)
    {
        $this->selectedBranches = $value;
    }

    #[On('update-search-branches')]
    public function searchBranches($search)
    {
        $searchBranches = $search;

        $this->branches = auth()->user()->business->branches()
            ->when($searchBranches, function ($query) use ($searchBranches) {
                $query->where('name', 'like', '%' . $searchBranches . '%');
            })->get()->map(function ($branch) {
                return [
                    'id' => $branch->id,
                    'name' => $branch->name,
                ];
            });

        $this->dispatch('update-values-branches', $this->branches);
    }

    #[On('change-files-bank-account-files')]
    public function changeFiles($values)
    {
        $this->photos = [];
        $this->getFileValues($values);
    }

    #[On('remove-files-bank-account-files')]
    public function removeFile($values)
    {
        $this->photos = [];
        $this->getFileValues($values);
    }

    // Helper Methods
    protected function getFileValues($values)
    {
        foreach ($values as $value) {
            $file = TemporaryUploadedFile::unserializeFromLivewireRequest($value);
            $this->photos[] = $file;
        }
    }

    // Render Method
    public function render()
    {
        return view('livewire.panel.settings.bank-accounts.add-bank-account')
            ->layout('layouts.panel', ['title' => 'Crear cuenta bancaria']);
    }
}
