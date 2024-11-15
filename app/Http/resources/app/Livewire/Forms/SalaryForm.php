<?php

namespace App\Livewire\Forms;

use App\Enums\Salaries\ModallyProfitCounterSalaryEnum;
use App\Enums\Salaries\ModallyProfitSalaryEnum;
use App\Enums\Salaries\ProfitOfSalaryEnum;
use App\Enums\Salaries\TaxesSalaryEnum;
use App\Enums\Salaries\TransportSalaryEnum;
use App\Enums\Salaries\TypeSalaryEnum;
use App\Livewire\Components\MultiSelectGeneral;
use App\Models\Branch;
use App\Models\Salary;
use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Form;

class SalaryForm extends Form
{

    public $users;
    public $selectedUser;
    public $typesSalary;
    public $selectedTypeSalary;
    public $typesSalaryValue;
    public $taxesSalary;
    public $selectedTaxSalary;
    public $taxesValue;
    public $transportsSalary;
    public $selectedTransportSalary;
    public $transportsValue;
    public $profitsOfSalary;
    public $selectedProfitSalary;
    public $modallyProfitsSalary;
    public $selectedModallyProfitSalary;
    public $modallyProfitsCountSalary;
    public $selectedModallyProfitCountSalary;
    public bool $onlyProfit = false;
    public $salary_mount;
    public $modallyIds = [];
    public $selectedmodallyIds;
    public int $modallyQuantity = 1;

    public function setForm()
    {

        $this->users = User::where('business_id', auth()->user()->business_id)
            ->select('id', 'name')
            ->get()->map(function ($user) {
                return [
                    'id' => $user->id,
                    'name' => $user->name,
                    'image' => $user->photo,
                ];
            });

        $this->typesSalary = collect(TypeSalaryEnum::cases())->map(function ($typeEnum) {
            return [
                'id' => $typeEnum->value,
                'name' => $typeEnum->getName(),
            ];
        })->toArray();


        $this->taxesSalary = collect(TaxesSalaryEnum::cases())->map(function ($tax) {
            return [
                'id' => $tax->value,
                'name' => $tax->getName(),
            ];
        })->toArray();

        $this->transportsSalary = collect(TransportSalaryEnum::cases())->map(function ($transport) {
            return [
                'id' => $transport->value,
                'name' => $transport->getName(),
            ];
        })->toArray();


        $this->profitsOfSalary = collect(ProfitOfSalaryEnum::cases())->map(function ($profit) {
            return [
                'id' => $profit->value,
                'name' => $profit->getName(),
            ];
        })->toArray();


        $this->modallyProfitsSalary = collect(ModallyProfitSalaryEnum::cases())->map(function ($modalProfit) {
            return [
                'id' => $modalProfit->value,
                'name' => $modalProfit->getName(),
            ];
        })->toArray();

        $this->modallyProfitsCountSalary = collect(ModallyProfitCounterSalaryEnum::cases())->map(function ($counter) {
            return [
                'id' => $counter->value,
                'name' => $counter->getName(),
            ];
        })->toArray();
    }



    public function setSalary($salary)
    {


        $this->selectedUser = [
            'id' => $salary->user->id,
            'name' => $salary->user->name,
            'image' => $salary->user->photo,
        ];

        $this->selectedTypeSalary = $salary->type->value;

        $this->typesSalaryValue = $salary->type_value;

        $this->selectedTaxSalary = $salary->taxes ? $salary->taxes->value : null;
        $this->taxesValue = $salary->taxes_value;
        $this->selectedTransportSalary = $salary->transport ? $salary->transport->value : null;
        $this->transportsValue = $salary->transport_value;
        $this->selectedProfitSalary = $salary->profit_of ? $salary->profit_of->value : null;

        $this->selectedModallyProfitSalary = $salary->modally_profit ? $salary->modally_profit->value : null;




        if ($this->selectedModallyProfitSalary == 'users') {
            $this->modallyIds = User::where('business_id', auth()->user()->business_id)
                ->select('id', 'name')
                ->get()->map(function ($user) {
                    return [
                        'id' => $user->id,
                        'name' => $user->name,
                        'image' => $user->photo,
                    ];
                });

            $this->modallyIds = collect($this->modallyIds)->whereIn('id', json_decode($salary->modally_profit_ids, true))->values()->toArray();
        } elseif ($this->selectedModallyProfitSalary == 'branches') {
            $this->modallyIds = Branch::where('business_id', auth()->user()->business_id)
                ->select('id', 'name')
                ->get()->map(function ($branch) {
                    return [
                        'id' => $branch->id,
                        'name' => $branch->name,
                        'image' => $branch->photo,
                    ];
                });

            $this->modallyIds = collect($this->modallyIds)->whereIn('id', json_decode($salary->modally_profit_ids, true))->values()->toArray();
        }




        $this->selectedModallyProfitCountSalary = $salary->modally_profit_counter ? $salary->modally_profit_counter->value : null;


        $this->modallyQuantity = $salary->modally_profit_quantity;
        $this->salary_mount = $salary->salary;
    }



    public function rules()
    {
        return [
            'selectedUser' => 'required',
            'selectedTypeSalary' => 'required',
            'typesSalaryValue' => 'required_if:selectedTypeSalary,percentage,commissions',
            'selectedProfitSalary' => 'required_if:selectedTypeSalary,percentage,commissions',
            'selectedModallyProfitSalary' => 'required_if:selectedTypeSalary,percentage,commissions',
            'selectedModallyProfitCountSalary' => 'required_if:selectedProfitSalary,customers',
            'modallyQuantity' => 'required_if:selectedModallyProfitCountSalary,days,count|numeric',

            'selectedmodallyIds' => 'required_if:selectedModallyProfitSalary,users,branches|nullable',
            'selectedTaxSalary' => 'required',
            'taxesValue' => 'required_if:selectedTaxSalary,percentage,fixed|nullable',

            'selectedTransportSalary' => 'required',
            'transportsValue' => 'required_if:selectedTransportSalary,percentage,fixed|nullable',

            'salary_mount' => 'required_if:selectedTypeSalary,salary_fixed|nullable',
        ];
    }


    public function messages()
    {
        return [
            'selectedUser.required' => 'Seleccionar el usuario es obligatorio.',
            'selectedTypeSalary.required' => 'Seleccionar el tipo de ganancia es obligatorio.',

            'typesSalaryValue.required_if' => 'Debes ingresar el valor de ganancia cuando es porcentaje o comisión.',
            'selectedProfitSalary.required_if' => 'Seleccionar la fuente de ganancia es obligatorio cuando es porcentaje o comisión.',
            'selectedModallyProfitSalary.required_if' => 'Seleccionar la modalidad de ganancia es obligatorio cuando es porcentaje o comisión.',
            'selectedModallyProfitCountSalary.required_if' => 'La frecuencia de ganancia es obligatorio cuando la modalidad es por cliente cerrado',

            'modallyQuantity.required_if' => 'Especificar la cantidad es obligatorio cuando es por días o conteo.',
            'modallyQuantity.numeric' => 'La cantidad debe ser un número válido.',

            'selectedTaxSalary.required' => 'Seleccionar un tipo de impuesto es obligatorio.',
            'taxesValue.required_if' => 'Indicar el valor del impuesto es obligatorio cuando se selecciona porcentaje o fijo.',
            'taxesValue.numeric' => 'El valor del impuesto debe ser un número válido.',

            'selectedmodallyIds.required_if' => 'Seleccionar al menos un usuario o sucursal.',


            'selectedTransportSalary.required' => 'Seleccionar un tipo de transporte es obligatorio.',
            'transportsValue.required_if' => 'Indicar el valor del transporte es obligatorio cuando se selecciona porcentaje o fijo.',
            'transportsValue.numeric' => 'El valor del transporte debe ser un número válido.',

            'salary_mount.required_if' => 'Indicar el salario mensual es obligatorio cuando el tipo de ganancia es salario fijo.',
            'salary_mount.numeric' => 'El salario mensual debe ser un número válido.',
        ];
    }




    public function save()
    {

        $this->validate();


        $salary = Salary::create([
            'business_id' => auth()->user()->business_id,
            'user_id' => $this->selectedUser['id'],
            'type' => $this->selectedTypeSalary,
            'type_value' => $this->typesSalaryValue,
            'only_profits' => false,
            'taxes' => $this->selectedTaxSalary,
            'taxes_value' => $this->taxesValue,
            'transport' => $this->selectedTransportSalary,
            'transport_value' => $this->transportsValue,
            'profit_of' => $this->selectedProfitSalary,
            'modally_profit' => $this->selectedModallyProfitSalary,
            'modally_profit_counter' => $this->selectedModallyProfitCountSalary,
            'modally_profit_quantity' => $this->modallyQuantity,
            'salary' => $this->salary_mount,
        ]);

        if($this->selectedmodallyIds){
            $salary->modally_profit_ids = json_encode(array_column($this->selectedmodallyIds, 'id'));
        }

    }


    public function update($salary)
    {

        $this->validate();

        $salary->update([
            'user_id' => $this->selectedUser['id'],
            'type' => $this->selectedTypeSalary,
            'type_value' => $this->typesSalaryValue,
            'only_profits' => false,
            'taxes' => $this->selectedTaxSalary,
            'taxes_value' => $this->taxesValue,
            'transport' => $this->selectedTransportSalary,
            'transport_value' => $this->transportsValue,
            'profit_of' => $this->selectedProfitSalary,
            'modally_profit' => $this->selectedModallyProfitSalary,
            'modally_profit_counter' => $this->selectedModallyProfitCountSalary,
            'modally_profit_quantity' => $this->modallyQuantity,
            'salary' => $this->salary_mount,
        ]);

        if($this->selectedmodallyIds){
            $salary->update([
                'modally_profit_ids' => json_encode(array_column($this->selectedmodallyIds, 'id')),
            ]);
        }


    }
}
