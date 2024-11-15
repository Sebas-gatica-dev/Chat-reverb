<div>

    <div class="mx-auto max-w-screen-2xl pt-2 lg:flex lg:gap-x-16 lg:px-8">
        <h1 class="sr-only">Edita la sucursal {{ $name }}</h1>

        <aside
            class="flex overflow-x-auto border-b border-gray-900/5 py-4 lg:block lg:w-64 lg:flex-none lg:border-0 lg:py-20">

            @include('components.panel.settings.menu-side-bar-settings')

        </aside>

        <main class="px-4 py-16 sm:px-6 lg:flex-auto lg:px-0 lg:py-20">
            <div class="mx-auto max-w-2xl space-y-16 sm:space-y-20 lg:mx-0 lg:max-w-none">

                <div class="sm:flex sm:items-center">
                    <div class="sm:flex-auto">
                        <h1 class="text-base font-semibold leading-6 text-gray-900">Sucursal</h1>
                        <p class="mt-2 text-sm text-gray-700">Edita la sucursal {{ $name }} de tu negocio
                        </p>
                    </div>
                    <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                        <a wire:navigate href="{{ route('panel.settings.branches.list') }}"
                            class="cursor-pointer block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                            Atras
                        </a>
                    </div>
                </div>


                <div class="mt-8 flow-root">

                    <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl md:col-span-3">
                                        
                        <div class="px-4 py-6 sm:p-8">
                            <div class="grid w-full grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-9">
                    

                     
                            <div class="lg:col-span-3 col-span-full">
                                <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Nombre
                                    de sucursal (*)</label>
                                <div class="mt-2">
                                    <input type="text" wire:model="name" name="name" id="name" value="name"
                                        autocomplete="off" placeholder="Escriba un nombre para la sucursal"
                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 text-sm sm:leading-6">
                                </div>
                                @error('name')
                                    <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                @enderror
                            </div>

{{-- 


                            <div class="lg:col-span-3 col-span-full">
                                <label for="address"
                                    class="block text-sm font-medium leading-6 text-gray-900">Direccion (*)</label>
                                <div class="mt-2">
                                    <input type="text" wire:model="address" name="address" id="address"
                                        value="address" autocomplete="off"
                                        placeholder="Escriba la direccion de la sucursal"
                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 text-sm sm:leading-6">
                                </div>

                                @error('address')
                                    <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                @enderror
                            </div> --}}

                                {{-- SELECCIONAR USUARIO PARA SUCURSAL --}}
                            <div class="lg:col-span-3 col-span-full">

                                <label for="users"
                                    class="block text-sm font-medium leading-6 text-gray-900">Selecciona usuarios para la sucursal (opcional)
                                    </label>
                                <div class="mt-2">
                                    <livewire:components.multi-select-general :selectedValues="$selectedUsers"
                                        :values="$users" :imageValue="true" :searchEnabled="true" :name="'users'"
                                        :model="false">
                                </div>
                                @error('selectedUsers')
                                    <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                @enderror
                            </div>


                                {{-- AFILIAR CUENTAS BANCARIAS A LA SUCURSAL --}}
                            <div class="lg:col-span-3 col-span-full">

                                <label for="bank_accounts"
                                    class="block text-sm font-medium leading-6 text-gray-900">Selecciona cuentas bancarias (opcional)
                                    </label>
                                <div class="mt-2">
                                    <livewire:components.multi-select-general :selectedValues="$selectedBankAccounts"
                                        :values="$bank_accounts" :imageValue="false" :searchEnabled="true" :name="'bank_accounts'"
                                        :model="false">
                                </div>
                                @error('selectedBankAccounts')
                                    <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                @enderror
                            </div>       

                    </div>
                </div>
            </div>
            {{-- @dump($address) --}}

            <div class="grid grid-cols-1 gap-x-8 gap-y-8 pt-2 mt-6">
                {{-- <div class="px-4 sm:px-0">
                    <h2 class="text-base font-semibold leading-7 text-gray-900">Personal Information</h2>
                    <p class="mt-1 text-sm leading-6 text-gray-600">Use a permanent address where you can
                        receive mail.</p>
                </div> --}}

                {{-- @dump($latitude, $longitude) --}}


                <livewire:components.maps.google-map-form-field-component
                        :selectField="false"
                        :latitude="$latitude"
                        :longitude="$longitude"
                        :address="$address"
                        :inputField="true"
                        :input_id="'address'"

                   />
               
                
            </div>

   
                <div class="flex items-center justify-end gap-x-6 border-t border-gray-900/10 px-4 py-4 sm:px-8">
                    <button wire:click="update()"
                    class="rounded-md bg-indigo-600 px-3 py-2 font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 text-sm focus-visible:outline-indigo-600">Actualizar</button>             
                </div>
    
        </main>

    </div>
</div>
