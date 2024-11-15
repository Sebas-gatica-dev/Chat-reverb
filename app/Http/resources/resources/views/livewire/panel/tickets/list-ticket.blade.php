<div>
    <header class="bg-white shadow">
        <div class="mx-auto max-w-screen-2xl px-4 py-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center">
                <div class="min-w-0 sm:flex-1">
                    <h1 class="items-center text-[1em] sm:text-2xl sm:mt-2 font-bold tracking-tight text-gray-900">
                        Tickets  ({{ $this->tickets->total() }})
                    </h1>
                </div>

                {{-- @can('access-function', 'customer-add') --}}
                <div class="items-center sm:flex md:ml-4 md:mt-0 justify-end text-sm">
                    <a wire:navigate href="{{ route('panel.tickets.add') }}"
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
                        <legend class="block font-medium">Fecha</legend>
                        <div class="space-y-4 pt-2">
                            <input type="month" wire:model.live="selectedDate"
                                class="w-full border-0 border-b border-slate-300 focus:border-slate-400 focus:ring-0 sm:text-sm" />
                        </div>
                    </fieldset>
                    <!-- Date Picker -->
                    <fieldset>
                        <legend class="block font-medium">Usuarios</legend>
                        <div class="space-y-4 pt-2">
                            <livewire:components.select-general :selectedValue="$selectedUser" :values="$users" :imageValue="false"
                                :searchEnabled="false" :name="'users'" :model="false">
                        </div>




                    </fieldset>
                </div>
                <!-- Second Row -->
                <div class="grid auto-rows-min grid-cols-1 md:gap-y-10 gap-y-4 md:grid-cols-2 md:gap-x-6">
                    <!-- Users -->
                    <fieldset>
                        <legend class="block font-medium">Tipo</legend>
                        <div class="space-y-4 pt-2">
                            <livewire:components.select-general :selectedValue="$selectedTypeTicket" :values="$ticketTypes" :imageValue="false"
                                :searchEnabled="false" :name="'ticketTypes'" :model="false">
                        </div>
                    </fieldset>
                    <!-- Status -->
                    <fieldset>
                        <legend class="block font-medium">Estado</legend>
                        <div class="space-y-4 pt-2">
                            <livewire:components.select-general :selectedValue="$selectedStatus" :values="$ticketStatuses" :imageValue="false"
                                :searchEnabled="false" :name="'ticketStatuses'" :model="false">
                        </div>
                    </fieldset>
                </div>

            </div>
        </div>


    </section>


    <!-- Estadísticas -->
    <div class="mx-auto max-w-screen-2xl px-4 pt-4 sm:px-6 lg:px-8">



        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
          

            <div class="bg-white shadow rounded-lg p-4">
                <div class="text-sm font-medium text-gray-500">Depositos en efectivo</div>
                <div class="flex items-baseline gap-x-1">
                <div class="mt-1 text-3xl font-semibold text-gray-900">
                    $ {{ number_format($this->cashDeposits, 0, ',', '.') }}
                </div>
                @if($this->cashDepositsPending)
                    <span class="text-sm text-red-500 font-semibold">($ {{ number_format($this->cashDepositsPending, 0, ',', '.') }})</span>
                @endif
                </div>
            </div>
   
    
            <div class="bg-white shadow rounded-lg p-4">
                <div class="text-sm font-medium text-gray-500">Depositos bancarios</div>
                <div class="flex items-baseline gap-x-1">
                <div class="mt-1 text-3xl font-semibold text-gray-900">
                    $ {{ number_format($this->bankDeposits, 0, ',', '.') }}
                </div>
                @if($this->bankDepositsPending)
                    <span class="text-sm text-red-500 font-semibold">($ {{ number_format($this->bankDepositsPending, 0, ',', '.') }})</span>
                @endif
                </div>
            </div>

         
            <div class="bg-white shadow rounded-lg p-4">
                <div class="text-sm font-medium text-gray-500">Gastos</div>
                <div class="flex items-baseline gap-x-1">
                <div class="mt-1 text-3xl font-semibold text-gray-900">
                    $ {{ number_format($this->expenses, 0, ',', '.') }}
                </div>
                @if($this->expensesPending)
                    <span class="text-sm text-red-500 font-semibold">($ {{ number_format($this->expensesPending, 0, ',', '.') }})</span>
                @endif
                </div>
            </div>



            <div class="bg-white shadow rounded-lg p-4">
                <div class="text-sm font-medium text-gray-500">Dinero pendiente</div>
                <div class="flex items-baseline gap-x-1">
                <div class="mt-1 text-3xl font-semibold text-gray-900">
                    $ {{ number_format($this->pendingMoney, 0, ',', '.') }}
                </div>
                @if($this->ticketPending)
                    <span class="text-sm text-red-500 font-semibold">($ {{ number_format($this->ticketPending, 0, ',', '.') }})</span>
                @endif
                </div>
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

                                <th scope="col"
                                    class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                                    Fecha
                                </th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                    Tipo
                                </th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                    Monto
                                </th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                    Usuario
                                </th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                    Estado
                                </th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                    Cuenta/Sucursal
                                </th>
                                <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                    <span class="sr-only">Acciones</span>
                                </th>
                            </tr>
                        </thead>


                        <tbody class="divide-y divide-gray-200">

                            @if ($this->tickets->total() > 0)

                                @foreach ($this->tickets as $ticket)
                                    <tr wire:key="{{ $ticket->id }}">

                                        <!-- Fecha -->
                                        <td class="py-3 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">
                                            {{ Carbon\Carbon::parse($ticket->created_at)->format('d/m/Y') }}
                                        </td>

                                        <!-- Tipo -->
                                        <td class="px-3 py-3 text-sm text-gray-500">


                                            <span
                                                class="inline-flex items-center gap-x-1.5 rounded-md {{ $ticket->type->getBadgeClasses() }} px-1.5 py-0.5 text-xs font-medium">
                                                <svg class="h-1.5 w-1.5 {{ $ticket->type->getBadgeFillClasses() }}"
                                                    viewBox="0 0 6 6" aria-hidden="true" fill="currentColor">
                                                    <circle cx="3" cy="3" r="3" />
                                                </svg>
                                                {{ $ticket->type->getName() }}
                                            </span>

                                        </td>
                                        <!-- monto -->
                                        <td class="px-3 py-3 text-sm text-gray-500">

                                            {{ number_format($ticket->amount, 0, ',', '.') }}

                                        </td>
                                        <!-- Usuario -->
                                        <td class="px-3 py-3 text-sm text-gray-500 has-tooltip">

                                            {{ $ticket->offeredBy->name }}

                                        </td>

                                        <td class="px-3 py-3 text-sm text-gray-500">

                                            <span
                                                class="inline-flex items-center gap-x-1.5 rounded-md  px-1.5 py-0.5 text-xs font-medium
                                            {{ $ticket->status->getBadgeClasses() }}
                                            ">


                                                <div class="animate-pulse h-1.5 w-1.5 rounded-full bg-current ">
                                                </div>

                                                {{ $ticket->status->getName() }}
                                            </span>

                                        </td>

                                        <!-- Cuenta/Sucursal -->
                                        <td class="px-3 py-3 text-sm text-gray-500">
                                            @if ($ticket->type == \App\Enums\Tickets\TypeTicketEnum::TRANSFER_DEPOSIT)
                                                {{ $ticket->bankAccount->name ?? 'N/A' }}
                                            @elseif ($ticket->type == \App\Enums\Tickets\TypeTicketEnum::CASH_DEPOSIT)
                                                {{ $ticket->branch->name ?? 'N/A' }}
                                            @else
                                                N/A
                                            @endif
                                        </td>

                                        <!-- Acciones -->
                                        <td class="px-3 py-3 text-sm text-gray-500">
                                            <div class="flex space-x-2">

                                                @if ($ticket->getRawOriginal('path'))
                                                    <!-- Ver Ticket -->
                                                    <button wire:click="viewTicket('{{ $ticket->id }}')"
                                                        class="text-gray-600 hover:text-gray-900">
                                                        <!-- SVG para Ver Ticket -->
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke-width="1.5"
                                                            stroke="currentColor" class="size-6">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                                        </svg>
                                                    </button>
                                                @endif

                                                @if ($ticket->status == \App\Enums\Tickets\StatusTicketEnum::PENDING)
                                                    <!-- Aprobar Ticket -->
                                                    <button wire:click="approveTicket('{{ $ticket->id }}')"
                                                        class="text-green-600 hover:text-green-900">
                                                        <!-- SVG para Aprobar Ticket -->
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke-width="1.5"
                                                            stroke="currentColor" class="size-6">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M9 12.75 11.25 15 15 9.75" />
                                                            <circle cx="12" cy="12" r="9"
                                                                stroke-linecap="round" stroke-linejoin="round" />
                                                        </svg>
                                                    </button>
                                                @endif


                                                @if ($ticket->status == \App\Enums\Tickets\StatusTicketEnum::PENDING)
                                                    <!-- Rechazar Ticket -->
                                                    <button wire:click="rejectTicket('{{ $ticket->id }}')"
                                                        class="text-red-600 hover:text-red-900">
                                                        <!-- SVG para Rechazar Ticket -->
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke-width="1.5"
                                                            stroke="currentColor" class="size-6">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                                        </svg>
                                                    </button>
                                                @endif

                                                @if ($ticket->status !== \App\Enums\Tickets\StatusTicketEnum::PENDING)
                                                    <!-- Recuperar Ticket -->
                                                    <button wire:click="recoverTicket('{{ $ticket->id }}')"
                                                        class="text-blue-600 hover:text-blue-900">
                                                        <!-- SVG para Recuperar Ticket -->
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke-width="1.5"
                                                            stroke="currentColor" class="size-6">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" />
                                                        </svg>
                                                    </button>
                                                @endif

                                                @if ($ticket->status == \App\Enums\Tickets\StatusTicketEnum::REJECTED)
                                                    <!-- Archivar Ticket -->
                                                    <button wire:click="archiveTicket('{{ $ticket->id }}')"
                                                        class="text-gray-600 hover:text-gray-900">
                                                        <!-- SVG para Archivar Ticket -->
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke-width="1.5"
                                                            stroke="currentColor" class="size-6">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
                                                        </svg>
                                                    </button>
                                                @endif

                                                <!-- Editar Ticket -->
                                                <a href="{{ route('panel.tickets.edit', $ticket->id) }}"
                                                    class="text-indigo-600 hover:text-indigo-900">
                                                    <!-- SVG para Editar Ticket -->
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        class="size-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                                    </svg>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="10" class="py-6 px-4 sm:px-8">
                                        <div class="rounded-md bg-yellow-50 p-4">
                                            <div class="text-sm font-medium text-yellow-700 text-center">
                                                <p>No se encontraron tickets para mostrar.</p>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                            @endif


                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="pt-6 px-4 sm:px-8">
            {{ $this->tickets->links(data: ['scrollTo' => false]) }}
        </div>
    </div>



    <div x-data="{
        showModal: @entangle('showConfirmationModal').live,
        showViewModal: @entangle('showViewModal').live,
    }">
        @if ($showConfirmationModal)
            @include('livewire.panel.tickets.partials.confirmation-modal', [
                'showModal' => 'showModal',
                'modelToggle' => $modalToggle,
                'model' => $modalModel,
                'icon' => $modalIcon,
                'iconBgColor' => $modalIconBgColor,
                'title' => $modalTitle,
                'modalView' => $modalView,
                'photo' => $photo,
                'message' => $modalMessage,
                'confirmAction' => $modalConfirmAction,
                'confirmButtonText' => $modalConfirmButtonText,
                'confirmButtonColor' => $modalConfirmButtonColor,
                'confirmButtonHoverColor' => $modalConfirmButtonHoverColor,
                'cancelAction' => '@this.set("showConfirmationModal", false)',
            ])
        @endif

    </div>



</div>
