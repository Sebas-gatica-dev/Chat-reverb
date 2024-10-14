<div>

    <header class="bg-white shadow">
        <div class="mx-auto max-w-screen-2xl px-4 py-6 sm:px-6 lg:px-8">
            <div class="md:flex md:items-center md:justify-between">
                <div class="min-w-0 flex-1">
                    <h1 class="text-2xl font-bold tracking-tight text-gray-900">Agregar Unidades de inventario</h1>
                </div>
                <div class="mt-4 flex md:ml-4 md:mt-0">
                    <a wire:navigate href="{{ route('panel.stock.list') }}"
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
                            <h2 class="text-base font-semibold leading-7 text-gray-900">Datos complementarios del
                                producto</h2>
                            <p class="mt-1 text-sm leading-6 text-gray-600">Ingresa datos extra que te permitiran
                                gestionar las unidades del inventario.</p>
                        </div>

                        <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl md:col-span-3">
                            <div class="px-4 py-6 sm:p-8">
                                <div class="grid w-full grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-9">
                                    <!-- Nombre -->
                                    <div class="sm:col-span-3">
                                        <label for="quantity"
                                            class="block text-sm font-medium leading-6 text-gray-900">Cantidad de
                                            unidades</label>
                                        <div class="mt-2">
                                            <input wire:model="quantity" type="number" name="quantity"
                                                id="quantity" autocomplete="given-name"
                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                        </div>
                                        @error('quantity')
                                            <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                        @enderror
                                    </div>



                                    <div class="sm:col-span-3">
                                        <label for="batch"
                                            class="block text-sm font-medium leading-6 text-gray-900">Lote</label>
                                        <div class="mt-2">
                                            <input wire:model="batch" id="batch" name="batch" type="text"
                                                autocomplete="batch"
                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                        </div>
                                        @error('batch')
                                            <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                        @enderror
                                    </div>


                                    <div class="sm:col-span-3">
                                        <label for="products"
                                            class="block text-sm font-medium leading-6 text-gray-900">Productos</label>
                                        <div class="mt-2">
                                     
                                            <livewire:components.select-general :values="$products" :imageValue="false"
                                                :searchEnabled="true" :name="'products'" :selectAllActivated="false" :model="false">
                                        </div>
                                        @error('selectedProduct.*')
                                            <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="sm:col-span-3">
                                        <label for="warehouses"
                                            class="block text-sm font-medium leading-6 text-gray-900">Depositos</label>
                                        <div class="mt-2">
                                            <livewire:components.select-general :values="$warehouses" :imageValue="false"
                                                :searchEnabled="true" :name="'warehouses'" :model="false">
                                        </div>
                                        @error('selectedWarehouse')
                                            <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                        @enderror
                                    </div>


                                    <div class="sm:col-span-3">
                                        <label for="cost"
                                            class="block text-sm font-medium leading-6 text-gray-900">Costo</label>
                                        <div class="mt-2">
                                            <input wire:model="cost" type="number" name="cost" id="cost"
                                                autocomplete="cost"
                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                        </div>
                                        @error('cost')
                                            <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                        @enderror

                                    </div>

                                    <div class="sm:col-span-3">
                                        <label for="profit"
                                            class="block text-sm font-medium leading-6 text-gray-900">Ganancia
                                            estimada</label>
                                        <div class="mt-2">
                                            <input wire:model="profit" type="number" name="profit" id="profit"
                                                autocomplete="profit"
                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                        </div>
                                        @error('profit')
                                            <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                        @enderror

                                    </div>



                                    {{-- <livewire:components.pines-custom.date-picker-pines-custom model="expiration_date" /> --}}
                                    <div class="sm:col-span-3">
                                        <label for="expirationDate"
                                            class="block text-sm font-medium leading-6 text-gray-900">Fecha de
                                            expiración</label>
                                        <div class="mt-2">
                                            <input wire:model="expirationDate" type="date" name="expirationDate"
                                                id="expirationDate" autocomplete="expirationDate"
                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                        </div>

                                    </div>
                                    <div class="sm:col-span-3">
                                        <label for="entryDate"
                                            class="block text-sm font-medium leading-6 text-gray-900">Fecha de
                                            ingreso</label>
                                        <div class="mt-2">
                                            <input wire:model="entryDate" type="date" name="entryDate"
                                                id="entryDate" autocomplete="entryDate"
                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                        </div>

                                    </div>


                                </div>
                            </div>

                            <div
                                class="flex items-center justify-end gap-x-6 border-t border-gray-900/10 px-4 py-4 sm:px-8">
                                <button wire:click="save"
                                    class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm
                                  hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2
                                  focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Guardar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
