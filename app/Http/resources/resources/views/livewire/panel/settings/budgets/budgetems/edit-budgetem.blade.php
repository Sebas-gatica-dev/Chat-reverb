<div>
    <div class="mx-auto max-w-screen-2xl pt-2 lg:flex lg:gap-x-16 lg:px-8">
        <h1 class="sr-only">Edición de Variable Presupuestaria</h1>

        <aside
            class="flex overflow-x-auto border-b border-gray-900/5 py-4 lg:block lg:w-64 lg:flex-none lg:border-0 lg:py-20">
            @include('components.panel.settings.menu-side-bar-settings')
        </aside>

        <main class="px-4 py-16 sm:px-6 lg:flex-auto lg:px-0 lg:py-20">
            <div class="mx-auto max-w-2xl space-y-4 sm:space-y-6 lg:mx-0 lg:max-w-none">
                <div class="sm:flex sm:items-center">
                    <div class="sm:flex-auto">
                        <h1 class="text-base font-semibold leading-6 text-gray-900">Variable Presupuestaria</h1>
                        <p class="mt-2 text-sm text-gray-700">Edita la variable presupuestaria: {{ $budgetem->name }}</p>
                    </div>
                    <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                        <a href="{{ route('panel.settings.budgets.budgetems.list') }}" wire:navigate
                            class="cursor-pointer block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm
                                hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                            Atrás
                        </a>
                    </div>
                </div>

                <div class="mt-8 flow-root">
                    <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl md:col-span-3">
                        <div class="px-4 py-6 sm:p-8">
                            <div class="grid w-full grid-cols-1 gap-x-6 gap-y-6 md:gap-y-8 sm:grid-cols-12">
                                <!-- Nombre -->
                                <div class="col-span-full sm:col-span-6 md:col-span-6 xl:col-span-6">
                                    <label for="name"
                                        class="block text-sm font-medium leading-6 text-gray-900">Nombre</label>
                                    <div class="mt-2">
                                        <input type="text" wire:model="name" id="name" autocomplete="off"
                                            placeholder="Escriba el nombre"
                                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300
                                                placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 text-sm sm:leading-6">
                                    </div>
                                    @error('name')
                                        <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                    @enderror
                                </div>
                                <!-- Descripción -->
                                <div class="col-span-full sm:col-span-6 md:col-span-6 xl:col-span-6">
                                    <label for="description"
                                        class="block text-sm font-medium leading-6 text-gray-900">Descripción</label>
                                    <div class="mt-2">
                                        <textarea wire:model="description" id="description" rows="3"
                                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300
                                                                                placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 text-sm sm:leading-6"
                                            placeholder="Escriba una descripción (opcional)"></textarea>
                                    </div>
                                    @error('description')
                                        <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Descripción del Ítem -->
                                <div class="col-span-full">
                                    <label for="description_item"
                                        class="block text-sm font-medium leading-6 text-gray-900">Descripción del
                                        Ítem</label>
                                    <div class="mt-2">
                                        <textarea wire:model="description_item" id="description_item" rows="3"
                                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300
                                                                                placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 text-sm sm:leading-6"
                                            placeholder="Escriba una descripción para el ítem (opcional)"></textarea>
                                    </div>
                                    @error('description_item')
                                        <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                    @enderror
                                </div>


                                <!-- Visible en el Documento -->
                                <div class="col-span-full sm:col-span-6 md:col-span-6 xl:col-span-4">
                                    <fieldset>
                                        <legend class="block text-sm font-medium leading-6 text-gray-900">Visible en el
                                            documento</legend>
                                        <div class="mt-4 space-y-4">
                                            <div class="flex items-center">
                                                <input id="visible_doc_yes" name="visible_doc" type="radio"
                                                    wire:model="visible_doc" value="1"
                                                    class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600">
                                                <label for="visible_doc_yes"
                                                    class="ml-3 block text-sm font-medium leading-6 text-gray-900">
                                                    Sí
                                                </label>
                                            </div>
                                            <div class="flex items-center">
                                                <input id="visible_doc_no" name="visible_doc" type="radio"
                                                    wire:model="visible_doc" value="0"
                                                    class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600">
                                                <label for="visible_doc_no"
                                                    class="ml-3 block text-sm font-medium leading-6 text-gray-900">
                                                    No
                                                </label>
                                            </div>
                                        </div>
                                    </fieldset>
                                    @error('visible_doc')
                                        <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                    @enderror
                                </div>


                                <!-- Tipo (Público/Privado) -->
                                <div class="col-span-full sm:col-span-6 md:col-span-6 xl:col-span-4">
                                    <fieldset>
                                        <legend class="block text-sm font-medium leading-6 text-gray-900">Tipo</legend>
                                        <div class="mt-4 space-y-4">
                                            <div class="flex items-center">
                                                <input id="type_public" name="private" type="radio"
                                                    wire:model="private" value="0"
                                                    class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600"
                                                    @if ($isInUse) disabled @endif>
                                                <label for="type_public"
                                                    class="ml-3 block text-sm font-medium leading-6 text-gray-900">
                                                    Público
                                                </label>
                                            </div>
                                            <div class="flex items-center">
                                                <input id="type_private" name="private" type="radio"
                                                    wire:model="private" value="1"
                                                    class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600"
                                                    @if ($isInUse) disabled @endif>
                                                <label for="type_private"
                                                    class="ml-3 block text-sm font-medium leading-6 text-gray-900">
                                                    Privado
                                                </label>
                                            </div>
                                        </div>
                                    </fieldset>
                                    @error('private')
                                        <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                    @enderror
                                </div>


                                <!-- Tipo de Cálculo -->

                                <!-- Tipo de Cálculo -->
                                <div class="col-span-full sm:col-span-6 md:col-span-6 xl:col-span-4">
                                    <fieldset>
                                        <legend class="block text-sm font-medium leading-6 text-gray-900">Tipo de
                                            cálculo</legend>
                                        <div class="mt-4 space-y-4">
                                            <div class="flex items-center">
                                                <input id="operator_sum" name="operator" type="radio"
                                                    wire:model="operator" value="1"
                                                    class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600"
                                                    @if ($isInUse) disabled @endif>
                                                <label for="operator_sum"
                                                    class="ml-3 block text-sm font-medium leading-6 text-gray-900">
                                                    Sumar
                                                </label>
                                            </div>
                                            <div class="flex items-center">
                                                <input id="operator_rest" name="operator" type="radio"
                                                    wire:model="operator" value="0"
                                                    class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600"
                                                    @if ($isInUse) disabled @endif>
                                                <label for="operator_rest"
                                                    class="ml-3 block text-sm font-medium leading-6 text-gray-900">
                                                    Restar
                                                </label>
                                            </div>
                                        </div>
                                    </fieldset>
                                    @error('operator')
                                        <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                    @enderror
                                </div>


                            </div>

                            <div class="grid w-full grid-cols-1 gap-x-6 gap-y-6 md:gap-y-8 sm:grid-cols-12 mt-4"
                                x-data="{ type: @entangle('type').live }">

                                <!-- Operador -->
                                <div class="col-span-full sm:col-span-6 md:col-span-6 xl:col-span-6">
                                    <label for="type"
                                        class="block text-sm font-medium leading-6 text-gray-900">Operador</label>
                                    <div class="mt-2">
                                        <select id="type" wire:model.live="type" x-model="type"
                                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset
                                                    ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6"
                                            @if ($isInUse) disabled @endif>
                                            <option value="">Seleccione el operador</option>
                                            @foreach (\App\Enums\TypeBudgetemEnum::cases() as $typeEnum)
                                                <option value="{{ $typeEnum->value }}">
                                                    {{ $typeEnum->getName() }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('type')
                                        <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Campo 'value' -->
                                <div class="col-span-full sm:col-span-6 md:col-span-6 xl:col-span-6"
                                    x-show=" (type === 'countable' || type === 'fixed') && (type != '')">
                                    <label for="value"
                                        class="block text-sm font-medium leading-6 text-gray-900">Valor</label>
                                    <div class="mt-2">
                                        <input type="number" step="0.01" wire:model="value" id="value"
                                            autocomplete="off" placeholder="Escriba el valor"
                                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300
                                                    placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 text-sm sm:leading-6">
                                    </div>
                                    @error('value')
                                        <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Campos 'min', 'max', 'default_quantity' -->
                                <div class="col-span-full grid grid-cols-1 sm:grid-cols-2 gap-4"
                                    x-show="!(type === 'fixed') && (type != '')">
                                    <!-- Valor Mínimo -->
                                    <div>
                                        <label for="min"
                                            class="block text-sm font-medium leading-6 text-gray-900">Valor
                                            Mínimo</label>
                                        <div class="mt-2">
                                            <input type="number" step="0.01" wire:model="min" id="min"
                                                autocomplete="off" placeholder="Escriba el valor mínimo"
                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300
                                                            placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 text-sm sm:leading-6">
                                        </div>
                                        @error('min')
                                            <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <!-- Valor Máximo -->
                                    <div>
                                        <label for="max"
                                            class="block text-sm font-medium leading-6 text-gray-900">Valor
                                            Máximo</label>
                                        <div class="mt-2">
                                            <input type="number" step="0.01" wire:model="max" id="max"
                                                autocomplete="off" placeholder="Escriba el valor máximo"
                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300
                                                            placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 text-sm sm:leading-6">
                                        </div>
                                        @error('max')
                                            <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <!-- Cantidad por Defecto -->
                                    <div class="col-span-full sm:col-span-2">
                                        <label for="default_quantity"
                                            class="block text-sm font-medium leading-6 text-gray-900">Cantidad
                                            por Defecto</label>
                                        <div class="mt-2">
                                            <input type="number" step="1" wire:model="default_quantity"
                                                id="default_quantity" autocomplete="off"
                                                placeholder="Escriba la cantidad por defecto"
                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300
                                                            placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 text-sm sm:leading-6">
                                        </div>
                                        @error('default_quantity')
                                            <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                        @enderror
                                    </div>

                                </div>


                                @if ($isInUse)
                                    <div class="col-span-full flex items-center gap-x-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="size-6 text-yellow-400">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M12 9v3.75m0-10.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.75c0 5.592 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.57-.598-3.75h-.152c-3.196 0-6.1-1.25-8.25-3.286Zm0 13.036h.008v.008H12v-.008Z" />
                                        </svg>

                                        <p class=" text-gray-500 text-xs">
                                            Algunos campos están deshabilitados porque esta variable ya está en uso
                                            en al menos un presupuesto o plantilla.
                                        </p>
                                    </div>
                                @endif
                            </div>


                            <!-- Botón de Actualizar -->
                            <div class="flex items-center justify-end gap-x-6 mt-6">
                                <button wire:click="update"
                                    class="rounded-md bg-indigo-600 px-3 py-2 font-semibold text-white shadow-sm
                                        hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2
                                        focus-visible:outline-offset-2 text-sm focus-visible:outline-indigo-600">
                                    Actualizar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
        </main>
    </div>




    <!-- Modal -->
    <div x-data="{ showModal: @entangle('showUpdateModal').live }" x-show="showModal" class="fixed inset-0 z-10 overflow-y-auto" x-cloak>
        <div class="flex items-center justify-center min-h-screen">
            <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:w-full sm:max-w-lg">
                <div class="px-4 py-5 sm:p-6">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                        Confirmar actualización de presupuestos
                    </h3>
                    <div class="mt-2">
                        <p class="text-sm text-gray-500">
                            Ha modificado el valor o cantidad por defecto. ¿Cómo desea proceder con los presupuestos que
                            usan esta variable?
                        </p>
                    </div>
                    <div class="mt-4">
                        <!-- Checkbox 1: keepOldPrice -->
                        <div class="flex items-center">
                            <input id="keepOldPrice" wire:model.live="keepOldPrice" type="checkbox"
                                class="h-4 w-4 text-indigo-600 border-gray-300 focus:ring-indigo-600">
                            <label for="keepOldPrice" class="ml-2 block text-sm text-gray-900">
                                Mantener con precio antiguo los presupuestos
                            </label>
                        </div>
                        <!-- Mostrar select si keepOldPrice es verdadero -->
                        @if ($keepOldPrice)
                            <div class="mt-4">
                                <label for="timePeriod" class="block text-sm font-medium text-gray-700">
                                    Ultimos:
                                </label>
                                <select id="timePeriod" wire:model.live="timePeriod"
                                    class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300
                                focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                    <option value="">Seleccione una opción</option>
                                    @foreach ($timePeriods as $period)
                                        <option value="{{ $period }}">{{ $period }} días</option>
                                    @endforeach
                                </select>
                                @error('timePeriod')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        @endif

                        <!-- Checkbox 2: updateTemplatesToggle -->
                        <div class="mt-4 flex items-center">
                            <input id="updateTemplatesToggle" wire:model="updateTemplatesToggle" type="checkbox"
                                class="h-4 w-4 text-indigo-600 border-gray-300 focus:ring-indigo-600" checked>
                            <label for="updateTemplatesToggle" class="ml-2 block text-sm text-gray-900">
                                Actualizar plantillas (templates)
                            </label>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button wire:click="performUpdate" type="button"
                        class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2
                        bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none
                        focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm:w-auto sm:text-sm">
                        Aceptar
                    </button>
                    <button wire:click="$set('showUpdateModal', false)" type="button"
                        class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2
                        bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none
                        focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Cancelar
                    </button>
                </div>
            </div>
        </div>
    </div>


</div>
