<div>


    <div class="px-4 py-6 sm:p-8">
        <h1 class="sr-only">Crear negocio</h1>

        <div class="mt-2 sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-base font-semibold leading-6 text-white">Crear negocio</h1>
                <p class="mt-2 text-sm text-gray-300">Llena el formulario para crear el negocio</p>
            </div>
            <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                <a wire:navigate href="{{ route('master.businesses.index') }}"
                    class="inline-flex items-center gap-x-1.5 rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="-ml-0.5 h-5 w-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                    </svg>
                    Atrás
                </a>
            </div>
        </div>

        <div class="ring-1 ring-gray-900/5 sm:rounded-xl md:col-span-full mt-6">
            <div class="grid w-full gap-x-6 gap-y-8 grid-cols-9 md:col-span-2">
                <div class="lg:col-span-3 col-span-full">
                    <label for="name" class="block text-sm font-medium leading-6 text-white">Nombre del
                        negocio</label>
                    <div class="mt-2">
                        <input type="text" wire:model="name" id="name" autocomplete="off"
                            placeholder="Ingrese el nombre del negocio"
                            class="block w-full rounded-md border-0 bg-white/5 py-1.5 text-white shadow-sm ring-1 ring-inset ring-white/10 focus:ring-2 focus:ring-inset focus:ring-indigo-500 text-sm sm:leading-6">
                    </div>
                    @error('name')
                        <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                    @enderror
                </div>



                <div class="lg:col-span-3 col-span-full">
                    <label for="logo" class="block text-sm font-medium leading-6 text-white">Logo</label>
                    <label for="logo">
                        <div class="mt-8 flex items-center gap-x-3">

                            @if ($logo)
                                <img class="inline-block h-32 w-32 rounded-md object-cover" src="{{  $logo->temporaryUrl()}}"
                                    alt="Logo temporal">
                            @else
                                <div wire:loading.remove wire:target="logo">
                                    <span class="inline-block h-32 w-32 overflow-hidden rounded-md bg-gray-100">
                                        <svg class="h-full w-full text-gray-300" fill="currentColor"
                                            viewBox="0 0 24 24">
                                            <path
                                                d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                                        </svg>
                                    </span>
                                </div>
                                <div wire:loading wire:target="logo">

                                    <div disabled>
                                        <svg class="animate-spin h-5 w-5 mx-auto text-gray-400"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10"
                                                stroke="currentColor" stroke-width="4">
                                            </circle>
                                            <path class="opacity-75" fill="currentColor"
                                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                            </path>
                                        </svg>
                                        <p class="mx-auto text-sm text-indigo-600">Procesando logo
                                            ..</p>

                                    </div>
                                </div>
                            @endif


                            <span type="button"
                                class="rounded-md bg-white px-2.5 py-1.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">Cambiar</span>

                            <input wire:model="logo" type="file" id="logo" wire:model.blur="logo"
                                class=" sr-only rounded-md bg-white px-2.5 py-1.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">



                        </div>
                    </label>
                    <p class="mt-3 text-sm leading-6 text-gray-600">Es recomendable que sea una
                        imagen
                        cuadrada,
                        por ejemplo: 500x500 pixeles.</p>

                    @error('logo')
                        <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                    @enderror
                </div>

                <div class="lg:col-span-3 col-span-full">
                    <label for="address" class="block text-sm font-medium leading-6 text-white">Dirección</label>
                    <div class="mt-2">
                        <input type="text" wire:model="address" id="address" autocomplete="off"
                            placeholder="Ingrese la dirección del negocio"
                            class="block w-full rounded-md border-0 bg-white/5 py-1.5 text-white shadow-sm ring-1 ring-inset ring-white/10 focus:ring-2 focus:ring-inset focus:ring-indigo-500 text-sm sm:leading-6">
                    </div>
                    @error('address')
                        <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                    @enderror
                </div>

                <div class="lg:col-span-3 col-span-full">
                    <label for="phone" class="block text-sm font-medium leading-6 text-white">Telefono</label>
                    <div class="mt-2">
                        <input type="text" wire:model="phone" id="phone" autocomplete="off"
                            placeholder="Ingrese numero de telefono"
                            class="block w-full rounded-md border-0 bg-white/5 py-1.5 text-white shadow-sm ring-1 ring-inset ring-white/10 focus:ring-2 focus:ring-inset focus:ring-indigo-500 text-sm sm:leading-6">
                    </div>
                    @error('phone')
                        <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                    @enderror
                </div>

                <div class="lg:col-span-3 col-span-full">
                    <label for="email" class="block text-sm font-medium leading-6 text-white">Email</label>
                    <div class="mt-2">
                        <input type="text" wire:model="email" id="email" autocomplete="off"
                            placeholder="Ingrese email"
                            class="block w-full rounded-md border-0 bg-white/5 py-1.5 text-white shadow-sm ring-1 ring-inset ring-white/10 focus:ring-2 focus:ring-inset focus:ring-indigo-500 text-sm sm:leading-6">
                    </div>
                    @error('email')
                        <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                    @enderror
                </div>
                <div class="lg:col-span-3 col-span-full">
                    <!-- Integrar el componente del selector de usuario -->

                    {{-- <livewire:master.businesses.partials.select-user :selectedUser="auth()->user()" /> --}}
                    <livewire:master.businesses.partials.select-user :selectedUser="auth()->user()" />


                </div>


            </div>
        </div>


        <div class="flex items-center md:justify-between justify-start gap-x-6 py-4">
            <button wire:click="save()"
                class="rounded-md bg-indigo-600 px-3 py-2 font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 text-sm focus-visible:outline-indigo-600">Crear</button>
        </div>
    </div>
</div>

