<div>
    <div class="mx-auto max-w-screen-2xl pt-2 lg:flex lg:gap-x-16 lg:px-8">
        <h1 class="sr-only">Edicion de rol </h1>

        <aside
            class="flex overflow-x-auto border-b border-gray-900/5 py-4 lg:block lg:w-64 lg:flex-none lg:border-0 lg:py-20">

            @include('components.panel.settings.menu-side-bar-settings')

        </aside>
        <main class="px-4 py-16 sm:px-6 lg:flex-auto lg:px-0 lg:py-20">
            <div class="mx-auto max-w-2xl space-y-16 sm:space-y-20 lg:mx-0 lg:max-w-none">

                <div class="sm:flex sm:items-center">
                    <div class="sm:flex-auto">
                        <h1 class="text-base font-semibold leading-6 text-gray-900">Roles</h1>
                        <p class="mt-2 text-sm text-gray-700">Edita un rol para asignar permisos a los usuarios.
                        </p>
                    </div>
                    <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                        <a href={{ route('panel.settings.roles.list') }} wire:navigate
                            class="cursor-pointer block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                            Atras
                        </a>
                    </div>
                </div>
                <div class="mt-8 flow-root">
                    <div
                        class="-mx-4 -mt-2 mb-4 sm:-mx-6 lg:mx-0 sm:shadow sm:rounded-lg bg-white  border-t border-gray-200">
                        <div class="inline-block space-y-4 min-w-full p-4 lg:p-6 align-middle sm:px-6 lg:px-4">

                            <div class="lg:col-span-3 col-span-full">
                                <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Nombre
                                    de Rol </label>
                                <div class="mt-2">
                                    <input type="text" wire:model="name" name="name" id="name" value="name"
                                        autocomplete="off" placeholder="Escriba un nombre para la Rol"
                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 text-sm sm:leading-6">
                                </div>
                                @error('name')
                                    <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                @enderror
                            </div>




                            <div class="lg:col-span-3 col-span-full">
                                <label for="description"
                                    class="block text-sm font-medium leading-6 text-gray-900">Descripcion</label>
                                <div class="mt-2">
                                    <input type="text" wire:model="description" name="description" id="description"
                                        value="description" autocomplete="off"
                                        placeholder="Escriba la descripcion del rol"
                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 text-sm sm:leading-6">
                                </div>

                                @error('description')
                                    <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="lg:col-span-3 col-span-full">

                                <livewire:master.businesses.partials.select-user :selectedUser="$role->createdBy" type='role'>

                            </div>

                            <div class="lg:col-span-3 col-span-full">
                                <label for="description"
                                    class="block text-sm font-medium leading-6 text-gray-900">Usuarios</label>
                                <div class="mt-2">
                                    <livewire:components.multi-select-general :selectedValues="$selectedUsers" :values="$users"
                                        :imageValue="false" :searchEnabled="true" :name="'users'" :model="false">

                                </div>
                            </div>

                        </div>


                    </div>



                    <div class="flex items-center md:justify-start justify-start gap-x-6 py-4">

                        <button wire:click="update"
                            class="rounded-md bg-indigo-600 px-3 py-2 font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 text-sm focus-visible:outline-indigo-600">Editar</button>



                    </div>


                </div>





                <div class="mt-8 flow-root">

                    <h1 class="text-base font-semibold leading-6 text-gray-900">Funciones</h1>
                    <p class="mt-2 text-sm text-gray-700">Asigna funciones a este rol.</p>

                    <div
                        class="-mx-4 mb-4 sm:-mx-6 lg:mx-0 sm:shadow sm:rounded-lg mt-4 bg-white  border-t border-gray-200">
                        <div class="grid grid-cols-1 space-y-4 min-w-full align-middle">
                            {{--
                            <div class="lg:col-span-3 col-span-full">
                                <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Nombre
                                    de Rol </label>
                                <div class="mt-2">
                                    <input type="text" wire:model="name" name="name" id="name" value="name"
                                        autocomplete="off" placeholder="Escriba un nombre para la Rol"
                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 text-sm sm:leading-6">
                                </div>
                                @error('name')
                                    <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                @enderror
                            </div> --}}





                            <div class="lg:col-span-3 col-span-full">

                                <livewire:panel.settings.roles.partials.multi-selected-features-roles :role="$role">


                            </div>






                        </div>


                    </div>



                    {{-- <div class="flex items-center md:justify-start justify-start gap-x-6 py-4">

                        <button wire:click="update"
                            class="rounded-md bg-indigo-600 px-3 py-2 font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 text-sm focus-visible:outline-indigo-600">Editar</button>



                    </div> --}}


                </div>

            </div>
        </main>

    </div>
    <livewire:panel.settings.roles.partials.modals.confirm-modal-next-module-un-saved>

</div>
