<div>
    <div class="pb-6">

        <div class="max-lg:block hidden">


            <div class="col-span-3 px-2 py-2">
                <label for="module" class="block text-sm font-medium leading-6 text-gray-900 mb-1">Módulos</label>
                <select id="module" wire:model.live="selectModule"
                    class="block w-full rounded-md border-gray-300 text-gray-900 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 text-sm sm:leading-6">
                    @foreach ($modules as $module)
                        <option value="{{ $module['id'] }}" {{ $module['id'] == $selectModule ? 'selected' : '' }}>
                            {{ $module['name'] }}
                        </option>
                    @endforeach
                </select>
            </div>

            @php

                $featuresModule = array_filter($this->modules, function ($elemento) {
                    return $elemento['id'] === $this->selectModule;
                });

                $featuresModule = array_column($featuresModule, 'features')[0];

            @endphp
            @if ($selectModule)
                <div class="col-span-3 px-2 py-2">

                    <label for="features" class="block text-sm font-medium leading-6 text-gray-900">Funciones</label>
                    <div class="mt-2">
                        <div x-data="{ open: false }" @click.away="open = false" class="relative mb-4">
                            <button @click="open = !open" type="button"
                                class="relative w-full cursor-default rounded-md bg-white py-1.5 pl-3 pr-10 text-left text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                aria-haspopup="listbox" :aria-expanded="open" aria-labelledby="listbox-label">
                                <span class="block truncate text-sm">
                                    {{ count(array_filter($selectedFeatures)) }} Funciones seleccionadas de
                                    {{ count($featuresModule) }}
                                </span>
                                <span class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2">
                                    <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="none"
                                        stroke="currentColor">
                                        <path d="M7 7l3-3 3 3m0 6l-3 3-3-3" />
                                    </svg>
                                </span>
                            </button>
                            <ul x-show="open" x-cloak
                                class="absolute z-10 mt-1 max-h-60 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm"
                                tabindex="-1" role="listbox" aria-labelledby="listbox-label">

                                @if (count($featuresModule) > 0)
                                    <li class="text-gray-900 cursor-default select-none py-2 pl-3 pr-4"
                                        id="listbox-option-0" role="option">
                                        <button wire:click.prevent="selectAllFeatures" class="w-full text-left">
                                            <span
                                                class="font-normal block truncate text-sm text-gray-500">{{ count($selectedFeatures) === count($featuresModule) ? 'Deseleccionar todas' : 'Seleccionar todas' }}</span>
                                        </button>
                                    </li>
                                @endif


                                {{-- @dump($allFeatures) --}}
                                {{-- @dd(array_keys($selectedFeatures)) --}}
                                @forelse($allFeatures as $feature)
                                    @if ($feature['module_id'] == $selectModule)
                                        <li class="text-gray-900 text-sm relative cursor-default select-none py-2 pl-8 pr-4"
                                            id="listbox-option-{{ $feature['id'] }}" role="option">
                                            <button wire:click.prevent="toggleFeatureSelected('{{ $feature['id'] }}')"
                                                class="w-full text-left">
                                                <span class="font-normal block truncate">{{ $feature['name'] }}</span>
                                                {{-- @dump($selectedFeatures[$feature['id']]) --}}

                                                @if (isset($selectedFeatures[$feature['id']]) && $selectedFeatures[$feature['id']])
                                                    <span
                                                        class="text-indigo-600 absolute inset-y-0 left-0 flex items-center pl-1.5">
                                                        <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"
                                                            aria-hidden="true">
                                                            <path fill-rule="evenodd"
                                                                d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z"
                                                                clip-rule="evenodd" />
                                                        </svg>
                                                    </span>
                                                @endif
                                            </button>
                                        </li>
                                    @endif

                                @empty
                                    <li class="text-gray-900 cursor-default select-none py-2 pl-3 pr-4"
                                        id="listbox-option-0" role="option">
                                        <span class="font-normal block truncate text-sm text-gray-500">No hay funciones
                                            disponibles</span>
                                    </li>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </div>

            @endif


        </div>



        <nav class="-mb-px flex space-x-8 border-b border-gray-200 w-full" aria-label="Tabs">
            <div
                class="overflow-x-auto flex scroll-smooth scrollbar-thin scrollbar-thumb-rounded-full scrollbar-thumb-indigo-100 scrollbar-track-indigo-50 ">
                @forelse ($modules as $module)
                    <button wire:click="changeModule('{{ $module['id'] }}')" wire:key="{{ $module['id'] }}"
                        class="group inline-flex items-center border-b-2 flex-shrink-0 whitespace-nowrap
                   py-4 text-sm font-medium px-4
                    {{ $module['id'] == $selectModule ? 'border-indigo-500 text-indigo-600 bg-indigo-50' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700' }}
                    ">

                        <span
                            class=" group-hover:text-gray-500 {{ $module['id'] == $selectModule ? 'text-indigo-500' : 'text-gray-400' }} ">{{ $module['name'] }}</span>
                    </button>
                @empty

                    <span class="text-gray-400">No hay módulos </span>
                @endforelse
            </div>
        </nav>


        <div class="mt-4 px-4">
            <fieldset>
                <legend class="sr-only">Funciones</legend>
                <div class="mt-4 grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3">
                    @forelse ($allFeatures as $feature)
                        @if ($feature['module_id'] == $selectModule)
                            <div class="space-y-5 col-span-1 flex flex-col">
                                <div class="relative flex items-start">
                                    <div class="flex h-6 items-center">
                                        <input id="feature-{{ $feature['id'] }}"
                                            wire:model.live="selectedFeatures.{{ $feature['id'] }}"
                                            name="feature-{{ $feature['id'] }}" type="checkbox"
                                            class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
                                            {{ in_array($feature['id'], array_keys($selectedFeatures)) ? 'checked' : '' }}>
                                    </div>
                                    <div class="ml-3 text-sm leading-6">
                                        <label for="feature-{{ $feature['id'] }}"
                                            class="font-medium text-gray-900">{{ $feature['name'] }}</label>
                                        <p id="feature-{{ $feature['id'] }}-description" class="text-gray-500">
                                            {{ $feature['description'] }}</p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @empty
                        <span class="text-gray-300 text-sm">No hay características disponibles</span>
                    @endforelse
                </div>

            </fieldset>

        </div>




        <div class="items-center justify-end gap-x-6 border-t border-gray-900/10 p-4 flex mt-2">

            <button wire:click="updateFeaturesRole"
                class="rounded-md bg-indigo-600 px-3 py-2 font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 text-sm focus-visible:outline-indigo-600">Actualizar</button>

        </div>


    </div>




</div>
