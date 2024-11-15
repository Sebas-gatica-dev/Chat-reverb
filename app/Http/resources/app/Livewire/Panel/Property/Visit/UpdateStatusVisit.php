<?php

namespace App\Livewire\Panel\Property\Visit;

use App\Enums\StatusVisitEnum;
use App\Livewire\Panel\Visit\VisitStatus\ProblemStatus;
use App\Models\Customer;
use App\Models\Input;
use App\Models\Property;
use App\Models\Visit;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use App\Traits\ValidateNotificationTrait;

class UpdateStatusVisit extends Component
{
    use WithFileUploads, ValidateNotificationTrait;

    public Visit $visit;
    
    public $currentStatus;
    public $latitude;
    public $longitude;
    public $formsDynamic = [];
    public $problemFormDynamic = [];
    public $steps = 1;

    public $locationActive = false;
    public $locationBlocked = false;

    public function mount()
    {
        $this->currentStatus = $this->visit->status;
        $this->formsDynamic = $this->updateDynamicFormsForVisitStatus($this->visit->status->value);
    }

    #[On('open-problems-modal-from-big-delay')]
    public function problemsModal($status)
    {
        $this->problemFormDynamic = $this->updateDynamicFormsForVisitStatus($status);
        $this->dispatch('open-problems-modal', $this->problemFormDynamic, $status)->to(ProblemStatus::class);
    }

    public function updateDynamicFormsForVisitStatus($status = null)
    {
        $status = StatusVisitEnum::from($status);

        $query = Input::where('business_id', auth()->user()->business_id)
            ->where('sector', $status->getSector()->value)
            ->select('id', 'label', 'input_type', 'placeholder', 'required', 'options')
            ->orderBy('order', 'asc')
            ->get()
            ->mapWithKeys(function ($input) {
                return [
                    $input->id => [
                        'label' => $input->label,
                        'input_type' => $input->input_type,
                        'placeholder' => $input->placeholder,
                        'required' => $input->required,
                        'options' => $input->options,
                        'value' => null,
                    ],
                ];
            })->toArray();

        return $query;
    }

    #[On('updateLocation')]
    public function updateLocation($latitude, $longitude)
    {
        $this->latitude = $latitude;
        $this->longitude = $longitude;
        $this->locationActive = true;
        $this->locationBlocked = false;
    }

    #[On('blockLocation')]
    public function blockLocation()
    {
        $this->locationBlocked = true;
        $this->locationActive = false;
    }

    public function render()
    {
        return view('livewire.panel.property.visit.update-status-visit')
            ->layout('layouts.panel');
    }
}
