@php
    use App\Enums\Units\UnitMeditionTypeEnum;

@endphp

<div>
    <header class="bg-white shadow">
        <div class="mx-auto max-w-screen-2xl px-4 py-6 sm:px-6 lg:px-8">
            <div class="md:flex md:items-center md:justify-between">
                <div class="min-w-0 flex-1">
                    <h1 class="text-2xl font-bold tracking-tight text-gray-900">Gestiona gestiona tu unidad
                        {{ $unit->tag }}-{{ $unit->product->name }}</h1>
                </div>
                <div class="mt-4 flex md:ml-4 md:mt-0">
                    <a wire:navigate href="{{ route('panel.stock.inventory-list', $product) }}"
                        class="inline-flex items-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">Volver</a>
                </div>
            </div>
        </div>
    </header>
    <main>
        <div class="mx-auto max-w-screen-2xl py-6 sm:px-6 lg:px-8">
            <div class="mt-8 flow-root">
                <div class="space-y-10 divide-y divide-gray-900/10">
                    <div class="grid grid-cols-1 gap-x-8 gap-y-8 md:grid-cols-4">
                        <div class="px-4 sm:px-0">
                            <h2 class="text-base font-semibold leading-7 text-gray-900">Realizar accion de unidad de
                                inventario</h2>
                            <p class="mt-1 text-sm leading-6 text-gray-600">Selecciona que tipo de accion debes
                                realizar.</p>
                            </div>
                        <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl md:col-span-3">
                            <div class="px-4 py-6 sm:p-8">
                                <div class="grid w-full grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-9">
                                    <div class="sm:col-span-6">
                                        <label for="products"
                                            class="block text-sm font-medium leading-6 text-gray-900">Acciones</label>
                                        <div class="mt-2">
                                            <livewire:components.select-general :values="$actionsList" :imageValue="false"
                                                :searchEnabled="false" :name="'action-type'" :selectAllActivated="false" :model="false">
                                        </div>
                                        @error('actionType')
                                            <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    @if ($actionType)
                                        @if ($actionType['id'] == 1)
                                            <div class="sm:col-span-3">
                                                <label for="products"
                                                    class="block text-sm font-medium leading-6 text-gray-900">Motivos de baja</label>
                                                <div class="mt-2">
                                                    <livewire:components.select-general :values="$reasonList"
                                                        :imageValue="false" :searchEnabled="false" :name="'reason-description'"
                                                        :selectAllActivated="false" :model="false">
                                                </div>
                                                @error('actionType')
                                                    <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="sm:col-span-full">
                                                <label for="reason_description"
                                                    class="block text-sm font-medium leading-6 text-gray-900">Desarrolla
                                                    el motivo de la baja.</label>
                                                <div class="mt-2">
                                                    <textarea x-data="{
                                                        resize() {
                                                            $el.style.height = '0px';
                                                            $el.style.height = $el.scrollHeight + 'px';
                                                            if ($el.scrollHeight > 130) {
                                                                $el.style.height = '130px';
                                                                $el.style.overflowY = 'auto';
                                                            }
                                                        }
                                                    }" x-init="resize()" @input="resize()" wire:model="reason_description"
                                                        name="reason_description" type="text"
                                                        placeholder="Type your message here. I will resize based on the height content."
                                                        class="flex w-full h-auto min-h-[80px] max-h-[130px] px-3 py-2 text-sm bg-white border rounded-md border-neutral-300 ring-offset-background placeholder:text-neutral-400 focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 disabled:cursor-not-allowed disabled:opacity-50"></textarea>
                                                </div>
                                                @error('quantity')
                                                    <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        @elseif($actionType['id'] == 3)
                                            {{-- //TRANSFERIR UNA UNIDAD A UN DEPOSITO --}}
                                            <div class="sm:col-span-3">
                                                <label for="selected-warehouse"
                                                    class="block text-sm font-medium leading-6 text-gray-900">Selecciona
                                                    el deposito al que transferir la unidad.</label>
                                                <div class="mt-2">

                                                    <livewire:components.select-general :values="$warehouses"
                                                        :imageValue="false" :searchEnabled="false" :name="'selected-warehouse'"
                                                        :selectAllActivated="false" :model="false">
                                                </div>
                                                @error('actionType')
                                                    <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="sm:col-span-full">
                                                <label for="reason_description"
                                                    class="block text-sm font-medium leading-6 text-gray-900">Describe
                                                    el motivo de la transferencia(opcional).</label>
                                                <div class="mt-2">
                                                    <textarea x-data="{
                                                        resize() {
                                                            $el.style.height = '0px';
                                                            $el.style.height = $el.scrollHeight + 'px';
                                                            if ($el.scrollHeight > 130) {
                                                                $el.style.height = '130px';
                                                                $el.style.overflowY = 'auto';
                                                            }
                                                        }
                                                    }" x-init="resize()" @input="resize()" wire:model="reason_description"
                                                        name="reason_description" type="text"
                                                        placeholder="Type your message here. I will resize based on the height content."
                                                        class="flex w-full h-auto min-h-[80px] max-h-[130px] px-3 py-2 text-sm bg-white border rounded-md border-neutral-300 ring-offset-background placeholder:text-neutral-400 focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 disabled:cursor-not-allowed disabled:opacity-50"></textarea>
                                                </div>
                                                @error('quantity')
                                                    <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        @elseif($actionType['id'] == 4)
                                            <div class="sm:col-span-3">
                                                <label for="selected-worker"
                                                    class="block text-sm font-medium leading-6 text-gray-900">Selecciona
                                                    el operario al que transferir la unidad.</label>
                                                <div class="mt-2">
                                                    <livewire:components.select-general :values="$workers"
                                                        :imageValue="false" :searchEnabled="false" :name="'selected-worker'"
                                                        :selectAllActivated="false" :model="false">
                                                </div>
                                                @error('actionType')
                                                    <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="sm:col-span-full">
                                                <label for="reason_description"
                                                    class="block text-sm font-medium leading-6 text-gray-900">Desarrolla
                                                    el motivo de la transferencia(opcional).</label>
                                                <div class="mt-2">
                                                    <textarea x-data="{
                                                        resize() {
                                                            $el.style.height = '0px';
                                                            $el.style.height = $el.scrollHeight + 'px';
                                                            if ($el.scrollHeight > 130) {
                                                                $el.style.height = '130px';
                                                                $el.style.overflowY = 'auto';
                                                            }
                                                        }
                                                    }" x-init="resize()" @input="resize()" wire:model="reason_description"
                                                        name="reason_description" type="text"
                                                        placeholder="Type your message here. I will resize based on the height content."
                                                        class="flex w-full h-auto min-h-[80px] max-h-[130px] px-3 py-2 text-sm bg-white border rounded-md border-neutral-300 ring-offset-background placeholder:text-neutral-400 focus:border-neutral-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-neutral-400 disabled:cursor-not-allowed disabled:opacity-50"></textarea>
                                                </div>
                                                @error('quantity')
                                                    <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        @elseif($actionType['id'] == 5)
                                            <div class="sm:col-span-3">
                                                <label for="selected-worker"
                                                    class="block text-sm font-medium leading-6 text-gray-900">Selecciona
                                                    la unidad a la que sumar.</label>
                                                <div class="mt-2">
                                                    <livewire:components.select-general :values="$selectUnits"
                                                        :imageValue="false" :searchEnabled="true" :name="'selected-unit'"
                                                        :selectAllActivated="false" :model="false">
                                                </div>
                                                @error('actionType')
                                                    <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                                @enderror
                                            </div>




                                            <div class="sm:col-span-full">
                                                <label for="reason_description"
                                                    class="block text-sm font-medium leading-6 text-gray-900">Desarrolla
                                                    el motivo de la suma(opcional).</label>
                                                <div class="mt-2">
                                                    <textarea x-data="{
                                                        resize() {
                                                            $el.style.height = '0px';
                                                            $el.style.height = $el.scrollHeight + 'px';
                                                            if ($el.scrollHeight > 130) {
                                                                $el.style.height = '130px';
                                                                $el.style.overflowY = 'auto';
                                                            }
                                                        }
                                                    }" x-init="resize()" @input="resize()" wire:model="reason_description"
                                                        name="reason_description" type="text"
                                                        placeholder="Type your message here. I will resize based on the height content."
                                                        class="flex w-full h-auto min-h-[80px] max-h-[130px] px-3 py-2 text-sm bg-white border rounded-md border-neutral-300 ring-offset-background placeholder:text-neutral-400 focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 disabled:cursor-not-allowed disabled:opacity-50"></textarea>
                                                </div>
                                                @error('quantity')
                                                    <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            @if ($selectedUnit)
                                                <div class="lg:col-span-2 col-span-3 ">
                                                    <label for="transfer_quantity"
                                                        class="block text-sm font-medium leading-6 text-gray-900">Cantidad
                                                        a transferir.</label>
                                                    <div class="mt-2 ">
                                                        <input type="number"
                                                            wire:model.live.debounce.250ms="transfer_quantity"
                                                            name="transfer_quantity" id="transfer_quantity"
                                                            autocomplete="off" placeholder="Escriba cantidad"
                                                            class="block w-full  rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 text-sm sm:leading-6">
                                                    </div>
                                                    @error('transfer_quantity')
                                                        <span
                                                            class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                                    @enderror
                                                </div>


                                                <div class="sm:col-span-7 col-span-full">

                                                    <div
                                                        class="bg-white w-full shadow rounded-lg overflow-hidden max-w-4xl mx-auto">
                                                        <div class="px-4 py-5 sm:px-6">
                                                            <h3 class="text-lg leading-4 text-start font-medium text-gray-900">
                                                                Resumen de Transferencia
                                                            </h3>
                                                        </div>
                                                        <div class="border-t border-gray-200">
                                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 p-4">
                                                                <div class="space-y-4">
                                                                    <h4 class="text-sm font-small text-gray-500  ">
                                                                        Emisor</h4>
                                                                    <div class="bg-gray-50 rounded-md p-4 space-y-2">
                                                                        <div class="flex justify-between">
                                                                            <span
                                                                                class="text-sm font-medium text-gray-500">Cantidad
                                                                                inicial:</span>
                                                                            <span
                                                                                class="text-sm text-gray-900">{{ $this->unit['initial_quantity'] }}
                                                                                {{ UnitMeditionTypeEnum::from($this->product_unit_measure)->abbreviation() }}</span>
                                                                        </div>
                                                                        <div class="flex justify-between">
                                                                            <span
                                                                                class="text-sm font-medium text-gray-500">Cantidad
                                                                                actual:</span>
                                                                            <span
                                                                                class="text-sm text-gray-900">{{ $this->unit['current_quantity'] }}
                                                                                {{ UnitMeditionTypeEnum::from($this->product_unit_measure)->abbreviation() }}</span>
                                                                        </div>
                                                                        <div class="flex justify-between">
                                                                            <span
                                                                                class="text-sm font-medium text-gray-500">Cantidad
                                                                                final:</span>
                                                                            <span
                                                                                class="text-sm font-semibold text-gray-900">{{ $this->unit['final_quantity'] ?? $this->unit['current_quantity'] }}
                                                                                {{ UnitMeditionTypeEnum::from($this->product_unit_measure)->abbreviation() }}</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="space-y-4">
                                                                    <h4 class="text-sm font-small text-gray-500  ">
                                                                        Receptor</h4>
                                                                    <div class="bg-gray-50 rounded-md p-4 space-y-2">
                                                                        <div class="flex justify-between">
                                                                            <span
                                                                                class="text-sm font-medium text-gray-500">Cantidad
                                                                                inicial:</span>
                                                                            <span
                                                                                class="text-sm text-gray-900">{{ $selectedUnit['initial_quantity'] }}
                                                                                {{ UnitMeditionTypeEnum::from($selectedUnit['unit_of_measurement'])->abbreviation() }}</span>
                                                                        </div>
                                                                        <div class="flex justify-between">
                                                                            <span
                                                                                class="text-sm font-medium text-gray-500">Cantidad
                                                                                actual:</span>
                                                                            <span
                                                                                class="text-sm text-gray-900">{{ $selectedUnit['current_quantity'] }}
                                                                                {{ UnitMeditionTypeEnum::from($selectedUnit['unit_of_measurement'])->abbreviation() }}</span>
                                                                        </div>
                                                                        <div class="flex justify-between">
                                                                            <span
                                                                                class="text-sm font-medium text-gray-500">Cantidad
                                                                                final:</span>
                                                                            <span
                                                                                class="text-sm font-semibold text-gray-900">{{ $selectedUnit['final_quantity'] ?? $selectedUnit['current_quantity'] }}
                                                                                {{ UnitMeditionTypeEnum::from($selectedUnit['unit_of_measurement'])->abbreviation() }}</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            @endif
                                        @endif
                                    @endif
                                </div>
                            </div>
                            @if ($actionType)
                            @if ($actionType['id'] == 1)
                                <div class="flex items-center justify-end gap-x-6 border-t border-gray-900/10 px-4 py-4 sm:px-8">
                                    <button wire:click="save"
                                        wire:confirm="¿Realmente deseas dar de baja esta unidad del inventario? \n\n   Esta acción es irreversible."
                                        class="rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm
                                        hover:bg-red-500 focus-visible:outline focus-visible:outline-2
                                        focus-visible:outline-offset-2 focus-visible:outline-red-600">Dar de baja</button>
                                </div>
                            @elseif ($actionType['id'] == 3 || $actionType['id'] == 4 || ($actionType['id'] == 5 && $unit['final_quantity'] > 0))
                                <div class="flex items-center justify-end gap-x-6 border-t border-gray-900/10 px-4 py-4 sm:px-8">
                                    <button wire:click="save"
                                        class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm
                                        hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2
                                        focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Guardar</button>
                                </div>
                            @elseif ($actionType['id'] == 5 && $unit['final_quantity'] == 0)
                                <div class="flex items-center justify-end gap-x-6 border-t border-gray-900/10 px-4 py-4 sm:px-8">
                                    <button wire:click="save"
                                        wire:confirm="Si realiza esta transferencia el emisor se dará de baja automáticamente."
                                        class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm
                                        hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2
                                        focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Guardar</button>
                                </div>
                            @endif
                        @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
   
</div>








   
