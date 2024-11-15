<div>
    <header class="bg-white shadow">
        <div class="mx-auto max-w-screen-2xl px-4 py-6 sm:px-6 lg:px-8">
            <div class="sm:flex sm:items-center sm:justify-between">
                <div class="min-w-0 flex-1">
                    <h1 class="text-2xl font-bold tracking-tight text-gray-900">Organizador de rutas</h1>
                </div>


                <div class="mt-4 flex md:ml-4 md:mt-0 justify-end">

                    <a wire:navigate href="{{ route('panel.routes.list') }}"
                        class="ml-3 inline-flex items-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                        Lista de rutas organizadas</a>
                </div>

            </div>
        </div>


    </header>



    <div class="mx-auto max-w-screen-2xl md:px-6 lg:px-8">

        <div class="mt-1 flow-root">
            <div class="">
                <div class="inline-block min-w-full py-6 align-middle md:px-6 lg:px-4">

                    <div class="min-w-full ">

                        <div class="">
                            <div>


                                <main class="mx-auto max-w-screen-2xl md:px-6 lg:px-8">

                                    <div class="pt-12 lg:grid lg:grid-cols-12 lg:gap-x-8 xl:grid-cols-12">
                                        <!-- Columna para Formulario -->
                                        <div class="col-span-12 lg:col-span-3 mx-auto w-full lg:w-full xl:w-full">
                                            <div
                                                class="space-y-4 divide-y divide-gray-200 p-6 shadow-lg rounded-md bg-white">
                                                <!-- Selector de Rango de Fechas -->
                                                <div class="sm:col-span-4">
                                                    <div class="space-y-4 pt-2">
                                                        <label class="text-sm font-medium" for="date">Fechas a organizar</label>
                                                        <livewire:components.date-picker
                                                        :defaultRange="'Próximos 7 días'"
                                                        :rangeOptions="['Hoy', 'Próximos 7 días', 'Próximos 15 días', 'Próximos 30 días', 'Mes actual']"/>
                                                    </div>
                                                </div>

                                                <!-- Selector de Operarios -->
                                                <div class="sm:col-span-2 pt-4">
                                                    <label for="gender" class="block text-sm font-medium leading-6 text-gray-900">Operarios</label>
                                                    <div class="flex items-start space-x-2 w-full mt-2">
                                                        <!-- El multi-select debe respetar el ancho disponible -->
                                                        <div class=" flex-grow max-w-[calc(100%-50px)]">
                                                            <livewire:components.multi-select-general :selectedValues="$selectedEmployees"
                                                                :values="$employees" :imageValue="false" :searchEnabled="true" :name="'employees'" :model="false" />
                                                        </div>
                                                        <!-- Botón con tamaño fijo -->
                                                        <button type="button" wire:click="confirmSelection"
                                                            class="rounded bg-white px-2 py-1.5 text-xs font-semibold text-gray-800 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 w-9 h-full">
                                                            <svg wire:loading.remove wire:target="confirmSelection" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5">
                                                                <path fill-rule="evenodd" d="M10.5 3.75a6.75 6.75 0 1 0 0 13.5 6.75 6.75 0 0 0 0-13.5ZM2.25 10.5a8.25 8.25 0 1 1 14.59 5.28l4.69 4.69a.75.75 0 1 1-1.06 1.06l-4.69-4.69A8.25 8.25 0 0 1 2.25 10.5Z" clip-rule="evenodd" />
                                                              </svg>

                                                              <svg wire:loading wire:target="confirmSelection" class="animate-spin text-gray-800" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                                              </svg>


                                                              
                                                        </button>
                                                    </div>
                                                    @error('gender')
                                                        <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                
                                                <div class="sm:col-span-2 pt-4" x-data="{ contemplatedOrganizedVisits: @entangle('contemplatedOrganizedVisits') }">
                                                    <div class="flex items-center">
                                                        <button type="button" wire:click="$toggle('contemplatedOrganizedVisits')"
                                                            x-bind:class="{ 'bg-indigo-600': contemplatedOrganizedVisits, 'bg-gray-200': !contemplatedOrganizedVisits }"
                                                            x-bind:aria-pressed="contemplatedOrganizedVisits.toString()"
                                                            class="relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:ring-offset-2"
                                                            role="switch" aria-labelledby="contemplatedOrganizedVisits-label">
                                                            <!-- Indicador de posición -->
                                                            <span aria-hidden="true"
                                                                x-bind:class="{ 'translate-x-5': contemplatedOrganizedVisits, 'translate-x-0': !contemplatedOrganizedVisits }"
                                                                class="pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out"></span>
                                                        </button>
                                                        <span class="ml-3 text-sm" id="contemplatedOrganizedVisits-label">
                                                            <span class="font-medium text-gray-900">Contemplar visitas organizadas</span>
                                                        </span>
                                                    </div>
                                                    @error('gender')
                                                        <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                

                                                <!-- Botón de Iniciar Proceso -->
                                                <div class="pt-4">
                                                    <div class="flex justify-center">
                                                        <button wire:click="initProcessOrganizations"
                                                            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                                                            Iniciar proceso
                                                        </button>
                                                    </div>
                                                </div>
                                                
                                              
                                                    @error('selectedAssignedVisits') 
                                                    <div class="">
                                                        <span class="text-sm text-red-400">{{ $message }}</span>
                                                    </div>
                                                    {{-- <span class="text-sm text-red-400">{{ $message }}</span> --}}
                                                    
                                                    @enderror
    
                                        

                                            </div>


                                        </div>




                                        <div class="col-span-12 lg:col-span-9 mx-auto w-full lg:w-full xl:w-full">
                                            <div class="space-y-10 p-4 shadow-lg rounded-md bg-white">

                                                <!-- Pestañas -->
                                                <div class="hidden sm:block">
                                                    <div class="border-b border-gray-200">
                                                        <nav class="-mb-px flex space-x-8" aria-label="Tabs">

                                                            <!-- Current: "border-indigo-500 text-indigo-600", Default: "border-transparent text-gray-500 hover:border-gray-200 hover:text-gray-700" -->

                                                            <button wire:click="$set('currentTab', 'unassigned')"
                                                                class="flex whitespace-nowrap border-b-2  px-1 py-4 text-sm font-medium
                                                                    {{ $currentTab == 'unassigned' ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:border-gray-200 hover:text-gray-700' }}"
                                                                aria-current="page">
                                                                Visitas sin coordinar
                                                                <!-- Current: "bg-indigo-100 text-indigo-600", Default: "bg-gray-100 text-gray-900" -->


                                                                <span
                                                                    class="ml-3 hidden rounded-full
                                                                        {{ $currentTab == 'unassigned' ? 'bg-indigo-100 text-indigo-600' : 'bg-gray-100 text-gray-900' }}
                                                                         px-2.5 py-0.5 text-xs font-medium md:inline-block">{{ $this->organizedVisits ? $this->unAssignedVisits->total() : '0' }} </span>
                                                            </button>

                                                            <button wire:click="$set('currentTab', 'assigned')"
                                                                class="flex whitespace-nowrap border-b-2  px-1 py-4 text-sm font-medium
                                                                    {{ $currentTab == 'assigned' ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:border-gray-200 hover:text-gray-700' }}"
                                                                aria-current="false">
                                                                Visitas coordinadas

                                                                <span
                                                                    class="ml-3 hidden rounded-full
                                                                        {{ $currentTab == 'assigned' ? 'bg-indigo-100 text-indigo-600' : 'bg-gray-100 text-gray-900' }}
                                                                         px-2.5 py-0.5 text-xs font-medium md:inline-block">{{ $this->organizedVisits ? $this->assignedVisits->total() : '0' }} </span>
                                                            </button> 
                                                        </nav>
                                                    </div>
                                                </div>


                                                <div class="sm:hidden">
                                                    <label for="tabs" class="sr-only">Select a tab</label>
                                                    <select id="tabs" name="tabs"
                                                        class="block w-full rounded-md border-gray-300 py-2 pl-3 pr-10 text-base focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                                                        <option selected>Visitas sin coordinar</option>
                                                        {{-- <option>Visitas coordinadas</option> --}}
                                                    </select>
                                                </div>

                                                @if ($currentTab == 'unassigned')



                                                    @if ($this->organizedVisits && ($this->unAssignedVisits->total() > 0))
                                                        <div class="mt-8 flow-root" x-data="{ selectedUnAssignedVisits: @entangle('selectedUnAssignedVisits').live }">
                                                            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">


                                                                <div
                                                                    class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">

                                                                    <div class="inline-flex items-center gap-2 px-3"
                                                                        x-show="selectedUnAssignedVisits.length > 0">

                                                                        <span
                                                                            class="inline-flex items-center rounded-md bg-yellow-400/10 px-2 py-1 text-xs font-medium text-yellow-500 ring-1 ring-inset ring-yellow-400/20"
                                                                            x-text="selectedUnAssignedVisits.length + ' seleccionados'">


                                                                        </span>


                                                                        <button
                                                                            @click="$wire.confirmDeSelectedUnAssignedVisits()"
                                                                            type="button"
                                                                            class="inline-flex items-center rounded px-2 py-1 text-sm font-semibold bg-indigo-600 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                                                                            Deseleccionar
                                                                        </button>
                                                                    </div>

                                                                    <div class="relative">
                                                                        <table
                                                                            class="min-w-full table-fixed divide-y divide-gray-300">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th scope="col"
                                                                                        class="relative px-7 sm:w-12 sm:px-6">

                                                                                        <input type="checkbox"
                                                                                            wire:model.live="selectAllUnAssignedVisits"
                                                                                            class="absolute left-4 top-1/2 -mt-2 h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600">
                                                                                    </th>
                                                                                    <th scope="col"
                                                                                        class="min-w-[12rem] py-3.5 pr-3 text-left text-sm font-semibold text-gray-900">
                                                                                        Cliente</th>
                                                                                    <th scope="col"
                                                                                        class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                                                                        Dirección</th>
                                                                                    <th scope="col"
                                                                                        class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                                                                        Fecha</th>
                                                                                    <th scope="col"
                                                                                        class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                                                                        Hora</th>
                                                                                    <th
                                                                                        class="px-6 py-3 text-left text-sm font-medium text-gray-900">
                                                                                        Operarios</th>
                                                                                    <th scope="col"
                                                                                        class="relative py-3.5 pl-3 pr-4 sm:pr-3">
                                                                                        <span
                                                                                            class="sr-only">Edit</span>
                                                                                    </th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody
                                                                                class="divide-y divide-gray-200 bg-white">
                                                                                @foreach ($this->unAssignedVisits as $unassignedVisit)
                                                                                    <tr
                                                                                        wire:key="{{ $unassignedVisit->id }}">
                                                                                        <td
                                                                                            class="relative px-7 sm:w-12 sm:px-6">
                                                                                            <input type="checkbox"
                                                                                                wire:change="changeSelectAll"
                                                                                                wire:model.live="selectedUnAssignedVisits"
                                                                                                value="{{ $unassignedVisit->id }}"
                                                                                                class="absolute left-4 top-1/2 -mt-2 h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600">
                                                                                        </td>
                                                                                        <td
                                                                                            class="whitespace-nowrap py-4 pr-3 text-sm font-medium text-gray-900">
                                                                                            {{ $unassignedVisit->customer->name }}
                                                                                        </td>
                                                                                        <td
                                                                                            class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                                                            {{ $unassignedVisit->property->address }}
                                                                                        </td>
                                                                                        <td
                                                                                            class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                                                            @if ($unassignedVisit->date)
                                                                                                {{ $unassignedVisit->date }}
                                                                                            @else
                                                                                                <span
                                                                                                    class="bg-red-100 text-red-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded">No
                                                                                                    asignada</span>
                                                                                            @endif
                                                                                        </td>
                                                                                        <td
                                                                                            class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                                                            @if ($unassignedVisit->time)
                                                                                                {{ $unassignedVisit->time }}
                                                                                            @else
                                                                                                <span
                                                                                                    class="bg-red-100 text-red-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded">No
                                                                                                    asignada</span>
                                                                                            @endif
                                                                                        </td>
                                                                                        <td
                                                                                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                                                            @if (count($unassignedVisit->users) > 0)
                                                                                                {{ implode(', ', $unassignedVisit->users->pluck('name')->toArray()) }}
                                                                                            @else
                                                                                                <span
                                                                                                    class="bg-red-100 text-red-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded">Sin
                                                                                                    asignar</span>
                                                                                            @endif
                                                                                        </td>
                                                                                        <td
                                                                                            class="whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-3">
                                                                                            <a href="{{ route('panel.customers.property.visit.edit', ['customer' => $unassignedVisit->customer, 'property' => $unassignedVisit->property, 'visit' => $unassignedVisit]) }}"
                                                                                                class="text-indigo-600 hover:text-indigo-900">Edit<span
                                                                                                    class="sr-only">,
                                                                                                    {{ $unassignedVisit->name }}</span></a>
                                                                                        </td>
                                                                                    </tr>
                                                                                @endforeach
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="mt-6">
                                                            {{ $this->unAssignedVisits->links() }}
                                                        </div>
                                                    @else
                                                        <div class="rounded-md bg-yellow-50 p-4 text-center">

                                                            <div class="flex justify-center">
                                                                <div class="mr-1">

                                                                    <svg class="h-5 w-5 text-yellow-400"
                                                                        viewBox="0 0 20 20" fill="currentColor"
                                                                        aria-hidden="true">
                                                                        <path fill-rule="evenodd"
                                                                            d="M8.485 2.495c.673-1.167 2.357-1.167 3.03 0l6.28 10.875c.673 1.167-.17 2.625-1.516 2.625H3.72c-1.347 0-2.189-1.458-1.515-2.625L8.485 2.495zM10 5a.75.75 0 01.75.75v3.5a.75.75 0 01-1.5 0v-3.5A.75.75 0 0110 5zm0 9a1 1 0 100-2 1 1 0 000 2z"
                                                                            clip-rule="evenodd" />
                                                                    </svg>
                                                                </div>
                                                                <h3
                                                                    class=" text-center text-sm font-medium text-yellow-800">
                                                                    No se encontraron visitas para su busqueda.
                                                                </h3>
                                                            </div>
                                                            <div class="mt-2 text-sm text-yellow-700">
                                                                <p>Intenta seleccionado otros filtros.</p>
                                                            </div>
                                                        </div>


                                                    @endif
                                              @elseif($currentTab == 'assigned')
                                                    <!-- Tabla de Visitas -->



                                                    @if ($this->organizedVisits && ($this->assignedVisits->total() > 0))
                                                        <div class="mt-8 flow-root" x-data="{ selectedAssignedVisits: @entangle('selectedAssignedVisits').live }">
                                                            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                                                <div
                                                                    class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">


                                                                    <div class="inline-flex items-center gap-2 px-3"
                                                                        x-show="selectedAssignedVisits.length > 0">

                                                                        <span
                                                                            class="inline-flex items-center rounded-md bg-yellow-400/10 px-2 py-1 text-xs font-medium text-yellow-500 ring-1 ring-inset ring-yellow-400/20"
                                                                            x-text="selectedAssignedVisits.length + ' seleccionados'">


                                                                        </span>

                                                                        <button
                                                                            @click="$wire.confirmDeSelectedAssignedVisits()"
                                                                            type="button"
                                                                            class="inline-flex items-center rounded px-2 py-1 text-sm font-semibold bg-indigo-600 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                                                                            Deseleccionar
                                                                        </button>
                                                                    </div>
                                                                    <div class="relative">
                                                                        <table
                                                                            class="min-w-full table-fixed divide-y divide-gray-300">
                                                                            <thead>
                                                                                <tr>

                                                                                    <th scope="col"
                                                                                        class="relative px-7 sm:w-12 sm:px-6">
                                                                                        <input type="checkbox"
                                                                                            wire:model.live="selectAllAssignedVisits"
                                                                                            class="absolute left-4 top-1/2 -mt-2 h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600">
                                                                                    </th>
                                                                                    <th scope="col"
                                                                                        class="min-w-[12rem] py-3.5 pr-3 text-left text-sm font-semibold text-gray-900">
                                                                                        Cliente</th>
                                                                                    <th scope="col"
                                                                                        class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                                                                        Dirección</th>
                                                                                    <th scope="col"
                                                                                        class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                                                                        Fecha</th>
                                                                                    <th scope="col"
                                                                                        class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                                                                        Hora</th>
                                                                                    <th
                                                                                        class="px-6 py-3 text-left text-sm font-medium text-gray-900">
                                                                                        Operarios</th>
                                                                                    <th scope="col"
                                                                                        class="relative py-3.5 pl-3 pr-4 sm:pr-3">
                                                                                        <span
                                                                                            class="sr-only">Edit</span>
                                                                                    </th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody
                                                                                class="divide-y divide-gray-200 bg-white">
                                                                                @foreach ($this->assignedVisits as $assignedVisit)
                                                                                    <tr
                                                                                        wire:key='{{ $assignedVisit->id }}'>
                                                                                        <td
                                                                                            class="relative px-7 sm:w-12 sm:px-6">
                                                                                            <input type="checkbox"
                                                                                                wire:change="changeSelectAll"
                                                                                                wire:model.live="selectedAssignedVisits"
                                                                                                value="{{ $assignedVisit->id }}"
                                                                                                class="absolute left-4 top-1/2 -mt-2 h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600">
                                                                                        </td>
                                                                                        <td
                                                                                            class="whitespace-nowrap py-4 pr-3 text-sm font-medium text-gray-900">
                                                                                            {{ $assignedVisit->customer->name }}
                                                                                        </td>
                                                                                        <td
                                                                                            class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                                                            {{ $assignedVisit->property->address }}
                                                                                        </td>
                                                                                        <td
                                                                                            class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">

                                                                                            {{ $assignedVisit->date }}

                                                                                        </td>
                                                                                        <td
                                                                                            class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">

                                                                                            {{ $assignedVisit->time }}

                                                                                        </td>
                                                                                        <td
                                                                                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">

                                                                                            {{ implode(', ', $assignedVisit->users->pluck('name')->toArray()) }}

                                                                                        </td>
                                                                                        <td
                                                                                            class="whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-3">
                                                                                            <a href="{{ route('panel.customers.property.visit.edit', ['customer' => $assignedVisit->customer, 'property' => $assignedVisit->property, 'visit' => $assignedVisit]) }}"
                                                                                                class="text-indigo-600 hover:text-indigo-900">Edit<span
                                                                                                    class="sr-only">,
                                                                                                    {{ $assignedVisit->name }}</span></a>
                                                                                        </td>
                                                                                    </tr>
                                                                                @endforeach
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="mt-6">
                                                            {{ $this->assignedVisits->links(data: ['scrollTo' => false]) }}
                                                        </div>
                                                    @else
                                                        <div class="rounded-md bg-yellow-50 p-4 text-center">

                                                            <div class="flex justify-center">
                                                                <div class="mr-1">

                                                                    <svg class="h-5 w-5 text-yellow-400"
                                                                        viewBox="0 0 20 20" fill="currentColor"
                                                                        aria-hidden="true">
                                                                        <path fill-rule="evenodd"
                                                                            d="M8.485 2.495c.673-1.167 2.357-1.167 3.03 0l6.28 10.875c.673 1.167-.17 2.625-1.516 2.625H3.72c-1.347 0-2.189-1.458-1.515-2.625L8.485 2.495zM10 5a.75.75 0 01.75.75v3.5a.75.75 0 01-1.5 0v-3.5A.75.75 0 0110 5zm0 9a1 1 0 100-2 1 1 0 000 2z"
                                                                            clip-rule="evenodd" />
                                                                    </svg>
                                                                </div>
                                                                <h3
                                                                    class=" text-center text-sm font-medium text-yellow-800">
                                                                    No se encontraron visitas para su busqueda.
                                                                </h3>
                                                            </div>
                                                            <div class="mt-2 text-sm text-yellow-700">
                                                                <p>Intenta seleccionado otros filtros.</p>
                                                            </div>
                                                        </div>
                                                    @endif

                                                @endif 

                                            </div>
                                        </div>

                                    </div>

                                </main>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <fieldset>
div class="relative flex gap-x-3">
   <div class="flex h-6 items-center">
 <input id="comments" name="comments" type="checkbox"
 class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600">
</div>
<div class="text-sm leading-6">
 <label for="comments"
class="font-medium text-gray-900">Ordenar
equitativamente</label>
<p class="text-gray-500">Repartir las visitas de
igual manera entre los usuarios.</p>
</div>
</fieldset> --}}

</div>
