@php
    use App\Enums\Units\UnitMeditionTypeEnum;
@endphp

<div>
    <div x-data="{ steps: $wire.$parent.entangle('steps').live }">
        <div class="rounded-md bg-blue-50 p-4 mt-4 mb-4">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-blue-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd"
                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a.75.75 0 000 1.5h.253a.25.25 0 01.244.304l-.459 2.066A1.75 1.75 0 0010.747 15H11a.75.75 0 000-1.5h-.253a.25.25 0 01-.244-.304l.459-2.066A1.75 1.75 0 009.253 9H9z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3 flex-1 md:flex md:justify-between">
                    <p class="text-sm text-blue-700">¿Terminaste el servicio? Apenas confirmes se le enviara el informe
                        al
                        cliente y podrás calificarte.</p>
                </div>
            </div>
        </div>
        <div x-init="steps = localStorage.getItem('steps') ? parseInt(localStorage.getItem('steps')) : steps;
        $watch('steps', value => localStorage.setItem('steps', value == 2 ? 1 : value));">


            <div x-show="steps == 1 || steps == 2">
                <div class="px-4 py-10 lg:p-8">

                    <div class="grid w-full grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <div class="sm:col-span-3">
                            <label for="selected-unit"
                                class="block text-sm font-medium leading-6 text-gray-900">Selecciona
                                Entre tus Productos de inventario.</label>
                            <div class="mt-2">
                                <livewire:components.select-general :values="$productsSelectList" :imageValue="false"
                                    :searchEnabled="true" :name="'selected-product'" :selectAllActivated="false" :model="false">
                            </div>

                        </div>


                        <div class="sm:col-span-3">
                            <label for="selected-unit"
                                class="block text-sm font-medium leading-6 text-gray-900">Selecciona
                                una
                                unidad.</label>
                            <div class="mt-2">
                                <livewire:components.select-general :values="$worker_units" :imageValue="false"
                                    :searchEnabled="true" :name="'selected-unit'" :selectAllActivated="false" :model="false">
                            </div>

                        </div>


                        <div x-data="{ show: @entangle('showUnitForm'), useEntireUnit: @entangle('useEntireUnit') }" x-show="show "
                            x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 transform scale-90"
                            x-transition:enter-end="opacity-100 transform scale-100"
                            x-transition:leave="transition ease-in duration-300"
                            x-transition:leave-start="opacity-100 transform scale-100"
                            x-transition:leave-end="opacity-0 transform scale-90" class="sm:col-span-3">
                            <label for="quantityToUse"
                                class="block text-sm font-medium leading-6 text-gray-900">Cantidad</label>
                            <div class="mt-2 relative">
                                <input
                                    class="relative rounded-md border-gray-300 shadow-sm focus:border-indigo-600 focus:ring focus:ring-indigo-600 focus:ring-opacity-50 block w-full sm:text-sm"
                                    id="quantityToUse" type="number" wire:model.live="quantityToUse"
                                    placeholder="Cantidad a usar..." min="0"
                                    @if ($useEntireUnit) disabled @endif>

                                @if ($selectedWorkerUnit && $selectedProduct)
                                    <span
                                        class="absolute right-3 top-1/2 transform -translate-y-1/2 bg-slate-50 px-2 py-2 text-slate-500 text-xs rounded">
                                        {{ UnitMeditionTypeEnum::from($selectedProduct['unit_of_measurement'])->abbreviation() }}
                                    </span>
                                @endif
                            </div>

                        </div>



                        {{-- @dump($quantityToUse) --}}

                        <div x-data="{ show: @entangle('showUnitForm'), }" x-show="show "
                            x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 transform scale-90"
                            x-transition:enter-end="opacity-100 transform scale-100"
                            x-transition:leave="transition ease-in duration-300"
                            x-transition:leave-start="opacity-100 transform scale-100"
                            x-transition:leave-end="opacity-0 transform scale-90" class="sm:col-span-3 mt-8">
                            <label for="quantityToUse"
                                class="block text-sm font-medium leading-6 text-gray-900"></label>
                            <div class="">
                                <livewire:components.toggle :checked="$useEntireUnit" :answer="'Toda la unidad'" :name="'use-entire-unit'" />
                            </div>
                            {{-- @dump('useEntireUnit: ' . $useEntireUnit) --}}


                        </div>

                        {{-- @dd($selectedWorkerUnit) --}}
                        <div class="flex lg:justify-between items-center w-full col-span-full lg:col-span-3">
                            <button x-data="{ show: @entangle('showUnitForm'), }" x-show="show"
                                x-transition:enter="transition ease-out duration-300"
                                x-transition:enter-start="opacity-0 transform scale-90"
                                x-transition:enter-end="opacity-100 transform scale-100"
                                x-transition:leave="transition ease-in duration-300"
                                x-transition:leave-start="opacity-100 transform scale-100"
                                x-transition:leave-end="opacity-0 transform scale-90"
                                class="lg:ml-0 rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                                {{-- @if ($this->selectedWorkerUnit) @if ($this->selectedWorkerUnit['current_quantity'] - $this->quantityToUse == 0)
                                wire:confirm="Si usas toda unidad esta se dara de baja,¿Deseas continuar?" @endif
                    @endif --}} wire:click="createUnitHistoryUse">
                                Cargar uso
                            </button>
                        </div>




                        {{-- COMIENZO DE UNIT HISTORIES --}}

                        @if ($unit_histories_use)
                            <div class="col-span-full rounded-md">
                                <div class="mr-auto py-2 sm:px-6">
                                    <h3 class="text-lg leading-4 text-start font-medium text-gray-900">
                                        Usos de la visita
                                    </h3>
                                </div>
                                <ul class="flex flex-col items-center">
                                    {{-- @dd($unit_histories_use) --}}
                                    @forelse ($unit_histories_use as $key => $unit_histories)
                                        {{-- @dd($unit_histories_use) --}}
                                        @php
                                            // Buscar el producto correspondiente en el array $products
                                            $product = collect($products)->firstWhere('id', $key);
                                        @endphp
                                        <div class="divide-y divide-gray-200 w-full" x-data="{ openProduct: false, openUnit: false }"
                                            wire:key="{{ $key }}">
                                            <div class="flex items-center justify-between border-b-slate-400">
                                                <!-- Nombre del producto -->
                                                <div class="px-3 py-3 text-md text-gray-500">
                                                    {{ $product['name'] ?? 'Producto no encontrado' }}
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
                                                x-transition:enter-end="opacity-100 transform scale-100" class="w-full">
                                                <div class="bg-gray-50 border-t border-t-gray-200 rounded-b-lg">
                                                    <div class="p-2">
                                                        <div class="overflow-x-auto my-1 rounded-md shadow-sm">
                                                            <table
                                                                class="min-w-full divide-y divide-gray-200 bg-white ring-1 ring-gray-100 border border-gray-200 md:rounded-lg md:shadow">
                                                                <thead>
                                                                    <tr>
                                                                        <th
                                                                            class="px-4 py-2 text-left text-sm font-semibold text-gray-900">
                                                                            Hora</th>
                                                                        <th
                                                                            class="px-4 py-2 text-left text-sm font-semibold text-gray-900">
                                                                            Cantidad</th>
                                                                        <th
                                                                            class="px-4 py-2 text-left text-sm font-semibold text-gray-900">
                                                                            Acciones</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody class="divide-y divide-gray-200">



                                                                    {{-- @dd($unit_histories) --}}
                                                                    @foreach ($unit_histories as $unitId => $unit_history)
                                                                        {{-- @dd($unit_history) --}}

                                                                        {{-- x-data="{ showInputEdit: @entangle('showInputEdit.' . $key . '.' . $unitId ) }" --}}
                                                                        <tr
                                                                            wire:key="unit-history-{{ $key }}-{{ $unitId }}">
                                                                            <td
                                                                                class="px-4 py-2 text-sm text-gray-500">
                                                                                {{ $unit_history['date'] }}
                                                                            </td>
                                                                            <td
                                                                                class="px-4 py-2 text-sm text-gray-500">
                                                                                @if (!$unit_history['showActivity'])
                                                                                    <span>
                                                                                        {{ $unit_history['quantity'] }}
                                                                                        {{ UnitMeditionTypeEnum::from($product['unit_of_measurement'])->abbreviation() }}
                                                                                    </span>
                                                                                @endif

                                                                                @if ($unit_history['showActivity'])
                                                                                    <input
                                                                                        class="relative rounded-md border-gray-300 shadow-sm focus:border-indigo-600 block w-16 lg:w-1/2 sm:text-sm"
                                                                                        type="number"
                                                                                        wire:model.live="unit_histories_use.{{ $key }}.{{ $unitId }}.quantity"
                                                                                        min="0">
                                                                                @endif
                                                                            </td>
                                                                            <td
                                                                                class="px-4 py-2 text-sm text-gray-500 flex">

                                                                                @if (!$unit_history['showActivity'])
                                                                                    <button
                                                                                        wire:click="toggleEditUnitHistoryUse('{{ $key }}','{{ $unitId }}')"
                                                                                        class="rounded-full text-white p-1 bg-indigo-500 hover:bg-indigo-400">
                                                                                        <!-- Icono de editar -->
                                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                                            fill="none"
                                                                                            viewBox="0 0 24 24"
                                                                                            stroke-width="1.5"
                                                                                            stroke="currentColor"
                                                                                            class="size-6">
                                                                                            <path
                                                                                                stroke-linecap="round"
                                                                                                stroke-linejoin="round"
                                                                                                d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                                                                        </svg>
                                                                                    </button>
                                                                                    <button
                                                                                        wire:click="deleteOrCancelEditUnitHistory({{ json_encode($unit_history) }}, '{{ $key }}','{{ $unitId }}')"
                                                                                        wire:confirm="¿Estás seguro de eliminar este registro de actividad?"
                                                                                        class="rounded-full text-white p-1 bg-red-500 hover:bg-red-400">
                                                                                        <!-- Icono de eliminar -->
                                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                                            viewBox="0 0 24 24"
                                                                                            fill="currentColor"
                                                                                            class="size-6">
                                                                                            <path fill-rule="evenodd"
                                                                                                d="M16.5 4.478v.227a48.816 48.816 0 0 1 3.878.512.75.75 0 1 1-.256 1.478l-.209-.035-1.005 13.07a3 3 0 0 1-2.991 2.77H8.084a3 3 0 0 1-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 0 1-.256-1.478A48.567 48.567 0 0 1 7.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 0 1 3.369 0c1.603.051 2.815 1.387 2.815 2.951Zm-6.136-1.452a51.196 51.196 0 0 1 3.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 0 0-6 0v-.113c0-.794.609-1.428 1.364-1.452Zm-.355 5.945a.75.75 0 1 0-1.5.058l.347 9a.75.75 0 1 0 1.499-.058l-.346-9Zm5.48.058a.75.75 0 1 0-1.498-.058l-.347 9a.75.75 0 0 0 1.5.058l.345-9Z"
                                                                                                clip-rule="evenodd" />
                                                                                        </svg>
                                                                                    </button>
                                                                                @endif

                                                                                @if ($unit_history['showActivity'])
                                                                                    <button
                                                                                        wire:click="editUnitHistoryUse({{ json_encode($unit_history) }}, '{{ $key }}','{{ $unitId }}')"
                                                                                        class="rounded-full text-white p-1 bg-indigo-500 hover:bg-indigo-400">
                                                                                        <!-- Icono de guardar -->
                                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                                            fill="none"
                                                                                            viewBox="0 0 24 24"
                                                                                            stroke-width="1.5"
                                                                                            stroke="currentColor"
                                                                                            class="size-6">
                                                                                            <path
                                                                                                stroke-linecap="round"
                                                                                                stroke-linejoin="round"
                                                                                                d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                                                                        </svg>
                                                                                    </button>
                                                                                    <button
                                                                                        wire:click="toggleEditUnitHistoryUse('{{ $key }}', '{{ $unitId }}')"
                                                                                        class="rounded-full text-white p-1 bg-red-500 hover:bg-red-400">
                                                                                        <!-- Icono de cancelar edición-->
                                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                                            fill="none"
                                                                                            viewBox="0 0 24 24"
                                                                                            stroke-width="1.5"
                                                                                            stroke="currentColor"
                                                                                            class="size-6">
                                                                                            <path
                                                                                                stroke-linecap="round"
                                                                                                stroke-linejoin="round"
                                                                                                d="M6 18 18 6M6 6l12 12" />
                                                                                        </svg>
                                                                                    </button>
                                                                                @endif
                                                                            </td>
                                                                        </tr>
                                                                        <!-- Detalles adicionales -->
                                                                        <tr x-show="openUnit" x-cloak
                                                                            x-transition:enter="transition ease-out duration-800"
                                                                            x-transition:enter-start="opacity-0 transform scale-95"
                                                                            x-transition:enter-end="opacity-100 transform scale-100"
                                                                            wire:key="{{ $key }}-{{ $unitId }}}}">
                                                                            <td colspan="5" class="px-4 py-2">
                                                                                <p class="text-sm text-gray-500">
                                                                                    Detalles
                                                                                    adicionales de la unidad
                                                                                    aquí...
                                                                                </p>
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
                        @endif
                        {{-- FINAL DE UNIT HISTORIES --}}


                        {{--  FINAL DE UNIT HISTORIES --}}












                        <hr x-data="{ show: @entangle('showUnitForm') }" {{-- x-show="show" --}}
                            x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 transform scale-90"
                            x-transition:enter-end="opacity-100 transform scale-100"
                            x-transition:leave="transition ease-in duration-300"
                            x-transition:leave-start="opacity-100 transform scale-100"
                            x-transition:leave-end="opacity-0 transform scale-90"
                            class="my-4 border-t border-gray-200 w-full col-span-full">

                        <div x-data="{ show: @entangle('showUnitForm') }" {{-- x-show="show" --}}
                            x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 transform scale-90"
                            x-transition:enter-end="opacity-100 transform scale-100"
                            x-transition:leave="transition ease-in duration-300"
                            x-transition:leave-start="opacity-100 transform scale-100"
                            x-transition:leave-end="opacity-0 transform scale-90" class="col-span-full mt-4">
                            <label for="files"
                                class="block text-sm font-medium leading-6 text-gray-900">Archivos</label>
                            <livewire:components.upload-file :multiple="true" :types="['image', 'document', 'video']" :name="'visit-files'" />
                        </div>

                    </div>
                </div>
            </div>


            {{-- 
            <div x-show="steps == 1">


                <button @click="steps = 2, alert('Comprueba que tus tu informacion de la visita sea correcta.')"
                    type="button"
                    class="ml-auto rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Siguiente</button>
            </div>

            <div x-show="steps == 2">

                <button 
                @click="steps = 3" type="button"
                    class="ml-auto rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Siguiente</button>

            </div> --}}


            {{-- IF DE PHP BLADE --}}
            <div x-show="steps == 3">
                <div class="grid-cols-12 max-w-screen-2xl p-8 ">

                    <div class="col-span-6  my-4">



                        <label for="visits" class="inline-block text-sm font-medium leading-6 text-gray-900">Pago
                            esperado
                        </label>
                        <div class="mt-2">
                            <livewire:components.select-general :selectedValue="$selectedExpectedPayment" :values="$expectedPayments" :imageValue="false"
                                :searchEnabled="false" :name="'expectedPayment'" :model="false" />
                        </div>
                        @error('selectedExpectedPayment')
                            <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                        @enderror


                    </div>


                    <div class="col-span-6   my-4">


                        @if ($selectedExpectedPayment == 'cash')
                            <div class="my-4">
                                <div class="">
                                    <livewire:components.toggle :checked="$payAllTheAmount" :answer="'Paga todo el monto?'"
                                        :name="'pay-all-the-amount'" />
                                </div>
                            </div>

                            <div>
                                <input
                                    class="relative rounded-md border-gray-300 shadow-sm focus:border-indigo-600 focus:ring focus:ring-indigo-600 focus:ring-opacity-50 block w-full sm:text-sm"
                                    id="amountReceived" type="text" wire:model.live="amountReceived"
                                    placeholder="Cantidad a usar..." x-mask:dynamic="$money($input, ',')"
                                    x-ref="input" x-on:keyup="$refs.input.blur(); $refs.input.focus()"
                                    @if ($payAllTheAmount) disabled @endif>

                            </div>
                        @endif

                    </div>
                    <div class="col-span-6 w-full">


                        <label for="reason_description"
                            class="inline-block text-sm font-medium leading-6 text-gray-900 mb-2">Informe de la
                            visita
                        </label>

                        <textarea x-data="{
                            resize() {
                                $el.style.height = '0px';
                                $el.style.height = $el.scrollHeight + 'px';
                                if ($el.scrollHeight > 130) {
                                    $el.style.height = '130px';
                                    $el.style.overflowY = 'auto';
                                }
                            }
                        }" x-init="resize()" @input="resize()" wire:model.defer="finalComment"
                            name="reason_description" placeholder="Comentarios finales sobre la visita..."
                            class="flex w-full h-auto min-h-[80px] max-h-[130px] px-3 py-2 text-sm bg-white border rounded-md border-neutral-300 ring-offset-background placeholder:text-neutral-400 focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 disabled:cursor-not-allowed disabled:opacity-50">
                        </textarea>
                        @error('finalComment')
                            <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                        @enderror
                    </div>


                </div>

                {{-- <hr> --}}




                @if ($formsDynamic)

                    <div class="col-span-full my-6 mx-6">

                        <hr class="sm:col-span-full">

                        @foreach ($formsDynamic as $key => $form)
                            @switch($form['input_type']->value)
                                @case('text')
                                    <div class="sm:col-span-4 my-4">
                                        <label for="text"
                                            class="block text-sm font-medium leading-6 text-gray-900">{{ $form['label'] }}
                                        </label>
                                        <div class="mt-2">
                                            <input id="text" wire:model.live="formsDynamic.{{ $key }}.value"
                                                type="{{ $form['input_type'] }}" autocomplete="number"
                                                placeholder="{{ $form['placeholder'] }}"
                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 text-sm sm:leading-6">
                                        </div>
                                        @error('formsDynamic.' . $key)
                                            <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                        @enderror
                                    </div>
                                @break

                                @case('number')
                                    <div class="sm:col-span-4 my-4">
                                        <label for="number"
                                            class="block text-sm font-medium leading-6 text-gray-900">{{ $form['label'] }}
                                        </label>
                                        <div class="mt-2">
                                            <input id="number" wire:model.live="formsDynamic.{{ $key }}.value"
                                                type="number" placeholder="{{ $form['placeholder'] }}"
                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 text-sm sm:leading-6">
                                        </div>
                                        @error('formsDynamic.' . $key)
                                            <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                        @enderror
                                    </div>
                                @break

                                @case('textarea')
                                    <div class="sm:col-span-4 my-4">
                                        <label for="textarea"
                                            class="block text-sm font-medium leading-6 text-gray-900">{{ $form['label'] }}
                                        </label>
                                        <div class="mt-2">
                                            <textarea id="textarea" wire:model.live="formsDynamic.{{ $key }}.value" rows="3"
                                                placeholder="{{ $form['placeholder'] }}"
                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 text-sm sm:leading-6"></textarea>
                                        </div>
                                        @error('formsDynamic.' . $key)
                                            <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                        @enderror
                                    </div>
                                @break

                                @case('toggle')
                                    <div class="sm:col-span-4 my-4" x-data="{ checked: @entangle('formsDynamic.' . $key . '.value') }">
                                        <label for="toggle" class="block text-sm font-medium leading-6 text-gray-900">
                                            {{ $form['label'] }}
                                        </label>

                                        <div class="mt-2">
                                            <button type="button"
                                                class="relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:ring-offset-2"
                                                role="switch" aria-checked="false" :aria-checked="checked.toString()"
                                                @click="checked = !checked"
                                                :class="{ 'bg-indigo-600': checked, 'bg-gray-200': !checked }">
                                                <span class="sr-only">Toggle</span>
                                                <span
                                                    class="pointer-events-none relative inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out"
                                                    :class="{ 'translate-x-5': checked, 'translate-x-0': !checked }">

                                                    {{-- Icono cuando está apagado (X) --}}
                                                    <span
                                                        class="absolute inset-0 flex h-full w-full items-center justify-center transition-opacity opacity-100 duration-200 ease-in"
                                                        aria-hidden="true"
                                                        :class="{
                                                            'opacity-0 duration-100 ease-out': checked,
                                                            'opacity-100 duration-200 ease-in':
                                                                !checked
                                                        }">
                                                        <svg class="h-3 w-3 text-gray-400" fill="none"
                                                            viewBox="0 0 12 12">
                                                            <path d="M4 8l2-2m0 0l2-2M6 6L4 4m2 2l2 2" stroke="currentColor"
                                                                stroke-width="2" stroke-linecap="round"
                                                                stroke-linejoin="round">
                                                            </path>
                                                        </svg>
                                                    </span>

                                                    {{-- Icono cuando está encendido (check) --}}
                                                    <span
                                                        class="absolute inset-0 flex h-full w-full items-center justify-center transition-opacity opacity-0 duration-100 ease-out"
                                                        aria-hidden="true"
                                                        :class="{
                                                            'opacity-100 duration-200 ease-in': checked,
                                                            'opacity-0 duration-100 ease-out':
                                                                !checked
                                                        }">
                                                        <svg class="h-3 w-3 text-indigo-600" fill="currentColor"
                                                            viewBox="0 0 12 12">
                                                            <path
                                                                d="M3.707 5.293a1 1 0 00-1.414 1.414l1.414-1.414zM5 8l-.707.707a1 1 0 001.414 0L5 8zm4.707-3.293a1 1 0 00-1.414-1.414l1.414 1.414zm-7.414 2l2 2 1.414-1.414-2-2-1.414 1.414zm3.414 2l4-4-1.414-1.414-4 4 1.414 1.414z">
                                                            </path>
                                                        </svg>
                                                    </span>
                                                </span>
                                            </button>
                                        </div>

                                        {{-- Mostrar errores de validación de Livewire, si los hay --}}
                                        @error('formsDynamic.' . $key . '.value')
                                            <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                        @enderror
                                    </div>
                                @break

                                @case('select')
                                    <div class="sm:col-span-4 my-4">
                                        <label for="select-{{ $key }}"
                                            class="block text-sm font-medium leading-6 text-gray-900">
                                            {{ $form['label'] }}
                                        </label>

                                        <div class="mt-2">
                                            <select id="select-{{ $key }}"
                                                wire:model.live="formsDynamic.{{ $key }}.value"
                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 text-sm sm:leading-6">

                                                <option value="{{ null }}">Selecciona una opción</option>

                                                @foreach (json_decode($form['options'], true) as $option)
                                                    <option value="{{ $option['value'] }}">
                                                        {{ $option['label'] }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        @error('formsDynamic.' . $key . '.value')
                                            <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                        @enderror
                                    </div>
                                @break

                                @default
                            @endswitch
                        @endforeach


                    </diV>
                @endif




            </div>
            {{-- END IF DE PHP BLADE --}}
        </div>



    </div>
</div>
