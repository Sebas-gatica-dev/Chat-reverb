<div>
    <div class="mx-auto max-w-screen-2xl pt-2 lg:flex lg:gap-x-16 lg:px-8">
        <h1 class="sr-only">Configuracion general</h1>

        <aside
            class="flex overflow-x-auto border-b border-gray-900/5 py-4 lg:block lg:w-64 lg:flex-none lg:border-0 lg:py-20">

            @include('components.panel.settings.menu-side-bar-settings')

        </aside>

        <main class="px-4 py-16 sm:px-6 lg:flex-auto lg:px-0 lg:py-20">
            <div class="mx-auto max-w-2xl space-y-16 sm:space-y-20 lg:mx-0 lg:max-w-none">
                <div>
                    <h2 class="text-base font-semibold leading-7 text-gray-900">Negocio</h2>
                    <p class="mt-1 text-sm leading-6 text-gray-500">Edite los datos de su negocio segun lo prefiera.</p>

                    <dl
                        class="sm:rounded-lg bg-white shadow p-4 mt-6 space-y-6 divide-y divide-gray-100 border-t border-gray-200 text-sm leading-6">
                        <div class="sm:flex">
                            <dt class="font-medium text-gray-900 sm:w-64 sm:flex-none sm:pr-6">Nombre</dt>


                            @if (!$updateName)
                                <dd class="mt-1 flex justify-between gap-x-6 sm:mt-0 sm:flex-auto">
                                    <div class="text-gray-900">{{ $name }} </div>
                                    @can('access-function','business-general-edit')
                                        <button type="button" wire:click="$set('updateName', true)"
                                            class="font-semibold text-indigo-600 hover:text-indigo-500">Actualizar</button>
                                    @endcan
                                </dd>
                            @else
                                <div class="mt-1 flex justify-between gap-x-6 sm:mt-0 sm:flex-auto">
                                    <div>
                                        <input type="text" wire:model.live="name" value="{{ $name }}"
                                            wire:keydown.enter="updateNameBusiness"
                                            class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:max-w-xs sm:text-sm">
                                        @error('name')
                                            <span class="text-red-500 text-sm ml-0.5 block">{{ $message }}</span>
                                        @enderror
                                    </div>
                                 

                                    <button wire:click="updateNameBusiness"
                                        class="font-semibold text-indigo-600 hover:text-indigo-500">Guardar</button>
                                </div>
                            @endif

                        </div>
                        <div class="pt-6 sm:flex">
                            <dt class="font-medium text-gray-900 sm:w-64 sm:flex-none sm:pr-6">Correo electronico</dt>
                            @if (!$updateEmail)
                                <dd class="mt-1 flex justify-between gap-x-6 sm:mt-0 sm:flex-auto">
                                    <div class="text-gray-900">{{ $email }}</div>

                                    @can('access-function','business-general-edit')
                                        <button type="button" wire:click="$set('updateEmail', true)"
                                            class="font-semibold text-indigo-600 hover:text-indigo-500">Actualizar</button>
                                    @endcan
                                </dd>
                            @else
                                <div class="mt-1 flex justify-between gap-x-6 sm:mt-0 sm:flex-auto">
                                    <div>
                                        <input type="text" wire:model.live="email" value="{{ $email }}"
                                            wire:keydown.enter="updateEmailBusiness"
                                            class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:max-w-xs sm:text-sm">

                                        @error('email')
                                            <span class="text-red-500 text-sm ml-0.5 block">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <button wire:click="updateEmailBusiness"
                                        class="font-semibold text-indigo-600 hover:text-indigo-500">Guardar</button>
                                </div>
                            @endif
                        </div>
                        <div class="pt-6 sm:flex">
                            <dt class="font-medium text-gray-900 sm:w-64 sm:flex-none sm:pr-6">Telefono</dt>
                            @if (!$updatePhone)
                                <dd class="mt-1 flex justify-between gap-x-6 sm:mt-0 sm:flex-auto">
                                    <div class="text-gray-900">{{ $phone }}</div>

                                    @can('access-function','business-general-edit')
                                        <button type="button" wire:click="$set('updatePhone', true)"
                                            class="font-semibold text-indigo-600 hover:text-indigo-500">Actualizar</button>
                                    @endcan
                                </dd>
                            @else
                                <div class="mt-1 flex justify-between gap-x-6 sm:mt-0 sm:flex-auto">
                                    <div>
                                        <input type="text" wire:model.live="phone" value="{{ $phone }}"
                                            wire:keydown.enter="updatePhoneBusiness"
                                            class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:max-w-xs sm:text-sm">

                                        @error('phone')
                                            <span class="text-red-500 text-sm ml-0.5 block">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <button wire:click="updatePhoneBusiness"
                                        class="font-semibold text-indigo-600 hover:text-indigo-500">Guardar</button>
                                </div>
                            @endif
                        </div>

                        {{-- <div class="pt-6 sm:flex">
                            <dt class="font-medium text-gray-900 sm:w-64 sm:flex-none sm:pr-6">Direccion

                            </dt>
                            @if (!$updateAddress)
                                <dd class="mt-1 flex justify-between gap-x-6 sm:mt-0 sm:flex-auto">
                                    <div class="text-gray-900">{{ $address }}</div>
                                    <button type="button" wire:click="$set('updateAddress', true)"
                                        class="font-semibold text-indigo-600 hover:text-indigo-500">Actualizar</button>
                                </dd>
                            @else
                                <div class="mt-1 flex justify-between gap-x-6 sm:mt-0 sm:flex-auto">
                                    <div>
                                        <input type="text" wire:model.live="address" value="{{ $address }}"
                                            wire:keydown.enter="updateAddressBusiness"
                                            class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:max-w-xs sm:text-sm">
                                        @error('address')
                                            <span class="text-red-500 text-sm ml-0.5 block">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <button wire:click="updateAddressBusiness"
                                        class="font-semibold text-indigo-600 hover:text-indigo-500">Guardar</button>
                                </div>
                            @endif
                        </div> --}}


                        <div class="pt-6 sm:flex">


                            <dt class="font-medium text-gray-900 sm:w-64 sm:flex-none sm:pr-6">Logo

                            </dt>


                            <dd class="mt-1 flex justify-between flex-row gap-x-6 flex-auto">
                                {{-- @dd('estoy aqui') --}}
                                @if (!$updateLogo)
                                    <div class="w-full">
                                        <div class="sm:col-span-4">
                                            <div
                                                class="relative mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-2">

                                                <img src="{{ $logo[0] }}"
                                                    class="h-64 w-auto object-cover object-center">
                                            </div>
                                        </div>
                                    </div>

                                    @can('access-function','business-general-edit')

                                    <button wire:click="{{ '$set("updateLogo", true)' }}"
                                        class="font-semibold text-indigo-600 hover:text-indigo-500">

                                        Actualizar

                                    </button>

                                    @endcan
                                @else
                                    <div class="w-full ">

                                        <livewire:components.upload-file :multiple="false"
                                         :types="['image']"
                                         :existingFiles="$logo"
                                         :name="'general-logo'"
                                         />

                                    </div>

                                    <button wire:click="updateLogoBusiness"
                                        class="font-semibold text-indigo-600 hover:text-indigo-500">

                                        Guardar

                                    </button>


                                @endif

                            </dd>





                            {{-- @if ($logo)
                                    <dd class="mt-1 flex justify-between gap-x-6 sm:mt-0 sm:flex-auto">
                                        <div class="text-gray-900">
                                            <img class="inline-block h-32 w-32 rounded-md object-cover"
                                            src="{{ asset($logoPreview) }}" alt="Logo temporal">
                                        </div>
                                        <button type="button" wire:click="$set('updateLogo', true)"
                                            class="font-semibold text-indigo-600 hover:text-indigo-500">Actualizar</button>
                                    </dd>
                                @else

                                    <dd class="mt-1 flex justify-between flex-row items-center gap-x-6 sm:mt-0 sm:flex-auto">
                                        <div class="w-full">

                                        <img class="inline h-32 w-32 rounded-md object-cover"
                                        src="{{ asset($logoPreview) }}" alt="Logo temporal">

                                        <input type="file" wire:model.live="logo" value="{{ $logo }}"
                                            class=" border-gray-300 align-center inline-block rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:max-w-xs sm:text-sm">

                                            @error('logo')
                                            <span class="text-red-500 text-sm ml-0.5 block">{{ $message }}</span>
                                        @enderror
                                        </div>
                                            <button wire:click="updateLogoBusiness"
                                            class="font-semibold text-indigo-600 hover:text-indigo-500">Guardar</button>
                                    </dd>
                                @endif --}}
                        </div>
                    </dl>
                </div>


            </div>
        </main>
    </div>


</div>
