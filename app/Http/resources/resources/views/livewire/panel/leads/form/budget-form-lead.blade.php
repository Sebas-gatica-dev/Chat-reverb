<div>


    <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl md:col-span-3">

     
        @if ( (isset($data['budget_id']) && $this->lead->budget->status->value !== 'generating') || !isset($data['budget_id'] ))
  
            <!-- Toggle for adding private variables -->
            <div class="relative px-2 bg-gray-700 py-2 sm:px-6 lg:px-8">

                <div class="mx-auto max-w-screen-2xl">

                    <div class="flex justify-between max-sm:space-x-4 text-white">


                        <div class="flex gap-x-2">

                            <div class="flex text-center items-center">
                                @if (isset($data['budget_id']) && !$selectedTemplateId)
                                    <div>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="size-5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" />
                                        </svg>
                                    </div>

                                    <livewire:components.toggle :checked="$data['update_budget']" name="budgets" :dark="true" />
                                @endif
                            </div>

                            <div class="flex text-center items-center">



                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M7.864 4.243A7.5 7.5 0 0 1 19.5 10.5c0 2.92-.556 5.709-1.568 8.268M5.742 6.364A7.465 7.465 0 0 0 4.5 10.5a7.464 7.464 0 0 1-1.15 3.993m1.989 3.559A11.209 11.209 0 0 0 8.25 10.5a3.75 3.75 0 1 1 7.5 0c0 .527-.021 1.049-.064 1.565M12 10.5a14.94 14.94 0 0 1-3.6 9.75m6.633-4.596a18.666 18.666 0 0 1-2.485 5.33" />
                                </svg>



                                <livewire:components.toggle :checked="$data['add_private_variables']" :dark="true" :name="'data.add_private_variables'"
                                    :idComponent="$idModel" />

                            </div>

                        </div>


                        @if (isset($data['budget_id']) && $this->lead->budget->status->value == 'generated' && $lead->budget->pdfExists())
                            <div class="has-tooltip">
                                <span class="tooltip text-sm">Ver pdf</span>

                                <a target="_blank" href="{{ $this->lead->budget->getPdfUrl() }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-5 cursor-pointer"
                                        data-tooltip-target="tooltip-left" data-tooltip-placement="left">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M10.125 2.25h-4.5c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125v-9M10.125 2.25h.375a9 9 0 0 1 9 9v.375M10.125 2.25A3.375 3.375 0 0 1 13.5 5.625v1.5c0 .621.504 1.125 1.125 1.125h1.5a3.375 3.375 0 0 1 3.375 3.375M9 15l2.25 2.25L15 12" />

                                    </svg>
                                </a>
                            </div>
                        @endif

                    </div>


                </div>



            </div>

        @endif
        <div class="relative px-4 pb-6 sm:px-8 sm:pt-8 sm:pb-0">


   
            <div class="{{( (isset($this->lead->budget)) && ($this->lead->budget->status->value == 'generating') ) ? 'filter blur-sm pointer-events-none' : '' }}">
                <!-- Toggles and Selects -->
                <div
                    class="mx-auto max-w-screen-2xl px-4 py-4 gap-6 sm:px-6 lg:px-8 grid 
                   {{ $closed ? 'sm:grid-cols-4' : 'sm:grid-cols-3' }} 
                    place-items-start justify-items-center">



                    <div>
                        <livewire:components.multi-select-general :selectedValues="collect($data['selected_budgetem_ids'])
                            ->map(function ($id) use ($budgetems) {
                                $budgetem = $budgetems->firstWhere('id', $id);
                                return ['id' => $budgetem->id, 'name' => $budgetem->name];
                            })
                            ->values()
                            ->toArray()" :values="$budgetems->map(function ($item) {
                            return ['id' => $item->id, 'name' => $item->name];
                        })" :name="'data.selected_budgetem_ids'"
                            :label="'Variables'" :idComponent="$idModel" />
                    </div>


                    <!-- MultiSelect for products -->
                    <div>
                        <livewire:components.multi-select-general :selectedValues="collect($data['selected_product_ids'] ?? [])
                            ->map(function ($id) use ($products) {
                                $product = $products->firstWhere('id', $id);
                                return ['id' => $product->id, 'name' => $product->name];
                            })
                            ->values()
                            ->toArray()" :values="$products->map(function ($item) {
                            return ['id' => $item->id, 'name' => $item->name];
                        })"
                            :name="'data.selected_product_ids'" :label="'Productos'" :idComponent="$idModel" />
                    </div>


                    <!-- Select for templates -->
                    @if (!$data['update_budget'])
                        <div>
                            <livewire:components.select-general :values="$templates
                                ->map(function ($template) {
                                    return ['id' => $template->id, 'name' => $template->name];
                                })
                                ->toArray()" :name="'template'" :selectedValue="$selectedTemplateId ?? null"
                                :label="'Plantillas'" :idComponent="$idModel" />
                        </div>
                    @endif


                    {{-- Nombre del presupuesto --}}

                    @if($closed)
                   
                    <div class="">

                        <label for="name" class="block text-sm font-medium leading-6 text-gray-900 mb-2">Nombre del
                            presupuesto</label>

                        <input type="text" wire:model.live="name" id="name" name="name"
                            placeholder="Escriba el nombre"
                            class="block w-full rounded-md border-0 py-1 text-gray-900 shadow-sm
                                ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2
                                     focus:ring-inset focus:ring-indigo-600 text-sm sm:leading-6" />

                        @error('name')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div> 
                        @enderror
                    </div>
                    @endif


                </div>

                <!-- Budget Variables Table -->
                <div class="mx-auto max-w-screen-2xl px-4 py-4 sm:px-6 lg:px-8">
                    <div class="overflow-x-auto" x-data="{ handle: (item, position) => { $wire.sortBudgetItems(item, position) } }">
                        <table
                            class="min-w-full divide-y divide-gray-300 bg-white ring-1 ring-black ring-opacity-5 md:rounded-lg md:shadow">
                            <thead>
                                <tr>
                                    <th colspan="2"
                                        class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
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



                                @forelse ($data['items'] as $index => $variable)
                                    <tr x-sort:item="'{{ $variable['id'] }}'" wire:key="'{{ $index }}'"
                                        class="hover:bg-slate-50 cursor-move">

                                        <td colspan="2" class="px-3 py-3 text-sm text-gray-500">
                                            #{{ $variable['order'] }} - {{ $variable['name'] }}
                                            @if ($variable['itemable_type'] == 'App\Models\Product')
                                                <span class="text-xs text-gray-400">(Producto)</span>
                                            @endif
                                        </td>


                                        <td class="px-3 py-3 text-sm text-gray-500">
                                            <livewire:components.toggle :checked="$variable['visible_doc']" :toggleId="$variable['id']"
                                                :key="'toggle-' . $variable['id'] . '-' . $index" />
                                        </td>

                                        <td class="px-3 py-3 text-sm text-gray-500">
                                            <span
                                                class="inline-flex items-center rounded-full px-2 py-1 text-xs font-medium ring-1 ring-inset {{ $variable['type_badge'] }}">
                                                {{ $variable['type_name'] }}
                                            </span>
                                        </td>


                                        <td class="px-3 py-3 text-sm text-gray-500">
                                            @if ($variable['type'] == 'countable' || $variable['type'] == 'fixed')
                                                {{ number_format($variable['value'], 0, ',', '.') }}
                                            @else
                                                %
                                            @endif
                                        </td>

                                        <td class="px-3 py-3 text-sm text-gray-500">
                                            @if ($variable['operator'])
                                                <!-- Sum -->
                                                <svg xmlns="http://www.w3.org/2000/svg" class="size-6 text-blue-800"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M12 9v6m3-3H9"></path>
                                                </svg>
                                            @else
                                                <!-- Subtract -->
                                                <svg xmlns="http://www.w3.org/2000/svg" class="size-6 text-red-800"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M15 12H9"></path>
                                                </svg>
                                            @endif
                                        </td>

                                        <td class="px-3 py-3 text-sm text-gray-500">
                                            @if ($variable['type'] == 'countable' || $variable['type'] == 'percentage')
                                                {{ $variable['min'] ?? 'N/A' }}
                                            @else
                                            @endif
                                        </td>

                                        <td class="px-3 py-3 text-sm text-gray-500">
                                            @if ($variable['type'] == 'countable' || $variable['type'] == 'percentage')
                                                {{ $variable['max'] ?? 'N/A' }}
                                            @else
                                            @endif
                                        </td>

                                        <td class="px-3 py-3 text-sm text-gray-500">
                                            @if ($variable['type'] == 'countable')
                                                <input type="number" step="1" min="0"
                                                    wire:model.live.debounce.1000ms="data.items.{{ $index }}.quantity"
                                                    class="inline-block w-20 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                            @elseif($variable['type'] == 'percentage')
                                                <input type="number" step="0.01" min="0"
                                                    wire:model.live.debounce.1000ms="data.items.{{ $index }}.quantity"
                                                    class="inline-block w-20  border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                            @else
                                                1
                                            @endif
                                        </td>

                                        <td class="px-3 py-3 text-sm text-gray-500">
                                            ${{ number_format($variable['subtotal'], 0, ',', '.') }}
                                        </td>

                                        <td class="px-3 py-3 text-sm text-gray-500">
                                            <div class="flex justify-start">
                                                <div class="text-red-400 cursor-pointer "
                                                    wire:click="removeItem({{ $index }})">
                                                    <!-- Delete icon -->
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        class="size-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
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
                                                    <p>No asigno ninguna variable, asigne una.</p>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse


                            </tbody>



                            <tfoot class="divide-y divide-gray-200">
                                @if ($allItemsInvisible && count($data['items']) > 0)
                                    <tr class="bg-indigo-50" wire:key="'once_item'">

                                        <!-- Input occupies 4 columns -->
                                        <td colspan="4" class="px-2 py-3">
                                            <div class="flex items-center">
                                                <input type="text" wire:model.live="data.once_item_title"
                                                    name="once_item_title" id="once_item_title"
                                                    placeholder="Nombre del grupo de items"
                                                    class="text-gray-700 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                                            </div>
                                        </td>
                                        <!-- Rest of the columns with grey background -->
                                        <td colspan="5" class=" "></td>

                                        <td colspan="2" class=" px-3 py-3 text-sm text-gray-500">
                                            ${{ number_format($data['subtotal'], 0, ',', '.') }}

                                        </td>

                                    </tr>
                                @endif

                                @if ($data['add_private_variables'])
                                    @can('access-function', 'budget-edit')
                                        <tr class="bg-slate-50 mt-6">
                                            <td colspan="12"
                                                class="px-3 py-3 text-sm text-center font-semibold text-gray-600">
                                                Variables privadas


                                            </td>

                                        </tr>

                                        @foreach ($data['private_variables'] as $index => $variable)
                                            <tr x-sort:item="'private-{{ $variable['id'] }}'"
                                                wire:key="'private-{{ $index }}'" class="hover:bg-slate-50">
                                                <td colspan="3" class="px-3 py-3 text-sm text-gray-500">
                                                    {{ $variable['name'] }}
                                                    <span class="text-xs text-gray-400">(Privada)</span>
                                                </td>



                                                <td class="px-3 py-3 text-sm text-gray-500">
                                                    <span
                                                        class="inline-flex items-center rounded-full px-2 py-1 text-xs font-medium ring-1 ring-inset {{ $variable['type_badge'] }}">
                                                        {{ $variable['type_name'] }}
                                                    </span>
                                                </td>

                                                <td class="px-3 py-3 text-sm text-gray-500">
                                                    @if ($variable['type'] == 'countable' || $variable['type'] == 'fixed')
                                                        {{ number_format($variable['value'], 0, ',', '.') }}
                                                    @else
                                                        %
                                                    @endif
                                                </td>


                                                <td class="px-3 py-3 text-sm text-gray-500">
                                                    @if ($variable['operator'])
                                                        <!-- Sum -->
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            class="size-6 text-blue-800" fill="none"
                                                            viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M12 9v6m3-3H9"></path>
                                                        </svg>
                                                    @else
                                                        <!-- Subtract -->
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            class="size-6 text-red-800" fill="none"
                                                            viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M15 12H9"></path>
                                                        </svg>
                                                    @endif
                                                </td>

                                                <td class="px-3 py-3 text-sm text-gray-500">

                                                </td>

                                                <td class="px-3 py-3 text-sm text-gray-500">

                                                </td>

                                                <td class="px-3 py-3 text-sm text-gray-500">
                                                    @if ($variable['type'] == 'countable')
                                                        {{ $variable['quantity'] }}
                                                    @elseif($variable['type'] == 'percentage')
                                                        {{ $variable['quantity'] }} %
                                                        {{-- {{ $data['items'][$index]['quantity'] }} --}}
                                                    @else
                                                        1
                                                    @endif
                                                </td>

                                                <td class="px-3 py-3 text-sm text-gray-500">
                                                    ${{ number_format($variable['subtotal'], 0, ',', '.') }}
                                                </td>

                                                <td>

                                                </td>

                                            </tr>
                                        @endforeach

                                        <tr>
                                            <td colspan="7"
                                                class="px-3 py-3 text-right text-sm font-semibold text-gray-900">
                                                Gastos internos
                                            </td>
                                            <td class="px-3 py-3 text-sm text-gray-500">
                                                ${{ number_format($privateSubtotal, 0, ',', '.') }}
                                            </td>
                                            <td></td>
                                        </tr>
                                    @else
                                        <!-- Fila de Subtotal de Variables Privadas -->
                                        <tr>
                                            <td colspan="7"
                                                class="px-3 py-3 text-right text-sm font-semibold text-gray-900">
                                                Gastos internos
                                            </td>
                                            <td class="px-3 py-3 text-sm text-gray-500">
                                                ${{ number_format($privateSubtotal, 0, ',', '.') }}
                                            </td>
                                            <td></td>
                                        </tr>
                                    @endcan

                                @endif





                                <!-- Subtotal row -->
                                <tr>
                                    <td colspan="7"
                                        class="px-3 py-3 text-right text-sm font-semibold text-gray-900">
                                        Subtotal


                                    </td>
                                    <td class="px-3 py-3 text-sm text-gray-500">
                                        ${{ number_format($data['subtotal'], 0, ',', '.') }}
                                    </td>
                                    <td></td>
                                </tr>



                                <tr>
                                    <td class="px-3 py-3 text-sm text-gray-500">
                                        <input wire:model.live="data.iva" id="include-iva" type="checkbox"
                                            class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                                    </td>
                                    <td colspan="6" class="px-3 py-3 text-sm text-gray-500">
                                        Incluir IVA
                                    </td>
                                </tr>

                                <!-- Total row -->
                                <tr>
                                    <td colspan="7"
                                        class="px-3 py-3 text-right text-sm font-semibold text-gray-900">
                                        Total
                                    </td>
                                    <td class="px-3 py-3 text-sm text-gray-500">
                                        ${{ number_format($data['total'], 0, ',', '.') }}
                                    </td>
                                    <td></td>
                                </tr>

                            </tfoot>
                        </table>
                    </div>
                </div>

                <!-- Save Button -->
                <div class="mx-auto max-w-screen-2xl px-4 py-4 sm:px-6 lg:px-8">

                    <div class="flex gap-x-4">
                        <div>

                            <button wire:click="saveBudget"
                                class="inline-flex items-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-700">
                                {{ isset($data['budget_id']) ? 'Actualizar' : 'Crear' }}
                            </button>

                            <!-- PDF Link -->

                            {{-- @if (isset($data['budget_id']) && !$generatingPdf && $lead->budget->pdfExists())
                                <a target="_blank" href="{{ $lead->budget->getPdfUrl() }}"
                                    class="inline-flex items-center rounded-md bg-blue-600 px-3 py-2 text-sm font-semibold text-white hover:bg-blue-700">
                                    Ver Presupuesto PDF
                                </a>
                            @endif --}}
                        </div>

                        <div>
                            <!-- Botón para abrir el drawer -->
                            <button wire:click="$set('openDrawer', 'true')" type="button"
                                class="inline-flex items-center rounded-md bg-gray-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-gray-700">
                                Unión
                            </button>

                        </div>
                    </div>

                </div>
            </div>

            <!-- Overlay -->
            @if (isset($this->lead->budget) && $this->lead->budget->status->value == 'generating')
                <div wire:poll.1s="checkProgress"
                    class="absolute inset-0 flex items-center justify-center bg-white bg-opacity-75">
                    <div class="text-center">
                        <p class="text-lg font-semibold mb-4">Presupuesto generándose. Vuelve más tarde...</p>
                        {{-- @dump($progress) --}}
                        <!-- Progress Bar -->
                        <div x-data="{ progress: @entangle('progress').live }"
                            class="relative w-64 h-3 overflow-hidden rounded-full bg-neutral-100">
                            <div class="absolute h-full bg-neutral-900" :style="{ width: progress + '%' }"></div>
                        </div>
                        <p class="mt-2">Generando PDF... {{ $progress }}%</p>
                    </div>
                </div>
            @elseif (isset($this->lead->budget) && $this->lead->budget->status->value == 'error')
                <div class="absolute inset-0 flex items-center justify-center bg-white bg-opacity-75">
                    <div class="text-center">
                        <p class="text-lg font-semibold mb-4">Hubo un error en la generación del presupuesto...</p>

                        <button wire:click="saveBudget"
                            class="inline-flex items-center rounded-md bg-gray-600 px-3 py-2 text-sm font-semibold text-white hover:bg-gray-700">
                            Reintentar nuevamente
                        </button>

                    </div>
                </div>
            @endif



        </div>
        @if ( (isset($this->lead->budget) && $this->lead->budget->status->value !== 'generating') || !(isset($data['budget_id']) ) )
            <div class="relative px-2 bg-gray-700 py-2 sm:px-6 lg:px-8">
                <div class="py-2">

                </div>
            </div>
        @endif

    </div>




    <div x-data="{ open: @entangle('openDrawer').live }" @keydown.window.escape="open = false" x-show="open" class="relative z-50"
        aria-labelledby="slide-over-title" x-ref="dialog" aria-modal="true">
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
                                <livewire:panel.budgets.partials.add-budget-pdf-resources :model="$budget ?? null" />
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>




</div>
