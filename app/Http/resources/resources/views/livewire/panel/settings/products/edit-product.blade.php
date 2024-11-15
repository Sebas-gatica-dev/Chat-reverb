<div>
    <div class="mx-auto max-w-screen-2xl pt-2 lg:flex lg:gap-x-16 lg:px-8">
        <h1 class="sr-only">Editar un producto</h1>

        <!-- Sidebar -->
        <aside
            class="flex overflow-x-auto border-b border-gray-900/5 py-4 lg:block lg:w-64 lg:flex-none lg:border-0 lg:py-20">
            @include('components.panel.settings.menu-side-bar-settings')
        </aside>

        <!-- Main content -->
        <main class="px-4 py-16 sm:px-6 lg:flex-auto lg:px-0 lg:pt-20 ">
            <div class="mx-auto max-w-2xl space-y-4 sm:space-y-4 lg:mx-0 lg:max-w-none">

                <!-- Header section -->
                <div class="sm:flex sm:items-center">
                    <div class="sm:flex-auto">
                        <h1 class="text-base font-semibold leading-6 text-gray-900">Producto</h1>
                        <p class="mt-2 text-sm text-gray-700">Editar un producto del inventario</p>
                    </div>
                    <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                        <a wire:navigate href="{{ route('panel.settings.stock.product.list') }}"
                            class="cursor-pointer block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                            Atrás
                        </a>
                    </div>
                </div>

                <!-- Formulario -->
                <div class="mt-8 flow-root">
                    <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl md:col-span-3">
                        <div class="px-4 py-6 sm:p-8">
                            <div class="grid w-full grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-9">

                                <!-- Nombre del producto -->
                                <div class="lg:col-span-3 col-span-full">
                                    <label for="name"
                                        class="block text-sm font-medium leading-6 text-gray-900">Nombre del
                                        producto</label>
                                    <div class="mt-2">
                                        <input type="text" wire:model="name" name="name" id="name"
                                            autocomplete="off" placeholder="Escriba un nombre para la sucursal"
                                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 text-sm sm:leading-6">
                                    </div>
                                    @error('name')
                                        <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Descripción del producto -->
                                <div class="lg:col-span-6 col-span-full">
                                    <label for="description"
                                        class="block text-sm font-medium leading-6 text-gray-900">Descripción del
                                        producto</label>
                                    <div class="mt-2">
                                        <textarea wire:model="description" name="description" id="description" autocomplete="off"
                                            placeholder="Escriba una descripción para el producto"
                                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 text-sm sm:leading-6">
                                        </textarea>
                                    </div>
                                    @error('description')
                                        <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Margen de ganancia -->
                                <div class="lg:col-span-3 col-span-full">
                                    <label for="profit"
                                        class="block text-sm font-medium leading-6 text-gray-900">Margen de
                                        ganancia</label>
                                    <div class="mt-2">
                                        <input type="number" wire:model="profit" name="profit" id="profit"
                                            autocomplete="off" placeholder="Escriba el margen de ganancia"
                                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 text-sm sm:leading-6">
                                    </div>
                                    @error('profit')
                                        <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Costo parcial -->
                                <div class="lg:col-span-3 col-span-full">
                                    <label for="cost"
                                        class="block text-sm font-medium leading-6 text-gray-900">Costo parcial</label>
                                    <div class="mt-2">
                                        <input type="number" wire:model="cost" name="cost" id="cost"
                                            autocomplete="off" placeholder="Escriba el costo parcial"
                                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 text-sm sm:leading-6">
                                    </div>
                                    @error('cost')
                                        <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                    @enderror
                                </div>

                            </div>
                        </div>

                        <!-- Opciones de radio con Alpine.js -->
                        <div x-data="{
                            radioGroupSelectedValue: @entangle('radioGroupSelectedValue'),
                            radioGroupOptions: [
                                { title: 'Un solo uso', description: 'Producto que será usado y descartado', value: 'single_use' },
                                { title: 'Administrable', description: 'Producto con unidades o medidas gestionables progresivamente', value: 'administrable' },
                                { title: 'Por tiempo', description: 'Producto con uso determinado por tiempo o cantidad de veces', value: 'infinite' },
                            ]
                        }" class="w-full bg-white">
                            <div class="w-[1100px] mx-auto space-y-3 px-4">
                                <template x-for="(option, index) in radioGroupOptions" :key="index">
                                    <label @click="radioGroupSelectedValue = option.value"
                                        class="flex items-start p-5 space-x-3 bg-white border rounded-md shadow-sm hover:bg-gray-50 border-neutral-200/70">
                                        <input type="radio" name="radio-group" :value="option.value"
                                            x-bind:checked="radioGroupSelectedValue === option.value"
                                            class="text-indigo-600 translate-y-px focus:ring-indigo-600" />
                                        <span class="relative flex flex-col text-left space-y-1.5 leading-none">
                                            <span x-text="option.title" class="font-semibold"></span>
                                            <span x-text="option.description" class="text-sm opacity-50"></span>
                                        </span>
                                    </label>
                                </template>
                            </div>
                            @error('radioGroupSelectedValue')
                                <span class="text-red-500 text-sm ml-12 mt-6">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Subida de archivos -->
                        <div class="grid grid-cols-1 gap-x-8 gap-y-8 pt-2 m-10">
                            <div class="col-span-full mb-7">
                                <label for="files" class="block text-sm font-medium leading-6 text-gray-900">Imágenes
                                    del producto</label>
                                <livewire:components.upload-file wire:key="'product-images'" :multiple="true"
                                    :types="['image']" :existingFiles="$productImagesExisting" :name="'product-images'" />
                            </div>

                            <div class="col-span-full mb-7">
                                <label for="files"
                                    class="block text-sm font-medium leading-6 text-gray-900">Documentos
                                    relacionados</label>
                                <livewire:components.upload-file wire:key="'product-documents'" :multiple="true"
                                    :types="['document']" :existingFiles="$productDocumentsExisting" :name="'product-documents'" />
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Botón de guardar -->
                <div class="flex items-center justify-end gap-x-4 px-4 sm:px-8">
                    <button wire:click="update"
                        class="rounded-md bg-indigo-600 px-3 py-2 font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 text-sm focus-visible:outline-indigo-600">
                        Editar
                    </button>
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
