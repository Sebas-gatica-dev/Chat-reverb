<?php

namespace App\Livewire\Panel\Stats;

use App\Livewire\Stats\CountWidget;
use App\Models\Widget;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class PreviewStats extends Component
{
    public $template;
    public $data = [];
    public $pickerStartDate;
    public $pickerEndDate;
    public $pickerRange;
    public $sizeable = false;
    public $sortable = false;
    public $live = false;


    public function mount()
    {


        // $this->template = Auth::user()->templates->first();
        $this->loadWidgets();
    }


    #[On('refresh-widgets')]
    public function loadWidgets($startDynamic = null, $endDynamic = null, $rangeDynamic = null)
    {
        if ($startDynamic && $endDynamic && $rangeDynamic) {
            $this->pickerStartDate = $startDynamic;
            $this->pickerEndDate = $endDynamic;
            $this->pickerRange = $rangeDynamic;
        }


        foreach ($this->template->widgets as $widget) {
            $this->processWidgetLogic($widget);
        }
    }


    public function processWidgetLogic($widget)
    {
        if (!$widget instanceof Widget) {
            $widget = Widget::find($widget);
        }

        // Parsear date_range
        $startDynamic = $this->pickerStartDate ?? $widget->date->getStartDate();
        $endDynamic = $this->pickerEndDate ?? $widget->date->getEndDate();
        $rangeDynamic = $this->pickerRange ?? $widget->date->getRange();

        // Obtener datos según la lógica del widget
        $data = $widget->logic->getData($startDynamic, $endDynamic, $rangeDynamic);

        // Preparar datos para la vista
        if ($widget->type->value === 'count') {
            $total = array_sum($data);
            $this->data[$widget->id] = [
                'component' => 'livewire.stats.count-widget',
                'params' => [
                    'widgetId' => $widget->id,
                    'title' => $widget->logic->getName(),
                    'total' => $total,
                    'color' => $widget->color
                ],
            ];

            $this->dispatch('refresh-widget-count-' . $widget->id, widgetId: $widget->id, title: $widget->title, total: $total, color: $widget->color, size: $widget->size)->to(CountWidget::class);
        } else {
            $datosFinales = [];
            $fechasAUsar = $widget->date->getRealDates($startDynamic, $endDynamic, $rangeDynamic);

            foreach ($fechasAUsar as $fecha) {
                $datosFinales[] = $data[$fecha] ?? 0;
            }


            $this->data[$widget->id] = [
                'labels' => $widget->date->getLabels($startDynamic, $endDynamic, $rangeDynamic),
                'datasets' => [
                    [
                        'label' => $widget->logic->getName(),
                        'backgroundColor' => $widget->color,
                        'data' => $datosFinales,
                    ],
                ],
                'type' => $widget->type->value,
            ];
        }

        $this->dispatch('refresh-widget-chart', widgetId: $widget->id, data: $this->data[$widget->id]);
    }

    #[On('update-col-span')]
    public function updateColSpan($widgetId, $colSpan)
    {
        $widget = Widget::find($widgetId);
        $widget->size = $colSpan;
        $widget->save();

        // Actualiza el widget en el estado del componente
        $this->loadWidgets();
    }

    public function orderWidget($widgetId, $newPosition)
    {
        $newPosition = (int) $newPosition + 1;

        // Encuentra el widget actual en la colección
        $widget = collect($this->template->widgets)->firstWhere('id', $widgetId);

        // Si no encuentra el widget, sale de la función
        if (!$widget) {
            return;
        }

        // Obtiene la posición actual del widget
        $currentPosition = $widget->order;

        // Si la posición actual y la nueva son iguales, no hay nada que reorganizar
        if ($currentPosition == $newPosition) {
            return;
        }

        // Reorganiza los widgets en la colección y ajusta sus posiciones
        $this->template->widgets = collect($this->template->widgets)->map(function ($item) use ($widgetId, $currentPosition, $newPosition) {
            if ($item->id == $widgetId) {
                // Asigna la nueva posición al widget que estamos moviendo
                $item->order = $newPosition;
            } elseif ($currentPosition < $newPosition) {
                // Si estamos moviendo el widget hacia abajo
                if ($item->order > $currentPosition && $item->order <= $newPosition) {
                    $item->order--;
                }
            } else {
                // Si estamos moviendo el widget hacia arriba
                if ($item->order < $currentPosition && $item->order >= $newPosition) {
                    $item->order++;
                }
            }
            return $item;
        })->sortBy('order')->values()->all();

        // Guarda cada widget reorganizado en la base de datos
        foreach ($this->template->widgets as $item) {
            Widget::where('id', $item->id)->update(['order' => $item->order]);
        }

        // Recarga los widgets después de la reorganización
        $this->loadWidgets();
    }



    public function placeholder()
    {
        return <<<'HTML'
        <div class="grid grid-cols-12 gap-4 p-4">
            
        <div role="status" class="p-4 border border-gray-200 rounded animate-pulse md:p-6 col-span-4">
        <div class="h-2.5 bg-violet-200 rounded-full w-32 mb-2.5"></div>
        <div class="w-48 h-2 mb-10 bg-violet-200 rounded-full"></div>
        <div class="flex items-baseline mt-4">
            <div class="w-full bg-violet-200 rounded-t-lg h-20"></div>
            <div class="w-full h-36 ms-6 bg-violet-200 rounded-t-lg"></div>
            <div class="w-full bg-violet-200 rounded-t-lg h-28 ms-6"></div>
            <div class="w-full h-32 ms-6 bg-violet-200 rounded-t-lg"></div>
            <div class="w-full bg-violet-200 rounded-t-lg h-24 ms-6"></div>
            <div class="w-full bg-violet-200 rounded-t-lg h-40 ms-6"></div>
            <div class="w-full bg-violet-200 rounded-t-lg h-32 ms-6"></div>
        </div>
        <span class="sr-only">Loading...</span>
        </div>

        <div role="status" class="p-4 border border-gray-200 rounded  animate-pulse md:p-6 col-span-4">
        <div class="h-2.5 bg-violet-200 rounded-full w-32 mb-2.5"></div>
        <div class="w-48 h-2.5 mb-10 bg-violet-200 rounded-full"></div>
        <div class="flex items-baseline mt-4">
            <div class="w-full bg-violet-200 rounded-t-lg h-24"></div>
            <div class="w-full h-32 ms-6 bg-violet-200 rounded-t-lg"></div>
            <div class="w-full bg-violet-200 rounded-t-lg h-16 ms-6"></div>
            <div class="w-full h-28 ms-6 bg-violet-200 rounded-t-lg"></div>
            <div class="w-full bg-violet-200 rounded-t-lg h-40 ms-6"></div>
            <div class="w-full bg-violet-200 rounded-t-lg h-36 ms-6"></div>
            <div class="w-full bg-violet-200 rounded-t-lg h-32 ms-6"></div>
        </div>
        <span class="sr-only">Loading...</span>
        </div>

        <div role="status" class="p-4 border border-gray-200 rounded animate-pulse md:p-6 col-span-4">
        <div class="h-2.5 bg-violet-200 rounded-full w-32 mb-2.5"></div>
        <div class="w-48 h-2.5 mb-10 bg-violet-200 rounded-full"></div>
        <div class="flex items-baseline mt-4">
            <div class="w-full bg-violet-200 rounded-t-lg h-32"></div>
            <div class="w-full h-28 ms-6 bg-violet-200 rounded-t-lg"></div>
            <div class="w-full bg-violet-200 rounded-t-lg h-24 ms-6"></div>
            <div class="w-full h-20 ms-6 bg-violet-200 rounded-t-lg"></div>
            <div class="w-full bg-violet-200 rounded-t-lg h-36 ms-6"></div>
            <div class="w-full bg-violet-200 rounded-t-lg h-40 ms-6"></div>
            <div class="w-full bg-violet-200 rounded-t-lg h-24 ms-6"></div>
        </div>
        <span class="sr-only">Loading...</span>
        </div>
        </div>
     HTML;
    }


    public function render()
    {
        return view('livewire.panel.stats.preview-stats');
    }
}
