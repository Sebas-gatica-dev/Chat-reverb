<div>
    <div class="mx-auto max-w-screen-2xl pt-2 lg:flex lg:gap-x-16 lg:px-8">
        <h1 class="sr-only">Creacion de rol</h1>

        <aside
            class="flex overflow-x-auto border-b border-gray-900/5 py-4 lg:block lg:w-64 lg:flex-none lg:border-0 lg:py-20">

            @include('components.panel.settings.menu-side-bar-settings')

        </aside>
        <main class="px-4 py-16 sm:px-6 lg:flex-auto lg:px-0 lg:py-20">
            <div class="mx-auto max-w-2xl space-y-16 sm:space-y-20 lg:mx-0 lg:max-w-none">

                <div class="sm:flex sm:items-center">
                    <div class="sm:flex-auto">
                        <h1 class="text-base font-semibold leading-6 text-gray-900">Roles</h1>
                        <p class="mt-2 text-sm text-gray-700">Crea un nuevo rol para asignar permisos a los usuarios.
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
                    <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl md:col-span-3">

                        <div class="px-4 py-6 sm:p-8">
                            <div class="grid w-full grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-9">
                                <div class="lg:col-span-4 col-span-full">
                                    <label for="name"
                                        class="block text-sm font-medium leading-6 text-gray-900">Nombre
                                        de Rol </label>
                                    <div class="mt-2">
                                        <input type="text" wire:model="name" name="name" id="name"
                                            autocomplete="off" placeholder="Escriba un nombre para la Rol"
                                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 text-sm sm:leading-6">
                                    </div>
                                    @error('name')
                                        <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                    @enderror
                                </div>




                                <div class="lg:col-span-4 col-span-full">
                                    <label for="description"
                                        class="block text-sm font-medium leading-6 text-gray-900">Descripcion</label>
                                    <div class="mt-2">
                                        <input type="text" wire:model="description" name="description"
                                            id="description" autocomplete="off"
                                            placeholder="Escriba la descripcion del rol"
                                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 text-sm sm:leading-6">
                                    </div>

                                    @error('description')
                                        <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="lg:col-span-4 col-span-full" x-data="{ on: @entangle('on').live }">

                                    <div class="inline-flex items-center gap-2">
                                        <span class="text-sm text-gray-900">¿Desea copiar las funciones de otro rol a
                                            este
                                            nuevo? </span>
                                        <button type="button"
                                            class="relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:ring-offset-2 bg-gray-200"
                                            role="switch" aria-checked="false" :aria-checked="on.toString()"
                                            @click="on = !on" x-state:on="Enabled" x-state:off="Not Enabled"
                                            :class="{ 'bg-indigo-600': on, 'bg-gray-200': !(on) }">
                                            <span class="sr-only">Copiar las funciones de otro rol a este nuevo</span>
                                            <span
                                                class="pointer-events-none relative inline-block h-5 w-5 transform rounded-full bg-white ring-0 transition duration-200 ease-in-out translate-x-0"
                                                x-state:on="Enabled" x-state:off="Not Enabled"
                                                :class="{ 'translate-x-5': on, 'translate-x-0': !(on) }">
                                                <span
                                                    class="absolute inset-0 flex h-full w-full items-center justify-center transition-opacity opacity-100 duration-200 ease-in"
                                                    aria-hidden="true" x-state:on="Enabled" x-state:off="Not Enabled"
                                                    :class="{
                                                        'opacity-0 duration-100 ease-out': on,
                                                        'opacity-100 duration-200 ease-in':
                                                            !(on)
                                                    }">
                                                    <svg class="h-3 w-3 text-gray-400" fill="none"
                                                        viewBox="0 0 12 12">
                                                        <path d="M4 8l2-2m0 0l2-2M6 6L4 4m2 2l2 2" stroke="currentColor"
                                                            stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round">
                                                        </path>
                                                    </svg>
                                                </span>
                                                <span
                                                    class="absolute inset-0 flex h-full w-full items-center justify-center transition-opacity opacity-0 duration-100 ease-out"
                                                    aria-hidden="true" x-state:on="Enabled" x-state:off="Not Enabled"
                                                    :class="{
                                                        'opacity-100 duration-200 ease-in': on,
                                                        'opacity-0 duration-100 ease-out':
                                                            !(on)
                                                    }">
                                                    <svg class="h-3 w-3 text-indigo-600" fill="currentColor"
                                                        viewBox="0 0 12 12">
                                                        <path
                                                            d="M3.707 5.293a1 1 0 00-1.414 1.414l1.414-1.414zM5 8l-.707.707a1 1 0 001.414 0L5 8zm4.707-3.293a1 1 0 00-1.414-1.414l1.414 1.414zm-7.414 2l2 2 1.414-1.414-2-2-1.414 1.414zm3.414 2l4-4-1.414-1.414-4 4 1.414 1.414z">
                                                        </path>
                                                    </svg>
                                                </span>
                                            </span>
                                        </button>
                                    </div>


                                    <div class="mt-4" x-show="on" x-cloak>

                                        <livewire:components.select-general :selectedValue="$selectedRole" :values="$roles"
                                            :imageValue="false" :searchEnabled="true" :name="'roles'" :model="false">

                                    </div>

                                </div>


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
        </main>
    </div>

</div>
