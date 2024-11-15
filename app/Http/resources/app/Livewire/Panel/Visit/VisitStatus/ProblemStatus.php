<?php

namespace App\Livewire\Panel\Visit\VisitStatus;

use App\Enums\StatusVisitEnum;
use App\Helpers\Notifications;
use App\Models\InputData;
use App\Models\Visit;
use App\Rules\FormDynamicRequired;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\Attributes\On;

class ProblemStatus extends Component
{
    public Visit $visit;
    public $reason;
    public $formsDynamic = [];
    public $problemStatus;
    public $dateRescheduled;

    #[On('open-problems-modal')]
    public function prueba($formsDynamic, $status = null)
    {
        $this->formsDynamic = $formsDynamic;
        $this->problemStatus = StatusVisitEnum::from($status);
    }

    public function rules()
    {
        return [
            'formsDynamic.*' => [new FormDynamicRequired($this->formsDynamic)],
            'reason' => 'required|string|max:200',
            'dateRescheduled' => [Rule::requiredIf($this->problemStatus == StatusVisitEnum::RESCHEDULED), 'date']
        ];
    }

    public function messages()
    {
        return [
            'reason.required' => 'Debes escribir el motivo del problema para poder avanzar.',
            'reason.string' => 'Este campo debe ser un texto.',
            'reason.max' => 'Este campo no debe exceder los 200 caracteres.',
            'dateRescheduled.required' => 'Debes proveer una fecha para la reprogramación.',
            'dateRescheduled.date' => 'La fecha de reprogramación debe ser una fecha válida.',
        ];
    }

    public function save()
    {
        $this->validate();

        $lastStatusChange = $this->visit->statusChanges()->where('status', $this->visit->status)->first();

        $createdAt = $lastStatusChange->created_at;
        $now = now();
        $intervalStatus = $now->diffInMinutes($createdAt, false);
        $intervalStatus = abs((int) $intervalStatus);
        $json = [
            'reason' => $this->reason,
        ];

        if ($this->dateRescheduled) {
            $json['date_rescheduled'] = $this->dateRescheduled;
        }

        // dd([
        //     'lastStatusChange' => $lastStatusChange,
        //     'status' => $this->problemStatus,
        //     'interval_status' => $intervalStatus,
        //     'data' => json_encode($json),
        // ]);

        $newStatusChange = $this->visit->statusChanges()->create([
            'status' => $this->problemStatus,
            'interval_status' => $intervalStatus,
            'data' => json_encode($json),
        ]);

        $this->visit->status = $this->problemStatus->value;
        $this->visit->save();

        if ($this->formsDynamic) {
            foreach ($this->formsDynamic as $key => $form) {

                $data = [
                    'value' => $form['value'],
                ];

                $inputData = new InputData();
                $inputData->input_id = $key;
                $inputData->data = json_encode($data);
                $inputData->modeable_type = 'App\Models\StatusChange';
                $inputData->modeable_id = $newStatusChange->id;
                $inputData->user_id = auth()->id();
                $inputData->save();
            }
        }

        $this->dispatch('notification', [
            'message' => 'La visita ha sido actualizada correctamente.',
            'type' => Notifications::icons('success'),

        ]);

        $this->redirectRoute('panel.customers.property.show', [$this->visit->customer_id, $this->visit->property_id], navigate: true);
    }

    public function render()
    {
        return view('livewire.panel.visit.visit-status.problem-status')->layout('layouts.panel');
    }
}
