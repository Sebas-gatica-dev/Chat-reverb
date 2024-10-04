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
                        <a href="{{ route('panel.settings.budgetems.list') }}" wire:navigate
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
                                <div class="col-span-full sm:col-span-6 md:col-span-6 xl:col-span-6">
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
                                <div class="col-span-full sm:col-span-6 md:col-span-6 xl:col-span-6">
                                    <fieldset>
                                        <legend class="block text-sm font-medium leading-6 text-gray-900">Tipo</legend>
                                        <div class="mt-4 space-y-4">
                                            <div class="flex items-center">
                                                <input id="type_public" name="private" type="radio"
                                                    wire:model="private" value="1"
                                                    class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600">
                                                <label for="type_public"
                                                    class="ml-3 block text-sm font-medium leading-6 text-gray-900">
                                                    Público
                                                </label>
                                            </div>
                                            <div class="flex items-center">
                                                <input id="type_private" name="private" type="radio"
                                                    wire:model="private" value="0"
                                                    class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600">
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

                            </div>

                            <div class="grid w-full grid-cols-1 gap-x-6 gap-y-6 md:gap-y-8 sm:grid-cols-12 mt-4"
                                x-data="{ operator: @entangle('operator').live }">
                                <!-- Operador -->
                                <div class="col-span-full sm:col-span-6 md:col-span-6 xl:col-span-6">
                                    <label for="operator"
                                        class="block text-sm font-medium leading-6 text-gray-900">Operador</label>
                                    <div class="mt-2">
                                        <select id="operator" wire:model.live="operator" x-model="operator"
                                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset
                                                    ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                            <option value="">Seleccione el operador</option>
                                            @foreach (\App\Enums\OperatorBudgetemEnum::cases() as $operatorEnum)
                                                <option value="{{ $operatorEnum->name }}">
                                                    {{ $operatorEnum->value }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('operator')
                                        <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Campo 'value' -->
                                <div class="col-span-full sm:col-span-6 md:col-span-6 xl:col-span-6"
                                    x-show=" (operator === 'COUNTABLE' || operator === 'FIXED') && (operator != '')">
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
                                    x-show="!(operator === 'FIXED') && (operator != '')">
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
</div>
