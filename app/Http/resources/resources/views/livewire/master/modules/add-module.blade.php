<div>
    <div class="px-4 py-6 sm:p-8">
        <h1 class="sr-only">Creacion de modulos</h1>


        <div class="mt-2 sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-base font-semibold leading-6 text-white">Crear modulo</h1>
                <p class="mt-2 text-sm text-gray-300">Llena el formulario para crear el modulo</p>
            </div>

            <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                <a wire:navigate href="{{ route('master.modules.index') }}"
                    class="inline-flex items-center gap-x-1.5 rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">

                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="-ml-0.5 h-5 w-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                    </svg>
                    Atras

                </a>

            </div>

        </div>



        <div class="ring-1 ring-gray-900/5 sm:rounded-xl md:col-span-full mt-6" x-data="{ name: @entangle('name'), slug: @entangle('slug') }">


            <div class="grid w-full gap-x-6 gap-y-8 grid-cols-9 md:col-span-2">

                <div class="lg:col-span-3 col-span-full">
                    <label for="first-name" class="block text-sm font-medium leading-6 text-white">Nombre
                        del modulo</label>
                    <div class="mt-2">
                        <input type="text" wire:model="name" id="name" autocomplete="off"
                            placeholder="Ingrese el nombre del modulo"
                            class="block w-full rounded-md border-0 bg-white/5 py-1.5 text-white shadow-sm ring-1 ring-inset ring-white/10 focus:ring-2 focus:ring-inset focus:ring-indigo-500 text-sm sm:leading-6"
                            @input="slug = name.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/^-+|-+$/g, '')"
                            >
                    </div>
                    @error('name')
                        <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                    @enderror
                </div>


                <div class="lg:col-span-3 col-span-full">
                    <label for="slug" class="block text-sm font-medium leading-6 text-white">Slug del
                        modulo</label>
                    <div class="mt-2">

                            <input type="text" wire:model.live="slug" id="slug" autocomplete="slug"
                                x-model="slug"
                                class="block w-full rounded-md border-0 bg-white/5 py-1.5 text-white shadow-sm ring-1 ring-inset ring-white/10 focus:ring-2 focus:ring-inset focus:ring-indigo-500 text-sm sm:leading-6"
                                placeholder="Slug" disabled>

                    </div>
                    @error('slug') <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span> @enderror
                </div>

                {{-- SLUG  --}}


{{--
                <div class="lg:col-span-3 col-span-full">
                    <label for="status" class="block text-sm font-medium leading-6 text-white">Estado</label>
                    <div class="mt-2">

                        <select wire:model="status" name="status" id="status"
                            class="block w-full rounded-md border-0 py-1.5 text-gray-200 bg-gray-800 shadow-sm ring-1 ring-inset ring-white/10 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs text-sm sm:leading-6">
                            <option value="">Seleccione una opción</option>
                            <option value="1">Activo</option>
                            <option value="0">Inactivo</option>
                        </select>

                    </div>

                    @error('status')
                        <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                    @enderror
                </div> --}}



                <div class="col-span-9">
                    <label for="description" class="block text-sm font-medium leading-6 text-white">Descripción</label>
                    <div class="mt-2">

                        <textarea id="description" wire:model="description" rows="3"
                            class="block w-full rounded-md border-0 py-1.5 bg-white/5 text-white shadow-sm ring-1 ring-inset ring-white/10 ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>

                    </div>
                    @error('description')
                        <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                    @enderror
                </div>


            </div>
        </div>
        <div class="flex items-center md:justify-between justify-start gap-x-6 py-4">

            <button wire:click="save()"
                class="rounded-md bg-indigo-600 px-3 py-2 font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 text-sm focus-visible:outline-indigo-600">Crear</button>

        </div>
    </div>




</div>




