<div>


    @if ($typeView == 'list')
        <!-- Código para la Vista Lista -->
        @livewire('panel.routes.partials.typeview.visits-format-list', 
        ['visits' => $assignedVisits,
        'year' => $year,
        'month' => $month,
        'day' => $day,
        ])

    @elseif ($typeView == 'card')

        <!-- Código para la Vista Tarjeta -->

        @livewire('panel.routes.partials.typeview.visits-format-card', 
        ['visits' => $assignedVisits,
        'year' => $year,
        'month' => $month,
        'day' => $day,
        ])
    @endif


    {{-- Modal of routesOrganizer --}}

    <div x-data="{ modalOpen: @entangle('openNewRoute') }"
        @keydown.escape.window="
        modalOpen = false; 
        @this.set('openNewRoute', false); 
    "
        x-effect="
        if (modalOpen === false) {
            @this.set('newRoute', []);
            @this.set('openNewRoute', false);
        }
    "
        :class="{ 'z-40': modalOpen }" class="relative w-auto h-auto">

        <div x-show="modalOpen"
            class="fixed inset-0 z-50 flex items-center justify-center w-screen  h-screen bg-gray-800 bg-opacity-50"
            x-cloak>
            <div x-show="modalOpen" x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 -translate-y-2 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 -translate-y-2 sm:scale-95"
                class="relative w-full max-w-screen-lg p-6 bg-white border border-gray-200 shadow-lg rounded-lg">

                <!-- Modal Header -->
                <div class="flex items-center justify-between pb-3">
                    <h3 class="text-lg font-semibold">Ruta organizada</h3>
                    <button @click="modalOpen=false" class="text-gray-500 hover:text-gray-800">
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Modal Content -->
                <div class="relative pb-8">
                    <div class="grid grid-cols-6 gap-4">
                        <!-- Primera columna (1/4) -->
                        <div
                            class="col-span-2 bg-white shadow-md border border-gray-300 p-4 rounded-md overflow-y-scroll h-96 scroll-smooth scrollbar-thin scrollbar-thumb-rounded-full scrollbar-thumb-indigo-300 scrollbar-track-indigo-100">
                            <ul class="space-y-4 ">
                                @foreach ($newRoute as $index => $visit)
                                    <li class="p-4 rounded-lg text-sm border shadow-sm relative has-tooltip cursor-pointer
                                @if (isset($visit['out']) && $visit['out'] && $this->selectedVisitIndex === $index) bg-red-300 border-red-400
                                @elseif (isset($visit['out']) && $visit['out'])
                                    bg-red-100 border-red-200
                                @elseif ($this->selectedVisitIndex === $index)
                                    bg-lime-100 border-lime-400
                                @else
                                    bg-gray-50 border-gray-200 @endif"
                                        wire:click="selectVisit({{ $index }})">



                                        <span class="tooltip">
                                            {{ $visit['address'] }}
                                        </span>
                                        @if ($index > 0)
                                            <div class="absolute -top-5 left-0 right-0 text-center">
                                                <span
                                                    class="text-xs text-gray-200 bg-gray-700 px-2 py-1 rounded-sm">Tiempo
                                                    de
                                                    viaje:
                                                    {{ $visit['travel_time'] }}
                                                    min</span>
                                            </div>
                                        @endif

                                        <!-- Hora de la visita -->
                                        <div class="flex justify-between items-center">
                                            <div class="flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="w-5 h-5 text-blue-500 mr-2" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                <span
                                                    class="font-medium text-gray-700">{{ \Carbon\Carbon::parse($visit['start_time'])->format('H:i') }}</span>
                                            </div>
                                            <!-- ID o información adicional de la visita -->
                                            <div class="flex items-center">
                                                @if (isset($visit['out']) && $visit['out'])
                                                    <!-- Ícono en rojo si 'out' es true -->
                                                    <span class="mr-2 bg-red-200 text-red-500 p-0.5 rounded-full">
                                                        <svg wire:click="markAsOut({{ $index }})"
                                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                            fill="currentColor" class="size-5 cursor-pointer">
                                                            <path fill-rule="evenodd"
                                                                d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm13.36-1.814a.75.75 0 1 0-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 0 0-1.06 1.06l2.25 2.25a.75.75 0 0 0 1.14-.094l3.75-5.25Z"
                                                                clip-rule="evenodd" />
                                                        </svg>
                                                    </span>
                                                    <span class="text-sm text-red-500">#{{ $loop->iteration }}</span>
                                                @elseif(isset($visit['out']) && !$visit['out'])
                                                    <!-- Ícono si 'out' existe y es false, permite volverlo a true -->
                                                    <span class="mr-2 bg-gray-200 text-gray-500 p-0.5 rounded-full">
                                                        <svg wire:click="markAsOut({{ $index }})"
                                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                            fill="currentColor" class="size-5 cursor-pointer">
                                                            <path fill-rule="evenodd"
                                                                d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25Zm-1.72 6.97a.75.75 0 1 0-1.06 1.06L10.94 12l-1.72 1.72a.75.75 0 1 0 1.06 1.06L12 13.06l1.72 1.72a.75.75 0 1 0 1.06-1.06L13.06 12l1.72-1.72a.75.75 0 1 0-1.06-1.06L12 10.94l-1.72-1.72Z"
                                                                clip-rule="evenodd" />
                                                        </svg>
                                                    </span>
                                                    <span class="text-sm text-gray-500">#{{ $loop->iteration }}</span>
                                                @else
                                                    <!-- Gris si no es ni "this" ni tiene 'out' -->
                                                    <span class="text-sm text-gray-500">#{{ $loop->iteration }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="col-span-4 h-96 bg-white shadow-md border border-gray-300 p-4  rounded-md ">
                            <div wire:ignore class="h-full" id="maps"></div>
                        </div>
                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="flex flex-col-reverse sm:flex-row sm:justify-end sm:space-x-2">
                    <button @click="modalOpen=false" type="button"
                        class="inline-flex items-center justify-center h-10 px-4 py-2 text-sm font-medium transition-colors border rounded-md focus:outline-none focus:ring-2 focus:ring-neutral-100 focus:ring-offset-2">Cerrar</button>
                    <button type="button"
                        class="inline-flex items-center justify-center h-10 px-4 py-2 text-sm font-medium text-white transition-colors border border-transparent rounded-md focus:outline-none focus:ring-2 focus:ring-neutral-900 focus:ring-offset-2 bg-neutral-950 hover:bg-neutral-900"
                        wire:click="organized()">Organizar ruta


                </div>
            </div>
        </div>
    </div>


    @script
        <script>
            (g => {
                var h, a, k, p = "The Google Maps JavaScript API",
                    c = "google",
                    l = "importLibrary",
                    q = "__ib__",
                    m = document,
                    b = window;
                b = b[c] || (b[c] = {});
                var d = b.maps || (b.maps = {}),
                    r = new Set,
                    e = new URLSearchParams,
                    u = () => h || (h = new Promise(async (f, n) => {
                        await (a = m.createElement("script"));
                        e.set("libraries", [...r] + "");
                        for (k in g) e.set(k.replace(/[A-Z]/g, t => "_" + t[0].toLowerCase()), g[
                            k]);
                        e.set("callback", c + ".maps." + q);
                        a.src = `https://maps.${c}apis.com/maps/api/js?` + e;
                        d[q] = f;
                        a.onerror = () => h = n(Error(p + " could not load."));
                        a.nonce = m.querySelector("script[nonce]")?.nonce || "";
                        m.head.append(a);
                    }));
                d[l] ? console.warn(p + " only loads once. Ignoring:", g) : d[l] = (f, ...n) => r.add(f) && u()
                    .then(() =>
                        d[l](f, ...n))
            })({

                key: "AIzaSyD3K3dBES7-pn0gkICbQyiQgfNHhlUU3W4",
                v: "weekly",
                libraries: "places,marker,geometry,drawing"
            });
        </script>
    @endscript

    @script
        <script>
            let visitsPoints = [];


            let lastSelectedMarker = {};
            let previousSelection = null; // Inicialmente null
            let maps;
            let previousVisits = null;
            let markers = []; // Objeto para rastrear marcadores por mapId



            async function initMap() {

                markers = []; // Reiniciar marcadores para este mapId
                lastSelectedMarker = null;


                const visits = $wire.get('newRoute');

                const mapId = 'maps';
                const points = visits.map(visit => ({
                    lat: visit.latitude,
                    lng: visit.longitude,
                    ...(visit.out ? {
                        out: visit.out
                    } : {})
                }));


                visitsPoints = points;

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
                } = await google.maps.importLibrary("core");


                const mapElement = document.getElementById(mapId);
                if (mapElement && points.length > 0) {


                    const map = new Map(mapElement, {

                        center: {
                            lat: parseFloat(points[0].lat),
                            lng: parseFloat(points[0].lng)
                        },
                        zoom: 10,
                        mapId: 'DEMO_MAP_ID'
                    });

                    maps = map; // Almacenar el mapa por mapId


                    // Reiniciar lastSelectedMarker para este mapId
                    lastSelectedMarker = null;


                    if (points.length === 1) {

                        // Caso de un solo marcador
                        const marker = new AdvancedMarkerElement({
                            map: map,

                            position: {
                                lat: parseFloat(points[0].lat),
                                lng: parseFloat(points[0].lng)
                            },

                            title: 'Única Visita',
                            content: new PinElement({
                                background: "#FBBC04",
                                borderColor: "#ab8003",

                                // glyph: "1", // Mostrar número o etiqueta
                                glyphColor: "#b88f1a",
                                scale: 1 // Tamaño del marcador
                            }).element
                        });

                        markers.push(marker);

                        // Evento click para personalizar el marcador
                        marker.addListener('click', () => {
                            personalizeMarker(marker, 0);
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
                        const destination = new google.maps.LatLng(points[points.length - 1].lat, points[points
                                .length - 1]
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


                                    const pin = new PinElement({
                                        background: point.out ? "#FF6347" : "#FFB347",
                                        /* Rojo si point.out es true, de lo contrario naranja */
                                        borderColor: point.out ? "#B22222" : "#FF8C00",
                                        /* Rojo más oscuro si point.out es true, de lo contrario naranja intermedio */
                                        glyphColor: point.out ? "#8B0000" : "#E67E22",
                                        /* Rojo intenso si point.out es true, de lo contrario naranja más intenso */
                                    });

                                    const marker = new AdvancedMarkerElement({
                                        map: map,
                                        position: {
                                            lat: parseFloat(point.lat),
                                            lng: parseFloat(point.lng)
                                        },

                                        title: `Visita ${index + 1}`,
                                        content: pin.element,

                                    });

                                    markers.push(marker);
                                    // Evento click para personalizar el marcador
                                    marker.addListener('click', () => {
                                        personalizeMarker(marker, index);
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

            Livewire.on('refresh', () => {
                initMap();
            });

            $wire.on('selectVisit', (value) => {
                const index = value;


                if (markers[index]) {
                    const marker = markers[index];
                    personalizeMarker(marker, index);
                }
            });

            $wire.on('markOut', (value) => {
                const index = value;


                visitsPoints[index].out = !visitsPoints[index].out;

                $dispatch('selectVisit', index);

            });


            function personalizeMarker(marker, index) {

                const map = maps; // Recuperar el mapa correspondiente

                if (!map) {
                    console.warn('Mapa no encontrado para mapId');
                    return;
                }

                const point = visitsPoints[index];

                // Si hay un marcador seleccionado previamente para este mapa, restablece su contenido original
                if (lastSelectedMarker && lastSelectedMarker.marker !== marker) {
                    const previousMarker = lastSelectedMarker.marker;

                    previousMarker.content = new google.maps.marker.PinElement({
                        background: point && point.out === true ? "#FF6347" :
                        "#FFB347", // Rojo si es 'out' true, de lo contrario naranja
                        borderColor: point && point.out === true ? "#B22222" :
                        "#FF8C00", // Rojo más oscuro si es 'out' true
                        glyphColor: point && point.out === true ? "#8B0000" :
                        "#E67E22", // Rojo intenso si es 'out' true
                    }).element;
                }

                // Si el mismo marcador se selecciona de nuevo, restablecer el estilo y deseleccionar
                if (lastSelectedMarker && lastSelectedMarker.marker == marker) {
                    marker.content = new google.maps.marker.PinElement({
                        background: point && point.out === true ? "#FF6347" :
                        "#FFB347", // Rojo si es 'out' true, de lo contrario naranja
                        borderColor: point && point.out === true ? "#B22222" :
                        "#FF8C00", // Rojo más oscuro si es 'out' true
                        glyphColor: point && point.out === true ? "#8B0000" :
                        "#E67E22", // Rojo intenso si es 'out' true
                    }).element;
                    lastSelectedMarker = null;

                    // Restablecer el zoom al valor inicial
                    map.setZoom(12);
                    map.setCenter(marker.position);
                    return;
                }

                // Cambiar el contenido del marcador actual a azul y cambiar el glifo
                marker.content = new google.maps.marker.PinElement({
                    background: "#3CB371", // Verde medio
                    borderColor: "#2E8B57", // Verde más oscuro
                    glyphColor: "#006400", // Verde intenso oscuro
                }).element;

                // Actualizar el marcador seleccionado para este mapa
                lastSelectedMarker = {
                    marker: marker,
                    index: index
                };

                // Hacer zoom y centrar en el marcador
                map.setZoom(13);
                map.setCenter(marker.position);
            }
        </script>
    @endscript




</div>
