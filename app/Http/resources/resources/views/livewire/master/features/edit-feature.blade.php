<div>

    <div class="px-4 py-6 sm:p-8">
        <h1 class="sr-only">Edición de la funcion {{ $name }}</h1>


        <div class="mt-2 sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-base font-semibold leading-6 text-white">Edición de la funcion {{ $name }}</h1>
                <p class="mt-2 text-sm text-gray-300">Llena el formulario para editar la funcion</p>
            </div>


            <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                <a wire:navigate href="{{ route('master.modules.edit', $module) }}"
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
                        del funcion</label>
                    <div class="mt-2">
                        <input type="text" wire:model="name" id="name" autocomplete="off" value="name"
                            placeholder="Ingrese el nombre de la funcion"
                            class="block w-full rounded-md border-0 bg-white/5 py-1.5 text-white shadow-sm ring-1 ring-inset ring-white/10 focus:ring-2 focus:ring-inset focus:ring-indigo-500 text-sm sm:leading-6"
                            @input="slug = name.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/^-+|-+$/g, '')">
                    </div>
                    @error('name')
                        <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                    @enderror
                </div>


                <div class="lg:col-span-3 col-span-full">
                    <label for="slug" class="block text-sm font-medium leading-6 text-white">Slug de la
                        funcion</label>
                    <div class="mt-2">

                        <input type="text" wire:model.live="slug" id="slug" autocomplete="slug" value="name"
                            class="block w-full rounded-md border-0 bg-white/5 py-1.5 text-white shadow-sm ring-1 ring-inset ring-white/10 focus:ring-2 focus:ring-inset focus:ring-indigo-500 text-sm sm:leading-6"
                            placeholder="Slug" disabled>

                    </div>
                    @error('slug')
                        <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                    @enderror
                </div>

                {{-- SLUG  --}}



                {{-- <div class="lg:col-span-3 col-span-full">
                    <label for="status" class="block text-sm font-medium leading-6 text-white">Estado</label>
                    <div class="mt-2">

                        <select wire:model="status" name="status" id="status"
                            class="block w-full rounded-md border-0 py-1.5 text-gray-200 bg-gray-800 shadow-sm ring-1 ring-inset ring-white/10 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs text-sm sm:leading-6">
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

                        <textarea id="description" wire:model="description" rows="3" value="description"
                            class="block w-full rounded-md border-0 py-1.5 bg-white/5 text-white shadow-sm ring-1 ring-inset ring-white/10 ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>

                    </div>
                    @error('description')
                        <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                    @enderror
                </div>

                {{-- @if ($module == null)
                <div class="lg:col-span-3 col-span-full">
                    <!-- Integrar el componente del selector de modulo -->

                    <livewire:master.features.partials.select-module >
                </div>
                @endif --}}


            </div>
        </div>
        <div class="flex items-center md:justify-between justify-start gap-x-6 py-4">

            <button wire:click="update()"
                class="rounded-md bg-indigo-600 px-3 py-2 font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 text-sm focus-visible:outline-indigo-600">Actualizar</button>

        </div>



        <div x-data="{ on: false }" >

            <div class="inline-flex items-center gap-2">
            <span class="text-sm text-white">¿Modificar el módulo perteneciente?</span>
            <button type="button" class="relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:ring-offset-2 bg-gray-200" role="switch" aria-checked="false" :aria-checked="on.toString()" @click="on = !on" x-state:on="Enabled" x-state:off="Not Enabled" :class="{ 'bg-indigo-600': on, 'bg-gray-200': !(on) }">
                <span class="sr-only">Cambiar modulo a la funcion</span>
                <span class="pointer-events-none relative inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out translate-x-0" x-state:on="Enabled" x-state:off="Not Enabled" :class="{ 'translate-x-5': on, 'translate-x-0': !(on) }">
                  <span class="absolute inset-0 flex h-full w-full items-center justify-center transition-opacity opacity-100 duration-200 ease-in" aria-hidden="true" x-state:on="Enabled" x-state:off="Not Enabled" :class="{ 'opacity-0 duration-100 ease-out': on, 'opacity-100 duration-200 ease-in': !(on) }">
                    <svg class="h-3 w-3 text-gray-400" fill="none" viewBox="0 0 12 12">
                      <path d="M4 8l2-2m0 0l2-2M6 6L4 4m2 2l2 2" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                  </span>
                  <span class="absolute inset-0 flex h-full w-full items-center justify-center transition-opacity opacity-0 duration-100 ease-out" aria-hidden="true" x-state:on="Enabled" x-state:off="Not Enabled" :class="{ 'opacity-100 duration-200 ease-in': on, 'opacity-0 duration-100 ease-out': !(on) }">
                    <svg class="h-3 w-3 text-indigo-600" fill="currentColor" viewBox="0 0 12 12">
                      <path d="M3.707 5.293a1 1 0 00-1.414 1.414l1.414-1.414zM5 8l-.707.707a1 1 0 001.414 0L5 8zm4.707-3.293a1 1 0 00-1.414-1.414l1.414 1.414zm-7.414 2l2 2 1.414-1.414-2-2-1.414 1.414zm3.414 2l4-4-1.414-1.414-4 4 1.414 1.414z"></path>
                    </svg>
                  </span>
                </span>
              </button>
            </div>


        <div class="grid w-full gap-x-6 gap-y-8 grid-cols-9 md:col-span-2 ring-1 ring-gray-900/5 sm:rounded-xl mt-6" x-show="on" x-cloak>
            <div class="col-span-full">
                <h2 class="text-base font-semibold leading-6 text-white">Cambiar modulo a la función {{ $name }}</h2>
                <p class="mt-2 text-sm text-gray-300">Selecciona el modulo de la lista.</p>
            </div>
            <div class="col-span-6">

                <livewire:master.features.partials.select-module :selectedModule="$module">



                <button wire:click="updateModule()"
                    class="rounded-md bg-indigo-600 px-3 py-2 font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 text-sm focus-visible:outline-indigo-600">Cambiar modulo</button>

            </div>


        </div>

        </div>




    </div>




</div>
