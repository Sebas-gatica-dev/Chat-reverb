<?php

namespace App\Livewire\Panel\Visit\VisitStatus;

use App\Enums\StatusVisitEnum;
use App\Helpers\Notifications;
use App\Models\InputData;
use App\Models\Visit;
use App\Rules\FormDynamicRequired;
use DateTime;
use Livewire\Attributes\On;
use Livewire\Component;


class Ontheway extends Component
{

    public Visit $visit;
    public $formsDynamic = [];


    public $hasDelayTime;
    public $delayTime;
    public $reasonDelay;

    public $visitDateDiference;
    public $bigDelay;


    public $current_latitude;
    public $current_longitude;



   public function mount($latitude, $longitude){

   

       dump('es aca', $this->checkDelay($this->visit->date,$this->visit->time) ? true : false);

        $this->hasDelayTime = $this->checkDelay($this->visit->date,$this->visit->time) ? true : false;
        $this->current_latitude = $latitude;
        $this->current_longitude = $longitude;

   }


    public function rules(){
       return [
         'formsDynamic.*' => [new FormDynamicRequired($this->formsDynamic)],
       ];
    }


    #[On('update-status')]
    public function save(){

        $this->validate();

        $this->dispatch('validate-form-dynamic');

        $this->visit->status = StatusVisitEnum::ATTHEDOOR;
        $this->visit->save();

        // Obtener el último cambio de estado
        $lastStatusChange = $this->visit->statusChanges()->latest()->first();
        $createdAt = $lastStatusChange->created_at;
        $now = now();
        $intervalStatus = $now->diffInMinutes($createdAt, false);
        $intervalStatus = abs((int) $intervalStatus);



        
        $visit_activity = json_encode([
            'reason-delay' => $this->reasonDelay,
            'has-delay-time' => $this->hasDelayTime,
            'has-big-delay' => $this->bigDelay,
            'big-delay-time' => $this->visitDateDiference, 
        ]);
       

       
        $newStatusChange = $this->visit->statusChanges()->create([
            'status' => StatusVisitEnum::ATTHEDOOR,
            'latitude' => $this->current_latitude,
            'longitude' => $this->current_longitude,
            'interval_status' => $intervalStatus,
            'data' => $visit_activity,
            'out_of_range' => $this->checkIfOutOfRange($this->current_latitude, $this->current_longitude),
        ]);


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

        // Lógica de enviar mail notificar al cliente
        $this->dispatch('notification', [
            'message' => 'El estado de la visita se ha actualizado a "En la puerta".',
            'type' => Notifications::icons('success'),
        ]);

        $this->redirectRoute('panel.customers.property.show', [$this->visit->customer_id, $this->visit->property_id], true, true);
    }


    public function checkDelay($fechaPactada, $horarioPactado) {
        // Convertir la fecha y el horario pactado a un objeto DateTime
        $fechaHoraPactada = DateTime::createFromFormat('Y-m-d H:i:s', "$fechaPactada $horarioPactado");
        $fechaHoraActual = new DateTime();
    
        // Verificar si la fecha pactada es el mismo día que la fecha actual
        if ($fechaHoraPactada->format('Y-m-d') !== $fechaHoraActual->format('Y-m-d')) {
            // Si la fecha pactada es un día anterior, calcular minutos totales de retraso
            $diferencia = $fechaHoraActual->diff($fechaHoraPactada);
    
            $this->bigDelay = true;
            $dias = $diferencia->days;
            $horas = $diferencia->h;
            $minutos = $diferencia->i;
      

            // Formatear como "X días, Y horas, Z minutos, W segundos"
            $this->visitDateDiference = "{$dias} días, {$horas} horas, {$minutos} minutos";
            
                return $diferencia; // Retorna un objeto DateInterval
            }
    
        // Si es el mismo día, aplicar la lógica existente para el retraso en minutos
        // Calcular la diferencia en minutos
        $diferencia = $fechaHoraActual->diff($fechaHoraPactada);
        $diferenciaMinutos = ($diferencia->h * 60) + $diferencia->i;
    
        // Verificar si está retrasado más de 20 minutos
        if ($fechaHoraActual > $fechaHoraPactada && $diferenciaMinutos > 20) {
            return $diferencia; // Retorna el objeto DateInterval, representando solo horas y minutos de diferencia
        } else {
            return null; // No hay retraso o es menor o igual a 20 minutos
        }
    }
    

    
    function checkIfOutOfRange($lat1, $lon1) {

        $radioTierra = 6371000; // Radio de la Tierra en metros
    

        $property = $this->visit->property;
       
        // Convertir grados a radianes
        $lat1Rad = deg2rad($lat1); // Latitud de la ubicación actual del operario
        $lon1Rad = deg2rad($lon1); // Longitud de la ubicación actual del operario
        $lat2Rad = deg2rad($property->latitude); // Latitud de la propiedad
        $lon2Rad = deg2rad($property->longitude); // Longitud de la propiedad
    
        // Calcular diferencias
        $dlat = $lat2Rad - $lat1Rad; // Diferencia de latitudes
        $dlon = $lon2Rad - $lon1Rad; // Diferencia de longitudes
    
        // Fórmula de Haversine
        $a = sin($dlat / 2) * sin($dlat / 2) +
             cos($lat1Rad) * cos($lat2Rad) * 
             sin($dlon / 2) * sin($dlon / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
    
        $distancia = $radioTierra * $c; // Distancia en metros
    
        // Verificar si está dentro del radio de 200 metros
        return $distancia <= 200; //Si es true esta dentro del radio de 200 metros, si es false esta fuera del radio de 200 metros
    }
  





    public function render()
    {
        return view('livewire.panel.visit.visit-status.ontheway')->layout('layouts.panel');
    }
}
