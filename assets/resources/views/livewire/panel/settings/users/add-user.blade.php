<div>
    <div class="mx-auto max-w-screen-2xl pt-2 lg:flex lg:gap-x-16 lg:px-8">
        <h1 class="sr-only">Creacion de usuario</h1>

        <aside
            class="flex overflow-x-auto border-b border-gray-900/5 py-4 lg:block lg:w-64 lg:flex-none lg:border-0 lg:py-20">

            @include('components.panel.settings.menu-side-bar-settings')

        </aside>
        <main class="px-4 py-16 sm:px-6 lg:flex-auto lg:px-0 lg:py-20">
            <div class="mx-auto max-w-2xl space-y-4 sm:space-y-6 lg:mx-0 lg:max-w-none">

                <div class="sm:flex sm:items-center">
                    <div class="sm:flex-auto">
                        <h1 class="text-base font-semibold leading-6 text-gray-900">Usuario</h1>
                        <p class="mt-2 text-sm text-gray-700">Crea un nuevo usuario
                        </p>
                    </div>
                    <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                        <a href={{ route('panel.settings.users.list') }} wire:navigate
                            class="cursor-pointer block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                            Atras
                        </a>
                    </div>
                </div>
                <div class="mt-8 flow-root">
                    <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl md:col-span-3">

                        <div class="px-4 py-6 sm:p-8">
                            <div class="grid w-full grid-cols-1 gap-x-6 gap-y-6 md:gap-y-8 sm:grid-cols-12">

                                <div class="col-span-full sm:col-span-3 md:col-span-4  xl:col-span-3 ">
                                    <label for="name"
                                        class="block text-sm font-medium leading-6 text-gray-900">Nombre
                                        de usuario </label>
                                    <div class="mt-2">
                                        <input type="text" wire:model="name" name="name" id="name"
                                            autocomplete="off" placeholder="Escriba un nombre para el usuario"
                                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 text-sm sm:leading-6">
                                    </div>
                                    @error('name')
                                        <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-span-full sm:col-span-3 md:col-span-4  xl:col-span-3 ">
                                    <label for="email"
                                        class="block text-sm font-medium leading-6 text-gray-900">Correo
                                        electronico</label>
                                    <div class="mt-2">
                                        <input type="email" wire:model="email" name="email" id="email"
                                            autocomplete="off" placeholder="Escriba el correo electronico del usuario"
                                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 text-sm sm:leading-6">
                                    </div>

                                    @error('email')
                                        <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div x-data="{ showPassword: @entangle('showPassword').live }"
                                    class="col-span-full sm:col-span-3 md:col-span-4  xl:col-span-3 ">
                                    <label for="password"
                                        class="block text-sm font-medium leading-6 text-gray-900">Contraseña</label>
                                    <div class="mt-2 relative">
                                        <input :type="showPassword ? 'text' : 'password'" wire:model="password"
                                            name="password" id="password" autocomplete="off"
                                            placeholder="Escriba la contraseña del usuario"
                                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 text-sm sm:leading-6">
                                        <button type="button" @click="showPassword = !showPassword"
                                            class="absolute inset-y-0 right-0 pr-3 flex items-center text-sm leading-6">

                                            <svg :class="{ 'hidden': showPassword, 'block': !showPassword }"
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="h-5 w-5 text-gray-500">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                            </svg>

                                            <svg :class="{ 'block': showPassword, 'hidden': !showPassword }"
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="h-5 w-5 text-gray-500">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                                            </svg>

                                        </button>
                                    </div>
                                    @error('password')
                                        <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div x-data="{ showPassword: @entangle('showPassword').live }"
                                    class="col-span-full sm:col-span-3 md:col-span-4  xl:col-span-3">
                                    <label for="password"
                                        class="block text-sm font-medium leading-6 text-gray-900">Confirmar
                                        contraseña</label>
                                    <div class="mt-2 relative">
                                        <input :type="showPassword ? 'text' : 'password'"
                                            wire:model="password_confirmation" name="password_confirmation"
                                            id="password_confirmation" autocomplete="off"
                                            placeholder="Confirme la contraseña del usuario"
                                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 text-sm sm:leading-6">
                                        <button type="button" @click="showPassword = !showPassword"
                                            class="absolute inset-y-0 right-0 pr-3 flex items-center text-sm leading-6">

                                            <svg :class="{ 'hidden': showPassword, 'block': !showPassword }"
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="h-5 w-5 text-gray-500">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                            </svg>

                                            <svg :class="{ 'block': showPassword, 'hidden': !showPassword }"
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor"
                                                class="h-5 w-5 text-gray-500">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                                            </svg>

                                        </button>
                                    </div>
                                    @error('password_confirmation')
                                        <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-span-full sm:col-span-3 md:col-span-4  xl:col-span-4 ">

                                    <label for="services"
                                        class="block text-sm font-medium leading-6 text-gray-900">Asignar rol
                                        (*)</label>
                                    <div class="mt-2">
                                        <livewire:components.multi-select-general :selectedValues="$selectedRoles" :values="$roles"
                                            :imageValue="false" :searchEnabled="true" :name="'roles'" :model="false">
                                    </div>
                                    @error('selectedRoles')
                                        <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-span-full sm:col-span-3 md:col-span-4  xl:col-span-4 ">
                                    <label for="selectedBranches"
                                        class="block text-sm font-medium leading-6 text-gray-900">Selecciona
                                        sucursales</label>
                                    <div class="mt-2">
                                        <livewire:components.multi-select-general :selectedValue="$selectedBranches" :values="$branches"
                                            :imageValue="false" :searchEnabled="true" :name="'branches'" :model="false">
                                    </div>
                                    @error('selectedBranches')
                                        <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-span-full sm:col-span-3 md:col-span-4  xl:col-span-4 ">
                                    <label for="transport"
                                        class="block text-sm font-medium leading-6 text-gray-900">Selecciona el
                                        transporte</label>
                                    <div class="mt-2">
                                        <select id="transport" wire:model="transport" autocomplete="transport"
                                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                            <option value="">Seleccione el transporte</option>
                                            @foreach ($transports as $transport)
                                                <option value="{{ $transport->value }}">
                                                    {{ \App\Enums\TransportEnum::getTransport($transport) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('transport')
                                        <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                    @enderror
                                </div>


                            </div>

                            <div class="grid w-full grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-12 mt-6 md:mt-4">
                                <div class="lg:col-span-12 col-span-full">
                                    <label for="photo"
                                        class="block text-sm font-medium leading-6 text-gray-900">Foto</label>

                                    <livewire:components.upload-file :multiple="false" :types="['image']" :name="'user-photo'" />

                                    @error('photo')
                                        <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                    @enderror

                                </div>
                            </div>

                        </div>

                    </div>


                </div>



                <div class="grid grid-cols-1 gap-x-8 gap-y-3 pt-2">

                    <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl ">

                        <div class="col-span-full px-4 py-6 sm:p-8">
                            <livewire:components.add-date-availability-general />
                        </div>

                    </div>


                </div>

                <div class="grid grid-cols-1 gap-x-8 gap-y-3 pt-2">
                    {{--  @dump($start_lat, $start_long) --}}



                    <livewire:components.maps.google-map-form-field-component :selectField="true" :selectElements="$branches"
                        :latitude="$start_lat" :longitude="$start_long" />



                    <div class="flex items-center justify-end gap-x-6  px-4 py-2 sm:px-8">
                        {{-- @dump($start_lat, $start_long, $address, $coordSelect) --}}

                        <button wire:click="save('save')"
                            class="rounded-md bg-indigo-600 px-3 py-2 font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 text-sm focus-visible:outline-indigo-600">Crear</button>

                        <button wire:click="save('save-new')"
                            class="rounded-md bg-indigo-600 px-3 py-2 font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 text-sm focus-visible:outline-indigo-600">Crear
                            y crear otro</button>
                    </div>
                </div>


        </main>


    </div>


</div>
