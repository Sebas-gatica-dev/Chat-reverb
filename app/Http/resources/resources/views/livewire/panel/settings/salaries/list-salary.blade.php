<div>
    <div class="mx-auto max-w-screen-2xl pt-2 lg:flex lg:gap-x-16 lg:px-8">
        <h1 class="sr-only">Lista de salarios</h1>
        <aside
            class="flex overflow-x-auto border-b border-gray-900/5 py-4 lg:block lg:w-64 lg:flex-none lg:border-0 lg:py-20">
            @include('components.panel.settings.menu-side-bar-settings')
        </aside>
        <main class="px-4 py-16 sm:px-6 lg:flex-auto lg:px-0 lg:pt-20">
            <div class="mx-auto max-w-2xl space-y-4 sm:space-y-4 lg:mx-0 lg:max-w-none">
                <div class="sm:flex sm:items-center">
                    <div class="sm:flex-auto">
                        <h1 class="text-base font-semibold leading-6 text-gray-900">Salarios</h1>
                        <p class="mt-2 text-sm text-gray-700">Vas a poder configurar detalladamente la ganancia de cada
                            trabajador de tu empresa.</p>
                    </div>
                    <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                        <a wire:navigate href="{{ route('panel.settings.salaries.create') }}"
                            class="cursor-pointer block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                            Crear un salario
                        </a>
                    </div>
                </div>

                <div class="mt-8 flow-root">

                    <ul role="list" class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3 mt-10">
                        @forelse ($salaries as $salary)
                            <li
                                class="col-span-1 divide-y divide-gray-200 rounded-lg bg-white shadow h-full flex flex-col text-sm">
                                <div class="flex w-full items-center justify-between space-x-6 p-6">
                                    <div class="flex-1 truncate">
                                        <div class="flex items-center space-x-4">
                                            <h3 class="truncate text-sm font-medium text-gray-900">
                                                {{ $salary->user->name }}
                                                @forelse($salary->user->roles as $role)
                                                    <span
                                                        class=" ml-1 inline-flex shrink-0 items-center rounded-full bg-green-50 px-1.5 py-0.5 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20">{{ $role->name }}</span>
                                                @empty
                                                @endforelse
                                            </h3>
                                        </div>
                                        <p class="mt-1 truncate text-sm text-gray-500">{{ $salary->user->email }}</p>
                                    </div>
                                    <img class="h-10 w-10 shrink-0 rounded-full bg-gray-300"
                                        src="{{ $salary->user->photo }}" alt="">
                                </div>
                                <div class="divide-y divide-gray-200 px-4">

                                    <div class="flex justify-between items-center gap-x-4 p-3">
                                        <dt class="text-gray-500">Ganancia por:</dt>
                                        <div
                                            class="rounded-md bg-green-50 px-2 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20">
                                            {{ $salary->type->getName() }}</div>
                                    </div>

                                    @if ($salary->type->value == 'percentage' || $salary->type->value == 'commissions')
                                        <div class="flex justify-between gap-x-4 p-3">
                                            <dt class="text-gray-500">Sobre
                                                {{ Str::lower($salary->profit_of->getName()) }}:</dt>
                                            <div
                                                class="rounded-md bg-green-50 px-2 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20">
                                                {{ $salary->modally_profit->getName() }}</div>
                                        </div>


                                        <div class="flex justify-between gap-x-4 p-3">
                                            <dt class="text-gray-500">{{ $salary->type->getName() }}:</dt>
                                            <dd class="flex items-start gap-x-2">
                                                <div class="font-medium text-gray-900">

                                                    <div
                                                        class="rounded-md bg-green-50 px-2 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20">
                                                        {{ $salary->getTypeValueDisplayFormatAttribute }}</div>

                                            </dd>
                                        </div>
                                    @endif

                                    @if ($salary->taxes_value > 0)
                                        <div class="flex justify-between gap-x-4 p-3">
                                            <dt class="text-gray-500">Impuestos:</dt>
                                            <dd class="flex items-center gap-x-2">
                                                {{-- <div class="font-medium text-gray-900 ">{{ $salary->taxes->getName() }}</div> --}}
                                                {{-- @dump($salary->taxes_value) --}}

                                                <div
                                                    class="rounded-md bg-green-50 px-2 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20">
                                                    {{ $salary->getTaxDisplayFormatAttribute }}</div>

                                            </dd>
                                        </div>
                                    @endif


                                    @if ($salary->transport_value > 0)
                                        <div class="flex justify-between gap-x-4 p-3">
                                            <dt class="text-gray-500">Transporte:</dt>
                                            <dd class="flex items-start gap-x-2">
                                                {{-- <div class="font-medium text-gray-900">{{ $salary->taxes->getName() }}</div> --}}
                                                {{-- @dump($salary->taxes_value) --}}

                                                <div
                                                    class="rounded-md bg-green-50 px-2 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20">
                                                    {{ $salary->getTransportDisplayFormatAttribute }}</div>

                                            </dd>
                                        </div>
                                    @endif

                                    @if ($salary->salary > 0)
                                        <div class="flex justify-between gap-x-4 p-3">
                                            <dt class="text-gray-500">Salario</dt>
                                            <dd class="flex items-start gap-x-2">
                                                <div class="font-medium text-gray-900">${{ $salary->salary }}</div>
                                            </dd>
                                        </div>
                                    @endif
                                </div>

                                <div class="mt-auto">
                                    <div class="-mt-px flex divide-x divide-gray-200">
                                        <div class="flex w-0 flex-1">
                                            <a href="{{ route('panel.settings.salaries.edit', $salary) }}"
                                                class="relative -mr-px inline-flex w-0 flex-1 items-center justify-center gap-x-3 rounded-bl-lg border border-transparent py-4 text-sm font-semibold text-gray-900">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                    fill="currentColor" class="h-5 w-5 text-gray-400">
                                                    <path
                                                        d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32L19.513 8.2Z" />
                                                </svg>
                                                Editar
                                            </a>
                                        </div>
                                        <div class="-ml-px flex w-0 flex-1">
                                            <a href="tel:+1-202-555-0170"
                                                class="relative inline-flex w-0 flex-1 items-center justify-center gap-x-3 rounded-br-lg border border-transparent py-4 text-sm font-semibold text-gray-900">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                    fill="currentColor" class="h-5 w-5 text-red-500">
                                                    <path fill-rule="evenodd"
                                                        d="M16.5 4.478v.227a48.816 48.816 0 0 1 3.878.512.75.75 0 1 1-.256 1.478l-.209-.035-1.005 13.07a3 3 0 0 1-2.991 2.77H8.084a3 3 0 0 1-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 0 1-.256-1.478A48.567 48.567 0 0 1 7.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 0 1 3.369 0c1.603.051 2.815 1.387 2.815 2.951Zm-6.136-1.452a51.196 51.196 0 0 1 3.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 0 0-6 0v-.113c0-.794.609-1.428 1.364-1.452Zm-.355 5.945a.75.75 0 1 0-1.5.058l.347 9a.75.75 0 1 0 1.499-.058l-.346-9Zm5.48.058a.75.75 0 1 0-1.498-.058l-.347 9a.75.75 0 0 0 1.5.058l.345-9Z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                                Eliminar
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @empty
                        @endforelse
                    </ul>




                    {{ $salaries->links(data: ['scrollTo' => false]) }}

                </div>
            </div>
        </main>
    </div>
</div>
