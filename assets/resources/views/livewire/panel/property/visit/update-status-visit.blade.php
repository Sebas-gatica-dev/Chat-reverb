<div>

    <header class="bg-white shadow">
        <div class="mx-auto max-w-screen-2xl px-4 py-6 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between">
                <div class="min-w-0">
                    <h1 class="text-xl font-bold tracking-tight text-gray-900">Actualizar estado</h1>
                    <div class="text-sm text-gray-500">{{ $property->property_name ?? $customer->name }}</div>
                    <div class="text-sm text-gray-500">{{ Carbon\Carbon::parse($visit->date)->format('d/m/Y') }} -
                        {{ Carbon\Carbon::parse($visit->time)->format('H:i') }}</div>

                </div>


                <div class="flex md:ml-4 md:mt-0">

                    <a wire:navigate href="{{ route('panel.customers.property.show', [$customer, $property]) }}"
                        class="ml-3 inline-flex items-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Volver</a>
                </div>

            </div>
        </div>


    </header>
    <div
        class="my-8 mx-auto max-w-screen-md bg-white ring-1 ring-black ring-opacity-5 md:rounded-lg
                    md:shadow">

        <div class="px-4 py-10 lg:p-8">

            <nav class="flex items-center justify-center" aria-label="Progress">
                <p class="text-sm font-medium">Estado {{ $visit->status->value + 1 }} de 4</p>
                <ol role="list" class="ml-8 flex items-center space-x-5">
                    @for ($i = 0; $i < 4; $i++)
                        <li>
                            <a href="#"
                                class="block h-2.5 w-2.5 rounded-full {{ $visit->status->value > $i ? 'bg-indigo-600 hover:bg-indigo-900' : ($visit->status->value == $i ? 'bg-indigo-200' : 'bg-gray-200') }}">
                                @if ($visit->status->value == $i)
                                    <span class="relative block h-2.5 w-2.5 rounded-full bg-indigo-600"
                                        aria-hidden="true"></span>
                                @endif
                                <span class="sr-only">Estado {{ $i + 1 }}</span>
                            </a>
                        </li>
                    @endfor
                </ol>
            </nav>

            @include('components.panel.visit-status.' . Str::lower($visit->status->name))

        </div>

        <div class="flex items-center justify-end gap-x-6 border-t border-gray-900/10 px-4 py-4 divide-x-1">
            @if (in_array($visit->status->value, [0, 1, 2, 3]))
                <div class="inline-flex rounded-md shadow-sm" x-data="{ open: false }">
                    <button type="button" x-on:click="open = !open"
                        class="relative inline-flex items-center rounded-l-md bg-red-500 px-3 py-2 text-sm font-semibold text-white ring-1 ring-inset ring-red-500 hover:bg-red-600 focus:z-10">¿Tuviste
                        problemas?</button>
                    <div class="relative -ml-px block">
                        <button type="button"
                            class="relative inline-flex items-center rounded-r-md bg-red-500 px-2 py-2 text-white ring-1 ring-inset ring-red-500 hover:bg-red-600 focus:z-10"
                            id="option-menu-button" aria-expanded="true" aria-haspopup="true" x-on:click="open = !open">
                            <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                        <div class="absolute right-0 z-10 -mr-1 mt-2 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                            role="menu" aria-orientation="vertical" aria-labelledby="option-menu-button"
                            tabindex="-1" x-show="open" @click.away="open = false"
                            x-transition:enter="transition ease-out duration-100"
                            x-transition:enter-start="transform opacity-0 scale-95"
                            x-transition:enter-end="transform opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-75"
                            x-transition:leave-start="transform opacity-100 scale-100"
                            x-transition:leave-end="transform opacity-0 scale-95" x-cloak>
                            <div class="py-1" role="none">
                                <!-- Active: "bg-gray-100 text-gray-900", Not Active: "text-gray-700" -->
                                {{-- <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem"
                                tabindex="-1" id="option-menu-item-0">Reprogramar visita</a> --}}
                                @if (in_array($visit->status->value, [0, 1, 2]))
                                    <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem"
                                        tabindex="-1" id="option-menu-item-1">Cancelar visita</a>
                                @endif
                                @if (in_array($visit->status->value, [3]))
                                    <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem"
                                        tabindex="-1" id="option-menu-item-2">Servicio incompleto</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <button wire:click="updateStatus" type="button"
                class="ml-auto rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Siguiente</button>
        </div>


    </div>

    @script
        <script>
            document.addEventListener('livewire:navigated', function() {
                getLocation();
            });

            function getLocation() {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(showPosition, showError, {
                        enableHighAccuracy: true,
                        timeout: 5000,
                        maximumAge: 0
                    });
                } else {
                    alert("La geolocalización no es compatible con este navegador.");
                }
            }

            function showPosition(position) {
                Livewire.dispatch('updateLocation', [position.coords.latitude, position.coords.longitude]);
            }

            function showError(error) {
                switch (error.code) {
                    case error.PERMISSION_DENIED:
                        alert("Debe permitir el acceso a la ubicación para continuar.");
                        setTimeout(getLocation, 5000); // Intentar nuevamente después de 5 segundos
                        break;
                    case error.POSITION_UNAVAILABLE:
                        alert(
                            "La información de ubicación no está disponible, actualice la página o contacte al administrador."
                            );
                        break;
                    case error.TIMEOUT:
                        alert("Hubo un problema al obtener la ubicación, actualice la página.");
                        setTimeout(getLocation, 5000); // Intentar nuevamente después de 5 segundos
                        break;
                    case error.UNKNOWN_ERROR:
                        alert("Ha ocurrido un error desconocido, actualice la página o contacte al administrador.");
                        setTimeout(getLocation, 5000); // Intentar nuevamente después de 5 segundos
                        break;
                }
            }
        </script>
    @endscript

</div>
