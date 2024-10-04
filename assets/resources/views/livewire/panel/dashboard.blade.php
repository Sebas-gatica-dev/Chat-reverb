<div class="mx-auto max-w-screen-2xl md:px-6 lg:px-8 my-4" wire:poll="refreshSubscribers">
    <!-- Div oculto para forzar la inclusión de todas las clases col-span -->
    <div class="hidden">
        <div class="col-span-2 col-span-3 col-span-4 col-span-6 col-span-8 col-span-10 col-span-12"></div>
    </div>

    <div class="grid grid-cols-12 gap-4">
        @php
            $sizeMap = [
                'dos' => 2,
                'tres' => 3,
                'cuatro' => 4,
                'seis' => 6,
                'ocho' => 8,
                'diez' => 10,
                'doce' => 12,
            ];
        @endphp

        @foreach ($template->widgets as $widget)
            @php
                $colSpan = $sizeMap[$widget->size] ?? 2;
            @endphp

            <div class="col-span-{{ $colSpan }}">
                @if (isset($data[$widget->id]['component']) && $data[$widget->id]['component'] === 'livewire.stats.count-widget')
                    <livewire:stats.count-widget 
                        :key="$widget->id"
                        :widget-id="$data[$widget->id]['params']['widgetId']"
                        :title="$data[$widget->id]['params']['title']"
                        :total="$data[$widget->id]['params']['total']"
                        :color="$data[$widget->id]['params']['color']"
                        :size="$widget->size"
                    />
                @else
                    <!-- Renderiza el gráfico con Chart.js para otros tipos de widgets -->
                    <div class="rounded-lg shadow-sm ring-1 ring-gray-900/5 bg-white p-4">
                        <canvas wire:ignore id="chart-{{ $widget->id }}" class="w-full"></canvas>
                    </div>
                @endif
            </div>
        @endforeach
    </div>

    @assets
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @endassets

    @script
    <script>
        // Definimos la función en el ámbito global
        window.renderizarGraficos = function() {
            @foreach ($template->widgets as $widget)
                @if (!isset($data[$widget->id]['component']))
                    // Coloca los datos de cada widget en su propia variable local.
                    const chartData{{ $widget->id }} = {!! json_encode($data[$widget->id] ?? []) !!};
                    
                    // Selecciona el contexto del canvas correcto según la ID del widget
                    const chartCtx{{ $widget->id }} = document.getElementById('chart-{{ $widget->id }}');
                    
                    if (chartCtx{{ $widget->id }}) {
                        // Destruye el gráfico existente si lo hay
                        if (chartCtx{{ $widget->id }}.chart) {
                            chartCtx{{ $widget->id }}.chart.destroy();
                        }
                        
                        // Renderiza el gráfico de Chart.js para este widget
                        chartCtx{{ $widget->id }}.chart = new Chart(chartCtx{{ $widget->id }}.getContext('2d'), {
                            type: '{{ $data[$widget->id]['type'] }}', // Tipo de gráfico: 'bar', 'line', 'pie', 'doughnut', etc.
                            data: chartData{{ $widget->id }},
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                scales: {
                                    y: {
                                        beginAtZero: true
                                    }
                                }
                            }
                        });
                    }
                @endif
            @endforeach
        };

        // Ejecutamos la función cuando el DOM esté listo
        document.addEventListener('DOMContentLoaded', window.renderizarGraficos);

        // Escuchamos el evento 'livewire:navigated'
        document.addEventListener('livewire:navigated', window.renderizarGraficos);

        // Escuchamos el evento 'refresh' de Livewire
        Livewire.on('refresh', window.renderizarGraficos);
    </script>
    @endscript
</div>
