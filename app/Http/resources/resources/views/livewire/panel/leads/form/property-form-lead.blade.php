<div>
    <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl md:col-span-3">
        <div class="px-4 py-6 sm:p-8">
            <div class="grid w-full grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-12">

                <div class="sm:col-span-4">
                    <x-input-real-time model="data.address" label="Dirección" placeholder="Av. Siempre Viva 123"
                        type="text" />
                </div>

                <input type="hidden" wire:model="data.latitude" id="latitude">
                <input type="hidden" wire:model="data.longitude" id="longitude">



                <div class="sm:col-span-4">
                    <x-input-real-time model="data.between_streets" label="Entrecalles"
                        placeholder="Entre Calle 1 y Calle 2" type="text" />
                </div>


                <div class="sm:col-span-2">
                    <x-input-real-time model="data.floor" label="Piso" placeholder="1" type="text" />
                </div>

                <div class="sm:col-span-2">
                    <x-input-real-time model="data.apartment" label="Departamento" placeholder="A" type="text" />
                </div>




                <div class="sm:col-span-3">
                    <livewire:components.select-general :idComponent="$idModel" :values="$provinces" :label="'Provincia'"
                        :name="'data.province_id'" :selectedValue="$selectedProvince" :searchEnabled="false" :live="true" :defaultOption="'Seleccione una provincia'" />


                    @error('province_id')
                        <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                    @enderror

                </div>


                <div class="sm:col-span-3">
                    <livewire:components.select-general :idComponent="$idModel" :values="$cities" :label="'Ciudad'"
                        :name="'data.city_id'" :selectedValue="$selectedCity" :searchEnabled="false" :live="true"
                        :defaultOption="'Seleccione una ciudad'" />

                    @error('city_id')
                        <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                    @enderror

                </div>



                <div class="sm:col-span-3">
                    <livewire:components.select-general :idComponent="$idModel" :values="$neighborhoods" :label="'Barrio'"
                        :name="'data.neighborhood_id'" :selectedValue="$selectedNeighborhood" :searchEnabled="false" :live="true"
                        :defaultOption="'Seleccione un barrio'" />

                    @error('neighborhood_id')
                        <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                    @enderror

                </div>

                <div class="sm:col-span-3">
                    <livewire:components.select-general :idComponent="$idModel" :values="$subzones" :label="'Subzonas'"
                        :name="'data.subzone_id'" :selectedValue="$selectedSubzone" :searchEnabled="false" :live="true"
                        :defaultOption="'Seleccione una subzona'" />

                    @error('subzone_id')
                        <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                    @enderror

                </div>


            </div>


        </div>



    </div>
    <div class="mt-8">
        <livewire:components.maps.google-map-form-field-component :latitude="$data['latitude']" :longitude="$data['longitude']"
            :input_id="'data.address'" />
    </div>


    <div class="mt-8">
        <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl w-full">
            <div class="px-4 py-6 sm:p-8">
                <div class="grid w-full grid-cols-1 gap-x-6 gap-y-3 sm:grid-cols-12">


                    <div class="sm:col-span-3">
                        <x-input-real-time model="data.documentation" label="CUIT/DNI" placeholder="20-12345678-9"
                            autocomplete="documentation" type="text" />
                    </div>

                    <div class="sm:col-span-3">

                        <livewire:components.select-general :idComponent="$idModel" :values="$propertiesTypes" :label="'Tipo de
                                                propiedad'"
                            :name="'data.property_type'" :selectedValue="$data['property_type']" :searchEnabled="false" :live="true"
                            :defaultOption="'Seleccione un tipo de propiedad'" />


                        @error('data.property_type')
                            <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                        @enderror

                    </div>

                    <div class="sm:col-span-3">

                        <livewire:components.select-general :idComponent="$idModel" :values="$frequencies" :label="'Frecuencia'"
                            :name="'data.frequency'" :selectedValue="$data['frequency']" :searchEnabled="false" :live="true"
                            :defaultOption="'Seleccione una frecuencia'" />


                        @error('data.property_type')
                            <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                        @enderror

                    </div>

                    <div class="sm:col-span-3">

                        <livewire:components.select-general :idComponent="$idModel" :values="$branches" :label="'Sucursal'"
                            :name="'data.branch_id'" :selectedValue="$data['branch_id']" :searchEnabled="false" :live="true"
                            :defaultOption="'Seleccione un tipo de propiedad'" />


                        @error('data.branch_id')
                            <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                        @enderror

                    </div>

                    <hr class="sm:col-span-full mt-4">

                    <div class="col-span-full">
                        <livewire:components.add-date-availability-general :selectedValues="$data['availabilities']" />
                    </div>


                </div>
            </div>
        </div>


    </div>

</div>
