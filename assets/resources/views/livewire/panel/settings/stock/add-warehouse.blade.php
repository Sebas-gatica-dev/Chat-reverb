<div>
    <div class="mx-auto max-w-screen-2xl pt-2 lg:flex lg:gap-x-16 lg:px-8">
        <h1 class="sr-only">Registrar un nuevo deposito</h1>

        <aside class="flex overflow-x-auto border-b border-gray-900/5 py-4 lg:block lg:w-64 lg:flex-none lg:border-0 lg:py-20">
            @include('components.panel.settings.menu-side-bar-settings')
        </aside>

        <main class="px-4 py-16 sm:px-6 lg:flex-auto lg:px-0 lg:pt-20">
            <div class="mx-auto max-w-2xl space-y-4 sm:space-y-4 lg:mx-0 lg:max-w-none">

                <div class="sm:flex sm:items-center">
                    <div class="sm:flex-auto">
                        <h1 class="text-base font-semibold leading-6 text-gray-900">Deposito</h1>
                        <p class="mt-2 text-sm text-gray-700">Crear un nuevo deposito, para tus insumos y productos.</p>
                    </div>
                    <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                        <a wire:navigate href="{{ route('panel.settings.stock.warehouse.list') }}"
                            class="cursor-pointer block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                            Atras
                        </a>
                    </div>
                </div>

                <div class="mt-8 flow-root">
                    <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl md:col-span-3">
                        <div class="px-4 py-6 sm:p-8">
                            <div class="grid w-full grid-cols-2 gap-x-6 gap-y-8">
                                <!-- Input Nombre del depósito -->
                                <div class="col-span-1">
                                    <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Nombre del depósito</label>
                                    <div class="mt-2">
                                        <input type="text" wire:model="name" name="name" id="name" autocomplete="off" placeholder="Escriba un nombre para la sucursal"
                                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 text-sm sm:leading-6">
                                    </div>
                                    @error('name')
                                        <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Input Dirección -->
                                <div class="col-span-1">
                                    <label for="address" class="block text-sm font-medium leading-6 text-gray-900">Dirección</label>
                                    <div class="mt-2">
                                        <input type="text" wire:model.live="address" id="address" autocomplete="address" placeholder="Av. Rivadavia N°1234"
                                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    </div>
                                    @error('address')
                                        <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Mapa -->
                <div class="mt-8">
                    <livewire:components.maps.google-map-form-field-component
                        :latitude="$latitude"
                        :longitude="$longitude"
                        :input_id="'address'"
                    />
                </div>

                <div class="flex items-center justify-end gap-x-4 px-4 sm:px-8">
                    <button wire:click="save('save')"
                        class="rounded-md bg-indigo-600 px-3 py-2 font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 text-sm focus-visible:outline-indigo-600">
                        Crear
                    </button>
                    <button wire:click="save('save-new')"
                        class="rounded-md bg-indigo-600 px-3 py-2 font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 text-sm focus-visible:outline-indigo-600">
                        Crear y crear otra
                    </button>
                </div>

            </div>
        </main>
    </div>
</div>
