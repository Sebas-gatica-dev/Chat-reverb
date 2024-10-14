<?php

namespace App\Livewire\Panel\Settings\BankAccounts;

use App\Helpers\Notifications;
use App\Models\BankAccount;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;

class ListBankAccounts extends Component
{
    use WithPagination;

    // Properties
    public $search = '';

    // Lifecycle Hooks
    public function mount()
    {
        $this->authorize('access-function', 'bank-account-list');


        // Initialization code if needed
    }

    // Delete Bank Account
    public function deleteBankAccount($id)
    {
        $bankAccount = BankAccount::find($id);

        if ($bankAccount) {
            $bankAccount->delete(); // Soft delete
            $this->dispatch('notification', [
                'type' => Notifications::icons('success'),
                'message' => 'Cuenta desactivada'
            ]);
        } else {
            $this->dispatch('notification', [
                'type' => Notifications::icons('error'),
                'message' => 'No se pudo encontrar la cuenta bancaria'
            ]);
        }
    }

    // Restore Bank Account
    public function restoreBankAccount($id)
    {
        $bankAccount = BankAccount::withTrashed()->find($id);

        if ($bankAccount) {
            $bankAccount->restore(); // Restore from soft delete
            $this->dispatch('notification', [
                'type' => Notifications::icons('success'),
                'message' => 'Cuenta bancaria restaurada'
            ]);
        } else {
            $this->dispatch('notification', [
                'type' => Notifications::icons('error'),
                'message' => 'No se pudo encontrar la cuenta bancaria'
            ]);
        }
    }

    // Force Delete Bank Account
    public function forceDeleteBankAccount($id)
    {
        $bankAccount = BankAccount::withTrashed()->find($id);

  

        if ($bankAccount) {
            // Detach branches
            $bankAccount->branches()->detach();

            // Delete related files
            $files = $bankAccount->files;
            foreach ($files as $file) {
                Storage::delete($file->getRawOriginal('path')); // Delete file from storage
            }
            $bankAccount->files()->delete();

            // Force delete bank account
            $bankAccount->forceDelete();

            $this->dispatch('notification', [
                'type' => Notifications::icons('success'),
                'message' => 'Cuenta bancaria eliminada junto con los archivos asociados'
            ]);
        } else {
            $this->dispatch('notification', [
                'type' => Notifications::icons('error'),
                'message' => 'No se pudo encontrar la cuenta bancaria'
            ]);
        }
    }

    // Render Method
    public function render()
    {
        return view('livewire.panel.settings.bank-accounts.list-bank-accounts', [
            'bankAccounts' => auth()->user()->business->bankAccounts()
                ->withTrashed()
                ->orderBy('created_at', 'desc')
                ->orderBy('name', 'asc')
                ->paginate(10)
        ])->layout('layouts.panel', ['title' => 'Lista de cuentas bancarias']);
    }
}
