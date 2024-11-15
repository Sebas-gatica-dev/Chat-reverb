<div>
    <div class="mt-4 p-4 y-2 border rounded-lg bg-white" x-data="{ open: false }">

        {{-- <!-- Puedes colocar estos botones donde prefieras en tu interfaz -->
        <div class="theme-switcher">
            <button class="theme-btn px-4 py-2 bg-gray-800 text-white rounded" data-operator-id="{{ $operatorId }}"
                data-date="{{ $selectedDate }}" data-theme="DARK">Tema Oscuro</button>
            <button class="theme-btn px-4 py-2 bg-gray-200 text-black rounded" data-operator-id="{{ $operatorId }}"
                data-date="{{ $selectedDate }}" data-theme="LIGHT">Tema Claro</button>
        </div> --}}


        <div class="flex justify-between items-center" :class="open && 'mb-4'">
            <div class="flex items-center gap-4">
                <!-- Imagen -->
                <img class="h-10 w-10 rounded-full bg-gray-800"
                    src="{{ auth()->user()->photo }}"
                    alt="{{ auth()->user()->name }}">
        
                <!-- Información del operador -->
                <div class="inline-flex  gap-1">
                    <span class="inline-flex items-center gap-x-1.5 rounded-md bg-yellow-100 px-2 py-1 text-sm font-medium text-yellow-800">
                        <svg class="h-1.5 w-1.5 fill-yellow-500" viewBox="0 0 6 6" aria-hidden="true">
                            <circle cx="3" cy="3" r="3" />
                        </svg>
                        {{ $operatorData['name'] }}
                    </span>
        
                    <span class="inline-flex items-center rounded-md bg-purple-100 px-2 py-1 text-sm font-medium text-purple-700">
                        {{ count($operatorData['visits']) }} visitas
                    </span>
        
                    <span class="inline-flex items-center rounded-md bg-blue-100 px-2 py-1 text-sm font-medium text-blue-700">
                        {{ $this->travelTimeTotal() }}
                    </span>
        
                    <span class="inline-flex items-center rounded-full bg-gray-100 px-2 py-1 text-sm font-medium text-gray-600">
                        {{ $this->totalTravelAndWorkTime() }}
                    </span>
                </div>
            </div>
        
            <!-- Botones de acción -->
            <div class="inline-flex items-center">
                <div>
                    <button x-on:click="open = ! open" x-show="open == false" x-cloak>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="h-6 w-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3.75 3.75v4.5m0-4.5h4.5m-4.5 0L9 9M3.75 20.25v-4.5m0 4.5h4.5m-4.5 0L9 15M20.25 3.75h-4.5m4.5 0v4.5m0-4.5L15 9m5.25 11.25h-4.5m4.5 0v-4.5m0 4.5L15 15" />
                        </svg>
                    </button>
        
                    <button x-on:click="open = ! open" x-show="open == true" x-cloak>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="h-6 w-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 9V4.5M9 9H4.5M9 9 3.75 3.75M9 15v4.5M9 15H4.5M9 15l-5.25 5.25M15 9h4.5M15 9V4.5M15 9l5.25-5.25M15 15h4.5M15 15v4.5m0-4.5 5.25 5.25" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        

        {{-- <div class="" x-show="open" x-cloak>
                    @if (!empty($this->eliminationHistoryByOperario[$operatorId][$selectedDate]))
                        <button wire:click="undoDeletion('{{ $operatorId }}', '{{ $selectedDate }}')"
                            class="bg-red-600 text-white px-2.5 py-1.5 text-sm rounded-md shadow-md hover:bg-red-700">
                            <!-- Icono SVG -->
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-4">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3" />
                            </svg>
                        </button>
                    @endif
                </div> --}}



        <div x-show="open" x-cloak x-transition:enter.duration.200ms x-transition:leave.duration.200ms >

            @if (count($operatorData['visits']) > 0)
                <div class="grid gap-2 grid-cols-4">
                    <div class="col-span-1 overflow-auto" x-data="{ handleSort: (item, position) => { $wire.sortVisits(item, position, '{{ $operatorId }}', '{{ $selectedDate }}') } }">
                        <ul x-sort="handleSort"
                            class="max-h-96 overflow-y-auto
                    scroll-smooth scrollbar-thin
                    ">
                            @foreach ($operatorData['visits'] as $index => $visit)
                                <li x-sort:item="'{{ $visit['id'] }}'"
                                    class="flex relative space-x-4 py-4 items-center p-2
                                {{ $selectedOperator === $operatorId && $selectedPoint === $index
                                    ? 'bg-blue-100'
                                    : ($visit['exceeds_working_hours']
                                        ? 'bg-red-100'
                                        : '') }}
                                rounded-lg mb-2 shadow-sm hover:bg-gray-100 transition-colors duration-300 ease-in-out"
                                    wire:click="selectVisitFromList({{ $index }}, '{{ $operatorId }}', '{{ $selectedDate }}', '{{ $visit['latitude'] }}', '{{ $visit['longitude'] }}' )"
                                    wire:key="visit-{{ $visit['id'] }}">

                                    {{-- @dump($index) --}}
                                    <!-- Contenido de la visita -->
                                    <div class="min-w-0 flex-auto">
                                        <!-- Detalles de la visita -->
                                        <div class="flex items-center gap-x-3">
                                            <div class="flex-none rounded-full bg-green-400/10 p-1 text-green-400">
                                                <div class="h-2 w-2 rounded-full bg-current"></div>
                                            </div>
                                            <h2 class="min-w-0 text-sm font-semibold leading-6 text-gray-800">
                                                <div class="flex gap-x-2">
                                                    <span class="truncate">{{ $visit['start_time'] }}</span>
                                                    <span class="text-gray-800">/</span>
                                                    <span class="whitespace-nowrap">{{ $visit['end_time'] }}</span>
                                                </div>
                                            </h2>

                                            <!-- Botón de eliminar -->
                                            <button
                                                wire:click="deleteVisit('{{ $visit['id'] }}', '{{ $operatorId }}', '{{ $selectedDate }}')"
                                                class="absolute top-0 right-0 mt-1 mr-1 text-red-500 hover:text-red-700">
                                                <!-- Icono SVG -->
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                    class="w-6 h-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                                </svg>
                                            </button>
                                        </div>

                                        <div class="mt-3 flex items-center gap-x-2.5 text-xs leading-5 text-gray-400">
                                            <p>{{ $visit['customer_name'] }}</p>
                                            <svg viewBox="0 0 2 2" class="h-0.5 w-0.5 flex-none fill-gray-300">
                                                <circle cx="1" cy="1" r="1" />
                                            </svg>
                                            <p class="truncate whitespace-nowrap">
                                                {{ $visit['address'] }}</p>

                                            <svg viewBox="0 0 2 2" class="h-0.5 w-0.5 flex-none fill-gray-300">
                                                <circle cx="1" cy="1" r="1" />
                                            </svg>

                                            <p>Duración: {{ $visit['travel_time'] }} min</p>
                                        </div>
                                    </div>

                                    <div
                                        class="flex-none rounded-full bg-gray-400/10 px-2 py-1 text-xs font-medium text-gray-400 ring-1 ring-inset ring-gray-400/20">
                                        {{ $visit['duration_time'] }} min
                                    </div>

                                    <div class="flex space-x-2">
                                        <!-- Botón para mover la visita -->
                                        <button
                                            wire:click.stop="openMoveModal('{{ $visit['id'] }}', '{{ $operatorId }}', '{{ $selectedDate }}')"
                                            class="

                                        absolute right-0 mb-1 mr-1
                                        
                                        text-blue-500 hover:text-blue-800 bottom-0">
                                            <!-- Icono SVG -->
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="size-5">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M7.5 21L3 16.5m0 0L7.5 12M3 16.5h13.5m0-13.5L21 7.5m0 0L16.5 12M21 7.5H7.5" />
                                            </svg>
                                        </button>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="col-span-3 ">
                        <div wire:ignore class="h-96 mb-5" id="map-{{ $selectedDate }}-{{ $operatorId }}"></div>
                    </div>

                </div>
            @else
                <p class="text-sm text-gray-500">No hay visitas asignadas para este día.</p>
            @endif

            <!-- Modal de Mover Visita -->
            @if ($showMoveModal)
                <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
                    <div class="bg-white rounded-lg shadow-lg w-96">
                        <div class="flex justify-between items-center p-4 border-b">
                            <h3 class="text-lg font-semibold">Mover Visita</h3>
                            <button wire:click="closeMoveModal" class="text-gray-500 hover:text-gray-700">
                                <!-- Icono SVG -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                        <div class="p-4">
                            <div class="mb-4">
                                <label for="moveToDate" class="block text-sm font-medium text-gray-700">Nueva
                                    Fecha</label>
                                <select wire:model="moveToDate" id="moveToDate"
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm text-sm">
                                    <option class="text-sm" value="">Seleccionar Fecha</option>
                                    @foreach ($availableDates as $availableDate)
                                        <option class="text-sm" value="{{ $availableDate }}">
                                            {{ \Carbon\Carbon::parse($availableDate)->format('d M, Y') }}</option>
                                    @endforeach
                                </select>
                                @error('moveToDate')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="moveToOperator" class="block text-sm font-medium text-gray-700">Nuevo
                                    Operario</label>
                                <select wire:model="moveToOperator" id="moveToOperator"
                                    class="mt-1 block w-full border border-gray-300 text-sm rounded-md shadow-sm">
                                    <option class="text-sm" value="">Seleccionar Operario</option>
                                    @foreach ($availableOperators as $opId => $operatorName)
                                        <option class="text-sm" value="{{ $opId }}">{{ $operatorName }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('moveToOperator')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            @if (session('status'))
                                <div class="mb-4">
                                    <p class="text-red-500 text-sm text-center">
                                        {{ session('status') }}

                                    </p>

                                </div>
                            @endif



                        </div>
                        <div class="flex justify-end p-4 border-t">
                            <button wire:click="closeMoveModal"
                                class="mr-2 text-sm px-4 py-2 bg-gray-200 text-gray-700 rounded">Cancelar</button>
                            <button wire:click="moveVisit"
                                class="px-4 py-2 text-sm bg-indigo-600 text-white rounded hover:bg-indigo-700">Mover</button>
                        </div>
                    </div>
                </div>
            @endif

        </div>


    </div>

    {{-- <div wire:emit='updateHistoryDeleteVisit'> --}}
    {{-- @dump($eliminationHistoryByOperario[$operatorId][$selectedDate] ?? null) --}}

    {{-- </div> --}}

    {{-- @script
    <script>
    
        Livewire.on('initMaps', function() {
            console.log('puto');

        });

 
    </script>
    @endscript --}}

    @script
        <script>
            let save = [];
            let lastSelectedMarker = {};
            let previousSelection = null; // Inicialmente null
            let maps = {};
            let previousVisits = null;
            let markers = {}; // Objeto para rastrear marcadores por mapId

            $wire.on('markVisitOnMap', (value) => {

                const mapId = value.mapId;
                const operator = value.operator;
                const date = value.date;
                const index = value.index;

                if (markers[mapId] && markers[mapId][index]) {
                    const marker = markers[mapId][index];
                    personalizeMarker(marker, index, operator, mapId);
                }
            });

            // Función para inicializar los mapas
            $wire.on('initMaps', function(visits) {

                visits.forEach(function(visit) {
                    const mapId = `map-${visit.date}-${visit.operator}`;
                    const points = visit.points;
                    const operator = visit.operator;
                    const operatorName = visit.operator_name;
                    const date = visit.date;


                    initMap(mapId, points, operator, operatorName);
                });
            });

            async function initMap(mapId, points, operator, operatorName, date) {


                if (!points || points.length === 0) {
                    console.warn('Se necesitan al menos uno o más puntos para visualizar el mapa');
                    return;
                }

                const {
                    Map
                } = await google.maps.importLibrary("maps");

                const {
                    AdvancedMarkerElement,
                    PinElement
                } = await google.maps.importLibrary("marker");

                const {
                    ColorScheme
                } = await google.maps.importLibrary("core")

                const mapElement = document.getElementById(mapId);
                if (mapElement && points.length > 0) {




                    const map = new Map(mapElement, {
                        zoom: 12,

                        colorScheme: ColorScheme.LIGHT,

                        center: {
                            lat: parseFloat(points[0].lat),
                            lng: parseFloat(points[0].lng)
                        },
                        mapId: 'DEMO_MAP_ID'
                    });

                    maps[mapId] = map; // Almacenar el mapa por mapId

                    // Eliminar marcadores existentes para este mapId
                    if (markers[mapId]) {
                        markers[mapId].forEach(marker => marker.map = null);
                    }
                    markers[mapId] = []; // Inicializar array para este mapId

                    // Reiniciar lastSelectedMarker para este mapId
                    lastSelectedMarker[mapId] = null;

                    if (points.length === 1) {
                        // Caso de un solo marcador
                        const marker = new AdvancedMarkerElement({
                            position: {
                                lat: parseFloat(points[0].lat),
                                lng: parseFloat(points[0].lng)
                            },
                            map: map,
                            title: 'Única Visita',
                            content: new PinElement({
                                background: "#FBBC04",
                                glyph: "1", // Mostrar número o etiqueta
                                glyphColor: "white",
                                scale: 1 // Tamaño del marcador
                            }).element


                        });

                        markers[mapId].push(marker);

                        // Evento click para personalizar el marcador
                        marker.addListener('click', () => {
                            personalizeMarker(marker, 0, operator, mapId);
                        });

                    } else {
                        // Caso de múltiples marcadores
                        const directionsService = new google.maps.DirectionsService();
                        const directionsRenderer = new google.maps.DirectionsRenderer({
                            suppressMarkers: true
                        });
                        directionsRenderer.setMap(map);

                        const waypoints = points.slice(1, -1).map(point => ({
                            location: new google.maps.LatLng(point.lat, point.lng),
                            stopover: false
                        }));

                        const origin = new google.maps.LatLng(points[0].lat, points[0].lng);
                        const destination = new google.maps.LatLng(points[points.length - 1].lat, points[points.length - 1]
                            .lng);

                        const request = {
                            origin: origin,
                            destination: destination,
                            waypoints: waypoints,
                            travelMode: google.maps.TravelMode.DRIVING
                        };

                        directionsService.route(request, function(result, status) {
                            if (status === google.maps.DirectionsStatus.OK) {
                                directionsRenderer.setDirections(result);

                                points.forEach((point, index) => {
                                    const marker = new AdvancedMarkerElement({
                                        position: {
                                            lat: parseFloat(point.lat),
                                            lng: parseFloat(point.lng)
                                        },
                                        map: map,
                                        title: `Visita ${index + 1} - ${operatorName}`,
                                        content: new PinElement({
                                            background: "#FBBC04",
                                            glyph: (index + 1)
                                                .toString(), // Mostrar número correcto
                                            glyphColor: "white",
                                            scale: 1 // Tamaño del marcador
                                        }).element
                                    });

                                    markers[mapId].push(marker);

                                    // Evento click para personalizar el marcador
                                    marker.addListener('click', () => {
                                        personalizeMarker(marker, index, operator, mapId);
                                    });
                                });


                            } else {
                                console.error('Error al obtener la ruta', status);
                            }
                        });
                    }
                } else {
                    console.warn('No se pudo inicializar el mapa. Elemento del mapa o puntos no disponibles.');
                }
            }

            function personalizeMarker(marker, index, operator, mapId) {
                const map = maps[mapId]; // Recuperar el mapa correspondiente

                if (!map) {
                    console.warn('Mapa no encontrado para mapId:', mapId);
                    return;
                }

                // Si hay un marcador seleccionado previamente para este mapa, restablece su contenido original
                if (lastSelectedMarker[mapId] && lastSelectedMarker[mapId].marker !== marker) {
                    const previousMarker = lastSelectedMarker[mapId].marker;
                    const previousIndex = lastSelectedMarker[mapId].index;

                    previousMarker.content = new google.maps.marker.PinElement({
                        background: "#FBBC04", // Restablece el color original
                        glyph: (previousIndex + 1).toString(), // Restaurar número correcto
                        glyphColor: "white",
                        scale: 1
                    }).element;
                }

                // Si el mismo marcador se selecciona de nuevo, restablecer el estilo y deseleccionar
                if (lastSelectedMarker[mapId] && lastSelectedMarker[mapId].marker === marker) {
                    marker.content = new google.maps.marker.PinElement({
                        background: "#FBBC04", // Restablece el color original
                        glyph: (index + 1).toString(), // Restaurar número correcto
                        glyphColor: "white",
                        scale: 1
                    }).element;
                    lastSelectedMarker[mapId] = null;

                    // Restablecer el zoom al valor inicial
                    map.setZoom(12);
                    map.setCenter(marker.position);

                    $wire.dispatch('visitPointClicked', {
                        point: index,
                        operator: operator
                    });
                    return;
                }

                // Cambiar el contenido del marcador actual a azul y cambiar el glifo
                marker.content = new google.maps.marker.PinElement({
                    background: "blue",
                    glyph: (index + 1).toString(), // Mostrar número correcto
                    glyphColor: "white",
                    scale: 1.5 // Ajustar el tamaño si es necesario
                }).element;

                // Actualizar el marcador seleccionado para este mapa
                lastSelectedMarker[mapId] = {
                    marker: marker,
                    index: index
                };

                // Hacer zoom y centrar en el marcador
                map.setZoom(13);
                map.setCenter(marker.position);

                $wire.dispatch('visitPointClicked', {
                    point: index,
                    operator: operator
                });
            }
        </script>

        {{-- // // Agregar event listeners a los botones de tema
        // document.querySelectorAll('.theme-btn').forEach(button => {
        //     button.addEventListener('click', () => {

        //         const operatorId = button.getAttribute('data-operator-id');
        //         const date = button.getAttribute('data-date');
        //         const colorScheme = button.getAttribute('data-theme');
        //         // Dispatch a Livewire
        //         $wire.dispatch('changeColorScheme', {
        //             operatorId: operatorId,
        //             date: date,
        //             colorScheme: colorScheme
        //         });
        //     });
        // }); --}}
    @endscript







</div>
