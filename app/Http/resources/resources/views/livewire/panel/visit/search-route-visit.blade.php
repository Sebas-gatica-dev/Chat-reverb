<div>
@if($allVisits->count() > 0 || $routesOrganized)
   

<div class="sm:col-span-12">
    <div
        class="col-span-12 bg-white shadow-sm border border-gray-300 p-4 mb-4 flex justify-between items-center rounded-md text-sm">
        <button class="focus:outline-none" wire:click="selectPreviusVisit">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-500 hover:text-gray-700" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
        </button>
        <div class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-blue-500" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
            <span class="font-semibold">{{ $routesOrganized[$currentVisitIndex]['visit']['date'] }}</span>
        </div>

        <div class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-red-500" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span>{{ \Carbon\Carbon::parse($routesOrganized[$currentVisitIndex]['visit']['start_time'])->format('H:i') }}
        </div>

        <div class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-purple-500" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
            </svg>
            <span> {{ $routesOrganized[$currentVisitIndex]['visit']['user']['name'] }}</span>
        </div>
        <div class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-green-500" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span>Viaje: {{ $routesOrganized[$currentVisitIndex]['visit']['travel_time'] }} minutos</span>
        </div>

        <div class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-green-500" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span>Duración del trabajo: {{ $routesOrganized[$currentVisitIndex]['visit']['duration_time'] }}
                minutos</span>
        </div>

        <button class="focus:outline-none" wire:click="selectNextVisit">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-500 hover:text-gray-700" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
        </button>
    </div>
    <div class="sm:col-span-12">
        <div class="grid grid-cols-6 gap-4">
            <!-- Primera columna (1/4) -->
            <div
                class="col-span-2 bg-white shadow-md border border-gray-300 p-4 rounded-md overflow-y-scroll h-96 scroll-smooth scrollbar-thin scrollbar-thumb-rounded-full scrollbar-thumb-indigo-300 scrollbar-track-indigo-100">
                <ul class="space-y-4 ">
                    @foreach ($routesOrganized[$currentVisitIndex]['route'] as $index => $visit)
                        <li
                            class="has-tooltip p-4 rounded-lg text-sm border shadow-sm relative 
                    {{ $visit['id'] == $routesOrganized[$currentVisitIndex]['visit']['id']
                        ? 'bg-blue-100 border-blue-200'
                        : (isset($visit['out']) && $visit['out']
                            ? 'bg-red-100 border-red-200'
                            : 'bg-gray-50 border-gray-200') }}">

                            <span class="tooltip">
                                {{ $visit['id'] }}
                            </span>
                            @if ($index > 0)
                                <div class="absolute -top-5 left-0 right-0 text-center">
                                    <span class="text-xs text-gray-200 bg-gray-700 px-2 py-1 rounded-sm">Tiempo de
                                        viaje:
                                        {{ $routesOrganized[$currentVisitIndex]['route'][$index]['travel_time'] }}
                                        min</span>
                                </div>
                            @endif

                            <!-- Hora de la visita -->
                            <div class="flex justify-between items-center">
                                <div class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-500 mr-2"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
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
                                            <svg wire:click="markAsOut({{ $routesOrganized[$currentVisitIndex]['route'] }}, {{ $index }})"
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
                                            <svg wire:click="markAsOut({{ $currentVisitIndex }}, {{ $index }})"
                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                fill="currentColor" class="size-5 cursor-pointer">
                                                <path fill-rule="evenodd"
                                                    d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25Zm-1.72 6.97a.75.75 0 1 0-1.06 1.06L10.94 12l-1.72 1.72a.75.75 0 1 0 1.06 1.06L12 13.06l1.72 1.72a.75.75 0 1 0 1.06-1.06L13.06 12l1.72-1.72a.75.75 0 1 0-1.06-1.06L12 10.94l-1.72-1.72Z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </span>
                                        <span class="text-sm text-gray-500">#{{ $loop->iteration }}</span>
                                    @elseif($visit['id'] == $routesOrganized[$currentVisitIndex]['visit']['id'])
                                        <!-- Azul si es la visita actual "this", sin ícono -->
                                        <span class="text-sm text-blue-500">#{{ $loop->iteration }}</span>
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
</div>



@endif

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
        const currentVisitIndex = $wire.get('currentVisitIndex'); // Obtener el índice actual de la visita
        const routesOrganized = $wire.get('routesOrganized'); // Obtener todas las rutas organizadas

        // Acceder a la ruta organizada correspondiente al currentVisitIndex
        const visits = routesOrganized[currentVisitIndex]['route'];


        const mapId = 'maps';
        const points = visits.map(visit => ({
            lat: visit.latitude,
            lng: visit.longitude
        }));

        let lastSelectedMarker = {};
        let previousSelection = null; // Inicialmente null
        let maps = {};
        let previousVisits = null;
        let markers = []; // Objeto para rastrear marcadores por mapId



        async function initMap() {

            const currentVisitIndex = $wire.get('currentVisitIndex'); // Obtener el índice actual de la visita
            const routesOrganized = $wire.get('routesOrganized'); // Obtener todas las rutas organizadas

            // Acceder a la ruta organizada correspondiente al currentVisitIndex
            const visits = routesOrganized[currentVisitIndex]['route'];

            const mapId = 'maps';
            const points = visits.map(visit => ({
                lat: visit.latitude,
                lng: visit.longitude
            }));


            if (!points || points.length === 0) {
                console.warn('Se necesitan al menos uno o más puntos para visualizar el mapa');
                return;
            }

            const {
                Map
            } = await google.maps.importLibrary("maps");


            const {
                AdvancedMarkerElement
            } = await google.maps.importLibrary("marker");

            const {
                PinElement
            } = await google.maps.importLibrary("marker")


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
                        personalizeMarker(marker, 0, operator, mapId, null);
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
                                    background: "#FBBC04",
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

                                markers.push(marker)
                                // Evento click para personalizar el marcador
                                marker.addListener('click', () => {
                                    personalizeMarker(marker, index, operator,
                                        mapId, pin);
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
        Livewire.hook('element.init', ({
            component,
            el
        }) => {

            if (document.getElementById(mapId)) {

                initMap();


            }
        });

        Livewire.on('refresh', () => {
            initMap();


        });
    </script>
@endscript
