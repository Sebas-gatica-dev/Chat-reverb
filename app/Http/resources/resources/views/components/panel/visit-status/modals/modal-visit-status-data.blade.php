@php
    use App\Enums\StatusVisitEnum;
@endphp

@props([
    'modalStatusChangeData',
    'statusName',
    'statusChange',
    'defaultDataFields',
    'dataFormsDynamic',
    'visit',
    'latitude',
    'longitude',
])

{{-- <template x-teleport="body"> --}}
    <div 
    {{-- x-data="{
        modalStatusChangeData: @entangle('modalStatusChangeData'),
    }" --}}
    x-show="modalStatusChangeData"
      x-trap.inert.noscroll="modalStatusChangeData"
    class="fixed top-0 left-0 z-[99] flex items-center justify-center w-screen h-screen p-4" x-cloak>



        <div x-show="modalStatusChangeData"  x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-300"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
            @click="modalStatusChangeData=false" class="absolute inset-0 w-full h-full bg-gray-900/60 backdrop-blur-sm">
        </div>

         <div x-show="modalStatusChangeData" 
            x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 scale-90"
            x-transition:enter-end="opacity-100 scale-100" x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90"
            class="relative w-full max-w-2xl max-h-[80vh] overflow-y-auto bg-white shadow-xl px-4 sm:px-6 py-6 bg-opacity-95 rounded-xl">
            <div class="mb-6">
                <h2 class="text-xl font-semibold text-gray-900 mb-2">Detalles del estado {{ $statusName }}</h2>
            </div>

            <div class="space-y-6">
                <!-- Mapa -->

                @if($modalStatusChangeData)
                <div class="rounded-lg overflow-hidden shadow-sm border border-gray-200 z-50">
                    {{-- @dump($latitude,$longitude) --}}
                    {{-- <livewire:components.maps.google-map-form-field-component
                        :latitude="$latitude"
                        :longitude="$longitude"
                     lazy
                   /> --}}
                   <div class="col-span-full">
                    <div id="map" class="shadow-sm rounded-lg w-full h-96 object-cover" wire:ignore></div>
                </div>
                </div>

                <div class="bg-gray-50 rounded-lg p-4 space-y-4">
                    <div class="grid sm:grid-cols-2 gap-4">
                        <div class="flex flex-col">
                            <span class="text-sm font-medium text-gray-500">Estado Actual:</span>
                            <span class="text-sm font-semibold text-blue-600">
                             
                                {{ StatusVisitEnum::getStatus($visit['status']) }}
                            </span>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-sm font-medium text-gray-500">Fecha y Hora:</span>
                            <span class="text-sm text-gray-700">
                                {{ $statusChange ? $statusChange->created_at->format('Y-m-d H:i') : '' }}
                            </span>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-sm font-medium text-gray-500">Intervalo:</span>
                            <span class="text-sm text-gray-700">

                                {{ $statusChange ? $statusChange->interval_status : '' }}
                            </span>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-sm font-medium text-gray-500">Técnico:</span>
                            <span class="text-sm text-gray-700">
                                Ernesto Juarez
                            </span>
                        </div>
                    </div>
                    @if ($defaultDataFields)
                        <div class="grid sm:grid-cols-2 gap-4">
                            @foreach ($defaultDataFields as $index => $defaultField)
                            @continue(in_array($index, ['has-big-delay', 'has-delay-time']))
                                <div class="flex flex-col">
                                    <span class="text-sm font-medium text-gray-500">
                                        
                                        @switch($index)
                                            @case('big-delay-time')
                                                Gran desfasaje de tiempo            
                                                @break
                                            @case('reason-delay')
                                                Motivo de retraso
                                                @break
                                            @case('comment')
                                                Comentario antes de partir
                                            @break
                                            @case('approximate_time')
                                                Tiempo aproximado de llegada(minutos)
                                            @break
                                            
                                        
                                            @default {{ $index }}
                                                
                                        @endswitch
                                       </span>
                                    <span class="text-sm font-semibold text-blue-600">
                                        {{ $defaultField }}
                                    </span>
                                </div>
                            @endforeach
                        </div>
                    @endif
                    @if ($dataFormsDynamic)
                        <div class="grid sm:grid-cols-2 gap-4">
                            @foreach ($dataFormsDynamic as $formDynamic)
                                <div class="flex flex-col">
                                    <span class="text-sm font-medium text-gray-500">
                                        {{ $formDynamic['label'] }}
                                    </span>
                                    <span class="text-sm font-semibold text-blue-600">
                                        {{ json_decode($formDynamic['input_data'][0]['data'], true)['value'] }}
                                    </span>
                                </div>
                            @endforeach
                        </div>
                    @endif

                </div>

                @endif
            </div> 


            
          @if($statusChange)
            @if (!$statusChange['out_of_range'])
                <div class="rounded-md bg-red-50 p-4 mt-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a.75.75 0 000 1.5h.253a.25.25 0 01.244.304l-.459 2.066A1.75 1.75 0 0010.747 15H11a.75.75 0 000-1.5h-.253a.25.25 0 01-.244-.304l.459-2.066A1.75 1.75 0 009.253 9H9z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3 flex-1 md:flex md:justify-between">
                            <p class="text-sm text-red-700">¡La actualización de estado se realizo fuera de rango!.</p>
                        </div>
                    </div>
                </div>
                
            @endif
         @endif


            <div class="mt-6 flex justify-end">
                <button @click="modalStatusChangeData=false; $dispatch('close-status-change-data-modal');"
                    type="button"
                    class="inline-flex items-center justify-center px-4 py-2 border border-gray-300 
                                    rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 
                                    
                                    transition duration-150 ease-in-out">
                    Cerrar
                </button>
            </div>
        </div>


    </div>
</template>
@push('scripts')
@script

<script>

let mapInstance = null; // Variable global para almacenar la instancia del mapa
// let googleMapsScript = null; // Variable para almacenar el script de Google Maps API

async function initMap() {
    console.log('Initializing Map');
    const { Map } = await google.maps.importLibrary("maps");
    const { AdvancedMarkerElement } = await google.maps.importLibrary("marker");

    const initialLat = parseFloat(@json($latitude)) || -34.59039;
    const initialLng = parseFloat(@json($longitude)) || -58.41388;

    mapInstance = new Map(document.getElementById('map'), {
        center: { lat: initialLat, lng: initialLng },
        zoom: 15,
        mapId: 'DEMO_MAP_ID' // Usa tu ID de mapa si tienes uno
    });

    const marker = new AdvancedMarkerElement({
        map: mapInstance,
        position: { lat: initialLat, lng: initialLng },
        title: "Ubicación seleccionada",
        gmpDraggable: true
    });

    marker.addListener('dragend', function(event) {
        const lat = event.latLng.lat();
        const lng = event.latLng.lng();
        
        Livewire.emit('updateLatLong', { latitude: lat, longitude: lng });
    });
}

// function loadGoogleMapsScript() {
//     return new Promise((resolve, reject) => {
//         if (googleMapsScript) {
//             resolve(); // Si el script ya está cargado, no se vuelve a cargar
//             return;
//         }
        
//         googleMapsScript = document.createElement('script');
//         googleMapsScript.src = `https://maps.googleapis.com/maps/api/js?key=AIzaSyD3K3dBES7-pn0gkICbQyiQgfNHhlUU3W4&libraries=places,marker,geocoder`;
//         googleMapsScript.async = true;
//         googleMapsScript.onload = resolve;
//         googleMapsScript.onerror = reject;
//         document.head.appendChild(googleMapsScript);
//     });
// }

async function initializeMapWhenReady() {
    const mapContainer = document.getElementById('map');
    if (!mapContainer) {
        setTimeout(initializeMapWhenReady, 100); // Reintenta cada 100 ms hasta que `div#map` esté disponible
    } else {
        await initMap(); // Llama a `initMap()` cuando `div#map` esté listo
    }
}

Livewire.on('open-status-change-data-modal', async function() {
    console.log('Opening modal and loading map');
    
    // await loadGoogleMapsScript(); // Carga el script de Google Maps si no está ya cargado
    initializeMapWhenReady(); // Inicializa el mapa cuando el modal se abre y `div#map` esté listo
});

Livewire.on('close-status-change-data-modal', function() {
    console.log('Closing modal and destroying map instance');
    
    if (mapInstance) {
        mapInstance = null; // Limpia la instancia del mapa
    }
    
    //Limpia el contenedor del mapa
    const mapDiv = document.getElementById('map');
    if (mapDiv) {
        mapDiv.innerHTML = ''; 
    }

    // Elimina el script de Google Maps del DOM para desconectar la conexión
    // if (googleMapsScript) {
    //     googleMapsScript.remove();
    //     googleMapsScript = null;
    // }
});

</script>
@endscript
@endpush
