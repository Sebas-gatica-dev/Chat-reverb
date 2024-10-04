<div>
    @can('access-function','zone-add')

    @if($provincias->isNotEmpty())
    <div class="sm:shadow-none shadow py-6 flex justify-between items-center gap-x-6 gap-y-4 sm:grid-cols-4">

        <div class="grid grid-cols-1 gap-x-6 gap-y-4 sm:grid-cols-4 flex-grow items-center">

            <div class="relative">
             
                <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Provincia</label>
                <div class="mt-2">
                    <div x-data="{ open: false }" @click.away="open = false" class="relative mb-4">
                        <button @click="open = !open" type="button"
                            class="relative w-full cursor-default rounded-md bg-white py-1.5 pl-3 pr-10 text-left text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-600 sm:text-sm sm:leading-6"
                            aria-haspopup="listbox" :aria-expanded="open" aria-labelledby="listbox-label">
                            <span
                                class="block truncate text-sm">{{ $selectedProvincia ? $provincias->find($selectedProvincia['id'])->name : 'Seleccione una Provincia' }}</span>
                            <span class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2">
                                <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="none"
                                    stroke="currentColor">
                                    <path d="M7 7l3-3 3 3m0 6l-3 3-3-3" />
                                </svg>
                            </span>
                        </button>
                 

                        <ul x-show="open"
                            class="absolute z-10 mt-1 max-h-60 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm"
                            tabindex="-1" role="listbox" aria-labelledby="listbox-label" x-cloak>
                            @foreach ($provincias as $provincia)
                                <li class="text-gray-900 text-sm relative cursor-default select-none py-2 pl-8 pr-4"
                                    @click="open = !open" type="button" id="listbox-option-{{ $provincia->id }}"
                                    role="option">
                                    <button wire:click.prevent="toggleProvinciaSelection({{ $provincia->id }})"
                                        class="w-full text-left">
                                        <span class="font-normal block truncate">{{ $provincia->name }}</span>
                                        @if (isset($selectedProvincia['id']) && $selectedProvincia['id'] == $provincia->id)
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
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            {{-- Selección de Ciudad --}}
            @if ($selectedProvincia)
                <div class="relative">
                    <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Ciudad</label>
                    <div class="mt-2">
                        <div x-data="{ open: false }" @click.away="open = false" class="relative mb-4">
                            <button @click="open = !open" type="button"
                                class="relative w-full cursor-default rounded-md bg-white py-1.5 pl-3 pr-10 text-left text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                aria-haspopup="listbox" :aria-expanded="open" aria-labelledby="listbox-label">
                                <span class="block truncate text-sm">{{ count($selectedCiudades) }}
                                    Ciudad(es) seleccionada(s)</span>
                                <span class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2">
                                    <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="none"
                                        stroke="currentColor">
                                        <path d="M7 7l3-3 3 3m0 6l-3 3-3-3" />
                                    </svg>
                                </span>
                            </button>
                            <ul x-show="open"
                                class="absolute z-10 mt-1 max-h-60 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm"
                                tabindex="-1" role="listbox" aria-labelledby="listbox-label" x-cloak>
                                <li class="text-gray-900 cursor-default select-none py-2 pl-3 pr-4"
                                    id="listbox-option-0" role="option">
                                    <button wire:click.prevent="selectAllCiudades" class="w-full text-left">
                                        <span
                                            class="font-normal block truncate text-sm text-gray-500">{{ count($selectedCiudades) === count($ciudades) ? 'Deselect all' : 'Select all' }}</span>
                                    </button>
                                </li>
                                @foreach ($ciudades as $name => $id)
                                    <li class="text-gray-900 text-sm relative cursor-default select-none py-2 pl-8 pr-4"
                                        id="listbox-option-{{ $id + 1 }}" role="option">
                                        <button
                                            wire:click.prevent="toggleCiudadSelection({{ $id }}, '{{ $name }}')"
                                            class="w-full text-left">
                                            <span class="font-normal block truncate">{{ $name }}</span>
                                            @if (in_array($id, array_column($selectedCiudades, 'id')))
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
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Selección de Barrio --}}
            @if (!empty($selectedCiudades) && count($selectedCiudades) > 0)
                <div class="relative">
                    <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Barrio</label>
                    <div class="mt-2">
                        <div x-data="{ open: false }" @click.away="open = false" class="relative mb-4">
                            <button @click="open = !open" type="button"
                                class="relative w-full cursor-default rounded-md bg-white py-1.5 pl-3 pr-10 text-left text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                aria-haspopup="listbox" :aria-expanded="open" aria-labelledby="listbox-label">
                                <span class="block truncate text-sm">{{ count($selectedBarrios) }}
                                    Barrio(s) seleccionado(s)</span>
                                <span class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2">
                                    <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="none"
                                        stroke="currentColor">
                                        <path d="M7 7l3-3 3 3m0 6l-3 3-3-3" />
                                    </svg>
                                </span>
                            </button>
                            <ul x-show="open"
                                class="absolute z-10 mt-1 max-h-60 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm"
                                tabindex="-1" role="listbox" aria-labelledby="listbox-label" x-cloak>
                                <li class="text-gray-900 cursor-default select-none py-2 pl-3 pr-4"
                                    id="listbox-option-0" role="option">
                                    <button wire:click.prevent="selectAllBarrios" class="w-full text-left">
                                        <span
                                            class="font-normal block truncate text-base text-gray-400">{{ count($selectedBarrios) === count($barrios) ? 'Deselect all' : 'Select all' }}</span>
                                    </button>
                                </li>
                                @foreach ($barrios as $name => $id)
                                    <li class="text-gray-900 text-sm relative cursor-default select-none py-2 pl-8 pr-4"
                                        id="listbox-option-{{ $id + 1 }}" role="option">
                                        <button
                                            wire:click.prevent="toggleBarrioSelection({{ $id }}, '{{ $name }}')"
                                            class="w-full text-left">
                                            <span class="font-normal block truncate">{{ $name }}</span>
                                            @if (in_array($id, array_column($selectedBarrios, 'id')))
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
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Selección de Subzona --}}
            @if (!empty($selectedBarrios) && count($selectedBarrios) > 0)
                <div class="relative">
                    <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Subzona</label>
                    <div class="mt-2">
                        @if ($subzonas)
                            <div x-data="{ open: false }" @click.away="open = false" class="relative mb-4">
                                <button @click="open = !open" type="button"
                                    class="relative w-full cursor-default rounded-md bg-white py-1.5 pl-3 pr-10 text-left text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                    aria-haspopup="listbox" :aria-expanded="open" aria-labelledby="listbox-label">
                                    <span class="block truncate text-sm">{{ count($selectedSubzonas) }}
                                        Subzona(s) seleccionada(s)</span>
                                    <span
                                        class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2">
                                        <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="none"
                                            stroke="currentColor">
                                            <path d="M7 7l3-3 3 3m0 6l-3 3-3-3" />
                                        </svg>
                                    </span>
                                </button>
                                <ul x-show="open"
                                    class="absolute z-10 mt-1 max-h-60 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm"
                                    tabindex="-1" role="listbox" aria-labelledby="listbox-label" x-cloak>
                                    <li class="text-gray-900 cursor-default select-none py-2 pl-3 pr-4"
                                        id="listbox-option-0" role="option">
                                        <button wire:click.prevent="selectAllSubzonas" class="w-full text-left">
                                            <span
                                                class="font-normal block truncate text-base text-gray-400">{{ count($selectedSubzonas) === count($subzonas) ? 'Deselect all' : 'Select all' }}</span>
                                        </button>
                                    </li>
                                    @foreach ($subzonas as $name => $id)
                                        <li class="text-gray-900 text-sm relative cursor-default select-none py-2 pl-8 pr-4"
                                            id="listbox-option-{{ $id + 1 }}" role="option">
                                            <button
                                                wire:click.prevent="toggleSubzonaSelection({{ $id }}, '{{ $name }}')"
                                                class="w-full text-left">
                                                <span class="font-normal block truncate">{{ $name }}</span>
                                                @if (in_array($id, array_column($selectedSubzonas, 'id')))
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
                                    @endforeach
                                </ul>
                            </div>
                        @else
                            <div class="relative mb-4">
                                <button type="button"
                                    class="relative w-full cursor-not-allowed rounded-md bg-gray-100 py-1.5 pl-3 pr-10 text-left text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 sm:text-sm sm:leading-6">
                                    <span class="block truncate text-sm">No hay subzonas</span>
                                    <span
                                        class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2">
                                        <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="none"
                                            stroke="currentColor">
                                            <path d="M7 7l3-3 3 3m0 6l-3 3-3-3" />
                                        </svg>
                                    </span>
                                </button>
                            </div>
                        @endif
                    </div>
                </div>
            @endif

        </div>


        @if (count($selectedBarrios) > 0 || count($selectedSubzonas) > 0)
            <div class="inline pt-3" wire:loading.remove wire:target="addZone">
                <button wire:click="addZone()" type="button"
                    class="w-7 h-7 rounded-full hidden sm:block bg-green-600 p-1 text-white shadow-sm hover:bg-green-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-600">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                        <path fill-rule="evenodd"
                            d="M12 3.75a.75.75 0 0 1 .75.75v6.75h6.75a.75.75 0 0 1 0 1.5h-6.75v6.75a.75.75 0 0 1-1.5 0v-6.75H4.5a.75.75 0 0 1 0-1.5h6.75V4.5a.75.75 0 0 1 .75-.75Z"
                            clip-rule="evenodd" />
                    </svg>
                </button>

                <button type="button" wire:click="addZone()"
                    class="sm:hidden inline-flex items-center rounded-md bg-green-600 px-2.5 py-1.5 text-sm font-semibold text-white shadow-sm hover:bg-green-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-600">
                    Agregar Zona
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="-mr-0.5 h-5 w-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                </button>

            </div>


            <div class="inline pt-3" wire:loading wire:target="addZone">
                <span
                    class="w-7 h-7 hidden sm:block p-1 text-gray-600">

                    <svg class="animate-spin h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                      </svg>
                </span>



            </div>
        @else
            <div class="inline mt-3">
                <button type="button" wire:click="addZone()"
                    class="w-7 h-7 rounded-full hidden sm:block bg-gray-600 p-1 text-white shadow-sm hover:bg-gray-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-600">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                        <path fill-rule="evenodd"
                            d="M12 3.75a.75.75 0 0 1 .75.75v6.75h6.75a.75.75 0 0 1 0 1.5h-6.75v6.75a.75.75 0 0 1-1.5 0v-6.75H4.5a.75.75 0 0 1 0-1.5h6.75V4.5a.75.75 0 0 1 .75-.75Z"
                            clip-rule="evenodd" />
                    </svg>
                </button>

                <button type="button" wire:click="addZone()"
                    class="sm:hidden inline-flex items-center rounded-md bg-gray-600 px-2.5 py-1.5 text-sm font-semibold text-white shadow-sm hover:bg-gray-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-600">
                    Agregar Zona
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="-mr-0.5 h-5 w-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                </button>

            </div>


        @endif

    </div>
    @endif

    <hr class="mx-4">

    @endcan 


    @can('access-function','zone-list')
    <div class="mt-10 mb-4">
        <div class="mb-5 mx-2">
            <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Zonas
                agregadas</label>
        </div>
        @forelse ($selectedZones as $selectedZone)
            <div wire:key='{{ 'elemento-' . \Illuminate\Support\Str::random(10) }}'
                class="sm:shadow-none shadow p-2 flex justify-between items-center gap-x-6 gap-y-4 sm:grid-cols-4">

                <div class="grid grid-cols-1 gap-x-6 gap-y-4 sm:grid-cols-4 flex-grow items-center">
                    {{-- Seleccion de Provincia --}}

                    <div x-data="{ open: false }" @click.away="open = false" class="relative">
                        <button @click="open = !open" type="button"
                            class="relative w-full cursor-default rounded-md bg-white py-1.5 pl-3 pr-10 text-left text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-600 sm:text-sm sm:leading-6"
                            aria-haspopup="listbox" :aria-expanded="open" aria-labelledby="listbox-label">
                            <span class="block truncate text-sm">{{ $selectedZone['provincia']['name'] }}</span>
                            <span class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2">
                                <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="none"
                                    stroke="currentColor">
                                    <path d="M7 7l3-3 3 3m0 6l-3 3-3-3" />
                                </svg>
                            </span>
                        </button>
                        <ul x-show="open"
                            class="absolute z-10 mt-1 max-h-60 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm"
                            tabindex="-1" role="listbox" aria-labelledby="listbox-label" x-cloak>
                            <li class="text-gray-900 relative select-none py-2 pl-8 pr-4"
                                id="listbox-option-{{ $selectedZone['provincia']['id'] }}" role="option">
                                <button class="w-full text-left">
                                    <span
                                        class="font-normal block truncate text-sm">{{ $selectedZone['provincia']['name'] }}</span>
                                    <span class="text-indigo-600 absolute inset-y-0 left-0 flex items-center pl-1.5">
                                        <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"
                                            aria-hidden="true">
                                            <path fill-rule="evenodd"
                                                d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </span>
                                </button>
                            </li>
                        </ul>
                    </div>


                    {{-- Selección de Ciudad --}}

                    <div x-data="{ open: false }" @click.away="open = false" class="relative">
                        <button @click="open = !open" type="button"
                            class="relative w-full cursor-default rounded-md bg-white py-1.5 pl-3 pr-10 text-left text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-600 sm:text-sm sm:leading-6"
                            aria-haspopup="listbox" :aria-expanded="open" aria-labelledby="listbox-label">
                            <span class="block truncate text-sm">{{ count($selectedZone['ciudades']) }}
                                Ciudad(es)
                                seleccionada(s)</span>
                            <span class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2">
                                <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="none"
                                    stroke="currentColor">
                                    <path d="M7 7l3-3 3 3m0 6l-3 3-3-3" />
                                </svg>
                            </span>
                        </button>

                        <ul x-show="open"
                            class="absolute z-10 mt-1 max-h-60 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm"
                            tabindex="-1" role="listbox" aria-labelledby="listbox-label" x-cloak>
                            @foreach ($selectedZone['ciudades'] as $ciudad)
                                <li class="text-gray-900 text-sm relative cursor-default select-none py-2 pl-8 pr-4"
                                    id="listbox-option-{{ $ciudad['id'] + 1 }}" role="option">
                                    <button class="w-full text-left">
                                        <span class="font-normal block truncate text-sm">{{ $ciudad['name'] }}</span>
                                        <span
                                            class="text-indigo-600 absolute inset-y-0 left-0 flex items-center pl-1.5">
                                            <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"
                                                aria-hidden="true">
                                                <path fill-rule="evenodd"
                                                    d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </span>
                                    </button>
                                </li>
                            @endforeach
                        </ul>
                    </div>


                    {{-- Selección de Barrio --}}

                    <div x-data="{ open: false }" @click.away="open = false" class="relative">
                        <button @click="open = !open" type="button"
                            class="relative w-full cursor-default rounded-md bg-white py-1.5 pl-3 pr-10 text-left text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-600 sm:text-sm sm:leading-6"
                            aria-haspopup="listbox" :aria-expanded="open" aria-labelledby="listbox-label">
                            <span class="block truncate text-sm">{{ count($selectedZone['barrios']) }}
                                Barrio(s)
                                seleccionado(s)</span>
                            <span class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2">
                                <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="none"
                                    stroke="currentColor">
                                    <path d="M7 7l3-3 3 3m0 6l-3 3-3-3" />
                                </svg>
                            </span>
                        </button>

                        <ul x-show="open"
                            class="absolute z-10 mt-1 max-h-60 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm"
                            tabindex="-1" role="listbox" aria-labelledby="listbox-label" x-cloak>
                            @foreach ($selectedZone['barrios'] as $barrio)
                                <li class="text-gray-900 text-sm relative cursor-default select-none py-2 pl-8 pr-4"
                                    id="listbox-option-{{ $barrio['id'] + 1 }}" role="option">
                                    <button class="w-full text-left">
                                        <span class="font-normal block truncate text-sm">{{ $barrio['name'] }}</span>
                                        <span
                                            class="text-indigo-600 absolute inset-y-0 left-0 flex items-center pl-1.5">
                                            <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"
                                                aria-hidden="true">
                                                <path fill-rule="evenodd"
                                                    d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </span>
                                    </button>
                                </li>
                            @endforeach
                        </ul>
                    </div>


                    {{-- Selección de Subzona --}}
                    @if (!empty($selectedZone['subzonas']) && count($selectedZone['subzonas']) > 0)
                        <div x-data="{ open: false }" @click.away="open = false" class="relative">
                            <button @click="open = !open" type="button"
                                class="relative w-full cursor-default rounded-md bg-white py-1.5 pl-3 pr-10 text-left text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                aria-haspopup="listbox" :aria-expanded="open" aria-labelledby="listbox-label">
                                <span class="block truncate text-sm">{{ count($selectedZone['subzonas']) }}
                                    Subzona(s)
                                    seleccionada(s)</span>
                                <span class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2">
                                    <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="none"
                                        stroke="currentColor">
                                        <path d="M7 7l3-3 3 3m0 6l-3 3-3-3" />
                                    </svg>
                                </span>
                            </button>

                            <ul x-show="open"
                                class="absolute z-10 mt-1 max-h-60 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm"
                                tabindex="-1" role="listbox" aria-labelledby="listbox-label" x-cloak>
                                @foreach ($selectedZone['subzonas'] as $subzona)
                                    <li class="text-gray-900 text-sm relative cursor-default select-none py-2 pl-8 pr-4"
                                        id="listbox-option-{{ $subzona['id'] + 1 }}" role="option">
                                        <button class="w-full text-left">
                                            <span
                                                class="font-normal block truncate text-sm">{{ $subzona['name'] }}</span>
                                            <span
                                                class="text-indigo-600 absolute inset-y-0 left-0 flex items-center pl-1.5">
                                                <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"
                                                    aria-hidden="true">
                                                    <path fill-rule="evenodd"
                                                        d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </span>
                                        </button>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @else
                        <div class="relative">
                            <button
                                class="relative w-full cursor-not-allowed rounded-md bg-gray-100 py-1.5 pl-3 pr-10 text-left text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 sm:text-sm sm:leading-6">
                                <span class="block truncate text-sm">Sin subzonas</span>
                                <span class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2">
                                    <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="none"
                                        stroke="currentColor">
                                        <path d="M7 7l3-3 3 3m0 6l-3 3-3-3" />
                                    </svg>
                                </span>
                            </button>
                        </div>
                    @endif


                </div>


                @can('access-function', 'zone-delete')

                <div class="inline" wire:loading.remove wire:target="removeZone({{ $loop->index }})">
                    <div class="">
                        <button wire:click="removeZone({{ $loop->index }})"
                            wire:confirm="¿Estás seguro de que deseas eliminar esta zona?" type="button"
                            class="w-7 h-7 rounded-full hidden sm:block bg-red-600 p-1 text-white shadow-sm hover:bg-red-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                            </svg>
                        </button>

                        <button type="button" wire:click="removeZone({{ $loop->index }})"
                            class="sm:hidden inline-flex items-center rounded-md bg-red-600 px-2.5 py-1.5 text-sm font-semibold text-white shadow-sm hover:bg-red-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                            Quitar Zona
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="-mr-0.5 h-5 w-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>

                @endcan

                <div class="inline pt-3" wire:loading wire:target="removeZone({{ $loop->index }})">
                    <span
                        class="w-7 h-7 hidden sm:block p-1 text-gray-600">

                        <svg class="animate-spin h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                          </svg>
                    </span>



                </div>

             

            </div>
        @empty
            <div class="sm:col-span-7">
                <div class="rounded-md bg-yellow-50 p-4 w-100">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor"
                                aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M8.485 2.495c.673-1.167 2.357-1.167 3.03 0l6.28 10.875c.673 1.167-.17 2.625-1.516 2.625H3.72c-1.347 0-2.189-1.458-1.515-2.625L8.485 2.495zM10 5a.75.75 0 01.75.75v3.5a.75.75 0 01-1.5 0v-3.5A.75.75 0 0110 5zm0 9a1 1 0 100-2 1 1 0 000 2z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-yellow-800">Todavía no
                                agregaste ninguna zona</h3>
                            <div class="mt-2 text-sm text-yellow-700">
                                <p>Una vez elegida tu zona, por favor acepta en el botón verde.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforelse
    </div>
    @endif
</div>
