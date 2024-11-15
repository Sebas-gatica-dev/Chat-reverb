<div>
    <div class="mx-auto max-w-screen-2xl pt-2 lg:flex lg:gap-x-16 lg:px-8">
        <h1 class="sr-only">Plantillas de estadísticas</h1>

        <aside
            class="flex overflow-x-auto border-b border-gray-900/5 py-4 lg:block lg:w-64 lg:flex-none lg:border-0 lg:py-20">

            @include('components.panel.settings.menu-side-bar-settings')

        </aside>
        <main class="px-4 py-16 sm:px-6 lg:flex-auto lg:px-0 lg:py-20">
            <div class="mx-auto max-w-2xl space-y-16 sm:space-y-10 lg:mx-0 lg:max-w-none">

                <div class="sm:flex sm:items-center" x-data="{ open: false }">
                    <div class="sm:flex-auto">
                        <h1 class="text-base font-semibold leading-6 text-gray-900">Crear plantilla de estadística</h1>
                        <p class="mt-2 text-sm text-gray-700">Crea la plantilla de estadísticas visibles para cada
                            usuario o
                            grupo de usuarios según su rol.
                        </p>
                    </div>


                </div>


                {{-- Datos principales --}}

                <div class="mt-8 flow-root">
                    <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl md:col-span-3">

                        <div class="px-4 py-6 sm:p-8">
                            <div class="grid w-full grid-cols-1 gap-x-6 gap-y-6 md:gap-y-8 sm:grid-cols-12">

                                <div class="col-span-full sm:col-span-3 md:col-span-4  xl:col-span-3 ">
                                    <label for="name"
                                        class="block text-sm font-medium leading-6 text-gray-900">Nombre de la
                                        plantilla</label>
                                    <div class="mt-2">
                                        <input type="text" wire:model="name" name="name" id="name"
                                            autocomplete="off" placeholder="Escriba un nombre para la plantilla"
                                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 text-sm sm:leading-6">
                                    </div>
                                    @error('name')
                                        <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                    @enderror
                                </div>



                                <div class="col-span-full sm:col-span-3 md:col-span-4  xl:col-span-3 ">
                                    <livewire:components.multi-select-general :selectedValues="$selectedRoles" :values="$roles"
                                        :imageValue="false" :defaultOption="'Elegí roles'" :searchEnabled="true" :name="'roles'"
                                        :model="false" label="Roles" />

                                    @error('selectedRoles')
                                        <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                    @enderror
                                </div>


                                <div class="col-span-full sm:col-span-3 md:col-span-4  xl:col-span-3 ">
                                    <livewire:components.multi-select-general :selectedValues="$selectedUsers" :values="$users"
                                        :imageValue="false" :defaultOption="'Elegí los usuarios'" :searchEnabled="true" :name="'users'"
                                        :model="false" label="Usuarios" />

                                    @error('selectedRoles')
                                        <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                    @enderror
                                </div>


                                <div class="col-span-full">
                                    <label for="description"
                                        class="block text-sm font-medium leading-6 text-gray-900">Descripción</label>
                                    <div class="mt-2">

                                        <textarea wire:model="description" autocomplete="off" placeholder="Agrege un comentario" id="description"
                                            name="description" rows="3"
                                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 text-sm  sm:leading-6"></textarea>
                                    </div>

                                    @error('description')
                                        <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                    @enderror
                                </div>





                            </div>


                        </div>

                        <div class="flex items-center justify-end pr-7 pb-6">
                            <button wire:click="save()"
                                class="rounded-md bg-indigo-600 px-3 py-2 font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 text-sm focus-visible:outline-indigo-600">Crear</button>
                        </div>
                    </div>
                </div>

            </div>
        </main>
    </div>
</div>
