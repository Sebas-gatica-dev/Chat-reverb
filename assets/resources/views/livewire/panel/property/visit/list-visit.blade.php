<div>






    @php
        $status = $visit->status->value;
        $progressWidths = [
            0 => 'width: 2.5%',
            1 => 'width: 30%',
            2 => 'width: 50%',
            3 => 'width: 70%',
            4 => 'width: 100%',
            5 => 'width: 2.5%',
            6 => 'width: 100%',
            7 => 'width: 70%',
        ];

        $statusColors = [
            0 => 'bg-blue-600',
            1 => 'bg-yellow-500',
            2 => 'bg-amber-600',
            3 => 'bg-orange-600',
            4 => 'bg-green-600',
            5 => 'bg-indigo-600',
            6 => 'bg-red-600',
            7 => 'bg-red-900',
        ];

        $statusColorsBullet = [
            0 => 'bg-blue-600/10',
            1 => 'bg-yellow-500/10',
            2 => 'bg-amber-600/10',
            3 => 'bg-orange-600/10',
            4 => 'bg-green-600/10',
            5 => 'bg-indigo-600/10',
            6 => 'bg-red-600/10',
            7 => 'bg-red-900/10',
        ];

        $statusTextColor = [
            0 => 'text-blue-600',
            1 => 'text-yellow-500',
            2 => 'text-amber-600',
            3 => 'text-orange-600',
            4 => 'text-green-600',
            5 => 'text-indigo-600',
            6 => 'text-red-600',
            7 => 'text-red-900',
        ];

        $finalStatusText = [
            5 => 'Reprogramada',
            6 => 'Cancelada',
            7 => 'Incompleta',
        ];
    @endphp

    <div
        class="bg-white shadow-sm ring-1 ring-gray-900/5 -mx-4 sm:mx-0 py-4 px-2 sm:px-6 {{ $first ? 'sm:rounded-b-lg' : 'sm:rounded-lg' }}">


        <div x-data="{ open: false }">

            <div class="relative flex items-center space-x-4 sm:pt-4 pb-6 sm:pb-0">
                <div class="min-w-0 flex-auto">
                    <div class="flex items-center justify-between">


                        <div class="flex items-center gap-x-2">

                            <div
                                class=" rounded-full {{ $statusColorsBullet[$status] }} p-1 {{ $statusTextColor[$status] }} animate-pulse">
                                <div class="h-2.5 w-2.5 rounded-full bg-current"></div>
                            </div>
                            <h2 class="min-w-0 text-sm font-semibold leading-6 text-white">
                                <a href="#" class="flex gap-x-2">
                                    <span
                                        class=" inline-flex items-center rounded-md bg-slate-200 px-2.5 py-0.5 text-sm sm:text-base font-medium text-slate-700">{{ \Carbon\Carbon::parse($visit->date)->format('d/m/Y') }}</span>
                                    {{-- <span class="text-gray-800">/</span> --}}
                                    <span
                                        class="whitespace-nowrap inline-flex items-center rounded-md bg-blue-100 px-2.5 py-0.5 text-sm sm:text-base font-medium text-blue-700">{{ \Carbon\Carbon::parse($visit->time)->format('H:i') }}</span>
                                    {{-- <span class="absolute inset-0"></span> --}}
                                </a>
                            </h2>
                        </div>
                        <div class="flex ml-1 sm:ml-0 gap-x-1 sm:gap-x-2">

                            
                            @can('access-function', 'visit-update-all-state')
                                @if (!in_array($visit->status->value, [4, 5, 6, 7]))
                                    <a href="{{ route('panel.customers.property.visit.update.status', [$visit->customer_id, $visit->property_id, $visit->id]) }}"
                                        wire:navigate
                                        class="rounded bg-yellow-50 px-2 py-1 text-sm font-semibold text-yellow-800 shadow-sm ring-1 ring-inset ring-yellow-600/20 hover:bg-yellow-100 flex items-center">

                                        <span class="hidden sm:inline"> Actualizar estado</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                            class="h-4 w-4 text-yellow-400 inline sm:ml-1">
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


                    </div>
                    <div class="mt-3 flex items-center gap-x-2.5 text-xs leading-5 text-gray-400">
                        <p class="truncate">Confirmado por Emanuel Sánchez</p>
                        <svg viewBox="0 0 2 2" class="h-0.5 w-0.5 flex-none fill-gray-300">
                            <circle cx="1" cy="1" r="1" />
                        </svg>
                        <p class="whitespace-nowrap">creado {{ $visit->created_at->diffForHumans() }}</p>
                    </div>
                </div>
            </div>

            <div class="flex items-center gap-x-4 justify-between sm:justify-end">
                <span class="text-xl sm:text-2xl font-bold tracking-tight text-gray-700">${{ $visit->price }}</span>
                <div class="flex">
                    <div
                        class="rounded-full bg-indigo-400/10 px-2.5 py-0.5 text-xs font-medium text-indigo-400 ring-1 ring-inset ring-indigo-400/30">
                        {{ $visit->visitType->name }}
                    </div>
                    <svg class="h-5 w-5 flex-none text-gray-400 cursor-pointer" viewBox="0 0 20 20" fill="currentColor"
                        aria-hidden="true" x-on:click="open = !open">
                        <path fill-rule="evenodd"
                            d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z"
                            clip-rule="evenodd" />
                    </svg>
                </div>

            </div>

            <div x-show="open" x-cloak>
                <div class="grid grid-cols-1 gap-x-4 gap-y-0 sm:gap-4 sm:grid-cols-2">
                    <div class="relative flex items-center space-x-3 ">
                        <dl class="flex flex-wrap space-y-4 mt-8 sm:my-4">

                            <div class="flex w-full flex-none gap-x-4">
                                <dt class="flex-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                        class="h-6 w-5 text-gray-400">
                                        <path fill-rule="evenodd"
                                            d="M7.5 5.25a3 3 0 0 1 3-3h3a3 3 0 0 1 3 3v.205c.933.085 1.857.197 2.774.334 1.454.218 2.476 1.483 2.476 2.917v3.033c0 1.211-.734 2.352-1.936 2.752A24.726 24.726 0 0 1 12 15.75c-2.73 0-5.357-.442-7.814-1.259-1.202-.4-1.936-1.541-1.936-2.752V8.706c0-1.434 1.022-2.7 2.476-2.917A48.814 48.814 0 0 1 7.5 5.455V5.25Zm7.5 0v.09a49.488 49.488 0 0 0-6 0v-.09a1.5 1.5 0 0 1 1.5-1.5h3a1.5 1.5 0 0 1 1.5 1.5Zm-3 8.25a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z"
                                            clip-rule="evenodd" />
                                        <path
                                            d="M3 18.4v-2.796a4.3 4.3 0 0 0 .713.31A26.226 26.226 0 0 0 12 17.25c2.892 0 5.68-.468 8.287-1.335.252-.084.49-.189.713-.311V18.4c0 1.452-1.047 2.728-2.523 2.923-2.12.282-4.282.427-6.477.427a49.19 49.19 0 0 1-6.477-.427C4.047 21.128 3 19.852 3 18.4Z" />
                                    </svg>

                                </dt>
                                <dd class="text-sm leading-6 text-gray-500">
                                    Servicios:

                                    <div class="ml-2 inline">
                                        @foreach ($visit->services->pluck('name') as $service)
                                            <span
                                                class="inline-flex items-center rounded-md bg-indigo-50 px-1.5 py-0.5 text-xs font-medium text-indigo-700 ring-1 ring-inset ring-indigo-700/10">{{ $service }}</span>
                                        @endforeach

                                    </div>
                                </dd>
                            </div>
                            @can('access-function','visit-show-payment-method')
                            <div class="flex w-full flex-none gap-x-4">
                                <dt class="flex-none">
                                    <span class="sr-only">Status</span>
                                    <svg class="h-6 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor"
                                        aria-hidden="true">
                                        <path fill-rule="evenodd"
                                            d="M2.5 4A1.5 1.5 0 001 5.5V6h18v-.5A1.5 1.5 0 0017.5 4h-15zM19 8.5H1v6A1.5 1.5 0 002.5 16h15a1.5 1.5 0 001.5-1.5v-6zM3 13.25a.75.75 0 01.75-.75h1.5a.75.75 0 010 1.5h-1.5a.75.75 0 01-.75-.75zm4.75-.75a.75.75 0 000 1.5h3.5a.75.75 0 000-1.5h-3.5z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </dt>
                               
                                <dd class="text-sm leading-6 text-gray-500">Paga con:
                                    <div class="ml-2 inline">
                                        <span
                                            class="inline-flex items-center rounded-md bg-blue-50 px-1.5 py-0.5 text-xs font-medium text-blue-700 ring-1 ring-inset ring-blue-700/10">Mercado
                                            Pago</span>
                                    </div>

                                </dd>
                                                      
                            </div>
                            @endcan           
                        </dl>

                    </div>

                    <div class="relative flex items-center space-x-3 ">
                        <dl class="flex flex-wrap space-y-4 my-4">
                            <div class="flex w-full flex-none gap-x-4 ">
                                <dt class="flex-none">
                                    <span class="sr-only">Client</span>

                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                        class="h-6 w-5 text-gray-400">
                                        <path fill-rule="evenodd"
                                            d="M3.75 3.375c0-1.036.84-1.875 1.875-1.875H9a3.75 3.75 0 0 1 3.75 3.75v1.875c0 1.036.84 1.875 1.875 1.875H16.5a3.75 3.75 0 0 1 3.75 3.75v7.875c0 1.035-.84 1.875-1.875 1.875H5.625a1.875 1.875 0 0 1-1.875-1.875V3.375Zm10.5 1.875a5.23 5.23 0 0 0-1.279-3.434 9.768 9.768 0 0 1 6.963 6.963A5.23 5.23 0 0 0 16.5 7.5h-1.875a.375.375 0 0 1-.375-.375V5.25ZM12 10.5a.75.75 0 0 1 .75.75v.028a9.727 9.727 0 0 1 1.687.28.75.75 0 1 1-.374 1.452 8.207 8.207 0 0 0-1.313-.226v1.68l.969.332c.67.23 1.281.85 1.281 1.704 0 .158-.007.314-.02.468-.083.931-.83 1.582-1.669 1.695a9.776 9.776 0 0 1-.561.059v.028a.75.75 0 0 1-1.5 0v-.029a9.724 9.724 0 0 1-1.687-.278.75.75 0 0 1 .374-1.453c.425.11.864.186 1.313.226v-1.68l-.968-.332C9.612 14.974 9 14.354 9 13.5c0-.158.007-.314.02-.468.083-.931.831-1.582 1.67-1.694.185-.025.372-.045.56-.06v-.028a.75.75 0 0 1 .75-.75Zm-1.11 2.324c.119-.016.239-.03.36-.04v1.166l-.482-.165c-.208-.072-.268-.211-.268-.285 0-.113.005-.225.015-.336.013-.146.14-.309.374-.34Zm1.86 4.392V16.05l.482.165c.208.072.268.211.268.285 0 .113-.005.225-.015.336-.012.146-.14.309-.374.34-.12.016-.24.03-.361.04Z"
                                            clip-rule="evenodd" />
                                    </svg>

                                </dt>
                                <a class="text-sm font-medium leading-6 text-indigo-600">Ver comprobantes</a>
                            </div>

                            <div class="flex w-full flex-none gap-x-4">
                                <dt class="flex-none">
                                    <span class="sr-only">Status</span>


                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                        class="h-6 w-5 text-gray-400">
                                        <path fill-rule="evenodd"
                                            d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25ZM12.75 6a.75.75 0 0 0-1.5 0v6c0 .414.336.75.75.75h4.5a.75.75 0 0 0 0-1.5h-3.75V6Z"
                                            clip-rule="evenodd" />
                                    </svg>

                                </dt>
                                <a class="text-sm font-medium leading-6 text-indigo-600">Ver disponibilidad</a>
                            </div>
                        </dl>
                    </div>
                </div>

                <div
                    class="mt-6 mb-1 sm:my-6 rounded-lg border border-gray-300 bg-white px-6 py-5 shadow-sm hover:border-gray-400">
                    <div class="relative flex items-center space-x-3">
                        <div class="flex-shrink-0">
                            <img class="h-10 w-10 rounded-full" src="{{ $principalComment->user->photo }}"
                                alt="{{ $principalComment->user->name }}">
                        </div>
                        <div class="min-w-0 flex-1">
                            <a href="#" class="focus:outline-none">
                                <span class="absolute inset-0" aria-hidden="true"></span>
                                <p class="text-sm font-medium text-gray-900">{{ $principalComment->user->name }}</p>
                                <p class="truncate text-sm text-gray-500">
                                    {{ $principalComment->user->roles->first()->name }}</p>
                            </a>
                        </div>
                    </div>
                    <div class="mt-4 text-pretty text-base text-gray-500">
                        <p>{{ $principalComment->message }}</p>
                    </div>

                    <!-- More people... -->
                </div>
            </div>

            <div class="pb-2 pt-8 sm:py-2">
                <h4 class="sr-only">Status</h4>
                <div class="flex justify-between items-center">
                    {{-- <p class="text-sm font-medium text-gray-900">Preparing to ship on <time datetime="2021-03-24">March
                            24, 2021</time></p> --}}

                    <div class="relative flex items-center">

                        @if ($visit->users->count() > 0)
                            <div class="flex">
                                @foreach ($visit->users as $user)
                                    <img src="{{ $user->photo }}" alt="{{ $user->name }}"
                                        class="h-6 w-6 rounded-full bg-gray-800 shadow-sm border-2 border-white"
                                        style="z-index: {{ $loop->index + 1 }}; margin-left: {{ $loop->index == 0 ? '0' : '-10' }}px;">
                                @endforeach
                            </div>
                            <div class="hidden sm:flex truncate text-sm font-semibold leading-6 text-gray-900 ml-2">
                                @foreach ($visit->users as $user)
                                    {{ $user->name }}{{ $loop->last ? '' : ',' }}
                                @endforeach
                            </div>
                            <div class="flex sm:hidden truncate text-sm font-semibold leading-6 text-gray-900 ml-2">
                                {{ $visit->users[0]->name }}
                                @if ($visit->users->count() > 1)
                                    <span
                                        class="inline-flex items-center gap-x-0.5 rounded-md bg-yellow-100 px-1.5 py-0.5 text-xs font-medium text-yellow-800 ml-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                            fill="currentColor" class="h-3 w-3 text-yellow-800 inline">
                                            <path fill-rule="evenodd"
                                                d="M12 3.75a.75.75 0 0 1 .75.75v6.75h6.75a.75.75 0 0 1 0 1.5h-6.75v6.75a.75.75 0 0 1-1.5 0v-6.75H4.5a.75.75 0 0 1 0-1.5h6.75V4.5a.75.75 0 0 1 .75-.75Z"
                                                clip-rule="evenodd" />
                                        </svg>

                                        {{ $visit->users->count() - 1 }}

                                    </span>
                                @endif
                            </div>
                        @else
                            <div class="flex text-sm font-semibold leading-6 text-gray-900">
                                <span
                                    class="inline-flex items-center gap-x-0.5 rounded-md bg-red-100 px-1.5 py-0.5 text-xs font-medium text-red-800 ml-1 border-red-600">

                                    Sin usuarios asignados
                                </span>
                            </div>

                        @endif





                    </div>
                    {{-- <h3 class="inline text-sm font-semibold leading-6 text-gray-900 ml-2">
                            @foreach ($visit->users as $user)
                                {{ $user->name }}{{ $loop->last ? '' : ',' }}
                            @endforeach
                        </h3> --}}

                </div>


                <div class="mt-6" aria-hidden="true">
                    <div class="overflow-hidden rounded-full bg-gray-200">
                        <div class="h-2 rounded-full {{ $statusColors[$status] }}"
                            style="{{ $progressWidths[$status] }}">
                        </div>
                    </div>
                    <div class="mt-6 grid grid-cols-5 text-sm font-medium text-gray-600 sm:grid">
                        <div class="{{ $status == 0 ? $statusTextColor[$status] . ' font-bold' : '' }}">
                            <span
                                class="text-center {{ $status == 0 ? 'absolute ml-2' : 'hidden' }} sm:inline sm:relative">Pendiente</span>
                        </div>
                        <div
                            class="sm:text-center {{ $status == 1 ? $statusTextColor[$status] . ' font-bold' : '' }}">
                            <span
                                class="text-center {{ $status == 1 ? 'absolute ml-2' : 'hidden' }} sm:inline sm:relative">En
                                camino</span>
                        </div>
                        <div
                            class="sm:text-center {{ $status == 2 ? $statusTextColor[$status] . ' font-bold' : '' }}">

                            <span
                                class="text-center {{ $status == 2 ? 'absolute ml-2' : 'hidden' }} sm:inline sm:relative">En
                                la puerta</span>
                        </div>
                        <div
                            class="sm:text-center {{ $status == 3 ? $statusTextColor[$status] . ' font-bold' : '' }}">
                            <span
                                class="text-center {{ $status == 3 ? 'absolute ml-2' : 'hidden' }} sm:inline sm:relative">En
                                progreso</span>
                        </div>
                        <div
                            class="text-left {{ in_array($status, [4, 5, 6, 7]) ? $statusTextColor[$status] . ' font-bold' : '' }}">
                            @if (in_array($status, [5, 6, 7]))
                                <span
                                    class="{{ $statusTextColor[$status] }} text-left {{ in_array($status, [4, 5, 6, 7]) ? '-ml-3' : 'hidden' }} sm:inline">{{ $finalStatusText[$status] }}</span>
                            @else
                                <span
                                    class="{{ $status == 4 ? $statusTextColor[$status] : '' }} text-left {{ $status == 4 ? '-ml-3' : 'hidden' }} sm:inline ">Completado</span>
                            @endif
                        </div>
                    </div>
                </div>

            @can('access-function', 'visit-comment-add')
                <livewire:panel.property.visit.add-comment :visit="$visit" :principalComment="$principalComment->id" :key="$visit->id" />
            @endcan        


            </div>


        </div>


    </div>





</div>