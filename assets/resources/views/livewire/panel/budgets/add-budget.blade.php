<div>
    <header class="bg-white shadow">
        <div class="mx-auto max-w-screen-2xl px-4 py-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center">
                <div class="min-w-0 sm:flex-1">
                    <h1 class="items-center text-[1em] sm:text-2xl sm:mt-2 font-bold tracking-tight text-gray-900">
                        Crear Presupuesto para {{ $lead->full_name }}
                    </h1>
                </div>

                <div class="items-center sm:flex md:ml-4 md:mt-0 justify-end">
                    <a wire:navigate href="{{ route('panel.leads.list') }}"
                        class="ml-3 inline-flex items-center rounded-md bg-indigo-600 px-2 py-1.5 sm:px-3 sm:py-2 text-[0.8em] sm:text-sm font-semibold text-white shadow-sm hover:bg-indigo-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                        Atrás
                    </a>
                </div>
            </div>
        </div>
    </header>

    <div class="mx-auto max-w-screen-2xl px-4 py-6 sm:px-6 lg:px-8">

        <!-- Contenedor del Toggle y el MultiSelect -->
        <div class="flex items-center mb-4 space-x-4">
            <!-- Toggle para sumar variables privadas -->
            <div class="flex items-center">
                <livewire:components.toggle :checked="$addPrivateVariables" :answer="'Sumar variables privadas'" />
            </div>

            <!-- Componente de MultiSelect -->
            <div class="flex-1">
                <livewire:components.multi-select-general :selectedValues="$budgetems
                    ->whereIn('id', $selectedBudgetemIds)
                    ->map(function ($item) {
                        return ['id' => $item->id, 'name' => $item->name];
                    })
                    ->values()
                    ->toArray()" :values="$budgetems->map(function ($item) {
                    return ['id' => $item->id, 'name' => $item->name];
                })" :imageValue="false"
                    :searchEnabled="true" :name="'budgetems'" :model="false" :label="null" />
            </div>
        </div>

        <!-- Tabla de variables presupuestarias -->
        <div class="overflow-x-auto" x-data="{ handle: (item, position) => { $wire.sortBudgetVariables(item, position) } }">
            <table
                class="min-w-full divide-y divide-gray-300 bg-white ring-1 ring-black ring-opacity-5 md:rounded-lg md:shadow">
                <thead>
                    <tr>
                        <th class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                            Suma
                        </th>
                        <th class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                            Nombre de variable presupuestaria
                        </th>
                        <th class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                            Valor
                        </th>
                        <th class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                            Máximo
                        </th>
                        <th class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                            Mínimo
                        </th>
                        <th class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                            Cantidad
                        </th>
                        <th class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                            Acciones
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200" x-sort="handle">
                    @foreach ($budgetVariables as $index => $variable)
                        <!-- Other variables -->
                        <tr x-sort:item = "'{{ $variable['id'] }}'">
                            <td class="px-3 py-3 text-sm text-gray-500">
                                <input type="checkbox" wire:model.live="budgetVariables.{{ $index }}.sum"
                                    class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                            </td>
                            <td class="px-3 py-3 text-sm text-gray-500">
                                {{ $variable['name'] }}
                            </td>
                            <td class="px-3 py-3 text-sm text-gray-500">
                                @if ($variable['operator'] == 'FIXED' || $variable['operator'] == 'COUNTABLE')
                                    {{ number_format($variable['value'], 2) }}
                                @else
                                    N/A
                                @endif
                            </td>
                            <td class="px-3 py-3 text-sm text-gray-500">
                                @if ($variable['operator'] == 'COUNTABLE' || $variable['operator'] == 'PERCENTAGE')
                                    {{ $variable['max'] ?? 'N/A' }}
                                @else
                                    N/A
                                @endif
                            </td>
                            <td class="px-3 py-3 text-sm text-gray-500">
                                @if ($variable['operator'] == 'COUNTABLE' || $variable['operator'] == 'PERCENTAGE')
                                    {{ $variable['min'] ?? 'N/A' }}
                                @else
                                    N/A
                                @endif
                            </td>
                            <td class="px-3 py-3 text-sm text-gray-500">
                                @if ($variable['operator'] == 'COUNTABLE')
                                    <input type="number" step="1" min="0"
                                        wire:model.live="budgetVariables.{{ $index }}.cantidad"
                                        class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                @elseif($variable['operator'] == 'PERCENTAGE')
                                    <input type="number" step="0.01" min="0"
                                        wire:model.live.debounce.500ms="budgetVariables.{{ $index }}.cantidad"
                                        class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                @else
                                    N/A
                                @endif
                            </td>
                            <td class="px-3 py-3 text-sm text-gray-500">

                                <div class="flex justify-around">
                                    <div class="  text-red-400 cursor-pointer"
                                        wire:click="removeVariable({{ $index }})">

                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                        </svg>

                                    </div>

                                    {{-- @dump($variable['id']) --}}
                                    {{-- <div class="" x-sort:handle >

                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M3.75 3.75v4.5m0-4.5h4.5m-4.5 0L9 9M3.75 20.25v-4.5m0 4.5h4.5m-4.5 0L9 15M20.25 3.75h-4.5m4.5 0v4.5m0-4.5L15 9m5.25 11.25h-4.5m4.5 0v-4.5m0 4.5L15 15" />
                                        </svg>
                                    </div> --}}
                                </div>

                            </td>
                        </tr>
                    @endforeach


                </tbody>

                <tfoot class="divide-y divide-gray-200">
                    <!-- Fila de subtotal -->
                    <tr>
                        <td colspan="5" class="px-3 py-3 text-right text-sm font-semibold text-gray-900">
                            Subtotal
                        </td>
                        <td class="px-3 py-3 text-sm text-gray-500">
                            {{ number_format($subtotal, 2) }}
                        </td>
                        <td></td>
                    </tr>

                    <tr>
                        <td class="px-3 py-3 text-sm text-gray-500">
                            <input type="checkbox" wire:model.live="iva" id="include-iva"
                                class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                        </td>
                        <td class="px-3 py-3 text-sm text-gray-500">
                            Incluir IVA
                        </td>

                        <td colspan="5">
                        </td>

                    </tr>

                    <!-- Fila de total -->
                    <tr>
                        <td colspan="5" class="px-3 py-3 text-right text-sm font-semibold text-gray-900">
                            Total
                        </td>
                        <td class="px-3 py-3 text-sm text-gray-500">
                            {{ number_format($total, 2) }}
                        </td>
                        <td></td>
                    </tr>

                </tfoot>




            </table>
        </div>

        <!-- Botón para guardar presupuesto -->
        <div class="mt-4">
            <button wire:click="saveBudget"
                class="inline-flex items-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-700">
                Crear Presupuesto
            </button>
        </div>
    </div>
</div>
