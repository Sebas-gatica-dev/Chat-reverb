<div class="">
    <div class="mx-auto max-w-screen-sm md:px-6 lg:px-8 px-2">
        @foreach ($visits as $userData)
            <div class="mb-8">


                <div class="border flex items-center justify-between bg-white p-4 border-gray-200 shadow text-center rounded-lg ">

                    <!-- Nombre del Operario -->
                    <div class="flex-1">

                        <h2 class="text-xl font-bold text-center text-gray-800">{{ $userData['user']->name }}</h2>

                    </div>


                    <div class="ml-auto">

                        <span class="cursor-pointer" wire:click="dispatchToParentShowRouteMap({{ json_encode(array_column($userData['visits'], 'id')) }})">

                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 6.75V15m6-6v8.25m.503 3.498 4.875-2.437c.381-.19.622-.58.622-1.006V4.82c0-.836-.88-1.38-1.628-1.006l-3.869 1.934c-.317.159-.69.159-1.006 0L9.503 3.252a1.125 1.125 0 0 0-1.006 0L3.622 5.689C3.24 5.88 3 6.27 3 6.695V19.18c0 .836.88 1.38 1.628 1.006l3.869-1.934c.317-.159.69-.159 1.006 0l4.994 2.497c.317.158.69.158 1.006 0Z" />
                        </svg>

                        </span>


                    </div>
                </div>


                <!-- Contenedor de Tarjetas -->
                <div class="grid grid-cols-1 gap-y-6 justify-items-center mt-4">
                    @foreach ($userData['visits'] as $visit)
                        <!-- Tarjeta de Visita -->
                        <div class="w-full overflow-hidden bg-white rounded-lg shadow-lg">
                            <!-- Imagen o Ícono -->
                            <!-- Puedes usar una imagen o un color de fondo -->
                            {{-- <div class="flex items-center justify-center h-48 bg-gray-100">
                            <!-- Ícono representativo -->
                            <svg class="h-20 w-20 text-gray-400" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M..."/>
                            </svg>
                        </div> --}}

                            <!-- Encabezado de la Tarjeta -->
                            <div
                                class="flex items-center justify-between px-6 py-3 bg-gradient-to-r from-violet-700 to-violet-950">
                                {{-- <svg class="w-6 h-6 text-white fill-current" viewBox="0 0 24 24">
                                <!-- Ícono representativo -->
                                <path d="M..."/>
                            </svg> --}}

                                <div class="flex">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-white">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                    </svg>




                                    <h1 class="mx-3 text-base font-semibold text-white">
                                        {{ Carbon\Carbon::parse($visit->time)->format('H:i') }}</h1>
                                </div>

                                <div>

                                    <div class="flex ml-1 sm:ml-0 gap-x-1 sm:gap-x-2 justify-end">


                                        @can('access-function', 'visit-update-all-state')
                                            @if (!in_array($visit->status->value, ['completed', 'rescheduled', 'cancelled', 'incomplete']))
                                                <a href="{{ route('panel.customers.property.visit.update.status', [$visit->customer_id, $visit->property_id, $visit->id]) }}"
                                                    wire:navigate
                                                    class="rounded bg-white px-2 py-1 text-sm font-semibold text-gray-700 shadow-sm ring-1 ring-inset ring-gray-600/20 hover:bg-gray-50 flex items-center">

                                                    <span class="hidden sm:inline"> Actualizar estado</span>
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                        fill="currentColor" class="h-4 w-4 text-white-400 inline sm:ml-1">
                                                        <path
                                                            d="M5.055 7.06C3.805 6.347 2.25 7.25 2.25 8.69v8.122c0 1.44 1.555 2.343 2.805 1.628L12 14.471v2.34c0 1.44 1.555 2.343 2.805 1.628l7.108-4.061c1.26-.72 1.26-2.536 0-3.256l-7.108-4.061C13.555 6.346 12 7.249 12 8.689v2.34L5.055 7.061Z" />
                                                    </svg>

                                                </a>
                                            @endif
                                        @endcan



                                        @can('access-function', 'visit-edit')
                                            <a href="{{ route('panel.customers.property.visit.edit', [$visit->customer_id, $visit->property_id, $visit->id]) }}"
                                                wire:navigate
                                                class="rounded items-center bg-white px-2 py-1 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 flex">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                    fill="currentColor" class="h-4 w-4 text-gray-400 inline sm:mr-1">
                                                    <path
                                                        d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32L19.513 8.2Z" />
                                                </svg>
                                                <span class="hidden sm:inline"> Editar</span>


                                            </a>
                                        @endcan

                                    </div>




                                </div>

                            </div>

                            <!-- Contenido de la Tarjeta -->
                            <div class="px-1 py-4">


                                <livewire:panel.routes.partials.typeview.visits-format-card-info :visit="$visit"
                                    :key="$visit->id" />
                                {{-- <h1 class="text-xl font-semibold text-gray-800">{{ $visit->customer->name }}</h1>

                            <p class="py-2 text-gray-700">{{ $visit->property->address }}</p>

                            <!-- Información adicional -->
                            <div class="flex items-center mt-4 text-gray-700">
                                <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24">
                                    <!-- Ícono de reloj -->
                                    <path d="M..."/>
                                </svg>
                                <h1 class="px-2 text-sm">{{ \Carbon\Carbon::parse($visit->time)->format('H:i') }}</h1>
                            </div>

                            <div class="flex items-center mt-4 text-gray-700">
                                <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24">
                                    <!-- Ícono de teléfono -->
                                    <path d="M..."/>
                                </svg>
                                <h1 class="px-2 text-sm">
                                    {{ $visit->customer->phones->first()->number ?? 'Sin teléfono' }}
                                </h1>
                            </div> --}}

                            </div>

                            <!-- Sección de Comentarios -->

                            <div class="px-4 py-5 sm:p-6 bg-gray-50 border-t border-gray-200">
                                @livewire('panel.property.visit.add-comment', ['visit' => $visit], key('visit-comment-' . $visit->id))
                            </div>

                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach

    </div>
</div>
