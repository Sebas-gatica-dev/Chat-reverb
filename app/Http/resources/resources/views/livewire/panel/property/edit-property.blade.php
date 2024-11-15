<div>
    <header class="bg-white shadow">
        <div class="mx-auto max-w-screen-2xl px-4 py-6 sm:px-6 lg:px-8">
            <div class="md:flex md:items-center md:justify-between">
                <div class="min-w-0 flex-1">
                    <h1 class="text-2xl font-bold tracking-tight text-gray-900">Editar propiedad a {{ $customer->name }}
                    </h1>
                </div>
                <div class="mt-4 flex md:ml-4 md:mt-0">
                    <a wire:navigate href="{{ route('panel.customers.list') }}"
                        class="inline-flex items-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">Volver</a>

                    {{-- <button type="button" class="ml-3 inline-flex items-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Agregar cliente</button> --}}
                </div>
            </div>
        </div>


    </header>

    <main>
        <div class="mx-auto max-w-screen-2xl py-6 sm:px-6 lg:px-8">
            <div class="mt-8 flow-root">

                <div class="space-y-10 divide-y divide-gray-900/10">


                    @if(Gate::allows('access-function','customer-edit'))
                    <div class="space-y-10 divide-y divide-gray-900/10">
                        <div class="grid grid-cols-1 gap-x-8 gap-y-8 md:grid-cols-4">
                            <div class="px-4 sm:px-0">
                                <h2 class="text-base font-semibold leading-7 text-gray-900">Información principal</h2>
                                <p class="mt-1 text-sm leading-6 text-gray-600">Ingresa los datos basicos del cliente
                                    para
                                    poder tener su informacion en el sistema.
                            </div>

                            <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl md:col-span-3">
                                <div class="px-4 py-6 sm:p-8">

                                   
                                    <div class="grid w-full grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-9">

                                        <div class="sm:col-span-3">
                                            <label for="name"
                                                class="block text-sm font-medium leading-6 text-gray-900">Nombre</label>
                                            <div class="mt-2">
                                                <input type="text" wire:model="name" id="name"
                                                    autocomplete="given-name" placeholder="Juan"
                                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                            </div>
                                            @error('name')
                                                <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="sm:col-span-3">
                                            <label for="surname"
                                                class="block text-sm font-medium leading-6 text-gray-900">Apellido</label>
                                            <div class="mt-2">
                                                <input type="text" wire:model="surname" id="surname"
                                                    autocomplete="surname" placeholder="Perez"
                                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                            </div>
                                            @error('surname')
                                                <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="sm:col-span-3">
                                            <label for="business_name"
                                                class="block text-sm font-medium leading-6 text-gray-900">Empresa</label>
                                            <div class="mt-2">
                                                <input type="text" wire:model="business_name" id="business_name"
                                                    autocomplete="business_name" placeholder="Empresa S.A."
                                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                            </div>
                                            @error('business_name')
                                                <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                            @enderror
                                        </div>


                                        <div class="sm:col-span-3">
                                            <label for="email"
                                                class="block text-sm font-medium leading-6 text-gray-900">Correo
                                                electrónico</label>
                                            <div class="mt-2">
                                                <input id="email" wire:model="email" type="email"
                                                    autocomplete="email" placeholder="nombre@gmail.com"
                                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                            </div>
                                            @error('email')
                                                <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                            @enderror
                                        </div>



                                        <div class="sm:col-span-2">
                                            <label for="gender"
                                                class="block text-sm font-medium leading-6 text-gray-900">Genero</label>
                                            <div class="mt-2">
                                                <select id="gender" wire:model="gender" autocomplete="gender"
                                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                                    <option value="">Seleccione un genero</option>
                                                    <option value="male">Masculino</option>
                                                    <option value="female">Femenino</option>
                                                </select>
                                            </div>

                                            @error('gender')
                                                <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                            @enderror
                                        </div>





                                        <div class="sm:col-span-2">
                                            <label for="source"
                                                class="block text-sm font-medium leading-6 text-gray-900">Fuente</label>
                                            <div class="mt-2">
                                                <select id="source" wire:model="source" autocomplete="source"
                                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                                    <option value="">Seleccione una fuente</option>
                                                    @foreach ($sources as $source)
                                                        <option value="{{ $source->value }}">{{ $source->getName()}}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            @error('source')
                                                <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                            @enderror
                                        </div>


                                        <div class="sm:col-span-2">
                                            <label for="customer_createdby"
                                                class="block text-sm font-medium leading-6 text-gray-900">Cerrado
                                                por</label>
                                            <div class="mt-2">
                                                {{-- @dump($customer_createdby) --}}
                                                <select id="customer_createdby" wire:model="customer_createdby"
                                                    autocomplete="customer_createdby"
                                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                                    <option value="">Seleccione un usuario</option>

                                                    @foreach ($users as $user)
                                                        <option value="{{ $user->id }}">{{ $user->name }}
                                                        </option>
                                                    @endforeach

                                                </select>
                                            </div>

                                            @error('customer_createdby')
                                                <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                            @enderror
                                        </div>


                                    </div>

                                </div>

                            </div>
                        </div>



                    </div>
                    @endif


                    @if(Gate::allows('access-function','property-edit'))

                    <div class="grid grid-cols-1 gap-x-8 gap-y-8 pt-10 md:grid-cols-4">
                        <div class="px-4 sm:px-0">
                            <h2 class="text-base font-semibold leading-7 text-gray-900">Ubicación</h2>
                            <p class="mt-1 text-sm leading-6 text-gray-600">Ingresa los datos de la ubicación para
                                poder tener su informacion en el sistema.
                        </div>

                        <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl md:col-span-3">
                            <div class="px-4 py-6 sm:p-8">
                                <div class="grid w-full grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-12">


                                    <div class="sm:col-span-6">
                                        <label for="address"
                                            class="block text-sm font-medium leading-6 text-gray-900">Dirección</label>
                                        <div class="mt-2">
                                            <input type="text" wire:model="address" id="address"
                                                autocomplete="address" placeholder="Av.Rivadavia N°1234"
                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                        </div>

                                        @error('address')
                                            <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                        @enderror


                                    </div>

                                    <input type="hidden" wire:model="latitude" id="latitude">
                                    <input type="hidden" wire:model="longitude" id="longitude">



                                    <div class="sm:col-span-6">
                                        <label for="between_streets"
                                            class="block text-sm font-medium leading-6 text-gray-900">Entrecalles</label>
                                        <div class="mt-2">
                                            <input type="text" wire:model="between_streets" id="between_streets"
                                                autocomplete="between_streets" placeholder="Entre Calle 1 y Calle 2"
                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                        </div>

                                        @error('between_streets')
                                            <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                        @enderror
                                    </div>


                                    <div class="sm:col-span-6">
                                        <label for="floor"
                                            class="block text-sm font-medium leading-6 text-gray-900">Piso</label>
                                        <div class="mt-2">
                                            <input type="text" wire:model="floor" id="floor"
                                                autocomplete="floor" placeholder="1"
                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                        </div>

                                        @error('floor')
                                            <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="sm:col-span-6">
                                        <label for="apartament"
                                            class="block text-sm font-medium leading-6 text-gray-900">Departamento</label>
                                        <div class="mt-2">
                                            <input type="text" wire:model="apartment" id="apartament"
                                                autocomplete="apartament" placeholder="B"
                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                        </div>

                                        @error('apartment')
                                            <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="sm:col-span-3">
                                        <label for="province_id"
                                            class="block text-sm font-medium leading-6 text-gray-900">Provincia</label>
                                        <div class="mt-2">
                                            <select id="province_id" wire:model.live="province_id"
                                                autocomplete="province_id"
                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                                <option value="">Seleccione una provincia</option>
                                                @foreach ($provinces as $province)
                                                    <option value="{{ $province->province->id }}">{{ $province->province->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        @error('province_id')
                                            <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                        @enderror
                                    </div>



                                    <div class="sm:col-span-3">
                                        <label for="city_id"
                                            class="block text-sm font-medium leading-6 text-gray-900">Ciudad</label>
                                        <div class="mt-2">
                                            <select id="city_id" wire:model.live="city_id" autocomplete="city_id"
                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                                <option value="">Seleccione una ciudad</option>
                                                @foreach ($cities as $city)
                                                    <option value="{{ $city->city->id }}">{{ $city->city->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        @error('city_id')
                                            <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                        @enderror


                                    </div>


                                    <div class="sm:col-span-3">
                                        <label for="neighborhood_id"
                                            class="block text-sm font-medium leading-6 text-gray-900">Barrio</label>
                                        <div class="mt-2">
                                            <select id="neighborhood_id" wire:model.live="neighborhood_id"
                                                autocomplete="neighborhood_id"
                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                                <option value="">Seleccione un barrio</option>
                                                @foreach ($neighborhoods as $neighborhood)
                                                    <option value="{{ $neighborhood->neighborhood->id }}">{{ $neighborhood->neighborhood->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        @error('neighborhood_id')
                                            <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="sm:col-span-3">
                                        <label for="subzone_id"
                                            class="block text-sm font-medium leading-6 text-gray-900">Subzona</label>
                                        <div class="mt-2">
                                            <select id="subzone_id" wire:model.live="subzone_id"
                                                autocomplete="subzone_id"
                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6"
                                                @if (empty($subzones)) disabled @endif>
                                                <option value="">Seleccione una subzona</option>
                                                @foreach ($subzones as $subzone)
                                                    <option value="{{ $subzone->subzone->id }}">{{ $subzone->subzone->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>


                                    </div>

                                    <div class="col-span-full">
                                        {{-- <div id="map" class="shadow-sm rounded-lg w-full h-96 object-cover"
                                            wire:ignore></div> --}}
                                        
                                            <livewire:components.maps.google-map-form-field-component
                                            :latitude="$latitude"
                                            :longitude="$longitude"
                                            :input_id="'address'"
                        
                                           />
                                    
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-x-8 gap-y-8 pt-10 lg:grid-cols-4">
                        <div class="px-4 sm:px-0">
                            <h2 class="text-base font-semibold leading-7 text-gray-900">Información de la propiedad
                            </h2>
                            <p class="mt-1 text-sm leading-6 text-gray-600">Ingresa los datos de la propiedad para
                                poder tener su informacion en el sistema.
                        </div>

                        <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl md:col-span-3">
                            <div class="px-4 py-6 sm:p-8">
                                <div class="grid w-full grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-12 mb-5">



                                    <div class="sm:col-span-4">
                                        <label for="property_name"
                                            class="block text-sm font-medium leading-6 text-gray-900">Nombre de la
                                            propiedad</label>
                                        <div class="mt-2">
                                            <input type="text" wire:model="property_name" id="property_name"
                                                autocomplete="property_name"
                                                placeholder="Local 37, casa del hermano, etc"
                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                        </div>
                                        @error('property_name')
                                            <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                        @enderror
                                    </div>


                                    <div class="sm:col-span-4">
                                        <label for="documentation"
                                            class="block text-sm font-medium leading-6 text-gray-900">CUIT/DNI</label>
                                        <div class="mt-2">
                                            <input type="text" wire:model="documentation" id="documentation"
                                                autocomplete="documentation" placeholder="20-12345678-9"
                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                        </div>
                                        @error('documentation')
                                            <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="sm:col-span-4">
                                        <label for="property_type"
                                            class="block text-sm font-medium leading-6 text-gray-900">Tipo de
                                            propiedad</label>
                                        <div class="mt-2">
                                            <select id="property_type" wire:model="property_type"
                                                autocomplete="property_type"
                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                                <option value="">Seleccione un tipo de propiedad</option>
                                                @foreach ($propertiesTypes as $propertyType)
                                                    <option value="{{ $propertyType->id }}">{{ $propertyType->name }}
                                                    </option>
                                                @endforeach


                                            </select>
                                        </div>
                                        @error('property_type')
                                            <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="sm:col-span-4">
                                        <label for="frequency"
                                            class="block text-sm font-medium leading-6 text-gray-900">Frecuencia</label>
                                        <div class="mt-2">
                                            <select id="frequency" wire:model="frequency" autocomplete="frequency"
                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                                <option value="">Seleccione una frecuencia</option>
                                                @foreach ($frequencies as $frequency)
                                                    <option value="{{ $frequency->value }}">
                                                        {{ \App\Enums\FrequencyEnum::getFrequency($frequency) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('frequency')
                                            <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                        @enderror
                                    </div>


                                    <div class="sm:col-span-4">
                                        <label for="branch_id"
                                            class="block text-sm font-medium leading-6 text-gray-900">Sucursal</label>
                                        <div class="mt-2">
                                            <select id="branch_id" wire:model="branch_id" autocomplete="branch_id"
                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                                <option value="">Seleccione una sucursal</option>
                                                @foreach ($branches as $branch)
                                                    <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('branch_id')
                                            <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="sm:col-span-4">
                                        <label for="created_by"
                                            class="block text-sm font-medium leading-6 text-gray-900">Cerrado
                                            por</label>
                                        <div class="mt-2">
                                            <select id="created_by" wire:model="created_by" autocomplete="created_by"
                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                                <option value="">Seleccione un usuario</option>
                                                @foreach ($users as $user)
                                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('created_by')
                                            <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                        @enderror
                                    </div>


                                    @can('access-function', 'property-add-photo')
                                    <div class="col-span-full">
                                        <label for="files"
                                            class="block text-sm font-medium leading-6 text-gray-900">Archivo</label>
                                            <livewire:components.upload-file
                                                :multiple="false" 
                                                :types="['image']"
                                                :existingFiles="$photo"
                                                :name="'property-photo'"
                                            />
                                    </div>
                                    @endcan

                                    <hr class="sm:col-span-full">

                                    <div class="col-span-full">
                                        <livewire:components.add-date-availability-general  :selectedValues="$availabilities" />
                                    </div>





                                </div>

                                {{-- @foreach ($errors->all() as $error)
                                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 mt-1 rounded relative"
                                    role="alert">
                                    <strong class="font-bold">Error!</strong>
                                    <span class="block sm:inline">{{ $error }}</span>
                                </div>

                            @endforeach --}}
                            </div>

                        </div>


                    </div>

                    @endif
                </div>

                

                <div class="flex items-center justify-end py-4">

                    <button wire:click="save" type="button"
                        class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Guardar</button>

                </div>

                {{-- @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach --}}

            </div>
        </div>
    </main>
    {{-- @push('scripts')
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
