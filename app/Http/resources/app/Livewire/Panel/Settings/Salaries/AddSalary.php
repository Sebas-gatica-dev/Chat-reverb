<?php

namespace App\Livewire\Panel\Settings\Salaries;

use App\Enums\Salaries\ModallyProfitCounterSalaryEnum;
use App\Enums\Salaries\ModallyProfitSalaryEnum;
use App\Enums\Salaries\ProfitOfSalaryEnum;
use App\Enums\Salaries\TaxesSalaryEnum;
use App\Enums\Salaries\TransportSalaryEnum;
use App\Enums\Salaries\TypeSalaryEnum;
use App\Livewire\Components\MultiSelectGeneral;
use App\Livewire\Forms\SalaryForm;
use App\Models\Branch;
use App\Models\Salary;
use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Component;

use function Pest\Laravel\json;

class AddSalary extends Component
{
    public SalaryForm $form;
    public $salary;


    public function mount()
    {
        $this->form->setForm();


        if($this->salary){

            $this->salary = Salary::where('id', $this->salary)->firstOrFail();

            $this->form->setSalary($this->salary);
        }


    }

    #[On('update-checked-only-profit')]
    public function changeChecked($value)
    {
        $this->form->onlyProfit = $value;
    }

    #[On('update-selected-value-users')]
    public function updateSelectedUser($value)
    {

        $this->form->selectedUser = $value;
    }

    #[On('update-selected-value-typesSalary')]
    public function updateSelectedTypeSalary($value)
    {

    
        $this->form->selectedTypeSalary = $value; 
    }

    #[On('update-selected-value-taxesSalary')]
    public function updateSelectedTaxSalary($value)
    {
        $this->form->selectedTaxSalary = $value;
    }

    #[On('update-selected-value-transportsSalary')]
    public function updateSelectedTransportSalary($value)
    {
        $this->form->selectedTransportSalary = $value;
    }

    #[On('update-selected-value-profitsOfSalary')]
    public function updateSelectedProfitSalary($value)
    {

       
        $this->form->selectedProfitSalary = $value;
    }

    #[On('update-selected-value-modallyProfitsSalary')]
    public function updateSelectedModallyProfitSalary($value)
    {

        if($value == 'users'){
            $this->form->modallyIds = User::where('business_id', auth()->user()->business_id)
            ->select('id', 'name')
            ->get()->map(function ($user) {
                return [
                    'id' => $user->id,
                    'name' => $user->name,
                    'image' => $user->photo,
                ];
            });
        }elseif($value == 'branches'){ 
            $this->form->modallyIds = Branch::where('business_id', auth()->user()->business_id)
            ->select('id', 'name')
            ->get()->map(function ($user) {
                return [
                    'id' => $user->id,
                    'name' => $user->name,
                ];
            });


        }


        $this->dispatch('update-values-modallyIds', $this->form->modallyIds)->to(MultiSelectGeneral::class);
        $this->dispatch('clear-selected-values-modallyIds')->to(MultiSelectGeneral::class);
        $this->form->selectedmodallyIds = [];
        $this->form->selectedModallyProfitSalary = $value;
    }





    #[On('update-selected-value-modallyProfitsCountSalary')]
    public function updateSelectedModallyProfitCountSalary($value)
    {
        $this->form->selectedModallyProfitCountSalary = $value;
    }

    #[On('update-selected-values-modallyIds')]
    public function updateSelectedModallyIds($value)
    {
        $this->form->selectedmodallyIds = $value;
    }

    public function save()
    {
        $this->form->save();
        $this->redirectRoute('panel.settings.salaries.list', true);
    }

    public function update()
    {
        $this->form->update($this->salary);
        $this->redirectRoute('panel.settings.salaries.list', true);

    }


    public function render()
    {
        return view('livewire.panel.settings.salaries.add-salary')->layout('layouts.panel');
    }
}
