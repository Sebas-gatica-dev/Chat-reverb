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
                <div class="items-center sm:flex md:ml-4 md:mt-0 justify-end text-sm">
                    <a wire:navigate href="{{ route('panel.leads.add') }}"
                        class="ml-3 inline-flex items-center rounded-md bg-gradient-to-t from-violet-800 to-purple-700 hover:from-purple-600 hover:to-purple-700 px-2 py-1.5 sm:px-3 sm:py-2 text-[0.8em] sm:text-sm font-semibold text-white shadow-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 ">
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
                            <livewire:components.date-picker :defaultRange="'Mes actual'" :rangeOptions="[
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

                <!-- Four Row -->
                <div class="grid auto-rows-min grid-cols-1 md:gap-y-10 gap-y-4 md:grid-cols-2 md:gap-x-6">


                    <fieldset>
                        <legend class="block font-medium">Tipo de contacto</legend>
                        <div class="space-y-4 pt-2">
                            <livewire:components.select-general :selectedValue="$selectedPropertyType" :values="$type_contacts" :imageValue="false"
                                :searchEnabled="false" :name="'type-contact'" :model="false">
                        </div>
                    </fieldset>


                </div>




            </div>
        </div>


    </section>


    <!-- Estadísticas -->
    <div class="mx-auto max-w-screen-2xl px-4 pt-6 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
            <!-- Total Leads Card -->
            <div class="bg-white shadow rounded-lg p-4">
                <div class="text-sm font-medium text-gray-500">Total de Leads</div>
                <div class="mt-1 text-3xl font-semibold text-gray-900">{{ $this->leads->total() }}</div>
            </div>
            <!-- Average Budget Card -->
            <div class="bg-white shadow rounded-lg p-4">
                <div class="text-sm font-medium text-gray-500">Media de Presupuestos</div>
                <div class="mt-1 text-3xl font-semibold text-gray-900">
                    ${{ number_format($this->averageBudget, 2, ',', '.') }}
                </div>
            </div>
            <!-- Effectiveness % Card -->
            <div class="bg-white shadow rounded-lg p-4">
                <div class="text-sm font-medium text-gray-500">Efectividad %</div>
                <div class="mt-1 text-3xl font-semibold text-gray-900">{{ $this->effectivenessPercentage }}%</div>
            </div>
            <!-- Today's Leads Card -->
            <div class="bg-white shadow rounded-lg p-4">
                <div class="text-sm font-medium text-gray-500">Leads de Hoy</div>
                <div class="mt-1 text-3xl font-semibold text-gray-900">{{ $this->leadsToday }}</div>
            </div>
        </div>
    </div>





    <div class="mx-auto max-w-screen-2xl">
        <div class="flow-root">
            <div class="overflow-x-auto">
                <div class="inline-block min-w-full pt-6 align-middle md:px-6 lg:px-8">
                    <table
                        class="min-w-full divide-y divide-gray-300 bg-white ring-1 ring-black ring-opacity-5 md:rounded-lg md:shadow">
                        <thead>
                            <tr>
                                <th scope="col" class="w-8 py-3.5 pl-4 pr-3 sm:pl-6">
                                    <!-- Espacio para el botón -->
                                </th>
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

                            @if ($this->leads->total() > 0)

                                @foreach ($this->leads as $lead)
                        <tbody x-data="{ open: false }" wire:key="{{ $lead->id }}">

                            <tr wire:key="{{ $lead->id }}">

                                <td class="py-3 pl-4 pr-3 text-sm sm:pl-6">
                                    <button @click="open = !open"
                                        class="text-gray-500 hover:text-gray-700 focus:outline-none">
                                        <svg :class="{ 'rotate-180': open }"
                                            class="w-5 h-5 transform transition-transform duration-200"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </button>
                                </td>

                                <!-- Fecha -->
                                <td class="py-3 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">
                                    {{ Carbon\Carbon::parse($lead->date_lead)->format('d/m/Y') }}
                                </td>
                                <!-- Hora -->
                                <td class="px-3 py-3 text-sm text-gray-500">
                                    {{ Carbon\Carbon::parse($lead->time_lead)->format('H:i') }}
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

                                    @if ($lead->firstPhone)
                                        <span
                                            class="inline-flex items-center rounded-md bg-blue-100 px-2 py-1 text-xs font-medium text-blue-700">
                                            {{ $lead->firstPhone->number }}
                                        </span>
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <!-- Zona -->
                                <td class="px-3 py-3 text-sm text-gray-500 has-tooltip">

                                    <span
                                        class="tooltip">{{ !is_null($lead->firstProperty) ? ($lead->firstProperty->city ? $lead->firstProperty->city->name : 'N/A') : 'N/A' }}</span>
                                    {{ !is_null($lead->firstProperty) ? ($lead->firstProperty->neighborhood ? $lead->firstProperty->neighborhood->name : 'N/A') : 'N/A' }}
                                </td>

                                <!-- Presupuesto column -->
                                <td class="px-3 py-3 text-sm text-gray-500">

                                    @if ($lead->budget)
                                        <div class="flex items-center gap-x-1">

                                            <div class="text-center mt-1"
                                                {{ $lead->budget->status == App\Enums\StatusBudgetEnum::GENERATING ? ' wire:poll=checkBudgetStatus() ' : '' }}>

                                                @if ($lead->budget->status == App\Enums\StatusBudgetEnum::GENERATING)
                                                    <x-spinner>
                                                        Generando
                                                    </x-spinner>
                                                @elseif ($lead->budget->pdfExists())
                                                    <div class="inline-flex items-center space-x-2">

                                                        <div class="relative inline-flex has-tooltip">
                                                            <a target="_blank"
                                                                href="{{ $lead->budget->getPdfUrl() }}"
                                                                class="rounded-md 
                                                                sm:text-xs
                                                                cursor-pointer bg-green-800 py-1 px-2 border border-transparent text-center text-white transition-all shadow-md hover:shadow-lg focus:bg-green-700 focus:shadow-none active:bg-green-700 hover:bg-green-700 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none
                                                               ">
                                                                @if ($lead->budget->iva)
                                                                    <span class="text-xs">${{ number_format($lead->budget->total + $lead->budget->total * 0.21, 0, ',', '.') }}</span>
                                                                @else
                                                                    <span class="text-xs">${{ number_format($lead->budget->total, 0, ',', '.') }}</span>
                                                                @endif

                                                            </a>
                                                            {{-- <span
                                                                class="absolute top-0.5 right-0.5 grid min-h-[5px] min-w-[5px] translate-x-2/4 -translate-y-2/4 place-items-center rounded-full bg-green-600 py-1 px-1 text-xs text-white border border-white">
                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                    viewBox="0 0 16 16" fill="currentColor"
                                                                    class="w-2 h-2">
                                                                    <path fill-rule="evenodd"
                                                                        d="M12.416 3.376a.75.75 0 0 1 .208 1.04l-5 7.5a.75.75 0 0 1-1.154.114l-3-3a.75.75 0 0 1 1.06-1.06l2.353 2.353 4.493-6.74a.75.75 0 0 1 1.04-.207Z"
                                                                        clip-rule="evenodd" />
                                                                </svg>
                                                            </span> --}}
                                                            <span class="tooltip">Ver presupuesto</span>
                                                        </div>

                                                        <div>
                                                        <a href="{{ route('panel.leads.add', $lead->id) }}?paso=6"
                                                            class="mb-1" wire:navigate>
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                viewBox="0 0 24 24" stroke-width="1.5"
                                                                stroke="currentColor" class="size-6">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                                            </svg>
                                                        </a>
                                                    </div>
                                                    </div>
                                                @else
                                                    <div class="inline-flex items-center space-x-2">

                                                        <div class="relative inline-flex has-tooltip">
                                                            <button wire:click.prevent="generatePdf('{{ $lead->budget->id }}' )""
                                                                class="rounded-md 
                                                                sm:text-xs
                                                                cursor-pointer bg-yellow-800 py-1 px-2 border border-transparent text-center text-white transition-all shadow-md hover:shadow-lg focus:bg-yellow-700 focus:shadow-none active:bg-yellow-700 hover:bg-yellow-700 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none
                                                               ">
                                                                @if ($lead->budget->iva)
                                                                    <span class="text-xs">${{ number_format($lead->budget->total + $lead->budget->total * 0.21, 0, ',', '.') }}</span>
                                                                @else
                                                                    <span class="text-xs">${{ number_format($lead->budget->total, 0, ',', '.') }}</span>
                                                                @endif

                                                            </button>

                                                            <span class="tooltip">Generar presupuesto</span>
                                                        </div>

                                                        <div>
                                                        <a href="{{ route('panel.leads.add', $lead->id) }}?paso=6"
                                                            class="mb-1" wire:navigate>
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                viewBox="0 0 24 24" stroke-width="1.5"
                                                                stroke="currentColor" class="size-6">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                                            </svg>
                                                            
                                                        </a>

                                                    </div>
                                                @endif

                                            </div>

                                        </div>
                                    @else
                                        <a href="{{ route('panel.leads.add', $lead->id) }}?paso=6"
                                            class="rounded-md 
                                            sm:text-xs
                                            cursor-pointer bg-gray-800 py-1 px-3 border border-transparent text-center text-white transition-all shadow-md hover:shadow-lg focus:bg-gray-700 focus:shadow-none active:bg-gray-700 hover:bg-gray-700 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none
                                           ">
                                            Crear
                                        </a>
                                    @endif
                                </td>
                                <!-- Contacto -->
                                <td class="px-3 py-3 text-sm ">

                                    {{-- @dump($lead->contact_badge_classes, $lead->contact_fill_classes) --}}
                                    <span
                                        class="inline-flex items-center gap-x-1.5 rounded-md {{ $lead->type_contact->getBadgeClasses() }} px-1.5 py-0.5 text-xs font-medium">
                                        <svg class="h-1.5 w-1.5 {{ $lead->type_contact->getBadgeFillClasses() }}"
                                            viewBox="0 0 6 6" aria-hidden="true" fill="currentColor">
                                            <circle cx="3" cy="3" r="3" />
                                        </svg>
                                        {{ $lead->type_contact->getName() }}
                                    </span>
                                </td>

                                <!-- Estado -->
                                <td class="px-3 py-3 text-sm">
                                    <span
                                        class="inline-flex items-center gap-x-1.5 rounded-md {{ $lead->status->getBadgeClasses() }} px-1.5 py-0.5 text-xs font-medium">
                                        <svg class="h-1.5 w-1.5 {{ $lead->status->getBadgeFillClasses() }}"
                                            viewBox="0 0 6 6" aria-hidden="true">
                                            <circle cx="3" cy="3" r="3" fill="currentColor" />

                                        </svg>
                                        {{ $lead->status->getName() }}
                                    </span>
                                </td>
                                <!-- Editar -->
                                <td
                                    class="relative whitespace-nowrap py-3 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                    <a href="{{ route('panel.leads.add', $lead->id) }}"
                                        class="text-indigo-600 hover:text-indigo-900">Editar</a>
                                </td>
                            </tr>

                            <!-- Información adicional del lead -->

                            <tr x-show="open" wire:key="{{ $lead->id }}" x-cloak>
                                {{-- <td colspan="1" class="bg-gray-50">
                                </td> --}}
                                <td colspan="11" class="bg-gray-50 px-16 border-t border-t-gray-200">


                                    {{-- <div class="py-6 align-middle md:px-6 lg:px-8"> --}}
                                    <div class="p-4">
                                        <!-- Información adicional del lead -->
                                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                                            <div class="inline-flex text-center items-center gap-x-1">


                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                    class="size-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M12 21a9.004 9.004 0 0 0 8.716-6.747M12 21a9.004 9.004 0 0 1-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 0 1 7.843 4.582M12 3a8.997 8.997 0 0 0-7.843 4.582m15.686 0A11.953 11.953 0 0 1 12 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0 1 21 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0 1 12 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 0 1 3 12c0-1.605.42-3.113 1.157-4.418" />
                                                </svg>


                                                <p class="text-sm">

                                                    {{ $lead->source ? $lead->source->getName() : 'N/A' }}

                                                </p>
                                            </div>


                                            <div class="inline-flex text-center items-center gap-x-1">

                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                    class="size-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M16.5 12a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0Zm0 0c0 1.657 1.007 3 2.25 3S21 13.657 21 12a9 9 0 1 0-2.636 6.364M16.5 12V8.25" />
                                                </svg>




                                                <p class="text-sm">Correo: {{ $lead->email ?? 'N/A' }}</p>

                                            </div>

                                            <div class="inline-flex text-center items-center gap-x-1">
                                                <svg class="size-5 " stroke="currentColor"
                                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M337.8 14.8C341.5 5.8 350.3 0 360 0H472c13.3 0 24 10.7 24 24V136c0 9.7-5.8 18.5-14.8 22.2s-19.3 1.7-26.2-5.2l-39-39-24.7 24.7C407 163.3 416 192.6 416 224c0 80.2-59.1 146.7-136.1 158.2c0 .6 .1 1.2 .1 1.8v.4 .4 .4 .4 .4 .4 .4 .4 .4 .4 .4 .4 .4 .4 .4 .4 .4 .4 .4 .4 .4 .4 .4 .4 .4 .4 .4 .4 .4 .4 .3 .4 .3 .3 .3 .3 .3 .3 .3 .3 .3 .3 .3 .3 .3 .3 .3 .3 .3 .3 .3 .3 .3 .3 .3 .3 .3 .3 .3 .3 .3 .3 .3 .3 .3 .3 .3 .3 .3h24c13.3 0 24 10.7 24 24s-10.7 24-24 24H280v.2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .1 .1 .1 .1 .1 .1 .1 .1 .1 .1 .1 .1 .1 .1 .1 .1 .1 .1 .1 .1 .1 .1 .1 .1 .1 .1 .1 .1 .1 .1 .1 .1 .1 .1 .1 .1 .1 .1 .1 .1 .1 .1 .1 .1 .1 .1 .1 .1 .1 .1 .1 .1 .1 .1 .1 .1 .1 .1 .1 .1 .1 .1 .1 .1 .1 .1 .1 .1 .1 .1 .1 .1 .1 .1 .1 .1 .1 .1 .1 .1 .1 .1 .1 .1 .1 .1 .1 .1 .1 .1 .1 .1 .1 .1 .1 .1 .1 .1 .1 .1 .1 .1 .1 .1 .1 .1 .1 .1 .1 .1 .1 .1 .1 .1 .1 .1 .1 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0l-24 0-24 0v0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0-.1-.1-.1-.1-.1-.1-.1-.1-.1-.1V486 486v-.1-.1-.1-.1-.1-.1-.1-.1-.1-.1-.1-.1-.1V485 485v-.1-.1-.1-.1-.1-.1-.1-.1-.1-.1-.1V484v-.1-.1-.1-.1-.1-.1-.1-.1-.1-.1V483v-.1-.1-.1-.1-.1-.1-.1-.1-.1-.1-.1-.1-.1-.1-.1-.1-.1-.1-.1V481v-.1-.1-.1-.1-.1-.1-.1-.1V480v-.1-.1-.1-.1-.1-.1-.1V479v-.1-.1-.1-.1-.1-.1-.1V478v-.1-.1-.1-.1-.1-.1V477v-.1-.1-.1-.1-.1-.1V476v-.1-.1-.1-.1-.1-.1V475v-.1-.2-.2-.2-.2-.2V474v-.2-.2-.2-.2-.2V473v-.2-.2-.2-.2-.2-.2-.2-.2-.2-.2-.2-.2-.2-.2-.2-.2-.2V470v-.2-.2-.2-.2-.2V469v-.2-.2-.2-.2-.2-.2-.2-.2-.2-.2V467v-.2-.2-.2-.2-.2-.2-.2-.2-.2-.2-.2-.2-.2-.2-.2-.2-.2-.2-.2-.2V463v-.2-.2-.2-.2-.2-.2-.2-.2-.2-.2-.2-.2-.2-.2-.2-.2-.2-.2V459v-.2-.2-.2-.2-.2-.2-.2-.2V457v-.2-.2-.2-.2V456H208c-13.3 0-24-10.7-24-24s10.7-24 24-24h24v-.3-.3-.3-.3-.3-.3-.3-.3-.3-.3-.3-.3-.3-.3V403v-.3-.3V402v-.3-.3V401v-.3-.3V400v-.3-.3-.3-.3-.3-.3-.3-.3-.3-.3-.3-.3-.3-.4-.3-.4-.4-.4-.4V393v-.4-.4-.4-.4-.4-.4-.4-.4-.4-.4-.4-.4-.4V388v-.4-.4-.4-.4-.4-.4-.4-.4-.4-.4V384c0-.6 0-1.2 .1-1.8C155.1 370.7 96 304.2 96 224c0-88.4 71.6-160 160-160c39.6 0 75.9 14.4 103.8 38.2L382.1 80 343 41c-6.9-6.9-8.9-17.2-5.2-26.2zM448 48l0 0h0v0zM256 488h24c0 13.3-10.7 24-24 24s-24-10.7-24-24h24zm96-264a96 96 0 1 0 -192 0 96 96 0 1 0 192 0z">
                                                    </path>
                                                </svg>



                                                <p class="text-sm">
                                                    {{ $lead->gender == 'male' ? 'Masculino' : 'Femenino' }}</p>
                                            </div>

                                            <div class="inline-flex text-center items-center gap-x-1">

                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                    class="size-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M8.25 21v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21m0 0h4.5V3.545M12.75 21h7.5V10.75M2.25 21h1.5m18 0h-18M2.25 9l4.5-1.636M18.75 3l-1.5.545m0 6.205 3 1m1.5.5-1.5-.5M6.75 7.364V3h-3v18m3-13.636 10.5-3.819" />
                                                </svg>


                                                <p class="text-sm ">
                                                    {{ $lead->firstProperty->propertyType->name ?? 'N/A' }}</p>
                                            </div>

                                            <div class="inline-flex text-center items-center gap-x-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                    class="size-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                                </svg>

                                                <p class="text-sm ">Cliente:
                                                    {{ $lead->name ?? 'N/A' }}</p>
                                            </div>

                                            <div class="inline-flex text-center items-center gap-x-1">

                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                    class="size-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                                </svg>


                                                <p class="text-sm ">Vendedor:
                                                    {{ $lead->createdBy->name ?? 'N/A' }}</p>
                                            </div>

                                        </div>

                                        <!-- Sección de Actividad -->
                                        <div class="mt-6">
                                            <div wire:click="openActivityModal('{{ $lead->id }}')"
                                                class="py-1 cursor-pointer flex items-center justify-center hover:bg-gray-700 bg-gray-800 ring-1 ring-black ring-opacity-5 md:rounded-md md:shadow space-x-4">
                                                <h4 class="text-base font-semibold text-gray-50">Actividad</h4>



                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                    class="size-5 fill-gray-100 text-gray-800">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M12 10.5v6m3-3H9m4.06-7.19-2.12-2.12a1.5 1.5 0 0 0-1.061-.44H4.5A2.25 2.25 0 0 0 2.25 6v12a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9a2.25 2.25 0 0 0-2.25-2.25h-5.379a1.5 1.5 0 0 1-1.06-.44Z" />
                                                </svg>


                                            </div>

                                            <!-- Tabla de actividades -->
                                            <div class="overflow-x-auto mt-4 rounded-md shadow-sm">
                                                <table
                                                    class="min-w-full divide-y divide-gray-200
                                                bg-white ring-1 ring-gray-100 border border-gray-200 md:rounded-lg md:shadow
                                                
                                                ">
                                                    <thead>
                                                        <tr>
                                                            <th
                                                                class="px-4 py-2 text-left text-sm font-semibold text-gray-900">
                                                                Fecha</th>
                                                            <th
                                                                class="px-4 py-2 text-left text-sm font-semibold text-gray-900">
                                                                Hora</th>
                                                            <th
                                                                class="px-4 py-2 text-left text-sm font-semibold text-gray-900">
                                                                Usuario</th>
                                                            <th
                                                                class="px-4 py-2 text-left text-sm font-semibold text-gray-900">
                                                                Comentario</th>
                                                            <th
                                                                class="px-4 py-2 text-left text-sm font-semibold text-gray-900">
                                                                Tipo de contacto</th>
                                                            <th
                                                                class="px-4 py-2 text-left text-sm font-semibold text-gray-900">
                                                                Acciones</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="divide-y divide-gray-200">
                                                        @forelse ($lead->leadActivities as $activity)
                                                            <tr>
                                                                <td class="px-4 py-2 text-sm text-gray-500">
                                                                    {{ \Carbon\Carbon::parse($activity->date)->format('d/m/Y') }}
                                                                </td>
                                                                <td class="px-4 py-2 text-sm text-gray-500">
                                                                    {{ \Carbon\Carbon::parse($activity->time)->format('H:i') }}
                                                                </td>
                                                                <td class="px-4 py-2 text-sm text-gray-500">
                                                                    {{ $activity->user->name }}</td>
                                                                <td class="px-4 py-2 text-sm text-gray-500">
                                                                    {{ $activity->comment }}</td>
                                                                <td class="px-4 py-2 text-sm text-gray-500">


                                                                    <span
                                                                        class="inline-flex items-center gap-x-1.5 rounded-md {{ $activity->type_contact->getBadgeClasses() }} px-1.5 py-0.5 text-xs font-medium">
                                                                        <svg class="h-1.5 w-1.5 {{ $activity->type_contact->getBadgeFillClasses() }}"
                                                                            viewBox="0 0 6 6" aria-hidden="true"
                                                                            fill="currentColor">
                                                                            <circle cx="3" cy="3"
                                                                                r="3" />
                                                                        </svg>
                                                                        {{ $activity->type_contact->getName() }}
                                                                    </span>



                                                                    {{-- {{ $activity->type_contact->getName() }} --}}

                                                                </td>
                                                                <td class="px-4 py-2 text-sm text-gray-500">
                                                                    @if (!$activity->is_initial)
                                                                        <div class="inline-flex space-x-2">
                                                                            <button
                                                                                wire:click="editActivity('{{ $activity->id }}')"
                                                                                class="text-indigo-600 hover:text-indigo-900">
                                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                                    fill="none" viewBox="0 0 24 24"
                                                                                    stroke-width="1.5"
                                                                                    stroke="currentColor"
                                                                                    class="size-5">
                                                                                    <path stroke-linecap="round"
                                                                                        stroke-linejoin="round"
                                                                                        d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                                                                </svg>

                                                                            </button>

                                                                            <button
                                                                                wire:click="deleteActivity('{{ $activity->id }}')"
                                                                                class="text-red-600 hover:text-red-900">
                                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                                    fill="none" viewBox="0 0 24 24"
                                                                                    stroke-width="1.5"
                                                                                    stroke="currentColor"
                                                                                    class="size-5">
                                                                                    <path stroke-linecap="round"
                                                                                        stroke-linejoin="round"
                                                                                        d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                                                                </svg>



                                                                            </button>
                                                                        </div>
                                                                    @else
                                                                        <span class="text-gray-400">N/A</span>
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                        @empty
                                                            <tr>
                                                                <td colspan="10" class="py-6 px-4 sm:px-8">
                                                                    <div class="rounded-md bg-yellow-50 p-4">
                                                                        <div
                                                                            class="text-sm font-medium text-yellow-700 text-center">
                                                                            <p>No se encontraron actividades.</p>
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
                                </td>
                            </tr>
                        </tbody>
                        @endforeach

                        </tbody>
                    @else
                        <tr>
                            <td colspan="10" class="py-6 px-4 sm:px-8">
                                <div class="rounded-md bg-yellow-50 p-4">
                                    <div class="text-sm font-medium text-yellow-700 text-center">
                                        <p>No se encontraron clientes potenciales.</p>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endif

                    </table>
                </div>
            </div>
        </div>

        <div class="pt-6 px-4 sm:px-8">
            {{ $this->leads->links(data: ['scrollTo' => false]) }}
        </div>
    </div>

    {{-- @dd($type_contacts) --}}

    <!-- Modal de Actividad -->
    <div x-data="{ showModal: @entangle('showActivityModal') }" x-cloak>
        <div x-show="showModal" class="fixed inset-0 z-50 flex items-center justify-center">
            <div class="fixed inset-0 bg-gray-900 opacity-50"></div>
            <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                        {{ $activityId ? 'Editar Actividad' : 'Agregar Actividad' }}
                    </h3>
                    <div class="mt-2">
                        <form>
                            <div class="mb-4">
                                <label for="activityTypeContact" class="block text-sm font-medium text-gray-700">Tipo
                                    de contacto</label>
                                <select wire:model="activityTypeContact" id="activityTypeContact"
                                    class="mt-1 block w-full text-sm">
                                    <option value="">Seleccione</option>

                                    @foreach ($type_contacts as $type)
                                        <option value="{{ $type['id'] }}">{{ $type['name'] }}</option>
                                    @endforeach
                                </select>
                                @error('activityTypeContact')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="activityComment"
                                    class="block text-sm font-medium text-gray-700">Detalle</label>
                                <textarea wire:model="activityComment" id="activityComment" rows="3" class="mt-1 block w-full text-sm"></textarea>
                                @error('activityComment')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </form>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button wire:click="saveActivity"
                        class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-gradient-to-t from-violet-800 to-purple-700 hover:from-purple-600 hover:to-purple-700 text-base font-medium text-white sm:ml-3 sm:w-auto sm:text-sm">
                        Guardar
                    </button>
                    <button @click="showModal = false"
                        class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 sm:mt-0 sm:w-auto sm:text-sm">
                        Cancelar
                    </button>
                </div>
            </div>
        </div>
    </div>



</div>
