<div>
    <!-- Información adicional de la visita -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

        <div class="inline-flex text-center items-center gap-x-1">


            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-6 w-5 text-gray-400">
                <path fill-rule="evenodd"
                    d="M7.5 5.25a3 3 0 0 1 3-3h3a3 3 0 0 1 3 3v.205c.933.085 1.857.197 2.774.334 1.454.218 2.476 1.483 2.476 2.917v3.033c0 1.211-.734 2.352-1.936 2.752A24.726 24.726 0 0 1 12 15.75c-2.73 0-5.357-.442-7.814-1.259-1.202-.4-1.936-1.541-1.936-2.752V8.706c0-1.434 1.022-2.7 2.476-2.917A48.814 48.814 0 0 1 7.5 5.455V5.25Zm7.5 0v.09a49.488 49.488 0 0 0-6 0v-.09a1.5 1.5 0 0 1 1.5-1.5h3a1.5 1.5 0 0 1 1.5 1.5Zm-3 8.25a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z"
                    clip-rule="evenodd" />
                <path
                    d="M3 18.4v-2.796a4.3 4.3 0 0 0 .713.31A26.226 26.226 0 0 0 12 17.25c2.892 0 5.68-.468 8.287-1.335.252-.084.49-.189.713-.311V18.4c0 1.452-1.047 2.728-2.523 2.923-2.12.282-4.282.427-6.477.427a49.19 49.19 0 0 1-6.477-.427C4.047 21.128 3 19.852 3 18.4Z" />
            </svg>


            <div class="text-sm leading-6 text-gray-500">
                Servicios:

                <div class="ml-2 inline">
                    @foreach ($visit->services->pluck('name')->take(2) as $service)
                        <span
                            class="inline-flex items-center rounded-md bg-indigo-50 px-1.5 py-0.5 text-xs font-medium text-indigo-700 ring-1 ring-inset ring-indigo-700/10 text-ellipsis overflow-hidden text-nowrap max-w-20">{{ $service }}</span>
                    @endforeach

                    @if(count($visit->services) > 2)
                          <span
                    class="inline-flex items-center rounded-md bg-indigo-50 px-1.5 py-0.5 text-xs font-medium text-indigo-700 ring-1 ring-inset ring-indigo-700/10 has-tooltip">
                    <span class="tooltip text-xs">{{ $visit->services->pluck('name')->skip(2)->implode(', ') }}</span>
                    +{{ count($visit->services) - 2 }}</span>
                    @endif
                </div>
            </div>
        </div>


        <div class="inline-flex text-center items-center gap-x-1">

            <svg class="h-6 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd"
                    d="M2.5 4A1.5 1.5 0 001 5.5V6h18v-.5A1.5 1.5 0 0017.5 4h-15zM19 8.5H1v6A1.5 1.5 0 002.5 16h15a1.5 1.5 0 001.5-1.5v-6zM3 13.25a.75.75 0 01.75-.75h1.5a.75.75 0 010 1.5h-1.5a.75.75 0 01-.75-.75zm4.75-.75a.75.75 0 000 1.5h3.5a.75.75 0 000-1.5h-3.5z"
                    clip-rule="evenodd" />
            </svg>
            <div class="text-sm leading-6 text-gray-500">Paga con:
                <div class="ml-2 inline">
                    <span
                        class="inline-flex items-center rounded-md bg-blue-50 px-1.5 py-0.5 text-xs font-medium text-blue-700 ring-1 ring-inset ring-blue-700/10">Mercado
                        Pago</span>
                </div>

            </div>


        </div>

        <div class="inline-flex text-center items-center gap-x-1">

            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="h-6 w-5 text-gray-400">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M10.125 2.25h-4.5c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125v-9M10.125 2.25h.375a9 9 0 0 1 9 9v.375M10.125 2.25A3.375 3.375 0 0 1 13.5 5.625v1.5c0 .621.504 1.125 1.125 1.125h1.5a3.375 3.375 0 0 1 3.375 3.375M9 15l2.25 2.25L15 12" />
            </svg>



            @if (isset($visit->budget))
                @if ($visit->budget->pdfExists())
                    <a target="_blank" href="{{ $visit->budget->getPdfUrl() }}"
                        class="text-sm font-medium leading-6 text-indigo-600">
                        Ver presupuesto
                    </a>
                @else
                    <span
                        class="inline-flex items-center rounded-md ring-1 ring-inset px-1.5 py-0.5 text-xs font-medium 
                {{ $visit->budget->status->getBadgeClasses() }} 
                {{ $visit->budget->status->getBadgeColorRingClasses() }}">
                        {{ $visit->budget->status->getName() }}
                    </span>
                @endif
            @else
                <span
                    class=" inline-flex items-center rounded-md ring-1 ring-inset px-1.5 py-0.5 text-xs font-medium text-gray-500">
                    Sin presupuesto
                </span>

            @endif

        </div>

        <div class="inline-flex text-center items-center gap-x-1">

            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="h-6 w-5 text-gray-400">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>

            <div class="text-sm leading-6 text-gray-500">Tiempo de visita:
                <div class="ml-2 inline">
                    <span
                        class="inline-flex items-center rounded-md bg-green-50 px-1.5 py-0.5 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-700/10">

                        {{ $visit->duration_time }} minutos

                    </span>
                </div>

            </div>

        </div>

        <div class="inline-flex text-center items-center gap-x-1">

            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="h-6 w-5 text-gray-400">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M2.25 13.5h3.86a2.25 2.25 0 0 1 2.012 1.244l.256.512a2.25 2.25 0 0 0 2.013 1.244h3.218a2.25 2.25 0 0 0 2.013-1.244l.256-.512a2.25 2.25 0 0 1 2.013-1.244h3.859m-19.5.338V18a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18v-4.162c0-.224-.034-.447-.1-.661L19.24 5.338a2.25 2.25 0 0 0-2.15-1.588H6.911a2.25 2.25 0 0 0-2.15 1.588L2.35 13.177a2.25 2.25 0 0 0-.1.661Z" />
            </svg>


            <div class="text-sm leading-6 text-gray-500">Correo:
                <div class="ml-2 inline">
                    <span
                        class="inline-flex items-center rounded-md bg-gray-50 px-1.5 py-0.5 text-xs font-medium text-gray-700 ring-1 ring-inset ring-gray-700/10">

                        {{ $visit->customer->email }}

                    </span>
                </div>

            </div>

        </div>


        <div class="inline-flex text-center items-center gap-x-1">

            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="h-6 w-5 text-gray-400">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Z" />
            </svg>



            <div class="text-sm leading-6 text-gray-500">Propiedad:
                <div class="ml-2 inline">
                    <span
                        class="inline-flex items-center rounded-md bg-gray-50 px-1.5 py-0.5 text-xs font-medium text-gray-700 ring-1 ring-inset ring-gray-700/10">

                        {{ $visit->property->property_name }}

                    </span>
                </div>

            </div>

        </div>





        <div class="inline-flex text-center items-center gap-x-1">


            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="h-6 w-5 text-gray-400">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0 1 18 18.75h-2.25m-7.5-10.5H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125 1.125v9.375m-8.25-3 1.5 1.5 3-3.75" />
            </svg>



            <div class="text-sm leading-6 text-gray-500">Tipo de visita:
                <div class="ml-2 inline">
                    <span
                        class="inline-flex items-center rounded-md bg-gray-50 px-1.5 py-0.5 text-xs font-medium text-gray-700 ring-1 ring-inset ring-gray-700/10">

                        {{ $visit->visitType->name }}

                    </span>
                </div>

            </div>

        </div>

    </div>
</div>
