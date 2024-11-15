<div>

    <div class="mx-auto max-w-screen-2xl pt-2 lg:flex lg:gap-x-16 lg:px-8">
        <h1 class="sr-only">Crear nueva sucursal</h1>

        <aside
            class="flex overflow-x-auto border-b border-gray-900/5 py-4 lg:block lg:w-64 lg:flex-none lg:border-0 lg:py-20">

            @include('components.panel.settings.menu-side-bar-settings')

        </aside>

        <main class="px-4 py-16 sm:px-6 lg:flex-auto lg:px-0 lg:pt-20 ">
            <div class="mx-auto max-w-2xl space-y-4 sm:space-y-4 lg:mx-0 lg:max-w-none">

                <div class="sm:flex sm:items-center">
                    <div class="sm:flex-auto">
                        <h1 class="text-base font-semibold leading-6 text-gray-900">Sucursal</h1>
                        <p class="mt-2 text-sm text-gray-700">Crea una nueva sucursal para tu negocio
                        </p>
                    </div>
                    <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                        <a wire:navigate href="{{ route('panel.settings.branches.list') }}"
                            class="cursor-pointer block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                            Atras
                        </a>
                    </div>
                </div>


                <div class="mt-8 flow-root">

                    <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl md:col-span-3">
                                        
                        <div class="px-4 py-6 sm:p-8">
                            <div class="grid w-full grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-9">
                    


                                
                                    <div class="lg:col-span-3 col-span-full">
                                        <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Nombre
                                            de sucursal </label>
                                        <div class="mt-2">
                                            <input type="text" wire:model="name" name="name" id="name"
                                                autocomplete="off" placeholder="Escriba un nombre para la sucursal"
                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 text-sm sm:leading-6">
                                        </div>
                                        @error('name')
                                            <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                        @enderror
                                    </div>
{{--         
                                    <div class="lg:col-span-3 col-span-full">
                                        <label for="address"
                                            class="block text-sm font-medium leading-6 text-gray-900">Direccion</label>
                                        <div class="mt-2">
                                            <input type="text" wire:model="address" name="address" id="address"
                                                autocomplete="off" placeholder="Escriba la direccion de la sucursal"
                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 text-sm sm:leading-6">
                                        </div>
        
                                        @error('address')
                                            <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                        @enderror
                                    </div> --}}
        
                                       {{-- SELECCIONAR USUARIOS PARA LA SUCURSAL --}}
                                    <div class="lg:col-span-3 col-span-full">
                                        <label for="selectedUsers"
                                            class="block text-sm font-medium leading-6 text-gray-900">{{ __("Select users for the branch (Optional) ") }}</label>
                                            <div class="mt-2">
                                                <livewire:components.multi-select-general :selectedValue="$selectedUsers" :values="$users"
                                                    :imageValue="true" :searchEnabled="true" :name="'users'"
                                                    :model="false">
                                            </div>
                                            @error('selectedUsers')
                                                <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                            @enderror
                                    </div>
        
        
        
                                          {{-- AFILIAR CUENTAS BANCARIAS A LA SUCURSAL --}}
                                          <div class="lg:col-span-3 col-span-full">
        
                                            <label for="bank_accounts"
                                                class="block text-sm font-medium leading-6 text-gray-900">Afilia cuentas bancarias a tu sucursal
                                                </label>

                                            <div class="mt-2">
                                                <livewire:components.multi-select-general :selectedValues="$selectedBankAccounts"
                                                    :values="$bank_accounts" :imageValue="false" :searchEnabled="true" :name="'bank_accounts'"
                                                    :model="false">
                                            </div>
                                            @error('selectedBankAccounts')
                                                <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                            @enderror
                                        </div>
        
        
                               
                    
                    
                            </div>
                        </div>





                    </div>





                </div>
                 {{-- comienzo del form map --}}

      {{-- @dump('desde add branch',$latitude, $longitude) --}}
                 <div class="grid grid-cols-1 gap-x-8 gap-y-8 pt-2">
                    {{-- <div class="px-4 sm:px-0">
                        <h2 class="text-base font-semibold leading-7 text-gray-900">Personal Information</h2>
                        <p class="mt-1 text-sm leading-6 text-gray-600">Use a permanent address where you can
                            receive mail.</p>
                    </div> --}}

                    <livewire:components.maps.google-map-form-field-component
                    :latitude="$latitude"
                    :longitude="$longitude"
                    :inputField="true"
                    :input_id="'address'"
                   />




                    
                </div>


                <div class="flex items-center justify-end gap-x-4  px-4  sm:px-8">
                    <button wire:click="save('save')"
                        class="rounded-md bg-indigo-600 px-3 py-2 font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 text-sm focus-visible:outline-indigo-600">Crear</button>

                    <button wire:click="save('save-new')"
                        class="rounded-md bg-indigo-600 px-3 py-2 font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 text-sm focus-visible:outline-indigo-600">Crear
                        y crear otra</button>
                 </div>


             {{--  --}}

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
</div>
