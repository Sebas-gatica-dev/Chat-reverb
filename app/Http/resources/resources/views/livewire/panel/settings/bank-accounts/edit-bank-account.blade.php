<div>
    <div class="mx-auto max-w-screen-2xl pt-2 lg:flex lg:gap-x-16 lg:px-8">
        <h1 class="sr-only">Edita tu cuenta bancaria {{ $holder }}</h1>

        <aside class="flex overflow-x-auto border-b border-gray-900/5 py-4 lg:block lg:w-64 lg:flex-none lg:border-0 lg:py-20">
            @include('components.panel.settings.menu-side-bar-settings')
        </aside>

        <main class="px-4 py-16 sm:px-6 lg:flex-auto lg:px-0 lg:py-20">
            <div class="mx-auto max-w-2xl space-y-16 sm:space-y-20 lg:mx-0 lg:max-w-none">
                <div class="sm:flex sm:items-center">
                    <div class="sm:flex-auto">
                        <h1 class="text-base font-semibold leading-6 text-gray-900">Cuenta bancaria</h1>
                        <p class="mt-2 text-sm text-gray-700">Edita la cuenta {{ $holder }} de tu negocio.</p>
                    </div>
                    <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                        <a wire:navigate href="{{ route('panel.settings.bank-accounts.list') }}"
                            class="cursor-pointer block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                            Atras
                        </a>
                    </div>
                </div>

                <div class="mt-8 flow-root">
                    <x-panel.settings.form>
                        <x-slot name="slot">
                            <div class="lg:col-span-3 col-span-full">
                                <label for="holder" class="block text-sm font-medium leading-6 text-gray-900">Nombre de cuenta</label>
                                <div class="mt-2">
                                    <input type="text" wire:model="holder" name="holder" id="holder" value="holder"
                                        autocomplete="off" placeholder="Ej: Cuenta Corriente Negocios"
                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 text-sm sm:leading-6">
                                </div>
                                @error('holder')
                                    <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="lg:col-span-3 col-span-full">
                                <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Titular de cuenta</label>
                                <div class="mt-2">
                                    <input type="text" wire:model="name" name="name" id="name" autocomplete="off" 
                                        placeholder="Ej: Juan Hernán Pérez" value="name"
                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 text-sm sm:leading-6">
                                </div>
                                @error('name')
                                    <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="lg:col-span-3 col-span-full">
                                <label for="bank" class="block text-sm font-medium leading-6 text-gray-900">Entidad Bancaria</label>
                                <div class="mt-2">
                                    <input type="text" wire:model="bank" name="bank" id="bank" autocomplete="off" 
                                        placeholder="Ej: Banco Santander, BruBank, Banco Nación, etc." value="bank"
                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 text-sm sm:leading-6">
                                </div>
                                @error('bank')
                                    <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="lg:col-span-3 col-span-full">
                                <label for="branches" class="block text-sm font-medium leading-6 text-gray-900">Selecciona sucursales para la cuenta</label>
                                <div class="mt-2">
                                    <livewire:components.multi-select-general :selectedValues="$selectedBranches" :values="$branches"
                                        :imageValue="false" :searchEnabled="true" :name="'branches'" :model="false">
                                </div>
                                @error('selectedBranches')
                                    <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="lg:col-span-3 col-span-full">
                                <label for="cuit" class="block text-sm font-medium leading-6 text-gray-900">CUIL/CUIT</label>
                                <div class="mt-2">
                                    <input type="text" wire:model="cuit" name="cuit" id="cuit" autocomplete="off" 
                                        placeholder="Entre 8 y 11 caracteres numericos..." value="cuit"
                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 text-sm sm:leading-6">
                                </div>
                                @error('cuit')
                                    <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="lg:col-span-3 col-span-full">
                                <label for="account_number" class="block text-sm font-medium leading-6 text-gray-900">Numero de cuenta</label>
                                <div class="mt-2">
                                    <input type="text" wire:model="account_number" name="account_number" id="account_number" 
                                        value="account_number" autocomplete="off" placeholder="Ej: 204-87865/8"
                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 text-sm sm:leading-6">
                                </div>
                                @error('account_number')
                                    <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="lg:col-span-3 col-span-full">
                                <label for="cbu" class="block text-sm font-medium leading-6 text-gray-900">CBU</label>
                                <div class="mt-2">
                                    <input type="text" wire:model="cbu" name="cbu" id="cbu" value="cbu" autocomplete="off"
                                        placeholder="Ej: 01702046600000087865"
                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 text-sm sm:leading-6">
                                </div>
                                @error('cbu')
                                    <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="lg:col-span-3 col-span-full">
                                <label for="alias" class="block text-sm font-medium leading-6 text-gray-900">Alias</label>
                                <div class="mt-2">
                                    <input type="text" wire:model="alias" name="alias" id="alias" value="alias" 
                                        autocomplete="off" placeholder="Ej: miempresa.mp"
                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 text-sm sm:leading-6">
                                </div>
                                @error('alias')
                                    <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-span-full">
                                <label for="files" class="block text-sm font-medium leading-6 text-gray-900">Archivos</label>
                                <livewire:components.upload-file :multiple="true" :types="['image', 'video', 'audio', 'document']" 
                                    :existingFiles="$filesExisting" :name="'bank-acount-existing-files'" />
                            </div>
                        </x-slot>

                        <x-slot name="buttons">
                            <button wire:click="save()"
                                class="rounded-md bg-indigo-600 px-3 py-2 font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 text-sm focus-visible:outline-indigo-600">
                                Actualizar
                            </button>
                        </x-slot>
                    </x-panel.settings.form>
                </div>
            </div>
        </main>
    </div>
</div>
