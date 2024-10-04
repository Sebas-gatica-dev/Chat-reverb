<?php

namespace App\Livewire\Panel;

use App\Livewire\Stats\CountWidget;
use App\Models\Comment;
use App\Models\Customer;
use App\Models\LogicStat;
use App\Models\Property;
use App\Models\Template;
use App\Models\User;
use App\Models\Visit;
use App\Models\Widget;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class Dashboard extends Component
{

    public $data = [];

    public function mount()
    {


        
        // Obtiene el template del usuario actual
        $template = auth()->user()->templates->first();
    
        // Procesar cada widget y llamar a la lógica correspondiente
        foreach ($template->widgets as $widget) {
            $this->processWidgetLogic($widget); // Llama al método para procesar cada widget
        }

        // dd($this->data);

       

        // Verifica el contenido de los datos después de procesar los widgets
    }

    public function refreshSubscribers()
    {
        
        $this->mount();

        $this->dispatch('refresh');

    }

    public function processWidgetLogic($widget)
    {
       
        // Convertir date_range a array si es una cadena JSON
        $dateRange = is_string($widget->date_range) ? json_decode($widget->date_range, true) : $widget->date_range;
        $fechaInicio = $dateRange['start'];  // Fecha de inicio
        $fechaFin = $dateRange['end'];       // Fecha de fin
    
        // Detectar automáticamente si es un rango de meses o días
        $esRangoDeMeses = (strlen($fechaInicio) === 7); // Si tiene 7 caracteres, es un rango de meses (Y-m)
    
        if ($esRangoDeMeses) {
            // Caso para un rango de meses (formato Y-m)
            $fechasReales = $this->generarFechasReales($fechaInicio, $fechaFin); // Genera las fechas para meses
            $fechasFinales = $this->generarFechasMeses($fechaInicio, $fechaFin); // Etiquetas para los meses
            $date_start = Carbon::parse(min($fechasReales))->startOfMonth();
            $date_end = Carbon::parse(max($fechasReales))->endOfMonth();
        } else {
            // Caso para un rango de días (formato Y-m-d)
            $fechasDias = $this->generarFechas($fechaInicio, $fechaFin); // Genera las fechas para días
            $fechasFinales = $fechasDias; // Etiquetas para los días
            $date_start = Carbon::parse(min($fechasDias));
            $date_end = Carbon::parse(max($fechasDias));
        }
    
        // Llamar a la lógica según el widget
        switch ($widget->logic) {
            case 'UsersLogic':
                $data = $this->getUsersData($date_start, $date_end, $esRangoDeMeses);
                break;
            case 'CommentsLogic':
                $data = $this->getCommentsData($date_start, $date_end, $esRangoDeMeses);
              
                break;
            case 'VisitsLogic':
                $data = $this->getVisitsData($date_start, $date_end, $esRangoDeMeses);
                break;
            case 'PropertysLogic':
                $data = $this->getPropertysData($date_start, $date_end, $esRangoDeMeses);
                break;
            case 'CustomersLogic':
                $data = $this->getCustomersData($date_start, $date_end, $esRangoDeMeses);
                break;
            default:
                $data = [];
                break;
        }
    
        // Asegurarse de que $data sea un array
        if ($data instanceof \Illuminate\Support\Collection) {
            $data = $data->toArray();
        }
    
        if ($widget->type === 'count') {
            // Lógica para el tipo "count"
            $total = array_sum($data); // Sumar todos los valores de $data para obtener el total
            $this->data[$widget->id] = [
                'component' => 'livewire.stats.count-widget', // Llamar al componente "count"
                'params' => [
                    'widgetId' => $widget->id,
                    'title' => $widget->title,
                    'total' => $total,
                    'color' => $widget->color
                ],
            ];
        } else {
            // Lógica para los gráficos (bar o line)
            $datosFinales = [];
            $fechasAUsar = $esRangoDeMeses ? $fechasReales : $fechasDias;
    
            foreach ($fechasAUsar as $fecha) {
                // Asignar el valor de $data para la fecha específica o 0 si no hay datos
                $datosFinales[] = isset($data[$fecha]) ? $data[$fecha] : 0;
            }
    
            $this->data[$widget->id] = [
                'labels' => $fechasFinales,
                'datasets' => [
                    [
                        'label' => $widget->title, // Título del widget
                        'backgroundColor' => $widget->color, // Color del widget
                        'data' => $datosFinales, // Datos procesados
                    ],
                ],
                'type' => $widget->type // bar o line
            ];
        }
    }
    
    
    
    // Funciones para las diferentes lógicas
    public function getUsersData($start, $end, $isMonthRange)
    {
        return User::selectRaw($isMonthRange ? 'DATE_FORMAT(created_at, "%Y-%m") as datez, COUNT(*) as total' : 'DATE(created_at) as datez, COUNT(*) as total')
            ->whereBetween('created_at', [$start, $end])
            ->groupBy('datez')
            ->pluck('total', 'datez');
    }

    public function getCommentsData($start, $end, $isMonthRange)
    {
    
        return Comment::selectRaw($isMonthRange ? 'DATE_FORMAT(created_at, "%Y-%m") as datez, COUNT(*) as total' : 'DATE(created_at) as datez, COUNT(*) as total')
            ->whereBetween('created_at', [$start, $end])
            ->groupBy('datez')
            ->pluck('total', 'datez');
    }

    public function getVisitsData($start, $end, $isMonthRange)
    {
        return Visit::selectRaw($isMonthRange ? 'DATE_FORMAT(created_at, "%Y-%m") as datez, COUNT(*) as total' : 'DATE(created_at) as datez, COUNT(*) as total')
            ->whereBetween('created_at', [$start, $end])
            ->groupBy('datez')
            ->pluck('total', 'datez');
    }

    public function getPropertysData($start, $end, $isMonthRange)
    {
        return Property::selectRaw($isMonthRange ? 'DATE_FORMAT(created_at, "%Y-%m") as datez, COUNT(*) as total' : 'DATE(created_at) as datez, COUNT(*) as total')
            ->whereBetween('created_at', [$start, $end])
            ->groupBy('datez')
            ->pluck('total', 'datez');
    }

    public function getCustomersData($start, $end, $isMonthRange)
    {
        return Customer::selectRaw($isMonthRange ? 'DATE_FORMAT(created_at, "%Y-%m") as datez, COUNT(*) as total' : 'DATE(created_at) as datez, COUNT(*) as total')
            ->whereBetween('created_at', [$start, $end])
            ->groupBy('datez')
            ->pluck('total', 'datez');
    }

    // Funciones para generar fechas
    function generarFechasReales($fechaInicio, $fechaFin)
    {

        $date_start = Carbon::createFromFormat('Y-m', $fechaInicio)->startOfMonth();
        $date_end = Carbon::createFromFormat('Y-m', $fechaFin)->endOfMonth();

        $dates = [];
        $currentDate = $date_start->copy();
        while ($currentDate->lte($date_end)) {
            $dates[] = $currentDate->format('Y-m');
            $currentDate->addMonth();
        }

        return $dates;
    }

    function generarFechasMeses($fechaInicio, $fechaFin)
    {
        $date_start = Carbon::createFromFormat('Y-m', $fechaInicio)->startOfMonth();
        $date_end = Carbon::createFromFormat('Y-m', $fechaFin)->endOfMonth();

        $months = [];
        $currentDate = $date_start->copy();
        while ($currentDate->lte($date_end)) {
            $months[] = ucfirst($currentDate->isoFormat('MMMM'));
            $currentDate->addMonth();
        }

        return $months;
    }

    function generarFechas($fechaInicio, $fechaFin)
    {
        $date_start = Carbon::createFromFormat('Y-m-d', $fechaInicio);
        $date_end = Carbon::createFromFormat('Y-m-d', $fechaFin);

        $dates = [];
        $currentDate = $date_start->copy();
        while ($currentDate->lte($date_end)) {
            $dates[] = $currentDate->format('Y-m-d');
            $currentDate->addDay();
        }

        return $dates;
    }

    public function render()
    {
        return view('livewire.panel.dashboard', ['template' => auth()->user()->templates->first()])
            ->layout('layouts.panel');
    }
}
