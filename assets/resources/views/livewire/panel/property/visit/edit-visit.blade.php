<div>
    <header class="bg-white shadow">
        <div class="mx-auto max-w-screen-2xl px-4 py-6 sm:px-6 lg:px-8">
            <div class="md:flex md:items-center md:justify-between">
                <div class="min-w-0 flex-1">
                    <h1 class="text-2xl font-bold tracking-tight text-gray-900">Editar visita de
                        {{ $visit->property->property_name }}
                    </h1>
                </div>
                <div class="mt-4 flex md:ml-4 md:mt-0">
                    <a wire:navigate
                        href="{{ route('panel.customers.property.show', [$this->visit->customer_id, $this->visit->property_id]) }}"
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
                            <h2 class="text-base font-semibold leading-7 text-gray-900">Informacion sobre la visita</h2>
                            <p class="mt-1 text-sm leading-6 text-gray-600">Llene los campos para agregar su visita con
                                cuidado.</p>
                        </div>

                        <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl md:col-span-3">
                            <div class="px-4 py-6 sm:p-8">
                                <div class="grid w-full grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-12">



                                    <div class="sm:col-span-4">
                                        <label for="property_name"
                                            class="block text-sm font-medium leading-6 text-gray-900">Fecha de visita
                                            (*)</label>
                                        <div class="mt-2">
                                            <input type="date" wire:model.live="date" id="date"
                                                autocomplete="off" placeholder="dd/mm/yyyy"
                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                        </div>
                                        @error('date')
                                            <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                        @enderror
                                    </div>


                                    <div class="sm:col-span-4">
                                        <label for="time"
                                            class="block text-sm font-medium leading-6 text-gray-900">Hora</label>
                                        <div class="mt-2">
                                            <input type="time" wire:model.live="time" id="time"
                                                autocomplete="off" placeholder="--:--"
                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                        </div>
                                        @error('time')
                                            <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    {{-- <div class="sm:col-span-4">
                                        <label for="property_type"
                                            class="block text-sm font-medium leading-6 text-gray-900">Disponibilidad del cliente (*)</label>
                                        <div class="mt-2">
                                            <select id="property_type" wire:model.live="property_type"
                                                autocomplete="property_type"
                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                                <option value="">Seleccione un tipo de propiedad</option>



                                            </select>
                                        </div>
                                        @error('property_type')
                                            <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                        @enderror
                                    </div> --}}
                                    <div class="sm:col-span-4">

                                        <label for="users"
                                            class="block text-sm font-medium leading-6 text-gray-900">Asigna usuarios a
                                            la visita
                                            </label>
                                        <div class="mt-2">
                                            <livewire:components.multi-select-general :selectedValues="$selectedUsers"
                                                :values="$users" :imageValue="true" :searchEnabled="true" :name="'users'"
                                                :model="false">
                                        </div>
                                        @error('selectedUsers')
                                            <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                        @enderror
                                    </div>


                                    <div class="sm:col-span-4">

                                        <label for="visits"
                                            class="block text-sm font-medium leading-6 text-gray-900">Tipo de visita
                                            (*)</label>
                                        <div class="mt-2">
                                            <livewire:components.select-general :selectedValue="$selectedTypeVisit" :values="$typeVisits"
                                                :imageValue="false" :searchEnabled="true" :name="'typeVisits'"
                                                :model="false">
                                        </div>
                                        @error('selectedTypeVisit')
                                            <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                        @enderror
                                    </div>



                                    <div class="sm:col-span-4">

                                        <label for="services"
                                            class="block text-sm font-medium leading-6 text-gray-900">Tipo de servicios
                                            (*)</label>
                                        <div class="mt-2">
                                            <livewire:components.multi-select-general :selectedValues="$selectedServices"
                                                :values="$services" :imageValue="false" :searchEnabled="true"
                                                :name="'services'" :model="false">
                                        </div>
                                        @error('selectedServices')
                                            <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                        @enderror
                                    </div>



                                    <div class="sm:col-span-4">
                                        <label for="iva"
                                            class="block text-sm font-medium leading-6 text-gray-900">IVA</label>
                                        <div class="mt-2">
                                            <livewire:components.toggle :checked="$checked" :breakdown="false"
                                                :answer="$answer" :dark="false">
                                        </div>
                                    </div>


                                    <hr class="sm:col-span-full">


                                    <div class="sm:col-span-4">
                                        <label for="price"
                                            class="block text-sm font-medium leading-6 text-gray-900">Precio </label>
                                        <div class="mt-2">
                                            <input id="price" wire:model.live="price" type="text"
                                                autocomplete="number" placeholder="15.000,00"
                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                        </div>

                                        @error('price')
                                            <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                        @enderror
                                    </div>


                                    <div class="sm:col-span-4">
                                        <label for="duration_time"
                                            class="block text-sm font-medium leading-6 text-gray-900">Duración de la visita </label>
                                        <div class="mt-2">
                                            <input id="duration_time" wire:model.live="duration_time" type="number"
                                                autocomplete="duration_time" placeholder="45"
                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                        </div>

                                        @error('duration_time')
                                            <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="sm:col-span-4">

                                        <label for="visits"
                                            class="block text-sm font-medium leading-6 text-gray-900">Pago esperado
                                        </label>
                                        <div class="mt-2">
                                            <livewire:components.select-general :selectedValue="$selectedExpectedPayment" :values="$expectedPayments"
                                                :imageValue="false" :searchEnabled="false" :name="'expectedPayment'"
                                                :model="false">
                                        </div>
                                        @error('selectedExpectedPayment')
                                            <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                        @enderror
                                    </div>




                                    <hr class="sm:col-span-full">


                                    <div class="sm:col-span-full">
                                        <label for="message"
                                            class="block text-sm font-medium leading-6 text-gray-900">Comentario
                                            (*)</label>
                                        <div class="mt-2">
                                            <textarea wire:model="message" autocomplete="off" placeholder="Agrege un comentario"id="message" name="message" value="message"
                                                rows="3"
                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 text-sm  sm:leading-6"></textarea>
                                        </div>
                                        @error('message')
                                            <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                        @enderror

                                    </div>


                                    <hr class="sm:col-span-full">



                                    <div class="col-span-full">
                                        <label for="files"
                                            class="block text-sm font-medium leading-6 text-gray-900">Archivos</label>

                                            <livewire:components.upload-file :multiple="true" :extensions="['jpg', 'jpeg', 'png' , 'gif', 'pdf', 'doc', 'docx', 'txt', 'xls', 'xlsx', 'ppt', 'pptx', 'mp4', 'mov', 'avi', 'mp3', 'wav', 'mp3 ', 'wav', 'ogg', 'm4a', 'flac', 'aac', 'wma']"
                                                
                                            :existingFiles="$filesExisting"
                                            />
                                            {{-- @dump($initialFilesExisting, $filesExisting, $newFiles) --}}

                                    </div>

                                    <hr class="sm:col-span-full">

                                    <div class="col-span-full">
                                        <livewire:components.add-date-availability-general :selectedValues="$availabilities" />
                                    </div>



                                    <hr class="sm:col-span-full p-0">
                                    <div class="col-span-full justify-end flex">

                                        <button wire:click="save" type="button"
                                            class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Guardar
                                        </button>
                                    </div>



                                </div>



                            </div>

                        </div>
                    </div>






                </div>




            </div>
        </div>




    </main>

</div>
