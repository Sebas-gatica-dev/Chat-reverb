<div>
    <div>
        <div class="mx-auto max-w-screen-2xl pt-2 lg:flex lg:gap-x-16 lg:px-8">
            <h1 class="sr-only">Configuracion general</h1>

            <aside
                class="flex overflow-x-auto border-b border-gray-900/5 py-4 lg:block lg:w-64 lg:flex-none lg:border-0 lg:py-20">

                @include('components.panel.settings.menu-side-bar-settings')

            </aside>

            <main class="px-4 py-16 sm:px-6 lg:flex-auto lg:px-0 lg:py-20">
                <div class="flex justify-between items-center">
                    <div>
                        <h2 class="text-base font-semibold leading-7 text-gray-900">Mi suscripción</h2>
                        <p class="mt-1 text-sm leading-6 text-gray-500">Administra tu suscripción, actualiza tu plan o
                            cancela tu suscripción.</p>
                    </div>
                  @can('access-function', 'suscription-change-plan')
                    <a href="{{ route('panel.settings.my-subscription.changue-plan') }}" wire:navigate type="button"
                        class="inline-flex items-center gap-x-1.5 rounded-md bg-indigo-600 px-2.5 py-1.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                        <svg class="-ml-0.5 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                            fill="currentColor" class="size-6">
                            <path fill-rule="evenodd"
                                d="M15.22 6.268a.75.75 0 0 1 .968-.431l5.942 2.28a.75.75 0 0 1 .431.97l-2.28 5.94a.75.75 0 1 1-1.4-.537l1.63-4.251-1.086.484a11.2 11.2 0 0 0-5.45 5.173.75.75 0 0 1-1.199.19L9 12.312l-6.22 6.22a.75.75 0 0 1-1.06-1.061l6.75-6.75a.75.75 0 0 1 1.06 0l3.606 3.606a12.695 12.695 0 0 1 5.68-4.974l1.086-.483-4.251-1.632a.75.75 0 0 1-.432-.97Z"
                                clip-rule="evenodd" />
                        </svg>

                        Cambiar de plan
                    </a>
                   @endcan 
                </div>
                <div class="mx-auto max-w-2xl  lg:mx-0 lg:max-w-none">

                    {{-- <div class="sm:rounded-lg bg-white shadow p-4 mt-6 space-y-6 divide-y divide-gray-100 border-t border-gray-200 text-sm leading-6"></div> --}}

                    <div>
                        <span class="bg-green-500"></span>
                        <span class="bg-green-400"></span>
                        <span class="bg-gray-500"></span>
                        <span class="bg-gray-400"></span>
                        <span class="bg-red-500"></span>
                        <span class="bg-red-400"></span>
                        <span class="bg-orange-500"></span>
                        <span class="bg-orange-400"></span>
                        <span class="bg-blue-500"></span>
                        <span class="bg-blue-400"></span>
                        <span class="bg-slate-500"></span>
                        <span class="bg-slate-400"></span>
                        <span class="text-blue-700 bg-blue-50 ring-blue-600/20"></span>
                        <span class="text-red-700 bg-red-50 ring-red-600/20"></span>
                        <span class="text-green-700 bg-green-50 ring-green-600/20"></span>

                    </div>




                    <div class="mx-auto max-w-screen-2xl px-2 lg:px-0">


                        <dl class="mt-12 grid grid-cols-1 gap-6 sm:grid-cols-3">
                            <div class="overflow-hidden rounded-lg bg-white px-4 py-5 shadow sm:p-6">
                                <dt class="truncate text-sm font-medium text-gray-500">Plan actual</dt>
                                <dd class="mt-1 text-3xl font-semibold tracking-tight text-gray-900">
                                    {{ $subscription->plan->name }}</dd>
                            </div>
                            <div class="overflow-hidden rounded-lg bg-white px-4 py-5 shadow sm:p-6">
                                <dt class="truncate text-sm font-medium text-gray-500">Estado</dt>
                                <dd class="mt-1 text-3xl font-semibold tracking-tight text-gray-900 flex items-center">
                                    {{ $subscription->getStatusText() }}
                                    <span class="relative h-3 w-3 inline-flex ml-3">
                                        <span
                                            class="animate-ping absolute inline-flex h-full w-full rounded-full {{ $subscription->getStatusExpandClass() }} opacity-75"></span>
                                        <span
                                            class="relative inline-flex rounded-full h-3 w-3 {{ $subscription->getStatusBadgeClass() }}"></span>
                                    </span>
                                </dd>
                            </div>
                            <div class="overflow-hidden rounded-lg bg-white px-4 py-5 shadow sm:p-6">
                                <dt class="truncate text-sm font-medium text-gray-500">Vencimiento</dt>
                                <dd class="mt-1 text-3xl font-semibold tracking-tight text-gray-900">
                                    @if ($subscription->status->value == 1)
                                    {{ $subscription->ends_at ? \Carbon\Carbon::parse($subscription->ends_at)->isoFormat('D [de] MMMM, YYYY') : 'Eterno' }}
                                @else
                                    {{ $subscription->ends_at ? \Carbon\Carbon::parse($subscription->ends_at)->isoFormat('D [de] MMMM, YYYY') : 'A definir' }}
                                @endif

                                </dd>
                            </div>
                        </dl>
                    </div>

                    <main>

                        @can('access-function','suscription-list-payments')
                        <div class="mx-auto mt-8 max-w-screen-2xl sm:mt-6 px-2 lg:px-0">

                            <ul role="list" class="grid grid-cols-1 gap-x-6 gap-y-8 lg:grid-cols-3">

                                @foreach ($payments as $payment)
                                    <li class="overflow-hidden rounded-xl border bg-white border-gray-200"
                                        x-data="{ open: false }" x-cloak>
                                        <div class="flex items-center gap-x-4 border-b border-gray-900/5 bg-white p-6">
                                            <img src="https://asset.brandfetch.io/id4J-eZGRh/idheOMrLg2.jpeg?updated=1711727381149"
                                                alt="Tuple"
                                                class="h-12 w-12 flex-none rounded-lg bg-white object-cover ring-1 ring-gray-900/10">
                                            <div class="text-sm font-medium leading-6 text-gray-900">
                                                {{ $payment->subscription->plan->name }}
                                            </div>

                                            @if ($payment->status->value == 0)
                                                <a href="{{ $payment->link }}"
                                                    class="rounded bg-green-50 px-2 py-1 text-xs font-semibold text-green-600 shadow-sm hover:bg-green-100 ring-1 ring-inset ring-green-300">Pagar</a>
                                            @endif

                                            {{-- @if ($payment->status->value == 0)
                                            <span wire:click="payPayment('{{ $payment->id }}')"
                                                class="rounded bg-green-50 px-2 py-1 text-xs font-semibold text-green-600 shadow-sm hover:bg-green-100 ring-1 ring-inset ring-green-300">Pagar</span>
                                        @endif --}}

                                            <div class="relative ml-auto">
                                                <button type="button"
                                                    class="-m-2.5 block p-2.5 text-gray-400 hover:text-gray-500"
                                                    id="options-menu-0-button" aria-expanded="false"
                                                    aria-haspopup="true" @click="open = !open">
                                                    <span class="sr-only">Open options</span>
                                                    <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"
                                                        aria-hidden="true">
                                                        <path
                                                            d="M3 10a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0zM8.5 10a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0zM15.5 8.5a1.5 1.5 0 100 3 1.5 1.5 0 000-3z" />
                                                    </svg>
                                                </button>

                                                <div class="absolute right-0 z-10 mt-0.5 w-32 origin-top-right rounded-md bg-white py-2 shadow-lg ring-1 ring-gray-900/5 focus:outline-none"
                                                    role="menu" aria-orientation="vertical"
                                                    aria-labelledby="options-menu-0-button" tabindex="-1"
                                                    x-show="open" @click.away="open = false"
                                                    x-transition:enter="transition ease-out duration-100"
                                                    x-transition:enter-start="transform opacity-0 scale-95"
                                                    x-transition:enter-end="transform opacity-100 scale-100"
                                                    x-transition:leave="transition ease-in duration-75"
                                                    x-transition:leave-start="transform opacity-100 scale-100"
                                                    x-transition:leave-end="transform opacity-0 scale-95">

                                                    <a href="#"
                                                        class="block px-3 py-1 text-sm leading-6 text-gray-900"
                                                        role="menuitem" tabindex="-1" id="options-menu-0-item-0">Ver
                                                        factura<span class="sr-only">Ver factura</span></a>
                                                    <a href="#"
                                                        class="block px-3 py-1 text-sm leading-6 text-gray-900"
                                                        role="menuitem" tabindex="-1"
                                                        id="options-menu-0-item-1">Edit<span class="sr-only">,
                                                            Tuple</span></a>
                                                </div>
                                            </div>
                                        </div>
                                        <dl class="-my-3 divide-y divide-gray-100 px-6 py-4 text-sm leading-6">
                                            <div class="flex justify-between gap-x-4 py-3">
                                                <dt class="text-gray-500">Pago realizado</dt>
                                                <dd class="text-gray-700">
                                                    <time datetime="{{ $payment->paid_at }}">
                                                        {{ \Carbon\Carbon::parse($payment->paid_at)->isoFormat('D [de] MMMM, YYYY') }}
                                                    </time>
                                                </dd>
                                            </div>
                                            <div class="flex justify-between gap-x-4 py-3">
                                                <dt class="text-gray-500">Monto abonado</dt>
                                                <dd class="flex items-start gap-x-2">
                                                    <div class="font-medium text-gray-900">
                                                        ${{ number_format($payment->amount, 0) }}</div>
                                                    <div
                                                        class="rounded-md py-1 px-2 text-xs font-medium ring-1 ring-inset {{ $payment->getStatusBadgeClass() }}">
                                                        {{ $payment->getStatusText() }}</div>

                                                </dd>
                                            </div>
                                        </dl>
                                    </li>
                                @endforeach



                            </ul>


                        </div>
                         @endcan
                    </main>
                </div>

        </div>
        </main>
    </div>


</div>

</div>
