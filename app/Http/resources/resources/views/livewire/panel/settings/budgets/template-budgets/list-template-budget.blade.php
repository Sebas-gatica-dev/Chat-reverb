<div>
    <div class="mx-auto max-w-screen-2xl pt-2 lg:flex lg:gap-x-16 lg:px-8">
        <h1 class="sr-only">Configuración de plantillas presupuestarias</h1>

        <aside class="flex overflow-x-auto border-b border-gray-900/5 py-4 lg:block lg:w-64 lg:flex-none lg:border-0 lg:py-20">
            @include('components.panel.settings.menu-side-bar-settings')
        </aside>

        <main class="px-4 py-16 sm:px-6 lg:flex-auto lg:px-0 lg:py-20">
            <div class="mx-auto max-w-2xl space-y-16 sm:space-y-20 lg:mx-0 lg:max-w-none">

                <div class="sm:flex sm:items-center">
                    <div class="sm:flex-auto">
                        <h1 class="text-base font-semibold leading-6 text-gray-900">Plantillas Presupuestarias</h1>
                        <p class="mt-2 text-sm text-gray-700">Administra las plantillas presupuestarias de tu empresa.</p>
                    </div>
                    <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                        <a href="{{ route('panel.settings.budgets.template.create') }}" wire:navigate
                            class="cursor-pointer block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                            Agregar plantilla
                        </a>
                    </div>
                </div>

                <div class="mt-8 flow-root">
                    <div class="-mx-4 -mt-2 mb-4 overflow-x-auto sm:-mx-6 lg:mx-0 sm:shadow sm:rounded-lg bg-white border-t border-gray-200">
                        <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-4">
                            <table class="min-w-full divide-y divide-gray-300">
                                <thead>
                                    <tr>
                                        <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">
                                            Nombre
                                        </th>
                                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                            Estado
                                        </th>
                                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                            Descripción
                                        </th>
                                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                            Total
                                        </th>
                                        <th scope="col" class="relative py-3.5 text-right font-semibold pl-3 pr-16">
                                            <span class="sr-only">Acciones</span>
                                        </th>
                                    </tr>
                                </thead>

                                <tbody class="divide-y divide-gray-200">
                                   
                                    @forelse ($templates as $template)
                                        <div wire:key="{{ $template->id }}">
                                            <tr>
                                                <!-- Nombre -->
                                                <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-0">
                                                    {{ $template->name }}
                                                </td>

                                                <!-- Estado -->
                                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                    <div class="flex items-center gap-x-2">
                                                        @if ($template->deleted_at)
                                                            <div class="flex-none rounded-full bg-rose-400/10 p-1 text-rose-400">
                                                                <div class="h-1.5 w-1.5 rounded-full bg-current"></div>
                                                            </div>
                                                            <div>Inactiva</div>
                                                        @else
                                                            <div class="flex-none rounded-full bg-green-400/10 p-1 text-green-400">
                                                                <div class="h-1.5 w-1.5 rounded-full bg-current"></div>
                                                            </div>
                                                            <div>Activa</div>
                                                        @endif
                                                    </div>
                                                </td>

                                                <!-- Descripción -->
                                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                    @if ($template->description)
                                                        <span title="{{ $template->description }}">
                                                            {{ Str::limit($template->description, 30, '...') }}
                                                        </span>
                                                    @else
                                                        <span class="inline-flex items-center rounded-md bg-gray-100 px-2 py-1 text-xs font-medium text-gray-800">
                                                            Sin descripción
                                                        </span>
                                                    @endif
                                                </td>


                                                <!-- Total -->

                                                <td class="whitespace nowrap px-3 py-4 text-sm text-gray-500">
                                                    ${{ number_format($template->total, 0, ',', '.') }}
                                                </td>

                                                <!-- Acciones -->
                                                <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-0 flex items-center">
                                                    @if ($template->deleted_at)
                                                        <button wire:click="forceDeleteTemplate('{{ $template->id }}')"
                                                            wire:confirm="¿Estás seguro de que deseas eliminar esta plantilla?"
                                                            class="text-red-600 hover:text-red-900">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                                class="size-6">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
                                                            </svg>
                                                        </button>

                                                        <button wire:click="restoreTemplate('{{ $template->id }}')"
                                                            class="text-green-600 hover:text-green-900 ml-4">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                                class="size-6">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                                            </svg>
                                                        </button>
                                                    @else
                                                        <div class="inline-flex">
                                                            <a href="{{ route('panel.settings.budgets.template.edit', $template->id) }}"
                                                                wire:navigate
                                                                class="text-indigo-600 hover:text-indigo-900">
                                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                                    class="size-6">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                                                </svg>
                                                            </a>

                                                            <button wire:click="deleteTemplate('{{ $template->id }}')"
                                                                class="text-red-600 hover:text-red-900 ml-4 inline-flex">
                                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                                    class="size-6">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        d="M5.636 5.636a9 9 0 1 0 12.728 0M12 3v9" />
                                                                </svg>
                                                            </button>
                                                        </div>
                                                    @endif
                                                </td>
                                            </tr>
                                        </div>
                                    @empty
                                        <tr>
                                            <td colspan="12" class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-500">
                                                No hay plantillas presupuestarias registradas.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    {{ $templates->links(data: ['scrollTo' => false]) }}
                </div>
            </div>
        </main>
    </div>
</div>
