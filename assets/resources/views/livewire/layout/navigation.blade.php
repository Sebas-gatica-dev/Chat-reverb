<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;
use Carbon\Carbon;

new class extends Component {
    /**
     * Log the current user out of the application.
     */

    public $routes = [];

    public function mount()
    {
        // Obtener la fecha actual usando Carbon
        $currentDate = Carbon::now();
        $currentYear = $currentDate->year;
        $currentMonth = $currentDate->month;
        $currentDay = $currentDate->day;

        
        $this->routes = [
            [
                'name' => 'Dashboard',
                'route' => route('panel.dashboard'),
                'active' => 'panel.dashboard',
                'gate' => 'dashboard-show',
            ],
            [
                'name' => 'Clientes',
                'route' => route('panel.customers.list'),
                'active' => 'panel.customers.*',
                'gate' => 'customer-list',
            ],
            [
                'name' => 'Potenciales',
                'route' => route('panel.leads.list'),
                'active' => 'panel.leads.*',
                'gate' => 'leads-show',
            ],
            [
                'name' => 'Pagos',
                'route' => '#',
                'active' => 'panel.payments.*',
                'gate' => true,
            ],
            [
                'name' => 'Mi agenda',
                'route' => '#',
                'active' => 'panel.agenda.*',
                'gate' => true,
            ],
            [
                'name' => 'Rutas Diarias',
                'route' => route('panel.routes.daily', ['year' => $currentYear, 'month' => $currentMonth, 'day' => $currentDay]),
                'active' => 'panel.routes.*',
                'gate' => true,
            ],
            [
                'name' => 'Stock',
                'route' => route('panel.stock.list'), // Este es el enlace correcto basado en tu archivo de rutas
                'active' => 'panel.stock.*', // Asegúrate de actualizar el valor de 'active' si es necesario
                'gate' => true,
            ],
        ];
    }

    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
}; ?>


<div x-data="{ open: false, openProfile: false }" class="sm:relative sticky top-0 z-50">
    <header class="bg-white">
        <nav class="
        mx-auto max-w-screen-2xl px-4 sm:px-6 lg:px-8 max-lg:py-3
        ">
            <div class="relative flex justify-between lg:gap-8 xl:grid xl:grid-cols-12">

                {{-- Logo --}}

                <div
                    class="relative z-10 px-2 lg:px-0
                flex md:absolute md:inset-y-0 md:left-0 lg:static xl:col-span-2
                ">
                    <div class="flex flex-shrink-0 items-center">
                        <a href="#">
                            <img class="h-10 w-auto" src="{{ asset('logo.png') }}" alt="{{ config('app.name') }}">
                        </a>
                    </div>
                </div>

                {{-- Search  y iconos de notificacion y perfil escritorio --}}


                {{-- <div
                    class="flex relative z-10
                min-w-0 flex-1 md:px-8 lg:px-0 xl:col-span-6
                ">


                    <div
                        class="hidden lg:flex lg:items-center lg:px-6 lg:py-4 lg:mx-0 lg:max-w-none xl:px-0">

                        <div class="w-full  ">
                            <label for="search" class="sr-only">Search</label>
                            <div class="relative">
                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                    <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor"
                                        aria-hidden="true">
                                        <path fill-rule="evenodd"
                                            d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <input id="search" name="search"
                                    class="block w-full rounded-md border-0 bg-white py-1.5 pl-10 pr-3 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-500 sm:text-sm sm:leading-6"
                                    placeholder="Search" type="search">
                            </div>
                        </div>

                    </div>

                </div> --}}

               
                <div class="min-w-0 flex-1 lg:px-0 xl:col-span-6 h-16 ">
                    @can('access-function', 'search-main')
                        <livewire:panel.search />
                    @endcan
                </div>
              
                {{-- Iconos de notificacion y perfil movil --}}

                <!-- Mobile menu button -->
                <div class="relative z-10 flex items-center lg:hidden md:absolute md:inset-y-0 md:right-0">

                    <button type="button"
                        class="relative inline-flex items-center justify-center rounded-md p-2 text-gray-800 hover:bg-gray-100 hover:text-gray-500  focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500"
                        aria-controls="mobile-menu" @click="open = !open" aria-expanded="false"
                        x-bind:aria-expanded="open.toString()">
                        <span class="absolute -inset-0.5"></span>
                        <span class="sr-only">Open main menu</span>
                        <svg x-description="Icon when menu is closed." x-state:on="Menu open" x-state:off="Menu closed"
                            class="h-6 w-6 block" :class="{ 'hidden': open, 'block': !(open) }" fill="none"
                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"></path>
                        </svg>
                        <svg x-description="Icon when menu is open." x-state:on="Menu open" x-state:off="Menu closed"
                            class="h-6 w-6 hidden" :class="{ 'block': open, 'hidden': !(open) }" fill="none"
                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>


                {{-- Iconos de notificacion y perfil escritorio --}}

                <div class="hidden lg:flex lg:items-center lg:justify-end xl:col-span-4">


                    <span class="relative inline-block text-gray-400">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                            aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
                        </svg> <span
                            class="absolute top-0 right-0 inline-flex items-center justify-center px-1.5 py-0.5 text-[11px] font-bold leading-none text-red-100 transform translate-x-1/2 -translate-y-1/2 bg-red-700/95 rounded-full">4</span>
                    </span>



                    <button type="button"
                        class="relative ml-3 flex-shrink-0 rounded-full p-1 text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                        <span class="absolute -inset-1.5"></span>
                        <span class="sr-only">Log de actividad</span>

                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M10.34 15.84c-.688-.06-1.386-.09-2.09-.09H7.5a4.5 4.5 0 1 1 0-9h.75c.704 0 1.402-.03 2.09-.09m0 9.18c.253.962.584 1.892.985 2.783.247.55.06 1.21-.463 1.511l-.657.38c-.551.318-1.26.117-1.527-.461a20.845 20.845 0 0 1-1.44-4.282m3.102.069a18.03 18.03 0 0 1-.59-4.59c0-1.586.205-3.124.59-4.59m0 9.18a23.848 23.848 0 0 1 8.835 2.535M10.34 6.66a23.847 23.847 0 0 0 8.835-2.535m0 0A23.74 23.74 0 0 0 18.795 3m.38 1.125a23.91 23.91 0 0 1 1.014 5.395m-1.014 8.855c-.118.38-.245.754-.38 1.125m.38-1.125a23.91 23.91 0 0 0 1.014-5.395m0-3.46c.495.413.811 1.035.811 1.73 0 .695-.316 1.317-.811 1.73m0-3.46a24.347 24.347 0 0 1 0 3.46" />
                        </svg>


                    </button>

                    <!-- Profile dropdown -->
                    <div class="relative ml-5 flex-shrink-0" x-data="{ open: false }">
                        <div>
                            <button type="button"
                                class="relative flex rounded-full bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                                id="user-menu-button" aria-expanded="false" aria-haspopup="true" @click="open = !open"
                                :aria-expanded="open.toString()">
                                <span class="absolute -inset-1.5"></span>
                                <span class="sr-only">Open user menu</span>
                                <img class="h-8 w-8 rounded-full"
                                    src="https://images.unsplash.com/photo-1550525811-e5869dd03032?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                                    alt="">
                            </button>
                        </div>


                        <div class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                            role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1"
                            x-show="open" @click.away="open = false"
                            x-transition:enter="transition ease-out duration-100"
                            x-transition:enter-start="transform opacity-0 scale-95"
                            x-transition:enter-end="transform opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-75"
                            x-transition:leave-start="transform opacity-100 scale-100"
                            x-transition:leave-end="transform opacity-0 scale-95" x-cloak>
                            <!-- Active: "bg-gray-100", Not Active: "" -->
                            @can('access-function', 'settings-my-account')
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem"
                                    tabindex="-1" id="user-menu-item-0">Mi perfil</a>
                            @endcan
                            @can('access-function', 'trash-show')
                                <a wire:navigate href="{{ route('panel.trash') }}"
                                    class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1"
                                    id="user-menu-item-1">Papelera</a>
                            @endcan        
                            @can('access-function', 'settings-show-option')
                                <a wire:navigate href="{{ route('panel.settings.general.business') }}"
                                    class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1"
                                id="user-menu-item-1">Configuración</a>
                            @endcan
                            <button wire:click="logout" class="block px-4 py-2 text-sm text-gray-700" role="menuitem"
                                tabindex="-1" id="user-menu-item-2">Cerrar sesión</button>
                        </div>
                    </div>

                </div>




            </div>
        </nav>
    </header>



    {{-- MENU PARA ESCRITORIOS --}}

    <header class="bg-gray-800 z-10">

        <nav class="mx-auto max-w-screen-2xl px-8">
            <div class="lg:block hidden">
                <div class="relative flex h-16 items-center justify-between">
                    <div class="flex items-center px-2 lg:px-0">
                        <div class="flex-shrink-0">

                        </div>
                        <div class="hidden lg:block">
                            <div class="flex space-x-4"">
                                <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                                @foreach ($routes as $route)
                                    @if (Gate::allows('access-function', $route['gate']))
                                        <a wire:navigate href="{{ $route['route'] }}"
                                            class="{{ request()->routeIs($route['active']) ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} rounded-md px-3 py-2 text-sm font-medium">{{ $route['name'] }}</a>
                                    @endif
                                @endforeach



                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </nav>
    </header>

    {{-- MENU PARA MOVILES --}}
    <!-- Mobile menu, show/hide based on menu state. -->
    <nav class="lg:hidden bg-gray-800 " aria-label="Global" x-show="open" @click.away="open = false"
        x-transition:enter="transition duration-200 ease-out" x-transition:enter-start="transform opacity-0 scale-95"
        x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition duration-100 ease-in"
        x-transition:leave-start="transform opacity-100 scale-100"
        x-transition:leave-end="transform opacity-0 scale-95" x-cloak>
        <div class="space-y-1 px-2 pb-3 pt-2">
            <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
            @foreach ($routes as $route)
                @if (Gate::allows('access-function', $route['gate']))
                    <a wire:navigate href="{{ $route['route'] }}"
                        class="{{ request()->routeIs($route['active']) ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} block rounded-md px-3 py-2 text-base font-medium">{{ $route['name'] }}</a>
                @endif
            @endforeach




            <div class="border-t border-gray-700 pb-3 pt-4">


                <div class="flex items-center justify-between" @click="openProfile = !openProfile">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <img class="h-10 w-10 rounded-full"
                                src="{{ auth()->user()->photo ? auth()->user()->photo : asset('user.webp') }}"
                                alt="{{ auth()->user()->name }}">
                        </div>
                        <div class="ml-3">
                            <div class="text-base font-medium leading-none text-white">{{ auth()->user()->name }}
                            </div>
                            <div class="text-sm font-medium leading-none text-gray-400">{{ auth()->user()->email }}
                            </div>
                        </div>
                    </div>
                    <div class="flex-shrink-0 ml-3">




                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="h-6 w-6 text-gray-500"
                            :class="openProfile ? 'hidden' : ''">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                        </svg>

                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="h-6 w-6 text-gray-500"
                            :class="openProfile ? '' : 'hidden'">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5" />
                        </svg>




                    </div>
                </div>
                <div class="mt-3 space-y-1 border-t border-gray-700" x-show="openProfile"
                    @click.away="openProfile = false">

                    @can('access-function', 'settings-my-account')
                    <a wire:navigate href="#"
                        class=" text-gray-300 hover:bg-gray-700 block hover:text-white rounded-md px-3 py-2 text-base font-medium">
                        Mi perfil
                    </a>
                    @endcan
                    @can('access-function','trash-show')
                    <a href="{{ route('panel.trash') }}" wire:navigate
                        class=" text-gray-300 hover:bg-gray-700 block hover:text-white rounded-md px-3 py-2 text-base font-medium">Papelera</a>
                    @endcan
                    @can('access-function','settings-show-option')
                    <a href="{{ route('panel.settings.general.business') }}" wire:navigate
                        class=" text-gray-300 hover:bg-gray-700 block hover:text-white rounded-md px-3 py-2 text-base font-medium">Configuración</a>
                    @endcan
                  
                    <a wire:click="logout"
                        class=" text-gray-300 hover:bg-gray-700 block hover:text-white rounded-md px-3 py-2 text-base font-medium">Cerrar
                        sesión</a>
                      
                </div>
            </div>
        </div>

    </nav>


    {{-- BUSCADOR PARA MOVILES --}}

    <header class="bg-gray-100 block lg:hidden">

        <div class="w-full p-2">
            <div class="relative text-gray-600">
                <input
                    class="bg-white text-gray-600 border-gray-300 h-10 px-5 pr-10 w-full rounded-md text-sm focus:outline-none focus:ring-transparent focus:bg-white focus:border-slate-400 relative appearance-none"
                    type="search" placeholder="Buscar..." autocomplete="false" />

                <button class="absolute right-0 top-0 mt-3 mr-4">
                    <svg class="h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px"
                        viewBox="0 0 56.966 56.966" style="enable-background:new 0 0 56.966 56.966;"
                        xml:space="preserve" width="512px" height="512px">
                        <path
                            d="M55.146,51.887L41.588,37.786c3.486-4.144,5.396-9.358,5.396-14.786c0-12.682-10.318-23-23-23s-23,10.318-23,23  s10.318,23,23,23c4.761,0,9.298-1.436,13.177-4.162l13.661,14.208c0.571,0.593,1.339,0.92,2.162,0.92  c0.779,0,1.518-0.297,2.079-0.837C56.255,54.982,56.293,53.08,55.146,51.887z M23.984,6c9.374,0,17,7.626,17,17s-7.626,17-17,17  s-17-7.626-17-17S14.61,6,23.984,6z" />
                    </svg>

                </button>

            </div>
        </div>

    </header>


</div>
