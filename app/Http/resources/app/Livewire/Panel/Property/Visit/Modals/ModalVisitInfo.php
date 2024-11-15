<?php

namespace App\Livewire\Panel\Property\Visit\Modals;

use App\Enums\Forms\SectorTypeEnum;
use App\Enums\StatusVisitEnum;
use App\Models\Input;
use App\Models\InputData;
use App\Models\Visit;
use Livewire\Attributes\On;
use Livewire\Component;




class ModalVisitInfo extends Component
{

    public Visit $visit;
    public $modalVisitInfoData = false;
    public $nameEvent = 'open-modal-visit-info-';
    public $dataFormsDynamic = [];

    public function mount(){
    
    $this->nameEvent = $this->nameEvent . $this->visit->id;    
    
    }





    public function loadFormsDynamic(){
        $this->dataFormsDynamic = Input::where('business_id', auth()->user()->business_id)
        ->where('sector',  SectorTypeEnum::VisitCreate->value)
        ->select('id', 'label', 'input_type', 'placeholder', 'required', 'options')
        ->orderBy('order', 'asc') // Ordenar por el campo 'order'
        ->get()->toArray();

    if ($this->dataFormsDynamic) {
        foreach ($this->dataFormsDynamic as &$input) {
            $inputData = InputData::where('input_id', $input['id'])
                ->where('modeable_type', 'App\Models\Visit')
                ->where('modeable_id', $this->visit->id)
                ->get()->toArray();
                //  dd($input);
            if ($inputData) {
                // dd($inputData);
                // if($input['input_type'] == 'toggle'){
                //     dd($inputData);
                //     $data = json_decode($inputData[0]['data'], true);
                // }
                $input['input_data'] = $inputData;

                $input['input_data'] = json_decode($input['input_data'][0]['data'],true)['value'];
            }
        }


    }   

//      dd($this->dataFormsDynamic);
 }



   public function getListeners(){
        return [
            $this->nameEvent  => 'openModalVisitInfo',
        ];
   }
   


    public function openModalVisitInfo(){
        
        $this->loadFormsDynamic();
        $this->modalVisitInfoData = true;
    }


    
    public function closeModalVisitInfo(){
        $this->dataFormsDynamic = [];
        $this->modalVisitInfoData = false;
    }

    public function render()
    {
        return view('livewire.panel.property.visit.modals.modal-visit-info')->layout('layouts.panel');
    }
}
