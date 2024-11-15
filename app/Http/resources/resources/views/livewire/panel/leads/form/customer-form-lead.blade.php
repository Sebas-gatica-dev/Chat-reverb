<div>
    <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl md:col-span-3">
        <div class="px-4 py-6 sm:p-8">
            <div class="grid w-full grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-9">
            

                {{-- Fecha --}}
                <div class="sm:col-span-3 col-span-6">
                    <x-input-real-time model="data.date_lead" label="Fecha" type="date" />
                </div>

                <!-- Hora -->
                <div class="sm:col-span-3 col-span-3">
                    <x-input-real-time model="data.time_lead" label="Hora" type="time" />
                </div>

                <!-- Tipo de contacto -->
                <div class="sm:col-span-3 col-span-9">
                    <livewire:components.select-general :values="$type_contacts" :label="'Tipo de contacto'" :name="'data.type_contact'"
                        :selectedValue="$selectedTypeContact" :searchEnabled="false" :live="true" :defaultOption="'Selecciona tipo de contacto'" :idComponent="$idModel" />
                        @error('data.type_contact')
                        <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Separador --}}
                <div class="border-t border-gray-900/10 py-4 col-span-9"> </div>

                <!-- Nombre -->
                <div class="sm:col-span-3 col-span-5">
                    <x-input-real-time model="data.name" label="Nombre" placeholder="Juan" />
                </div>

                <!-- Apellido -->
                <div class="sm:col-span-3 col-span-4">
                    <x-input-real-time model="data.surname" label="Apellido" placeholder="Pérez" />
                </div>

                <div class="sm:col-span-3 col-span-9">
                    <x-input-real-time model="data.business_name" label="Nombre de la empresa"
                        placeholder="Google S.A" />
                </div>

                <!-- Género -->
                <div class="sm:col-span-3 col-span-9">
                    <livewire:components.select-general :values="$genders" :label="'Genero'" :name="'data.gender'"
                        :selectedValue="$selectedGender" :searchEnabled="false" :live="true" :defaultOption="'Selecciona un género'"
                        :idComponent="$idModel" />
                    @error('data.gender')
                        <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                    @enderror
                </div>



                <!-- Email -->
                <div class="sm:col-span-3 {{ !isset($this->data['id']) ? 'col-span-4' : 'col-span-9' }}">
                    <x-input-real-time model="data.email" label="Email" placeholder="nombre@gmail.com"
                        type="email" />
                </div>

                @if(!isset($this->data['id']))
                <!-- Teléfono -->
                <div class="sm:col-span-3 col-span-5">
                    <x-input-real-time model="data.phone" label="Teléfono" placeholder="11-1234-5678" type="text" />
                </div>
                @endif

                <!-- Fuente -->
                <div class="sm:col-span-3 col-span-9">
                    <livewire:components.select-general :values="$sources" :label="'Fuente'" :name="'data.source'"
                        :selectedValue="$selectedSource" :searchEnabled="false" :live="true" :defaultOption="'Selecciona una fuente'"
                        :idComponent="$idModel" />
                    @error('data.source')
                        <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                    @enderror
                </div>



                <!-- Servicios -->
                <div class="sm:col-span-3 col-span-9">
                    <livewire:components.select-general :values="$services" :label="'Servicios'" :name="'data.service_id'"
                        :selectedValue="$selectedService" :searchEnabled="false" :live="true" :defaultOption="'Selecciona servicio'"
                        :idComponent="$idModel" />
                        @error('data.service_id')
                        <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Creado por -->
                <div class="sm:col-span-3 col-span-9">
                    <livewire:components.select-general :values="$users" :label="'Creado por'" :name="'data.created_by'"
                        :selectedValue="$selectedUser" :searchEnabled="false" :live="true" :defaultOption="'Selecciona usuario'"
                        :idComponent="$idModel" />
                        @error('data.created_by')
                        <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                    @enderror
                </div>


                <!-- Descripción -->
                <div class="col-span-9">
                    <x-input-real-time model="data.lead_first_activity.comment" label="Comentario (*)" type="textarea"
                        placeholder="Escribe un comentario para la visita" />
                </div>



            </div>
        </div>


        @if (!isset($data['id']))
            <div class="flex items-center justify-end gap-x-6 border-t border-gray-900/10 px-4 py-4 sm:px-8">
                <span wire:click="saveFormNewLead"
                    class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm
                hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2
                focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Crear
                    un nuevo lead</span>
            </div>
        @endif
    </div>
</div>
