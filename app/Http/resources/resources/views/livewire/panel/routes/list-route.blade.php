<div x-data="listRoutesData()" x-init="init()">


    <header class="bg-white shadow">
        <div class="mx-auto max-w-screen-2xl px-4 py-6 sm:px-6 lg:px-8">
            <div class="sm:flex sm:items-center sm:justify-between">
                <div class="min-w-0 flex-1">
                    <h1 class="text-2xl font-bold tracking-tight text-gray-900">Rutas</h1>
                </div>
                <div class="mt-4 flex md:ml-4 md:mt-0 justify-end gap-2">



                    <span class="isolate inline-flex rounded-md shadow-sm">


                        <button type="button" wire:click="previousDay"
                            class="relative inline-flex items-center rounded-l-md bg-white px-3 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-10">
                            <span class="sr-only">Previous</span>
                            <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>

                        <div x-data="{ date: '{{ $year }}-{{ str_pad($month, 2, '0', STR_PAD_LEFT) }}-{{ str_pad($day, 2, '0', STR_PAD_LEFT) }}' }">
                            <input type="date" x-model="date" @change="$wire.updateDate(date)"
                                class="border-y-gray-300 border-l-0 px-3 py-2 text-sm">
                        </div>


                        <button type="button" wire:click="nextDay"
                            class="relative -ml-px inline-flex items-center rounded-r-md bg-white px-3 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-10">
                            <span class="sr-only">Next</span>
                            <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>

                    </span>
                    <div class="hidden md:ml-4 md:flex md:items-center">
                        {{-- <div class="relative" x-data="{ open: false }">
                            <button type="button"
                                class="flex items-center gap-x-1.5 rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50"
                                id="menu-button" aria-expanded="false" aria-haspopup="true" @click="open = !open">
                                Vista diaria
                                <svg class="-mr-1 h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor"
                                    aria-hidden="true">
                                    <path fill-rule="evenodd"
                                        d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>


                            <div class="absolute right-0 z-10 mt-3 w-36 origin-top-right overflow-hidden rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                                role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1"
                                x-show="open" @click.away="open = false"
                                x-transition:enter="transition ease-out duration-100"
                                x-transition:enter-start="transform opacity-0 scale-95"
                                x-transition:enter-end="transform opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-75"
                                x-transition:leave-start="transform opacity-100 scale-100"
                                x-transition:leave-end="transform opacity-0 scale-95" x-cloak>

                                <div class="" role="none">
                                    <!-- Active: "bg-gray-100 text-gray-900", Not Active: "text-gray-700" -->
                                    <a wire:navigate
                                        href="{{ route('panel.routes.daily', ['year' => \Carbon\Carbon::now()->year, 'month' => \Carbon\Carbon::now()->month, 'day' => \Carbon\Carbon::now()->day]) }}"
                                        class="block px-4 py-2 text-sm bg-gray-100 text-gray-900" role="menuitem"
                                        tabindex="-1" id="menu-item-0">Vista diaria</a>
                                    <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem"
                                        tabindex="-1" id="menu-item-1">Vista semanal</a>
                                    <a wire:navigate
                                        href="{{ route('panel.routes.monthly', ['year' => \Carbon\Carbon::now()->year, 'month' => str_pad(\Carbon\Carbon::now()->month, 2, '0', STR_PAD_LEFT)]) }}"
                                        class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1"
                                        id="menu-item-2">Vista mensual</a>
                                    <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem"
                                        tabindex="-1" id="menu-item-3">Vista anual</a>
                                </div>
                            </div>
                        </div> --}}
                        <!-- Opciones de Vista -->
                        <div class="relative inline-block text-left">
                            <!-- Botón de menú -->
                            <div>
                                <button type="button" @click="open = !open"
                                    class="inline-flex w-full justify-center gap-x-1.5 rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50"
                                    id="menu-button" aria-expanded="true" aria-haspopup="true">
                                    Vista: <span x-text="view == 'list' ? 'Lista' : 'Tarjeta'"></span>
                                    <svg class="-mr-1 h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor"
                                        aria-hidden="true">
                                        <path fill-rule="evenodd"
                                            d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </div>
                            <!-- Menú desplegable -->
                            <div x-show="open" @click.away="open = false" x-cloak
                                x-transition:enter="transition ease-out duration-100"
                                x-transition:enter-start="transform opacity-0 scale-95"
                                x-transition:enter-end="transform opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-75"
                                x-transition:leave-start="transform opacity-100 scale-100"
                                x-transition:leave-end="transform opacity-0 scale-95"
                                class="absolute right-0 z-10 mt-2 w-36 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                                role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
                                <div class="py-1" role="none">
                                    <!-- Opción Vista Lista -->
                                    <a href="#" @click.prevent="view = 'list'; open = false;"
                                        :class="view == 'list' ? 'bg-gray-100 text-gray-900 outline-none' : 'text-gray-700'"
                                        class="block px-4 py-2 text-sm" role="menuitem" tabindex="-1">
                                        Vista Lista
                                    </a>
                                    <!-- Opción Vista Tarjeta -->
                                    <a href="#" @click.prevent="view = 'card'; open = false;"
                                        :class="view == 'card' ? 'bg-gray-100 text-gray-900 outline-none' : 'text-gray-700'"
                                        class="block px-4 py-2 text-sm" role="menuitem" tabindex="-1">
                                        Vista Tarjeta
                                    </a>
                                </div>
                            </div>
                        </div>


                    </div>

                    <div class="mt-4 flex md:mt-0 justify-end">

                        <a wire:navigate href="{{ route('panel.routes.organizer') }}"
                            class="ml-3 inline-flex items-center rounded-md bg-indigo-600 px-3 py-2 leading-4 text-sm font-semibold text-white shadow-sm hover:bg-indigo-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Organizar
                            rutas
                            {{--
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                class="size-4 ml-3">
                                <path fill-rule="evenodd"
                                    d="M11.622 1.602a.75.75 0 0 1 .756 0l2.25 1.313a.75.75 0 0 1-.756 1.295L12 3.118 10.128 4.21a.75.75 0 1 1-.756-1.295l2.25-1.313ZM5.898 5.81a.75.75 0 0 1-.27 1.025l-1.14.665 1.14.665a.75.75 0 1 1-.756 1.295L3.75 8.806v.944a.75.75 0 0 1-1.5 0V7.5a.75.75 0 0 1 .372-.648l2.25-1.312a.75.75 0 0 1 1.026.27Zm12.204 0a.75.75 0 0 1 1.026-.27l2.25 1.312a.75.75 0 0 1 .372.648v2.25a.75.75 0 0 1-1.5 0v-.944l-1.122.654a.75.75 0 1 1-.756-1.295l1.14-.665-1.14-.665a.75.75 0 0 1-.27-1.025Zm-9 5.25a.75.75 0 0 1 1.026-.27L12 11.882l1.872-1.092a.75.75 0 1 1 .756 1.295l-1.878 1.096V15a.75.75 0 0 1-1.5 0v-1.82l-1.878-1.095a.75.75 0 0 1-.27-1.025ZM3 13.5a.75.75 0 0 1 .75.75v1.82l1.878 1.095a.75.75 0 1 1-.756 1.295l-2.25-1.312a.75.75 0 0 1-.372-.648v-2.25A.75.75 0 0 1 3 13.5Zm18 0a.75.75 0 0 1 .75.75v2.25a.75.75 0 0 1-.372.648l-2.25 1.312a.75.75 0 1 1-.756-1.295l1.878-1.096V14.25a.75.75 0 0 1 .75-.75Zm-9 5.25a.75.75 0 0 1 .75.75v.944l1.122-.654a.75.75 0 1 1 .756 1.295l-2.25 1.313a.75.75 0 0 1-.756 0l-2.25-1.313a.75.75 0 1 1 .756-1.295l1.122.654V19.5a.75.75 0 0 1 .75-.75Z"
                                    clip-rule="evenodd" />
                            </svg> --}}


                        </a>
                    </div>


                </div>
            </div>
        </div>
    </header>




    <div class="mx-auto max-w-screen-2xl md:px-6 lg:px-8">
        <div class="sm:flex sm:items-center py-4">
            <div class="sm:flex-auto">
                <h1 class="text-base font-semibold leading-6 text-gray-900">Rutas para
                    {{ $day }}/{{ $month }}/{{ $year }}</h1>
                <p class="mt-2 text-sm text-gray-700">Lista de todas las visitas asignadas a los usuarios para la
                    fecha especificada.</p>
            </div>
        </div>




        <!-- Tabla de visitas asignadas -->
        <div class="mt-1 flow-root">
            <livewire:panel.routes.partials.assigned-visits :year="$year" :month="$month" :day="$day"
                :typeView="$view" />
        </div>


        <div x-data="{ showUncoordinated: @entangle('showUncoordinated') }" class="w-full max-w-2xl mx-auto p-4">
            <button wire:click="$toggle('showUncoordinated')"
                class="w-full bg-slate-700 hover:bg-slate-600 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                <span
                    x-text="showUncoordinated ? 'Ocultar visitas sin coordinar' : 'Mostrar visitas sin coordinar'"></span>
                <svg x-show="!showUncoordinated" class="inline w-4 h-4 ml-2" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
                <svg x-show="showUncoordinated" class="inline w-4 h-4 ml-2" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path>
                </svg>
            </button>
        </div>

        @if ($showUncoordinated)
            <!-- Tabla de visitas no asignadas -->
            <div class="mt-8 flow-root">
                <livewire:panel.routes.partials.unassigned-visits :year="$year" :month="$month"
                    :day="$day" />

            </div>
        @endif
    </div>

   
    <script>
        function listRoutesData() {
            return {
                view: @entangle('view').live,
                open: false,
                init() {
                    // Al inicializar, comprobamos si hay una vista guardada en localStorage
                    const savedView = localStorage.getItem('listRoutesView');
                    if (savedView) {
                        this.view = savedView;
                    }else{
                        this.view = 'list';
                    }

                    // Observamos cambios en 'view' y actualizamos localStorage
                    this.$watch('view', (value) => {
                        localStorage.setItem('listRoutesView', value);

                    });
                }
            }
        }
    </script>








</div>
