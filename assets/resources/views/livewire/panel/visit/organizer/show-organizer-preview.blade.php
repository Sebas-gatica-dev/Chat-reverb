<div>



    <header class="bg-white shadow">
        <div class="mx-auto max-w-screen-2xl px-4 py-6 sm:px-6 lg:px-8">
            <div class="sm:flex sm:items-center sm:justify-between">
                <div class="min-w-0 flex-1">
                    <h1 class="text-2xl font-bold tracking-tight text-gray-900">Ruta Organizada</h1>
                </div>


                <div class="mt-4 flex md:ml-4 md:mt-0 justify-end">

                    <a wire:navigate href="{{ route('panel.routes.list') }}"
                        class="ml-3 inline-flex items-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Atras</a>
                </div>

            </div>
        </div>


    </header>

    <div class="mx-auto max-w-screen-2xl py-6 sm:px-6 lg:px-8">
        <div class="py-6 align-middle w-auto max-sm:w-16">
            <div class="p-6 bg-white rounded-lg shadow-lg">

                <!-- Navegación de Fechas -->
                <div class="mb-6 overflow-x-auto">
                    <div class="border-b border-gray-200">
                        <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                            @foreach ($routeOrganizer as $date => $data)
                                @if ($data['hasVisits'])
                                    <!-- Fecha con visitas, habilitamos wire:click -->
                                    <button wire:click.prevent="selectDate('{{ $date }}')"
                                        class="whitespace-nowrap border-b-2 px-1 py-4 text-sm font-medium 
                                        {{ $selectedDate === $date ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700' }}
                                       ">
                                        {{ \Carbon\Carbon::parse($date)->format('d M, Y') }}
                                    </button>
                                @else
                                    <!-- Fecha sin visitas, sin wire:click o estilo deshabilitado -->
                                    <span
                                        class="whitespace-nowrap border-b-2 px-1 py-4 text-sm font-medium 
                                    border-transparent text-gray-200  
                                    cursor-not-allowed">
                                        {{ \Carbon\Carbon::parse($date)->format('d M, Y') }}
                                    </span>
                                @endif
                            @endforeach
                        </nav>
                    </div>
                </div>

                {{-- @dd($routeOrganizer)     --}}
                <div>
                    @foreach ($routeOrganizer as $date => $data)
                        <div wire:key="date-{{ $date }}">
                            @if ($selectedDate === $date)
                                @foreach ($data['workers'] as $operatorId => $operatorData)
                                    {{-- @dump($operatorData) --}}

                                    <div>
                                        <livewire:panel.visit.organizer.partials.operator-routes :operatorId="$operatorId"
                                            :operatorData="$operatorData" :selectedDate="$selectedDate" :availableDates="$availableDates" :componenteId="$date . '-' . $operatorId"
                                            :key="$date . '-' . $operatorId" />


                                    </div>
                                @endforeach
                            @endif
                        </div>
                    @endforeach

                </div>

                <!-- Sección de Visitas No Organizadas -->
                <div class="mt-8">
                    <h2 class="text-xl font-bold mb-4">Visitas no organizadas</h2>

                    <table class="min-w-full divide-y divide-gray-300">
                        <thead>
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Cliente</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Dirección</th>

                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Estado</th>

                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Acciones</th>

                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">


                            @foreach ($uncoordinatedVisits as $visit)
                                <tr wire:key="visit-{{ $visit['id'] }}">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{ $visit['customer']['name'] }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $visit['property']['address'] }}</td>

                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                            No Organizada
                                        </span>
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{-- @dd($visit) --}}
                                        <!-- Aquí puedes agregar los botones o enlaces de acción -->
                                        <button
                                            wire:click.stop="openMoveModalVisitNotOrganized('{{ $visit['id'] }}', '{{ $visit['property']['id'] }}')"
                                            class="text-indigo-600 hover:text-indigo-900">

                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="size-5">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M7.5 21L3 16.5m0 0L7.5 12M3 16.5h13.5m0-13.5L21 7.5m0 0L16.5 12M21 7.5H7.5" />
                                            </svg>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Botón de Confirmación -->
                <div class="flex justify-between mt-6">
                    <div>
                        @if ($unsaved)
                            <span
                                class="inline-flex items-center rounded-full bg-yellow-100 px-2 py-1 text-xs font-medium text-yellow-800">
                                Hay cambios sin guardar
                            </span>
                        @endif
                    </div>

                    <button wire:click="saveRoutes" wire:confirm='¿Estás seguro de guardar las rutas?'
                        class="bg-indigo-600 text-white text-sm px-3 py-2 rounded-md shadow-md hover:bg-indigo-700">
                        Guardar rutas
                    </button>
                </div>






            </div>
        </div>


        {{-- @assets
    <script defer 
     type="text/javascript"
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD3K3dBES7-pn0gkICbQyiQgfNHhlUU3W4&libraries=places,geometry,drawing">
    </script>
@endassets --}}


        {{-- @assets

    <script defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD3K3dBES7-pn0gkICbQyiQgfNHhlUU3W4&libraries=places,geometry,drawing">
    </script>
    @endassets --}}


        {{-- @push('scripts')
            @once

                @assets
                    <script defer
                        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD3K3dBES7-pn0gkICbQyiQgfNHhlUU3W4&libraries=places,geometry,drawing">
                    </script>
                @endassets
            @endonce


        @endpush --}}




        <!-- Modal de Mover Visita -->
        @if ($showMoveModalVisitNotOrganized)




            <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
                <div class="bg-white rounded-lg shadow-lg w-96">
                    <div class="flex justify-between items-center p-4 border-b">
                        <h3 class="text-lg font-semibold">Mover Visita</h3>
                        <button wire:click="closeMoveModalVisitNotOrganized" class="text-gray-500 hover:text-gray-700">
                            <!-- Icono SVG -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    <div class="p-4">
                        <div class="mb-4">
                            <label for="moveToDate" class="block text-sm font-medium text-gray-700">Nueva
                                Fecha</label>
                            <select wire:model="moveToDate" id="moveToDate"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm text-sm">
                                <option value="">Selecciona una fecha</option>
                                @foreach ($availableDates as $availableDate)
                                    <option class="text-sm" value="{{ $availableDate }}">
                                        {{ \Carbon\Carbon::parse($availableDate)->format('d M, Y') }}</option>
                                @endforeach
                            </select>
                            @error('moveToDate')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="moveToOperator" class="block text-sm font-medium text-gray-700">Nuevo
                                Operario</label>
                            <select wire:model="moveToOperator" id="moveToOperator"
                                class="mt-1 block w-full border border-gray-300 text-sm rounded-md shadow-sm">
                                <option class="text-sm" value="">Selecciona un operario</option>
                                @foreach ($availableOperators as $opId => $operatorName)
                                    <option class="text-sm" value="{{ $opId }}">{{ $operatorName }}</option>
                                @endforeach
                            </select>
                            @error('moveToOperator')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    @if (session('status'))
                        <div class="mb-4">
                            <p class="text-red-500 text-sm text-center">
                                {{ session('status') }}

                            </p>

                        </div>
                    @endif

                    <div class="flex justify-end p-4 border-t">
                        <button wire:click="closeMoveModalVisitNotOrganized"
                            class="mr-2 text-sm px-4 py-2 bg-gray-200 text-gray-700 rounded">Cancelar</button>
                        <button wire:click="moveVisitNotOrganized"
                            class="px-4 py-2 text-sm bg-indigo-600 text-white rounded hover:bg-indigo-700">Mover</button>
                    </div>
                </div>
            </div>
        @endif


    </div>

    @script
        <script>
            (g => {
                var h, a, k, p = "The Google Maps JavaScript API",
                    c = "google",
                    l = "importLibrary",
                    q = "__ib__",
                    m = document,
                    b = window;
                b = b[c] || (b[c] = {});
                var d = b.maps || (b.maps = {}),
                    r = new Set,
                    e = new URLSearchParams,
                    u = () => h || (h = new Promise(async (f, n) => {
                        await (a = m.createElement("script"));
                        e.set("libraries", [...r] + "");
                        for (k in g) e.set(k.replace(/[A-Z]/g, t => "_" + t[0].toLowerCase()), g[
                            k]);
                        e.set("callback", c + ".maps." + q);
                        a.src = `https://maps.${c}apis.com/maps/api/js?` + e;
                        d[q] = f;
                        a.onerror = () => h = n(Error(p + " could not load."));
                        a.nonce = m.querySelector("script[nonce]")?.nonce || "";
                        m.head.append(a);
                    }));
                d[l] ? console.warn(p + " only loads once. Ignoring:", g) : d[l] = (f, ...n) => r.add(f) && u()
                    .then(() =>
                        d[l](f, ...n))
            })({
                key: "AIzaSyD3K3dBES7-pn0gkICbQyiQgfNHhlUU3W4",
                v: "weekly",
                libraries: "places,marker,geometry,drawing"
            });
        </script>
    @endscript


</div>
