<div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl w-full">
    <div class="px-4 py-6 sm:p-8">
        <div class="grid w-full grid-cols-1 gap-x-6 gap-y-3 sm:grid-cols-12">


            <div class="sm:col-span-12 grid grid-cols-1 gap-4 lg:grid-cols-2">


                @if ($selectField)

                    <div class="lg:col-span-1">
                        <label for="address" class="block text-sm font-medium leading-6 text-gray-900">Dirección inicial
                            sucursal (*)</label>
                        <div class="mt-2">
                            <input {{-- MEJORAR DISABLED --}} type="text" wire:model.live="address" id="address"
                                x-bind:disabled="coordSelect !== 'editPoint'" autocomplete="address"
                                placeholder="Av. Rivadavia N°1234"
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>


                    <div class="lg:col-span-1">
                        <label for="coordSelect" class="block text-sm font-medium leading-6 text-gray-900">Selecciona
                            sucursal para coordenadas iniciales</label>
                        <div class="mt-2">
                            <select id="coordSelect" wire:model.live="coordSelect" x-model="coordSelect"
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                <option value="default">Seleccione una sucursal</option>
                                @foreach ($selectElements as $element)
                                    <option
                                        value="{{ $element['latitude'] }},{{ $element['longitude'] }},{{ $element['address'] }}">
                                        {{ $element['name'] }}
                                    </option>
                                @endforeach
                                <option value="editPoint" @click="doSomething()">Ubicacion personalizada</option>
                            </select>

                        </div>
                        @error('coordSelect')
                            <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                        @enderror
                    </div>
                @elseif($inputField)
                    <div class="sm:col-span-12">
                        <label for="address" class="block text-sm font-medium leading-6 text-gray-900">Dirección
                            (*)</label>
                        <div class="mt-2">
                            <input type="text" wire:model.live="address" id="address" autocomplete="address"
                                placeholder="Av.Rivadavia N°1234"
                                class="block w-full lg:w-3/6 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        </div>
                        @error('address')
                            <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                        @enderror
                    </div>
                @endif
                @error('address')
                    <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                @enderror
            </div>

            {{-- @dump('desde el map',$latitude, $longitude, $address, $coordSelect) --}}

            {{-- @dump($address) --}}

            <input type="hidden" wire:model="latitude" id="latitude">
            <input type="hidden" wire:model="longitude" id="longitude">
            <div class="col-span-full">
                <div id="map" class="shadow-sm rounded-lg w-full h-96 object-cover" wire:ignore></div>
            </div>


        </div>
    </div>
    @foreach ($errors->all() as $error)
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 my-2 rounded relative" role="alert">
            <strong class="font-bold">Error!</strong>
            <span class="block sm:inline">{{ $error }}</span>
        </div>
    @endforeach

</div>
@push('scripts')
    <script data-navigate-once>
        document.addEventListener('livewire:navigated', function() {
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
                libraries: "places,marker,geocoder"
            });
        }, {
            once: true
        });
    </script>
    <script>
        document.addEventListener('livewire:navigated', function() {
            const mapElement = document.getElementById('map');

            if (mapElement) {

                async function initMap() {
                    const {
                        Map
                    } = await google.maps.importLibrary("maps");
                    const {
                        AdvancedMarkerElement
                    } = await google.maps.importLibrary("marker");

                    const latitudeInput = document.getElementById('latitude');
                    const longitudeInput = document.getElementById('longitude');

                    // Get initial coordinates from input fields
                    const initialLat = parseFloat(latitudeInput.value) || -34.59039;
                    const initialLng = parseFloat(longitudeInput.value) || -58.41388;

                    const map = new Map(document.getElementById('map'), {
                        center: {
                            lat: initialLat,
                            lng: initialLng
                        },
                        zoom: 15,
                        mapId: 'DEMO_MAP_ID' // Usa tu propio ID de mapa si tienes uno
                    });

                    const input_id = @this.input_id;
                    const textInputField = @this.inputField;

                    console.log(input_id);

                    let input = null;

                    if(input_id && !textInputField){

                        input = document.getElementById(input_id);

                    }else{

                        input = document.getElementById('address');

                    }



                 
                    const options = {
                        componentRestrictions: {
                            country: "arg"
                        },
                        types: [
                            'address'
                        ] // Esto limita los resultados solo a direcciones, excluyendo países
                    };

                    const autocomplete = new google.maps.places.Autocomplete(input, options);
                    autocomplete.bindTo('bounds', map);

                    const marker = new AdvancedMarkerElement({
                        map: map,
                        position: {
                            lat: initialLat,
                            lng: initialLng
                        },
                        title: "Ubicación seleccionada",
                        gmpDraggable: true // Habilitar arrastre
                    });

                    autocomplete.addListener('place_changed', function() {
                        marker.map = null;
                        const place = autocomplete.getPlace();

                        let streetNumber = '';
                        let route = '';
                        // Separar el número de la calle y la ruta
                        for (let i = 0; i < place.address_components.length; i++) {
                            const addressType = place.address_components[i].types[0];
                            if (addressType === 'street_number') {
                                streetNumber = place.address_components[i].long_name;
                            } else if (addressType === 'route') {
                                route = place.address_components[i].long_name;
                            }
                        }
                        // Concatenar en el orden deseado y asignar al input
                        document.getElementById('address').value = `${route} ${streetNumber}`;
                        if (!place.geometry) {
                            window.alert("No se encontró la dirección: '" + place.name + "'");
                            return;
                        }

                        // Si el lugar tiene una geometría, presenta ella en un mapa.
                        if (place.geometry.viewport) {
                            map.fitBounds(place.geometry.viewport);
                        } else {
                            map.setCenter(place.geometry.location);
                            map.setZoom(17);
                        }
                        marker.position = place.geometry.location;
                        marker.map = map;

                        const lat = place.geometry.location.lat();
                        const lng = place.geometry.location.lng();
                        document.getElementById('latitude').value = lat;
                        document.getElementById('longitude').value = lng;

                        Livewire.dispatch('updateLatLong', {
                            lat: lat,
                            lng: lng
                        });

                        Livewire.dispatch('updateAddress', {
                            address: input.value
                        });

                    });

                  
                    Livewire.on('updateLatLong', (event) => {
                     
                        const lat = event.lat;
                        const lng = event.lng;
                        const position = new google.maps.LatLng(lat, lng);
                        marker.position = position;
                        map.setCenter(position);

                      
                        console.log(lat,lng);
                    });

                    Livewire.on('editPoint', (event) => {
                        let alpineComponent = document.querySelector('#address');
                        if (event.status) {
                            marker.gmpDraggable = true;
                            input.disabled = false;
                        } else {
                            marker.gmpDraggable = false;
                            input.disabled = true;
                        }
                    });

                    marker.addListener('dragend', function(event) {
                        const latLng = event.latLng;
                        const lat = latLng.lat();
                        const lng = latLng.lng();

                        document.getElementById('latitude').value = lat;
                        document.getElementById('longitude').value = lng;

                        // Envía los valores actualizados a Livewire
                        Livewire.dispatch('updateLatLong', {
                            lat: lat,
                            lng: lng
                        });

                        Livewire.dispatch('updateAddress', {
                            address: input.value
                        });

                    });
                }
                initMap();
            }
        });
    </script>
@endpush
