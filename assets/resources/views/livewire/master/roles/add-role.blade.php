<div>

    <div class="px-4 py-6 sm:p-8">
        <h1 class="sr-only">Agregar de rol</h1>

        <div class="mt-2 sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-base font-semibold leading-6 text-white">Agregar rol</h1>
                <p class="mt-2 text-sm text-gray-300">Llena el formulario para agregar el rol</p>
            </div>
            <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                <a href="{{ route('master.roles.index') }}"
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
                        rol</label>
                    <div class="mt-2">
                        <input type="text" wire:model="name" id="name" autocomplete="off"
                            placeholder="Ingrese el nombre del rol"
                            class="block w-full rounded-md border-0 bg-white/5 py-1.5 text-white shadow-sm ring-1 ring-inset ring-white/10 focus:ring-2 focus:ring-inset focus:ring-indigo-500 text-sm sm:leading-6">
                    </div>
                    @error('name')
                        <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                    @enderror
                </div>
                <div class="lg:col-span-3 col-span-full">
                    <label for="description" class="block text-sm font-medium leading-6 text-white">Descripción</label>
                    <div class="mt-2">
                        <input type="text" wire:model="description" id="description" autocomplete="off"
                            placeholder="Ingrese la descripción del rol"
                            class="block w-full rounded-md border-0 bg-white/5 py-1.5 text-white shadow-sm ring-1 ring-inset ring-white/10 focus:ring-2 focus:ring-inset focus:ring-indigo-500 text-sm sm:leading-6">
                    </div>
                    @error('description')
                        <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                    @enderror
                </div>



                <div class="lg:col-span-3 col-span-full">
                    <!-- Integrar el componente del selector de usuario -->

                    <livewire:master.businesses.partials.select-user :selectedUser="auth()->user()">


                </div>



            </div>
        </div>

        <div class="flex items-center md:justify-start justify-start gap-x-6 py-4">
            <button wire:click="save('save')"
                class="rounded-md bg-indigo-600 px-3 py-2 font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 text-sm focus-visible:outline-indigo-600">Crear</button>

            <button wire:click="save('save-new')"
                class="rounded-md bg-indigo-600 px-3 py-2 font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 text-sm focus-visible:outline-indigo-600">Crear
                y crear otro</button>
        </div>
    </div>






</div>
