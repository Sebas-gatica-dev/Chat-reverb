<?php

namespace App\Livewire\Panel\Property\Visit;

use App\Enums\StatusVisitEnum;
use App\Helpers\Notifications;
use App\Models\Customer;
use App\Models\Property;
use App\Models\Visit;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

class UpdateStatusVisit extends Component
{

    public Customer $customer;
    public Property $property;
    public Visit $visit;

    public $nextStatus;
    public $latitude;
    public $longitude;
    public $approximateTime;


    public function validationAttributes()
    {
        return [
            'approximateTime' => 'tiempo aproximado',
            'latitude' => 'latitud',
            'longitude' => 'longitud',
        ];
    }
    public function updateStatus()
    {

        // Construir el nombre del método
        $methodName = 'updateStatus' . $this->visit->status->name;

        // Verificar si el método existe en la clase actual
        if (method_exists($this, $methodName)) {
            // Llamar al método de forma dinámica
            call_user_func([$this, $methodName]);
        } else {
            // Manejar el caso cuando el método no existe
            throw new \Exception("El método {$methodName} no existe.");
        }
    }

    #[On('updateLocation')]
    public function updateLocation($latitude, $longitude)
    {
        $this->latitude = $latitude;
        $this->longitude = $longitude;
    }

    public function updateStatusPending()
    {
        $this->validate([
            'approximateTime' => 'required|numeric|min:1',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        $this->visit->status = StatusVisitEnum::OnTheWay;
        $this->visit->save();

        $this->visit->statusChanges()->create([
            'status' => StatusVisitEnum::OnTheWay,
            'approximate_time' => $this->approximateTime,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
        ]);

        $this->dispatch('notification', [
            'message' => 'El estado de la visita se ha actualizado a "En camino".',
            'type' => Notifications::icons('success'),
        ]);

        $this->redirectRoute('panel.customers.property.show', [$this->customer, $this->property], true, true);
    }
    public function updateStatusOnTheWay()
    {


        $this->visit->status = StatusVisitEnum::AtTheDoor;
        $this->visit->save();

        $this->visit->statusChanges()->create([
            'status' => StatusVisitEnum::AtTheDoor,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
        ]);

        //logica de enviar mail notificar al cliente

        $this->dispatch('notification', [
            'message' => 'El estado de la visita se ha actualizado a "En la puerta".',
            'type' => Notifications::icons('success'),
        ]);

        $this->redirectRoute('panel.customers.property.show', [$this->customer, $this->property], true, true);
    }

    public function updateStatusAtTheDoor()
    {
        $this->visit->status = StatusVisitEnum::InProgress;
        $this->visit->save();

        $this->visit->statusChanges()->create([
            'status' => StatusVisitEnum::InProgress,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
        ]);

        //logica de enviar mail notificar al cliente

        $this->dispatch('notification', [
            'message' => 'El estado de la visita se ha actualizado a "En progreso".',
            'type' => Notifications::icons('success'),
        ]);

        $this->redirectRoute('panel.customers.property.show', [$this->customer, $this->property], true, true);
    }

    public function updateStatusInProgress()
    {
        $this->visit->status = StatusVisitEnum::Completed;
        $this->visit->save();

        $this->visit->statusChanges()->create([
            'status' => StatusVisitEnum::Completed,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
        ]);

        //logica de enviar mail notificar al cliente

        $this->dispatch('notification', [
            'message' => 'El estado de la visita se ha actualizado a "Completada".',
            'type' => Notifications::icons('success'),
        ]);

        $this->redirectRoute('panel.customers.property.show', [$this->customer, $this->property], true, true);
    }

    public function updateStatusCompleted()
    {
        dd('completed');
    }

    public function updateStatusRescheduled()
    {
        dd('rescheduled');
    }

    public function updateStatusCancelled()
    {
        dd('cancelled');
    }

    public function updateStatusIncomplete()
    {
        dd('incomplete');
    }



    public function render()
    {
        return view('livewire.panel.property.visit.update-status-visit')
            ->layout('layouts.panel');
    }
}
