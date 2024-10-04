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
            <span>{{ \Carbon\Carbon::parse($routesOrganized[$currentVisitIndex]['visit']['time'])->format('H:i') }}
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
                                        class="font-medium text-gray-700">{{ \Carbon\Carbon::parse($visit['time'])->format('H:i') }}</span>
                                </div>
                                <!-- ID o información adicional de la visita -->
                                <div class="flex items-center">
                                    @if (isset($visit['out']) && $visit['out'])
                                        <!-- Ícono en rojo si 'out' es true -->
                                        <span class="mr-2 bg-red-200 text-red-500 p-0.5 rounded-full">
                                            <svg wire:click="markAsOut({{ $currentVisitIndex }}, {{ $index }})"
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


            <!-- Segunda columna (3/4) -->
            <div class="col-span-4 h-96 bg-white shadow-md border border-gray-300 p-4  rounded-md ">
                <div wire:ignore class="h-full" id="maps"></div>
            </div>
        </div>
    </div>

    {{-- <div class="sm:col-span-12">


        <div class="relative w-full max-w-md mx-auto">


            <div class="overflow-hidden">

                <div class="flex" id="carousel">


                    @foreach ($routesOrganized as $index => $visit)
                        <div class="w-full flex-shrink-0 cursor-pointer" id="slide-{{ $index }}"
                            x-data="{ selected: false }" x-on:click="selected = !selected"
                            wire:key="slide-{{ $index }}"
                            wire:click="handleClick({{ $loop->iteration }}, '{{ $visit['visit']['date'] }}', '{{ $visit['visit']['time'] }}', '{{ $visit['visit']['user']['id'] }}')">
                            <div class="border border-gray-200 rounded-lg shadow-md p-6 m-2">
                                <div class="flex items-center mb-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-blue-500"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <span class="font-semibold">{{ $visit['visit']['date'] }}</span>
                                </div>
                                <div class="flex items-center mb-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-green-500"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span>Travel Time: {{ $visit['visit']['travel_time'] }}</span>
                                </div>

                                <div class="flex items-center mb-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-green-500"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span>Duration Time: {{ $visit['visit']['duration_time'] }}</span>
                                </div>
                                <div class="flex items-center mb-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-green-500"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span>{{ $visit['visit']['time'] }}</span>
                                </div>
                                <div class="flex items-center mb-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-purple-500"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    <span> {{ $visit['visit']['user']['name'] }}</span>
                                </div>

                                <div class="flex items-center">



                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2 text-red-400">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M9 6.75V15m6-6v8.25m.503 3.498 4.875-2.437c.381-.19.622-.58.622-1.006V4.82c0-.836-.88-1.38-1.628-1.006l-3.869 1.934c-.317.159-.69.159-1.006 0L9.503 3.252a1.125 1.125 0 0 0-1.006 0L3.622 5.689C3.24 5.88 3 6.27 3 6.695V19.18c0 .836.88 1.38 1.628 1.006l3.869-1.934c.317-.159.69-.159 1.006 0l4.994 2.497c.317.158.69.158 1.006 0Z" />
                                    </svg>


                                    <span> Ver ruta</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="px-2">
                <button type="button"
                    class="rounded-md bg-gray-700 px-2.5  py-1.5 text-sm font-semibold text-white shadow-sm hover:bg-gray-600 w-full"
                    wire:click="selectNextVisit">Buscar otra fecha</button>
            </div>

            <!-- Botones de navegación -->
            <button
                class="absolute left-[-45px] top-1/2 transform -translate-y-1/2 bg-white p-2 rounded-full shadow border border-gray-300"
                aria-label="Anterior visita">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-600" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </button>
            <button
                class="absolute right-[-45px] top-1/2 transform -translate-y-1/2 bg-white p-2 rounded-full shadow border border-gray-300"
                aria-label="Siguiente visita">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-600" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </button>


        </div>
    </div> --}}
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
                                    // content: {
                                    //     text: (index + 1).toString(),
                                    //     color: 'white',
                                    //     fontSize: '12px',
                                    //     fontWeight: 'bold'
                                    // }
                                });




                                markers.push(marker);

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

        initMap();

        Livewire.on('refresh', () => {
            initMap();
            Livewire.hook('morph.added', ({
                el,
                component
            }) => {



                const carousel = document.getElementById('carousel');
                const slides = carousel.children;
                const totalSlides = slides.length;
                const currentIndex = totalSlides - 1; // Iniciar en el último slide

                // Mover el carrusel según la dirección (-1 para izquierda, 1 para derecha)
                function moveCarousel(direction) {
                    currentIndex = (currentIndex + direction + totalSlides) % totalSlides;

                    const slideWidth = slides[0].offsetWidth;
                    carousel.style.transform = `translateX(-${currentIndex * slideWidth}px)`;
                }

                // Establecer el carrusel en el último slide al cargarse
                const slideWidth = slides[0].offsetWidth;
                carousel.style.transform = `translateX(-${currentIndex * slideWidth}px)`;

                // Agregar eventos a los botones de navegación
                document.querySelector('button[aria-label="Anterior visita"]').addEventListener('click',
                    () => {
                        moveCarousel(-1); // Mover hacia la izquierda
                    });

                document.querySelector('button[aria-label="Siguiente visita"]').addEventListener('click',
                    () => {
                        moveCarousel(1); // Mover hacia la derecha
                    });

                carousel.style.transition = 'transform 0.3s ease-in-out';
            });

        });
    </script>
@endscript
