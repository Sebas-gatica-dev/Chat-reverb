<main class="max-w-screen-2xl  mx-auto py-6 sm:px-6 lg:px-8"  x-data="{ phoneForm: false }">

    <div class="grid grid-cols-12 gap-2">
        <div class="col-span-full lg:col-span-4 p-2 lg:p-6">
            <div class="w-full sticky top-12 ">

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
                
                            <div class="space-y-2 px-4 mb-6" wire:sortable="orderPhone">
                
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
                


            </div>


        </div>
        <div class="col-span-full lg:col-span-8 p-4 lg:pt-6">
            {{-- @dump($productsWithUnitsWithUnits) --}}




                {{-- Escritorio --}}
                <nav class="hidden relative sm:flex divide-x divide-gray-200 sm:rounded-t-lg shadow" aria-label="Tabs">
                    <!-- Current: "text-gray-900", Default: "text-gray-500 hover:text-gray-700" -->


                    <button wire:click="changeSection(1)"
                        class="
                        {{ $currentSection == 1 ? 'text-gray-900' : 'text-gray-500 hover:text-gray-700' }}
                          group relative min-w-0 flex-1 overflow-hidden bg-white py-4 px-4 text-center text-sm font-medium hover:bg-gray-50 focus:z-10 rounded-tl-lg">
                        <span>Visitas</span>
                        <span aria-hidden="true"
                            class="
                            {{ $currentSection == 1 ? 'bg-indigo-500' : 'bg-transparent' }}
                               absolute inset-x-0 bottom-0 h-0.5"></span>
                    </button>

                    <button wire:click="changeSection(2)"
                        class="
                        {{ $currentSection == 2 ? 'text-gray-900' : 'text-gray-500 hover:text-gray-700' }}
                          group relative min-w-0 flex-1 overflow-hidden bg-white py-4 px-4 text-center text-sm font-medium hover:bg-gray-50 focus:z-10">
                        <span>Archivos</span>
                        <span aria-hidden="true"
                            class="
                            {{ $currentSection == 2 ? 'bg-indigo-500' : 'bg-transparent' }}
                               absolute inset-x-0 bottom-0 h-0.5"></span>
                    </button>

                    <button wire:click="changeSection(3)"
                        class="
                    {{ $currentSection == 3 ? 'text-gray-900' : 'text-gray-500 hover:text-gray-700' }}
                      group relative min-w-0 flex-1 overflow-hidden bg-white py-4 px-4 text-center text-sm font-medium hover:bg-gray-50 focus:z-10">
                        <span>Inventario</span>
                        <span aria-hidden="true"
                            class="
                        {{ $currentSection == 3 ? 'bg-indigo-500' : 'bg-transparent' }}
                           absolute inset-x-0 bottom-0 h-0.5"></span>
                    </button>
                    <a href="#"
                        class="text-gray-500 hover:text-gray-700 rounded-tr-lg relative min-w-0 flex-1 overflow-hidden bg-white py-4 px-4 text-center text-sm font-medium hover:bg-gray-50 focus:z-10">
                        <span>Actividad</span>
                        <span aria-hidden="true" class="bg-transparent absolute inset-x-0 bottom-0 h-0.5"></span>
                    </a>
                </nav>

                <aside class="flex md:hidden overflow-x-auto border-b border-gray-900/5 py-4">
                    <nav class="flex-none px-4 sm:px-6 lg:px-0">
                        <ul role="list" class="flex gap-x-3 gap-y-1 whitespace-nowrap lg:flex-col">
                            <li>
                                <!-- Current: "bg-gray-50 text-indigo-600", Default: "text-gray-700 hover:text-indigo-600 hover:bg-gray-50" -->
                                <a href="" wire:navigate
                                    class="group flex gap-x-3 rounded-md py-2 pl-2 pr-3 text-sm producting-6 font-semibold bg-gray-50 text-indigo-600 hover:text-indigo-600 hover:bg-gray-50">Visitas
                                </a>
                            </li>
                            <li>
                                <!-- Current: "bg-gray-50 text-indigo-600", Default: "text-gray-700 hover:text-indigo-600 hover:bg-gray-50" -->
                                <a href="" wire:navigate
                                    class="group flex gap-x-3 rounded-md py-2 pl-2 pr-3 text-sm producting-6 font-semibold text-gray-700 hover:text-indigo-600 hover:bg-gray-50">Documentos
                                </a>
                            </li>
                            <li>
                                <!-- Current: "bg-gray-50 text-indigo-600", Default: "text-gray-700 hover:text-indigo-600 hover:bg-gray-50" -->
                                <a href="" wire:navigate
                                    class="group flex gap-x-3 rounded-md py-2 pl-2 pr-3 text-sm producting-6 font-semibold text-gray-700 hover:text-indigo-600 hover:bg-gray-50">Agenda
                                </a>
                            </li>
                            <li>
                                <!-- Current: "bg-gray-50 text-indigo-600", Default: "text-gray-700 hover:text-indigo-600 hover:bg-gray-50" -->
                                <a href="" wire:navigate
                                    class="group flex gap-x-3 rounded-md py-2 pl-2 pr-3 text-sm producting-6 font-semibold text-gray-700 hover:text-indigo-600 hover:bg-gray-50">Actividad
                                </a>
                            </li>

                        </ul>
                    </nav>
                </aside>


                {{-- @switch($currentSection) --}}
                @switch($currentSection)
                    @case(1)
                        <div class="space-y-8" wire:loading.class="hidden" wire:target="changeSection">

                            @forelse ($visits as $visit)
                                <livewire:panel.property.visit.list-visit :visit="$visit" :first="$loop->first"
                                    :wire:key="$visit->id" />

                            @empty
                                <div class="bg-white shadow-sm ring-1 ring-gray-900/5 -mx-4 sm:mx-0 py-4 px-6 rounded-b-lg">
                                    <div class="rounded-md bg-yellow-50 p-4">
                                        <div class="text-sm font-medium text-yellow-700 text-center">
                                            <p>Todavía no se han registrado visitas para esta propiedad.</p>
                                        </div>
                                    </div>
                                </div>
                            @endforelse




                            @if ($visits->hasMorePages())
                                <div class="mt-6 text-center">
                                    <button wire:click="loadMore" type="button"
                                        class="rounded bg-white px-2 py-1 text-xs font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">Cargar
                                        más</button>
                                </div>
                            @endif

                        </div>
                    @break

                    @case(2)
                        <div wire:loading.class="hidden">
                            <livewire:panel.users.files.list-files :user="$user" />
                        </div>


                        {{-- <div class="bg-white shadow-sm ring-1 ring-gray-900/5 -mx-4 sm:mx-0 py-4 px-6 rounded-b-lg" wire:loading.class="hidden" wire:target="changeSection">
                            <div class="rounded-md bg-yellow-50 p-4">
                                <div class="text-sm font-medium text-yellow-700 text-center">
                                    <p>Todavía no se han registrado archivos para esta propiedad.</p>
                                </div>
                            </div>
                        </div>  --}}
                    @break

                    @case(3)
                        {{-- @dd($productsWithUnitsWithUnits[0]->name) --}}

                        <table
                            class="min-w-full divide-y divide-gray-300 bg-white ring-1 ring-black ring-opacity-5 md:rounded-b-lg md:shadow">
                            <thead>
                                <tr>
                                    <th scope="col" class="w-8 py-3.5 pl-4 pr-3 sm:pl-6">
                                        <!-- Espacio para el botón -->
                                    </th>
                                    <th scope="col"
                                        class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                                        Nombre
                                    </th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                        Cantidad
                                    </th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                        Tipo
                                    </th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                        Costo
                                    </th>

                                    <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                        <span class="sr-only">Editar</span>

                                    </th>
                                </tr>
                            </thead>


                            @if ($productsWithUnits->count() > 0)
                                @foreach ($productsWithUnits as $product)
                                    <tbody class="divide-y divide-gray-200" x-data="{ open: false }"
                                        wire:key="{{ $product->id }}">

                                        <tr wire:key="{{ $product->id }}">

                                            <td class="py-3 pl-4 pr-3 text-sm sm:pl-6">
                                                <button @click="open = !open"
                                                    class="text-gray-500 hover:text-gray-700 focus:outline-none">
                                                    <svg :class="{ 'rotate-180': open }"
                                                        class="w-5 h-5 transform transition-transform duration-200"
                                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                        stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M19 9l-7 7-7-7" />
                                                    </svg>
                                                </button>
                                            </td>

                                            <!-- Fecha -->
                                            <td class="py-3 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">
                                                {{ $product->name }}
                                            </td>
                                            <!-- Hora -->
                                            <td class="px-3 py-3 text-sm text-gray-500">
                                                {{ $product->units->count() }}
                                            </td>
                                            <!-- Nombre -->
                                            <td class="px-3 py-3 text-sm text-gray-500">
                                                {{ $product->type }}
                                            </td>

                                            <td class="px-3 py-3 text-sm text-gray-500">
                                                {{ $product->cost }}
                                            </td>

                                            <!-- Editar -->
                                            <td
                                                class="relative whitespace-nowrap py-3 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">


                                            </td>
                                        </tr>

                                        <!-- Información adicional del product -->
                                        <tr x-show="open" wire:key="{{ $product->id }}"
                                            x-transition:enter="transition ease-out duration-800"
                                            x-transition:enter-start="opacity-0 transform scale-95"
                                            x-transition:enter-end="opacity-100 transform scale-100" x-cloak>

                                            <td colspan="11" class="bg-gray-50 border-t border-t-gray-200 rounded-b-lg">
                                                <div class="p-4">
                                                    <!-- Tabla de actividades -->
                                                    <div class="overflow-x-auto my-1 rounded-md shadow-sm">
                                                        <table
                                                            class="min-w-full divide-y divide-gray-200
                                        bg-white ring-1 ring-gray-100 border border-gray-200 md:rounded-lg md:shadow
                                        
                                        ">
                                                            <thead>
                                                                <tr>
                                                                    <th
                                                                        class="px-4 py-2 text-left text-sm font-semibold text-gray-900">
                                                                        Tag
                                                                    </th>
                                                                    <th
                                                                        class="px-4 py-2 text-left text-sm font-semibold text-gray-900">
                                                                        Fecha de ingreso
                                                                    </th>
                                                                    <th
                                                                        class="px-4 py-2 text-left text-sm font-semibold text-gray-900">
                                                                        Fecha vencimiento
                                                                    </th>
                                                                    <th
                                                                        class="px-4 py-2 text-left text-sm font-semibold text-gray-900">
                                                                        Status
                                                                    </th>
                                                                    <th
                                                                        class="px-4 py-2 text-left text-sm font-semibold text-gray-900">
                                                                        Paraderota
                                                                    </th>
                                                                    <th
                                                                        class="px-4 py-2 text-left text-sm font-semibold text-gray-900">
                                                                        Acciones
                                                                    </th>
                                                                </tr>
                                                            </thead>
                                                            <tbody class="divide-y divide-gray-200">
                                                                {{-- @dd($product->units) --}}

                                                                @forelse ($product->units as $unit)
                                                                    <tr wire:navigate
                                                                        href="{{ route('panel.stock.inventory-show', [$product, $unit->id]) }}">
                                                                        <td class="px-4 py-2 text-sm text-gray-500">
                                                                            <div class="flex items-center">
                                                                                <span>
                                                                                    {{ $unit->tag ?? 'no definido' }}
                                                                                </span>


                                                                                <div x-data="{ copied: false }"
                                                                                    class="ml-2 relative">
                                                                                    <button
                                                                                        @click="navigator.clipboard.writeText('{{ $unit->tag }}'); copied = true; setTimeout(() => copied = false, 2000)"
                                                                                        class="text-gray-500 hover:text-gray-700 focus:outline-none">
                                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                                            class="h-5 w-5"
                                                                                            viewBox="0 0 20 20"
                                                                                            fill="currentColor">
                                                                                            <path
                                                                                                d="M8 3a1 1 0 011-1h2a1 1 0 110 2H9a1 1 0 01-1-1z" />
                                                                                            <path
                                                                                                d="M6 3a2 2 0 00-2 2v11a2 2 0 002 2h8a2 2 0 002-2V5a2 2 0 00-2-2 3 3 0 01-3 3H9a3 3 0 01-3-3z" />
                                                                                        </svg>
                                                                                    </button>
                                                                                    <span x-show="copied"
                                                                                        x-transition:enter="transition ease-out duration-300"
                                                                                        x-transition:enter-start="opacity-0 transform scale-90"
                                                                                        x-transition:enter-end="opacity-100 transform scale-100"
                                                                                        x-transition:leave="transition ease-in duration-300"
                                                                                        x-transition:leave-start="opacity-100 transform scale-100"
                                                                                        x-transition:leave-end="opacity-0 transform scale-90"
                                                                                        class="absolute left-4 -bottom-4 bg-black text-white text-xs px-2 py-1 rounded">
                                                                                        Copiado!
                                                                                    </span>
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                        <td class="px-4 py-2 text-sm text-gray-500">
                                                                            {{-- {{ \Carbon\Carbon::parse($unit->time)->format('H:i') }} --}}
                                                                            {{ $unit->entry_date ?? 'no definido' }}

                                                                        </td>
                                                                        <td class="px-4 py-2 text-sm text-gray-500">
                                                                            {{-- {{ $unit->user->name }}</td> --}}
                                                                            {{ $unit->expiration_date ?? 'no definido' }}
                                                                        <td class="px-4 py-2 text-sm text-gray-500">
                                                                            {{-- {{ $unit->comment }}</td> --}}
                                                                            {{ $product->cost ? '$' . $product->cost : 'no definido' }}
                                                                        <td class="px-4 py-2 text-sm text-gray-500">


                                                                            <span
                                                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full  {{ $unit->status->getBackgroundColor() }} {{ $unit->status->getTextColor() }} ring-1 ring-inset {{ $unit->status->getRingColor() }}">
                                                                                {{ $unit->status->getName() ?? 'no definido' }}
                                                                            </span>

                                                                            {{-- {{ $unit->type_contact->getName() }} --}}

                                                                        </td>
                                                                        <td class="px-4 py-2 text-sm text-gray-500">
                                                                            <a class="text-indigo-600 hover:text-indigo-900">
                                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                                    class="h-5 w-5" viewBox="0 0 20 20"
                                                                                    fill="currentColor">
                                                                                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                                                                    <path fill-rule="evenodd"
                                                                                        d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                                                                                        clip-rule="evenodd" />
                                                                                </svg>
                                                                            </a>
                                                                        </td>
                                                                    </tr>
                                                                @empty
                                                                    <tr>
                                                                        <td colspan="10" class="py-6 px-4 sm:px-8">
                                                                            <div class="rounded-md bg-yellow-50 p-4">
                                                                                <div
                                                                                    class="text-sm font-medium text-yellow-700 text-center">
                                                                                    <p>No se encontraron actividades.</p>
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                @endforelse
                                                            </tbody>
                                                        </table>
                                                    </div>

                                                </div>
                    </td>
                    {{-- <td colspan="1" class="bg-gray-50">
                        </td> --}}
                    </tr>
                    </tbody>
                    @endforeach

                    </tbody>
                @else
                    <tr>
                        <td colspan="10" class="py-6 px-4 sm:px-8">
                            <div class="rounded-md bg-yellow-50 p-4">
                                <div class="text-sm font-medium text-yellow-700 text-center">
                                    <p>No se encontraron unidades relacionadas.</p>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endif

                    </table>

                    @default
                @endswitch
                <div class="hidden bg-white shadow-sm ring-1 ring-gray-900/5 -mx-4 sm:mx-0 py-4 px-6 rounded-b-lg"
                    wire:loading.remove.class="hidden" wire:target="changeSection">
                    <div class="border border-purple-100 shadow-md rounded-md p-4 w-full mx-auto">
                        <div class="animate-pulse flex space-x-4">
                            <div class="rounded-full bg-purple-100 h-10 w-10"></div>
                            <div class="flex-1 space-y-6 py-1">
                                <div class="h-2 bg-purple-100 rounded"></div>
                                <div class="space-y-3">
                                    <div class="grid grid-cols-3 gap-4">
                                        <div class="h-2 bg-purple-100 rounded col-span-2"></div>
                                        <div class="h-2 bg-purple-100 rounded col-span-1"></div>
                                    </div>
                                    <div class="h-2 bg-purple-100 rounded"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



            </div>

        </div>

        </div>







          {{-- COMIENZO DE MODAL PHONE --}}
                
          <div class="relative z-50" aria-labelledby="modal-title" role="dialog" aria-modal="true"
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

    </main>
