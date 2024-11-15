@props(['unit_histories_use'])

<template x-teleport="body">
    <div x-show="modalUnitsUsed" class="fixed top-0 left-0 z-[99] flex items-center justify-center w-screen h-screen" x-cloak>
        <div x-show="modalUnitsUsed"
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="ease-in duration-300"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            @click="modalUnitsUsed=false" class="absolute inset-0 w-full h-full bg-gray-900 bg-opacity-50 backdrop-blur-sm"></div>
        <div x-show="modalUnitsUsed"
            x-trap.inert.noscroll="modalUnitsUsed"
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0 scale-90"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-90"
            class="relative w-full py-6 bg-white shadow-md px-7 bg-opacity-90 drop-shadow-md backdrop-blur-sm sm:max-w-lg sm:rounded-lg">
            <div class="flex items-center justify-between pb-3">
                <h3 class="text-lg font-semibold">Usos de la Unidad</h3>
                {{-- <button @click="modalUnitsUsed=false" class="absolute top-0 right-0 flex items-center justify-center w-8 h-8 mt-5 mr-5 text-gray-600 rounded-full hover:text-gray-800 hover:bg-gray-50">
                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>  
                </button> --}}
            </div>
            <div class="relative w-auto pb-8">
                <div class="col-span-full rounded-md">
                   
                    <ul class="flex flex-col items-center">
                        @forelse ($unit_histories_use as $key => $product)
                            <div class="divide-y divide-gray-200 w-full" x-data="{ openProduct: false, openUnit: false }"
                                wire:key="{{ $key }}">
                                <div class="flex items-center justify-between border-b-slate-400">
                                    <!-- Nombre del producto -->
                                    <div class="px-3 py-3 text-md text-gray-500">
                                       {{ $product['name'] }}
                                    </div>

                                    <!-- Botón para expandir/cerrar -->
                                    <div class="py-3 pl-4 pr-3 text-sm sm:pl-6">
                                        <button @click="openProduct = !openProduct"
                                            class="text-gray-500 hover:text-gray-700 focus:outline-none">
                                            <svg :class="{ 'rotate-180': openProduct }"
                                                class="w-5 h-5 transform transition-transform duration-200"
                                                xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2" d="M19 9l-7 7-7-7" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>

                                <!-- Detalles del producto -->
                                <div x-show="openProduct" x-cloak
                                    x-transition:enter="transition ease-out duration-800"
                                    x-transition:enter-start="opacity-0 transform scale-95"
                                    x-transition:enter-end="opacity-100 transform scale-100"
                                    class="w-full">
                                    <div class="bg-gray-50 border-t border-t-gray-200 rounded-b-lg">
                                        <div class="p-2">
                                            <div class="overflow-x-auto my-1 rounded-md shadow-sm">
                                                <table
                                                    class="min-w-full divide-y divide-gray-200 bg-white ring-1 ring-gray-100 border border-gray-200 md:rounded-lg md:shadow">
                                                    <thead>
                                                        <tr>
                                                            <th
                                                                class="px-4 py-2 text-left text-sm font-semibold text-gray-900">
                                                                Unidad</th>
                                                            <th
                                                                class="px-4 py-2 text-left text-sm font-semibold text-gray-900">
                                                                Hora</th>
                                                            <th
                                                                class="px-4 py-2 text-left text-sm font-semibold text-gray-900">
                                                                Cantidad</th>
                                                         
                                                        </tr>
                                                    </thead>
                                                    <tbody class="bg-white divide-y divide-gray-200">
                                                        @foreach ($product['units'] as $unitId => $unit)
                                                            <tr>
                                                                <td class="px-6 py-4 whitespace-nowrap text-sm"
                                                                    x-data="{ hover: false }"
                                                                    @mouseenter="hover = true"
                                                                    @mouseleave="hover = false"
                                                                    :class="{ 'transform transition duration-300 ease-in-out': true,
                                                                            'translate-y-0 text-gray-500': !hover,
                                                                            '-translate-y-1 text-indigo-600 shadow-lg': hover }">
                                                                    <a href="{{ route('panel.stock.inventory-show', [$product['id'], $unit['unit_id']]) }}"
                                                                    target="_blank"
                                                                    class="flex justify-center relative overflow-hidden">
                                                                        <span class="relative z-10 transition-colors duration-300"
                                                                            :class="{ 'text-indigo-600': hover }">
                                                                            {{ $unit['tag'] }}
                                                                        </span>
                                                                        <span class="absolute bottom-0 left-0 w-full h-0.5 bg-indigo-600 transform transition-all duration-300 ease-out"
                                                                            :class="{ 'scale-x-0': !hover, 'scale-x-100': hover }">
                                                                        </span>
                                                                    </a>
                                                                </td>
                                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                                    {{ \Carbon\Carbon::parse($unit['date'])->format('H:i:s') }}
                                                                </td>
                                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                                    {{ $unit['quantity'] }} {{ App\Enums\Units\UnitMeditionTypeEnum::from($product['unit_of_measurement'])->abbreviation() }}
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="text-center">No se encontraron productos.</p>
                        @endforelse
                    </ul>
                </div>
            </div>
            <div class="flex flex-col-reverse sm:flex-row sm:justify-between sm:space-x-2">
                <button
                 @click="modalUnitsUsed=false;" 
                type="button" class="inline-flex items-center justify-center h-10 px-4 py-2 text-sm font-medium transition-colors border bg-indigo-600 text-white rounded-md hover:bg-indigo-500 focus:outline-none focus:ring-0">Cerrar</button>
            </div>
        </div>
    </div>
</template>