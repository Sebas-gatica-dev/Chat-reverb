<?php

namespace App\Livewire\Panel\Stock;

use App\Models\Product;
use App\Models\Unit;
use App\Models\UnitHistory;
use App\Models\Warehouse;
use Livewire\Component;
use App\Enums\Units\UnitsHistoryTypeEnum;
use App\Models\User;
use Livewire\Attributes\On;
use App\Enums\Units\UnitDownActionReasonTypeEnum;
use App\Traits\ValidateNotificationTrait;
use App\Enums\Units\UnitsStatusEnum;
use App\Helpers\Notifications;


class AddStockInventoryAction extends Component
{

    use ValidateNotificationTrait;

    public ?Unit $unit;
    public ?Product $product;
    public $hasWorker; //BOOL PARA VALIDAR SU LA UNIDAD TIENE UN WORKER A CARGO
    public $hasWarehouse; //BOOL PARA NVALIDAR SI LA UNIDAD ESTA ALOJADA EN UN DEPOSITO
    public $currentWorker;
    public $currentWarehouse;
    public $actionType;
    public $warehouses;
    public $workers;
    public $selectUnits;
    public $selectUnitsSearch;
    public $selectedWorker;
    public $selectedWarehouse;
    public $actionsList;
    public $destinationableSelect;
    public $destinationableSelected;
    public $originableSelect;
    public $originableSelected;
    public $unsubscribe;
    public $reason_description;
    public $selectedUnit;
    public $reasonList;
    public $transfer_quantity;
    public $current_emisor_quantity;
    public $final_emisor_quantity;
    public $current_receptor_quantity;
    public $final_receptor_quantity;
    public $product_unit_measure;

    public function mount()
{
    $this->product_unit_measure = $this->product->unit_of_measurement;
    
    $this->hasWorker = isset($this->unit->worker_id);
    $this->hasWarehouse = isset($this->unit->warehouse_id);

    $this->actionsList = collect(UnitsHistoryTypeEnum::cases())
        ->filter(fn($unitMeditionType) => in_array($unitMeditionType->value, [
            UnitsHistoryTypeEnum::Baja->value,
            UnitsHistoryTypeEnum::TransferToWarehouse->value,
            UnitsHistoryTypeEnum::TransferToWorker->value,
            UnitsHistoryTypeEnum::TransferToOtherUnit->value,
        ]))
        ->map(fn($unitMeditionType) => [
            'id' => $unitMeditionType->value,
            'name' => UnitsHistoryTypeEnum::getStatus($unitMeditionType->value)
        ])
        ->values() 
        ->toArray();
    

    $this->reasonList = collect(UnitDownActionReasonTypeEnum::cases())
        ->map(fn($reasonDownType) => [
            'id' => $reasonDownType->value,
            'name' => UnitDownActionReasonTypeEnum::getDownActionReason($reasonDownType->value)
        ])->toArray();

          

            $queryWarehouse = Warehouse::where('business_id', auth()->user()->business->id);

        if ($this->hasWarehouse) {
            $this->warehouses = $queryWarehouse->where('id', '!=', $this->unit->warehouse_id)->limit(5)->get()->toArray();
        } else {
            $this->warehouses = $queryWarehouse->get()->toArray();
        }

        $queryWorker = User::where('business_id', auth()->user()->business->id);

        if ($this->hasWorker) {
            $this->workers = $queryWorker->where('id', '!=', $this->unit->worker_id)->limit(5)->get()->toArray();
        } else {
            $this->workers = $queryWorker->get()->toArray();
        }

              $this->selectUnits = $this->product->units()
            ->where('id', '!=', $this->unit->id)
            ->where('type', $this->unit->type)->limit(5)
            ->get()->map(fn($unit) => [
                'id' => $unit->id,
                'name' => $unit->tag . '-' . $this->product->name,
                'initial_quantity' => $unit->initial_quantity,
                'current_quantity' => $unit->current_quantity,
                'unit_of_measurement' => $this->product->unit_of_measurement,
                'status' => $unit->status,
            ]);


    $this->current_emisor_quantity = $this->unit->current_quantity;
}

    public function updatedTransferQuantity($value)
    {

        if ($value === '' || $value === null) {
            $this->transfer_quantity = null;
        } elseif ($value > $this->unit->current_quantity) {

            $this->transfer_quantity = $this->unit->current_quantity;


            $this->dispatch('notification', [
                'message' => 'Si transfieres la totalidad de la unidad, esta se dará de baja',
                'type' => Notifications::icons('warning')
            ]);

            $this->final_emisor_quantity =  $this->current_emisor_quantity;

        } else {
            $this->transfer_quantity = $value;
        }

        $this->calculateFinalQuantities();
    }

    public function calculateFinalQuantities()
    {
        if ($this->selectedUnit) {
            $this->final_receptor_quantity = $this->selectedUnit['current_quantity'] + $this->transfer_quantity;
            $this->final_emisor_quantity = $this->unit['current_quantity'] - $this->transfer_quantity;
        }
    }

    public function updatedActionType($actionType)
{
    $this->selectedWarehouse = null;
    $this->selectedWorker = null;
    $this->selectedUnit = null; // Restablecer la selección de unidad

    if ($actionType == UnitsHistoryTypeEnum::TransferToWarehouse->value || $actionType == UnitsHistoryTypeEnum::TransferToWorker->value) {
        $this->loadWarehousesAndWorkers();
    } elseif ($actionType == UnitsHistoryTypeEnum::TransferToOtherUnit->value) {
        $this->loadAvailableUnits();
    } elseif ($actionType == UnitsHistoryTypeEnum::Baja->value) {
        $this->unsubscribe = true;
    }
}

private function loadAvailableUnits()
{
        $this->selectUnits = $this->product->units()
        ->where('id', '!=', $this->unit->id)
        ->where('type', $this->unit->type)
        ->get()->map(fn($unit) => [
            'id' => $unit->id,
            'name' => $unit->tag . '-' . $unit->product->name,
            'initial_quantity' => $unit->initial_quantity,
            'current_quantity' => $unit->current_quantity,
            'unit_of_measurement' => $this->product->unit_of_measurement,
            'status' => $unit->status,
        ]);

}

    private function loadWarehousesAndWorkers()
{
    $queryWarehouse = Warehouse::where('business_id', auth()->user()->business->id);
    $this->warehouses = $queryWarehouse->when($this->hasWarehouse, fn($query) => $query->where('id', '!=', $this->unit->warehouse_id))->get()->toArray();

    $queryWorker = User::where('business_id', auth()->user()->business->id);
    $this->workers = $queryWorker->when($this->hasWorker, fn($query) => $query->where('id', '!=', $this->unit->worker_id))->get()->toArray();
}

public function rules()
{
    return [
        'destinationableSelected.id' => 'required_if:actionType.id,' . UnitsHistoryTypeEnum::Baja->value,
        'selectedWarehouse' => 'required_if:actionType.id,' . UnitsHistoryTypeEnum::TransferToWarehouse->value,
        'reason_description' => 'required_if:actionType.id,' . UnitsHistoryTypeEnum::TransferToWarehouse->value,
        'selectedWorker' => 'required_if:actionType.id,' . UnitsHistoryTypeEnum::TransferToWorker->value,
        'reason_description' => 'required_if:actionType.id,' . UnitsHistoryTypeEnum::TransferToWorker->value,
        'selectedUnit' => 'required_if:actionType.id,' . UnitsHistoryTypeEnum::TransferToOtherUnit->value,
        'transfer_quantity' => 'required_if:actionType.id,' . UnitsHistoryTypeEnum::TransferToOtherUnit->value,
    ];
}

public function messages()
{
    return [
        'destinationableSelected.id.required_if' => 'Debes seleccionar un motivo para dar de baja la unidad.',
        'selectedWarehouse.required_if' => 'Debes seleccionar un almacén para la transferencia.',
        'selectedWorker.required_if' => 'Debes seleccionar un trabajador para la transferencia.',
        'selectedUnit.required_if' => 'Debes seleccionar una unidad a la que transferir.',
        'transfer_quantity.required_if' => 'La cantidad a transferir es requerida.',
    ];
}

    public function save()
    {

        $this->validate();

        switch ($this->actionType) {
            case UnitsHistoryTypeEnum::TransferToWarehouse->value:
                $this->transferToWarehouse();
                break;
            case UnitsHistoryTypeEnum::TransferToWorker->value:
                $this->transferToWorker();
                break;
            case UnitsHistoryTypeEnum::TransferToOtherUnit->value:
                $this->transferToOtherUnit();
                break;
            case UnitsHistoryTypeEnum::Baja->value:
                $this->downUnit();
                break;
            default:
                break;
        }

    }

    private function transferToWarehouse()
    {

        $this->validate();

        if (!$this->unit->worker_id && $this->unit->warehouse_id) {
            $unit_history = UnitHistory::create([
                'unit_id' => $this->unit->id,
                'type' => strval(UnitsHistoryTypeEnum::TransferToWarehouse->value),
                'originable_type' => 'App\Models\Warehouse',
                'originable_id' => $this->unit->warehouse_id,
                'destinationable_type' => 'App\Models\Warehouse',
                'destinationable_id' => $this->selectedWarehouse['id'],
                'created_by' => auth()->id(),
                'description' => $this->reason_description,
                'initial_quantity' => $this->unit->initial_quantity,
                'current_quantity' => $this->unit->current_quantity,
            ]);

            $this->unit->update([
                'worker_id' =>  null,
                'warehouse_id' => $this->selectedWarehouse['id'],
            ]);
        } elseif ($this->unit->worker_id && !$this->unit->warehouse_id) {
            $unit_history = UnitHistory::create([
                'unit_id' => $this->unit->id,
                'type' => strval(UnitsHistoryTypeEnum::TransferToWarehouse->value),
                'originable_type' => 'App\Models\User',
                'originable_id' => $this->unit->worker_id,
                'destinationable_type' => 'App\Models\Warehouse',
                'destinationable_id' => $this->selectedWarehouse['id'],
                'created_by' => auth()->id(),
                'description' => $this->reason_description,
                'initial_quantity' => $this->unit->initial_quantity,
                'current_quantity' => $this->unit->current_quantity,
            ]);

            $this->unit->update([
                'warehouse_id' => $this->selectedWarehouse['id'],
                'worker_id' => null,
            ]);
        }

        session()->flash('notification', [
            'message' => 'Accion ejecutada correctamente',
            'type' => Notifications::icons('success')
        ]);


        $this->redirectRoute('panel.stock.inventory-show', ['product' => $this->product->id, 'unit' => $this->unit->id]);
    }

    private function transferToWorker()
    {
        $this->validate();

        if ($this->unit->warehouse_id && !$this->unit->worker_id) {
            $unit_history = UnitHistory::create([
                'unit_id' => $this->unit->id,
                'type' => UnitsHistoryTypeEnum::TransferToWorker->value,
                'originable_type' => 'App\Models\Warehouse',
                'originable_id' => $this->unit->warehouse_id,
                'destinationable_type' => 'App\Models\User',
                'destinationable_id' => $this->selectedWorker['id'],
                'created_by' => auth()->id(),
                'description' => $this->reason_description,
                'initial_quantity' => $this->unit->initial_quantity,
                'current_quantity' => $this->unit->current_quantity,

            ]);

            $this->unit->update([
                'worker_id' => $this->selectedWorker['id'],
                'warehouse_id' => null,
            ]);

        } elseif ($this->unit->worker_id && !$this->unit->warehouse_id) {

            $unit_history = UnitHistory::create([
                'unit_id' => $this->unit->id,
                'type' => UnitsHistoryTypeEnum::TransferToWorker->value,
                'originable_type' => 'App\Models\User',
                'originable_id' => $this->unit->worker_id,
                'destinationable_type' => 'App\Models\User',
                'destinationable_id' => $this->selectedWorker['id'],
                'created_by' => auth()->id(),
                'description' => $this->reason_description,
                'initial_quantity' => $this->unit->initial_quantity,
                'current_quantity' => $this->unit->current_quantity,

            ]);

            $this->unit->update([
                'worker_id' => $this->selectedWorker['id'],
                'warehouse_id' => null,
            ]);
        }

        session()->flash('notification', [
            'message' => 'Accion ejecutada correctamente',
            'type' => Notifications::icons('success')
        ]);



        $this->redirectRoute('panel.stock.inventory-show', ['product' => $this->product->id, 'unit' => $this->unit->id]);
    }

    private function transferToOtherUnit()
    {
        $this->validate();

        $this->unit->update([
            'current_quantity' => $this->unit->current_quantity - $this->transfer_quantity,
        ]);

        $unit = Unit::find($this->selectedUnit['id']);

        $unit->update([
            'current_quantity' => $unit->current_quantity + $this->transfer_quantity,
        ]);

        session()->flash('notification', [
            'message' => 'Accion ejecutada correctamente',
            'type' => Notifications::icons('success')
        ]);

        UnitHistory::create([
            'unit_id' => $this->unit->id,
            'type' => strval(UnitsHistoryTypeEnum::TransferToOtherUnit->value),
            'originable_type' => 'App\Models\Unit',
            'originable_id' => $this->unit->id,
            'destinationable_type' => 'App\Models\Unit',
            'destinationable_id' => $this->selectedUnit['id'],
            'created_by' => auth()->id(),
            'description' => $this->reason_description,
            'initial_quantity' => $this->current_emisor_quantity,
            'current_quantity' => $this->final_emisor_quantity,
            'quantity' => $this->transfer_quantity,
        ]);

        UnitHistory::create([
            'unit_id' => $unit->id,
            'type' => strval(UnitsHistoryTypeEnum::ReceiveTransfer->value),
            'originable_type' => 'App\Models\Unit',
            'originable_id' => $this->unit->id,
            'destinationable_type' => 'App\Models\Unit',
            'destinationable_id' => $this->selectedUnit['id'],
            'created_by' => auth()->id(),
            'current_quantity' => $unit->current_quantity,
            'description' => $this->reason_description,
            'initial_quantity' => $this->current_receptor_quantity,
            'current_quantity' => $this->final_receptor_quantity,
            'quantity' => $this->transfer_quantity,
        ]);

        if ($this->final_emisor_quantity == 0) {
            $this->downUnit();
        }


        $this->redirectRoute('panel.stock.inventory-show', ['product' => $this->product->id, 'unit' => $this->unit->id]);
    }

    public function downUnit()
    {

        $this->unit->update([
            'status' => UnitsStatusEnum::DISCHARGUED->value,
        ]);

      $newUnit = UnitHistory::create([
            'unit_id' => $this->unit->id,
            'type' => UnitsHistoryTypeEnum::Baja->value,
            'originable_type' => $this->unit->originable_type,
            'originable_id' => $this->unit->originable_id,
            'destinationable_type' => $this->unit->destinationable_type,
            'destinationable_id' => $this->unit->destinationable_id,
            'created_by' => auth()->id(),
            'description' => $this->reason_description,
            'reason_action' => $this->destinationableSelected,

        ]);

        session()->flash('notification', [
            'message' => 'Accion ejecutada correctamente',
            'type' => Notifications::icons('success')
        ]);

        $this->redirectRoute('panel.stock.inventory-list', ['product' => $this->product->id, 'unit' => $this->unit->id]);
    }

    #[On('update-selected-value-action-type')]
    public function updateSelectedProduct($value)
    {
        $this->actionType = $value;
    }

    #[On('update-selected-value-selected-warehouse')]
    public function updateSelectedWarehouse($value)
    {
        $this->selectedWarehouse = $value;
    }


    #[On('update-selected-value-selected-worker')]
    public function updateSelectedWorker($value)
    {
        $this->selectedWorker = $value;
    }

    #[On('update-selected-value-reason-description')]
    public function updateSelectedReasonDescription($value)
    {
        $this->destinationableSelected = $value;
    }

    #[On('update-selected-value-selected-unit')]
    public function updateSelectedUnit($value)
    {
        $this->selectedUnit = $value;

        $this->current_receptor_quantity = $this->selectedUnit['current_quantity'] ?? null;
        $this->final_receptor_quantity = $this->selectedUnit['current_quantity'] ?? null;
    }

    #[On('update-search-selected-unit')]
    public function searchUnits($search)
    {
        $selectUnitsSearch = $search;

        $this->selectUnits = $this->product->units()
            ->when($selectUnitsSearch, function ($query) use ($selectUnitsSearch) {
                $query->where('tag', 'like', '%' . $selectUnitsSearch . '%');
            })->get()->map(function ($unit) {
                return [
                    'id' => $unit->id,
                    'name' => $unit->tag . ' - ' . $unit->product->name,
                ];
            });

        $this->dispatch('update-values-selected-unit', $this->selectUnits);
    }

    public function render()
    {
        return view('livewire.panel.stock.add-stock-inventory-action')->layout('layouts.panel');
    }
}
