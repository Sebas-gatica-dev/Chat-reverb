<div>

    @if ($visit)
        <livewire:panel.property.visit.list-visit :visit="$visit" :first="null" :wire:key="$visit->id" />
    @else
        <div class="text-center mt-6 min-w-full">
            <div colspan="10" class="py-6 rounded-md">
                <div class="rounded-md bg-slate-50 p-4 border border-slate-600 shadow-sm">
                    <div class="text-sm font-medium text-slate-700 text-center ">
                        <p>Esta opción no es obligatoria, tiene que usarla si necesita coordinar una visita para poder
                            presupuestar el trabajo.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl md:col-span-3 mt-6">
            <div class="px-4 py-6 sm:p-8">

                <div x-data="{ recommendedDate: @entangle('recommendedDate') }">

                    <div class="grid md:w-full grid-cols-1 gap-x-6 gap-y-8 md:grid-cols-12">

                        {{-- TOGGLE --}}
                        <div class="md:col-span-12 col-span-6 md:mx-auto">
                            <div class="flex items-center w-full gap-x-4 divide-x">



                                <!-- Toggle para 'recommendedDate' -->
                                <div class="flex items-center">
                                    <button type="button" wire:click="$toggle('recommendedDate')"
                                        x-bind:class="{ 'bg-indigo-600': recommendedDate, 'bg-gray-200': !recommendedDate }"
                                        class="relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:ring-offset-2"
                                        role="switch" aria-labelledby="personalized-date-label">
                                        <!-- Icono del interruptor -->
                                        <span aria-hidden="true"
                                            x-bind:class="{ 'translate-x-5': recommendedDate, 'translate-x-0': !recommendedDate }"
                                            class="pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out"></span>
                                    </button>
                                    <span class="ml-3 text-sm" id="personalized-date-label">
                                        <span class="font-medium text-gray-900">Recomendaciones de la IA</span>
                                    </span>
                                </div>

                            </div>
                        </div>

                        {{-- Recomendaciones de la IA --}}
                        <div x-show="recommendedDate" class="col-span-12">
                            {{-- <livewire:panel.visit.search-route-visit :property="$property" lazy /> --}}
                        </div>

                    </div>



                    <div x-show="!recommendedDate"
                        class="grid w-full grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-12 max-sm:mt-4">

                        <!-- Fecha -->
                        <div class="sm:col-span-4">
                            <x-input-real-time model="data.date" label="Fecha" type="date" />
                        </div>

                        <!-- Hora -->
                        <div class="sm:col-span-4">
                            <x-input-real-time model="data.time" label="Hora" type="time" />
                        </div>

                        <!-- Asignación de usuarios -->
                        <div class="sm:col-span-4">

                            <label for="users" class="block text-sm font-medium leading-6 text-gray-900">Asigna
                                usuarios a
                                la visita
                            </label>
                            <div class="mt-2">
                                <livewire:components.multi-select-general :selectedValues="$data['workers']" :values="$users"
                                    :imageValue="true" :searchEnabled="true" :name="'data.workers'" :model="false"
                                    :idComponent="$idModel" />
                            </div>

                        </div>


                    </div>


                    <hr class="sm:col-span-full mt-10">


                </div>

                <div class="grid w-full gap-x-6 gap-y-8 grid-cols-12 mt-10">

                    {{-- Precio --}}
                    <div class="sm:col-span-4 col-span-8">
                        <x-input-real-time model="data.price" label="Precio" type="number" placeholder="$15.000" />
                    </div>

                    <div class="sm:col-span-2 col-span-4">

                            <label for="iva"
                                class="block text-sm font-medium leading-6 text-gray-900">IVA
                                {{ ($data['iva'] && $data['price'] > 0) ? '($'. number_format($this->totalPrice, 0, ',', '.') . ')' : '' }}
                            </label>
                    
                        <div class="mt-3">
                            {{-- <livewire:components.toggle :checked="$data['iva']" :breakdown="false" :dark="false"> --}}

                            <livewire:components.toggle :checked="$data['iva']" :breakdown="false"
                            :dark="false" 
                            :name="'iva'" />


                        </div>
                    </div>

                    <div class="sm:col-span-3 col-span-12">
                        <x-input-real-time model="data.duration_time" label="Duración de la visita" type="number"
                            placeholder="60 min" />
                    </div>



                    <div class="sm:col-span-8 col-span-12">
                        <livewire:components.select-general :values="$expectedPayments" :label="'Pago esperado'" :name="'data.expected_payment'"
                            :selectedValue="$selectedExpectedPayment" :searchEnabled="true" :live="true" :defaultOption="'Selecciona tipo de pago'"
                            :idComponent="$idModel" />
                        @error('data.expected_payment')
                            <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                        @enderror
                    </div>



                    <hr class="sm:col-span-full">

                    <div class="col-span-full">
                        <x-input-real-time model="data.comment" label="Comentario (*)" type="textarea"
                            placeholder="Escribe un comentario para la visita" />
                    </div>

                    @if (!isset($data['id']))
                        <div class="col-span-full justify-end flex">

                            <button wire:click="saveFormNewVisitInspect"
                                class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm
                    hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2
                    focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                                Crear visita de inspección</button>
                        </div>
                    @endif

                </div>


            </div>
    @endif
</div>
</div>
