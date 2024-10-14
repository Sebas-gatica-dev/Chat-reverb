<div>
    <header class="bg-white shadow">
        <div class="mx-auto max-w-screen-2xl px-4 py-6 sm:px-6 lg:px-8">
            <div class="md:flex md:items-center md:justify-between">
                <div class="min-w-0 flex-1">
                    <h1 class="text-2xl font-bold tracking-tight text-gray-900">Agregar propiedad a {{ $customer->name }}
                    </h1>
                </div>
                <div class="mt-4 flex md:ml-4 md:mt-0">
                  
                    <a wire:navigate href="{{ route('panel.customers.show', $customer->id) }}"
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


                    <div class="grid grid-cols-1 gap-x-8 gap-y-8 pt-10 lg:grid-cols-4">
                        <div class="px-4 sm:px-0">
                            <h2 class="text-base font-semibold leading-7 text-gray-900">Información de propiedad</h2>
                            <p class="mt-1 text-sm leading-6 text-gray-600">Use a permanent address where you can
                                receive mail.</p>
                        </div>

                        <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl md:col-span-3">
                            <div class="px-4 py-6 sm:p-8">
                                <div class="grid w-full grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-12">



                                    <div class="sm:col-span-4">
                                        <label for="property_name"
                                            class="block text-sm font-medium leading-6 text-gray-900">Nombre de la
                                            propiedad (*)</label>
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
                                            propiedad (*)</label>
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
                                            class="block text-sm font-medium leading-6 text-gray-900">Frecuencia
                                            (*)</label>
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
                                            class="block text-sm font-medium leading-6 text-gray-900">Sucursal
                                            (*)</label>
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
                                            por (*)</label>
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
                                                :name="'property-photo'"
                                            />
                                        </div>
                                    @endcan

                                    <hr class="sm:col-span-full">

                                    <div class="col-span-full">
                                        <livewire:components.add-date-availability-general  />
                                    </div>



                                  @can('access-function', 'property-add-phone')

                                    <hr class="sm:col-span-full">

                                    <div class="sm:col-span-3">
                                        <label for="number"
                                            class="block text-sm font-medium leading-6 text-gray-900">Teléfono del
                                            cliente</label>
                                        <div class="mt-2">
                                            <input id="number" wire:model="number" type="text"
                                                autocomplete="number" placeholder="(011) 1234-5678"
                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                        </div>

                                        @error('number')
                                            <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="sm:col-span-3">
                                        <label for="phoneModel"
                                            class="block text-sm font-medium leading-6 text-gray-900">Vincular
                                            con</label>
                                        <div class="mt-2">
                                            <select id="phoneModel" wire:model="phoneModel" autocomplete="phoneModel"
                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                                <option value="">Seleccione una opción</option>
                                                <option value="customer">Cliente</option>
                                                <option value="property">Propiedad</option>
                                            </select>
                                        </div>
                                        @error('phoneModel')
                                            <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="sm:col-span-3">
                                        <label for="tagNumber"
                                            class="block text-sm font-medium leading-6 text-gray-900">Etiqueta del
                                            contacto</label>
                                        <div class="mt-2">
                                            <input id="tagNumber" wire:model="tagNumber" type="text"
                                                autocomplete="tagNumber" placeholder="Personal, Trabajo, etc"
                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                        </div>
                                        @error('tagNumber')
                                            <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                        @enderror
                                    </div>



                                    <div class="sm:col-span-1 flex items-center">
                                        <fieldset>

                                            {{-- <p class="mt-1 text-sm leading-6 text-gray-600">These are delivered via SMS to your mobile phone.</p> --}}
                                            <div class="mt-1 space-y-1">
                                                <div class="flex items-center gap-x-3">
                                                    <input id="typeNumber" wire:model="typeNumber" type="radio"
                                                        value="0"
                                                        class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600">
                                                    <label for="typeNumber"
                                                        class="block text-sm font-medium leading-6 text-gray-900">Celular</label>
                                                </div>
                                                <div class="flex items-center gap-x-3">
                                                    <input id="typeNumber" wire:model="typeNumber" type="radio"
                                                        value="1"
                                                        class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600">
                                                    <label for="typeNumber"
                                                        class="block text-sm font-medium leading-6 text-gray-900">Teléfono</label>
                                                </div>

                                            </div>

                                            @error('typeNumber')
                                                <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                            @enderror
                                        </fieldset>
                                    </div>

                                    <div class="sm:col-span-2 flex items-center justify-center">

                                        <button type="button" wire:click="addPhone"
                                            class="inline-flex items-center gap-x-1.5 rounded bg-gray-700 px-2 py-1 text-xs font-semibold text-white shadow-sm hover:bg-gray-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-700">
                                            Agregar
                                            <svg class="-mr-0.5 h-5 w-5" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                                <path fill-rule="evenodd"
                                                    d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm.75-11.25a.75.75 0 0 0-1.5 0v2.5h-2.5a.75.75 0 0 0 0 1.5h2.5v2.5a.75.75 0 0 0 1.5 0v-2.5h2.5a.75.75 0 0 0 0-1.5h-2.5v-2.5Z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </button>

                                    </div>

                                    @endcan

                                </div>


                                @can('access-function', 'property-add-phone')
 

                                <ul class="grid grid-cols-1 gap-1 items-center justify-between"
                                    wire:sortable="updateTaskOrder" x-data="{ isPressed: false }">
                                    @foreach ($phones as $phone)
                                        <li class="flex items-center w-full mt-4"
                                            wire:key="phone-{{ $phone['id'] }}"
                                            wire:sortable.item="{{ $phone['id'] }}">
                                            <div class="py-3 px-3 flex items-center bg-gray-50 rounded-md w-full justify-between"
                                                @mousedown="isPressed = true" @mouseleave="isPressed = false"
                                                @mouseup="isPressed = false" wire:sortable.handle>
                                                <div class="flex items-center gap-x-2 cursor-move w-full">
                                                    <p class="text-sm font-semibold leading-6 text-gray-900">
                                                        {{ $phone['number'] }}</p>
                                                    @if ($loop->index == 0)
                                                        <p
                                                            class="rounded-md whitespace-nowrap mt-0.5 px-1.5 py-0.5 text-xs font-medium ring-1 ring-inset text-red-700 bg-red-50 ring-red-600/20">
                                                            Principal</p>
                                                    @endif
                                                    <p
                                                        class="rounded-md whitespace-nowrap mt-0.5 px-1.5 py-0.5 text-xs font-medium ring-1 ring-inset text-green-700 bg-green-50 ring-green-600/20">
                                                        {{ $phone['tag'] }}</p>
                                                    <p
                                                        class="rounded-md whitespace-nowrap mt-0.5 px-1.5 py-0.5 text-xs font-medium ring-1 ring-inset text-yellow-700 bg-yellow-50 ring-yellow-600/20">
                                                        {{ $phone['type'] == 0 ? 'Celular' : 'Fijo' }}</p>
                                                    <p
                                                        class="rounded-md whitespace-nowrap mt-0.5 px-1.5 py-0.5 text-xs font-medium ring-1 ring-inset text-indigo-700 bg-indigo-50 ring-indigo-600/20">
                                                        {{ $phone['model'] == 'customer' ? 'Cliente' : 'Propiedad' }}
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="relative inline-block z-40 select-none pointer-events-auto"
                                                x-data="{ open: false }">
                                                <button type="button" class="p-2.5 text-gray-500 hover:text-gray-900"
                                                    @click="open = !open">
                                                    <span class="sr-only">Open options</span>
                                                    <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"
                                                        x-show="!isPressed" aria-hidden="true">
                                                        <path
                                                            d="M10 3a1.5 1.5 0 110 3 1.5 1.5 0 010-3zM10 8.5a1.5 1.5 0 110 3 1.5 1.5 0 010-3zM11.5 15.5a1.5 1.5 0 10-3 0 1.5 1.5 0 003 0z" />
                                                    </svg>
                                                </button>
                                                <div class="absolute right-0 z-10 mt-2 w-32 origin-top-right top-6 rounded-md bg-white py-2 shadow-lg ring-1 ring-black/5 focus:outline-none font-bold select-none"
                                                    role="menu" aria-orientation="vertical"
                                                    aria-labelledby="options-menu-0-button" tabindex="-1"
                                                    @click.away="open = false" x-show="open" x-cloak
                                                    x-transition:enter="transition ease-out duration-100"
                                                    x-transition:enter-start="transform opacity-0 scale-95"
                                                    x-transition:enter-end="transform opacity-100 scale-100"
                                                    x-transition:leave="transition ease-in duration-75"
                                                    x-transition:leave-start="transform opacity-100 scale-100"
                                                    x-transition:leave-end="transform opacity-0 scale-95">
                                                    <a wire:click="removePhone({{ $phone['id'] }})"
                                                        class="block px-3 py-1 text-sm leading-6 text-gray-900">Eliminar</a>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>


                                @endcan

                          
                            </div>

                        </div>
                    </div>


                    <div class="grid grid-cols-1 gap-x-8 gap-y-8 pt-10 md:grid-cols-4">
                        <div class="px-4 sm:px-0">
                            <h2 class="text-base font-semibold leading-7 text-gray-900">Personal Information</h2>
                            <p class="mt-1 text-sm leading-6 text-gray-600">Use a permanent address where you can
                                receive mail.</p>
                        </div>

                        <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl md:col-span-3">
                            <div class="px-4 py-6 sm:p-8">
                                <div class="grid w-full grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-12">


                                    <div class="sm:col-span-6">
                                        <label for="address"
                                            class="block text-sm font-medium leading-6 text-gray-900">Dirección
                                            (*)</label>
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
                                            class="block text-sm font-medium leading-6 text-gray-900">Entrecalles
                                            (*)</label>
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
                                            class="block text-sm font-medium leading-6 text-gray-900">Provincia
                                            (*)</label>
                                        <div class="mt-2">
                                            <select id="province_id" wire:model.live="province_id"
                                                autocomplete="province_id"
                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                                <option value="">Seleccione una provincia</option>
                                                @foreach ($provinces as $province)
                                                    <option value="{{ $province->id }}">{{ $province->name }}
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
                                            class="block text-sm font-medium leading-6 text-gray-900">Ciudad
                                            (*)</label>
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
                                            class="block text-sm font-medium leading-6 text-gray-900">Barrio
                                            (*)</label>
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



                                            <livewire:components.maps.google-map-form-field-component :input_id="'address'"/>
                                    </div>


                                    {{-- @dump($latitude, $longitude) --}}


                                    <!-- Disponibilidad Horaria -->

                                    {{-- @foreach ($days as $dayEnum)

                                        <div class="col-span-full sm:col-span-3">
                                            <livewire:components.add-date-availability-general :model="$property ?? null" :dayOfWeek="App\Enums\AvailabilityDayEnums::getDays($dayEnum)" :wire:key="App\Enums\AvailabilityDayEnums::getDays($dayEnum)" />
                                        </div>

                                        @endforeach --}}





                                </div>
                            </div>
                            {{-- @foreach ($errors->all() as $error)
                                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative"
                                    role="alert">
                                    <strong class="font-bold">Error!</strong>
                                    <span class="block sm:inline">{{ $error }}</span>
                                </div>

                            @endforeach --}}
                            <div
                                class="flex items-center justify-end gap-x-6 border-t border-gray-900/10 px-4 py-4 sm:px-8">

                                <button wire:click="save" type="button"
                                    class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>

                            </div>
                        </div>
                    </div>


                </div>


            </div>
        </div>
    </main>

</div>
