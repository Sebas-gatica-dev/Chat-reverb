<div>
    <header class="bg-white shadow">
        <div class="mx-auto max-w-screen-2xl px-4 py-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center">
                <div class="min-w-0 sm:flex-1">
                    <h1 class="items-center text-[1em] sm:text-2xl sm:mt-2 font-bold tracking-tight text-gray-900">
                        Clientes potenciales
                    </h1>
                </div>

                {{-- @can('access-function', 'customer-add') --}}
                <div class="items-center sm:flex md:ml-4 md:mt-0 justify-end">
                    <a wire:navigate href="{{ route('panel.leads.add') }}"
                        class="ml-3 inline-flex items-center rounded-md bg-indigo-600 px-2 py-1.5 sm:px-3 sm:py-2 text-[0.8em] sm:text-sm font-semibold text-white shadow-sm hover:bg-indigo-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                        Agregar
                    </a>
                </div>
                {{-- @endcan --}}
            </div>
        </div>
    </header>


    <!-- Filters Section -->
    <section aria-labelledby="filter-heading" class="border-b border-t border-gray-200 bg-slate-100"
        x-data="{ openFilters: false }">
        <h2 id="filter-heading" class="sr-only">Filters</h2>
        <div class="max-w-screen-2xl mx-auto sm:grid items-center sm:grid-cols-3">


            <div class="relative flex justify-between sm:justify-none sm:block sm:col-span-1  items-center sm:py-4">
                <div
                    class="sm:mx-auto flex max-w-screen-2xl space-x-6 divide-x divide-gray-200 px-4 text-sm sm:px-6 lg:px-8">
                    <div>
                        <button type="button" class="group flex items-center font-medium text-gray-700"
                            aria-controls="disclosure-1" aria-expanded="false" @click="openFilters = !openFilters">
                            <svg class="mr-2 h-5 w-5 flex-none text-gray-400 group-hover:text-gray-500"
                                aria-hidden="true" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M2.628 1.601C5.028 1.206 7.49 1 10 1s4.973.206 7.372.601a.75.75 0 01.628.74v2.288a2.25 2.25 0 01-.659 1.59l-4.682 4.683a2.25 2.25 0 00-.659 1.59v3.037c0 .684-.31 1.33-.844 1.757l-1.937 1.55A.75.75 0 018 18.25v-5.757a2.25 2.25 0 00-.659-1.591L2.659 6.22A2.25 2.25 0 012 4.629V2.34a.75.75 0 01.628-.74z"
                                    clip-rule="evenodd" />
                            </svg>
                            {{ !$countFilters ? 'Filtros' : $countFilters . ' Filtros' }}
                        </button>
                    </div>
                    <div class="pl-6">
                        <button type="button" class="text-gray-500 text-sm" wire:click="resetFilters">Limpiar
                            filtros</button>
                    </div>



                </div>
                <!-- Sorting -->
                <div class="sm:hidden col-span-1 py-4">
                    <div class="mx-auto flex items-center max-w-screen-2xl justify-end px-4 sm:px-6 lg:px-8">



                        <div class="relative inline-block" x-data="{ open: false }" @click.away="open = false"
                            @close.stop="open = false">
                            <div class="flex">
                                <button type="button"
                                    class="group inline-flex justify-center text-sm font-medium text-gray-700 hover:text-gray-900"
                                    id="menu-button" aria-expanded="false" aria-haspopup="true" @click="open = !open"
                                    aria-controls="menu" aria-label="Filters">
                                    Ordenar
                                    <svg class="-mr-1 ml-1 h-5 w-5 flex-shrink-0 text-gray-400 group-hover:text-gray-500"
                                        viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd"
                                            d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </div>

                            <div class="absolute right-0 z-10 mt-2 w-40 origin-top-right rounded-md bg-white shadow-2xl ring-1 ring-black ring-opacity-5 focus:outline-none"
                                role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1"
                                x-show="open" x-transition:enter="transition ease-out duration-100"
                                x-transition:enter-start="transform opacity-0 scale-95"
                                x-transition:enter-end="transform opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-75"
                                x-transition:leave-start="transform opacity-100 scale-100"
                                x-transition:leave-end="transform opacity-0 scale-95" x-cloak>

                                <div class="py-1" role="none">
                                    <a class="block px-4 py-2 text-sm text-gray-500 hover:bg-gray-100 hover:text-gray-900 {{ $sort === 'newest' ? 'font-medium text-gray-900' : '' }}"
                                        role="menuitem" tabindex="-1" id="menu-item-0"
                                        wire:click="updateSort('newest')">Más
                                        recientes</a>
                                    <a class="block px-4 py-2 text-sm text-gray-500 hover:bg-gray-100 hover:text-gray-900 {{ $sort === 'oldest' ? 'font-medium text-gray-900' : '' }}"
                                        role="menuitem" tabindex="-1" id="menu-item-1"
                                        wire:click="updateSort('oldest')">Más
                                        antiguos</a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>

            <!-- Centro: Input de Búsqueda -->
            <div class="relative col-span-1 py-2 hidden sm:block">
                <div class="w-full">
                    <input type="text" wire:model.live.debounce.500ms="searchTerm"
                        class="bg-transparent block w-full border-0 border-b border-slate-300 focus:border-slate-400 focus:ring-0 sm:text-sm"
                        placeholder="Buscar..." />
                </div>
            </div>

            <div class="hidden sm:block col-span-1 py-4">
                <div class="mx-auto flex items-center max-w-screen-2xl justify-end px-4 sm:px-6 lg:px-8">



                    <div class="relative inline-block" x-data="{ open: false }" @click.away="open = false"
                        @close.stop="open = false">
                        <div class="flex">
                            <button type="button"
                                class="group inline-flex justify-center text-sm font-medium text-gray-700 hover:text-gray-900"
                                id="menu-button" aria-expanded="false" aria-haspopup="true" @click="open = !open"
                                aria-controls="menu" aria-label="Filters">
                                Ordenar
                                <svg class="-mr-1 ml-1 h-5 w-5 flex-shrink-0 text-gray-400 group-hover:text-gray-500"
                                    viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd"
                                        d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>
                        </div>

                        <div class="absolute right-0 z-10 mt-2 w-40 origin-top-right rounded-md bg-white shadow-2xl ring-1 ring-black ring-opacity-5 focus:outline-none"
                            role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1"
                            x-show="open" x-transition:enter="transition ease-out duration-100"
                            x-transition:enter-start="transform opacity-0 scale-95"
                            x-transition:enter-end="transform opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-75"
                            x-transition:leave-start="transform opacity-100 scale-100"
                            x-transition:leave-end="transform opacity-0 scale-95" x-cloak>

                            <div class="py-1" role="none">
                                <a class="block px-4 py-2 text-sm text-gray-500 hover:bg-gray-100 hover:text-gray-900 {{ $sort === 'newest' ? 'font-medium text-gray-900' : '' }}"
                                    role="menuitem" tabindex="-1" id="menu-item-0"
                                    wire:click="updateSort('newest')">Más
                                    recientes</a>
                                <a class="block px-4 py-2 text-sm text-gray-500 hover:bg-gray-100 hover:text-gray-900 {{ $sort === 'oldest' ? 'font-medium text-gray-900' : '' }}"
                                    role="menuitem" tabindex="-1" id="menu-item-1"
                                    wire:click="updateSort('oldest')">Más
                                    antiguos</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>


        </div>

        <div class="border-t border-gray-200 md:py-10 py-5 col-span-3 bg-white shadow-sm" id="disclosure-1"
            x-show="openFilters" x-transition:enter="transition ease-out duration-100"
            x-transition:enter-start="transform opacity-0 scale-95"
            x-transition:enter-end="transform opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-75"
            x-transition:leave-start="transform opacity-100 scale-100"
            x-transition:leave-end="transform opacity-0 scale-95" x-cloak>
            <div
                class="mx-auto grid max-w-screen-2xl grid-cols-1 lg:grid-cols-2 gap-y-4 lg:gap-x-6 px-4 text-sm sm:px-6 lg:px-8">
                <!-- First Row -->
                <div class="grid auto-rows-min grid-cols-1 md:gap-y-10 gap-y-4 md:grid-cols-2 md:gap-x-6">
                    <!-- Zones -->
                    <fieldset>
                        <legend class="block font-medium">Zonas</legend>
                        <div class="space-y-4 pt-2">
                            <livewire:components.select-general :selectedValue="$selectedZone" :values="$zones" :imageValue="false"
                                :searchEnabled="true" :name="'zones'" :model="true">
                        </div>
                    </fieldset>
                    <!-- Date Picker -->
                    <fieldset>
                        <legend class="block font-medium">Fecha</legend>
                        <div class="space-y-4 pt-2">
                            <livewire:components.date-picker :defaultRange="'Año actual'" :rangeOptions="[
                                'Último mes',
                                'Hoy',
                                'Anteriores 7 días',
                                'Anteriores 15 días',
                                'Anteriores 30 días',
                                'Mes actual',
                                'Año actual',
                            ]" />
                        </div>
                    </fieldset>
                </div>
                <!-- Second Row -->
                <div class="grid auto-rows-min grid-cols-1 md:gap-y-10 gap-y-4 md:grid-cols-2 md:gap-x-6">
                    <!-- Users -->
                    <fieldset>
                        <legend class="block font-medium">Usuarios</legend>
                        <div class="space-y-4 pt-2">
                            <livewire:components.select-general :selectedValue="$selectedUser" :values="$users" :imageValue="false"
                                :searchEnabled="false" :name="'users'" :model="false">
                        </div>
                    </fieldset>
                    <!-- Status -->
                    <fieldset>
                        <legend class="block font-medium">Estado</legend>
                        <div class="space-y-4 pt-2">
                            <livewire:components.select-general :selectedValue="$selectedStatus" :values="$statuses" :imageValue="false"
                                :searchEnabled="false" :name="'statuses'" :model="false">
                        </div>
                    </fieldset>
                </div>
                <!-- Third Row -->
                <div class="grid auto-rows-min grid-cols-1 md:gap-y-10 gap-y-4 md:grid-cols-2 md:gap-x-6">
                    <!-- Property Types -->
                    <fieldset>
                        <legend class="block font-medium">Tipo de Propiedad</legend>
                        <div class="space-y-4 pt-2">
                            <livewire:components.select-general :selectedValue="$selectedPropertyType" :values="$propertyTypes" :imageValue="false"
                                :searchEnabled="false" :name="'propertyTypes'" :model="false">
                        </div>
                    </fieldset>
                    <!-- Sources -->
                    <fieldset>
                        <legend class="block font-medium">Fuente</legend>
                        <div class="space-y-4 pt-2">
                            <livewire:components.select-general :selectedValue="$selectedSource" :values="$sources" :imageValue="false"
                                :searchEnabled="false" :name="'sources'" :model="false">
                        </div>
                    </fieldset>
                </div>
            </div>
        </div>


    </section>




    <div class="mx-auto max-w-screen-2xl md:px-6 lg:px-8">
        <div class="mt-1 flow-root">
            <div class="overflow-x-auto">
                <div class="inline-block min-w-full py-6 align-middle md:px-6 lg:px-8">
                    <table
                        class="min-w-full divide-y divide-gray-300 bg-white ring-1 ring-black ring-opacity-5 md:rounded-lg md:shadow">
                        <thead>
                            <tr>
                                <th scope="col"
                                    class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                                    Fecha
                                </th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                    Hora
                                </th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                    Nombre
                                </th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                    Servicios
                                </th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                    Teléfono
                                </th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                    Zona
                                </th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                    Presupuesto
                                </th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                    Contacto
                                </th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                    Estado
                                </th>
                                <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                    <span class="sr-only">Editar</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse ($this->leads as $lead)
                                <tr wire:key="{{ $lead->id }}">
                                    <!-- Fecha -->
                                    <td class="py-3 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">
                                        {{ Carbon\Carbon::parse($lead->date)->format('d/m/Y') }}
                                    </td>
                                    <!-- Hora -->
                                    <td class="px-3 py-3 text-sm text-gray-500">
                                        {{ Carbon\Carbon::parse($lead->time)->format('H:i') }}
                                    </td>
                                    <!-- Nombre -->
                                    <td class="px-3 py-3 text-sm text-gray-500">
                                        {{ $lead->full_name }}
                                    </td>
                                    <!-- Servicios -->
                                    <td class="px-3 py-3 text-sm text-gray-500">
                                        @if ($lead->service)
                                            <span
                                                class="inline-flex items-center gap-x-1.5 rounded-md bg-gray-100 px-2 py-1 text-xs font-medium text-gray-600">
                                                <svg class="h-1.5 w-1.5 fill-gray-400" viewBox="0 0 6 6"
                                                    aria-hidden="true">
                                                    <circle cx="3" cy="3" r="3" />
                                                </svg>
                                                {{ $lead->service->name }}
                                            </span>
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <!-- Teléfono -->
                                    <td class="px-3 py-3 text-sm text-gray-500">
                                        @if ($lead->phone)
                                            <span
                                                class="inline-flex items-center rounded-md bg-blue-100 px-2 py-1 text-xs font-medium text-blue-700">
                                                {{ $lead->phone }}
                                            </span>
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <!-- Zona -->
                                    <td class="px-3 py-3 text-sm text-gray-500 has-tooltip">
                                        <span class="tooltip">{{ $lead->city ? $lead->city->name : 'N/A' }}</span>
                                        {{ $lead->neighborhood ? $lead->neighborhood->name : 'N/A' }}
                                    </td>

                                    
                                    <!-- Presupuesto column -->
                                    <td class="px-3 py-3 text-sm text-gray-500">
                                        @if ($lead->budget)
                                            <a href="#" class="text-indigo-600 hover:text-indigo-900">Ver</a>
                                        @else
                                            <a href="{{ route('panel.budget.add', $lead->id) }}"
                                                class="text-indigo-600 hover:text-indigo-900">Crear</a>
                                        @endif
                                    </td>
                                    <!-- Contacto -->
                                    <td class="px-3 py-3 text-sm ">
                                        {{-- @dump($lead->contact_badge_classes, $lead->contact_fill_classes) --}}
                                        <span
                                            class="inline-flex items-center gap-x-1.5 rounded-md {{ $lead->contact_badge_classes }} px-1.5 py-0.5 text-xs font-medium">
                                            <svg class="h-1.5 w-1.5 {{ $lead->contact_badge_fill_classes }}"
                                                viewBox="0 0 6 6" aria-hidden="true" fill="currentColor">
                                                <circle cx="3" cy="3" r="3" />
                                            </svg>
                                            {{ $lead->type_contact }}
                                        </span>
                                    </td>



                                    <!-- Estado -->
                                    <td class="px-3 py-3 text-sm">
                                        <span
                                            class="inline-flex items-center gap-x-1.5 rounded-md {{ $lead->status_badge_classes }} px-1.5 py-0.5 text-xs font-medium">
                                            <svg class="h-1.5 w-1.5 {{ $lead->status_badge_fill_classes }}"
                                                viewBox="0 0 6 6" aria-hidden="true">
                                                <circle cx="3" cy="3" r="3" fill="currentColor" />

                                            </svg>
                                            {{ $lead->status }}
                                        </span>
                                    </td>
                                    <!-- Editar -->
                                    <td
                                        class="relative whitespace-nowrap py-3 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                        <a href="{{ route('panel.leads.edit', $lead->id) }}"
                                            class="text-indigo-600 hover:text-indigo-900">Editar</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="py-6 px-4 sm:px-8">
                                        <div class="rounded-md bg-yellow-50 p-4">
                                            <div class="text-sm font-medium text-yellow-700 text-center">
                                                <p>No se encontraron clientes potenciales.</p>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="pb-6 px-4 sm:px-8">
            {{ $this->leads->links(data: ['scrollTo' => false]) }}
        </div>
    </div>
</div>
