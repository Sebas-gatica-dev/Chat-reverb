<div>

    <header class=" bg-white shadow">
        <div class="mx-auto max-w-screen-2xl px-4 py-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center">
                <div class="min-w-0 sm:flex-1">
                    <h1 class="items-center	text-[1em] sm:text-2xl sm:mt-2 font-bold tracking-tight text-gray-900">
                        Clientes</h1>
                </div>

                @can('access-function', 'customer-add')
                    <div class=" items-center sm:flex md:ml-4 md:mt-0 justify-end">

                        <a wire:navigate href="{{ route('panel.customers.add') }}"
                            class="ml-3 inline-flex items-center rounded-md bg-indigo-600 px-2 py-1.5 sm:px-3 sm:py-2 text-[0.8em] sm:text-sm font-semibold text-white shadow-sm hover:bg-indigo-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Agregar
                            cliente</a>
                    </div>
                @endcan
            </div>

        </div>

    </header>


    @can('access-function', 'customer-show-filters')
        <section aria-labelledby="filter-heading" class="grid items-center border-b border-t border-gray-200 bg-slate-100 "
            x-data="{ openFilters: false }">
            <h2 id="filter-heading" class="sr-only">Filters</h2>
            <div class="relative col-start-1 row-start-1 py-4">
                <div class="mx-auto flex max-w-screen-2xl space-x-6 divide-x divide-gray-200 px-4 text-sm sm:px-6 lg:px-8">
                    <div>
                        <button type="button" class="group flex items-center font-medium text-gray-700"
                            aria-controls="disclosure-1" aria-expanded="false" @click="openFilters = !openFilters">
                            <svg class="mr-2 h-5 w-5 flex-none text-gray-400 group-hover:text-gray-500" aria-hidden="true"
                                viewBox="0 0 20 20" fill="currentColor">
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
            </div>
            <div class="border-t border-gray-200 md:py-10 py-5 bg-white shadow-sm" id="disclosure-1" x-show="openFilters"
                x-transition:enter="transition ease-out duration-100"
                x-transition:enter-start="transform opacity-0 scale-95"
                x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75"
                x-transition:leave-start="transform opacity-100 scale-100"
                x-transition:leave-end="transform opacity-0 scale-95" x-cloak>
                <div
                    class="mx-auto grid max-w-screen-2xl grid-cols-1 lg:grid-cols-2 gap-y-4 lg:gap-x-6 px-4 text-sm sm:px-6 lg:px-8">
                    <div class="grid auto-rows-min grid-cols-1 md:gap-y-10 gap-y-4 md:grid-cols-2 md:gap-x-6">
                        <fieldset>
                            <legend class="block font-medium">Zonas</legend>
                            <div class="space-y-4 pt-2">

                                <livewire:components.select-general :selectedValue="$selectedZone" :values="$zones" :imageValue="false"
                                    :searchEnabled="true" :name="'zones'" :model="true">
                            </div>
                        </fieldset>
                        <fieldset>
                            <legend class="block font-medium">Tipo de propiedades</legend>
                            <div class="space-y-4 pt-2">
                                <livewire:components.select-general :selectedValue="$selectedPropertyType" :values="$propertyTypes" :imageValue="false"
                                    :searchEnabled="false" :name="'propertyTypes'" :model="false">
                            </div>
                        </fieldset>
                    </div>
                    <div class="grid auto-rows-min grid-cols-1 md:gap-y-10 gap-y-4 md:grid-cols-2 md:gap-x-6">
                        <fieldset>
                            <legend class="block font-medium">Frecuencias</legend>
                            <div class="space-y-4 pt-2">
                                <livewire:components.select-general :selectedValue="$selectedFrequency" :values="$frequencies" :imageValue="false"
                                    :searchEnabled="false" :name="'frequencies'" :model="false">
                            </div>
                        </fieldset>
                        <fieldset>
                            <legend class="block font-medium">Sucursales</legend>
                            <div class="space-y-4 pt-2">
                                <livewire:components.select-general :selectedValue="$selectedBranch" :values="$branches" :imageValue="false"
                                    :searchEnabled="false" :name="'branches'" :model="false">
                            </div>
                        </fieldset>
                    </div>
                </div>
            </div>

            <div class="col-start-1 row-start-1 py-4">
                <div class="mx-auto flex max-w-screen-2xl justify-end px-4 sm:px-6 lg:px-8">
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
                                <!--
                            Active: "bg-gray-100", Not Active: ""

                            Selected: "font-medium text-gray-900", Not Selected: "text-gray-500"
                        -->
                                <a class="block px-4 py-2 text-sm text-gray-500 hover:bg-gray-100 hover:text-gray-900 {{ $sort === 'newest' ? 'font-medium text-gray-900' : '' }}"
                                    role="menuitem" tabindex="-1" id="menu-item-0" wire:click="updateSort('newest')">Más
                                    recientes</a>
                                <a class="block px-4 py-2 text-sm text-gray-500 hover:bg-gray-100 hover:text-gray-900 {{ $sort === 'oldest' ? 'font-medium text-gray-900' : '' }}"
                                    role="menuitem" tabindex="-1" id="menu-item-1" wire:click="updateSort('oldest')">Más
                                    antiguos</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endcan

    <div class="mx-auto max-w-screen-2xl md:px-6 lg:px-8">

        <div class="mt-1 flow-root">

            <div class="inline-block min-w-full py-6 align-middle md:px-6 lg:px-8">

                <table
                    class="min-w-full divide-y divide-gray-300 bg-white ring-1 ring-black ring-opacity-5 md:rounded-lg
                    md:shadow">
                    {{-- <thead>
                            <tr>
                                <th scope="col"
                                    class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">

                                    <span class="sr-only">Nombre</span>
                                </th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                    <span class="sr-only">Propiedades</span>

                                </th>
                                <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-0">
                                    <span class="sr-only">Edit</span>
                                </th>
                            </tr>
                        </thead> --}}
                    <tbody x-data="{
                        screenWidth: window.innerWidth,
                        init() {
                            window.addEventListener('resize', () => {
                                this.screenWidth = window.innerWidth;
                            });
                        },
                        redirectIfSmall(url) {
                            if (this.screenWidth < 640) { // Tailwind sm breakpoint: 640px
                                window.location.href = url;
                            }
                        }
                    }" x-init="init()" class="divide-y divide-gray-200">

                        @forelse ($customers as $customer)

                            {{-- @dd($customer) --}}
                            <tr wire:key="{{ $customer->id }}"
                                @click="redirectIfSmall('{{ route('panel.customers.show', $customer) }}')">
                                <td class="whitespace-nowrap py-2 sm:py-5 pl-2 sm:pl-6 pr-3 text-sm ">
                                    <div class="flex gap-x-2 sm:gap-x-7">
                                        <div class="flex-shrink-0">
                                            <div class="relative h-10 w-16 sm:w-20 flex justify-center">
                                                @if ($customer->properties->count() == 0)
                                                    <img class="h-10 w-10 rounded-full"
                                                        src="https://ui-avatars.com/api/?name={{ $customer->name }}+{{ $customer->surname }}"
                                                        alt="">
                                                @elseif ($customer->properties->count() == 1)
                                                    <img class="h-10 w-10 rounded-full"
                                                        src="{{ $customer->properties->first()->photo }}"
                                                        alt="">
                                                @elseif($customer->properties->count() == 2)
                                                    @foreach ($customer->properties as $property)
                                                        <img class="absolute h-10 w-10 rounded-full border-2 border-white {{ $loop->first ? 'left-1 sm:left-2' : 'right-1 sm:right-2' }}"
                                                            src="{{ $property->photo }}" alt="">
                                                    @endforeach
                                                @else
                                                    @foreach ($customer->properties->take(3) as $property)
                                                        <img class="absolute h-10 w-10 rounded-full border-2 border-white
                                        {{ $loop->first ? 'left-0 sm:left-2' : ($loop->last ? 'right-3 sm:right-4' : 'left-6 sm:left-9') }}"
                                                            src="{{ $property->photo }}" alt="">
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                        <div class="flex-auto">
                                            <div class="flex items-start gap-x-3">
                                                <div class="text-sm font-medium leading-6 text-gray-900">
                                                    {{ $customer->name }} {{ $customer->surname }}
                                                    {{-- Bullet for mobile view --}}
                                                    <span class="inline-block w-2 h-2 rounded-full ml-2 sm:hidden"
                                                        style="background-color: {{ $this->getLastVisitStatus($customer) }}; opacity: 0.6;">
                                                    </span>
                                                </div>
                                                {{-- Remove bullet for desktop view --}}
                                                @if ($customer->properties->count() == 1)
                                                    <div
                                                        class="rounded-md py-[1px] px-[3px] text-[10px] hidden sm:block sm:py-1 sm:px-2 sm:text-xs sm:font-medium ring-1 ring-inset text-orange-700 bg-orange-50 ring-orange-600/20">
                                                        {{ App\Enums\FrequencyEnum::getFrequency($customer->properties->first()->frequency) }}
                                                    </div>
                                                @endif
                                            </div>
                                            <div
                                                class="mt-1 text-xs leading-5 text-gray-500 lg:flex items-start gap-x-3 hidden">
                                                @if ($customer->properties->count() == 1)
                                                    Visita realizada el 22 de marzo
                                                @else
                                                    Este cliente todavía no tiene visitas cargadas
                                                @endif
                                            </div>
                                            <div
                                                class="mt-1 text-xs leading-5 text-gray-500 flex items-start gap-x-3 sm:flex md:flex lg:hidden">
                                                <x-property-address :customer="$customer" />
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td
                                    class="whitespace-nowrap px-3 py-5 text-sm text-gray-500 hidden sm:hidden md:hidden lg:block">
                                    <x-property-address :customer="$customer" />
                                </td>
                                <td
                                    class="relative whitespace-nowrap py-1 sm:py-5 sm:pl-3 pr-6 text-right text-sm font-medium">
                                    <div class="hidden sm:inline">
                                        <div class="flex justify-end">
                                            @if ($customer->properties->count() > 0)
                                                @can('access-function', 'property-show')
                                                    <a href="{{ route('panel.customers.show', $customer) }}" wire:navigate
                                                        class="text-sm font-medium leading-6 text-indigo-600 hover:text-indigo-500">
                                                        Ver
                                                        {{ $customer->properties->count() == 1 ? 'propiedad' : 'propiedades' }}
                                                    </a>
                                                @endcan
                                            @else
                                                @can('access-function', 'property-add')
                                                    <a href="{{ route('panel.customers.property.add', $customer) }}"
                                                        wire:navigate
                                                        class="text-sm font-medium leading-6 text-indigo-600 hover:text-indigo-500">
                                                        Agregar propiedad
                                                    </a>
                                                @endcan
                                            @endif
                                        </div>
                                        {{-- @dd($customer->createdBy) --}}
                                        <div class="mt-1 text-xs leading-5 text-gray-500">Creado el
                                            <span
                                                class="text-gray-900">{{ Carbon\Carbon::parse($customer->created_at)->isoFormat('D [de] MMMM') }}</span>
                                            por <span class="text-gray-900">{{ $customer->createdBy->name }}</span>
                                        </div>
                                    </div>
                                    @if($customer->properties->count() > 0)
                                    <div
                                        class="rounded-md text-[10px] flex justify-center sm:hidden sm:py-1 sm:px-2 sm:text-xs sm:font-medium ring-1 ring-inset text-orange-700 bg-orange-50 ring-orange-600/20">
                                        {{ App\Enums\FrequencyEnum::getFrequency($customer->properties->first()->frequency) }}
                                    </div>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <div class="rounded-md bg-yellow-50 p-4 my-6">
                                <div class="text-sm font-medium text-yellow-700 text-center">
                                    <p>No se encontraron clientes.</p>
                                </div>
                            </div>
                        @endforelse
                    </tbody>
                </table>


            </div>
        </div>



        <div class="pb-6 px-4 sm:px-8">
            {{ $customers->links(data: ['scrollTo' => false]) }}

        </div>


    </div>


</div>
