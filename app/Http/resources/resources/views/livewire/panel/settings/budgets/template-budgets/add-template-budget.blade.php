<div>

    <div class="mx-auto max-w-screen-2xl pt-2 lg:flex lg:gap-x-16 lg:px-8">
        <h1 class="sr-only">Creación de Variable Presupuestaria</h1>

        <aside
            class="flex overflow-x-auto border-b border-gray-900/5 py-4 lg:block lg:w-64 lg:flex-none lg:border-0 lg:py-20">
            @include('components.panel.settings.menu-side-bar-settings')
        </aside>

        <main class="px-4 py-16 sm:px-6 lg:flex-auto lg:px-0 lg:py-20">
            <div class="mx-auto max-w-2xl space-y-4 sm:space-y-6 lg:mx-0 lg:max-w-none">

                <div class="sm:flex sm:items-center">
                    <div class="sm:flex-auto">
                        <h1 class="text-base font-semibold leading-6 text-gray-900">Plantilla de presupuesto</h1>
                        <p class="mt-2 text-sm text-gray-700">Crea una plantilla presupuestaria</p>
                    </div>
                    <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                        <a href="{{ route('panel.settings.budgets.template.list') }}" wire:navigate
                            class="cursor-pointer block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm
                        hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                            Atrás
                        </a>
                    </div>
                </div>


                <div class="flex flex-col space-y-4 mb-4">
                    <input type="text" wire:model.defer="templateName"
                        class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        placeholder="Nombre de la Plantilla">

                    @error('templateName')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror


                    <textarea wire:model.defer="templateDescription"
                        class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        placeholder="Descripción"></textarea>

                    @error('templateDescription')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror

                </div>

                <div class="flex justify-start items-center mb-4 space-x-4">
                    <!-- Componente de MultiSelect -->
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
                            :searchEnabled="true" :name="'budgetems'" :model="false" 
                            :defaultOption="'Selecciona una variable presupuestaria'"
                            />
                    </div>

                    <!-- MultiSelect for products -->
                    <div>
                        <livewire:components.multi-select-general :selectedValues="$products
                        ->whereIn('id', $selectedProductIds)
                        ->map(function ($item) {
                            return ['id' => $item->id, 'name' => $item->name];
                        })
                        ->values()
                        ->toArray()" :values="$products->map(function ($item) {
                            return ['id' => $item->id, 'name' => $item->name];
                        })" :name="'products'"
                        :defaultOption="'Selecciona un producto'"
                             />
                    </div>

                    <div class="">
                        <livewire:components.toggle :checked="$addPrivateVariables" :answer="'Sumar variables privadas'" />
                    </div>


                </div>

                <!-- Tabla de variables presupuestarias -->
                <div class="overflow-x-auto" x-data="{ handle: (item, position) => { $wire.sortBudgetItems(item, position) } }">
                    <table
                        class="min-w-full divide-y divide-gray-300 bg-white ring-1 ring-black ring-opacity-5 md:rounded-lg md:shadow">
                        <thead>
                            <tr>
                                <th colspan="2" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                    Variable
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
                            @forelse ($items as $index => $variable)
                                <tr x-sort:item="'{{ $variable['id'] }}'" wire:key="'public-{{ $index }}'"
                                    class="hover:bg-slate-50 cursor-move">
                                    <td colspan="2" class="px-3 py-3 text-sm text-gray-500">
                                        {{ $variable['name'] }}
                                        @if ($variable['itemable_type'] == 'App\Models\Product')
                                            <span class="text-xs text-gray-400">(Producto)</span>
                                        @endif
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
                                            <svg xmlns="http://www.w3.org/2000/svg" class="size-6 text-blue-800"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 9v6m3-3H9"></path>
                                            </svg>
                                        @else
                                            <!-- Subtract -->
                                            <svg xmlns="http://www.w3.org/2000/svg" class="size-6 text-red-800"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
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
                                                wire:model.live.debounce.1000ms="items.{{ $index }}.quantity"
                                                class="block w-32 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                        @elseif($variable['type'] == 'percentage')
                                            <input type="number" step="0.01" min="0"
                                                wire:model.live.debounce.1000ms="items.{{ $index }}.quantity"
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
                                                wire:click="removeItem({{ $index }})">
                                                <!-- Delete icon -->
                                                <svg xmlns="http://www.w3.org/2000/svg" class="size-6" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                </svg>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="12" class="py-6 px-4 sm:px-8">
                                        <div class="rounded-md bg-yellow-50 p-4">
                                            <div class="text-sm font-medium text-yellow-700 text-center">
                                                <p>No asigno ninguna variable/producto, asigne una.</p>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse

                        </tbody>
                        <tfoot class="divide-y divide-gray-200">
                            <tr>
                                <td colspan="7" class="px-3 py-3 text-right text-sm font-semibold text-gray-900">
                                    Total
                                </td>
                                <td class="px-3 py-3 text-sm text-gray-500">
                                    ${{ number_format($subtotal, 0, ',', '.') }}
                                </td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>



                <!-- Button to open the PDF selection drawer -->
                <div class="mt-4">

                    <button wire:click="$set('openDrawer', 'true')" type="button"
                        class="inline-flex items-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-700">
                        Seleccionar PDFs Adicionales
                    </button>

                    <button wire:click="saveTemplateBudget"
                        class="inline-flex items-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-700">
                        Crear Plantilla
                    </button>
                </div>

            </div>
        </main>


    </div>






    <!-- Drawer for selecting PDFs -->


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
                                <livewire:panel.budgets.partials.add-budget-pdf-resources />
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>






</div>
