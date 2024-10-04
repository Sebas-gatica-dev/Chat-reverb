<div>

    <div class="px-4 py-6 sm:p-8">
        <h1 class="sr-only">Edición de rol</h1>

        <div class="mt-2 sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-base font-semibold leading-6 text-white">Editar rol</h1>
                <p class="mt-2 text-sm text-gray-300">Llena el formulario para editar el rol</p>
            </div>
            <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                <a href="{{ route('master.roles.index') }}"
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
                        rol</label>
                    <div class="mt-2">
                        <input type="text" wire:model="name" id="name" autocomplete="off" value="name"
                            placeholder="Ingrese el nombre del rol"
                            class="block w-full rounded-md border-0 bg-white/5 py-1.5 text-white shadow-sm ring-1 ring-inset ring-white/10 focus:ring-2 focus:ring-inset focus:ring-indigo-500 text-sm sm:leading-6">
                    </div>
                    @error('name')
                        <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                    @enderror
                </div>
                <div class="lg:col-span-3 col-span-full">
                    <label for="description" class="block text-sm font-medium leading-6 text-white">Descripción</label>
                    <div class="mt-2">
                        <input type="text" wire:model="description" id="description" autocomplete="off" value="description"
                            placeholder="Ingrese la descripción del rol"
                            class="block w-full rounded-md border-0 bg-white/5 py-1.5 text-white shadow-sm ring-1 ring-inset ring-white/10 focus:ring-2 focus:ring-inset focus:ring-indigo-500 text-sm sm:leading-6">
                    </div>
                    @error('description')
                        <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                    @enderror
                </div>



                <div class="lg:col-span-3 col-span-full">
                    <!-- Integrar el componente del selector de usuario -->

                    <livewire:master.businesses.partials.select-user :selectedUser="$role->user">


                </div>



            </div>
        </div>
        {{-- <div class="mt-6 ring-1 ring-gray-900/5 sm:rounded-xl md:col-span-full">
            <div class="grid w-full gap-x-6 gap-y-8 grid-cols-9 md:col-span-2">
                <div class="col-span-full">
                    <h2 class="text-base font-semibold leading-6 text-white">Asociar funciones</h2>
                    <p class="mt-2 text-sm text-gray-300">Asocia funciones a este rol.</p>
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

            <!-- Sección para asociar módulos al plan -->

    <div class="grid w-full gap-x-6 gap-y-8 grid-cols-9 md:col-span-2 ring-1 ring-gray-900/5 sm:rounded-xl mt-6">
        <div class="col-span-full">
            <h2 class="text-base font-semibold leading-6 text-white">Asociar funciones al rol</h2>
            <p class="mt-2 text-sm text-gray-300">Selecciona funciones.</p>
        </div>
        <div class="col-span-6">

            <livewire:master.features.partials.multi-select-features :role="$role">

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
                            <p class="mt-2 text-sm text-gray-300">Lista de funciones asociadas al rol
                                {{ $role->name }}</p>
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


                                    <button @click="$wire.confirmDetachSelectedFeaturesForRol()" type="button"
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
                                                UUID</th>

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
                                                <td class="whitespace
                                                -nowrap px-3 py-4 text-sm text-gray-300">
                                                    {{ $feature->id }}</td>
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







</div>
