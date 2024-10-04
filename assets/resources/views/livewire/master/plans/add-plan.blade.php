<div>
    <div class="px-4 py-6 sm:p-8">
        <h1 class="sr-only">Creacion de planes</h1>


        <div class="mt-2 sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-base font-semibold leading-6 text-white">Crear plan</h1>
                <p class="mt-2 text-sm text-gray-300">Llena el formulario para crear el plan</p>
            </div>

            <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                <a wire:navigate href="{{ route('master.plans.index') }}"
                    class="inline-flex items-center gap-x-1.5 rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">

                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="-ml-0.5 h-5 w-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                    </svg>
                    Atras

                </a>

            </div>

        </div>



        <div class="ring-1 ring-gray-900/5 sm:rounded-xl md:col-span-full mt-6">


            <div class="grid w-full gap-x-6 gap-y-8 grid-cols-9 md:col-span-2">

                <div class="lg:col-span-3 col-span-full">
                    <label for="first-name" class="block text-sm font-medium leading-6 text-white">Nombre
                        del plan</label>
                    <div class="mt-2">
                        <input type="text" wire:model="name" id="name" autocomplete="off"
                            placeholder="Ingrese el nombre del plan"
                            class="block w-full rounded-md border-0 bg-white/5 py-1.5 text-white shadow-sm ring-1 ring-inset ring-white/10 focus:ring-2 focus:ring-inset focus:ring-indigo-500 text-sm sm:leading-6">
                    </div>
                    @error('name')
                        <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                    @enderror
                </div>




                <div class="lg:col-span-3 col-span-full">
                    <label for="price" class="block text-sm font-medium leading-6 text-white">Precio</label>
                    <div class="mt-2">
                        <input id="price" wire:model="price" type="text" autocomplete="price"
                            placeholder="$25.000"
                            class="block w-full rounded-md border-0 bg-white/5 py-1.5 text-white shadow-sm ring-1 ring-inset ring-white/10 focus:ring-2 focus:ring-inset focus:ring-indigo-500 text-sm sm:leading-6">
                    </div>

                    @error('price')
                        <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                    @enderror
                </div>



                <div class="lg:col-span-3 col-span-full">
                    <label for="free_trial_days" class="block text-sm font-medium leading-6 text-white">Días
                        gratis</label>
                    <div class="mt-2">


                        <input type="text" wire:model="free_trial_days" id="free_trial_days" autocomplete="off"
                            placeholder="Ingrese los días gratis" value="0"
                            class="block w-full rounded-md border-0 bg-white/5 py-1.5 text-white shadow-sm ring-1 ring-inset ring-white/10 focus:ring-2 focus:ring-inset focus:ring-indigo-500 text-sm sm:leading-6">

                    </div>

                    @error('free_trial_days')
                        <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                    @enderror

                </div>


                <div class="lg:col-span-3 col-span-full">
                    <label for="duration" class="block text-sm font-medium leading-6 text-white">Unidad de
                        frecuencia</label>
                    <div class="mt-2">
                        <input type="text" wire:model="duration" id="duration" autocomplete="off"
                            placeholder="Ingrese la unidad de frecuencia"
                            class="block w-full rounded-md border-0 bg-white/5 py-1.5 text-white shadow-sm ring-1 ring-inset ring-white/10 focus:ring-2 focus:ring-inset focus:ring-indigo-500 text-sm sm:leading-6">
                    </div>
                    @error('duration')
                        <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                    @enderror
                </div>




                <div class="lg:col-span-3 col-span-full">
                    <label for="duration_unit" class="block text-sm font-medium leading-6 text-white">Frecuencia</label>
                    <div class="mt-2">

                        <select wire:model="duration_unit" name="duration_unit"
                            class="block w-full rounded-md border-0 py-1.5 text-gray-200 bg-gray-800 shadow-sm ring-1 ring-inset ring-white/10 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs text-sm sm:leading-6">
                            <option value="">Seleccione una opción</option>
                            <option value="month">Mensual</option>
                            <option value="year">Anual</option>
                        </select>

                    </div>

                    @error('duration_unit')
                        <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                    @enderror
                </div>



                <div class="lg:col-span-3 col-span-full">

                    <div class="mt-6">
                        <fieldset>
                            <div class="relative flex gap-x-3">
                                <div class="flex h-6 mt-2 items-center">
                                    <input id="is_featured" wire:model="is_featured" type="checkbox"
                                        class="h-4 w-4 rounded ring-white/10 bg-gray-800 text-indigo-600 focus:ring-indigo-600">
                                </div>
                                <div class="text-sm leading-6">
                                    <label for="is_featured" class="font-medium text-white">Destacar
                                        plan</label>
                                    <p class="text-gray-400">Resalta este plan en la lista de planes.
                                    </p>
                                </div>
                            </div>

                        </fieldset>
                    </div>


                    @error('is_featured')
                        <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                    @enderror

                </div>




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



</div>
