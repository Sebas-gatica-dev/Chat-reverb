<?php

namespace App\Livewire\Components;

use App\Helpers\Notifications;
use Livewire\Component;
use Illuminate\Support\Facades\Validator;
class AddDateAvailabilityGeneral extends Component
{
    public $model;
    public $availabilities = [];
    public $newAvailability = ['day' => '', 'start_time' => '', 'end_time' => ''];




    public function rules()
    {
        return [
            'newAvailability.day' => 'required_if:newAvailability.start_time,|required_if:newAvailability.end_time,',
            'newAvailability.start_time' => 'required_if:newAvailability.day,|date_format:H:i',
            'newAvailability.end_time' => 'required_if:newAvailability.day,|date_format:H:i',
        ];
    }

    public function messages()
    {
        return [


            'newAvailability.day.required' =>  '<span class="font-medium">Oops</span> :attribute requerido.',
            'newAvailability.start_time.required' =>  '<span class="font-medium">Oops</span> :attribute requerido.',
            'newAvailability.end_time.required' =>  '<span class="font-medium">Oops</span> :attribute requerido.',
            'newAvailability.start_time.date_format' =>  '<span class="font-medium">Oops</span> :attribute invalida.',
            'newAvailability.end_time.date_format' => '<span class="font-medium">Oops</span> :attribute invalida.',

        ];
    }


    public function validationAttributes()
    {
        return [
            'newAvailability.day' => 'Dia',
            'newAvailability.start_time' =>  'Hora de inicio',
            'newAvailability.end_time' =>  'Hora de fin',
        ];
    }


    protected function validationFailed($validator)
    {
        $errors = $validator->errors()->getMessages();

    }


    public function mount($selectedValues = null)
    {
        if ($selectedValues) {
            // dd($selectedValues);
            // $groupedAvailabilities = [];
            $this->availabilities = $selectedValues;

            // foreach ($selectedValues as $availability) {
            //     $groupedAvailabilities[$availability['day']][] = $availability;
            // }
            // $this->availabilities = $groupedAvailabilities;
        }
    }

    public function addAvailability()
    {

          $this->validate();



        // Caso especial: Si la franja horaria es de 00:00 a 00:00, la consideramos como una franja completa de 24 horas
        if ($this->newAvailability['start_time'] === '00:00' && $this->newAvailability['end_time'] === '00:00') {
            $this->newAvailability['end_time'] = '24:00';
        } else {
            $this->validate([
                'newAvailability.end_time' => 'after:newAvailability.start_time',
            ]);
        }

        $dayOptions = [
            'Todos los días' => ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'],
            'Lunes a viernes' => ['monday', 'tuesday', 'wednesday', 'thursday', 'friday'],
            'Sábados y domingos' => ['saturday', 'sunday'],
            'Lunes' => ['monday'],
            'Martes' => ['tuesday'],
            'Miércoles' => ['wednesday'],
            'Jueves' => ['thursday'],
            'Viernes' => ['friday'],
            'Sábado' => ['saturday'],
            'Domingo' => ['sunday'],
        ];

        $selectedDays = $dayOptions[$this->newAvailability['day']];

        foreach ($selectedDays as $day) {
            // Limitar a tres franjas por día
            $dayAvailabilities = array_filter($this->availabilities, fn ($a) => $a['day'] === $day);
            if (count($dayAvailabilities) >= 3) {
                $this->dispatch('notification', ['type' => Notifications::icons('error'), 'message' => 'No puedes añadir más de tres franjas horarias por día']);
                return;
            }

            // Comprobar solapamiento y duplicación
            foreach ($this->availabilities as $existingAvailability) {
                if (
                    $existingAvailability['day'] === $day &&
                    ($this->newAvailability['start_time'] < $existingAvailability['end_time']) &&
                    ($this->newAvailability['end_time'] > $existingAvailability['start_time'])
                ) {
                    $this->dispatch('notification', ['type' => Notifications::icons('error'), 'message' => 'Ya existe una franja horaria que se solapa con la que intentas añadir']);
                    return;
                }
            }

            // Agregar la nueva franja horaria con un identificador único
            $this->availabilities[] = [
                'id' => uniqid(),
                'day' => $day,
                'start_time' => $this->newAvailability['start_time'],
                'end_time' => $this->newAvailability['end_time']
            ];
        }

       $this->dispatch('notification', ['type' => Notifications::icons('success'), 'message' => 'Franja horaria agregada correctamente']);

        // Emitir evento al componente padre
        $this->dispatch('updateAvailabilities', $this->availabilities);



        // Resetear los valores de la nueva franja horaria
        $this->newAvailability = ['day' => '', 'start_time' => '', 'end_time' => ''];
    }

    public function removeAvailability($id)
    {
        $this->availabilities = array_filter($this->availabilities, fn ($availability) => $availability['id'] !== $id);
        $this->availabilities = array_values($this->availabilities); // Reindexar array

        // Emitir evento al componente padre
        $this->dispatch('updateAvailabilities', $this->availabilities);
    }

    public function translateDay($day)
    {
        $days = [
            'monday' => 'Lunes',
            'tuesday' => 'Martes',
            'wednesday' => 'Miércoles',
            'thursday' => 'Jueves',
            'friday' => 'Viernes',
            'saturday' => 'Sábado',
            'sunday' => 'Domingo',
        ];

        return $days[$day] ?? $day;
    }

    public function getGroupedAvailabilities()
    {
        $grouped = [];

        foreach ($this->availabilities as $availability) {
            $grouped[$availability['day']][] = $availability;
        }

        // Ordenar los días de la semana
        $orderedDays = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
        $groupedOrdered = [];
        foreach ($orderedDays as $day) {
            if (isset($grouped[$day])) {
                $groupedOrdered[$day] = $grouped[$day];
            }
        }

        return $groupedOrdered;
    }

    public function render()
    {
        return view('livewire.components.add-date-availability-general', [
            'groupedAvailabilities' => $this->getGroupedAvailabilities()
        ]);
    }
}
