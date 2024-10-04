<div>
    <div class="mx-auto max-w-screen-2xl pt-2 lg:flex lg:gap-x-16 lg:px-8">
        <h1 class="sr-only">Edición del usuario {{ $user->name }}</h1>

        <aside
            class="flex overflow-x-auto border-b border-gray-900/5 py-4 lg:block lg:w-64 lg:flex-none lg:border-0 lg:py-20">

            @include('components.panel.settings.menu-side-bar-settings')

        </aside>
        <main class="px-4 py-16 sm:px-6 lg:flex-auto lg:px-0 lg:py-20">

            <div class="mx-auto max-w-2xl space-y-16 sm:space-y-8 lg:mx-0 lg:max-w-none">

                <div class="sm:flex sm:items-center">
                    <div class="sm:flex-auto">
                        <h1 class="text-base font-semibold leading-6 text-gray-900">Usuario</h1>
                        <p class="mt-2 text-sm text-gray-700">Edición del usuario: {{ $user->name }}
                        </p>
                    </div>
                    <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                        <a href={{ route('panel.settings.users.list') }} wire:navigate
                            class="cursor-pointer block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                            Atras
                        </a>
                    </div>
                </div>
                <div class="mt-8 flow-root">





                    <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl md:col-span-3">


                        <div class="px-4 py-6 sm:p-8">
                            <div class="grid w-full grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-12">










                            <div class="col-span-full sm:col-span-3 md:col-span-4  xl:col-span-3">
                                <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Nombre
                                    de usuario </label>
                                <div class="mt-2">
                                    <input type="text" wire:model="name" name="name" id="name" value="name"
                                        autocomplete="off" placeholder="Escriba un nombre para el usuario"
                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 text-sm sm:leading-6">
                                </div>
                                @error('name')
                                    <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                @enderror
                            </div>



                            <div class="col-span-full sm:col-span-3 md:col-span-4  xl:col-span-3">
                                <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Correo
                                    electronico</label>
                                <div class="mt-2">
                                    <input type="email" wire:model="email" name="email" id="email"
                                        value="email" autocomplete="off"
                                        placeholder="Escriba el correo electronico del usuario"
                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 text-sm sm:leading-6">
                                </div>

                                @error('email')
                                    <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                @enderror
                            </div>

                            <div x-data="{ showPassword: @entangle('showPassword').live }" class="col-span-full sm:col-span-3 md:col-span-4  xl:col-span-3">
                                <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Crear nueva contraseña</label>
                                <div class="mt-2 relative">
                                    <input :type="showPassword ? 'text' : 'password'" wire:model="password"
                                        name="password" id="password" autocomplete="off"
                                        placeholder="Escriba la contraseña del usuario"
                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 text-sm sm:leading-6">
                                    <button type="button" @click="showPassword = !showPassword"
                                        class="absolute inset-y-0 right-0 pr-3 flex items-center text-sm leading-6">

                                        <svg :class="{ 'hidden': showPassword, 'block': !showPassword }"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="h-5 w-5 text-gray-500">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                        </svg>

                                        <svg :class="{ 'block': showPassword, 'hidden': !showPassword }"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="h-5 w-5 text-gray-500">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                                        </svg>

                                    </button>
                                </div>
                                @error('password')
                                    <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                @enderror
                            </div>

                            <div x-data="{ showPassword: @entangle('showPassword').live }" class="col-span-full sm:col-span-3 md:col-span-4  xl:col-span-3">
                                <label for="password"
                                    class="block text-sm font-medium leading-6 text-gray-900">Confirmar contraseña</label>
                                <div class="mt-2 relative">
                                    <input :type="showPassword ? 'text' : 'password'" wire:model="password_confirmation"
                                        name="password_confirmation" id="password_confirmation" autocomplete="off"
                                        placeholder="Confirme la contraseña del usuario"
                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 text-sm sm:leading-6">
                                    <button type="button" @click="showPassword = !showPassword"
                                        class="absolute inset-y-0 right-0 pr-3 flex items-center text-sm leading-6">

                                        <svg :class="{ 'hidden': showPassword, 'block': !showPassword }"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="h-5 w-5 text-gray-500">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                        </svg>

                                        <svg :class="{ 'block': showPassword, 'hidden': !showPassword }"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="h-5 w-5 text-gray-500">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                                        </svg>

                                    </button>
                                </div>
                                @error('password_confirmation')
                                    <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                @enderror
                            </div>



                            <div class="col-span-full sm:col-span-3 md:col-span-4  xl:col-span-4 ">

                                <label for="services"
                                    class="block text-sm font-medium leading-6 text-gray-900">Asignar rol
                                    (*)</label>
                                <div class="mt-2">
                                    <livewire:components.multi-select-general :selectedValues="$selectedRoles" :values="$roles"
                                        :imageValue="false" :searchEnabled="true" :name="'roles'" :model="false">
                                </div>
                                @error('selectedRoles')
                                    <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                @enderror
                            </div>


                            <div class="col-span-full sm:col-span-3 md:col-span-4  xl:col-span-4 ">
                                <label for="branches"
                                    class="block text-sm font-medium leading-6 text-gray-900">Selecciona sucursales </label>
                                <div class="mt-2">

                                    <livewire:components.multi-select-general :selectedValues="$selectedBranches" :values="$branches"
                                        :imageValue="false" :searchEnabled="true" :name="'branches'" :model="false">
                                </div>
                                @error('selectedBranches')
                                    <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-span-full sm:col-span-3 md:col-span-4  xl:col-span-4 ">
                                <label for="selectedBranches"
                                    class="block text-sm font-medium leading-6 text-gray-900">Selecciona el
                                    transporte</label>
                                <div class="mt-2">
                                    <select id="transport" wire:model="transport" autocomplete="transport"
                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                        <option value="">Seleccione el transporte</option>
                                        @foreach ($transports as $transport)
                                            <option value="{{ $transport->value }}" @selected($transport->value == $transport)>
                                                {{ \App\Enums\TransportEnum::getTransport($transport) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('transport')
                                    <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                @enderror
                            </div>
                

                            {{-- <div class="sm:col-span-full">
                                <div class="rounded-md bg-blue-50 p-4 w-100">
                                    <div class="flex">
                                        <div class="flex-shrink-0">
                                            <svg class="h-5 w-5 text-blue-400" viewBox="0 0 20 20"
                                                fill="currentColor" aria-hidden="true">
                                                <path fill-rule="evenodd"
                                                    d="M8.485 2.495c.673-1.167 2.357-1.167 3.03 0l6.28 10.875c.673 1.167-.17 2.625-1.516 2.625H3.72c-1.347 0-2.189-1.458-1.515-2.625L8.485 2.495zM10 5a.75.75 0 01.75.75v3.5a.75.75 0 01-1.5 0v-3.5A.75.75 0 0110 5zm0 9a1 1 0 100-2 1 1 0 000 2z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                        <div class="ml-3">
                                            <h3 class="text-sm font-medium text-blue-900">Zonas en las que trabaja
                                                {{ $user->name }}</h3>
                                            <div class="mt-2 text-sm text-blue-800">
                                                <p>Selecciona las zonas en las que trabaja este usuario y no olvides de
                                                    apretar el boton de agregar para guardar los cambios.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}

                           {{-- 
                            <div class="col-span-full">
                                <livewire:components.select-zones :model="$user" :provincesBusiness="auth()->user()->business->provinces" />
                            </div>

                            <hr class="sm:col-span-full">

                            <div class="col-span-full">
                                <livewire:components.add-date-availability-general :selectedValues="$availabilities" />
                            </div> --}}


                        </div>


                        <div class="lg:col-span-3 col-span-full m-4">
                            <label for="photo"
                                class="block text-sm font-medium leading-6 text-gray-900">Foto</label>
    
                            <livewire:components.upload-file :multiple="false" :extensions="['jpg', 'jpeg', 'png', 'gif', 'webp']"
                                :existingFiles="$photo" :name="'user-photo'" />
    
                        </div>


                    </div>



                    
                   








                    </div>





            </div>


     {{-- SELECTOR DE ZONAS --}}
            <div class="grid grid-cols-1 gap-x-8 gap-y-3 pt-2">
                <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl ">

                    <div class="col-span-full">
                        <div class="px-4 py-6 sm:p-8">
                           <livewire:components.select-zones :model="$user" :provincesBusiness="auth()->user()->business->provinces" />
                        </div>
                    </div>

                </div>

            </div>
    {{--FIN SELECTOR DE ZONAS --}}


     {{-- SELECTOR DE HORARIOS --}}
            <div class="grid grid-cols-1 gap-x-8 gap-y-3 pt-2">
                <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl ">

                    <div class="col-span-full">
                        <div class="px-4 py-6 sm:p-8">
                           <livewire:components.add-date-availability-general :selectedValues="$availabilities" />
                        </div>
                    </div>

                </div>

            </div>
      {{--FIN SELECTOR DE HORARIOS --}}




          {{-- @dump($address) --}}

                <div class="grid grid-cols-1 gap-x-8 gap-y-8 pt-2">
                    {{-- <div class="px-4 sm:px-0">
                        <h2 class="text-base font-semibold leading-7 text-gray-900">Personal Information</h2>
                        <p class="mt-1 text-sm leading-6 text-gray-600">Use a permanent address where you can
                            receive mail.</p>
                    </div> --}}

                    {{-- <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl">
                        <div class="px-4 py-6 sm:p-8">
                            <div class="grid w-full grid-cols-1 gap-x-6 gap-y-3 sm:grid-cols-12">


                                <div class="sm:col-span-12 grid grid-cols-1 gap-4 lg:grid-cols-2">
                                    <div class="lg:col-span-1">
                                        <label for="address"
                                            class="block text-sm font-medium leading-6 text-gray-900">Dirección inicial
                                            sucursal (*)</label>
                                        <div class="mt-2">
                                            <input 
                                            
                                            type="text" wire:model.live="address" id="address" x-bind:disabled="coordSelect !== 'editPoint'"
                                                autocomplete="address" placeholder="Av. Rivadavia N°1234"
                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                        </div>
                                    </div>

                                    <div class="lg:col-span-1">
                                        <label for="coordSelect"
                                            class="block text-sm font-medium leading-6 text-gray-900">Selecciona
                                            sucursal para coordenadas iniciales</label>
                                        <div class="mt-2">
                                            <select id="coordSelect" wire:model.live="coordSelect" x-model="coordSelect"
                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                                <option value="">Seleccione una sucursal</option>
                                                @foreach ($branches as $branch)
                                                    <option
                                                        value="{{ $branch['latitude'] }},{{ $branch['longitude'] }},{{ $branch['address'] }}">
                                                        {{ $branch['name'] }}
                                                    </option>
                                                @endforeach
                                                <option value="editPoint" @click="doSomething()">Ubicacion personalizada</option>
                                            </select>


                                        </div>
                                        @error('coordSelect')
                                            <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    @error('address')
                                        <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                    @enderror
                                </div>

                              

                                <input type="hidden" wire:model="start_lat" id="latitude">
                                <input type="hidden" wire:model="start_long" id="longitude">


                                <div class="col-span-full">
                                    <div id="map" class="shadow-sm rounded-lg w-full h-96 object-cover"
                                        wire:ignore></div>
                                </div>


                            </div>
                        </div>
                        @foreach ($errors->all() as $error)
                            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative"
                                role="alert">
                                <strong class="font-bold">Error!</strong>
                                <span class="block sm:inline">{{ $error }}</span>
                            </div>
                        @endforeach

                    </div> 
                      
                    --}}




                 
                    <livewire:components.maps.google-map-form-field-component
                     :selectField="true"
                     :selectElements="$branches" 
                     :latitude="$start_lat"
                     :longitude="$start_long"
                     :preselect="true"
                     :address="$address"
                    />
                                            


                </div>





            <div class="flex items-center justify-end gap-x-2  px-4 py-1 sm:px-8">
                        <button wire:click="update()"
                            class="rounded-md bg-indigo-600 px-3 py-1 font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 text-sm focus-visible:outline-indigo-600">Actualizar</button>

            </div>


        </main>
        {{-- @push('scripts')
        <script data-navigate-once>

document.addEventListener('alpine:init', () => {
console.log('inicio');

function doSomething(e) {
    console.log('click');
}
})
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
                            lat: initialLat,
                            lng: initialLng
                        },
                        title: "Ubicación seleccionada",
                        //gmpDraggable: true //Habilitar arrastre
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



                        // if($wire.$get('coorSelect') == 'editPoint'){
                        //     Livewire.dispatch('updateAddress', {
                        //     address: input.value
                        // });


                        // }
                    });




                    // Livewire.on('updateLatLong', (event) => {
                    //     const lat = parseFloat(event.lat);
                    //     const lng = parseFloat(event.lng);
                    //     map.setCenter({
                    //         lat: lat,
                    //         lng: lng
                    //     });
                    //     marker.position = {
                    //         lat: lat,
                    //         lng: lng
                    //     };
                    // });


                    Livewire.on('updateLatLong', (event) => {
                        const lat = event.lat;
                        const lng = event.lng;


                        const position = new google.maps.LatLng(lat, lng);
                        marker.position = position;
                        map.setCenter(position);
                    });





                    Livewire.on('editPoint', (event) => {
                        let alpineComponent = document.querySelector('#address');


                        if (event.status) {


                            marker.gmpDraggable = true;

                        } else {

                            input.disabled = true;
                            
                            marker.gmpDraggable = false;

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
                    });
                }



                initMap();
            });
        </script>
    @endpush --}}
    </div>


</div>
