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
                        <h1 class="text-base font-semibold leading-6 text-gray-900">Editar plantilla de estadística</h1>
                        <p class="mt-2 text-sm text-gray-700">Edita la plantilla de estadísticas visibles para cada
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

                                    @error('selectedUsers')
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
                            <button wire:click="edit()"
                                class="rounded-md bg-indigo-600 px-3 py-2 font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 text-sm focus-visible:outline-indigo-600">Editar</button>
                        </div>
                    </div>
                </div>


                <div class="flex justify-end gap-x-4">

                    <div x-data="{
                        slideOverOpen: false
                    }" class="relative z-50 w-auto h-auto">
                        <button @click="slideOverOpen=true, $dispatch('refresh-widgets')"
                            class="inline-flex items-center justify-center h-10 px-4 py-2 text-sm font-medium transition-colors bg-white border rounded-md hover:bg-neutral-100 active:bg-white focus:bg-white focus:outline-none focus:ring-2 focus:ring-neutral-200/60 focus:ring-offset-2 disabled:opacity-50 disabled:pointer-events-none">Previsualizar
                            plantilla</button>
                        <template x-teleport="body">
                            <div x-show="slideOverOpen" @keydown.window.escape="slideOverOpen=false"
                                class="relative z-[99]">
                                <div x-show="slideOverOpen" x-transition.opacity.duration.600ms
                                    @click="slideOverOpen = false"
                                    class="fixed inset-0 bg-black backdrop-blur-sm bg-opacity-70"></div>
                                <div class="fixed inset-0 overflow-hidden">
                                    <div class="absolute inset-0 overflow-hidden">
                                        <div class="fixed inset-y-0 right-0 flex max-w-screen-2xl pl-10">
                                            <div x-show="slideOverOpen" @click.away="slideOverOpen = false"
                                                x-transition:enter="transform transition ease-in-out duration-500 sm:duration-700"
                                                x-transition:enter-start="translate-x-full"
                                                x-transition:enter-end="translate-x-0"
                                                x-transition:leave="transform transition ease-in-out duration-500 sm:duration-700"
                                                x-transition:leave-start="translate-x-0"
                                                x-transition:leave-end="translate-x-full" class="w-screen max-w-full">
                                                <div
                                                    class="flex flex-col h-full py-5 overflow-y-scroll bg-white border-l shadow-lg border-neutral-100/70">
                                                    <div class="px-4 sm:px-5">
                                                        <div class="flex items-start justify-between pb-1">
                                                            <h2 class="text-base font-semibold leading-6 text-gray-900"
                                                                id="slide-over-title">Full-screen Slide Over Title</h2>
                                                            <div class="flex items-center h-auto ml-3">
                                                                <button @click="slideOverOpen=false"
                                                                    class="absolute top-0 right-0 z-30 flex items-center justify-center px-3 py-2 mt-4 mr-5 space-x-1 text-xs font-medium uppercase border rounded-md border-neutral-200 text-neutral-600 hover:bg-neutral-100">
                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                        fill="none" viewBox="0 0 24 24"
                                                                        stroke-width="1.5" stroke="currentColor"
                                                                        class="w-4 h-4">
                                                                        <path stroke-linecap="round"
                                                                            stroke-linejoin="round"
                                                                            d="M6 18L18 6M6 6l12 12"></path>
                                                                    </svg>
                                                                    <span>Cerrar</span>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="relative flex-1 px-4 mt-5 sm:px-5">
                                                        <div class="absolute inset-0 px-4 sm:px-5">
                                                            <div
                                                                class="relative h-full ">

                                                                <livewire:panel.stats.preview-stats :template="$template" lazy :sizeable="true" :sortable="true" />

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </div>



                    <div x-data="{
                        slideOverOpen: false
                    }"
                        @form-widget.window="slideOverOpen = !slideOverOpen"
                    class="relative z-50 w-auto h-auto">
                        <button @click="slideOverOpen=true"
                            class="inline-flex items-center justify-center h-10 px-4 py-2 text-sm font-medium transition-colors bg-white border rounded-md hover:bg-neutral-100 active:bg-white focus:bg-white focus:outline-none focus:ring-2 focus:ring-neutral-200/60 focus:ring-offset-2 disabled:opacity-50 disabled:pointer-events-none">Crear
                            widget</button>
                        <template x-teleport="body">
                            <div x-show="slideOverOpen" @keydown.window.escape="slideOverOpen=false, $dispatch('form-widget-closed')"
                                                        class="relative z-[99]">
                                <div x-show="slideOverOpen" x-transition.opacity.duration.600ms
                                    @click="slideOverOpen = false"
                                    class="fixed inset-0 bg-black backdrop-blur-sm bg-opacity-70"></div>
                                <div class="fixed inset-0 overflow-hidden">
                                    <div class="absolute inset-0 overflow-hidden">
                                        <div class="fixed inset-y-0 right-0 flex max-w-full pl-10">
                                            <div x-show="slideOverOpen" @click.away="slideOverOpen = false, $dispatch('form-widget-closed')"
                                                x-transition:enter="transform transition ease-in-out duration-500 sm:duration-700"
                                                x-transition:enter-start="translate-x-full"
                                                x-transition:enter-end="translate-x-0"
                                                x-transition:leave="transform transition ease-in-out duration-500 sm:duration-700"
                                                x-transition:leave-start="translate-x-0"
                                                x-transition:leave-end="translate-x-full" class="w-screen max-w-md">
                                                <div
                                                    class="flex flex-col h-full py-5 bg-white border-l shadow-lg border-neutral-100/70 ">
                                                    <div class="px-4 sm:px-5">
                                                        <div class="flex items-start justify-between pb-1">
                                                            <h2 class="text-base font-semibold leading-6 text-gray-900"
                                                                id="slide-over-title">Formulario del widget</h2>
                                                            <div class="flex items-center h-auto mx-3">
                                                                <button @click="slideOverOpen=false"
                                                                    class="absolute top-0 right-0 z-30 flex items-center justify-center px-3 py-2 mt-4 mr-5 space-x-1 text-xs font-medium uppercase border rounded-md border-neutral-200 text-neutral-600 hover:bg-neutral-100">
                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                        fill="none" viewBox="0 0 24 24"
                                                                        stroke-width="1.5" stroke="currentColor"
                                                                        class="w-4 h-4">
                                                                        <path stroke-linecap="round"
                                                                            stroke-linejoin="round"
                                                                            d="M6 18L18 6M6 6l12 12"></path>
                                                                    </svg>
                                                                    <span>Cerrar</span>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="relative flex-1 px-4 mt-5 sm:px-5">
                                                        <div class="absolute inset-0 px-4 sm:px-5">
                                                            <div
                                                                class="relative h-full overflow-hidden overflow-y-auto">

                                                                <livewire:panel.settings.stats.form-widget :templateId="$template->id" @refresh="$refresh" />

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </div>

                </div>


                {{-- Widgets --}}

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
                                            class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Fechas
                                        </th>
                                        <th scope="col"
                                            class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Color
                                        </th>
                                        <th scope="col"
                                            class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Tamaño
                                        </th>
                                        {{-- <th scope="col"
                                            class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Creado por
                                        </th> --}}
                                        {{-- <th scope="col"
                                                    class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Acciones
                                                </th> --}}
                                        <th scope="col"
                                            class="relative text-right py-3.5 font-semibold pl-3 pr-16">
                                            <span class="sr-only">Acciones</span>Acciones

                                            <svg wire:loading.inline
                                                wire:target="restoreService, forceDeleteService, deleteService"
                                                class="absolute right-1 hidden animate-spin mx-4 h-5 w-5 text-gray-800"
                                                xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24">
                                                <circle class="opacity-25" cx="12" cy="12" r="10"
                                                    stroke="currentColor" stroke-width="4"></circle>
                                                <path class="opacity-75" fill="currentColor"
                                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                                </path>
                                            </svg>
                                        </th>

                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    @forelse ($widgets as $widget)
                                        <div wire:key="{{ $widget->id }}">
                                            <tr>
                                                <td
                                                    class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-0">

                                                    <div class="font-medium text-gray-900">{{ $widget->title }}</div>
                                                    <div class="mt-1 truncate text-gray-500">{{ $widget->description }}</div>
                                                   </td>

                                                   <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-700">
                                                    <div class="font-medium">{{ $widget->date->getName() }}</div>

                                                 
                                                </td>
                                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                    <div
                                                        class="flex items-center justify-end gap-x-2 sm:justify-start">
                                                     
                                                        <div class="flex-none rounded-full p-1.5" style="background-color: {{$widget->color}}1A; color: {{$widget->color}};">
                                                            <div class="h-4 w-4 rounded-full" style="background-color: {{$widget->color}};"></div>
                                                        </div>
                                                        
                                                            {{-- <div class="sm:block">Inactiva</div> --}}
                                                 
                                                    </div>
                                                </td>

                                                
                                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-700">
                                                    <div class="font-medium">{{ $widget->size->getName() }}</div>

                                                 
                                                </td>

                                                <td
                                                    class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-0">


                                              
                                                        @can('access-function', 'service-edit')
                                                            <span @click="$dispatch('form-widget')" wire:click="editWidget('{{ $widget->id }}')" 
                                                                class="text-indigo-600 hover:text-indigo-900">Editar<span
                                                                    class="sr-only">{{ $widget->name }}</span></span>
                                                        @endcan

                                                        @can('access-function', 'service-soft')
                                                            <button wire:click="deleteWidget('{{ $widget->id }}')"
                                                                wire:confirm="¿Estás seguro de que deseas eliminar este widget?"
                                                                class="text-red-600 hover:text-red-900 ml-4">Eliminar</button>
                                                        @endcan
                                                </td>
                                            </tr>
                                        </div>
                                    @empty
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-500">
                                                No hay servicios registrados.
                                            </td>
                                        </tr> @endforelse
                        </tbody>
                        </table>
                    </div>



                    <div class="relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true"
                        x-show="open" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
                        x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
                        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" x-cloak
                        x-on:keydown.escape.window="open = false" x-on:open-edit-modal.window="open = true"
                        wire:keydown.enter="updateService" x-on:close-edit-modal.window="open = false">



                        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true">
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

                {{ $widgets->links(data: ['scrollTo' => false]) }}

            </div>





    </div>
    </main>
</div>
</div>
