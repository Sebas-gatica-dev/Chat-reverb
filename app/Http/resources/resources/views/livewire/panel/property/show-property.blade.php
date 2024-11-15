@php
    use App\Enums\StatusVisitEnum;
@endphp

<div>

    <div 
    {{-- x-data="{ modalStatusChangeData: @entangle('modalStatusChangeData').live }" --}}
     x-data="{ modalStatusChangeData: @entangle('modalStatusChangeData').live }"
    >
        {{-- @if ($modalStatusChangeData) --}}
            {{-- @include('livewire.panel.property.visit.modals.modal-visit-status-data', [
                'modalStatusChangeData' => $modalStatusChangeData,
                'closeModalStatusChangeData' => '@this.set("modalStatusChangeData", false)',
            ]) --}}

{{--        
 <template x-teleport="body">
                <div x-show="modalStatusChangeData" x-trap.inert.noscroll="modalStatusChangeData"
                    class="fixed top-0 left-0 z-[99] flex items-center justify-center w-screen h-screen p-4" x-cloak>


                    <div x-show="modalStatusChangeData"
                    x-transition:enter="ease-out duration-300"
                    x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100"
                    x-transition:leave="ease-in duration-200"
                    x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0"
                    class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75" 
                    @click="modalStatusChangeData = false">
               </div>
   

                    <div x-show="modalStatusChangeData" x-transition:enter="ease-out duration-300"  x-trap.inert.noscroll="modalStatusChangeData"
                        x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
                        x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 scale-100"
                        x-transition:leave-end="opacity-0 scale-90"
                        class="relative w-full max-w-2xl max-h-[80vh] overflow-y-auto bg-white shadow-xl px-4 sm:px-6 py-6 bg-opacity-95 rounded-xl">
                        <div class="mb-6">
                            <h2 class="text-xl font-semibold text-gray-900 mb-2">Detalles del estado {{ $statusName }}
                            </h2>
                        </div> --}}

                        <x-panel.visit-status.modals.modal-visit-status-data :modalStatusChangeData="$modalStatusChangeData" :statusName="$statusName" :statusChange="$statusChange"
                :defaultDataFields="$defaultDataFields" :dataFormsDynamic="$dataFormsDynamic" :visit="$currentVisit" 
                 :latitude="-34.761405"
                 :longitude="-58.207920"
                 
                />  
{{-- 
                        <span @click="modalStatusChangeData = false">cerrar</span>

                    </div>


                </div>
            </template>  --}}

        {{-- @endif --}}
    </div>

    <div x-data="{ modalShowAvailabilities: @entangle('modalShowAvailabilities').live }">
        @if ($modalShowAvailabilities)
            {{-- @include('livewire.panel.property.visit.modals.modal-visit-status-data', [
                'modalStatusChangeData' => $modalStatusChangeData,
                'closeModalStatusChangeData' => '@this.set("modalStatusChangeData", false)',
            ]) --}}

            <x-panel.visit-status.modals.modal-show-availabilities :grupedAvailabilities="$grupedAvailabilities" />
        @endif
    </div>



    <div>


        <div>

            <main>
                <header class="relative isolate">
                    <div class="absolute inset-0 -z-10 overflow-hidden" aria-hidden="true">
                        <div
                            class="absolute left-16 top-full -mt-16 transform-gpu opacity-50 blur-3xl xl:left-1/2 xl:-ml-80">
                            <div class="aspect-[1154/678] w-[72.125rem] bg-gradient-to-br from-[#FF80B5] to-[#9089FC]"
                                style="clip-path: polygon(100% 38.5%, 82.6% 100%, 60.2% 37.7%, 52.4% 32.1%, 47.5% 41.8%, 45.2% 65.6%, 27.5% 23.4%, 0.1% 35.3%, 17.9% 0%, 27.7% 23.4%, 76.2% 2.5%, 74.2% 56%, 100% 38.5%)">
                            </div>
                        </div>
                        <div class="absolute inset-x-0 bottom-0 h-px bg-gray-900/5"></div>
                    </div>

                    {{-- <a wire:navigate href="{{ route('panel.customers.property.add', $customer->id) }}" class="ml-3 inline-flex items-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"></a> --}}


                    <div class="overflow-hidden rounded-lg bg-white shadow">
                        <div class="mx-auto max-w-screen-2xl px-4 py-2 sm:px-6 lg:px-8">
                            <h2 class="sr-only" id="profile-overview-title">Profile Overview</h2>
                            <div class="bg-white p-6">
                                <div class="sm:flex sm:items-center sm:justify-between">
                                    <div class="sm:flex sm:space-x-5">
                                        <div class="flex-shrink-0">
                                            <img class="mx-auto md:h-20 md:w-20 h-32 w-32 rounded-full"
                                                src="{{ $property->photo }}" alt="">
                                        </div>
                                        <div class="mt-4 text-center sm:mt-0 sm:pt-1 sm:text-left ">
                                            <p class="text-sm font-medium text-gray-600">Creado por
                                                {{ $customer->createdBy->name }}

                                            <p class="text-xl font-bold text-gray-900 sm:text-2xl sm:flex items-center">
                                                {{ $customer->name }} {{ $customer->surname }}

                                                <span class="text-lg sm:text-xl font-medium text-gray-800 ml-2">

                                                    {{ $customer->business_name ? '(' . $customer->business_name . ')' : '' }}
                                                </span>


                                                <span
                                                    class="ml-2 inline-flex items-center rounded-md bg-green-50 px-1.5 py-0.5 text-xs font-medium text-green-800 ring-1 ring-inset ring-green-600/20">{{ App\Enums\FrequencyEnum::getFrequency($property->frequency) }}</span>
                                            </p>

                                            <p class="text-sm font-medium text-gray-600 mt-2 sm:mt-0">desde el
                                                {{ \Carbon\Carbon::parse($customer->created_at)->isoFormat('D [de] MMMM [de] YYYY') }}
                                            </p>

                                        </div>
                                    </div>



                                    <div class="mt-5 max-sm:flex lg:flex justify-center gap-2 sm:mt-0">
                                        {{-- <div class="flex items-center">

                            <span class="mr-4 inline-flex items-center rounded-md bg-yellow-50 px-1.5 py-0.5 text-xs font-medium text-yellow-800 ring-1 ring-inset ring-yellow-600/20">Badge</span>
                        </div> --}}


                                        @if (Gate::allows('access-function', 'property-edit') || Gate::allows('access-function', 'customer-edit'))
                                            <a href="{{ route('panel.customers.property.edit', [$customer, $property]) }}"
                                                wire:navigate
                                                class="sm:block text-center md:mb-2 lg:mb-0
                                     items-center justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">Editar
                                                perfil</a>
                                        @endif
                                        @can('access-function', 'visit-add')
                                            <a href="{{ route('panel.customers.property.visit.add', [$customer, $property]) }}"
                                                wire:navigate
                                                class="sm:block mt-0 sm:mt-4 md:mt-0 items-center justify-center  px-3 py-2 text-sm ring-1 ring-inset
                                    rounded-md bg-indigo-600 font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600
                                    ">Agregar
                                                Visita</a>
                                        @endcan


                                    </div>
                                </div>
                            </div>
                        </div>

                        @can('acess-function', 'property-show-extra-data')
                            <div class="bg-gray-50 border-gray-200 border-t">
                                <div
                                    class="mx-auto max-w-screen-2xl grid grid-cols-1 divide-y divide-gray-200   sm:grid-cols-3 sm:divide-x sm:divide-y-0">

                                    <div class="px-6 py-5 text-center text-sm font-medium">
                                        <span class="text-gray-900 font-bold">$75.600</span>
                                        <span class="text-gray-600">pendientes a pagar</span>
                                    </div>
                                    <div class="px-6 py-5 text-center text-sm font-medium">
                                        <span class="text-gray-900 font-bold">42</span>
                                        <span class="text-gray-600">servicios realizados</span>
                                    </div>
                                    <div class="px-6 py-5 text-center text-sm font-medium">
                                        <span class="text-red-900 font-bold">9</span>
                                        <span class="text-red-900">días atrasado de visita</span>
                                    </div>
                                </div>
                            </div>
                        @endcan


                    </div>
                </header>



                <div class="mx-auto max-w-screen-2xl px-4 sm:px-6 lg:px-8">
                    <div
                        class="mx-auto grid max-w-2xl grid-cols-1 grid-rows-1 items-center gap-x-8 lg:mx-0 lg:max-w-none lg:grid-cols-3 py-6">
                        <!-- Invoice summary -->
                        <div class="lg:col-start-3 lg:row-end-1">
                            <div x-data="{ open: false }" @keydown.escape.stop="open = false" @click.away="open = false"
                                class="flex justify-end">

                                <button type="button"
                                    class="inline-flex items-center gap-x-1.5 rounded-md    focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2
                    bg-white pl-3 pr-2 py-1.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50"
                                    id="menu-button" x-ref="button" @click="open=!open">

                                    Opciones

                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                        class=" h-5 w-5 text-gray-400">
                                        <path fill-rule="evenodd"
                                            d="M10.5 6a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0Zm0 6a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0Zm0 6a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0Z"
                                            clip-rule="evenodd" />
                                    </svg>

                                </button>



                                <div x-show="open" x-transition:enter="transition ease-out duration-100"
                                    x-transition:enter-start="transform opacity-0 scale-95"
                                    x-transition:enter-end="transform opacity-100 scale-100"
                                    x-transition:leave="transition ease-in duration-75"
                                    x-transition:leave-start="transform opacity-100 scale-100"
                                    x-transition:leave-end="transform opacity-0 scale-95"
                                    class="absolute z-10 mt-10 w-56 divide-y divide-gray-100 rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                                    x-cloak x-ref="menu-items"
                                    x-description="Dropdown menu, show/hide based on menu state." role="menu"
                                    aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">

                                    <div class="py-1" role="none">
                                        <!-- Active: "bg-gray-100 text-gray-900", Not Active: "text-gray-700" -->
                                        @can('access-function', 'property-add')
                                            <a wire:navigate
                                                href="{{ route('panel.customers.property.add', $customer->id) }}"
                                                class="group flex items-center px-4 py-2 text-sm text-gray-700"
                                                role="menuitem" tabindex="-1" id="menu-item-0">


                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                    class="mr-3 h-5 w-5 text-gray-400 group-hover:text-gray-500">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                                </svg>


                                                Agregar otra propiedad
                                            </a>
                                        @endcan
                                        @can('access-function', 'property-delete')
                                            <button wire:confirm= "Desea eliminar esta propiedad?"
                                                wire:click="deleteProperty"
                                                class="group flex items-center px-4 py-2 text-sm text-gray-700"
                                                role="menuitem" tabindex="-1" id="menu-item-1">

                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                    fill="currentColor"
                                                    class="mr-3 h-5 w-5 text-gray-400 group-hover:text-gray-500">
                                                    <path fill-rule="evenodd"
                                                        d="M16.5 4.478v.227a48.816 48.816 0 0 1 3.878.512.75.75 0 1 1-.256 1.478l-.209-.035-1.005 13.07a3 3 0 0 1-2.991 2.77H8.084a3 3 0 0 1-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 0 1-.256-1.478A48.567 48.567 0 0 1 7.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 0 1 3.369 0c1.603.051 2.815 1.387 2.815 2.951Zm-6.136-1.452a51.196 51.196 0 0 1 3.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 0 0-6 0v-.113c0-.794.609-1.428 1.364-1.452Zm-.355 5.945a.75.75 0 1 0-1.5.058l.347 9a.75.75 0 1 0 1.499-.058l-.346-9Zm5.48.058a.75.75 0 1 0-1.498-.058l-.347 9a.75.75 0 0 0 1.5.058l.345-9Z"
                                                        clip-rule="evenodd" />
                                                </svg>

                                                Borrar propiedad
                                            </button>
                                        @endcan

                                        @can('access-function', 'budget-add')
                                            <a wire:navigate
                                                href="{{ route('panel.customers.property.budget.add', [$customer->id, $property->id]) }}"
                                                class="group flex items-center px-4 py-2 text-sm text-gray-700"
                                                role="menuitem" tabindex="-1" id="menu-item-0">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                    class="mr-3 h-5 w-5 text-gray-400 group-hover:text-gray-500">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m3.75 9v6m3-3H9m1.5-12H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                                </svg>



                                                Agregar presupuesto
                                            </a>
                                        @endcan


                                    </div>

                                </div>

                            </div>
                        </div>



                        {{-- FILTROS DE VISITAS --}}
                        <div class="lg:col-span-2 lg:row-span-2 lg:row-end-2 items-center justify-end hidden lg:flex"
                            x-data="{ openFilters: false }">
                            @can('access-function', 'visit-filter')
                                <div class="w-full grid grid-cols-1 grid-rows-1 gap-x-4 lg:grid-cols-4"
                                    x-show="openFilters" x-transition:enter="transition ease-out duration-100"
                                    x-transition:enter-start="transform opacity-0 scale-95"
                                    x-transition:enter-end="transform opacity-100 scale-100"
                                    x-transition:leave="transition ease-in duration-75"
                                    x-transition:leave-start="transform opacity-100 scale-100"
                                    x-transition:leave-end="transform opacity-0 scale-95" x-cloak>


                                    <livewire:components.select-general :selectedValue="$selectedVisitType" :values="$visitType"
                                        :imageValue="false" :searchEnabled="false" :name="'visit-type'" :model="false">
                                        <livewire:components.select-general :selectedValue="$selectedStatus" :values="$status"
                                            :imageValue="false" :searchEnabled="false" :name="'status'" :model="false">
                                            <livewire:components.select-general :selectedValue="$selectedUser" :values="$users"
                                                :imageValue="true" :searchEnabled="true" :name="'user'" :model="false">
                                                <livewire:components.select-general :selectedValue="$selectedService" :values="$services"
                                                    :imageValue="false" :searchEnabled="false" :name="'service'"
                                                    :model="false">

                                </div>

                                <div class="ml-4">
                                    <button type="button" class="group flex items-center font-medium text-gray-700"
                                        aria-controls="disclosure-1" aria-expanded="false"
                                        @click="openFilters = !openFilters">
                                        <svg class="mr-2 h-5 w-5 flex-none text-gray-400 group-hover:text-gray-500"
                                            aria-hidden="true" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M2.628 1.601C5.028 1.206 7.49 1 10 1s4.973.206 7.372.601a.75.75 0 01.628.74v2.288a2.25 2.25 0 01-.659 1.59l-4.682 4.683a2.25 2.25 0 00-.659 1.59v3.037c0 .684-.31 1.33-.844 1.757l-1.937 1.55A.75.75 0 018 18.25v-5.757a2.25 2.25 0 00-.659-1.591L2.659 6.22A2.25 2.25 0 012 4.629V2.34a.75.75 0 01.628-.74z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        Filtros
                                    </button>
                                </div>
                            @endcan
                        </div>

                        {{-- FILTROS DE VISITAS --}}

                    </div>
                </div>

                <div class="mx-auto max-w-screen-2xl px-4 pb-16 sm:px-6 lg:px-8">
                    <div
                        class="mx-auto grid max-w-2xl grid-cols-1 grid-rows-1 items-start gap-x-8 gap-y-8 lg:mx-0 lg:max-w-none lg:grid-cols-3 ">
                        <!-- Invoice summary -->
                        <div class="lg:col-start-3 lg:row-end-1">


                            <h2 class="sr-only">Summary</h2>
                            <div class="rounded-lg shadow-sm ring-1 ring-gray-900/5 bg-white">
                                <dl class="flex flex-wrap">

                                    {{-- <div class="mt-6 flex w-full flex-none gap-x-4 border-t border-gray-900/5 px-6 pt-6"> --}}
                                    <div class="mt-6 flex w-full flex-none gap-x-4 px-6">
                                        <dt class="flex-none">
                                            <span class="sr-only">Nombre de la propiedad</span>



                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                fill="currentColor" class="h-6 w-5 text-amber-600">
                                                <path fill-rule="evenodd"
                                                    d="M11.097 1.515a.75.75 0 0 1 .589.882L10.666 7.5h4.47l1.079-5.397a.75.75 0 1 1 1.47.294L16.665 7.5h3.585a.75.75 0 0 1 0 1.5h-3.885l-1.2 6h3.585a.75.75 0 0 1 0 1.5h-3.885l-1.08 5.397a.75.75 0 1 1-1.47-.294l1.02-5.103h-4.47l-1.08 5.397a.75.75 0 1 1-1.47-.294l1.02-5.103H3.75a.75.75 0 0 1 0-1.5h3.885l1.2-6H5.25a.75.75 0 0 1 0-1.5h3.885l1.08-5.397a.75.75 0 0 1 .882-.588ZM10.365 9l-1.2 6h4.47l1.2-6h-4.47Z"
                                                    clip-rule="evenodd" />
                                            </svg>


                                        </dt>
                                        <dd class="text-base font-semibold leading-6 text-gray-700">
                                            {{ $property->property_name }}
                                        </dd>
                                    </div>
                                    <a href="https://maps.google.com/?q={{ $property->latitude }},{{ $property->longitude }}"
                                        target="_BLANK">
                                        <div
                                            class="mt-6 flex w-full flex-none gap-x-4 border-t border-gray-900/5 px-6 pt-6">

                                            <dt class="flex-none">
                                                <span class="sr-only">Dirección</span>

                                                <svg class="h-6 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                                    <path fill-rule="evenodd"
                                                        d="m11.54 22.351.07.04.028.016a.76.76 0 0 0 .723 0l.028-.015.071-.041a16.975 16.975 0 0 0 1.144-.742 19.58 19.58 0 0 0 2.683-2.282c1.944-1.99 3.963-4.98 3.963-8.827a8.25 8.25 0 0 0-16.5 0c0 3.846 2.02 6.837 3.963 8.827a19.58 19.58 0 0 0 2.682 2.282 16.975 16.975 0 0 0 1.145.742ZM12 13.5a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"
                                                        clip-rule="evenodd" />
                                                </svg>

                                            </dt>
                                            <dd class="text-base font-bold leading-6 text-gray-900">
                                                {{ $property->address }}
                                            </dd>
                                        </div>
                                    </a>
                                    <div class="mt-4 flex w-full flex-none gap-x-4 px-6">
                                        <dt class="flex-none">
                                            <span class="sr-only">Due date</span>
                                            <svg class="h-6 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                                <path fill-rule="evenodd"
                                                    d="M3 6a3 3 0 0 1 3-3h12a3 3 0 0 1 3 3v12a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3V6Zm14.25 6a.75.75 0 0 1-.22.53l-2.25 2.25a.75.75 0 1 1-1.06-1.06L15.44 12l-1.72-1.72a.75.75 0 1 1 1.06-1.06l2.25 2.25c.141.14.22.331.22.53Zm-10.28-.53a.75.75 0 0 0 0 1.06l2.25 2.25a.75.75 0 1 0 1.06-1.06L8.56 12l1.72-1.72a.75.75 0 1 0-1.06-1.06l-2.25 2.25Z"
                                                    clip-rule="evenodd" />
                                            </svg>

                                        </dt>
                                        <dd class="text-sm leading-6 text-gray-500">
                                            {{ $property->between_streets }}
                                        </dd>
                                    </div>
                                    <div class="mt-4 flex w-full flex-none gap-x-4 px-6">
                                        <dt class="flex-none">
                                            <span class="sr-only">Due date</span>


                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                fill="currentColor" class="h-6 w-5 text-gray-400">
                                                <path fill-rule="evenodd"
                                                    d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25ZM6.262 6.072a8.25 8.25 0 1 0 10.562-.766 4.5 4.5 0 0 1-1.318 1.357L14.25 7.5l.165.33a.809.809 0 0 1-1.086 1.085l-.604-.302a1.125 1.125 0 0 0-1.298.21l-.132.131c-.439.44-.439 1.152 0 1.591l.296.296c.256.257.622.374.98.314l1.17-.195c.323-.054.654.036.905.245l1.33 1.108c.32.267.46.694.358 1.1a8.7 8.7 0 0 1-2.288 4.04l-.723.724a1.125 1.125 0 0 1-1.298.21l-.153-.076a1.125 1.125 0 0 1-.622-1.006v-1.089c0-.298-.119-.585-.33-.796l-1.347-1.347a1.125 1.125 0 0 1-.21-1.298L9.75 12l-1.64-1.64a6 6 0 0 1-1.676-3.257l-.172-1.03Z"
                                                    clip-rule="evenodd" />
                                            </svg>


                                        </dt>
                                        <dd class="text-sm leading-6 text-gray-500">
                                            {{ $property->city->name }},
                                            {{ $property->neighborhood->name }}{{ $property->subzone ? ', ' . $property->subzone->name : '' }}
                                        </dd>
                                    </div>
                                    @if ($property->floor || $property->apartment)
                                        <div class="mt-4 flex w-full flex-none gap-x-4 px-6">
                                            <dt class="flex-none">
                                                <span class="sr-only">Due date</span>
                                                <svg class="h-6 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                                    fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                    stroke="currentColor" class="w-6 h-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21" />
                                                </svg>


                                            </dt>
                                            <dd class="text-sm leading-6 text-gray-500">
                                                {{ $property->floor ? 'Piso: ' . $property->floor : 'Piso: -' }}
                                                {{ $property->apartment ? 'Departamento: ' . $property->apartment : 'Departamento: -' }}
                                            </dd>
                                        </div>
                                    @endif
                                    <div class="mt-4 flex w-full flex-none gap-x-4 px-6">
                                        <dt class="flex-none">
                                            <span class="sr-only">Due date</span>
                                            <svg class="h-6 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M9.568 3H5.25A2.25 2.25 0 0 0 3 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 0 0 5.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 0 0 9.568 3Z" />
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M6 6h.008v.008H6V6Z" />
                                            </svg>



                                        </dt>
                                        <dd class="text-sm leading-6 text-gray-500">
                                            {{ $property->propertyType->name }}
                                        </dd>
                                    </div>



                                    <div class="mt-4 flex w-full flex-none gap-x-4 px-6">
                                        <dt class="flex-none">
                                            <span class="sr-only">Disponibilidades de la propiedad</span>


                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                fill="currentColor" class="h-6 w-5 text-gray-400">
                                                <path fill-rule="evenodd"
                                                    d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25ZM12.75 6a.75.75 0 0 0-1.5 0v6c0 .414.336.75.75.75h4.5a.75.75 0 0 0 0-1.5h-3.75V6Z"
                                                    clip-rule="evenodd" />
                                            </svg>



                                        </dt>
                                        <dd class="text-sm leading-6 text-gray-500">
                                            @if (!empty($property->availabilities->toArray()))
                                                <button
                                                    wire:click="openShowAvailabilitiesModal('property','{{ $property->id }}')"
                                                    class="text-sm font-medium leading-6 text-indigo-600">
                                                    Ver disponibilidad
                                                </button>
                                            @else
                                                <span class="text-sm font-medium leading-6 text-indigo-600">
                                                    No hay disponibilidades
                                                </span>
                                            @endif
                                        </dd>
                                    </div>



                                </dl>

                                @can('access-function', 'phone-list')
                                    <div class="mt-6 border-t border-gray-900/5 pb-0">
                                        <div class="my-4 flex w-full flex-none gap-x-3 pl-6 items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                fill="currentColor" class="h-4 w-4 text-indigo-600">
                                                <path fill-rule="evenodd"
                                                    d="M1.5 4.5a3 3 0 0 1 3-3h1.372c.86 0 1.61.586 1.819 1.42l1.105 4.423a1.875 1.875 0 0 1-.694 1.955l-1.293.97c-.135.101-.164.249-.126.352a11.285 11.285 0 0 0 6.697 6.697c.103.038.25.009.352-.126l.97-1.293a1.875 1.875 0 0 1 1.955-.694l4.423 1.105c.834.209 1.42.959 1.42 1.82V19.5a3 3 0 0 1-3 3h-2.25C8.552 22.5 1.5 15.448 1.5 6.75V4.5Z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            <dd class="text-base font-medium leading-6 text-gray-600">

                                                Teléfonos</dd>
                                            @can('access-function', 'phone-add')
                                                <span
                                                    class="inline-flex items-center gap-x-1.5 rounded-md px-2 py-1 text-xs font-medium bg-indigo-50 text-indigo-700 ring-1 ring-inset ring-indigo-700/10"
                                                    wire:click="addPhone">



                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                        fill="currentColor" class="h-4 w-4 text-indigo-700">
                                                        <path fill-rule="evenodd"
                                                            d="M12 3.75a.75.75 0 0 1 .75.75v6.75h6.75a.75.75 0 0 1 0 1.5h-6.75v6.75a.75.75 0 0 1-1.5 0v-6.75H4.5a.75.75 0 0 1 0-1.5h6.75V4.5a.75.75 0 0 1 .75-.75Z"
                                                            clip-rule="evenodd" />
                                                    </svg>


                                                    <span>Agregar</span>
                                                </span>
                                            @endcan

                                        </div>

                                        <div class="space-y-2 px-4" x-data="{ phoneForm: false }" wire:sortable="orderPhone">

                                            @forelse ($phones as $phone)
                                                <div class="py-3 flex w-full justify-between px-3 bg-gray-50 rounded-md"
                                                    wire:key="{{ $phone['id'] }}"
                                                    wire:sortable.item="{{ $phone['id'] }}">

                                                    <div class="flex items-center gap-x-2 cursor-move"
                                                        wire:sortable.handle>
                                                        <dd
                                                            class="text-sm font-medium leading-6 text-gray-600 cursor-default">
                                                            {{ $phone['number'] }}</dd>
                                                        <dd
                                                            class="inline-flex items-center gap-x-1.5 rounded-md px-2 py-1 text-xs font-medium text-gray-900 ring-1 ring-inset ring-gray-200">
                                                            <svg class="h-1.5 w-1.5 fill-red-500" viewBox="0 0 6 6"
                                                                aria-hidden="true">
                                                                <circle cx="3" cy="3" r="3" />
                                                            </svg>
                                                            <span>{{ $phone['tag'] }}</span>
                                                        </dd>

                                                        <dd
                                                            class="inline-flex items-center gap-x-1.5 rounded-md px-2 py-1 text-xs font-medium text-gray-900 ring-1 ring-inset ring-gray-200">
                                                            <svg class="h-1.5 w-1.5 fill-yellow-500" viewBox="0 0 6 6"
                                                                aria-hidden="true">
                                                                <circle cx="3" cy="3" r="3" />
                                                            </svg>
                                                            <span>{{ $phone['phoneable_type'] == 'App\Models\Customer' ? 'Cliente' : 'Propiedad' }}
                                                            </span>
                                                        </dd>

                                                        @if ($phone['type'] == '0')
                                                            <a href="#">
                                                                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                                                                    viewBox="0 0 50 50" class="h-4 w-4 fill-green-600">
                                                                    <path
                                                                        d="M25,2C12.318,2,2,12.318,2,25c0,3.96,1.023,7.854,2.963,11.29L2.037,46.73c-0.096,0.343-0.003,0.711,0.245,0.966 C2.473,47.893,2.733,48,3,48c0.08,0,0.161-0.01,0.24-0.029l10.896-2.699C17.463,47.058,21.21,48,25,48c12.682,0,23-10.318,23-23 S37.682,2,25,2z M36.57,33.116c-0.492,1.362-2.852,2.605-3.986,2.772c-1.018,0.149-2.306,0.213-3.72-0.231 c-0.857-0.27-1.957-0.628-3.366-1.229c-5.923-2.526-9.791-8.415-10.087-8.804C15.116,25.235,13,22.463,13,19.594 s1.525-4.28,2.067-4.864c0.542-0.584,1.181-0.73,1.575-0.73s0.787,0.005,1.132,0.021c0.363,0.018,0.85-0.137,1.329,1.001 c0.492,1.168,1.673,4.037,1.819,4.33c0.148,0.292,0.246,0.633,0.05,1.022c-0.196,0.389-0.294,0.632-0.59,0.973 s-0.62,0.76-0.886,1.022c-0.296,0.291-0.603,0.606-0.259,1.19c0.344,0.584,1.529,2.493,3.285,4.039 c2.255,1.986,4.158,2.602,4.748,2.894c0.59,0.292,0.935,0.243,1.279-0.146c0.344-0.39,1.476-1.703,1.869-2.286 s0.787-0.487,1.329-0.292c0.542,0.194,3.445,1.604,4.035,1.896c0.59,0.292,0.984,0.438,1.132,0.681 C37.062,30.587,37.062,31.755,36.57,33.116z">
                                                                    </path>
                                                                </svg>
                                                            </a>
                                                        @endif
                                                    </div>

                                                    @can('access-function', 'phone-edit')
                                                        <div class="relative" x-data="{ open: false }">
                                                            <dd class="text-sm font-bold leading-6 text-gray-600 flex items-center cursor-pointer"
                                                                @click="open = !open">
                                                                <svg class="h-6 w-5 text-gray-400"
                                                                    xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                    viewBox="0 0 24 24" stroke-width="1.5"
                                                                    stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        d="M12 6.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 12.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 18.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5Z" />
                                                                </svg>

                                                            </dd>
                                                            <div class="absolute left-0 z-10 mt-2 w-32 origin-top-right top-6 rounded-md bg-white py-2 shadow-lg ring-1 ring-black/5 focus:outline-none font-bold select-none"
                                                                role="menu" aria-orientation="vertical"
                                                                aria-labelledby="options-menu-0-button" tabindex="-1"
                                                                @click.away="open = false" x-show="open" x-cloak
                                                                x-transition:enter="transition ease-out duration-100"
                                                                x-transition:enter-start="transform opacity-0 scale-95"
                                                                x-transition:enter-end="transform opacity-100 scale-100"
                                                                x-transition:leave="transition ease-in duration-75"
                                                                x-transition:leave-start="transform opacity-100 scale-100"
                                                                x-transition:leave-end="transform opacity-0 scale-95">
                                                                <a wire:click="editPhone('{{ $phone['id'] }}')"
                                                                    class="block px-3 py-1 text-sm leading-6 text-gray-900">Editar</a>

                                                                @can('access-function', 'phone-delete')
                                                                    <a wire:click="deletePhone('{{ $phone['id'] }}')"
                                                                        wire:confirm="¿Estás seguro de que deseas eliminar este teléfono?"
                                                                        class="block px-3 py-1 text-sm leading-6 text-gray-900">Eliminar</a>
                                                                @endcan
                                                            </div>
                                                        </div>
                                                    @endcan

                                                </div>
                                            @empty
                                                <div class="rounded-md bg-yellow-50 p-4">
                                                    <div class="text-sm font-medium text-yellow-700 text-center">
                                                        <p>Todavía no se han registrado teléfonos para esta propiedad.</p>
                                                    </div>
                                                </div>
                                            @endforelse

                                            <div class="relative z-10" aria-labelledby="modal-title" role="dialog"
                                                aria-modal="true" x-show="phoneForm"
                                                x-transition:enter="ease-out duration-300"
                                                x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                                                x-transition:leave="ease-in duration-200"
                                                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                                                x-on:keydown.escape.window="phoneForm = false"
                                                x-on:open-phone-form.window="phoneForm = true"
                                                x-on:close-phone-form.window="phoneForm = false"
                                                wire:keydown.enter="savePhone" x-cloak>

                                                {{-- wire:keydown.enter="openEdit" --}}

                                                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"
                                                    aria-hidden="true">
                                                </div>

                                                <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
                                                    <div
                                                        class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">

                                                        <div class="relative transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg sm:p-6"
                                                            x-on:click.away="phoneForm = false">


                                                            <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                                                                <h3 class="text-base font-semibold leading-6 text-gray-900 mb-4"
                                                                    id="modal-title">
                                                                    {{ $phoneForm ? 'Editar teléfono' : 'Agregar teléfono' }}
                                                                </h3>

                                                                <div class="col-span-full mt-4">
                                                                    <label for="phoneNumberForm"
                                                                        class="text-sm font-medium leading-6 text-gray-900">Número</label>
                                                                    <div class="mt-2">
                                                                        <input type="text" wire:model="phoneNumberForm"
                                                                            autocomplete="off"
                                                                            placeholder="Escriba un nombre para el tipo de propiedad"
                                                                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 text-sm sm:leading-6">
                                                                    </div>
                                                                    @error('phoneNumberForm')
                                                                        <span
                                                                            class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                                                    @enderror
                                                                </div>

                                                                <div class="col-span-full mt-4">
                                                                    <label for="phoneTagForm"
                                                                        class="text-sm font-medium leading-6 text-gray-900">Etiqueta</label>
                                                                    <div class="mt-2">
                                                                        <input type="text" wire:model="phoneTagForm"
                                                                            autocomplete="off"
                                                                            placeholder="Escriba un nombre para el tipo de propiedad"
                                                                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 text-sm sm:leading-6">
                                                                    </div>
                                                                    @error('phoneTagForm')
                                                                        <span
                                                                            class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                                                    @enderror
                                                                </div>


                                                                <div class="col-span-full mt-4">
                                                                    <label for="phoneModelForm"
                                                                        class="text-sm font-medium leading-6 text-gray-900">Vincular
                                                                        con</label>
                                                                    <div class="mt-2">
                                                                        <select id="phoneModelForm"
                                                                            wire:model="phoneModelForm"
                                                                            autocomplete="phoneModelForm"
                                                                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                                                            <option value="">Seleccione una opción
                                                                            </option>
                                                                            <option value="customer">Cliente</option>
                                                                            <option value="property">Propiedad</option>
                                                                        </select>
                                                                    </div>
                                                                    @error('phoneModelForm')
                                                                        <span
                                                                            class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                                                    @enderror
                                                                </div>


                                                                <div class="col-span-full mt-4 flex items-center">
                                                                    <fieldset>
                                                                        <label for="phoneTypeForm"
                                                                            class="text-sm font-medium leading-6 text-gray-900">Tipo
                                                                            de teléfono</label>
                                                                        {{-- <p class="mt-1 text-sm leading-6 text-gray-600">These are delivered via SMS to your mobile phone.</p> --}}
                                                                        <div class="mt-2 space-y-1">
                                                                            <div class="flex items-center gap-x-3">
                                                                                <input id="phoneTypeForm"
                                                                                    wire:model="phoneTypeForm"
                                                                                    type="radio" value="0"
                                                                                    class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600">
                                                                                <label for="phoneTypeForm"
                                                                                    class="block text-sm font-medium leading-6 text-gray-900">Celular</label>
                                                                            </div>
                                                                            <div class="flex items-center gap-x-3">
                                                                                <input id="phoneTypeForm"
                                                                                    wire:model="phoneTypeForm"
                                                                                    type="radio" value="1"
                                                                                    class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600">
                                                                                <label for="phoneTypeForm"
                                                                                    class="block text-sm font-medium leading-6 text-gray-900">Teléfono</label>
                                                                            </div>

                                                                        </div>

                                                                        @error('phoneTypeForm')
                                                                            <span
                                                                                class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                                                        @enderror
                                                                    </fieldset>
                                                                </div>


                                                            </div>

                                                            <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
                                                                <button type="button" wire:click="savePhone"
                                                                    class="inline-flex w-full justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 sm:ml-3 sm:w-auto">Guardar</button>
                                                                <button type="button"
                                                                    class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto"
                                                                    x-on:click="phoneForm = false">Volver</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                @endcan
                                <div class="mt-3 border-t border-gray-900/5 pb-4">
                                    <div class="mt-4 flex w-full flex-none gap-x-4 px-6">
                                        <dt class="flex-none">
                                            <span class="sr-only">Status</span>
                                            <svg class="h-6 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Zm6-10.125a1.875 1.875 0 1 1-3.75 0 1.875 1.875 0 0 1 3.75 0Zm1.294 6.336a6.721 6.721 0 0 1-3.17.789 6.721 6.721 0 0 1-3.168-.789 3.376 3.376 0 0 1 6.338 0Z" />
                                            </svg>

                                        </dt>
                                        <dd class="text-sm font-medium leading-6 text-gray-500">
                                            {{ $property->documentation }}
                                        </dd>
                                    </div>
                                    <div class="mt-4 flex w-full flex-none gap-x-4 px-6">
                                        <dt class="flex-none">
                                            <span class="sr-only">Status</span>
                                            <svg class="h-6 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M16.5 12a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0Zm0 0c0 1.657 1.007 3 2.25 3S21 13.657 21 12a9 9 0 1 0-2.636 6.364M16.5 12V8.25" />
                                            </svg>

                                        </dt>
                                        <dd class="text-sm leading-6 text-gray-500">{{ $customer->email }}</dd>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!-- Menu de las visitas -->
                        <div class="lg:col-span-2 lg:row-span-2 lg:row-end-2 xl:px-0 xl:pb-20 xl:pt-0">


                            {{-- Escritorio --}}
                            <nav class="hidden relative sm:flex divide-x divide-gray-200 sm:rounded-t-lg shadow"
                                aria-label="Tabs">
                                <!-- Current: "text-gray-900", Default: "text-gray-500 hover:text-gray-700" -->


                                @can('access-function', 'visit-list')
                                    <button wire:click="changeSection(1)"
                                        class="{{ $currentSection == 1 ? 'text-gray-900' : 'text-gray-500 hover:text-gray-700' }} group relative min-w-0 flex-1 overflow-hidden bg-white py-4 px-4 text-center text-sm font-medium hover:bg-gray-50 focus:z-10">
                                        <span>Visitas</span>
                                        <span aria-hidden="true"
                                            class="{{ $currentSection == 1 ? 'bg-indigo-500' : 'bg-transparent' }}  absolute inset-x-0 bottom-0 h-0.5"></span>
                                    </button>
                                @endcan

                                @can('access-function', 'property-file-list')
                                    <button wire:click="changeSection(2)"
                                        class="{{ $currentSection == 2 ? 'text-gray-900' : 'text-gray-500 hover:text-gray-700' }} group relative min-w-0 flex-1 overflow-hidden bg-white py-4 px-4 text-center text-sm font-medium hover:bg-gray-50 focus:z-10">
                                        <span>Archivos</span>
                                        <span aria-hidden="true"
                                            class="{{ $currentSection == 2 ? 'bg-indigo-500' : 'bg-transparent' }}  absolute inset-x-0 bottom-0 h-0.5"></span>
                                    </button>
                                @endcan


                                <button wire:click="changeSection(3)"
                                    class="{{ $currentSection == 3 ? 'text-gray-900' : 'text-gray-500 hover:text-gray-700' }} group relative min-w-0 flex-1 overflow-hidden bg-white py-4 px-4 text-center text-sm font-medium hover:bg-gray-50 focus:z-10">
                                    <span>Presupuestos</span>
                                    <span aria-hidden="true"
                                        class="{{ $currentSection == 3 ? 'bg-indigo-500' : 'bg-transparent' }}  absolute inset-x-0 bottom-0 h-0.5"></span>
                                </button>


                                <a href="#"
                                    class="text-gray-500 hover:text-gray-700 group relative min-w-0 flex-1 overflow-hidden bg-white py-4 px-4 text-center text-sm font-medium hover:bg-gray-50 focus:z-10">
                                    <span>Agenda</span>
                                    <span aria-hidden="true"
                                        class="bg-transparent absolute inset-x-0 bottom-0 h-0.5"></span>
                                </a>
                                <a href="#"
                                    class="text-gray-500 hover:text-gray-700 rounded-tr-lg relative min-w-0 flex-1 overflow-hidden bg-white py-4 px-4 text-center text-sm font-medium hover:bg-gray-50 focus:z-10">
                                    <span>Actividad</span>
                                    <span aria-hidden="true"
                                        class="bg-transparent absolute inset-x-0 bottom-0 h-0.5"></span>
                                </a>
                            </nav>

                            <aside class="flex md:hidden overflow-x-auto border-b border-gray-900/5 py-4">
                                <nav class="flex-none px-4 sm:px-6 lg:px-0">
                                    <ul role="list" class="flex gap-x-3 gap-y-1 whitespace-nowrap lg:flex-col">
                                        <li>

                                            <!-- Current: "bg-gray-50 text-indigo-600", Default: "text-gray-700 hover:text-indigo-600 hover:bg-gray-50" -->
                                            <a href="" wire:navigate
                                                class="group flex gap-x-3 rounded-md py-2 pl-2 pr-3 text-sm leading-6 font-semibold bg-gray-50 text-indigo-600 hover:text-indigo-600 hover:bg-gray-50">Visitas
                                            </a>
                                        </li>
                                        <li>

                                            <!-- Current: "bg-gray-50 text-indigo-600", Default: "text-gray-700 hover:text-indigo-600 hover:bg-gray-50" -->
                                            <a href="" wire:navigate
                                                class="group flex gap-x-3 rounded-md py-2 pl-2 pr-3 text-sm leading-6 font-semibold text-gray-700 hover:text-indigo-600 hover:bg-gray-50">Documentos
                                            </a>
                                        </li>
                                        <li>

                                            <!-- Current: "bg-gray-50 text-indigo-600", Default: "text-gray-700 hover:text-indigo-600 hover:bg-gray-50" -->
                                            <a href="" wire:navigate
                                                class="group flex gap-x-3 rounded-md py-2 pl-2 pr-3 text-sm leading-6 font-semibold text-gray-700 hover:text-indigo-600 hover:bg-gray-50">Agenda
                                            </a>
                                        </li>
                                        <li>

                                            <!-- Current: "bg-gray-50 text-indigo-600", Default: "text-gray-700 hover:text-indigo-600 hover:bg-gray-50" -->
                                            <a href="" wire:navigate
                                                class="group flex gap-x-3 rounded-md py-2 pl-2 pr-3 text-sm leading-6 font-semibold text-gray-700 hover:text-indigo-600 hover:bg-gray-50">Actividad
                                            </a>
                                        </li>

                                    </ul>
                                </nav>

                            </aside>


                            @switch($currentSection)
                                @case(1)
                                    <div class="space-y-8" wire:loading.class="hidden" wire:target="changeSection">


                                        @can('access-function', 'visit-list')
                                            @forelse ($visits as $visit)
                                                <livewire:panel.property.visit.list-visit :visit="$visit" :first="$loop->first"
                                                    :wire:key="$visit->id" />

                                            @empty
                                                <div
                                                    class="bg-white shadow-sm ring-1 ring-gray-900/5 -mx-4 sm:mx-0 py-4 px-6 rounded-b-lg">
                                                    <div class="rounded-md bg-yellow-50 p-4">
                                                        <div class="text-sm font-medium text-yellow-700 text-center">
                                                            <p>Todavía no se han registrado visitas para esta propiedad.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforelse




                                            @if ($visits->hasMorePages())
                                                <div class="mt-6 text-center">
                                                    <button wire:click="loadMore" type="button"
                                                        class="rounded bg-white px-2 py-1 text-xs font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">Cargar
                                                        más</button>
                                                </div>
                                            @endif
                                        @endcan

                                    </div>
                                @break

                                @case(2)
                                    @can('access-function', 'property-file-list')
                                        <div wire:loading.class="hidden">
                                            <livewire:panel.property.files.list-files :property="$property" />
                                        </div>
                                    @endcan

                                    {{-- <div class="bg-white shadow-sm ring-1 ring-gray-900/5 -mx-4 sm:mx-0 py-4 px-6 rounded-b-lg" wire:loading.class="hidden" wire:target="changeSection">
                                    <div class="rounded-md bg-yellow-50 p-4">
                                        <div class="text-sm font-medium text-yellow-700 text-center">
                                            <p>Todavía no se han registrado archivos para esta propiedad.</p>
                                        </div>
                                    </div>
                                </div> --}}
                                @break

                                @case(3)
                                    <div wire:loading.class="hidden">
                                        <div
                                            class="bg-white shadow-sm ring-1 ring-gray-900/5 -mx-4 sm:mx-0 px-6 pb-6 pt-4 rounded-b-lg">

                                            <livewire:panel.property.budgets.list-budgets :property="$property" :customer="$customer"
                                                :key="$property->id" />

                                        </div>
                                    </div>
                                @break

                                @default
                            @endswitch

                            <div class="hidden bg-white shadow-sm ring-1 ring-gray-900/5 -mx-4 sm:mx-0 py-4 px-6 rounded-b-lg"
                                wire:loading.remove.class="hidden" wire:target="changeSection">
                                <div class="border border-purple-100 shadow-md rounded-md p-4 w-full mx-auto">
                                    <div class="animate-pulse flex space-x-4">
                                        <div class="rounded-full bg-purple-100 h-10 w-10"></div>
                                        <div class="flex-1 space-y-6 py-1">
                                            <div class="h-2 bg-purple-100 rounded"></div>
                                            <div class="space-y-3">
                                                <div class="grid grid-cols-3 gap-4">
                                                    <div class="h-2 bg-purple-100 rounded col-span-2"></div>
                                                    <div class="h-2 bg-purple-100 rounded col-span-1"></div>
                                                </div>
                                                <div class="h-2 bg-purple-100 rounded"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>



                        </div>

                        <div class="lg:col-start-3">
                            <!-- Activity feed -->
                            <h2 class="text-sm font-semibold leading-6 text-gray-900">Actividad</h2>
                            <ul role="list" class="mt-6 space-y-6">
                                <li class="relative flex gap-x-4">
                                    <div class="absolute left-0 top-0 flex w-6 justify-center -bottom-6">
                                        <div class="w-px bg-gray-200"></div>
                                    </div>
                                    <div class="relative flex h-6 w-6 flex-none items-center justify-center bg-white">
                                        <div class="h-1.5 w-1.5 rounded-full bg-gray-100 ring-1 ring-gray-300"></div>
                                    </div>
                                    <p class="flex-auto py-0.5 text-xs leading-5 text-gray-500"><span
                                            class="font-medium text-gray-900">Stephanie Gonzalez</span> creo una
                                        visita.</p>
                                    <time datetime="2023-01-23T10:32"
                                        class="flex-none py-0.5 text-xs leading-5 text-gray-500">hace
                                        2d</time>
                                </li>
                                <li class="relative flex gap-x-4">
                                    <div class="absolute left-0 top-0 flex w-6 justify-center -bottom-6">
                                        <div class="w-px bg-gray-200"></div>
                                    </div>
                                    <div class="relative flex h-6 w-6 flex-none items-center justify-center bg-white">
                                        <div class="h-1.5 w-1.5 rounded-full bg-gray-100 ring-1 ring-gray-300"></div>
                                    </div>
                                    <p class="flex-auto py-0.5 text-xs leading-5 text-gray-500"><span
                                            class="font-medium text-gray-900">Kevin Bada</span> envío una factura.</p>
                                    <time datetime="2023-01-23T11:03"
                                        class="flex-none py-0.5 text-xs leading-5 text-gray-500">hace
                                        3d</time>
                                </li>
                                <li class="relative flex gap-x-4">
                                    <div class="absolute left-0 top-0 flex w-6 justify-center -bottom-6">
                                        <div class="w-px bg-gray-200"></div>
                                    </div>
                                    <div class="relative flex h-6 w-6 flex-none items-center justify-center bg-white">
                                        <div class="h-1.5 w-1.5 rounded-full bg-gray-100 ring-1 ring-gray-300"></div>
                                    </div>
                                    <p class="flex-auto py-0.5 text-xs leading-5 text-gray-500"><span
                                            class="font-medium text-gray-900">Carlos Ybañez</span> envío una factura.
                                    </p>
                                    <time datetime="2023-01-23T11:24"
                                        class="flex-none py-0.5 text-xs leading-5 text-gray-500">hace
                                        4d</time>
                                </li>
                                <li class="relative flex gap-x-4">
                                    <div class="absolute left-0 top-0 flex w-6 justify-center -bottom-6">
                                        <div class="w-px bg-gray-200"></div>
                                    </div>
                                    <img src="https://images.unsplash.com/photo-1550525811-e5869dd03032?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                                        alt=""
                                        class="relative mt-3 h-6 w-6 flex-none rounded-full bg-gray-50">
                                    <div class="flex-auto rounded-md p-3 ring-1 ring-inset ring-gray-200 bg-white">
                                        <div class="flex justify-between gap-x-4">
                                            <div class="py-0.5 text-xs leading-5 text-gray-500"><span
                                                    class="font-medium text-gray-900">Emanuel Sánchez</span> escribió
                                                un
                                                comentario</div>
                                            <time datetime="2023-01-23T15:56"
                                                class="flex-none py-0.5 text-xs leading-5 text-gray-500">hace 6d</time>
                                        </div>
                                        <p class="text-sm leading-6 text-gray-500">El cliente se encuentra en el
                                            exterior, se
                                            le envió un mail con la factura.</p>
                                    </div>
                                </li>
                                <li class="relative flex gap-x-4">
                                    <div class="absolute left-0 top-0 flex w-6 justify-center -bottom-6">
                                        <div class="w-px bg-gray-200"></div>
                                    </div>
                                    <div class="relative flex h-6 w-6 flex-none items-center justify-center bg-white">
                                        <div class="h-1.5 w-1.5 rounded-full bg-gray-100 ring-1 ring-gray-300"></div>
                                    </div>
                                    <p class="flex-auto py-0.5 text-xs leading-5 text-gray-500"><span
                                            class="font-medium text-gray-900">Stephanie Gonzalez</span> envío una
                                        factura.</p>
                                    <time datetime="2023-01-24T09:12"
                                        class="flex-none py-0.5 text-xs leading-5 text-gray-500">hace
                                        10d</time>
                                </li>
                                <li class="relative flex gap-x-4">
                                    <div class="absolute left-0 top-0 flex w-6 justify-center h-6">
                                        <div class="w-px bg-gray-200"></div>
                                    </div>
                                    <div class="relative flex h-6 w-6 flex-none items-center justify-center bg-white">
                                        <svg class="h-6 w-6 text-indigo-600" viewBox="0 0 24 24" fill="currentColor"
                                            aria-hidden="true">
                                            <path fill-rule="evenodd"
                                                d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <p class="flex-auto py-0.5 text-xs leading-5 text-gray-500"><span
                                            class="font-medium text-gray-900">Diarco</span> pagó la factura.</p>
                                    <time datetime="2023-01-24T09:20"
                                        class="flex-none py-0.5 text-xs leading-5 text-gray-500">hace
                                        20d</time>
                                </li>
                            </ul>

                            <!-- New comment form -->
                            <div class="mt-6 flex gap-x-3">
                                <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                                    alt="" class="h-6 w-6 flex-none rounded-full bg-gray-50">
                                <form action="#" class="relative flex-auto">
                                    <div
                                        class="overflow-hidden rounded-lg pb-12 shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-indigo-600">
                                        <label for="comment" class="sr-only">Add your comment</label>
                                        <textarea rows="2" name="comment" id="comment"
                                            class="block w-full resize-none border-0 bg-transparent py-1.5 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                            placeholder="Add your comment..."></textarea>
                                    </div>

                                    <div class="absolute inset-x-0 bottom-0 flex justify-between py-2 pl-3 pr-2">
                                        <div class="flex items-center space-x-5">
                                            <div class="flex items-center">
                                                <button type="button"
                                                    class="-m-2.5 flex h-10 w-10 items-center justify-center rounded-full text-gray-400 hover:text-gray-500">
                                                    <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"
                                                        aria-hidden="true">
                                                        <path fill-rule="evenodd"
                                                            d="M15.621 4.379a3 3 0 00-4.242 0l-7 7a3 3 0 004.241 4.243h.001l.497-.5a.75.75 0 011.064 1.057l-.498.501-.002.002a4.5 4.5 0 01-6.364-6.364l7-7a4.5 4.5 0 016.368 6.36l-3.455 3.553A2.625 2.625 0 119.52 9.52l3.45-3.451a.75.75 0 111.061 1.06l-3.45 3.451a1.125 1.125 0 001.587 1.595l3.454-3.553a3 3 0 000-4.242z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                    <span class="sr-only">Attach a file</span>
                                                </button>
                                            </div>
                                            <div class="flex items-center">
                                                <div>
                                                    <label id="listbox-label" class="sr-only">Your mood</label>
                                                    <div class="relative">
                                                        <button type="button"
                                                            class="relative -m-2.5 flex h-10 w-10 items-center justify-center rounded-full text-gray-400 hover:text-gray-500"
                                                            aria-haspopup="listbox" aria-expanded="true"
                                                            aria-labelledby="listbox-label">
                                                            <span class="flex items-center justify-center">
                                                                <!-- Placeholder label, show/hide based on listbox state. -->
                                                                <span>
                                                                    <svg class="h-5 w-5 flex-shrink-0"
                                                                        viewBox="0 0 20 20" fill="currentColor"
                                                                        aria-hidden="true">
                                                                        <path fill-rule="evenodd"
                                                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.536-4.464a.75.75 0 10-1.061-1.061 3.5 3.5 0 01-4.95 0 .75.75 0 00-1.06 1.06 5 5 0 007.07 0zM9 8.5c0 .828-.448 1.5-1 1.5s-1-.672-1-1.5S7.448 7 8 7s1 .672 1 1.5zm3 1.5c.552 0 1-.672 1-1.5S12.552 7 12 7s-1 .672-1 1.5.448 1.5 1 1.5z"
                                                                            clip-rule="evenodd" />
                                                                    </svg>
                                                                    <span class="sr-only">Add your mood</span>
                                                                </span>
                                                                <!-- Selected item label, show/hide based on listbox state. -->
                                                                <span>
                                                                    <span
                                                                        class="flex h-8 w-8 items-center justify-center rounded-full bg-red-500">
                                                                        <svg class="h-5 w-5 flex-shrink-0 text-white"
                                                                            viewBox="0 0 20 20" fill="currentColor"
                                                                            aria-hidden="true">
                                                                            <path fill-rule="evenodd"
                                                                                d="M13.5 4.938a7 7 0 11-9.006 1.737c.202-.257.59-.218.793.039.278.352.594.672.943.954.332.269.786-.049.773-.476a5.977 5.977 0 01.572-2.759 6.026 6.026 0 012.486-2.665c.247-.14.55-.016.677.238A6.967 6.967 0 0013.5 4.938zM14 12a4 4 0 01-4 4c-1.913 0-3.52-1.398-3.91-3.182-.093-.429.44-.643.814-.413a4.043 4.043 0 001.601.564c.303.038.531-.24.51-.544a5.975 5.975 0 011.315-4.192.447.447 0 01.431-.16A4.001 4.001 0 0114 12z"
                                                                                clip-rule="evenodd" />
                                                                        </svg>
                                                                    </span>
                                                                    <span class="sr-only">Excited</span>
                                                                </span>
                                                            </span>
                                                        </button>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit"
                                            class="rounded-md bg-white px-2.5 py-1.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">Comment</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>



                </div>




                @foreach ($budgets as $budget)
                    <div class="budget-item">
                        <p>Nombre del Presupuesto: {{ $budget->name }}</p>
                        <p>Total: ${{ number_format($budget->total, 2) }}</p>
                        @if ($budget->property)
                            <p>Propiedad: {{ $budget->property->property_name }}</p>
                        @else
                            <p>Propiedad: N/A</p>
                        @endif
                    </div>
                @endforeach








        </div>
        </main>

    </div>


</div>
@push('scripts')
<script data-navigate-once>
    document.addEventListener('livewire:navigated', function() {
        
        (g => {
            var h, a, k, p = "The Google Maps JavaScript API",
                c = "google",
                l = "importLibrary",
                q = "__ib__",
                m = document,
                b = window;
            b = b[c] || (b[c] = {});
            var d = b.maps || (b.maps = {}),
                r = new Set,
                e = new URLSearchParams,
                u = () => h || (h = new Promise(async (f, n) => {
                    await (a = m.createElement("script"));
                    e.set("libraries", [...r] + "");
                    for (k in g) e.set(k.replace(/[A-Z]/g, t => "_" + t[0].toLowerCase()), g[
                        k]);
                    e.set("callback", c + ".maps." + q);
                    a.src = `https://maps.${c}apis.com/maps/api/js?` + e;
                    d[q] = f;
                    a.onerror = () => h = n(Error(p + " could not load."));
                    a.nonce = m.querySelector("script[nonce]")?.nonce || "";
                    m.head.append(a);
                }));
            d[l] ? console.warn(p + " only loads once. Ignoring:", g) : d[l] = (f, ...n) => r.add(f) && u()
                .then(() =>
                    d[l](f, ...n))
        })({
            key: "AIzaSyD3K3dBES7-pn0gkICbQyiQgfNHhlUU3W4",
            v: "weekly",
            libraries: "places,marker,geocoder"
        });
    }, {
        once: true
    });
</script>
@endpush
