@php
    use App\Enums\Units\UnitMeditionTypeEnum;
    use App\Enums\StatusVisitEnum;

    // Mapeo de estados a índices en el flujo de la visita
    $statusIndexMap = [
        StatusVisitEnum::ONTHEWAY->value => 1,
        StatusVisitEnum::ATTHEDOOR->value => 2,
        StatusVisitEnum::INPROGRESS->value => 3,
        StatusVisitEnum::COMPLETED->value => 4,
    ];

    // Obtener el índice del estado actual en el flujo
    $currentStatusIndex = $statusIndexMap[$visit->status->value] ?? 0;
@endphp

<div

x-data="{
        steps: @entangle('steps').live,
        locationActive: @entangle('locationActive').live,
        locationBlocked: @entangle('locationBlocked').live,
        }" 
    x-cloak
    >

    @if ($locationActive && $locationBlocked == false)
        <header class="bg-white shadow">
            <div class="mx-auto max-w-screen-2xl px-4 py-6 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between">
                    <div class="min-w-0">
                        <h1 class="text-xl font-bold tracking-tight text-gray-900">Actualizar estado</h1>
                        <div class="text-sm text-gray-500">{{ Carbon\Carbon::parse($visit->date)->format('d/m/Y') }} -
                            {{ Carbon\Carbon::parse($visit->time)->format('H:i') }}</div>
                    </div>

                    <div class="flex md:ml-4 md:mt-0">
                        <a wire:navigate
                            href="{{ route('panel.customers.property.show', [$visit->customer_id, $visit->property_id]) }}"
                            class="ml-3 inline-flex items-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                            Volver
                        </a>
                    </div>
                </div>
            </div>
        </header>

        <div class="my-8 mx-auto max-w-screen-md bg-white ring-1 ring-black ring-opacity-5 md:rounded-lg md:shadow">


            <div class="px-4 py-10 lg:p-8">
                <nav class="flex items-center justify-center" aria-label="Progress">
                    <p class="text-sm font-medium">Estado {{ $currentStatusIndex }} de 4</p>
                    <ol role="list" class="ml-8 flex items-center space-x-5">
                        @for ($i = 1; $i <= 4; $i++)
                            <li>
                                <a href="#"
                                    class="block h-2.5 w-2.5 rounded-full {{ $currentStatusIndex > $i ? 'bg-indigo-600 hover:bg-indigo-900' : ($currentStatusIndex == $i ? 'bg-indigo-200' : 'bg-gray-200') }}">
                                    @if ($currentStatusIndex == $i)
                                        <span class="relative block h-2.5 w-2.5 rounded-full bg-indigo-600"
                                            aria-hidden="true"></span>
                                    @endif
                                    <span class="sr-only">Estado {{ $i }}</span>
                                </a>
                            </li>
                        @endfor
                    </ol>
                </nav>

                {{-- @dump($latitude, $longitude) --}}

                @php
                    $componentName = 'panel.visit.visit-status.' . Str::lower($visit->status->getName());
                @endphp

                @php
                    $componentParams = [
                        'formsDynamic' => $formsDynamic,
                        'visit' => $visit,
                        'latitude' => $latitude,
                        'longitude' => $longitude,
                    ];
                @endphp

                @livewire($componentName, $componentParams)
            </div>


            <div class="flex items-center justify-end gap-x-6 border-t border-gray-900/10 px-4 py-4 divide-x-1">
                @if (in_array($visit->status->value, ['pending', 'ontheway', 'atthedoor', 'inprogress']))
                    <div class="relative inline-flex rounded-md shadow-sm" x-data="{ open: false }">
                        <!-- Main button -->
                        <button type="button"
                            class="flex items-center justify-center gap-1 rounded-l-md bg-red-500 px-3 py-2 text-sm font-semibold text-white ring-1 ring-inset ring-red-500 hover:bg-red-600 focus:z-10 whitespace-nowrap">
                            <span>¿Tuviste problemas?</span>
                        </button>

                        <!-- Dropdown trigger -->
                        <div class="relative">
                            <button type="button" @click="open = !open"
                                class="flex items-center justify-center rounded-r-md bg-red-500 px-2 py-2 text-white ring-1 ring-inset ring-red-500 hover:bg-red-600 focus:z-10">
                                <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd"
                                        d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>

                            <!-- Dropdown menu -->
                            <div x-show="open" x-transition:enter="transition ease-out duration-100"
                                x-transition:enter-start="transform opacity-0 scale-95"
                                x-transition:enter-end="transform opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-75"
                                x-transition:leave-start="transform opacity-100 scale-100"
                                x-transition:leave-end="transform opacity-0 scale-95" @click.away="open = false"
                                class="absolute right-0 z-50 mt-2 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                                role="menu" aria-orientation="vertical" aria-labelledby="option-menu-button"
                                tabindex="-1">
                                <div class="py-1" role="none">
                                    @if (in_array($visit->status->value, ['pending', 'ontheway', 'atthedoor']))
                                        <button wire:click="problemsModal('cancelled')"
                                            class="block w-full px-4 py-2 text-left text-sm text-gray-700 hover:bg-gray-100"
                                            role="menuitem">
                                            Cancelar visita
                                        </button>
                                    @endif

                                    @if (in_array($visit->status->value, ['atthedoor']))
                                        <button wire:click="problemsModal('rescheduled')"
                                            class="block w-full px-4 py-2 text-left text-sm text-gray-700 hover:bg-gray-100"
                                            role="menuitem">
                                            Reprogramar visita
                                        </button>
                                    @endif

                                    @if ($visit->status->value == 'inprogress')
                                        <button wire:click="problemsModal('incomplete')"
                                            class="block w-full px-4 py-2 text-left text-sm text-gray-700 hover:bg-gray-100"
                                            role="menuitem">
                                            Servicio incompleto
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                
                <button x-show="steps > 2 && '{{ $visit->status->value }}' == 'inprogress'" x-on:click="steps--"
                    type="button"
                    class="rounded-md bg-gray-400 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-gray-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-500">
                    Volver
                </button>



                <button
                x-on:click="
                if ('{{ $visit->status->value }}'  != 'inprogress') {
                    $wire.dispatch('update-status'); // Dispatch en estados menores a 3
                } else if (steps < 3) {
                    steps++; // Incrementa steps cuando status es 3
                    if(steps == 2){
                        alert('Verifica tus registros de productos antes de finalizar.');
                    }
                } else {
                    localStorage.removeItem('steps');
                    $wire.dispatch('update-status'); // Ejecuta dispatch cuando steps es 3
                }
            "
                x-text="steps != 3 ? 'Siguiente' : 'Finalizar'" type="button"
                class="ml-auto rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">

            </button>
            </div>
        </div>

        <livewire:panel.visit.visit-status.problem-status :visit="$visit">
        @elseif($locationActive == false && ($locationBlocked == false || $locationBlocked == true))
            <div class="min-h-[50vh] flex items-center justify-center p-4">
                <div class="max-w-lg w-full bg-white shadow-xl rounded-lg overflow-hidden">
                    <div class="p-5">

                        <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-500" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            Permiso de Ubicación Requerido
                        </h2>

                        <div class="mt-4 bg-yellow-50 border-l-4 border-yellow-400 p-4">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd"
                                            d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm text-yellow-700">
                                        Para brindarte el mejor servicio, necesitamos acceder a tu ubicación. Por favor,
                                        autoriza el acceso cuando el navegador lo solicite.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="mt-6 flex justify-center">
                            <div class="animate-pulse">
                                <div class="rounded-full bg-indigo-200 p-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-indigo-600"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4 text-center">
                            <h3 class="font-semibold text-lg">Esperando autorización...</h3>
                            <p class="text-sm text-gray-600 mt-1">
                                Si no ves la solicitud de permiso, sigue estas instrucciones:
                            </p>

                            @if($locationActive == false && $locationBlocked == false)
                                <button 
                                x-on:click="getLocation()" 
                                class="bg-indigo-500 p-2 text-white m-4 rounded-md">
                                    Dar ubicación
                                </button>
                            @endif

                        </div>

                        <div x-cloak class="mt-4 space-y-4">
                            <div>
                                <h4 class="font-medium text-gray-800">En dispositivos móviles:</h4>
                                <ul class="list-disc pl-5 mt-2 space-y-1 text-sm text-gray-600">
                                    <li>Abre la configuración de Chrome</li>
                                    <li>Ve a Configuración del sitio > Ubicación</li>
                                    <li>Busca este sitio y cambia el permiso a "Permitir"</li>
                                </ul>
                            </div>
                            <div>
                                <h4 class="font-medium text-gray-800">En computadoras:</h4>
                                <ul class="list-disc pl-5 mt-2 space-y-1 text-sm text-gray-600">
                                    <li>Haz clic en el ícono del candado en la barra de direcciones</li>
                                    <li>Busca "Ubicación" en los permisos</li>
                                    <li>Selecciona "Permitir"</li>
                                </ul>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
     
    @endif


    {{-- @dump($locationActive,$locationBlocked) --}}

    {{-- <template x-teleport="body"> --}}

    {{-- </template> --}}

</div>


@script
<script>
  document.addEventListener('livewire:navigated', function() {
        // Inicializar si es necesario al navegar
        checkPermission();
    }, {
        once: true
    });

    // function locationComponent() {
    //         return {
    //             // steps: @entangle('steps').live,
    //             locationActive: @entangle('locationActive').live,
    //             locationBlocked: @entangle('locationBlocked').live,
    //             intervalId: null,

    //             init() {
    //                 this.checkPermission(); // Verificar permisos al cargar
    //                 this.startLocationInterval();
    //             },

    //             startLocationInterval() {
    //                 // Intervalo para actualizar la ubicación cada 5 minutos
    //                 this.intervalId = setInterval(() => {
    //                     if (this.locationActive) {
    //                         this.getLocation();
    //                     }
    //                 }, 300000); // 300000 ms = 5 minutos
    //             },

    //             async checkPermission() {
    //                 if (navigator.permissions) {
    //                     const permissionStatus = await navigator.permissions.query({ name: 'geolocation' });
    //                     permissionStatus.state === 'granted' ? this.getLocation() : this.blockLocation();

    //                     // Maneja cambios en permisos en tiempo real
    //                     permissionStatus.onchange = () => {
    //                         permissionStatus.state === 'granted' ? this.getLocation() : this.blockLocation();
    //                     };
    //                 } else {
    //                     this.getLocation(); // Si no hay permisos explícitos, intenta obtener ubicación
    //                 }
    //             },

    //             getLocation() {
    //                 if (navigator.geolocation) {
    //                     navigator.geolocation.getCurrentPosition(
    //                         (position) => {
    //                             Livewire.dispatch('updateLocation', { 
    //                                 latitude: position.coords.latitude,
    //                                 longitude: position.coords.longitude
    //                             });
    //                             this.locationActive = true;
    //                             this.locationBlocked = false;
    //                         },
    //                         (error) => {
    //                             error.code === error.PERMISSION_DENIED ? this.blockLocation() : alert("Error al obtener la ubicación.");
    //                         },
    //                         { enableHighAccuracy: true, timeout: 5000, maximumAge: 0 }
    //                     );
    //                 } else {
    //                     alert("La geolocalización no es compatible con este navegador.");
    //                 }
    //             },

    //             blockLocation() {
    //                 this.locationBlocked = true;
    //                 this.locationActive = false;
    //                 clearInterval(this.intervalId); // Detener intervalos si la ubicación está bloqueada
    //             }
    //         };
    //     }




     function checkPermission() {
        // Verificar el estado del permiso de geolocalización
        if (navigator.permissions) {
            navigator.permissions.query({
                name: 'geolocation'
            }).then((permissionStatus) => {


                if (permissionStatus.state === 'granted') {
                    // Si el permiso ya está concedido, obtener la ubicación directamente
                    getLocation();
                }

                // Escuchar cambios de estado del permiso en tiempo real
                permissionStatus.onchange = () => {
                    if (permissionStatus.state === 'granted') {
                        getLocation();
                    } else if (permissionStatus.state === 'denied') {
                        Livewire.emit('updateLocationStatus', false, true);
                    }
                };
            });
        }
    }

    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition, showError, {
                enableHighAccuracy: true,
                maximumAge: 0
            });
        } else {
            alert("La geolocalización no es compatible con este navegador.");
        }
    }

    window.getLocation = getLocation;

    function showPosition(position) {
        Livewire.dispatch('updateLocation', [position.coords.latitude, position.coords.longitude]);
        //Livewire.emit('updateLocationStatus', true, false); 
        $wire.set('locationActive', true);
        $wire.set('locationBlocked', false);

        console.log('Ubicación actualizada');
    }

    function showError(error) {
        switch (error.code) {
            case error.PERMISSION_DENIED:
                alert("Debe permitir el acceso a la ubicación para continuar.");
                Livewire.emit('updateLocationStatus', false, true);
                break;
            case error.POSITION_UNAVAILABLE:
                alert("La información de ubicación no está disponible.");
                break;
            case error.TIMEOUT:
                alert("Hubo un problema al obtener la ubicación, actualice la página.");
                break;
            case error.UNKNOWN_ERROR:
                alert("Ha ocurrido un error desconocido.");
                break;
        }
    }
</script>
@endscript
