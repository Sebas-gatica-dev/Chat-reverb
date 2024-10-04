<div>
    <div class="mx-auto max-w-screen-2xl pt-2 lg:flex lg:gap-x-16 lg:px-8">
        <h1 class="sr-only">Configuracion de sucursales</h1>

        <aside
            class="flex overflow-x-auto border-b border-gray-900/5 py-4 lg:block lg:w-64 lg:flex-none lg:border-0 lg:py-20">

            @include('components.panel.settings.menu-side-bar-settings')

        </aside>
        <main class="px-4 py-16 sm:px-6 lg:flex-auto lg:px-0 lg:py-20">
            <div class="mx-auto max-w-2xl space-y-16 sm:space-y-20 lg:mx-0 lg:max-w-none">

                <div class="sm:flex sm:items-center" x-data="{ open: false }">
                    <div class="sm:flex-auto">
                        <h1 class="text-base font-semibold leading-6 text-gray-900">Servicios</h1>
                        <p class="mt-2 text-sm text-gray-700">Administra los servicios que ofrecen en tu negocio.
                        </p>
                    </div>

                    @can('access-function','service-add')
                        <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                            <div @click="open = true"
                                class="cursor-pointer block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                                Agregar servicio
                            </div>
                        </div>
                    @endcan


                    <div class="relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true"
                        x-show="open" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
                        x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
                        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" x-cloak
                        x-on:keydown.escape.window="open = false" x-on:close-modal.window="open = false"
                        wire:keydown.enter="createService">


                        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true">
                        </div>

                        <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
                            <div
                                class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">

                                <div class="relative transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg sm:p-6"
                                    x-on:click.away="open = false">


                                    <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                                        <h3 class="text-base font-semibold leading-6 text-gray-900 mb-4"
                                            id="modal-title">Agregar servicio</h3>
                                        <div class="col-span-full">
                                            <label for="name"
                                                class="block text-sm font-medium leading-6 text-gray-900">Nombre</label>
                                            <div class="mt-2">
                                                <input type="text" wire:model="name" name="name" id="name"
                                                    autocomplete="off"
                                                    placeholder="Escriba un nombre para el servicio"
                                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 text-sm sm:leading-6">
                                            </div>
                                            @error('name')
                                                <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
                                        <button type="button" wire:click="createService"
                                            class="inline-flex w-full justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 sm:ml-3 sm:w-auto">Agregar</button>
                                        <button type="button"
                                            class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto"
                                            x-on:click="open = false">Volver</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>


                <div class="mt-8 flow-root" x-data="{ open: false }">
                    <div
                        class="-mx-4 -mt-2 mb-4 overflow-x-auto sm:-mx-6 lg:mx-0 sm:shadow sm:rounded-lg bg-white  border-t border-gray-200">
                        <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-4">
                            <table class="min-w-full divide-y divide-gray-300">
                                <thead>
                                    <tr>
                                        <th scope="col"
                                            class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">
                                            Nombre</th>
                                        <th scope="col"
                                            class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Estado
                                        </th>
                                        {{-- <th scope="col"
                                            class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Creado por
                                        </th> --}}
                                        {{-- <th scope="col"
                                                    class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Acciones
                                                </th> --}}
                                        <th scope="col" class="relative text-right py-3.5 font-semibold pl-3 pr-16">
                                            <span class="sr-only">Acciones</span>Acciones

                                            <svg wire:loading.inline wire:target="restoreService, forceDeleteService, deleteService" class="absolute right-1 hidden animate-spin mx-4 h-5 w-5 text-gray-800" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                              </svg>
                                        </th>
                                        
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    @forelse ($services as $service)
                                        <div wire:key="{{ $service->id }}">
                                            <tr>
                                                <td
                                                    class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-0">
                                                    {{ $service->name }}</td>
                                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                    <div class="flex items-center justify-end gap-x-2 sm:justify-start">
                                                        @if ($service->deleted_at)
                                                            <div
                                                                class="flex-none rounded-full bg-rose-400/10 p-1 text-rose-400">
                                                                <div class="h-1.5 w-1.5 rounded-full bg-current"></div>
                                                            </div>
                                                            <div class="sm:block">Inactiva</div>
                                                        @else
                                                            <div
                                                                class="flex-none rounded-full bg-green-400/10 p-1 text-green-400">
                                                                <div class="h-1.5 w-1.5 rounded-full bg-current"></div>
                                                            </div>
                                                            <div class="sm:block">Activa</div>
                                                        @endif
                                                    </div>
                                                </td>

                                                <td
                                                    class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-0">


                                                    @if ($service->deleted_at)
                                                        @can('access-function','service-delete')
                                                        <button wire:click="forceDeleteService('{{ $service->id }}')"
                                                            wire:confirm="¿Estás seguro de que deseas eliminar definitivamente este servicio?"
                                                            class="text-red-600 hover:text-red-900 ml-4">Eliminar</button>
                                                        @endcan    
                                                        @can('access-function','service-restore')
                                                        <button wire:click="restoreService('{{ $service->id }}')"
                                                            class="text-green-600 hover:text-green-900 ml-4">Activar</button>
                                                        @endcan    
                                                    @else
                                                        @can('access-function','service-edit')

                                                            <button wire:click="editModalService('{{ $service->id }}')"
                                                                class="text-indigo-600 hover:text-indigo-900">Editar<span
                                                                    class="sr-only">{{ $service->name }}</span></button>

                                                        @endcan

                                                        @can('access-function','service-soft')

                                                        <button wire:click="deleteService('{{ $service->id }}')"
                                                            class="text-red-600 hover:text-red-900 ml-4">Desactivar</button>

                                                        @endcan    
                                                    @endif
                                                </td>
                                            </tr>
                                        </div>
                                    @empty
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-500">
                                                No hay servicios registrados.
                                            </td>
                                        </tr>
                                    @endforelse

                                </tbody>
                            </table>


                        </div>



                        <div class="relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true"
                            x-show="open" x-transition:enter="ease-out duration-300"
                            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                            x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100"
                            x-transition:leave-end="opacity-0" x-cloak x-on:keydown.escape.window="open = false"
                            x-on:open-edit-modal.window="open = true" wire:keydown.enter="updateService"
                            x-on:close-edit-modal.window="open = false">



                            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"
                                aria-hidden="true">
                            </div>

                            <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
                                <div
                                    class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">

                                    <div class="relative transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg sm:p-6"
                                        x-on:click.away="open = false">


                                        <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                                            <h3 class="text-base font-semibold leading-6 text-gray-900 mb-4"
                                                id="modal-title">Editar servicio</h3>
                                            <div class="col-span-full">
                                                <label for="editName"
                                                    class="block text-sm font-medium leading-6 text-gray-900">Nombre</label>
                                                <div class="mt-2">
                                                    <input type="text" wire:model="editName" id="editName"
                                                        autocomplete="off"
                                                        placeholder="Escriba un nombre para el servicio"
                                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 text-sm sm:leading-6">
                                                </div>
                                                @error('editName')
                                                    <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
                                            <button type="button" wire:click="updateService"
                                                class="inline-flex w-full justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 sm:ml-3 sm:w-auto">Guardar</button>



                                            <button type="button"
                                                class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto"
                                                x-on:click="open = false">Volver</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>

                    {{ $services->links(data: ['scrollTo' => false]) }}

                </div>




            </div>
        </main>




    </div>

</div>
