<?php

namespace App\Livewire\Panel\Property\Visit\Modals;

use App\Models\Visit;
use Livewire\Attributes\On;
use Livewire\Component;
use App\Enums\Forms\SectorTypeEnum;
use App\Enums\StatusVisitEnum;
use App\Models\Input;
use App\Models\InputData;
use App\Models\StatusChange;
use App\Models\VisitStatus;

class ModalVisitStatusData extends Component
{

    // public Visit $visit;    
    public $visit;
    public $visitStatus;
    public $defaultDataFields;
    public $defaultDataFieldsProblem;
    public $dataFormsDynamic = [];
    public $currentStatus;
    public $sectorList = [];
    public $statusVisitList = [];
    public $currentStatusSector;
    
    public $inputData;

    public $selectedSector;

    public $statusChange;
    

    public $hasFormDynnamic = false;
    public $modalStatusChangeData = false;

    public $nameEvent = 'open-status-change-data-modal-';


    public $statusName;

    public $worker;

    public function mount(){
  
    // $this->visitStatus = $this->visit->status->value;
    // $this->nameEvent = $this->nameEvent . $this->visit->id;

    // dd($this->currentStatusSector);
    // dd($this->dataFormsDynamic);

    }

    public function mapTheSectorList()
    {
    }

    public function getListeners(){
        return [
            'load-status-change-data-modal' => 'loadDataModal',
            'close-status-change-data-modal' => 'closeModalStatusChangeData',
            'update-selected-sector' => 'updateSelectedSector',
        ];
    }


    public function loadDataModal($status,$visit)
    {
       $this->visit = $visit;

    //    dd($this->visit);
       $this->visitStatus = $this->visit['status'];

        $enumCase = StatusVisitEnum::getSectorName($status);
        $this->statusName = StatusVisitEnum::getStatus($enumCase);
        $this->loadStatusChange($status);
        $this->loadDataFormsDynamic($status);

    
        // dd($this->statusChange,$this->dataFormsDynamic);
    
        $this->modalStatusChangeData = true;
    }

    public function loadDataFormsDynamic($status){
            $this->dataFormsDynamic = Input::where('business_id', auth()->user()->business_id)
            ->where('sector', $status)
            ->select('id', 'label', 'input_type', 'placeholder', 'required', 'options')
            ->orderBy('order', 'asc') // Ordenar por el campo 'order'
            ->get()->toArray();
        if ($this->dataFormsDynamic) {
            foreach ($this->dataFormsDynamic as &$input) {

                $inputData = InputData::where('input_id', $input['id'])
                    ->where('modeable_type', 'App\Models\StatusChange')
                    ->where('modeable_id', $this->statusChange->id)
                    ->get()->toArray();

                    // dd($inputData);

                if ($inputData) {
                    $input['input_data'] = $inputData;
                }
            }


        }   

        //  dd($this->dataFormsDynamic);
    }

    public function loadStatusChange($status){
        $enumCase = StatusVisitEnum::getSectorName($status);
        // dd($enumCase);
        $this->statusChange = StatusChange::where('visit_id', $this->visit['id'])
            ->where('status', $enumCase->value)
            ->first();
            // dd($this->statusChange);
        if (!is_null($this->statusChange->data)) {

        $defaultFieldsData = json_decode($this->statusChange->data, true);

       
                $this->defaultDataFields = $defaultFieldsData;
        }


    }

    public function isVisitStateInProgress(){
       
    }


    public function closeModalStatusChangeData()
    {
        $this->defaultDataFields = [];
        $this->defaultDataFieldsProblem = null;
        $this->dataFormsDynamic = [];
        $this->currentStatus = null;
        $this->sectorList = [];
        $this->statusVisitList = [];
        $this->currentStatusSector = null;
        $this->inputData = null;
        $this->selectedSector = null;
        $this->statusChange = null;
        $this->hasFormDynnamic = false;
        $this->statusName = null;
        $this->worker = null;

        $this->dispatch('close-status-change-data-modal');
    }


    #[On('update-selected-sector')]
    public function updateSelectedSector($sector){
        $this->selectedSector = $sector;
    }   

    public function loadInputData(){
        $this->defaultDataFields = $this->updateDynamicFormsForVisitStatus($this->visitStatus);
    }   

    public function render()
    {
        return view('livewire.panel.property.visit.modals.modal-visit-status-data')->layout('layouts.panel');
    }
}
