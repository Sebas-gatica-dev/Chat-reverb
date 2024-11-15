<div>
    <header class="bg-white shadow">
        <div class="mx-auto max-w-screen-2xl px-4 py-6 sm:px-6 lg:px-8">
            <div class="sm:flex sm:items-center sm:justify-between">
                <div class="min-w-0 flex-1">
                    <h1 class="text-2xl font-bold tracking-tight text-gray-900">Lista de organizadores de rutas</h1>
                </div>
                <div class="mt-4 flex md:ml-4 md:mt-0 justify-end">
                    <a wire:navigate href="{{ route('panel.routes.organizer') }}"
                        class="ml-3 inline-flex items-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                        Atrás
                    </a>
                </div>
            </div>
        </div>
    </header>

    <div class="mx-auto max-w-screen-2xl py-6 sm:px-6 lg:px-8">
        <div class="mt-8 flow-root">
            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                    <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-300">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col"
                                        class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                                        Creador de ruta</th>
                                    <th scope="col"
                                        class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                                        Fecha de Inicio</th>
                                    <th scope="col"
                                        class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Fecha de Fin
                                    </th>
                                    <th scope="col"
                                        class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Empleados</th>
                                    <th scope="col"
                                        class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Estado</th>
                                    <th scope="col"
                                        class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Ruta Guardada
                                    </th>
                                    <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                        <span class="sr-only">Acciones</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white" wire:poll.1s="refreshRoutes">
                                @foreach ($routes as $route)
                                    <tr>
                                        <td
                                            class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-500 sm:pl-6">
                                            {{ $route->creator->name }}
                                        </td>
                                        <td
                                            class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-500 sm:pl-6">
                                            {{ $route->start_date }}
                                        </td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                            {{ $route->end_date }}
                                        </td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                            {{ implode(', ', $route->employee_names) }}
                                        </td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm">
                                            @if ($route->status === \App\Enums\AutomaticRoutesStatus::GENERATING->value)
                                                <span
                                                    class="inline-flex items-center gap-x-1.5 rounded-full bg-yellow-100 px-1.5 py-0.5 text-xs font-medium text-yellow-800">
                                                    Generando
                                                </span>
                                            @elseif($route->status === \App\Enums\AutomaticRoutesStatus::COMPLETED->value)
                                                <span
                                                    class="inline-flex items-center gap-x-1.5 rounded-full bg-green-100 px-1.5 py-0.5 text-xs font-medium text-green-700">
                                                    Completado
                                                </span>
                                            @elseif($route->status === \App\Enums\AutomaticRoutesStatus::FAILURE->value)
                                                <span
                                                    class="inline-flex items-center gap-x-1.5 rounded-full bg-red-100 px-1.5 py-0.5 text-xs font-medium text-red-700">
                                                    Fallido
                                                </span>
                                            @else
                                                <span
                                                    class="inline-flex items-center gap-x-1.5 rounded-full bg-blue-100 px-1.5 py-0.5 text-xs font-medium text-blue-700">
                                                    En progreso
                                                </span>
                                            @endif
                                        </td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm">
                                            @if ($route->route_saved)
                                                <span
                                                    class="inline-flex items-center gap-x-1.5 rounded-full bg-green-100 px-1.5 py-0.5 text-xs font-medium text-green-700">
                                                    Guardado
                                                </span>
                                            @else
                                                <span
                                                    class="inline-flex items-center gap-x-1.5 rounded-full bg-gray-100 px-1.5 py-0.5 text-xs font-medium text-gray-600">
                                                    No guardado
                                                </span>
                                            @endif
                                        </td>
                                        <td
                                            class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">


                                            @if ($route->status === \App\Enums\AutomaticRoutesStatus::COMPLETED->value && !$route->route_saved)
                                                <button wire:click="goToRouteOrganizer('{{ $route->id }}')"
                                                    class="text-indigo-600 hover:text-indigo-900">
                                                    Previsualizar
                                                </button>
                                                @elseif($route->route_saved)
                                                <button wire:click="goToRouteOrganizer('{{ $route->id }}')"
                                                    class="text-indigo-600 hover:text-indigo-900">
                                                    Editar
                                                </button>
                                            @else
                                                <x-spinner>

                                                    {{ $route->progress }}%

                                                </x-spinner>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
