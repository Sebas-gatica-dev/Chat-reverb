<div>
    <div class="mx-auto max-w-screen-2xl pt-2 lg:flex lg:gap-x-16 lg:px-8">
        <h1 class="sr-only">Configuración de documentos presupuestarios</h1>

        <aside
            class="flex overflow-x-auto border-b border-gray-900/5 py-4 lg:block lg:w-64 lg:flex-none lg:border-0 lg:py-20">
            @include('components.panel.settings.menu-side-bar-settings')
        </aside>

        <main class="px-4 py-16 sm:px-6 lg:flex-auto lg:px-0 lg:py-20">
            <div class="mx-auto max-w-2xl space-y-16 sm:space-y-20 lg:mx-0 lg:max-w-none">

                <div class="sm:flex sm:items-center">
                    <div class="sm:flex-auto">
                        <h1 class="text-base font-semibold leading-6 text-gray-900">Documentos presupuestarios</h1>
                        <p class="mt-2 text-sm text-gray-700">Administra tus documentos presupuestarios de tu empresa.
                        </p>
                    </div>
                    <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                        <a href="{{ route('panel.settings.budgets.documents.create') }}" wire:navigate
                            class="cursor-pointer block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                            Agregar documento
                        </a>
                    </div>
                </div>

                <div class="mt-8 flow-root">
                    <div
                        class="-mx-4 -mt-2 mb-4 overflow-x-auto sm:-mx-6 lg:mx-0 sm:shadow sm:rounded-lg bg-white border-t border-gray-200">
                        <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-4">
                            <table class="min-w-full divide-y divide-gray-300">
                                <thead>
                                    <tr>
                                        <th scope="col"
                                            class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">
                                            Nombre
                                        </th>
                                        <th scope="col"
                                            class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                            Descripción
                                        </th>
                                        <th scope="col" class="relative py-3.5 text-right font-semibold pl-3 pr-16">
                                            <span class="sr-only">Acciones</span>
                                        </th>
                                    </tr>
                                </thead>

                                <tbody class="divide-y divide-gray-200">
                                    @forelse ($pdfResources as $pdfResource)
                                        <div wire:key="{{ $pdfResource->id }}">
                                            <tr>
                                                <!-- Nombre -->
                                                <td
                                                    class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-0">
                                                    {{ $pdfResource->name }}
                                                </td>


                                                <!-- Descripción -->
                                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                    @if ($pdfResource->description)
                                                        <span title="{{ $pdfResource->description }}">
                                                            {{ Str::limit($pdfResource->description, 30, '...') }}
                                                        </span>
                                                    @else
                                                        <span
                                                            class="inline-flex items-center rounded-md bg-gray-100 px-2 py-1 text-xs font-medium text-gray-800">
                                                            Sin descripción
                                                        </span>
                                                    @endif
                                                </td>

                                                <!-- Acciones -->
                                                <td
                                                    class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-0 flex items-center">

                                                    <button wire:click="deletePdfResource('{{ $pdfResource->id }}')"
                                                        wire:confirm="¿Estás seguro de que deseas eliminar este documento?"
                                                        class="text-red-600 hover:text-red-900">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                            class="size-6">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
                                                        </svg>
                                                    </button>


                                                </td>
                                            </tr>
                                        </div>
                                    @empty
                                        <tr>
                                            <td colspan="12"
                                                class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-500">
                                                No hay documentos presupuestarios registradas.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    {{ $pdfResources->links(data: ['scrollTo' => false]) }}
                </div>
            </div>
        </main>
    </div>
</div>
