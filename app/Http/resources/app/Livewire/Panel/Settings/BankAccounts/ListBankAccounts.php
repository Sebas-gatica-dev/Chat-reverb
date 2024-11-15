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

    public $search = '';

    public function mount()
    {
        $this->authorize('access-function', 'bank-account-list');
    }

    public function deleteBankAccount($id)
    {
        $bankAccount = BankAccount::find($id);

        if ($bankAccount) {
            $bankAccount->delete();
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

    public function restoreBankAccount($id)
    {
        $bankAccount = BankAccount::withTrashed()->find($id);

        if ($bankAccount) {
            $bankAccount->restore();
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

    public function forceDeleteBankAccount($id)
    {
        $bankAccount = BankAccount::withTrashed()->find($id);

        if ($bankAccount) {
            $bankAccount->branches()->detach();

            $files = $bankAccount->files;
            foreach ($files as $file) {
                Storage::delete($file->getRawOriginal('path'));
            }
            $bankAccount->files()->delete();

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