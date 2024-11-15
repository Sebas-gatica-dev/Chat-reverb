<div>

    <div class="px-4 py-6 sm:p-8">
        <h1 class="sr-only">Edición de negocio</h1>

        <div class="mt-2 sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-base font-semibold leading-6 text-white">Editar negocio</h1>
                <p class="mt-2 text-sm text-gray-300">Llena el formulario para editar el negocio</p>
            </div>
            <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                <a wire:navigate href="{{ route('master.businesses.index') }}"
                    class="inline-flex items-center gap-x-1.5 rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="-ml-0.5 h-5 w-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                    </svg>
                    Atrás
                </a>
            </div>
        </div>

        <div class="ring-1 ring-gray-900/5 sm:rounded-xl md:col-span-full mt-6">
            <div class="grid w-full gap-x-6 gap-y-8 grid-cols-9 md:col-span-2">
                <div class="lg:col-span-3 col-span-full">
                    <label for="name" class="block text-sm font-medium leading-6 text-white">Nombre del
                        negocio</label>
                    <div class="mt-2">
                        <input type="text" wire:model="name" id="name" autocomplete="off"
                            placeholder="Ingrese el nombre del negocio"
                            class="block w-full rounded-md border-0 bg-white/5 py-1.5 text-white shadow-sm ring-1 ring-inset ring-white/10 focus:ring-2 focus:ring-inset focus:ring-indigo-500 text-sm sm:leading-6">
                    </div>
                    @error('name')
                        <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                    @enderror
                </div>



                <div class="lg:col-span-3 col-span-full">
                    <label for="logo" class="block text-sm font-medium leading-6 text-white">Logo</label>
                    <label for="logo">
                        <div class="mt-8 flex items-center gap-x-3">

                            @if ($logoPreview)
                                <img class="inline-block h-32 w-32 rounded-md object-cover" src="{{ $logoPreview }}"
                                    alt="Logo temporal">
                            @else
                                <div wire:loading.remove wire:target="logo">
                                    <span class="inline-block h-32 w-32 overflow-hidden rounded-md bg-gray-100">
                                        <svg class="h-full w-full text-gray-300" fill="currentColor"
                                            viewBox="0 0 24 24">
                                            <path
                                                d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                                        </svg>
                                    </span>
                                </div>
                                <div wire:loading wire:target="logo">

                                    <div disabled>
                                        <svg class="animate-spin h-5 w-5 mx-auto text-gray-400"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10"
                                                stroke="currentColor" stroke-width="4">
                                            </circle>
                                            <path class="opacity-75" fill="currentColor"
                                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                            </path>
                                        </svg>
                                        <p class="mx-auto text-sm text-indigo-600">Procesando logo
                                            ..</p>

                                    </div>
                                </div>
                            @endif


                            <span type="button"
                                class="rounded-md bg-white px-2.5 py-1.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">Cambiar</span>

                            <input wire:model="logo" type="file" id="logo" wire:model.blur="logo" value="logo"
                                class=" sr-only rounded-md bg-white px-2.5 py-1.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">



                        </div>
                    </label>
                    <p class="mt-3 text-sm leading-6 text-gray-600">Es recomendable que sea una
                        imagen
                        cuadrada,
                        por ejemplo: 500x500 pixeles.</p>

                    @error('logo')
                        <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                    @enderror
                </div>

                <div class="lg:col-span-3 col-span-full">
                    <label for="address" class="block text-sm font-medium leading-6 text-white">Dirección</label>
                    <div class="mt-2">
                        <input type="text" wire:model="address" id="address" autocomplete="off"
                            placeholder="Ingrese la dirección del negocio" value="address"
                            class="block w-full rounded-md border-0 bg-white/5 py-1.5 text-white shadow-sm ring-1 ring-inset ring-white/10 focus:ring-2 focus:ring-inset focus:ring-indigo-500 text-sm sm:leading-6">
                    </div>
                    @error('address')
                        <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                    @enderror
                </div>

                <div class="lg:col-span-3 col-span-full">
                    <label for="phone" class="block text-sm font-medium leading-6 text-white">Telefono</label>
                    <div class="mt-2">
                        <input type="text" wire:model="phone" id="phone" autocomplete="off"
                            placeholder="Ingrese numero de telefono" value="phone"
                            class="block w-full rounded-md border-0 bg-white/5 py-1.5 text-white shadow-sm ring-1 ring-inset ring-white/10 focus:ring-2 focus:ring-inset focus:ring-indigo-500 text-sm sm:leading-6">
                    </div>
                    @error('phone')
                        <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                    @enderror
                </div>

                <div class="lg:col-span-3 col-span-full">
                    <label for="email" class="block text-sm font-medium leading-6 text-white">Email</label>
                    <div class="mt-2">
                        <input type="text" wire:model="email" id="email" autocomplete="off"
                            placeholder="Ingrese email" value="email"
                            class="block w-full rounded-md border-0 bg-white/5 py-1.5 text-white shadow-sm ring-1 ring-inset ring-white/10 focus:ring-2 focus:ring-inset focus:ring-indigo-500 text-sm sm:leading-6">
                    </div>
                    @error('email')
                        <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                    @enderror
                </div>
                <div class="lg:col-span-3 col-span-full">
                    <!-- Integrar el componente del selector de usuario -->

                    <livewire:master.businesses.partials.select-user :selectedUser="$business->createdBy">


                </div>



            </div>
        </div>
        {{-- <div class="mt-6 ring-1 ring-gray-900/5 sm:rounded-xl md:col-span-full">
            <div class="grid w-full gap-x-6 gap-y-8 grid-cols-9 md:col-span-2">
                <div class="col-span-full">
                    <h2 class="text-base font-semibold leading-6 text-white">Asociar funciones</h2>
                    <p class="mt-2 text-sm text-gray-300">Asocia funciones a este negocio.</p>
                </div>
                <div class="col-span-6">
                    <livewire:master.businesses.partials.multi-select-modules-and-features :business="$business">
                </div>
            </div>
        </div> --}}

        <div class="flex items-center md:justify-between justify-start gap-x-6 py-4">
            <button wire:click="update()"
                class="rounded-md bg-indigo-600 px-3 py-2 font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 text-sm focus-visible:outline-indigo-600">Editar</button>
        </div>
    </div>



    <!-- Sección para asociar módulos al plan -->

    <div class="grid w-full gap-x-6 gap-y-8 grid-cols-9 md:col-span-2 ring-1 ring-gray-900/5 sm:rounded-xl mt-6">
        <div class="col-span-full">
            <h2 class="text-base font-semibold leading-6 text-white">Asociar funciones al negocio</h2>
            <p class="mt-2 text-sm text-gray-300">Selecciona funciones.</p>
        </div>
        <div class="col-span-6">

            <livewire:master.features.partials.multi-select-features :business="$business">

        </div>


    </div>






    <div class="px-4 py-6 sm:p-8" x-data="{ selectAll: @entangle('selectAll').live, selectedFeatures: @entangle('selectedFeatures').live }">
        <div class="bg-gray-900">
            <div class="mx-auto max-w-7xl">
                <div class="bg-gray-900 py-10">
                    <div class="sm:flex sm:items-center">
                        <div class="sm:flex-auto">
                            <h1 class="text-base font-semibold leading-6 text-white">Funciones</h1>
                            <p class="mt-2 text-sm text-gray-300">Lista de funciones asociadas al negocio
                                {{ $business->name }}</p>
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


                                    <button @click="$wire.confirmDetachSelectedFeaturesForBusiness()" type="button"
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
                                                        {{ $feature->module->name ? $feature->module->name: 'Sin modulo' }}</td>
                                                <td class="py-4 pl-0 pr-4 text-sm leading-6 sm:pr-8 lg:pr-20">
                                                    <div
                                                        class="flex items-center justify-end gap-x-2 sm:justify-start">
                                                        @if ($feature->status == 1)
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
                                                        wire:confirm="¿Desea desasociar esta funcion del negocio?"
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





</div>
