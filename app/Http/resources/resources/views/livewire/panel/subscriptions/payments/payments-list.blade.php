<div>
    <div>
        <header class="bg-white shadow">
            <div class="mx-auto max-w-screen-2xl px-4 py-6 sm:px-6 lg:px-8">
                <div class="md:flex md:items-center md:justify-between">
                    <div class="min-w-0 flex-1">
                        <h1 class="text-2xl font-bold tracking-tight text-gray-900">Pagos de suscripciones</h1>
                    </div>
                    <div class="mt-4 flex md:ml-4 md:mt-0">
                        <a wire:navigate href="{{ route('panel.first-steps.plan') }}"
                            class="inline-flex items-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">Volver</a>

                        {{-- <button type="button" class="ml-3 inline-flex items-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Agregar cliente</button> --}}
                    </div>
                </div>
            </div>


        </header>

        <div class="mx-auto max-w-screen-2xl px-6 lg:px-8">


                <dl class="mt-5 grid grid-cols-1 gap-6 sm:grid-cols-3">
                  <div class="overflow-hidden rounded-lg bg-white px-4 py-5 shadow sm:p-6">
                    <dt class="truncate text-sm font-medium text-gray-500">Plan actual</dt>
                    <dd class="mt-1 text-3xl font-semibold tracking-tight text-gray-900">Unipersonal</dd>
                  </div>
                  <div class="overflow-hidden rounded-lg bg-white px-4 py-5 shadow sm:p-6">
                    <dt class="truncate text-sm font-medium text-gray-500">Estado</dt>
                    <dd class="mt-1 text-3xl font-semibold tracking-tight text-gray-900 flex items-center">
                            Activo
                            <span class="relative h-3 w-3 inline-flex ml-3">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-3 w-3 bg-green-500"></span>
                              </span>
                    </dd>
                  </div>
                  <div class="overflow-hidden rounded-lg bg-white px-4 py-5 shadow sm:p-6">
                    <dt class="truncate text-sm font-medium text-gray-500">Vencimiento</dt>
                    <dd class="mt-1 text-3xl font-semibold tracking-tight text-gray-900">31 de mayo, 2024</dd>
                  </div>
                </dl>
              </div>

        <main>

            <div class="mx-auto mt-8 max-w-screen-2xl px-6 sm:mt-6 lg:px-8">

                <ul role="list" class="grid grid-cols-1 gap-x-6 gap-y-8 lg:grid-cols-3">
                    <li class="overflow-hidden rounded-xl border bg-white border-gray-200" x-data="{ open: false }" x-cloak>
                        <div class="flex items-center gap-x-4 border-b border-gray-900/5 bg-white p-6">
                            <img src="https://asset.brandfetch.io/id4J-eZGRh/idheOMrLg2.jpeg?updated=1711727381149" alt="Tuple"
                                class="h-12 w-12 flex-none rounded-lg bg-white object-cover ring-1 ring-gray-900/10">
                            <div class="text-sm font-medium leading-6 text-gray-900">Plan "unipersonal"</div>
                            <div class="relative ml-auto">
                                <button type="button" class="-m-2.5 block p-2.5 text-gray-400 hover:text-gray-500"
                                    id="options-menu-0-button" aria-expanded="false" aria-haspopup="true" @click="open = !open">
                                    <span class="sr-only">Open options</span>
                                    <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path
                                            d="M3 10a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0zM8.5 10a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0zM15.5 8.5a1.5 1.5 0 100 3 1.5 1.5 0 000-3z" />
                                    </svg>
                                </button>

                                <div class="absolute right-0 z-10 mt-0.5 w-32 origin-top-right rounded-md bg-white py-2 shadow-lg ring-1 ring-gray-900/5 focus:outline-none"
                                    role="menu" aria-orientation="vertical" aria-labelledby="options-menu-0-button"
                                    tabindex="-1" x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-100"
                                    x-transition:enter-start="transform opacity-0 scale-95"
                                    x-transition:enter-end="transform opacity-100 scale-100"
                                    x-transition:leave="transition ease-in duration-75"
                                    x-transition:leave-start="transform opacity-100 scale-100"
                                    x-transition:leave-end="transform opacity-0 scale-95">

                                    <a href="#" class="block px-3 py-1 text-sm leading-6 text-gray-900"
                                        role="menuitem" tabindex="-1" id="options-menu-0-item-0">Ver factura<span
                                            class="sr-only">Ver factura</span></a>
                                    <a href="#" class="block px-3 py-1 text-sm leading-6 text-gray-900"
                                        role="menuitem" tabindex="-1" id="options-menu-0-item-1">Edit<span
                                            class="sr-only">, Tuple</span></a>
                                </div>
                            </div>
                        </div>
                        <dl class="-my-3 divide-y divide-gray-100 px-6 py-4 text-sm leading-6">
                            <div class="flex justify-between gap-x-4 py-3">
                                <dt class="text-gray-500">Pago realizado</dt>
                                <dd class="text-gray-700"><time datetime="2022-12-13">31 de mayo, 2024</time></dd>
                            </div>
                            <div class="flex justify-between gap-x-4 py-3">
                                <dt class="text-gray-500">Monto abonado</dt>
                                <dd class="flex items-start gap-x-2">
                                    <div class="font-medium text-gray-900">$35.000</div>
                                    <div
                                        class="rounded-md py-1 px-2 text-xs font-medium ring-1 ring-inset text-red-700 bg-red-50 ring-red-600/10">
                                        Rechazado</div>
                                </dd>
                            </div>
                        </dl>
                    </li>

                    <li class="overflow-hidden rounded-xl border border-gray-200" x-data="{ open: false }" x-cloak>
                        <div class="flex items-center gap-x-4 border-b border-gray-900/5 bg-gray-50 p-6">
                            <img src="https://asset.brandfetch.io/id4J-eZGRh/idheOMrLg2.jpeg?updated=1711727381149" alt="Tuple"
                                class="h-12 w-12 flex-none rounded-lg bg-white object-cover ring-1 ring-gray-900/10">
                            <div class="text-sm font-medium leading-6 text-gray-900">Plan "unipersonal"</div>
                            <div class="relative ml-auto">
                                <button type="button" class="-m-2.5 block p-2.5 text-gray-400 hover:text-gray-500"
                                    id="options-menu-0-button" aria-expanded="false" aria-haspopup="true" @click="open = !open">
                                    <span class="sr-only">Open options</span>
                                    <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path
                                            d="M3 10a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0zM8.5 10a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0zM15.5 8.5a1.5 1.5 0 100 3 1.5 1.5 0 000-3z" />
                                    </svg>
                                </button>

                                <div class="absolute right-0 z-10 mt-0.5 w-32 origin-top-right rounded-md bg-white py-2 shadow-lg ring-1 ring-gray-900/5 focus:outline-none"
                                    role="menu" aria-orientation="vertical" aria-labelledby="options-menu-0-button"
                                    tabindex="-1" x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-100"
                                    x-transition:enter-start="transform opacity-0 scale-95"
                                    x-transition:enter-end="transform opacity-100 scale-100"
                                    x-transition:leave="transition ease-in duration-75"
                                    x-transition:leave-start="transform opacity-100 scale-100"
                                    x-transition:leave-end="transform opacity-0 scale-95">

                                    <a href="#" class="block px-3 py-1 text-sm leading-6 text-gray-900"
                                        role="menuitem" tabindex="-1" id="options-menu-0-item-0">View<span
                                            class="sr-only">, Tuple</span></a>
                                    <a href="#" class="block px-3 py-1 text-sm leading-6 text-gray-900"
                                        role="menuitem" tabindex="-1" id="options-menu-0-item-1">Edit<span
                                            class="sr-only">, Tuple</span></a>
                                </div>
                            </div>
                        </div>
                        <dl class="-my-3 divide-y divide-gray-100 px-6 py-4 text-sm leading-6">
                            <div class="flex justify-between gap-x-4 py-3">
                                <dt class="text-gray-500">Pago realizado</dt>
                                <dd class="text-gray-700"><time datetime="2022-12-13">31 de abril, 2024</time></dd>
                            </div>
                            <div class="flex justify-between gap-x-4 py-3">
                                <dt class="text-gray-500">Monto abonado</dt>
                                <dd class="flex items-start gap-x-2">
                                    <div class="font-medium text-gray-900">$32.000</div>
                                    <div
                                        class="rounded-md py-1 px-2 text-xs font-medium ring-1 ring-inset text-green-700 bg-green-50 ring-green-600/20">
                                        Aceptado</div>
                                </dd>
                            </div>
                        </dl>
                    </li>


                    <li class="overflow-hidden rounded-xl border border-gray-200" x-data="{ open: false }" x-cloak>
                        <div class="flex items-center gap-x-4 border-b border-gray-900/5 bg-gray-50 p-6">
                            <img src="https://asset.brandfetch.io/id4J-eZGRh/idheOMrLg2.jpeg?updated=1711727381149" alt="Tuple"
                                class="h-12 w-12 flex-none rounded-lg bg-white object-cover ring-1 ring-gray-900/10">
                            <div class="text-sm font-medium leading-6 text-gray-900">Plan "unipersonal"</div>
                            <div class="relative ml-auto">
                                <button type="button" class="-m-2.5 block p-2.5 text-gray-400 hover:text-gray-500"
                                    id="options-menu-0-button" aria-expanded="false" aria-haspopup="true" @click="open = !open">
                                    <span class="sr-only">Open options</span>
                                    <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path
                                            d="M3 10a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0zM8.5 10a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0zM15.5 8.5a1.5 1.5 0 100 3 1.5 1.5 0 000-3z" />
                                    </svg>
                                </button>

                                <div class="absolute right-0 z-10 mt-0.5 w-32 origin-top-right rounded-md bg-white py-2 shadow-lg ring-1 ring-gray-900/5 focus:outline-none"
                                    role="menu" aria-orientation="vertical" aria-labelledby="options-menu-0-button"
                                    tabindex="-1" x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-100"
                                    x-transition:enter-start="transform opacity-0 scale-95"
                                    x-transition:enter-end="transform opacity-100 scale-100"
                                    x-transition:leave="transition ease-in duration-75"
                                    x-transition:leave-start="transform opacity-100 scale-100"
                                    x-transition:leave-end="transform opacity-0 scale-95">

                                    <a href="#" class="block px-3 py-1 text-sm leading-6 text-gray-900"
                                        role="menuitem" tabindex="-1" id="options-menu-0-item-0">View<span
                                            class="sr-only">, Tuple</span></a>
                                    <a href="#" class="block px-3 py-1 text-sm leading-6 text-gray-900"
                                        role="menuitem" tabindex="-1" id="options-menu-0-item-1">Edit<span
                                            class="sr-only">, Tuple</span></a>
                                </div>
                            </div>
                        </div>
                        <dl class="-my-3 divide-y divide-gray-100 px-6 py-4 text-sm leading-6">
                            <div class="flex justify-between gap-x-4 py-3">
                                <dt class="text-gray-500">Pago realizado</dt>
                                <dd class="text-gray-700"><time datetime="2022-12-13">31 de abril, 2024</time></dd>
                            </div>
                            <div class="flex justify-between gap-x-4 py-3">
                                <dt class="text-gray-500">Monto abonado</dt>
                                <dd class="flex items-start gap-x-2">
                                    <div class="font-medium text-gray-900">$32.000</div>
                                    <div
                                        class="rounded-md py-1 px-2 text-xs font-medium ring-1 ring-inset text-yellow-700 bg-yellow-50 ring-yellow-600/20">
                                        Pendiente</div>
                                </dd>
                            </div>
                        </dl>
                    </li>

                </ul>


            </div>

        </main>
    </div>
