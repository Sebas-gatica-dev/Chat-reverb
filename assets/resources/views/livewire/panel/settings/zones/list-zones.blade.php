<div>
    <div class="mx-auto max-w-screen-2xl pt-2 lg:flex lg:gap-x-16 lg:px-8">
        <h1 class="sr-only">Configuracion de sucursales</h1>

        <aside
            class="flex overflow-x-auto border-b border-gray-900/5 py-4 lg:block lg:w-64 lg:flex-none lg:border-0 lg:py-20">

            @include('components.panel.settings.menu-side-bar-settings')

        </aside>
        <main class="px-4 py-16 sm:px-6 lg:flex-auto lg:px-0 lg:py-20">
            <div class="mx-auto max-w-2xl space-y-16 sm:space-y-12 lg:mx-0 lg:max-w-none">

                <div class="sm:flex sm:items-center">
                    <div class="sm:flex-auto">
                        <h1 class="text-base font-semibold leading-6 text-gray-900">Zonas</h1>
                        <p class="mt-2 text-sm text-gray-700">Administra las zonas en las que trabajas y quieras que se
                            muestren
                            tus propiedades.</p>
                    </div>
                </div>

                <div class="mt-8 flow-root">
                    <div
                        class="-mx-4 -mt-2 mb-4 pb-3 sm:-mx-6 lg:mx-0 sm:shadow sm:rounded-lg px-6 bg-white  border-t border-gray-200">


                        <livewire:components.select-zones :model="auth()->user()->business" />

                    </div>
                </div>
            </div>
    </div>
    </main>
</div>
</div>
