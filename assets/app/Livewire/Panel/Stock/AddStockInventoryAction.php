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
    public $product_unit_measure;
    



    //LAS TRANSFERENCIAS DE UNIDAD A UNIDAD SOLO MLAS PODRAN RELAIZAR LOS ELEMENTOS QUE ESTEN ALOJADO EN UN DEPOSITO

    public function mount()
    {

        $this->product_unit_measure = $this->product->unit_of_measurement;
        // dd($this->unit, $this->product);
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
                'name' => UnitsHistoryTypeEnum::getStatus($unitMeditionType)
            ])->toArray();


            $this->reasonList = collect(UnitDownActionReasonTypeEnum::cases())
            ->map(fn($unitMeditionType) => [
                'id' => $unitMeditionType->value,
                'name' => UnitDownActionReasonTypeEnum::getStatus($unitMeditionType)
            ])->toArray();

            // dd($this->reasonList);

            $queryWarehouse = Warehouse::where('business_id', auth()->user()->business->id);

            if ($this->hasWarehouse) {
                $this->warehouses = $queryWarehouse->where('id', '!=', $this->unit->warehouse_id)->get()->toArray();
            } else {
                $this->warehouses = $queryWarehouse->get()->toArray();
            }
    
            $queryWorker = User::where('business_id', auth()->user()->business->id);
    
            if ($this->hasWorker) {
                $this->workers = $queryWorker->where('id', '!=', $this->unit->worker_id)->get()->toArray();
            } else {
                $this->workers = $queryWorker->get()->toArray();
            }

            

            $this->selectUnits = $this->product->units()
                ->where('id', '!=', $this->unit->id)
                ->where('type', $this->unit->type)
                ->get()->map(fn($unit) => [
                    'id' => $unit->id,
                    'name' => $unit->tag . '-' . $unit->product->name,
                    'initial_quantity' => $unit->initial_quantity,
                    'current_quantity' => $unit->current_quantity,
                    'unit_of_measurement' => $this->product->unit_of_measurement,
                    'status' => UnitsStatusEnum::getStatus(intval($unit->status)),
                ]);


            // dd($this->selectUnits)
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
        } else {
            $this->transfer_quantity = $value;
        }

        $this->calculateFinalQuantities();
    }

    public function calculateFinalQuantities()
    {
        if ($this->selectedUnit) {
            $this->selectedUnit['final_quantity'] = $this->selectedUnit['current_quantity'] + $this->transfer_quantity;
            $this->unit['final_quantity'] = $this->unit['current_quantity'] - $this->transfer_quantity;
        }
    }


    public function updatedActionType($actionType)
    {
        // dd($actionType == UnitsHistoryTypeEnum::TransferToWarehouse->value || $actionType == UnitsHistoryTypeEnum::TransferToWorker->value || $actionType == UnitsHistoryTypeEnum::TransferToOtherUnit->value);
        if ($actionType == UnitsHistoryTypeEnum::TransferToWarehouse->value || $actionType == UnitsHistoryTypeEnum::TransferToWorker->value || $actionType == UnitsHistoryTypeEnum::TransferToOtherUnit->value) {
            $this->loadWarehousesAndWorkers();
        } elseif ($actionType == UnitsHistoryTypeEnum::Baja->value) {
            $this->unsubscribe = true;
        }
    }

    private function loadWarehousesAndWorkers()
    {
        $queryWarehouse = Warehouse::where('business_id', auth()->user()->business->id);

        if ($this->hasWarehouse) {
            $this->warehouses = $queryWarehouse->where('id', '!=', $this->unit->warehouse_id)->get()->toArray();
        } else {
            $this->warehouses = $queryWarehouse->get()->toArray();
        }

        $queryWorker = User::where('business_id', auth()->user()->business->id);

        if ($this->hasWorker) {
            $this->workers = $queryWorker->where('id', '!=', $this->unit->worker_id)->get()->toArray();
        } else {
            $this->workers = $queryWorker->get()->toArray();
        }

    }






public function rules(){
    return [
        'actionType' => 'required',
        // 'originableSelected' => 'required',
        // 'destinationableSelected' => 'required',
    ];
}

public function messages(){
    return [
        'actionType.required' => 'El tipo de acción es requerido',
        // 'originableSelected.required' => 'El origen es requerido',
        // 'destinationableSelected.required' => 'El destino es requerido',
    ];
}



    public function save(){

        $this->validate();

        // if ($this->actionType['id'] == 5 && $this->unit['final_quantity'] == 0) {
        //     // Realizar las acciones necesarias antes de la confirmación
        //     // Si es necesario, puedes poner más lógica aquí
        //     // Mostrar la confirmación
        //     $this->dispatchBrowserEvent('confirmTransfer');
        //     return;
        // }

      
        switch ($this->actionType['id']) {
            case UnitsHistoryTypeEnum::TransferToWarehouse->value:
                // dd('warehouse');
                $this->transferToWarehouse();
                break;
            case UnitsHistoryTypeEnum::TransferToWorker->value:
                // dd('worker');
                $this->transferToWorker();
                break;
            case UnitsHistoryTypeEnum::TransferToOtherUnit->value:
                // dd('unit');
                $this->transferToOtherUnit();
                break;
            case UnitsHistoryTypeEnum::Baja->value:
                // dd('down');
                $this->downUnit();
                break;
            default:
                break;
        }

        // UnitHistory::create([


        // ]);

    }



    private function transferToWarehouse()
    {

        // dd($this->selectedWarehouse);
       if(!$this->unit->worker_id && $this->unit->warehouse_id){

                    //  dd($this->unit);
            $unit_history = UnitHistory::create([
                'unit_id' => $this->unit->id,
                'type' => UnitsHistoryTypeEnum::TransferToWarehouse->value,
                'originable_type' => 'App\Models\Warehouse',
                'originable_id' => $this->unit->warehouse_id,
                'destinationable_type' => 'App\Models\Warehouse',
                'destinationable_id' => $this->selectedWarehouse['id'],
                'created_by' => auth()->id(),
            ]);


       }elseif($this->unit->worker_id && !$this->unit->warehouse_id){


        $unit_history = UnitHistory::create([
            'unit_id' => $this->unit->id,
            'type' => UnitsHistoryTypeEnum::TransferToWarehouse->value,
            'originable_type' => 'App\Models\User',
            'originable_id' => $this->unit->warehouse_id,
            'destinationable_type' => 'App\Models\Warehouse',
            'destinationable_id' => $this->selectedWarehouse['id'],
            'created_by' => auth()->id(),
        ]);
         

       }
        


        $this->unit->update([
            'warehouse_id' => $this->selectedWarehouse['id'],
            'worker_id' => null,
        ]);



       
        
        session()->flash('notification', [
            'message' => 'Accion ejecutada correctamente',
            'type' => Notifications::icons('success')
        ]);
        

        $this->redirectRoute('panel.stock.inventory-show', ['product' => $this->product->id, 'unit' => $this->unit->id]);
    }




    private function transferToWorker()
    {

        if($this->unit->warehouse_id && !$this->unit->worker_id){
            $unit_history = UnitHistory::create([
                'unit_id' => $this->unit->id,
                'type' => UnitsHistoryTypeEnum::TransferToWorker->value,
                'originable_type' => 'App\Models\Warehouse',
                'originable_id' => $this->unit->warehouse_id,
                'destinationable_type' => 'App\Models\User',
                'destinationable_id' => $this->selectedWorker['id'],
                'created_by' => auth()->id(),
            ]);

        }elseif($this->unit->worker_id && !$this->unit->warehouse_id){

            $unit_history = UnitHistory::create([
                'unit_id' => $this->unit->id,
                'type' => UnitsHistoryTypeEnum::TransferToWorker->value,
                'originable_type' => 'App\Models\User',
                'originable_id' => $this->unit->worker_id,
                'destinationable_type' => 'App\Models\User',
                'destinationable_id' => $this->selectedWorker['id'],
                'created_by' => auth()->id(),
            ]);

        }
      


        $this->unit->update([
            'worker_id' => $this->selectedWorker['id'],
            'warehouse_id' => null,
        ]);
        


        session()->flash('notification', [
            'message' => 'Accion ejecutada correctamente',
            'type' => Notifications::icons('success')
        ]);

        

        $this->redirectRoute('panel.stock.inventory-show', ['product' => $this->product->id, 'unit' => $this->unit->id]);
    }

    private function transferToOtherUnit()
    {

        $this->unit->update([
            'worker_id' => null,
            'warehouse_id' => null,
            'current_quantity' => $this->unit->current_quantity - $this->transfer_quantity,
        ]);

     

        $unit = Unit::find($this->selectedUnit['id']);

        $unit->update([
            'worker_id' => $this->selectedWorker,
            'warehouse_id' => $this->selectedWarehouse,
            'current_quantity' => $unit->current_quantity + $this->transfer_quantity,
        ]);



        session()->flash('notification', [
            'message' => 'Accion ejecutada correctamente',
            'type' => Notifications::icons('success')
        ]);
        
        
        UnitHistory::create([
            'unit_id' => $this->unit->id,
            'type' => UnitsHistoryTypeEnum::TransferToOtherUnit->value,
            'originable_type' => 'App\Models\Unit',
            'originable_id' => $this->unit->id,
            'destinationable_type' => 'App\Models\Unit',
            'destinationable_id' => $this->selectedUnit['id'],
            'created_by' => auth()->id(),
        ]);



        UnitHistory::create([
            'unit_id' => $this->unit->id,
            'type' => UnitsHistoryTypeEnum::ReceiveTransfer->value,
            'originable_type' => 'App\Models\Unit',
            'originable_id' => $this->unit->id,
            'destinationable_type' => 'App\Models\Unit',
            'destinationable_id' => $this->selectedUnit['id'],
            'created_by' => auth()->id(),
        ]);

        if($this->unit['final_quantity'] == 0){

            $this->downUnit();
        }

        

        $this->redirectRoute('panel.stock.inventory-show', ['product' => $this->product->id, 'unit' => $this->unit->id]);
    }

    public function downUnit()
    {

        $this->unit->update([
            'status' => UnitsStatusEnum::DISCHARGUED->value,
        ]);

        UnitHistory::create([
            'unit_id' => $this->unit->id,
            'type' => UnitsHistoryTypeEnum::Baja->value,
            'originable_type' => $this->unit->originable_type,
            'originable_id' => $this->unit->originable_id,
            'destinationable_type' => $this->unit->destinationable_type,
            'destinationable_id' => $this->unit->destinationable_id,
            'created_by' => auth()->id(),
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
    public function updateSelectedBranches($value)
    {
        $this->selectedUnit = $value;
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
