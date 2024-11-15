<?php

namespace App\Traits;

use App\Models\TravelTime;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

trait AutomaticRouteTrait
{

    public function checkSpaceForOtherWork($availability, $date, $route)
    {

        
        $dayName = strtoupper(Carbon::parse($date)->format('l'));
        $day = collect($availability)->firstWhere('day.name', $dayName);


        if (!$day) {
            return false; // Si no se encuentra el día, retorna false
        }


        $endTime = Carbon::createFromFormat('H:i', $day['end_time']);
   
        $routesCurrentDay = $route ?? [];
        if (!empty($routesCurrentDay)) {
            $lastPoint = end($routesCurrentDay);
            $endTimeOfCurrentDay = Carbon::createFromFormat('H:i', $lastPoint['end_time']);

            foreach ($route as $visit) {
                $endTimeWithVisit = $endTimeOfCurrentDay->copy()->addMinutes($visit['duration_time'] + $visit['travel_time']);
                if ($endTimeWithVisit < $endTime) {
                    return true; // Retorna true si al menos una visita cabe en el tiempo disponible
                }
            }

            return false; // Retorna false si ninguna visita cabe
        }

        return true; // Retorna true si no hay visitas programadas y por lo tanto hay espacio
    }

    public function getTravelTime($originLat, $originLng, $destinationLat, $destinationLng, $travelMode = 'driving')
    {
        $cacheKey = "{$originLat},{$originLng},{$destinationLat},{$destinationLng}";

        if (isset($this->travelTimeCache[$cacheKey])) {
            return $this->travelTimeCache[$cacheKey];
        }
        // Radio de la Tierra en kilómetros
        $radioTierra = 6371;

        $lat1 = deg2rad($originLat);
        $lon1 = deg2rad($originLng);
        $lat2 = deg2rad($destinationLat);
        $lon2 = deg2rad($destinationLng);

        $diferenciaLat = $lat2 - $lat1;
        $diferenciaLon = $lon2 - $lon1;

        $a = sin($diferenciaLat / 2) * sin($diferenciaLat / 2) +
            cos($lat1) * cos($lat2) *
            sin($diferenciaLon / 2) * sin($diferenciaLon / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        $distanciaDecimal =  ($radioTierra * $c) * 1000;
        $distanciaEntero = (int) round($distanciaDecimal);

        $velocidad = 2.50; // Velocidad en metros por segundo
        $tiempoSegundos = $distanciaEntero / $velocidad;
        $tiempoMinutos = (int) round(($tiempoSegundos / 60));
        $this->travelTimeCache[$cacheKey] = $tiempoMinutos; // Cachear el resultado

        return $tiempoMinutos; // Retornar la distancia en metros
    }

    public function getTravelTimeAPI($originLat, $originLng, $destinationLat, $destinationLng, $mode = 'driving')
    {
        // Redondear las coordenadas a 6 decimales
        $originLat = round($originLat, 6);
        $originLng = round($originLng, 6);
        $destinationLat = round($destinationLat, 6);
        $destinationLng = round($destinationLng, 6);


        // Intentar obtener el tiempo de viaje de la base de datos
        $travelTimeRecord = TravelTime::where(function ($query) use ($originLat, $originLng, $destinationLat, $destinationLng) {
            $query->where(function ($subquery) use ($originLat, $originLng, $destinationLat, $destinationLng) {
                $subquery->where('origin_latitude', $originLat)
                    ->where('origin_longitude', $originLng)
                    ->where('destination_latitude', $destinationLat)
                    ->where('destination_longitude', $destinationLng);
            })->orWhere(function ($subquery) use ($originLat, $originLng, $destinationLat, $destinationLng) {
                $subquery->where('origin_latitude', $destinationLat)
                    ->where('origin_longitude', $destinationLng)
                    ->where('destination_latitude', $originLat)
                    ->where('destination_longitude', $originLng);
            });
        })->first();

        if ($travelTimeRecord) {
            return $travelTimeRecord->travel_time_minutes;
        }


        $url = 'https://maps.googleapis.com/maps/api/distancematrix/json?units=metric'
            . '&origins=' . $originLat . ',' . $originLng
            . '&destinations=' . $destinationLat . ',' . $destinationLng
            . '&mode=' . $mode
            . '&key=' . $this->googleMapsApiKey;

        $response = Http::get($url);
        $data = $response->json();


        if ($data['status'] == 'OK' && $data['rows'][0]['elements'][0]['status'] == 'OK') {
            $travelTime = ($data['rows'][0]['elements'][0]['duration']['value']) / 60;
            $travelTimeEntero = (int) number_format($travelTime, 0, '.', '');

            // Guardar en la base de datos
            TravelTime::create([
                'origin_latitude' => $originLat,
                'origin_longitude' => $originLng,
                'destination_latitude' => $destinationLat,
                'destination_longitude' => $destinationLng,
                'travel_time_minutes' => $travelTimeEntero,
            ]);

            return $travelTimeEntero;
        }
    }

    public function assignVisit(&$route, $visit, $availabilities, $date)
    {
        // Agregar la visita al array de la ruta
        $route[] = $visit;

        // Obtener el índice de la última visita agregada
        $lastIndex = count($route) - 1;

        if ($lastIndex > 0 && isset($route[$lastIndex - 1]['end_time'])) {
            // Si existe una visita anterior, calcular la hora de inicio en función de su hora de fin
            $endTime = Carbon::createFromFormat('H:i', $route[$lastIndex - 1]['end_time']);
            if (Str::startsWith($route[$lastIndex - 1]['id'], 'HOME')) {
                $startTime = $endTime->copy(); // Si es HOME, usamos el mismo tiempo de fin
            } else {
                $startTime = $endTime->copy()->addMinutes($visit['travel_time']); // Agregar el tiempo de viaje
            }
        } else {
            // Obtener la hora de inicio según la disponibilidad y la fecha
            $startTimeString = $this->getStartTime($availabilities, $date);
            if ($startTimeString == null) {
                return; // Operario no tiene disponibilidad
            }
            $startTime = Carbon::createFromFormat('H:i', $startTimeString);
        }

        // Redondear la hora de inicio a los 5 minutos más cercanos
        $startTime = $startTime->minute(ceil($startTime->minute / 5) * 5)->second(0);
        $route[$lastIndex]['start_time'] = $startTime->format('H:i');

      
        // Calcular y redondear la hora de fin usando 'start_time' y 'duration_time'
        $endTime = $startTime->copy()->addMinutes($visit['duration_time']);
        $endTime = $endTime->minute(ceil($endTime->minute / 5) * 5)->second(0);
        $route[$lastIndex]['end_time'] = $endTime->format('H:i');
    }


    public function getStartTime($availability, $date, $visit = null)
    {
        // Convertir la fecha a día de la semana en formato de texto (por ejemplo, 'MONDAY')
        $dayOfWeek = strtoupper(Carbon::parse($date)->format('l'));

        // Usar firstWhere para encontrar el día especificado en la disponibilidad
        $day = collect($availability)->firstWhere('day.name', $dayOfWeek);

        if ($day) {
            $startTime = Carbon::createFromFormat('H:i', $day['start_time']);

            // Solo redondear si los minutos no están ya alineados a los 5 minutos más cercanos
            $roundedMinute = ceil($startTime->minute / 5) * 5;
            if ($startTime->minute !== $roundedMinute) {
                $startTime = $startTime->copy()->minute($roundedMinute)->second(0);
            }
            return $startTime->format('H:i');
        }
        // Retornar null si no se encuentra el día especificado
        return null;
    }

    private function assignOutVisit($visit, $worker = null, $date)
    {
        $this->newRoute[] = $visit;  

        $lastIndex = count($this->newRoute) - 1;

        if ($lastIndex > 0 && isset($this->newRoute[$lastIndex - 1]['end_time'])) {

            $visit['travel_time'] = $this->getTravelTime(
                $this->newRoute[$lastIndex]['latitude'],
                $this->newRoute[$lastIndex]['longitude'],
                $visit['latitude'],
                $visit['longitude']
            );

            $endTime = Carbon::createFromFormat('H:i', $this->newRoute[$lastIndex - 1]['end_time']);
            if (Str::startsWith($this->newRoute[$lastIndex - 1]['id'], 'HOME')) {
                $startTime = $endTime->copy();
            } else {
                $startTime = $endTime->copy()->addMinutes($visit['travel_time']);
            }
        } else {
            $startTimeString = $this->getStartTime($worker->availabilities, strtoupper(Carbon::parse($date)->format('l')), $visit);
            if ($startTimeString == null) {
                return; // Operario no tiene disponibilidad
            }
            $startTime = Carbon::createFromFormat('H:i', $startTimeString);
        }





        // Redondear la hora de inicio a los 5 minutos más cercanos
        $startTime = $startTime->minute(ceil($startTime->minute / 5) * 5)->second(0);
        $this->newRoute[$lastIndex]['start_time'] = $startTime->format('H:i');

        // Calcular y redondear la hora de fin usando 'horaInicio' y 'duration_time'
        $endTime = $startTime->copy()->addMinutes($visit['duration_time']);
        $endTime = $endTime->minute(ceil($endTime->minute / 5) * 5)->second(0);
        $this->newRoute[$lastIndex]['end_time'] = $endTime->format('H:i');

        $this->newRoute[$lastIndex]['out'] = true;
    }



    

    public function checkAvailabilityOfVisitOrProperty($visits, $date, $route = null, $workerAvailability = null)
    {
        // Convertir la fecha en el día de la semana en formato en mayúsculas
        $dayOfWeek = strtoupper(Carbon::parse($date)->format('l'));

        foreach ($visits as $visit) {
            // Disponibilidad de la visita y la propiedad
            $visitAvailability = $visit['availability'];

            // Si ambas disponibilidades (visita y propiedad) son null, la visita es válida y se retorna
            if ($visitAvailability == null) {
                return $visit;
            }

            // Intentamos encontrar la disponibilidad primero en la visita, luego en la propiedad
            $dayAvailability = collect($visitAvailability)
                ->firstWhere('day.name', $dayOfWeek);

            // Si no se encuentra disponibilidad para el día ni en la visita ni en la propiedad, pasar a la siguiente visita
            if ($dayAvailability == null) {
                continue;
            }

            if(!$route && !$workerAvailability){
                return $visit;
            }

            $lastIndex = count($route) - 1;

            // Si hay al menos una visita en la ruta y tiene un 'end_time' definido
            if ($lastIndex >= 0 && isset($route[$lastIndex]['end_time'])) {
                $endTime = Carbon::createFromFormat('H:i', $route[$lastIndex]['end_time']);
                $startTime = $endTime->copy()->addMinutes($visit['travel_time']);

                // Verificar si la visita puede realizarse dentro del horario disponible
                if ($startTime->gte($dayAvailability['start_time']) && $startTime->addMinutes($visit['duration_time'])->lte($dayAvailability['end_time'])) {
                    $visit['start_time'] = $startTime->format('H:i');
                    return $visit;
                }
            } else {
                // Obtención del horario de inicio del operario
                $startTimeString = $this->getStartTime($workerAvailability, $date);

                if ($startTimeString == null) {
                    continue; // No hay disponibilidad para el operario
                }

                $startTime = Carbon::createFromFormat('H:i', $startTimeString);
                $startTime = $startTime->minute(ceil($startTime->minute / 5) * 5)->second(0);

                // Verificar si el inicio de la visita es válido
                if ($startTime->gte($dayAvailability['start_time']) && $startTime->addMinutes($visit['duration_time'])->lte($dayAvailability['end_time'])) {
                    $visit['start_time'] = $startTime->format('H:i');
                    return $visit;
                }
            }
        }
        // No se encontró ninguna visita disponible
        return null;
    }
}
