<div>
    <div class="px-4 py-6 sm:p-8">
        <h1 class="sr-only">Edicion de plan</h1>


        <div class="mt-2 sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-base font-semibold leading-6 text-white">Edita el plan</h1>
                <p class="mt-2 text-sm text-gray-300">Cambia los campos que desees</p>
            </div>

            <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                <a wire:navigate href="{{ route('master.plans.index') }}"
                    class="inline-flex items-center gap-x-1.5 rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">

                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="-ml-0.5 h-5 w-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                    </svg>
                    Atras

                </a>

            </div>

        </div>



        <div class="ring-1 ring-gray-900/5 sm:rounded-xl md:col-span-full mt-6">

            <div class="grid w-full gap-x-6 gap-y-8 grid-cols-9 md:col-span-2">

                <div class="lg:col-span-3 col-span-full">
                    <label for="first-name" class="block text-sm font-medium leading-6 text-white">Nombre
                        del plan</label>
                    <div class="mt-2">
                        <input type="text" wire:model="name" id="name" autocomplete="off"
                            placeholder="Ingrese el nombre del plan"
                            class="block w-full rounded-md border-0 bg-white/5 py-1.5 text-white shadow-sm ring-1 ring-inset ring-white/10 focus:ring-2 focus:ring-inset focus:ring-indigo-500 text-sm sm:leading-6">
                    </div>
                    @error('name')
                        <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                    @enderror
                </div>




                <div class="lg:col-span-3 col-span-full">
                    <label for="price" class="block text-sm font-medium leading-6 text-white">Precio</label>
                    <div class="mt-2">
                        <input id="price" wire:model="price" type="text" autocomplete="price"
                            placeholder="$25.000"
                            class="block w-full rounded-md border-0 bg-white/5 py-1.5 text-white shadow-sm ring-1 ring-inset ring-white/10 focus:ring-2 focus:ring-inset focus:ring-indigo-500 text-sm sm:leading-6">
                    </div>

                    @error('price')
                        <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                    @enderror
                </div>



                <div class="lg:col-span-3 col-span-full">
                    <label for="free_trial_days" class="block text-sm font-medium leading-6 text-white">Días
                        gratis</label>
                    <div class="mt-2">


                        <input type="text" wire:model="free_trial_days" id="free_trial_days" autocomplete="off"
                            placeholder="Ingrese los días gratis"
                            class="block w-full rounded-md border-0 bg-white/5 py-1.5 text-white shadow-sm ring-1 ring-inset ring-white/10 focus:ring-2 focus:ring-inset focus:ring-indigo-500 text-sm sm:leading-6">

                    </div>

                    @error('free_trial_days')
                        <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                    @enderror

                </div>


                <div class="lg:col-span-3 col-span-full">
                    <label for="duration" class="block text-sm font-medium leading-6 text-white">Unidad de
                        frecuencia</label>
                    <div class="mt-2">
                        <input type="text" wire:model="duration" id="duration" autocomplete="off"
                            placeholder="Ingrese la unidad de frecuencia"
                            class="block w-full rounded-md border-0 bg-white/5 py-1.5 text-white shadow-sm ring-1 ring-inset ring-white/10 focus:ring-2 focus:ring-inset focus:ring-indigo-500 text-sm sm:leading-6">
                    </div>
                    @error('duration')
                        <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                    @enderror
                </div>




                <div class="lg:col-span-3 col-span-full">
                    <label for="duration_unit" class="block text-sm font-medium leading-6 text-white">Frecuencia</label>
                    <div class="mt-2">

                        <select wire:model="duration_unit" name="duration_unit"
                            class="block w-full rounded-md border-0 py-1.5 text-gray-200 bg-gray-800 shadow-sm ring-1 ring-inset ring-white/10 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs text-sm sm:leading-6">
                            <option value="">Seleccione una opción</option>
                            <option value="month">Mensual</option>
                            <option value="year">Anual</option>
                        </select>

                    </div>

                    @error('duration_unit')
                        <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                    @enderror
                </div>



                <div class="lg:col-span-3 col-span-full">

                    <div class="mt-6">
                        <fieldset>
                            <div class="relative flex gap-x-3">
                                <div class="flex h-6 mt-2 items-center">
                                    <input id="is_featured" wire:model="is_featured" type="checkbox"
                                        class="h-4 w-4 rounded ring-white/10 bg-gray-800 text-indigo-600 focus:ring-indigo-600"
                                        {{ $is_featured ? 'checked' : '' }}>
                                </div>
                                <div class="text-sm leading-6">
                                    <label for="is_featured" class="font-medium text-white">Destacar plan</label>
                                    <p class="text-gray-400">Resalta este plan en la lista de planes.</p>
                                </div>
                            </div>

                        </fieldset>
                    </div>

                    @error('is_featured')
                        <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                    @enderror

                </div>




                <div class="col-span-9">
                    <label for="description" class="block text-sm font-medium leading-6 text-white">Descripción</label>
                    <div class="mt-2">

                        <textarea id="description" wire:model="description" rows="3"
                            class="block w-full rounded-md border-0 py-1.5 text-white shadow-sm ring-1 bg-white/5 ring-inset ring-white/10 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>

                    </div>
                    @error('description')
                        <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                    @enderror
                </div>






            </div>




            <div class="flex items-center md:justify-between justify-start gap-x-6 py-4">


                <button wire:click="update()"
                    class="rounded-md bg-indigo-600 px-3 py-2 font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 text-sm focus-visible:outline-indigo-600">Actualizar</button>

            </div>



        </div>


        <!-- Sección para asociar módulos al plan -->

        <div class="grid w-full gap-x-6 gap-y-8 grid-cols-9 md:col-span-2 ring-1 ring-gray-900/5 sm:rounded-xl mt-6">
            <div class="col-span-full">
                <h2 class="text-base font-semibold leading-6 text-white">Asociar modulos y sus funciones</h2>
                <p class="mt-2 text-sm text-gray-300">Asocia modulo y funciones.</p>
            </div>
            <div class="col-span-6">

                <livewire:master.features.partials.multi-select-features :plan="$plan" :key="$plan->id" />

            </div>


        </div>




    </div>




    <div class="px-4 py-6 sm:p-8" x-data="{ selectAll: @entangle('selectAll').live, selectedFeatures: @entangle('selectedFeatures').live }">
        <div class="bg-gray-900">
            <div class="mx-auto max-w-7xl">
                <div class="bg-gray-900 py-10">
                    <div class="sm:flex sm:items-center">
                        <div class="sm:flex-auto">
                            <h1 class="text-base font-semibold leading-6 text-white">Funciones</h1>
                            <p class="mt-2 text-sm text-gray-300">Lista de funciones asociadas al plan
                                {{ $plan->name }}</p>
                        </div>
                    </div>
                    <div class="mt-8 flow-root">
                        <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">



                                <!-- Selected row actions, only show when rows are selected. -->
                                <div x-show="selectedFeatures.length > 0"
                                    class="inline-flex items-center gap-2 px-3">

                                    <span class="inline-flex items-center rounded-md bg-yellow-400/10 px-2 py-1 text-xs font-medium text-yellow-500 ring-1 ring-inset ring-yellow-400/20">

                                        {{ count($selectedFeatures) }} seleccionados

                                    </span>


                                    <button @click="$wire.confirmDetachSelectedFeatures()" type="button"
                                        class="inline-flex items-center rounded px-2 py-1 text-sm font-semibold bg-indigo-600 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                                        Desasociar seleccionados
                                    </button>
                                </div>


                                <table class="min-w-full divide-y divide-gray-700">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="relative px-7 sm:w-12 sm:px-6">
                                                <input type="checkbox" x-model="selectAll"
                                                    x-on:click="selectedFeatures = selectAll ? @entangle('features').live : []"
                                                    class="absolute left-4 top-1/2 -mt-2 h-4 w-4 rounded  ring-white/10 bg-gray-800 text-indigo-600 focus:ring-indigo-600">
                                            </th>

                                            <th scope="col"
                                                class="px-3 py-3.5 text-left text-sm font-semibold text-white">
                                                Nombre</th>
                                            <th scope="col"
                                                class="px-3 py-3.5 text-left text-sm font-semibold text-white">
                                                Archivo
                                            </th>
                                            <th scope="col"
                                                class="px-3 py-3.5 text-left text-sm font-semibold text-white">
                                                Descripción</th>
                                            <th scope="col"
                                                class="px-3 py-3.5 text-left text-sm font-semibold text-white">
                                                Módulo
                                            </th>
                                            <th scope="col"
                                                class="py-2 pl-0 pr-4 text-right font-semibold sm:pr-8 text-white text-sm sm:text-left lg:pr-20">
                                                Estado</th>
                                            <th scope="col"
                                                class="px-3 py-3.5 text-left text-sm font-semibold text-white">
                                                Acciones
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-800">
                                        @forelse ($features as $feature)
                                            <!-- Selected: "bg-gray-50" -->

                                            <tr wire:key="{{ $feature->id }}">
                                                <td class="relative px-7 sm:w-12 sm:px-6">
                                                    <!-- Selected row marker, only show when row is selected. -->
                                                    <!-- <div class="absolute inset-y-0 left-0 w-0.5 bg-indigo-600"></div> -->

                                                    <input type="checkbox" value="{{ $feature->id }}"
                                                        x-model="selectedFeatures"
                                                        class="absolute left-4 top-1/2 -mt-2 h-4 w-4 rounded  ring-white/10 bg-gray-800 text-indigo-600 focus:ring-indigo-600">
                                                </td>
                                                <!-- Selected: "text-indigo-600", Not Selected: "text-gray-900" -->

                                                <td
                                                    class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-white sm:pl-0">
                                                    {{ $feature->name }}</td>
                                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-300">
                                                    {{ $feature->file ? $feature->file : 'Sin archivo' }}</td>
                                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-300">
                                                    {{ $feature->description }}</td>
                                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-300">
                                                    {{ $feature->module->name }}</td>
                                                <td class="py-4 pl-0 pr-4 text-sm leading-6 sm:pr-8 lg:pr-20">
                                                    <div
                                                        class="flex items-center justify-end gap-x-2 sm:justify-start">
                                                        @if (!$feature->deleted_at)
                                                            <div
                                                                class="flex-none rounded-full bg-green-400/10 p-1 text-green-400">
                                                                <div class="h-1.5 w-1.5 rounded-full bg-current">
                                                                </div>
                                                            </div>
                                                            <div class="text-white sm:block">Activa</div>
                                                        @else
                                                            <div
                                                                class="flex-none rounded-full bg-rose-400/10 p-1 text-rose-400">
                                                                <div class="h-1.5 w-1.5 rounded-full bg-current">
                                                                </div>
                                                            </div>
                                                            <div class="hidden text-white sm:block">Inactiva</div>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-300">
                                                    <button wire:click="confirmDetachFeature('{{ $feature->id }}')"
                                                        class="text-red-500 hover:text-red-700">Desasociar</button>

                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td class="py-4 pl-4 pr-3 text-sm font-medium text-white sm:pl-0"
                                                    colspan="6">No hay funciones asociadas a este plan.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>

                                {{ $features->links(data: ['scrollTo' => false]) }}

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <livewire:master.features.partials.modals.confirm-modal-detach-feature name="detachConfirm" />



</div>
