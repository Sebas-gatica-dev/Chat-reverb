<div>

    <div class="mx-auto max-w-screen-2xl pt-2 lg:flex lg:gap-x-16 lg:px-8">
        <h1 class="sr-only">Crear un nuevo documento</h1>

        <aside
            class="flex overflow-x-auto border-b border-gray-900/5 py-4 lg:block lg:w-64 lg:flex-none lg:border-0 lg:py-20">

            @include('components.panel.settings.menu-side-bar-settings')

        </aside>

        <main class="px-4 py-16 sm:px-6 lg:flex-auto lg:px-0 lg:pt-20 ">
            <div class="mx-auto max-w-2xl space-y-4 sm:space-y-4 lg:mx-0 lg:max-w-none">

                <div class="sm:flex sm:items-center">
                    <div class="sm:flex-auto">
                        <h1 class="text-base font-semibold leading-6 text-gray-900">Documento</h1>
                        <p class="mt-2 text-sm text-gray-700">Crea una nueva documento para los presupuestos de tu
                            negocio
                        </p>
                    </div>
                    <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                        <a wire:navigate href="{{ route('panel.settings.budgets.documents.list') }}"
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
                                    <label for="name"
                                        class="block text-sm font-medium leading-6 text-gray-900">Nombre de documento
                                    </label>
                                    <div class="mt-2">
                                        <input type="text" wire:model="name" name="name" id="name"
                                            autocomplete="off" placeholder="Escriba nombre de documento"
                                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 text-sm sm:leading-6">
                                    </div>
                                    @error('name')
                                        <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- SELECCIONAR USUARIOS PARA LA SUCURSAL --}}


                             
                                    <div class="lg:col-span-6 col-span-full">
                                        <label for="photo"
                                            class="block text-sm font-medium leading-6 text-gray-900">Documento</label>

                                        <livewire:components.upload-file :multiple="false" :types="['document']"
                                            :name="'budget-document'" />

                                        @error('photo')
                                            <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                        @enderror

                                    </div>
                             




                                <div class="col-span-full sm:col-span-6 md:col-span-6 xl:col-span-6">
                                    <label for="description"
                                        class="block text-sm font-medium leading-6 text-gray-900">Descripción</label>
                                    <div class="mt-2">
                                        <textarea wire:model="description" id="description" rows="3"
                                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300
                                                                                placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 text-sm sm:leading-6"
                                            placeholder="Escriba una descripción (opcional)"></textarea>
                                    </div>
                                    @error('description')
                                        <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                    @enderror
                                </div>


                            </div>
                        </div>


                    </div>


                </div>



                <div class="flex items-center justify-end gap-x-4  px-4  sm:px-8">
                    <button wire:click="save('save')"
                        class="rounded-md bg-indigo-600 px-3 py-2 font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 text-sm focus-visible:outline-indigo-600">Crear</button>

                    <button wire:click="save('save-new')"
                        class="rounded-md bg-indigo-600 px-3 py-2 font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 text-sm focus-visible:outline-indigo-600">Crear
                        y crear otra</button>
                </div>


        </main>



    </div>
</div>
