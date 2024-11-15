<div>
    <div>

        <div class="overflow-x-auto">
            <div class="inline-block min-w-full py-6 align-middle px-0.5">

                <table
                    class="min-w-full divide-y divide-gray-300 bg-white ring-1 ring-black ring-opacity-5 md:rounded-lg md:shadow">
                    <thead class="">
                        <tr>
                            <th scope="col" class="w-8 py-3.5 pl-4 pr-3 sm:pl-6">
                                <!-- Espacio para el botón -->
                            </th>


                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Hora</th>

                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Estado
                            </th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                Dirección
                            </th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Cliente
                            </th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                Teléfono
                            </th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Precio
                            </th>

                            <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                <span class="sr-only">Acciones</span>
                            </th>

                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">


                        @foreach ($visits as $userData)
                            <tr class="border-t border-gray-200 bg-gray-50 ">

                                <th colspan="3"
                                    class="py-2 pl-4 pr-3 text-start text-sm font-semibold text-gray-900 sm:pl-3">
                                    {{ $userData['user']->name }}

                                </th>

                                <th colspan="4" scope="colgroup">
                                </th>
                                <th colspan="1"
                                    class=" py-2 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-3">

                                    <div class="flex ml-1 sm:ml-0 gap-x-1 sm:gap-x-2 justify-end mr-4">

                                        <span class="text-red-500 cursor-pointer"
                                            wire:click="dispatchToParentDateVisit({{ json_encode(array_column($userData['visits'], 'id')) }}, '{{ $userData['user']->id }}', '{{ $year }}-{{ $month }}-{{ $day }}')">Reorganizar</span>
                                        - <span class="text-indigo-500 cursor-pointer"
                                            wire:click="dispatchToParentShowRouteMap({{ json_encode(array_column($userData['visits'], 'id')) }})">Ver
                                            en mapa</span>

                                    </div>
                                </th>

                            </tr>

                            @foreach ($userData['visits'] as $visit)
                    <tbody x-data="{ open: false }" wire:key="{{ $visit->id }}">



                        <tr class="border-t border-gray-300">

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


                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                {{ \Carbon\Carbon::parse($visit->time)->format('H:i') }}</td>


                            <td class="relative py-5 pr-6">


                                <div class="flex items-center justify-center has-tooltip">

                                    <div
                                        class="flex-none rounded-full animate-pulse {{ $visit->status->getBgClasses() }} p-1 {{ $visit->status->getStatusClasses() }}">
                                        <div class="h-2 w-2 rounded-full bg-current"></div>
                                    </div>
                                    <span class="tooltip text-sm">

                                        {{ $visit->status->getStatus($visit->status) }}
                                    </span>

                                </div>

                            </td>



                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-700">
                                <a href="https://maps.google.com/?q={{$visit->property->latitude }},{{$visit->property->longitude}}" target="_blank"
                             class="font-semibold">

                                    {{ $visit->property->address }}

                                </a>
                            </td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-700">

                                <a href="{{ route('panel.customers.property.show', [$visit->customer_id, $visit->property_id]) }}"
                                
                                    wire:navigate
                                    >

                                    {{ $visit->customer->name }}

                                </a>

                            </td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                @if ($visit->customer->phones->count() > 0)
                                    {{ $visit->customer->phones->first()->number }}
                                @else
                                    <span class="text-red-500">Sin teléfono</span>
                                @endif
                            </td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                ${{ $visit->price }}</td>


                            <td>

                                <div class="flex ml-1 sm:ml-0 gap-x-1 sm:gap-x-2 justify-end mr-4">


                                    @can('access-function', 'visit-update-all-state')
                                        @if (!in_array($visit->status->value, ['completed', 'rescheduled', 'cancelled', 'incomplete']))
                                            <a href="{{ route('panel.customers.property.visit.update.status', [$visit->customer_id, $visit->property_id, $visit->id]) }}"
                                                wire:navigate
                                                class="rounded bg-yellow-50 px-2 py-1 text-sm font-semibold text-yellow-800 shadow-sm ring-1 ring-inset ring-yellow-600/20 hover:bg-yellow-100 flex items-center">

                                                <span class="hidden sm:inline"> Actualizar estado</span>
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                    fill="currentColor" class="h-4 w-4 text-yellow-400 inline sm:ml-1">
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
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                                class="h-4 w-4 text-gray-400 inline sm:mr-1">
                                                <path
                                                    d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32L19.513 8.2Z" />
                                            </svg>
                                            <span class="hidden sm:inline"> Editar</span>


                                        </a>
                                    @endcan

                                </div>

                            </td>

                        </tr>

                        <tr x-show="open" wire:key="{{ $visit->id }}" x-cloak>

                            <td colspan="8" class="bg-gray-50 border-t border-t-gray-200">

                                <div class="sm:px-16 py-4">


                                    <livewire:panel.routes.partials.typeview.visits-format-list-info :visit="$visit"
                                        :key="$visit->id" />

                                </div>


                                <div class="sm:px-16 py-4 bg-white border-t border-t-gray-200">

                                    <livewire:panel.property.visit.add-comment :visit="$visit" :key="$visit->id"
                                        :principalComment="$visit->comments->first()" />

                                </div>

                            </td>
                        </tr>



                    </tbody>
                    @endforeach
                    @endforeach
                    </tbody>
                </table>


                {{-- <div class="mt-4">
                    {{ $assignedVisitsPaginated->links() }}
                </div> --}}

            </div>
        </div>

    </div>

</div>
