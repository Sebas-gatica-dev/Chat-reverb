<?php

namespace App\Livewire\Panel\Settings\BankAccounts;

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
use App\Rules\ValidCuitOrDni;
use App\Traits\ValidateNotificationTrait;


class EditBankAccount extends Component
{
   use ValidateNotificationTrait;

    public ?BankAccount $bankAccount;

    public $name;
    public $cbu;
    public $alias;
    public $cuit;
    public $account_number;
    public $photos;
    public $bank;
    public $branches;
    public $holder;
    public $selectedBranches = [];
    public $newFiles = [];
    public $filesExisting = [];
    public $initialFilesExisting = [];
    public $availabilities = [];

    public function mount()
    {
        $this->name = $this->bankAccount->name;
        $this->cbu = $this->bankAccount->cbu;
        $this->alias = $this->bankAccount->alias;
        $this->cuit = $this->bankAccount->cuit;
        $this->account_number = $this->bankAccount->account_number;
        $this->bank = $this->bankAccount->bank;
        $this->holder = $this->bankAccount->holder;

        $this->branches = auth()->user()->business->branches()->get()->map(function ($branch) {
            return [
                'id' => $branch->id,
                'name' => $branch->name,
            ];
        });

        $this->selectedBranches = $this->bankAccount->branches()->get()->map(function ($branch) {
            return [
                'id' => $branch->id,
                'name' => $branch->name,
            ];
        })->toArray();

        $this->filesExisting = $this->bankAccount->files->map(function ($file) {
            return [
                'id' => $file->id,
                'name' => $file->name,
                'path' => $file->path,
                'type' => $file->type,
                'extension' => $file->extension,
            ];
        })->toArray();


        $this->initialFilesExisting = $this->filesExisting;
    }

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

    public function save()
    {
        $this->validate();

        $this->bankAccount->update([
            'name' => $this->name,
            'bank' => $this->bank,
            'holder' => $this->holder,
            'cbu' => $this->cbu,
            'alias' => $this->alias,
            'cuit' => $this->cuit,
            'account_number' => $this->account_number,
        ]);

        $this->syncBranches();
        $this->handleFiles();
        $this->saveNewFiles();

        session()->flash('notification', [
            'message' => 'Cuenta bancaria actualizada correctamente',
            'type' => Notifications::icons('success')
        ]);

        $this->redirectRoute('panel.settings.bank-accounts.list', true, true);
    }

    protected function syncBranches()
    {
        if ($this->selectedBranches) {
            $this->bankAccount->branches()->sync(array_column($this->selectedBranches, 'id'));
        }
    }

    protected function handleFiles()
    {
        if ($this->filesExisting != $this->initialFilesExisting) {
            if (count($this->filesExisting) > 0) {
                foreach ($this->bankAccount->files as $file) {
                    if (!in_array($file->id, array_column($this->filesExisting, 'id'))) {
                        $filePath = $file->getRawOriginal('path');
                        Bus::dispatch(new ImageDeleteJob($file, $filePath));
                    }
                }
            } else {
                foreach ($this->bankAccount->files as $file) {
                    $filePath = $file->getRawOriginal('path');
                    Bus::dispatch(new ImageDeleteJob($file, $filePath));
                    $file->delete();
                }
            }
        }
    }

    protected function saveNewFiles()
    {
        if ($this->newFiles) {
            foreach ($this->newFiles as $file) {
                $filename = null;

                if (in_array($file->extension(), ['jpg', 'jpeg', 'png', 'gif', 'webp', 'bmp', 'tiff'])) {
                    $filePath = Str::slug(auth()->user()->business->name) . '/bank_accounts/' . $this->bankAccount->id . '/files/';
                    $filename = uniqid() . '.' . $file->extension();
                    $filenameComplete = $filePath . $filename;

                    $file->storeAs($filePath, $filename);

                    $storedFilePath = storage_path('app/public/' . $filenameComplete);
                    $fileSize = filesize($storedFilePath);
                    $fileType = pathinfo($storedFilePath, PATHINFO_EXTENSION);

                    $fileSaved = $this->bankAccount->files()->create([
                        'name' => $filename,
                        'path' => $filenameComplete,
                        'size' => $fileSize,
                        'type' => $fileType,
                        'user_id' => auth()->id(),
                    ]);

                    $file->delete();

                    Bus::dispatch(new ImageOptimizationScale($filenameComplete, $fileSaved));
                } else {
                    $filename = Str::slug(auth()->user()->business->name) . '/bank_accounts/' . $this->bankAccount->id . '/files/' . uniqid() . '.' . $file->extension();
                    Storage::put($filename, file_get_contents($file->getRealPath()));

                    $this->bankAccount->files()->create([
                        'name' => $file->getClientOriginalName(),
                        'path' => $filename,
                        'size' => $file->getSize(),
                        'type' => $file->extension(),
                        'user_id' => auth()->id(),
                    ]);
                }
            }
        }
    }

    #[On('change-files-bank-acount-existing-files')]
    public function changeNewFiles($values)
    {
        $this->newFiles = [];
        $this->getFileValues($values);
    }

    #[On('remove-files-bank-acount-existing-files')]
    public function removeNewFile($values)
    {
        $this->newFiles = [];
        $this->getFileValues($values);
    }

    #[On('remove-files-existing-bank-acount-existing-files')]
    public function removeFilesExisting($values)
    {
        $this->filesExisting = $values;
    }

    #[On('update-selected-values-branches')]
    public function updateSelectedBranches($value)
    {
        $this->selectedBranches = $value;
    }

    #[On('update-search-branches')]
    public function searchBranches($search)
    {
        $this->branches = auth()->user()->business->branches()
            ->when($search, function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            })->get()->map(function ($user) {
                return [
                    'id' => $user->id,
                    'name' => $user->name,
                ];
            });

        $this->dispatch('update-values-branches', $this->branches);
    }

    protected function getFileValues($values)
    {
        foreach ($values as $value) {
            $file = TemporaryUploadedFile::unserializeFromLivewireRequest($value);
            $this->newFiles[] = $file;
        }
    }

    public function render()
    {
        return view('livewire.panel.settings.bank-accounts.edit-bank-account')
            ->layout('layouts.panel', ['title' => 'Editar cuenta bancaria']);
    }
}
