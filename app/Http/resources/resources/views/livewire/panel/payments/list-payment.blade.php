<div>
    <header class="bg-white shadow">
        <div class="mx-auto max-w-screen-2xl px-4 py-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center">
                <div class="min-w-0 sm:flex-1">
                    <h1 class="text-[1em] sm:text-2xl sm:mt-2 font-bold tracking-tight text-gray-900">
                        Pagos
                    </h1>
                </div>
                <!-- Botón Agregar (opcional) -->
                <!--
                <div class="items-center sm:flex md:ml-4 md:mt-0 justify-end text-sm">
                    <a wire:navigate href="#"
                        class="ml-3 inline-flex items-center rounded-md bg-gradient-to-t from-violet-800 to-purple-700 hover:from-purple-600 hover:to-purple-700 px-2 py-1.5 sm:px-3 sm:py-2 text-[0.8em] sm:text-sm font-semibold text-white shadow-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 ">
                        Agregar
                    </a>
                </div>
                -->
            </div>
        </div>
    </header>


    <!-- Filters Section -->
    <section aria-labelledby="filter-heading" class="border-b border-t border-gray-200 bg-slate-100"
        x-data="{ openFilters: false }">
        <h2 id="filter-heading" class="sr-only">Filtros</h2>
        <div class="max-w-screen-2xl mx-auto sm:grid items-center sm:grid-cols-3">
            <div class="relative flex justify-between sm:justify-none sm:block sm:col-span-1 items-center sm:py-4">
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
                <!-- ... (Se puede mantener similar al componente original) -->
            </div>
            <!-- Centro: Input de Búsqueda -->
            <div class="relative col-span-1 py-2 hidden sm:block">
                <div class="w-full">
                    <input type="text" wire:model.live.debounce.500ms="searchTerm"
                        class="bg-transparent block w-full border-0 border-b border-slate-300 focus:border-slate-400 focus:ring-0 sm:text-sm"
                        placeholder="Buscar..." />
                </div>
            </div>
            <!-- Ordenamiento -->
            <!-- ... (Se puede mantener similar al componente original) -->
        </div>

        <!-- Filtros desplegables -->
        <div class="border-t border-gray-200 md:py-10 py-5 col-span-3 bg-white shadow-sm" id="disclosure-1"
            x-show="openFilters" x-transition:enter="transition ease-out duration-100"
            x-transition:enter-start="transform opacity-0 scale-95"
            x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75"
            x-transition:leave-start="transform opacity-100 scale-100"
            x-transition:leave-end="transform opacity-0 scale-95" x-cloak>
            <div
                class="mx-auto grid max-w-screen-2xl grid-cols-1 lg:grid-cols-2 gap-y-4 lg:gap-x-6 px-4 text-sm sm:px-6 lg:px-8">
                <!-- Primera Fila -->
                <div class="grid auto-rows-min grid-cols-1 md:gap-y-10 gap-y-4 md:grid-cols-2 md:gap-x-6">
                    <!-- Fecha -->
                    <fieldset>
                        <legend class="block font-medium">Fecha</legend>
                        <div class="space-y-4 pt-2">
                            <input type="month" wire:model.live="selectedDate"
                                class="w-full border-0 border-b border-slate-300 focus:border-slate-400 focus:ring-0 sm:text-sm" />
                        </div>
                    </fieldset>
                    <!-- Sucursales -->
                    <fieldset>
                        <legend class="block font-medium">Sucursales</legend>
                        <div class="space-y-4 pt-2">
                            <livewire:components.select-general :selectedValue="$selectedBranch" :values="$branches" :imageValue="false"
                                :searchEnabled="false" :name="'branches'" :model="false" />
                        </div>
                    </fieldset>
                </div>
                <!-- Segunda Fila -->
                <div class="grid auto-rows-min grid-cols-1 md:gap-y-10 gap-y-4 md:grid-cols-2 md:gap-x-6">
                    <!-- Usuarios -->
                    <fieldset>
                        <legend class="block font-medium">Usuarios</legend>
                        <div class="space-y-4 pt-2">
                            <livewire:components.select-general :selectedValue="$selectedUser" :values="$users" :imageValue="false"
                                :searchEnabled="false" :name="'users'" :model="false" />
                        </div>
                    </fieldset>
                    <!-- Estado de Comprobantes -->
                    <fieldset>
                        <legend class="block font-medium">Estado de Comprobantes</legend>
                        <div class="space-y-4 pt-2">
                            <livewire:components.select-general :selectedValue="$selectedReceiptStatus" :values="$receiptStatuses" :imageValue="false"
                                :searchEnabled="false" :name="'receiptStatuses'" :model="false" />
                        </div>
                    </fieldset>
                </div>
                <!-- Tercera Fila -->
                <div class="grid auto-rows-min grid-cols-1 md:gap-y-10 gap-y-4 md:grid-cols-2 md:gap-x-6">
                    <!-- Medios de Pago -->
                    <fieldset>
                        <legend class="block font-medium">Medios de Pago</legend>
                        <div class="space-y-4 pt-2">
                            <livewire:components.select-general :selectedValue="$selectedReceiptType" :values="$receiptTypes" :imageValue="false"
                                :searchEnabled="false" :name="'receiptTypes'" :model="false" />
                        </div>
                    </fieldset>
                </div>
            </div>
        </div>
    </section>



    <!-- Estadísticas -->
    <div class="mx-auto max-w-screen-2xl px-4 pt-6 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
            <!-- Total Aprobados -->
            <div class="bg-white shadow rounded-lg p-4">
                <div class="text-sm font-medium text-gray-500">Total Aprobados</div>
                <div class="mt-1 text-3xl font-semibold text-gray-900">
                    ${{ number_format($totalApprovedAmount, 2, ',', '.') }}
                </div>
            </div>
            <!-- Total Pendientes -->
            <div class="bg-white shadow rounded-lg p-4">
                <div class="text-sm font-medium text-gray-500">Total Pendientes</div>
                <div class="mt-1 text-3xl font-semibold text-gray-900">
                    ${{ number_format($totalPendingAmount, 2, ',', '.') }}
                </div>
            </div>
            <!-- Total Rechazados -->
            <div class="bg-white shadow rounded-lg p-4">
                <div class="text-sm font-medium text-gray-500">Total Rechazados</div>
                <div class="mt-1 text-3xl font-semibold text-gray-900">
                    ${{ number_format($totalRejectedAmount, 2, ',', '.') }}
                </div>
            </div>
            <!-- Total Incobrables -->
            <div class="bg-white shadow rounded-lg p-4">
                <div class="text-sm font-medium text-gray-500">Total Incobrables</div>
                <div class="mt-1 text-3xl font-semibold text-gray-900">
                    ${{ number_format($totalUncollectibleAmount, 2, ',', '.') }}
                </div>
            </div>
        </div>
    </div>


    <!-- Tabla de Pagos -->

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
                                <th scope="col" class="py-3.5 px-3 text-left text-sm font-semibold text-gray-900">
                                    Fecha
                                </th>
                                <th scope="col" class="py-3.5 px-3 text-left text-sm font-semibold text-gray-900">
                                    Hora
                                </th>
                                <th scope="col" class="py-3.5 px-3 text-left text-sm font-semibold text-gray-900">
                                    Monto Total
                                </th>
                                <th scope="col" class="py-3.5 px-3 text-left text-sm font-semibold text-gray-900">
                                    Monto Restante
                                </th>
                                <th scope="col" class="py-3.5 px-3 text-left text-sm font-semibold text-gray-900">
                                    Visita
                                </th>
                                <th scope="col" class="py-3.5 px-3 text-left text-sm font-semibold text-gray-900">
                                    Estado
                                </th>
                                <th scope="col" class="py-3.5 px-3 text-left text-sm font-semibold text-gray-900">
                                    Sucursal
                                </th>
                                <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                    <span class="sr-only">Acciones</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                @if ($this->payments->total() > 0)
                                @foreach ($this->payments as $payment)
                        <tbody x-data="{ open: false }" wire:key="{{ $payment->id }}">
                            <tr wire:key="{{ $payment->id }}">
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
                                <td class="px-3 py-3 text-sm text-gray-500">
                                    {{ $payment->created_at->format('d/m/Y') }}
                                </td>
                                <!-- Hora -->
                                <td class="px-3 py-3 text-sm text-gray-500">
                                    {{ $payment->created_at->format('H:i') }}
                                </td>
                                <!-- Monto Total -->
                                <td class="px-3 py-3 text-sm text-gray-500">
                                    ${{ number_format($payment->amount_charged, 2, ',', '.') }}
                                </td>
                                <!-- Monto Restante -->
                                <td class="px-3 py-3 text-sm text-gray-500">
                                    ${{ 
                                    number_format(
                                        $payment->amount_charged
                                        -
                                        $payment->receipts->where('status', \App\Enums\Tickets\StatusTicketEnum::APPROVED)->sum('amount')
                                        
                                        , 2, ',', '.') }}
                                </td>
                                <!-- Visita -->
                                <td class="px-3 py-3 text-sm text-gray-500">
                                    {{ $payment->referenceable->id ?? 'N/A' }}
                                </td>
                                <!-- Estado -->
                                <td class="px-3 py-3 text-sm text-gray-500">
                                    <span
                                        class="inline-flex items-center gap-x-1.5 rounded-md {{ $payment->status->getBadgeClasses() }} px-1.5 py-0.5 text-xs font-medium">
                                        <svg class="h-1.5 w-1.5 {{ $payment->status->getBadgeFillClasses() }}"
                                            viewBox="0 0 6 6" aria-hidden="true">
                                            <circle cx="3" cy="3" r="3" fill="currentColor" />
                                        </svg>
                                        {{ $payment->status->getName() }}
                                    </span>
                                </td>
                                <!-- Sucursal -->
                                <td class="px-3 py-3 text-sm text-gray-500">
                                    {{ $payment->branch->name ?? 'N/A' }}
                                </td>
                                <!-- Acciones -->
                                <td
                                    class="relative whitespace-nowrap py-3 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                    <!-- Botón Comprobante (sin funcionalidad) -->
                                    <button class="text-indigo-600 hover:text-indigo-900">Comprobante</button>
                                </td>
                            </tr>
                            <!-- Tabla de Comprobantes -->
                            <tr x-show="open" x-cloak>
                                <td colspan="9" class="bg-gray-50 px-16 border-t border-t-gray-200">
                                    <div class="p-4">

                                        <div class="mt-6">

                                            <div
                                                class="py-1 cursor-pointer flex items-center justify-center hover:bg-gray-700 bg-gray-800 ring-1 ring-black ring-opacity-5 md:rounded-md md:shadow space-x-4">
                                                <h4 class="text-base font-semibold text-gray-50">Comprobante</h4>



                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                    class="size-5 fill-gray-100 text-gray-800">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M12 10.5v6m3-3H9m4.06-7.19-2.12-2.12a1.5 1.5 0 0 0-1.061-.44H4.5A2.25 2.25 0 0 0 2.25 6v12a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9a2.25 2.25 0 0 0-2.25-2.25h-5.379a1.5 1.5 0 0 1-1.06-.44Z" />
                                                </svg>


                                            </div>


                                            <!-- Tabla de Comprobantes -->
                                            <div class="overflow-x-auto mt-4 rounded-md shadow-sm">
                                                <table
                                                    class="min-w-full divide-y divide-gray-200
                                                    bg-white ring-1 ring-gray-100 border border-gray-200 md:rounded-lg md:shadow">
                                                    <thead>
                                                        <tr>
                                                            <th
                                                                class="px-4 py-2 text-left text-sm font-semibold text-gray-900">
                                                                Fecha de Transferencia</th>
                                                            <th
                                                                class="px-4 py-2 text-left text-sm font-semibold text-gray-900">
                                                                Hora de Transferencia</th>
                                                            <th
                                                                class="px-4 py-2 text-left text-sm font-semibold text-gray-900">
                                                                Monto</th>
                                                            <th
                                                                class="px-4 py-2 text-left text-sm font-semibold text-gray-900">
                                                                Estado</th>
                                                            <th
                                                                class="px-4 py-2 text-left text-sm font-semibold text-gray-900">
                                                                Tipo de Comprobante</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="divide-y divide-gray-200">
                                                        @forelse ($payment->receipts as $receipt)
                                                            <tr>
                                                                <td class="px-4 py-2 text-sm text-gray-500">
                                                                    {{ \Carbon\Carbon::parse($receipt->date_paid)->format('d/m/Y') }}
                                                                </td>
                                                                <td class="px-4 py-2 text-sm text-gray-500">
                                                                    {{ \Carbon\Carbon::parse($receipt->time_paid)->format('H:i') }}
                                                                </td>
                                                                <td class="px-4 py-2 text-sm text-gray-500">
                                                                    ${{ number_format($receipt->amount, 2, ',', '.') }}
                                                                </td>
                                                                <td class="px-4 py-2 text-sm text-gray-500">
                                                                    {{ $receipt->status->getName() }}
                                                                </td>
                                                                <td class="px-4 py-2 text-sm text-gray-500">
                                                                    {{ $receipt->type->getName() }}
                                                                </td>
                                                            </tr>
                                                        @empty

                                                        <tr>
                                                            <td colspan="9" class="py-6 px-4 sm:px-8">
                                                                <div class="rounded-md bg-yellow-50 p-4">
                                                                    <div
                                                                        class="text-sm font-medium text-yellow-700 text-center">
                                                                        <p>No se encontraron comprobantes.</p>
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
                    @else
                        <tr>
                            <td colspan="9" class="py-6 px-4 sm:px-8">
                                <div class="rounded-md bg-yellow-50 p-4">
                                    <div class="text-sm font-medium text-yellow-700 text-center">
                                        <p>No se encontraron solicitudes de pago.</p>
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
            {{ $this->payments->links(data: ['scrollTo' => false]) }}
        </div>
    </div>

</div>
