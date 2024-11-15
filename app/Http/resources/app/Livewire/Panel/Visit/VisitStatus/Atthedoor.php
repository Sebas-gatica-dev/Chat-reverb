<?php

namespace App\Livewire\Panel\Visit\VisitStatus;

use App\Enums\StatusVisitEnum;
use App\Helpers\Notifications;
use App\Models\Customer;
use App\Models\InputData;
use App\Models\Property;
use App\Models\Visit;
use App\Rules\FormDynamicRequired;
use DateTime;
use Livewire\Attributes\On;
use Livewire\Component;





class Atthedoor extends Component
{


    public Visit $visit;
    public Customer $customer;
    public Property $property;
    public $formsDynamic = [];

    public $hasDelayTime;
    public $delayTime;
    public $reasonDelay;
    public $visitDateDiference;
    public $bigDelay;


    
    public $current_latitude;
    public $current_longitude;
    


    public function mount($latitude, $longitude){

        $this->hasDelayTime = $this->checkDelay($this->visit->date,$this->visit->time) ? true : false;
        $this->current_latitude = $latitude;
        $this->current_longitude = $longitude;

        // dump($this->current_latitude, $this->current_longitude);
     
    }

    public function rules(){
       return [
            'formsDynamic.*' => [new FormDynamicRequired($this->formsDynamic)],
          
         ];
    }


    public function messages(){

        return [
          
        ];
    }


    #[On('update-status')]
    public function save(){

        $this->validate();

        $this->visit->status = StatusVisitEnum::INPROGRESS;
        $this->visit->save();

        $lastStatusChange = $this->visit->statusChanges()->where('status', StatusVisitEnum::ATTHEDOOR->value)->first();
        $createdAt = $lastStatusChange->created_at;
        $now = now();
        $intervalStatus = $now->diffInMinutes($createdAt, false);
        $intervalStatus = abs((int) $intervalStatus);

        


            $array_decoded = json_decode($lastStatusChange['data']);

            $this->reasonDelay = $array_decoded['reason-delay'];



            $visit_activity = json_encode([
                'delay-time' =>   $this->checkDelay($this->visit->date,$this->visit->time), 
                'has-delay-time' => $this->hasDelayTime,
            ]);
            
    
        $newStatusChange =  $this->visit->statusChanges()->create([
            'status' => StatusVisitEnum::INPROGRESS,
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

        //logica de enviar mail notificar al cliente
        // $this->showVisitInProgressForm = true;

        $this->dispatch('notification', [
            'message' => 'El estado de la visita se ha actualizado a "En progreso".',
            'type' => Notifications::icons('success'),
        ]);

        $this->redirectRoute('panel.customers.property.show', [$this->visit->customer_id, $this->visit->property_id], true, true);
    }


    

    // public function checkDelay($horarioPactado) {

      
    //     $horarioPactado = DateTime::createFromFormat('H:i:s', $horarioPactado);
    //     $horarioActual = new DateTime();
    
       
    //     $diferencia = $horarioActual->diff($horarioPactado);
    //     $diferenciaMinutos = ($diferencia->h * 60) + $diferencia->i;
    
        
    //     if ($horarioActual > $horarioPactado && $diferenciaMinutos > 20) {
          
           

    //        return $diferenciaMinutos;

    //     } else {

    //         return null; 

    //     }

    // }


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
    
    // Ejemplo de uso:
    // $latitud1 = -34.603722; // Ejemplo de coordenada 1
    // $longitud1 = -58.381592;
    // $latitud2 = -34.602022; // Ejemplo de coordenada 2
    // $longitud2 = -58.380011;
    
    // if (calcularDistancia($latitud1, $longitud1, $latitud2, $longitud2)) {
    //     echo "La ubicación está dentro del radio de 200 metros.";
    // } else {
    //     echo "La ubicación está fuera del radio de 200 metros.";
    // }


    
    public function render()
    {
        return view('livewire.panel.visit.visit-status.atthedoor')->layout('layouts.panel');
    }
}
