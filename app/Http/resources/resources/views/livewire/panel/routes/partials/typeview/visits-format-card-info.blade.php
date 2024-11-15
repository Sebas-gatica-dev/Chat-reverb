<div>
    <!-- Información adicional de la visita -->
    <div class="grid grid-cols-1 gap-y-4 px-4">
        <!-- Cada ítem de información -->
        <!-- Por ejemplo, Servicios -->

        <div class="flex items-center text-center gap-x-2">


            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="h-5 w-5 text-gray-400">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
            </svg>


            <a href="{{ route('panel.customers.property.show', [$visit->customer_id, $visit->property_id]) }}"
                wire:navigate>
                <div class="text-sm text-gray-500">
                    <span class="font-medium">Cliente:</span>

                    <span class="inline-flex items-center text-gray-600">
                        {{ $visit->customer->name }}
                    </span>

                </div>
            </a>
        </div>


        <div class="flex items-center text-center w-full overflow-hidden ">
            <a href="https://maps.google.com/?q={{ $visit->property->latitude }},{{ $visit->property->longitude }}" target="_blank" class="font-semibold flex-1">
                
                <div class="text-sm text-gray-500 w-full flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="h-5 w-5 text-gray-400 flex-shrink-0">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M8.25 21v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21m0 0h4.5V3.545M12.75 21h7.5V10.75M2.25 21h1.5m18 0h-18M2.25 9l4.5-1.636M18.75 3l-1.5.545m0 6.205 3 1m1.5.5-1.5-.5M6.75 7.364V3h-3v18m3-13.636 10.5-3.819"/>
                    </svg>
                    <span class="font-medium flex-shrink-0 ml-2 mr-1">Dirección:</span>
                    <span class="inline-flex items-center text-gray-600 truncate whitespace-nowrap w-full">
                        {{ $visit->property->address }}
                    </span>
                </div>
            </a>
        </div>
        
    

        <div class="flex items-center text-center gap-x-2">



            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" 
            class="h-5 w-5 text-gray-400">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z" />
              </svg>
              



            <div class="text-sm text-gray-500">

                <span class="font-medium">Precio:</span>
                <span class="inline-flex items-center text-gray-600">
                    ${{ $visit->price }}
                </span>
            </div>


        </div>


        <div class="flex items-center text-center gap-x-2"">


            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="h-5 w-5 text-gray-400">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M10.125 2.25h-4.5c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125v-9M10.125 2.25h.375a9 9 0 0 1 9 9v.375M10.125 2.25A3.375 3.375 0 0 1 13.5 5.625v1.5c0 .621.504 1.125 1.125 1.125h1.5a3.375 3.375 0 0 1 3.375 3.375M9 15l2.25 2.25L15 12" />
            </svg>


            <div class="text-sm text-gray-500">
                <span class="font-medium">Estado:</span>

                <span
                    class="inline-flex items-center rounded-md px-2 py-0.5 text-xs font-medium 
                        {{ $visit->status->getTextClasses() }}
                         {{ $visit->status->getBgClasses() }}
                        ">
                    {{ $visit->status->getStatus($visit->status) }}
                </span>

            </div>
        </div>


        <div class="flex items-center text-center gap-x-2"">



            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="h-5 w-5 text-gray-400">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M10.5 1.5H8.25A2.25 2.25 0 0 0 6 3.75v16.5a2.25 2.25 0 0 0 2.25 2.25h7.5A2.25 2.25 0 0 0 18 20.25V3.75a2.25 2.25 0 0 0-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3" />
            </svg>

            <div class="text-sm text-gray-500">
                <span class="font-medium">Telefono:</span>
                @if ($visit->customer->phones->count() > 0)
                    <span
                        class="inline-flex items-center rounded-md px-2 py-0.5 text-xs font-medium
                            bg-green-50 text-green-700 ">
                        {{ $visit->customer->phones->first()->number }}
                    </span>
                @else
                    <span
                        class="inline-flex items-center rounded-md bg-red-50 px-2 py-0.5 text-xs font-mediumbg-red-50 text-red-700">
                        Sin telefono
                    </span>
                @endif
            </div>
        </div>


        <div class="flex items-center text-center gap-x-2"">

            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-5 w-5 text-gray-400">
                <path fill-rule="evenodd"
                    d="M7.5 5.25a3 3 0 0 1 3-3h3a3 3 0 0 1 3 3v.205c.933.085 1.857.197 2.774.334 1.454.218 2.476 1.483 2.476 2.917v3.033c0 1.211-.734 2.352-1.936 2.752A24.726 24.726 0 0 1 12 15.75c-2.73 0-5.357-.442-7.814-1.259-1.202-.4-1.936-1.541-1.936-2.752V8.706c0-1.434 1.022-2.7 2.476-2.917A48.814 48.814 0 0 1 7.5 5.455V5.25Zm7.5 0v.09a49.488 49.488 0 0 0-6 0v-.09a1.5 1.5 0 0 1 1.5-1.5h3a1.5 1.5 0 0 1 1.5 1.5Zm-3 8.25a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z"
                    clip-rule="evenodd" />
                <path
                    d="M3 18.4v-2.796a4.3 4.3 0 0 0 .713.31A26.226 26.226 0 0 0 12 17.25c2.892 0 5.68-.468 8.287-1.335.252-.084.49-.189.713-.311V18.4c0 1.452-1.047 2.728-2.523 2.923-2.12.282-4.282.427-6.477.427a49.19 49.19 0 0 1-6.477-.427C4.047 21.128 3 19.852 3 18.4Z" />
            </svg>

            <div class="text-sm text-gray-500">
                <span class="font-medium">Servicios:</span>
                @foreach ($visit->services->pluck('name') as $service)
                    <span
                        class="inline-flex items-center rounded-md bg-indigo-50 px-2 py-0.5 text-xs font-medium text-indigo-700">
                        {{ $service }}
                    </span>
                @endforeach
            </div>
        </div>


        <div class="flex items-center text-center gap-x-2"">



            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" 
            class="h-5 w-5 text-gray-400">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m3.75 9v7.5m2.25-6.466a9.016 9.016 0 0 0-3.461-.203c-.536.072-.974.478-1.021 1.017a4.559 4.559 0 0 0-.018.402c0 .464.336.844.775.994l2.95 1.012c.44.15.775.53.775.994 0 .136-.006.27-.018.402-.047.539-.485.945-1.021 1.017a9.077 9.077 0 0 1-3.461-.203M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
              </svg>
              

            <div class="text-sm text-gray-500">
                <span class="font-medium">Pago esperado:</span>
              
                    <span
                        class="inline-flex items-center rounded-md bg-indigo-50 px-2 py-0.5 text-xs font-medium text-indigo-700">
                        {{ $visit->expected_payment->getName() }}
                    </span>
        
            </div>
        </div>

        <div class="flex items-center text-center gap-x-2"">



            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
            stroke="currentColor" class="h-5 w-5 text-gray-400">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0 1 18 18.75h-2.25m-7.5-10.5H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125 1.125v9.375m-8.25-3 1.5 1.5 3-3.75" />
        </svg>

            <div class="text-sm text-gray-500">
                <span class="font-medium">Tipo de visita:</span>
              
                <span
                class="inline-flex items-center rounded-md bg-gray-50 px-1.5 py-0.5 text-xs font-medium text-gray-700 ring-1 ring-inset ring-gray-700/10">

                {{ $visit->visitType->name }}

            </span>
        
            </div>
        </div>

        <div class="flex items-center text-center gap-x-2"">



            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
            stroke="currentColor" class="h-5 w-5 text-gray-400">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
        </svg>
    

            <div class="text-sm text-gray-500">
                <span class="font-medium">Duración de visita:</span>
              
                <span
                class="inline-flex items-center rounded-md bg-gray-50 px-1.5 py-0.5 text-xs font-medium text-gray-700 ring-1 ring-inset ring-gray-700/10">

                {{ $visit->duration_time  }}

            </span>
        
            </div>
        </div>


        <div class="flex items-center text-center gap-x-2"">



            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="h-5 w-5 text-gray-400">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Z" />
            </svg>
    

            <div class="text-sm text-gray-500">
                <span class="font-medium">Propiedad:</span>
              
                <span
                class="inline-flex items-center rounded-md bg-gray-50 px-1.5 py-0.5 text-xs font-medium text-gray-700 ring-1 ring-inset ring-gray-700/10">

                {{ $visit->property->property_name }}

            </span>
        
            </div>
        </div>


    </div>
</div>
