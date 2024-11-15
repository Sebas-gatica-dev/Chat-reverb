<div>
    <header class="bg-white shadow">
        <div class="mx-auto max-w-screen-2xl px-4 py-6 sm:px-6 lg:px-8">
            <div class="md:flex md:items-center md:justify-between">
                <div class="min-w-0 flex-1">
                    <h1 class="text-2xl font-bold tracking-tight text-gray-900">Crear empresa</h1>
                </div>
                {{--                 <div class="mt-4 flex md:ml-4 md:mt-0">
                    <a wire:navigate href="{{ route('panel.customers') }}"
                        class="inline-flex items-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">Volver</a>


                </div> --}}
            </div>
        </div>


    </header>
    <main>

        <div class="mx-auto max-w-screen-2xl py-6 sm:px-6 lg:px-8">

            <div class="mt-8 flow-root">


                <div class="space-y-10 divide-y divide-gray-900/10">

                    <div class="grid grid-cols-1 gap-x-8 gap-y-8 md:grid-cols-4">
                        <div class="px-4 sm:px-0">
                            <h2 class="text-base font-semibold leading-7 text-gray-900">Perfil de empresa</h2>
                            <p class="mt-1 text-sm leading-6 text-gray-600">Llena los siguientes campos del formulario
                                para crear su empresa.</p>
                        </div>

                        <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl md:col-span-3">
                            <div class="px-4 py-6 sm:p-8">
                                <div class="grid w-full gap-x-6 gap-y-8 grid-cols-12 md:col-span-2">

                                    <div class="lg:col-span-3 col-span-full">
                                        <label for="first-name"
                                            class="block text-sm font-medium leading-6 text-gray-900">Nombre
                                            empresa</label>
                                        <div class="mt-2">
                                            <input type="text" wire:model="name" name="name" id="name"
                                                autocomplete="off" placeholder="Empresa S.A"
                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 text-sm sm:leading-6">
                                        </div>
                                        @error('name')
                                            <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                        @enderror
                                    </div>


                                    <div class="lg:col-span-3 col-span-full">
                                        <label for="email"
                                            class="block text-sm font-medium leading-6 text-gray-900">Correo
                                            electrónico</label>
                                        <div class="mt-2">
                                            <input id="email" wire:model="email" name="email" type="email"
                                                autocomplete="email" placeholder="nombre@dominio.com"
                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 text-sm sm:leading-6">
                                        </div>

                                        @error('email')
                                            <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                        @enderror
                                    </div>


                                    <div class="lg:col-span-3 col-span-full">
                                        <label for="phone"
                                            class="block text-sm font-medium leading-6 text-gray-900">Teléfono</label>
                                        <div class="mt-2">
                                

                                                <input type="text" wire:model="phone" id="phone"
                                                    autocomplete="off" placeholder="Ingrese numero de telefono"
                                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 text-sm sm:leading-6">
                                        
                                        </div>

                                        @error('phone')
                                            <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                        @enderror

                                    </div>


                                    <div class="lg:col-span-3 col-span-full">
                                        <label for="industries"
                                            class="block text-sm font-medium leading-6 text-gray-900">Industrias
                                            (*)</label>
                                        <div class="mt-2">
                                            <livewire:components.select-general :selectedValue="$selectedIndustry" :values="$industries"
                                                :imageValue="false" :searchEnabled="true" :name="'industries'" :model="false">
                                        </div>
                                        @error('selectedIndustry')
                                            <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                        @enderror



                                    </div>




                                    <div class=" col-span-full">
                                        <label for="logo"
                                            class="block text-sm font-medium leading-6 text-gray-900">Logo</label>

                                        <livewire:components.upload-file :multiple="false" :types="['image']" :name="'business'"/>

                                        @if ($errors->has('logo'))
                                            <span
                                                class="text-red-500 text-sm ml-0.5">{{ $errors->first('logo') }}</span>
                                        @else
                                            <p class="mt-3 text-sm leading-6 text-gray-600">Es recomendable que sea una
                                                imagen
                                                cuadrada,
                                                por ejemplo: 500x500 pixeles.</p>
                                        @endif
                                    </div>



                                </div>
                            </div>



















                        </div>






                    </div>




                </div>

            </div>



            <div class="grid grid-cols-1 gap-x-8 gap-y-8 md:grid-cols-4 mt-6">


                    <div class="px-4 sm:px-0 col-span-full md:col-span-1" >
                    <h2 class="text-base font-semibold leading-7 text-gray-900">Ubicacion de empresa</h2>
                    <p class="mt-1 text-sm leading-6 text-gray-600">Selecciona una direccion la cual haga referencia a la ubicación de tu empresa o su principal sucursal.</p>
                </div>

                {{-- @dump($latitude, $longitude) --}}

              <div class="col-span-full md:col-span-3"> 
                <livewire:components.maps.google-map-form-field-component
                :selectField="false"
                :latitude="$latitude"
                :longitude="$longitude"
                :inputField="true"
                :input_id="'address'"

                   />
            </div>






            </div>






            <div class="flex items-center justify-end gap-x-6  px-4 py-4 sm:px-8">
                <button wire:click="save()"
                    class="rounded-md bg-indigo-600 px-3 py-2 font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 text-sm focus-visible:outline-indigo-600">Continuar</button>

            </div>
        </div>




    </main>
    {{-- @push('scripts')
        <script>
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
                    libraries: "places,marker"
                });

                async function initMap() {
                    const {
                        Map
                    } = await google.maps.importLibrary("maps");
                    const {
                        AdvancedMarkerElement
                    } = await google.maps.importLibrary("marker");

                    const map = new Map(document.getElementById('map'), {
                        center: {
                            lat: -34.59039,
                            lng: -58.41388
                        },
                        zoom: 10,
                        mapId: 'DEMO_MAP_ID' // Usa tu propio ID de mapa si tienes uno
                    });

                    const input = document.getElementById('address');
                    const options = {
                        componentRestrictions: { country: "arg" },
                        types: ['address'] // Esto limita los resultados solo a direcciones, excluyendo países
                    };

                    const autocomplete = new google.maps.places.Autocomplete(input, options);
                    autocomplete.bindTo('bounds', map);

                    const marker = new AdvancedMarkerElement({
                        map: map,
                        position: {
                            lat: -34.59039,
                            lng: -58.41388
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
                    });
                }

                initMap();
            });
        </script>
    @endpush --}}
</div>
