<div>
    <header class="bg-white shadow">
        <div class="mx-auto max-w-screen-2xl px-4 py-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center">
                <div class="min-w-0 sm:flex-1">
                    <h1 class="items-center text-[1em] sm:text-2xl sm:mt-2 font-bold tracking-tight text-gray-900">
                        Editar Presupuesto para {{ $lead->full_name }}
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

        <!-- Toggles and Selects -->
        <div class="flex items-center mb-4 space-x-4">
            <!-- Toggle for adding private variables -->
            <div class="">
                <livewire:components.toggle :checked="$addPrivateVariables" :answer="'Sumar variables privadas'" />
            </div>

            <!-- Toggle for updating budget variables -->
            <div class="">
                <livewire:components.toggle :checked="$updateBudget" name="budgets" :answer="'Actualizar Presupuesto'" />
            </div>

            <!-- MultiSelect for budget variables -->
            <div class="">
                <livewire:components.multi-select-general :selectedValues="$budgetems
                    ->whereIn('id', $selectedBudgetemIds)
                    ->map(function ($item) {
                        return ['id' => $item->id, 'name' => $item->name];
                    })
                    ->values()
                    ->toArray()" :values="$budgetems->map(function ($item) {
                    return ['id' => $item->id, 'name' => $item->name];
                })" :imageValue="false"
                    :defaultOption="'Variables'" :searchEnabled="true" :name="'budgetems'" :model="false" :label="null" />
            </div>

            <!-- Select for templates -->
            <div class="">
                <livewire:components.select-general :values="$templates
                    ->map(function ($template) {
                        return ['id' => $template->id, 'name' => $template->name];
                    })
                    ->toArray()" :name="'template'" :selectedValue="$selectedTemplate"
                    :searchEnabled="true" :defaultOption="'Selecciona una plantilla'" />
            </div>
        </div>

        <!-- Budget variables table -->
        <div class="overflow-x-auto" x-data="{ handle: (item, position) => { $wire.sortBudgetVariables(item, position) } }">
            <table
                class="min-w-full divide-y divide-gray-300 bg-white ring-1 ring-black ring-opacity-5 md:rounded-lg md:shadow">
                <thead>
                    <tr>
                        <th colspan="2" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                            Variable
                        </th>

                        <th class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                            Visible
                        </th>
                        <th class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                            Tipo
                        </th>
                        <th class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                            Valor
                        </th>
                        <th class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                            Cálculo
                        </th>
                        <th class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                            Mínimo
                        </th>
                        <th class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                            Máximo
                        </th>
                        <th class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                            Cantidad
                        </th>
                        <th class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                            Subtotal
                        </th>
                        <th class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                            Acciones
                        </th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200" x-sort="handle">
                    @foreach ($budgetVariables as $index => $variable)
                        <tr x-sort:item="'{{ $variable['id'] }}'" wire:key="'public-{{ $index }}'"
                            class="hover:bg-slate-50 cursor-move">
                            <td colspan="2" class="px-3 py-3 text-sm text-gray-500">
                                {{ $variable['name'] }}
                            </td>

                            <td class="px-3 py-3 text-sm text-gray-500">
                                <livewire:components.toggle :checked="$variable['visible_doc']" :toggleId="$index" :key="$index" />
                            </td>


                            <td class="px-3 py-3 text-sm text-gray-500">
                                <span
                                    class="inline-flex items-center rounded-full px-2 py-1 text-xs font-medium ring-1 ring-inset {{ $variable['type_badge'] }}">
                                    {{ $variable['type_name'] }}
                                </span>
                            </td>

                            <td class="px-3 py-3 text-sm text-gray-500">
                                @if ($variable['type'] == 'fixed' || $variable['type'] == 'countable')
                                    {{ number_format($variable['value'], 0, ',', '.') }}
                                @else
                                    N/A
                                @endif
                            </td>

                            <td class="px-3 py-3 text-sm text-gray-500">
                                @if ($variable['operator'])
                                    <!-- Sum -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="size-6 text-blue-800" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 9v6m3-3H9"></path>
                                    </svg>
                                @else
                                    <!-- Subtract -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="size-6 text-red-800" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12H9"></path>
                                    </svg>
                                @endif
                            </td>

                            <td class="px-3 py-3 text-sm text-gray-500">
                                @if ($variable['type'] == 'countable' || $variable['type'] == 'percentage')
                                    {{ $variable['min'] ?? 'N/A' }}
                                @else
                                    N/A
                                @endif
                            </td>

                            <td class="px-3 py-3 text-sm text-gray-500">
                                @if ($variable['type'] == 'countable' || $variable['type'] == 'percentage')
                                    {{ $variable['max'] ?? 'N/A' }}
                                @else
                                    N/A
                                @endif
                            </td>

                            <td class="px-3 py-3 text-sm text-gray-500">
                                @if ($variable['type'] == 'countable')
                                    <input type="number" step="1" min="0"
                                        wire:model.live.debounce.1000ms="budgetVariables.{{ $index }}.cantidad"
                                        class="block w-32 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                @elseif($variable['type'] == 'percentage')
                                    <input type="number" step="0.01" min="0"
                                        wire:model.live.debounce.1000ms="budgetVariables.{{ $index }}.cantidad"
                                        class="block w-auto border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                @else
                                    N/A
                                @endif
                            </td>

                            <td class="px-3 py-3 text-sm text-gray-500">
                                ${{ number_format($variable['subtotal'], 0, ',', '.') }}
                            </td>

                            <td class="px-3 py-3 text-sm text-gray-500">
                                <div class="flex justify-start">
                                    <div class="text-red-400 cursor-pointer"
                                        wire:click="removeVariable({{ $index }})">
                                        <!-- Delete icon -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="size-6" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach

                    <!-- Private Variables -->
                    @if ($addPrivateVariables)
                        @foreach ($privateVariables as $index => $variable)
                            <tr x-sort:item="'private-{{ $variable['id'] }}'" wire:key="'private-{{ $index }}'"
                                class="hover:bg-slate-50">
                                <td colspan="2" class="px-3 py-3 text-sm text-gray-500">
                                    {{ $variable['name'] }}
                                    <span class="text-xs text-gray-400">(Privada)</span>
                                </td>

                                <td class="px-3 py-3 text-sm text-gray-500">
                                    -
                                </td>


                                <td class="px-3 py-3 text-sm text-gray-500">
                                    <span
                                        class="inline-flex items-center rounded-full px-2 py-1 text-xs font-medium ring-1 ring-inset {{ $variable['type_badge'] }}">
                                        {{ $variable['type_name'] }}
                                    </span>
                                </td>

                                <!-- Similar structure as public variables -->

                                <!-- No remove option for private variables -->
                                <td colspan="2" class="px-3 py-3 text-sm text-gray-500">
                                    {{ $variable['value'] }}
                                </td>
                            </tr>
                        @endforeach
                    @endif

                </tbody>

                <tfoot class="divide-y divide-gray-200">
                    <!-- Subtotal row -->
                    <tr>
                        <td colspan="7" class="px-3 py-3 text-right text-sm font-semibold text-gray-900">
                            Subtotal
                        </td>
                        <td class="px-3 py-3 text-sm text-gray-500">
                            ${{ number_format($subtotal, 0, ',', '.') }}
                        </td>
                        <td></td>
                    </tr>

                    <tr>
                        <td class="px-3 py-3 text-sm text-gray-500">
                            <input type="checkbox" wire:model.live="iva" id="include-iva"
                                class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                        </td>
                        <td colspan="6" class="px-3 py-3 text-sm text-gray-500">
                            Incluir IVA
                        </td>
                    </tr>

                    <!-- Total row -->
                    <tr>
                        <td colspan="7" class="px-3 py-3 text-right text-sm font-semibold text-gray-900">
                            Total
                        </td>
                        <td class="px-3 py-3 text-sm text-gray-500">
                            ${{ number_format($total, 0, ',', '.') }}
                        </td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>
        </div>


        <div class="mt-4">
            <!-- Botón para abrir el drawer -->
            <button wire:click="$set('openDrawer', 'true')" type="button"
                class="inline-flex items-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-700">
                Unión de PDFs
            </button>

            <!-- Botón para guardar presupuesto -->
            <button wire:click="update"
                class="ml-2 inline-flex items-center rounded-md bg-green-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-green-700">
                Actualizar Presupuesto
            </button>
        </div>



    </div>

    <div x-data="{ open: @entangle('openDrawer').live }" @keydown.window.escape="open = false" x-init="$watch( & quot; open & quot;, o => !o & amp; & amp; window.setTimeout(() => (open = true), 1000))" x-show="open"
        class="relative z-50" aria-labelledby="slide-over-title" x-ref="dialog" aria-modal="true">
        <div x-description="Background backdrop, show/hide based on slide-over state." class="fixed inset-0"></div>

        {{-- <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div> --}}

        <div x-show="open" x-transition:enter="ease-in-out duration-500" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="ease-in-out duration-500"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
            x-description="Background backdrop, show/hide based on slide-over state."
            class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity backdrop-blur-sm" aria-hidden="true">
        </div>


        <div class="fixed inset-0 overflow-hidden">
            <div class="absolute inset-0 overflow-hidden">
                <div class="pointer-events-none fixed inset-y-0 right-0 flex max-w-full pl-10">

                    <div x-show="open" x-cloak
                        x-transition:enter="transform transition ease-in-out duration-500 sm:duration-700"
                        x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
                        x-transition:leave="transform transition ease-in-out duration-500 sm:duration-700"
                        x-transition:leave-start="translate-x-0" x-transition:leave-end="translate-x-full"
                        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                        class="pointer-events-auto w-screen max-w-md"
                        x-description="Slide-over panel, show/hide based on slide-over state."
                        @click.away="open = false">

                        <div class="flex h-full flex-col overflow-y-scroll bg-white py-6 shadow-xl">
                            <div class="px-4 sm:px-6">
                                <div class="flex items-start justify-between">
                                    <h2 class="text-base font-semibold leading-6 text-gray-900" id="slide-over-title">
                                        Panel de union de documentos</h2>
                                    <div class="ml-3 flex h-7 items-center">
                                        <button type="button"
                                            class="relative rounded-md bg-white text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                                            @click="open = false">
                                            <span class="absolute -inset-2.5"></span>
                                            <span class="sr-only">Close panel</span>
                                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" aria-hidden="true"
                                                data-slot="icon">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M6 18 18 6M6 6l12 12"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="relative mt-6 flex-1 px-4 sm:px-6">
                                <livewire:panel.budgets.partials.add-budget-pdf-resources :model="$budget" />
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>




</div>
