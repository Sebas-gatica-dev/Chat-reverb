<div class="sticky top-6 max-w-md ">
    <div class="absolute top-0 left-0 w-full h-px px-4 flex items-center">
        <div class="h-full w-full bg-gradient-to-r from-transparent via-slate-100 to-slate-200"></div>
        <div class="h-full w-full bg-gradient-to-r from-slate-200 via-slate-100 to-transparent"></div>
    </div>
    <div class="absolute bottom-0 left-0 w-full h-px px-4 flex items-center">
        <div class="h-full w-full bg-gradient-to-r from-transparent via-slate-100 to-slate-200"></div>
        <div class="h-full w-full bg-gradient-to-r from-slate-200 via-slate-100 to-transparent"></div>
    </div>
    <div
        class="w-full h-full bg-gradient-to-br from-indigo-300 via-indigo-700 to-indigo-300 inset-0 rounded-[10px] shadow-sm scale-[1.014] z-10 absolute">
    </div>
    <div class="relative z-20 px-10 py-5 bg-white shadow-lg rounded-lg">
        <div class="text-left mt-4 flex items-center justify-start">
            <img class="rounded-full border-4 border-slate-200 h-24 w-24" src="{{ $user->photo }}" alt="Profile image">
            <div class="flex flex-col ml-4">
                <h2 class="text-xl font-semibold mt-2">{{ $user->name }}</h2>
                <p class="text-slate-600">
                    @foreach ($user->roles as $role)
                        {{ $role->name }}{{ !$loop->last ? ' - ' : '' }}
                    @endforeach
                </p>
            </div>
        </div>
        {{-- <div class="mt-5">
            <p class="text-slate-500 text-left">Hey! I'm Nicholas — UI/UX Designer from Palo Alto. Our products are carefully curated.</p>
        </div> --}}
        <div class="mt-5 p-1.5 text-slate-500">
            <div class="flex flex-col lg:flex-row items-center space-y-5 lg:space-x-10 lg:space-y-0 mb-4">
                <div class="flex items-center">
                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M11.54 22.351l.07.04.028.016a.76.76 0 00.723 0l.028-.015.071-.041a16.975 16.975 0 001.144-.742 19.58 19.58 0 002.683-2.282c1.944-1.99 3.963-4.98 3.963-8.827a8.25 8.25 0 00-16.5 0c0 3.846 2.02 6.837 3.963 8.827a19.58 19.58 0 002.682 2.282 16.975 16.975 0 001.145.742zM12 13.5a3 3 0 100-6 3 3 0 000 6z"
                            clip-rule="evenodd" />
                    </svg>

                    <span class="ml-2">{{ $user->address ?? 'nowhere' }}</span>
                </div>
   
            </div>

            <div class="flex flex-col lg:flex-row items-center space-y-5 lg:space-x-10 lg:space-y-0">

                <div class="flex items-center">
                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                        <path
                            d="M1.5 8.67v8.58a3 3 0 003 3h15a3 3 0 003-3V8.67l-8.928 5.493a3 3 0 01-3.144 0L1.5 8.67z" />
                        <path
                            d="M22.5 6.908V6.75a3 3 0 00-3-3h-15a3 3 0 00-3 3v.158l9.714 5.978a1.5 1.5 0 001.572 0L22.5 6.908z" />
                    </svg>
                    <span class="ml-2">{{ $user->email }}</span>
                </div>
            </div>
        </div>

        <div class=" py-5 space-y-3 space-x-1">

            @foreach ($user->branches as $branch)
                <span
                    class="inline-block bg-indigo-100 rounded-md px-2.5 py-1 text-xs font-semibold text-indigo-800">{{ $branch->name }}</span>
            @endforeach

            @foreach ($user->provinces as $province)
                <span
                    class="inline-block bg-orange-100 rounded-md px-2.5 py-1 text-xs font-semibold text-orange-800">{{ $province->province->name }}
                    (23 ciudades)</span>
            @endforeach

        </div>
        {{-- COMIENZO DE PHONES  --}}



        <div class="mt-6 border-t border-gray-900/5 pb-0">
            <div class="my-4 flex w-full flex-none gap-x-3 pl-6 items-center">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                    class="h-4 w-4 text-indigo-600">
                    <path fill-rule="evenodd"
                        d="M1.5 4.5a3 3 0 0 1 3-3h1.372c.86 0 1.61.586 1.819 1.42l1.105 4.423a1.875 1.875 0 0 1-.694 1.955l-1.293.97c-.135.101-.164.249-.126.352a11.285 11.285 0 0 0 6.697 6.697c.103.038.25.009.352-.126l.97-1.293a1.875 1.875 0 0 1 1.955-.694l4.423 1.105c.834.209 1.42.959 1.42 1.82V19.5a3 3 0 0 1-3 3h-2.25C8.552 22.5 1.5 15.448 1.5 6.75V4.5Z"
                        clip-rule="evenodd" />
                </svg>
                <dd class="text-base font-medium leading-6 text-gray-600">

                    Teléfonos</dd>
                <span
                    class="inline-flex items-center gap-x-1.5 rounded-md px-2 py-1 text-xs font-medium bg-indigo-50 text-indigo-700 ring-1 ring-inset ring-indigo-700/10"
                    wire:click="addPhone()">



                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                        class="h-4 w-4 text-indigo-700">
                        <path fill-rule="evenodd"
                            d="M12 3.75a.75.75 0 0 1 .75.75v6.75h6.75a.75.75 0 0 1 0 1.5h-6.75v6.75a.75.75 0 0 1-1.5 0v-6.75H4.5a.75.75 0 0 1 0-1.5h6.75V4.5a.75.75 0 0 1 .75-.75Z"
                            clip-rule="evenodd" />
                    </svg>


                    <span>Agregar</span>
                </span>

            </div>

            <div class="space-y-2 px-4" x-data="{ phoneForm: false }" wire:sortable="orderPhone">

                @forelse ($phones as $phone)
                    <div class="py-3 flex w-full justify-between px-3 bg-gray-50 rounded-md"
                        wire:key="{{ $phone['id'] }}" wire:sortable.item="{{ $phone['id'] }}">

                        <div class="flex items-center gap-x-2 cursor-move" wire:sortable.handle>
                            <dd class="text-sm font-medium leading-6 text-gray-600 cursor-default">
                                {{ $phone['number'] }}</dd>
                            <dd
                                class="inline-flex items-center gap-x-1.5 rounded-md px-2 py-1 text-xs font-medium text-gray-900 ring-1 ring-inset ring-gray-200">
                                <svg class="h-1.5 w-1.5 fill-red-500" viewBox="0 0 6 6" aria-hidden="true">
                                    <circle cx="3" cy="3" r="3" />
                                </svg>
                                <span>{{ $phone['tag'] }}</span>
                            </dd>

                            <dd
                                class="inline-flex items-center gap-x-1.5 rounded-md px-2 py-1 text-xs font-medium text-gray-900 ring-1 ring-inset ring-gray-200">
                                <svg class="h-1.5 w-1.5 fill-yellow-500" viewBox="0 0 6 6" aria-hidden="true">
                                    <circle cx="3" cy="3" r="3" />
                                </svg>
                                <span>{{ $phone['phoneable_type'] == 'App\Models\Customer' ? 'Cliente' : 'Propiedad' }}
                                </span>
                            </dd>

                            @if ($phone['type'] == '0')
                                <a href="#">
                                    <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 50 50"
                                        class="h-4 w-4 fill-green-600">
                                        <path
                                            d="M25,2C12.318,2,2,12.318,2,25c0,3.96,1.023,7.854,2.963,11.29L2.037,46.73c-0.096,0.343-0.003,0.711,0.245,0.966 C2.473,47.893,2.733,48,3,48c0.08,0,0.161-0.01,0.24-0.029l10.896-2.699C17.463,47.058,21.21,48,25,48c12.682,0,23-10.318,23-23 S37.682,2,25,2z M36.57,33.116c-0.492,1.362-2.852,2.605-3.986,2.772c-1.018,0.149-2.306,0.213-3.72-0.231 c-0.857-0.27-1.957-0.628-3.366-1.229c-5.923-2.526-9.791-8.415-10.087-8.804C15.116,25.235,13,22.463,13,19.594 s1.525-4.28,2.067-4.864c0.542-0.584,1.181-0.73,1.575-0.73s0.787,0.005,1.132,0.021c0.363,0.018,0.85-0.137,1.329,1.001 c0.492,1.168,1.673,4.037,1.819,4.33c0.148,0.292,0.246,0.633,0.05,1.022c-0.196,0.389-0.294,0.632-0.59,0.973 s-0.62,0.76-0.886,1.022c-0.296,0.291-0.603,0.606-0.259,1.19c0.344,0.584,1.529,2.493,3.285,4.039 c2.255,1.986,4.158,2.602,4.748,2.894c0.59,0.292,0.935,0.243,1.279-0.146c0.344-0.39,1.476-1.703,1.869-2.286 s0.787-0.487,1.329-0.292c0.542,0.194,3.445,1.604,4.035,1.896c0.59,0.292,0.984,0.438,1.132,0.681 C37.062,30.587,37.062,31.755,36.57,33.116z">
                                        </path>
                                    </svg>
                                </a>
                            @endif
                        </div>

                        <div class="relative" x-data="{ open: false }">
                            <dd class="text-sm font-bold leading-6 text-gray-600 flex items-center cursor-pointer"
                                @click="open = !open">
                                <svg class="h-6 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 6.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 12.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 18.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5Z" />
                                </svg>

                            </dd>
                            <div class="absolute left-0 z-10 mt-2 w-32 origin-top-right top-6 rounded-md bg-white py-2 shadow-lg ring-1 ring-black/5 focus:outline-none font-bold select-none"
                                role="menu" aria-orientation="vertical" aria-labelledby="options-menu-0-button"
                                tabindex="-1" @click.away="open = false" x-show="open" x-cloak
                                x-transition:enter="transition ease-out duration-100"
                                x-transition:enter-start="transform opacity-0 scale-95"
                                x-transition:enter-end="transform opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-75"
                                x-transition:leave-start="transform opacity-100 scale-100"
                                x-transition:leave-end="transform opacity-0 scale-95">
                                <a wire:click="editPhone('{{ $phone['id'] }}')"
                                    class="block px-3 py-1 text-sm leading-6 text-gray-900">Editar</a>

                                <a wire:click="deletePhone('{{ $phone['id'] }}')"
                                    wire:confirm="¿Estás seguro de que deseas eliminar este teléfono?"
                                    class="block px-3 py-1 text-sm leading-6 text-gray-900">Eliminar</a>
                            </div>
                        </div>

                    </div>
                @empty
                    <div class="rounded-md bg-yellow-50 p-4 mb-6">
                        <div class="text-sm font-medium text-yellow-700 text-center">
                            <p>Todavía no se han registrado teléfonos para este usuario.</p>
                        </div>
                    </div>
                @endforelse

                {{-- COMIENZO DE MODAL PHONE --}}

                <div class="relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true"
                    x-show="phoneForm" x-transition:enter="ease-out duration-300"
                    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                    x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0" x-on:keydown.escape.window="phoneForm = false"
                    x-on:open-phone-form.window="phoneForm = true" x-on:close-phone-form.window="phoneForm = false"
                    wire:keydown.enter="savePhone" x-cloak>

                    {{-- wire:keydown.enter="openEdit" --}}

                    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true">
                    </div>

                    <div class="fixed inset-0 z-20 w-screen overflow-y-auto">
                        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">

                            <div class="relative transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg sm:p-6"
                                x-on:click.away="phoneForm = false">


                                <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                                    <h3 class="text-base font-semibold leading-6 text-gray-900 mb-4" id="modal-title">
                                        {{ $phoneForm ? 'Editar teléfono' : 'Agregar teléfono' }}
                                    </h3>

                                    <div class="col-span-full mt-4">
                                        <label for="phoneNumberForm"
                                            class="text-sm font-medium leading-6 text-gray-900">Número</label>
                                        <div class="mt-2">
                                            <input type="text" wire:model="phoneNumberForm" autocomplete="off"
                                                placeholder="Escriba un nombre para el tipo de propiedad"
                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 text-sm sm:leading-6">
                                        </div>
                                        @error('phoneNumberForm')
                                            <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-span-full mt-4">
                                        <label for="phoneTagForm"
                                            class="text-sm font-medium leading-6 text-gray-900">Etiqueta</label>
                                        <div class="mt-2">
                                            <input type="text" wire:model="phoneTagForm" autocomplete="off"
                                                placeholder="Escriba un nombre para el tipo de propiedad"
                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 text-sm sm:leading-6">
                                        </div>
                                        @error('phoneTagForm')
                                            <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                        @enderror
                                    </div>


                                    <div class="col-span-full mt-4">
                                        <label for="phoneModelForm"
                                            class="text-sm font-medium leading-6 text-gray-900">Vincular
                                            con</label>
                                        <div class="mt-2">
                                            <select id="phoneModelForm" wire:model="phoneModelForm"
                                                autocomplete="phoneModelForm"
                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                                <option value="">Seleccione una opción</option>
                                                <option value="customer">Cliente</option>
                                                <option value="property">Propiedad</option>
                                            </select>
                                        </div>
                                        @error('phoneModelForm')
                                            <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                        @enderror
                                    </div>


                                    <div class="col-span-full mt-4 flex items-center">
                                        <fieldset>
                                            <label for="phoneTypeForm"
                                                class="text-sm font-medium leading-6 text-gray-900">Tipo
                                                de teléfono</label>
                                            {{-- <p class="mt-1 text-sm leading-6 text-gray-600">These are delivered via SMS to your mobile phone.</p> --}}
                                            <div class="mt-2 space-y-1">
                                                <div class="flex items-center gap-x-3">
                                                    <input id="phoneTypeForm" wire:model="phoneTypeForm"
                                                        type="radio" value="0"
                                                        class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600">
                                                    <label for="phoneTypeForm"
                                                        class="block text-sm font-medium leading-6 text-gray-900">Celular</label>
                                                </div>
                                                <div class="flex items-center gap-x-3">
                                                    <input id="phoneTypeForm" wire:model="phoneTypeForm"
                                                        type="radio" value="1"
                                                        class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600">
                                                    <label for="phoneTypeForm"
                                                        class="block text-sm font-medium leading-6 text-gray-900">Teléfono</label>
                                                </div>

                                            </div>

                                            @error('phoneTypeForm')
                                                <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                            @enderror
                                        </fieldset>
                                    </div>


                                </div>

                                <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
                                    <button type="button" wire:click="savePhone"
                                        class="inline-flex w-full justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 sm:ml-3 sm:w-auto">Guardar</button>
                                    <button type="button"
                                        class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto"
                                        x-on:click="phoneForm = false">Volver</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                {{-- FINAL DEL MODAL PHONE --}}


            </div>



        </div>



        {{-- FIN DE PHONES --}}
        <div class="flex justify-stretch space-x-4 pb-4 w-full">
   
            <button wire:navigate href="{{ route('panel.settings.users.edit', $user) }}"
                class="bg-slate-200/70 hover:bg-slate-200 text-slate-800 w-full font-semibold py-2 px-4 rounded-md">
                Editar Perfil
            </button>
        </div>
    </div>
</div>
