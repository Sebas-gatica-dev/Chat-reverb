<div>
    <header class="bg-white shadow">
        <div class="mx-auto max-w-screen-2xl px-4 py-6 sm:px-6 lg:px-8">
            <div class="md:flex md:items-center md:justify-between">
                <div class="min-w-0 flex-1">
                    <h1 class="text-2xl font-bold tracking-tight text-gray-900">Editar Lead</h1>
                </div>
                <div class="mt-4 flex md:ml-4 md:mt-0">
                    <a wire:navigate href="{{ route('panel.leads.list') }}"
                        class="inline-flex items-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                        Volver
                    </a>
                </div>
            </div>
        </div>
    </header>

    <main>
        <div class="mx-auto max-w-screen-2xl py-6 sm:px-6 lg:px-8">
            <div class="mt-8 flow-root">
                <div class="space-y-10 divide-y divide-gray-900/10">
                    <div class="grid grid-cols-1 gap-x-8 gap-y-8 md:grid-cols-4">
                        <div class="px-4 sm:px-0">
                            <h2 class="text-base font-semibold leading-7 text-gray-900">Información del Lead</h2>
                            <p class="mt-1 text-sm leading-6 text-gray-600">
                                Actualiza los datos del lead para mantener su información al día en el sistema.
                            </p>
                        </div>

                        <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl md:col-span-3">
                            <div class="px-4 py-6 sm:p-8">
                                <div class="grid w-full grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-9">
                                    <!-- Nombre -->
                                    <div class="sm:col-span-3">
                                        <label for="name" class="block text-sm font-medium leading-6 text-gray-900">
                                            Nombre
                                        </label>
                                        <div class="mt-2">
                                            <input type="text" wire:model="name" id="name"
                                                autocomplete="given-name" placeholder="Juan"
                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm
                                                ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2
                                                focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                        </div>
                                        @error('name')
                                            <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <!-- Apellido -->
                                    <div class="sm:col-span-3">
                                        <label for="surname" class="block text-sm font-medium leading-6 text-gray-900">
                                            Apellido
                                        </label>
                                        <div class="mt-2">
                                            <input type="text" wire:model="surname" id="surname"
                                                autocomplete="family-name" placeholder="Perez"
                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm
                                                ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2
                                                focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                        </div>
                                        @error('surname')
                                            <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                        @enderror
                                    </div>


                                    {{-- Fecha --}}
                                    <div class="sm:col-span-3">
                                        <label for="date"
                                            class="block text-sm font-medium leading-6 text-gray-900">Fecha</label>
                                        <div class="mt-2">
                                            <input type="date" wire:model="date" id="date"
                                                autocomplete="off" placeholder="dd/mm/yyyy"
                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 text-sm  sm:leading-6">
                                        </div>
                                        @error('date')
                                            <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                        @enderror
                                    </div>


                
                                    <!-- Hora -->
                                    <div class="sm:col-span-3">
                                        <label for="time"
                                            class="block text-sm font-medium leading-6 text-gray-900">Hora</label>
                                        <div class="mt-2">
                                            <input type="time" wire:model="time" id="time" 
                                                autocomplete="off" placeholder="--:--"
                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 text-sm  sm:leading-6">
                                        </div>
                                        @error('time')
                                            <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                        @enderror
                                    </div>




                                    <!-- Email -->
                                    <div class="sm:col-span-3">
                                        <label for="email" class="block text-sm font-medium leading-6 text-gray-900">
                                            Correo electrónico
                                        </label>
                                        <div class="mt-2">
                                            <input id="email" wire:model="email" type="email" autocomplete="email"
                                                placeholder="nombre@gmail.com"
                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm
                                                ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2
                                                focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                        </div>
                                        @error('email')
                                            <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <!-- Teléfono -->
                                    <div class="sm:col-span-3">
                                        <label for="phone" class="block text-sm font-medium leading-6 text-gray-900">
                                            Teléfono
                                        </label>
                                        <div class="mt-2">
                                            <input id="phone" wire:model="phone" type="text" autocomplete="tel"
                                                placeholder="123456789"
                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm
                                                ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2
                                                focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                        </div>
                                        @error('phone')
                                            <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <!-- Género -->
                                    <div class="sm:col-span-3">
                                        <label for="gender" class="block text-sm font-medium leading-6 text-gray-900">
                                            Género
                                        </label>
                                        <div class="mt-2">
                                            <select id="gender" wire:model="gender" autocomplete="gender"
                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm
                                                ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset
                                                focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                                <option value="">Seleccione un género</option>
                                                <option value="male">Masculino</option>
                                                <option value="female">Femenino</option>
                                            </select>
                                        </div>
                                        @error('gender')
                                            <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <!-- Fuente -->
                                    <div class="sm:col-span-3">
                                        <label for="source" class="block text-sm font-medium leading-6 text-gray-900">
                                            Fuente
                                        </label>
                                        <div class="mt-2">
                                            <select id="source" wire:model="source" autocomplete="source"
                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm
                                                ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset
                                                focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                                <option value="">Seleccione una fuente</option>
                                                @foreach ($sources as $sourceOption)
                                                    <option value="{{ $sourceOption->value }}">
                                                        {{ $sourceOption->value }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('source')
                                            <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <!-- Tipo de Contacto -->
                                    <div class="sm:col-span-3">
                                        <label for="type_contact"
                                            class="block text-sm font-medium leading-6 text-gray-900">
                                            Tipo de Contacto
                                        </label>
                                        <div class="mt-2">
                                            <select id="type_contact" wire:model="type_contact"
                                                autocomplete="type_contact"
                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm
                                                ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset
                                                focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                                <option value="">Seleccione un tipo de contacto</option>
                                                @foreach ($type_contacts as $type)
                                                    <option value="{{ $type->value }}">{{ $type->value }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('type_contact')
                                            <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    {{-- <!-- Estado -->
                                    <div class="sm:col-span-3">
                                        <label for="status" class="block text-sm font-medium leading-6 text-gray-900">
                                            Estado
                                        </label>
                                        <div class="mt-2">
                                            <select id="status" wire:model="status" autocomplete="status"
                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm
                                                ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset
                                                focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                                <option value="">Seleccione un estado</option>
                                                @foreach ($statuses as $statusOption)
                                                    <option value="{{ $statusOption->value }}">{{ $statusOption->value }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('status')
                                            <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                        @enderror
                                    </div> --}}

                                    <!-- Tipo de Propiedad -->
                                    <div class="sm:col-span-3">
                                        <label for="property_type_id"
                                            class="block text-sm font-medium leading-6 text-gray-900">
                                            Tipo de Propiedad
                                        </label>
                                        <div class="mt-2">
                                            <select id="property_type_id" wire:model="property_type_id"
                                                autocomplete="property_type_id"
                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm
                                                ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset
                                                focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                                <option value="">Seleccione un tipo de propiedad</option>
                                                @foreach ($property_types as $property_type)
                                                    <option value="{{ $property_type->id }}">
                                                        {{ $property_type->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('property_type_id')
                                            <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <!-- Servicio -->
                                    <div class="sm:col-span-3">
                                        <label for="service_id"
                                            class="block text-sm font-medium leading-6 text-gray-900">
                                            Servicio
                                        </label>
                                        <div class="mt-2">
                                            <select id="service_id" wire:model="service_id" autocomplete="service_id"
                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm
                                                ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset
                                                focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                                <option value="">Seleccione un servicio</option>
                                                @foreach ($services as $service)
                                                    <option value="{{ $service->id }}">{{ $service->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('service_id')
                                            <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <!-- Sucursal -->
                                    <div class="sm:col-span-3">
                                        <label for="branch_id"
                                            class="block text-sm font-medium leading-6 text-gray-900">
                                            Sucursal
                                        </label>
                                        <div class="mt-2">
                                            <select id="branch_id" wire:model="branch_id" autocomplete="branch_id"
                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm
                                                ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset
                                                focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
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

                                    <!-- Creado por -->
                                    <div class="sm:col-span-3">
                                        <label for="created_by"
                                            class="block text-sm font-medium leading-6 text-gray-900">
                                            Creado por
                                        </label>
                                        <div class="mt-2">
                                            <select id="created_by" wire:model="created_by" autocomplete="created_by"
                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm
                                                ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset
                                                focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
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

                                    <!-- Descripción -->
                                    <div class="sm:col-span-9">
                                        <label for="description"
                                            class="block text-sm font-medium leading-6 text-gray-900">
                                            Descripción
                                        </label>
                                        <div class="mt-2">
                                            <textarea id="description" wire:model="description" rows="3"
                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm
                                                ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2
                                                focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
                                        </div>
                                        @error('description')
                                            <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <!-- Provincia -->
                                    <div class="sm:col-span-3">
                                        <label for="province_id"
                                            class="block text-sm font-medium leading-6 text-gray-900">
                                            Provincia
                                        </label>
                                        <div class="mt-2">
                                            <select id="province_id" wire:model.live="province_id"
                                                autocomplete="province_id"
                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm
                                                ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset
                                                focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
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

                                    <!-- Ciudad -->
                                    <div class="sm:col-span-3">
                                        <label for="city_id"
                                            class="block text-sm font-medium leading-6 text-gray-900">
                                            Ciudad
                                        </label>
                                        <div class="mt-2">
                                            <select id="city_id" wire:model.live="city_id" autocomplete="city_id"
                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm
                                                ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset
                                                focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                                <option value="">Seleccione una ciudad</option>
                                                @foreach ($cities as $city)
                                                    <option value="{{ $city->city->id }}">{{ $city->city->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('city_id')
                                            <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <!-- Barrio -->
                                    <div class="sm:col-span-3">
                                        <label for="neighborhood_id"
                                            class="block text-sm font-medium leading-6 text-gray-900">
                                            Barrio
                                        </label>
                                        <div class="mt-2">
                                            <select id="neighborhood_id" wire:model.live="neighborhood_id"
                                                autocomplete="neighborhood_id"
                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm
                                                ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset
                                                focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                                <option value="">Seleccione un barrio</option>
                                                @foreach ($neighborhoods as $neighborhood)
                                                    <option value="{{ $neighborhood->neighborhood->id }}">
                                                        {{ $neighborhood->neighborhood->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('neighborhood_id')
                                            <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <!-- Subzona -->
                                    <div class="sm:col-span-3">
                                        <label for="subzone_id"
                                            class="block text-sm font-medium leading-6 text-gray-900">
                                            Subzona
                                        </label>
                                        <div class="mt-2">
                                            <select id="subzone_id" wire:model.live="subzone_id"
                                                autocomplete="subzone_id"
                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm
                                                ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset
                                                focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6"
                                                @if (empty($subzones)) disabled @endif>
                                                <option value="">Seleccione una subzona</option>
                                                @foreach ($subzones as $subzone)
                                                    <option value="{{ $subzone->subzone->id }}">
                                                        {{ $subzone->subzone->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div
                                class="flex items-center justify-end gap-x-6 border-t border-gray-900/10 px-4 py-4 sm:px-8">
                                <button wire:click="update"
                                    class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm
                                    hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2
                                    focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                                    Actualizar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
