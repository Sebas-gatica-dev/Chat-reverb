<div class="grid grid-cols-12 gap-4 mt-6" x-data="{ handle: (item, position) => { $wire.orderWidget(item, position) }, initGraficos: false }" @if ($sortable)
    x-sort="handle"
    @endif
    x-init="initGraficos = true;
    $nextTick(() => window.renderizarGraficos());">

    @forelse ($template->widgets as $widget)
        <div x-sort:item="'{{ $widget->id }}'" x-data="{
            width: 0,
            sizeable: @entangle('sizeable'),
            containerWidth: 0,
            colSpanName: '{{ $widget->size->getName() }}',
            colSpanClass: '{{ $widget->size->getColSpan() }}',
            isResizing: false,
            initialized: false,
            init() {
                this.$nextTick(() => {
        
        
        
                    // Establecer la clase inicial desde la base de datos
        
                    if (this.sizeable) {
        
                        this.updateContainerWidth();
                        this.width = this.$el.getBoundingClientRect().width;
                        this.$el.className = `${this.colSpanClass} max-h-96 resize-x overflow-auto`;
                        // Marcar como inicializado
                        this.initialized = true;
        
                    } else {
                        this.$el.style.width = `${this.colSpanClass}`;
                    }
        
        
        
                    if (this.sizeable) {
        
        
                        // Configurar el ResizeObserver
                        const resizeObserver = new ResizeObserver(entries => {
                            for (let entry of entries) {
                                const newWidth = entry.contentRect.width;
                                if (newWidth !== this.width) {
                                    this.width = newWidth;
                                    console.log('hola');
        
                                    {{-- this.isResizing = true; --}}
                                    this.$el.className = `${this.colSpanClass} relative max-h-96 resize-x overflow-auto z-10`;
        
                                }
                            }
                        });
                        resizeObserver.observe(this.$el);
        
        
                    }
                    // Escuchar cambios en el tamaño de la ventana
                    window.addEventListener('resize', () => {
        
                        this.updateContainerWidth();
                    });
                });
            },
            updateContainerWidth() {
                this.containerWidth = this.$el.parentElement.getBoundingClientRect().width;
            },
            snapToClosestColSpan() {
                const containerWidth = this.containerWidth;
                const colWidth = containerWidth / 12;
        
                // Definir los anchos exactos para cada colSpan
                const colSpans = [
                    { name: 'extra_small', colSpan: 'col-span-2', width: colWidth * 2 },
                    { name: 'very_small', colSpan: 'col-span-3', width: colWidth * 3 },
                    { name: 'small', colSpan: 'col-span-4', width: colWidth * 4 },
                    { name: 'medium', colSpan: 'col-span-6', width: colWidth * 6 },
                    { name: 'large', colSpan: 'col-span-8', width: colWidth * 8 },
                    { name: 'very_large', colSpan: 'col-span-10', width: colWidth * 10 },
                    { name: 'full', colSpan: 'col-span-12', width: colWidth * 12 },
                ];
        
                // Encontrar el colSpan más cercano al ancho actual
                let closest = colSpans.reduce((prev, curr) => {
                    return (Math.abs(curr.width - this.width) < Math.abs(prev.width - this.width) ? curr : prev);
                });
        
                // Actualizar colSpanName y colSpanClass
                this.colSpanName = closest.name;
                let colSpanClass = closest.colSpan;
        
                if (this.colSpanClass !== colSpanClass) {
                    this.colSpanClass = colSpanClass;
        
                    // Actualizar la clase del elemento
                    this.$el.className = `${colSpanClass} max-h-96 resize-x overflow-auto`;
        
                    // Redimensionar el gráfico si es necesario
                    if (window.graficos['{{ $widget->id }}']) {
                        window.graficos['{{ $widget->id }}'].resize();
                    }
                }
        
                // Ajustar el ancho del elemento al ancho del colSpan más cercano
                this.$el.style.width = `${closest.width}px`;
                this.width = closest.width;
        
            },
            dispatchColSpan() {
                if (this.isResizing) {
                    // Ajustar al colSpan más cercano
                    this.snapToClosestColSpan();
        
                    // Despachar el evento con el nuevo colSpanName
                    console.log('dispatchColSpan');
                    this.$dispatch('update-col-span', { widgetId: {{ $widget->id }}, colSpan: this.colSpanName });
        
                    // Restablecer isResizing
                    this.isResizing = false;
                }
            }
        }" x-ref="widget{{ $widget->id }}"
            :class="colSpanClass + ' max-h-96' + (sizeable ? ' resize-x overflow-auto' : '')"
            :style="sizeable ? 'resize: horizontal; min-width: 150px;' : ''" @if ($sizeable)
            @mouseup.window="dispatchColSpan()"
            @mousedown.self="isResizing = true"
    @endif

    wire:key="{{ $widget->id }}"

    @if ($live)
        wire:poll.1s.visible="processWidgetLogic('{{ $widget->id }}')"
    @endif
    >



    @if (isset($data[$widget->id]['component']) && $data[$widget->id]['component'] === 'livewire.stats.count-widget')
        <livewire:stats.count-widget :key="$widget->id" :widget-id="$data[$widget->id]['params']['widgetId']" :title="$data[$widget->id]['params']['title']" :total="$data[$widget->id]['params']['total']"
            :color="$data[$widget->id]['params']['color']" :size="$widget->size->getColSpan()" />
    @else
        <div class="rounded-lg shadow-sm ring-1 ring-gray-900/5 bg-white p-4  border border-gray-200">
            <canvas wire:ignore id="chart-{{ $widget->id }}" class="w-full max-h-80"></canvas>
        </div>
    @endif
</div>

@empty
<div class="col-span-12">
    <div class="text-center mt-6 min-w-full   md:rounded-b-md md:shadow">
        <div class=" rounded-md">
            <div class="rounded-md bg-yellow-50 p-4 border border-yellow-600 shadow-sm">
                <div class="text-sm font-medium text-yellow-700 text-center ">
                    <p>No hay ningún widget en esta plantilla</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endforelse
</div>



@assets
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endassets

@script
    <script>
        // document.querySelectorAll('.resizable-widget').forEach(widget => {
        //     widget.addEventListener('mouseup', () => {
        //         const widgetId = widget.getAttribute('data-widget-id');
        //         updateColSpan(widgetId);
        //     });
        // });

        window.graficos = {};

        // Definimos la función en el ámbito global
        window.renderizarGraficos = function() {
            @foreach ($template->widgets as $widget)
                @if (!isset($data[$widget->id]['component']))
                    // Coloca los datos de cada widget en su propia variable local.
                    var chartData{{ $widget->id }} = {!! json_encode($data[$widget->id] ?? []) !!};

                    // Selecciona el contexto del canvas correcto según la ID del widget
                    var chartCtx{{ $widget->id }} = document.getElementById('chart-{{ $widget->id }}');

                    if (chartCtx{{ $widget->id }}) {
                        // Si ya existe el gráfico, solo actualiza la data y omite la creación
                        if (!window.graficos[{{ $widget->id }}]) {
                            // Renderiza el gráfico de Chart.js por primera vez para este widget
                            window.graficos[{{ $widget->id }}] = new Chart(chartCtx{{ $widget->id }}.getContext(
                                '2d'), {
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
                    }
                @endif
            @endforeach
        };

        // Función para actualizar el gráfico
        window.actualizarGrafico = function(widgetId, nuevosDatos) {
            // Accede al gráfico por su widgetId
            if (window.graficos[widgetId]) {
                let grafico = window.graficos[widgetId];

                // Actualiza solo los datasets y las labels
                grafico.data.datasets.forEach((dataset, index) => {
                    dataset.data = nuevosDatos.datasets[index].data;
                    dataset.backgroundColor = nuevosDatos.datasets[index].backgroundColor;
                    dataset.label = nuevosDatos.datasets[index].label;
                    grafico.config.type = nuevosDatos.type;
                });
                grafico.data.labels = nuevosDatos.labels;

                // Redimensiona el gráfico para ajustarlo automáticamente al contenedor
                // Cambia temporalmente la altura del canvas y luego la restablece


                // Restablece la altura después de la redimensión

                grafico.resize(); // Vuelve a ajustar al tamaño original
                // Pequeño retardo para permitir el ajuste de altura
                // Aplica los cambios en los datos sin redibujar todo
                grafico.update();


            }
        };



        // Escuchamos el evento 'refresh' para actualizar la data del gráfico
        Livewire.on('refresh-widget-chart', (e) => {
            // Llamamos a la función de actualización del gráfico con los nuevos datos
            window.actualizarGrafico(e.widgetId, e.data);
        });
        // Escuchamos el evento 'livewire:navigated' para volver a renderizar los gráficos
        document.addEventListener('livewire:navigated', window.renderizarGraficos);
    </script>
@endscript
