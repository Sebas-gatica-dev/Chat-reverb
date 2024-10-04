<div>


    <header class="bg-white shadow">
        <div class="mx-auto max-w-screen-2xl px-4 py-6 sm:px-6 lg:px-8">
            <div class="sm:flex sm:items-center sm:justify-between">
                <div class="min-w-0 flex-1">
                    <h1 class="text-2xl font-bold tracking-tight text-gray-900">Busqueda de: "{{ $search }}"</h1>
                </div>


            </div>
        </div>


    </header>



    <div class="mx-auto max-w-screen-2xl md:px-6 lg:px-8">

        <div class="mt-1 flow-root">
            <div class="overflow-x-auto">
                <div class="inline-block min-w-full py-6 align-middle md:px-6 lg:px-8">

                    <div
                        class=" divide-y divide-gray-300 bg-white ring-1 ring-black ring-opacity-5 md:rounded-lg
                    md:shadow">
                        <div>

                            <div class="mt-6 overflow-hidden border-t border-gray-100">

                                @if ($results != [])
                                    <div class="max-w-7xl ">
                                        <div class="px-6">
                                            <table class="w-full text-left mx-12">
                                                <thead class="sr-only">
                                                    <tr>
                                                        <th>Tipo</th>
                                                        <th>Detalles</th>
                                                        <th>Más detalles</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    <!-- Sección de Clientes -->
                                                    @php $clientes = array_filter($results, fn($result) => $result['type'] === 'Cliente'); @endphp
                                                    @if (count($clientes) > 0)
                                                        <tr class="text-sm leading-6 text-gray-900">
                                                            <th scope="colgroup" colspan="3"
                                                                class="relative isolate py-2 font-semibold">
                                                                <time
                                                                    datetime="{{ now()->format('Y-m-d') }}">Clientes</time>
                                                                <div
                                                                    class="absolute inset-y-0 right-full -z-10 w-screen border-b border-gray-200 bg-gray-50">
                                                                </div>
                                                                <div
                                                                    class="absolute inset-y-0 left-0 -z-10 w-screen border-b border-gray-200 bg-gray-50">
                                                                </div>
                                                            </th>
                                                        </tr>


                                                        @foreach ($clientes as $result)
                                                            <tr class="text-sm leading-6 text-gray-900">
                                                                <td class="relative py-5 pr-20">
                                                                    <div class="flex-auto">
                                                                        <div class="rounded-md bg-slate-100 p-4">
                                                                            <div class="flex">
                                                                                <div class="flex-shrink-0">
                                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                                        viewBox="0 0 24 24"
                                                                                        fill="currentColor"
                                                                                        class="h-5 w-5 text-slate-400">
                                                                                        <path fill-rule="evenodd"
                                                                                            d="M10.5 3.75a6.75 6.75 0 1 0 0 13.5 6.75 6.75 0 0 0 0-13.5ZM2.25 10.5a8.25 8.25 0 1 1 14.59 5.28l4.69 4.69a.75.75 0 1 1-1.06 1.06l-4.69-4.69A8.25 8.25 0 0 1 2.25 10.5Z"
                                                                                            clip-rule="evenodd" />
                                                                                    </svg>
                                                                                </div>
                                                                                <div
                                                                                    class="ml-3 flex-1 md:flex md:justify-between">
                                                                                    <p class="text-sm text-slate-700">
                                                                                        Resultado:
                                                                                        <b>{{ $result['value'] }}</b>
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div
                                                                        class="absolute bottom-0 right-full h-px w-screen bg-gray-100">
                                                                    </div>

                                                                    <div
                                                                        class="absolute bottom-0 left-0 h-px w-screen bg-gray-100">
                                                                    </div>
                                                                </td>
                                                                <td class="hidden py-5 pr-6 sm:table-cell">
                                                                    <div class="text-sm leading-6 text-gray-900">
                                                                        {{ $result['data']->name }}
                                                                        {{ $result['data']->surname }}</div>
                                                                    <div class="mt-1 text-xs leading-5 text-gray-500">
                                                                        {{ ucfirst($result['field']) }}</div>
                                                                </td>
                                                                <td class="py-5 text-right">
                                                                    <a wire:navigate
                                                                        href="{{ route('panel.customers.show', $result['data']) }}"
                                                                        class="text-sm font-medium leading-6 text-indigo-600 hover:text-indigo-500">Ver
                                                                        resultado</a>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @endif

                                                    <!-- Sección de Propiedades -->
                                                    @php $propiedades = array_filter($results, fn($result) => $result['type'] === 'Propiedad'); @endphp
                                                    @if (count($propiedades) > 0)
                                                        <tr class="text-sm leading-6 text-gray-900">
                                                            <th scope="colgroup" colspan="3"
                                                                class="relative isolate py-2 font-semibold">
                                                                <time
                                                                    datetime="{{ now()->format('Y-m-d') }}">Propiedades</time>
                                                                <div
                                                                    class="absolute inset-y-0 right-full -z-10 w-screen border-b border-gray-200 bg-gray-50">
                                                                </div>
                                                                <div
                                                                    class="absolute inset-y-0 left-0 -z-10 w-screen border-b border-gray-200 bg-gray-50">
                                                                </div>
                                                            </th>
                                                        </tr>


                                                        @foreach ($propiedades as $result)
                                                            <tr class="text-sm leading-6 text-gray-900">
                                                                <td class="relative py-5 pr-20">
                                                                    <div class="flex-auto">
                                                                        <div class="rounded-md bg-slate-100 p-4">
                                                                            <div class="flex">
                                                                                <div class="flex-shrink-0">
                                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                                        viewBox="0 0 24 24"
                                                                                        fill="currentColor"
                                                                                        class="h-5 w-5 text-slate-400">
                                                                                        <path fill-rule="evenodd"
                                                                                            d="M10.5 3.75a6.75 6.75 0 1 0 0 13.5 6.75 6.75 0 0 0 0-13.5ZM2.25 10.5a8.25 8.25 0 1 1 14.59 5.28l4.69 4.69a.75.75 0 1 1-1.06 1.06l-4.69-4.69A8.25 8.25 0 0 1 2.25 10.5Z"
                                                                                            clip-rule="evenodd" />
                                                                                    </svg>
                                                                                </div>
                                                                                <div
                                                                                    class="ml-3 flex-1 md:flex md:justify-between">
                                                                                    <p class="text-sm text-slate-700">
                                                                                        Resultado:
                                                                                        <b>{{ $result['value'] }}</b>
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div
                                                                        class="absolute bottom-0 right-full h-px w-screen bg-gray-100">
                                                                    </div>

                                                                    <div
                                                                        class="absolute bottom-0 left-0 h-px w-screen bg-gray-100">
                                                                    </div>
                                                                </td>
                                                                <td class="hidden py-5 pr-6 sm:table-cell">
                                                                    <div class="text-sm leading-6 text-gray-900">
                                                                        {{ $result['data']->property_name }} -
                                                                        {{ $result['data']->customer->name }}
                                                                        {{ $result['data']->customer->surname }}</div>
                                                                    <div class="mt-1 text-xs leading-5 text-gray-500">
                                                                        {{ ucfirst($result['field']) }}</div>
                                                                </td>
                                                                <td class="py-5 text-right">
                                                                    <a wire:navigate
                                                                        href="{{ route('panel.customers.property.show', [$result['data']->customer, $result['data']]) }}"
                                                                        class="text-sm font-medium leading-6 text-indigo-600 hover:text-indigo-500">Ver
                                                                        resultado</a>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @endif

                                                    <!-- Sección de Usuarios -->
                                                    @php $usuarios = array_filter($results, fn($result) => $result['type'] === 'Usuario'); @endphp
                                                    @if (count($usuarios) > 0)
                                                        <tr class="text-sm leading-6 text-gray-900">
                                                            <th scope="colgroup" colspan="3"
                                                                class="relative isolate py-2 font-semibold">
                                                                <time
                                                                    datetime="{{ now()->format('Y-m-d') }}">Usuarios</time>
                                                                <div
                                                                    class="absolute inset-y-0 right-full -z-10 w-screen border-b border-gray-200 bg-gray-50">
                                                                </div>
                                                                <div
                                                                    class="absolute inset-y-0 left-0 -z-10 w-screen border-b border-gray-200 bg-gray-50">
                                                                </div>
                                                            </th>
                                                        </tr>
                                                        @foreach ($usuarios as $result)
                                                            <tr class="text-sm leading-6 text-gray-900">
                                                                <td class="relative py-5 pr-20">
                                                                    <div class="flex-auto">
                                                                        <div class="rounded-md bg-slate-100 p-4">
                                                                            <div class="flex">
                                                                                <div class="flex-shrink-0">
                                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                                        viewBox="0 0 24 24"
                                                                                        fill="currentColor"
                                                                                        class="h-5 w-5 text-slate-400">
                                                                                        <path fill-rule="evenodd"
                                                                                            d="M10.5 3.75a6.75 6.75 0 1 0 0 13.5 6.75 6.75 0 0 0 0-13.5ZM2.25 10.5a8.25 8.25 0 1 1 14.59 5.28l4.69 4.69a.75.75 0 1 1-1.06 1.06l-4.69-4.69A8.25 8.25 0 0 1 2.25 10.5Z"
                                                                                            clip-rule="evenodd" />
                                                                                    </svg>
                                                                                </div>
                                                                                <div
                                                                                    class="ml-3 flex-1 md:flex md:justify-between">
                                                                                    <p class="text-sm text-slate-700">
                                                                                        Resultado:
                                                                                        <b>{{ $result['value'] }}</b>
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div
                                                                        class="absolute bottom-0 right-full h-px w-screen bg-gray-100">
                                                                    </div>

                                                                    <div
                                                                        class="absolute bottom-0 left-0 h-px w-screen bg-gray-100">
                                                                    </div>
                                                                </td>
                                                                <td class="hidden py-5 pr-6 sm:table-cell">
                                                                    <div class="text-sm leading-6 text-gray-900">
                                                                        {{ $result['data']->name }}
                                                                        {{ $result['data']->surname }}</div>
                                                                    <div class="mt-1 text-xs leading-5 text-gray-500">
                                                                        {{ ucfirst($result['field']) }}</div>
                                                                </td>
                                                                <td class="py-5 text-right">
                                                                    <a href="#"
                                                                        class="text-sm font-medium leading-6 text-indigo-600 hover:text-indigo-500">Ver
                                                                        resultado</a>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @endif


                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                @else
                                    <div class="rounded-md bg-yellow-50 p-4 text-center">

                                        <div class="flex justify-center">
                                            <div class="mr-1">

                                                <svg class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20"
                                                    fill="currentColor" aria-hidden="true">
                                                    <path fill-rule="evenodd"
                                                        d="M8.485 2.495c.673-1.167 2.357-1.167 3.03 0l6.28 10.875c.673 1.167-.17 2.625-1.516 2.625H3.72c-1.347 0-2.189-1.458-1.515-2.625L8.485 2.495zM10 5a.75.75 0 01.75.75v3.5a.75.75 0 01-1.5 0v-3.5A.75.75 0 0110 5zm0 9a1 1 0 100-2 1 1 0 000 2z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                            <h3 class=" text-center text-sm font-medium text-yellow-800">
                                                No se encontraron resultados para la busqueda "{{ $search }}".</h3>
                                        </div>
                                        <div class="mt-2 text-sm text-yellow-700">
                                            <p>Intenta buscar con otros términos o verifica que la busqueda sea correcta.</p>
                                        </div>
                                    </div>



                            @endif


                        </div>
                    </div>

                </div>


            </div>
        </div>

    </div>

    <div class="pb-6 px-4 sm:px-8">
        {{-- {{ $customers->links(data: ['scrollTo' => false]) }} --}}

    </div>


</div>


</div>
