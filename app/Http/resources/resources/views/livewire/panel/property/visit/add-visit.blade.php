<div>
    <header class="bg-white shadow">
        <div class="mx-auto max-w-screen-2xl px-4 py-6 sm:px-6 lg:px-8">
            <div class="md:flex md:items-center md:justify-between">
                <div class="min-w-0 flex-1">
                    <h1 class="text-2xl font-bold tracking-tight text-gray-900">Crear visita para
                        {{ $property->property_name }}
                    </h1>
                </div>
                @can('access-function', 'property-show')
                    <div class="mt-4 flex md:ml-4 md:mt-0">
                        <a wire:navigate
                            href="{{ route('panel.customers.property.show', [$this->customer, $this->property->id]) }}"
                            class="inline-flex items-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">Volver</a>

                        {{-- <button type="button" class="ml-3 inline-flex items-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Agregar cliente</button> --}}
                    </div>
                @endcan
            </div>
        </div>


    </header>

    <main>
        <div class="mx-auto max-w-screen-2xl py-6 sm:px-6 lg:px-8">
            <div class="mt-8 flow-root">

                <div class="space-y-10 divide-y divide-gray-900/10">


                    <div class="grid grid-cols-1 gap-x-8 gap-y-8 pt-10 lg:grid-cols-4">
                        <div class="px-4 sm:px-0">
                            <h2 class="text-base font-semibold leading-7 text-gray-900">Informacion sobre la visita</h2>
                            <p class="mt-1 text-sm leading-6 text-gray-600">Llene los campos para agregar su visita con
                                cuidado.</p>
                        </div>



                        <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl md:col-span-3">
                            <div class="px-4 py-6 sm:p-8">
                                <div class="grid w-full grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-12"
                                    x-data="{ coordinateLater: @entangle('coordinateLater'), recommendedDate: @entangle('recommendedDate') }">



                                    <div class="col-span-12 mx-auto">
                                        <div class="flex items-center w-full gap-x-4 divide-x">

                                            <!-- Toggle para 'coordinateLater' -->
                                            <div class="flex items-center">
                                                <button type="button" wire:click="$toggle('coordinateLater')"
                                                    x-bind:class="{
                                                        'bg-indigo-600': coordinateLater,
                                                        'bg-gray-200': !
                                                            coordinateLater
                                                    }"
                                                    x-bind:aria-pressed="coordinateLater.toString()"
                                                    class="relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:ring-offset-2"
                                                    role="switch" aria-labelledby="coordinateLater-label">
                                                    <!-- Indicador de posición -->
                                                    <span aria-hidden="true"
                                                        x-bind:class="{
                                                            'translate-x-5': coordinateLater,
                                                            'translate-x-0': !
                                                                coordinateLater
                                                        }"
                                                        class="pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out"></span>
                                                </button>
                                                <span class="ml-3 text-sm" id="coordinateLater-label">
                                                    <span class="font-medium text-gray-900">Coordinar más tarde</span>
                                                </span>
                                            </div>

                                            <!-- Toggle para 'recommendedDate' -->
                                            <div class="flex items-center pl-4">
                                                <button type="button" wire:click="$toggle('recommendedDate')"
                                                    x-bind:class="{
                                                        'bg-indigo-600': recommendedDate,
                                                        'bg-gray-200': !
                                                            recommendedDate
                                                    }"
                                                    class="relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:ring-offset-2"
                                                    role="switch" aria-labelledby="personalized-date-label">
                                                    <!-- Icono del interruptor -->
                                                    <span aria-hidden="true"
                                                        x-bind:class="{
                                                            'translate-x-5': recommendedDate,
                                                            'translate-x-0': !
                                                                recommendedDate
                                                        }"
                                                        class="pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out"></span>
                                                </button>
                                                <span class="ml-3 text-sm" id="personalized-date-label">
                                                    <span class="font-medium text-gray-900">Recomendaciones de la
                                                        IA</span>
                                                </span>
                                            </div>

                                        </div>
                                    </div>








                                    <div x-show="!coordinateLater" class="col-span-12">
                                        <div x-show="recommendedDate" class="col-span-12">
                                            <livewire:panel.visit.search-route-visit :property="$property" lazy />
                                        </div>

                                        <div x-show="!recommendedDate"
                                            class="grid w-full grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-12">
                                            <div class="sm:col-span-4">
                                                <label for="property_name"
                                                    class="block text-sm font-medium leading-6 text-gray-900">Fecha de
                                                    visita
                                                    (*)</label>
                                                <div class="mt-2">
                                                    <input type="date" wire:model.live="date" id="date"
                                                        autocomplete="off" placeholder="dd/mm/yyyy"
                                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 text-sm  sm:leading-6">
                                                </div>
                                                @error('date')
                                                    <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                                @enderror
                                            </div>


                                            <div class="sm:col-span-4">
                                                <label for="time"
                                                    class="block text-sm font-medium leading-6 text-gray-900">Hora</label>
                                                <div class="mt-2">
                                                    <input type="time" wire:model.live="time" id="time"
                                                        autocomplete="off" placeholder="--:--"
                                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 text-sm  sm:leading-6">
                                                </div>
                                                @error('time')
                                                    <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="sm:col-span-4">

                                                <label for="users"
                                                    class="block text-sm font-medium leading-6 text-gray-900">Asigna
                                                    usuarios a
                                                    la visita
                                                </label>
                                                <div class="mt-2">
                                                    <livewire:components.multi-select-general :selectedValues="$selectedUsers"
                                                        :values="$users" :imageValue="true" :searchEnabled="true"
                                                        :name="'users'" :model="false">
                                                </div>
                                                @error('selectedUsers')
                                                    <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                                @enderror
                                            </div>

                                        </div>
                                    </div>




                                    <div class="sm:col-span-4">

                                        <label for="visits"
                                            class="block text-sm font-medium leading-6 text-gray-900">Tipo de visita
                                            (*)</label>
                                        <div class="mt-2">
                                            <livewire:components.select-general :selectedValue="$selectedTypeVisit" :values="$typeVisits"
                                                :imageValue="false" :searchEnabled="true" :name="'typeVisits'"
                                                :model="false">
                                        </div>
                                        @error('selectedTypeVisit')
                                            <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                        @enderror
                                    </div>



                                    <div class="sm:col-span-4">

                                        <label for="services"
                                            class="block text-sm font-medium leading-6 text-gray-900">Tipo de servicios
                                            (*)</label>
                                        <div class="mt-2">
                                            <livewire:components.multi-select-general :selectedValues="$selectedServices"
                                                :values="$services" :imageValue="false" :searchEnabled="true"
                                                :name="'services'" :model="false">
                                        </div>
                                        @error('selectedServices')
                                            <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="sm:col-span-4">
                                        <label for="budgets"
                                            class="block text-sm font-medium leading-6 text-gray-900">Seleccionar
                                            Presupuesto</label>
                                        <div class="mt-2">
                                            <livewire:components.select-general :selectedValue="$selectedBudget" :values="$budgets"
                                                :imageValue="false" :searchEnabled="true" :name="'budget'"
                                                :model="false" />
                                        </div>
                                        @error('selectedBudget')
                                            <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                        @enderror
                                    </div>




                                    <hr class="sm:col-span-full">


                                    <div class="sm:col-span-3">
                                        <label for="price"
                                            class="block text-sm font-medium leading-6 text-gray-900">Precio</label>
                                        <div class="mt-2">
                                         
                                            <input id="price" wire:model.live="price" type="number"
                                                autocomplete="number" placeholder="15.000,00"
                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 text-sm  sm:leading-6"
                                                @if ($selectedBudget) disabled @endif
                                                
                                                >
                                        </div>
                                        @error('price')
                                            <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="sm:col-span-2 items-center">
                                        <label for="iva"
                                            class="block text-sm font-medium leading-6 text-gray-900">IVA
                                            {{ ($checked && $this->price > 0) ? '($'. number_format($this->totalPrice, 0, ',', '.') . ')' : '' }}
                                        </label>
                                        <div class="mt-3 inline-block">
                                            <livewire:components.toggle :checked="$checked" :breakdown="false"
                                                :dark="false" :disabled="$selectedBudget != null" 
                                                :name="'iva'" />
                                              

                                        </div>

                    
                                    </div>





                                    <div class="sm:col-span-4">

                                        <label for="visits"
                                            class="block text-sm font-medium leading-6 text-gray-900">Pago esperado
                                        </label>
                                        <div class="mt-2">
                                            <livewire:components.select-general :selectedValue="$selectedExpectedPayment" :values="$expectedPayments"
                                                :imageValue="false" :searchEnabled="false" :name="'expectedPayment'"
                                                :model="false">
                                        </div>
                                        @error('selectedExpectedPayment')
                                            <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="sm:col-span-4">
                                        <label for="created_by"
                                            class="block text-sm font-medium leading-6 text-gray-900">Cerrado
                                            por</label>
                                        <div class="mt-2">
                                            <select id="created_by" wire:model="created_by" autocomplete="created_by"
                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                                @foreach ($users as $user)
                                                    <option value="{{ $user['id'] }}" @selected($user['id'] == auth()->id())>
                                                        {{ $user['name'] }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        @error('created_by')
                                            <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                        @enderror
                                    </div>



                                    @if ($formsDynamic)
                                        <hr class="sm:col-span-full">

                                        @foreach ($formsDynamic as $key => $form)
                                            @switch($form['input_type']->value)
                                                @case('text')
                                                    <div class="sm:col-span-4">
                                                        <label for="text"
                                                            class="block text-sm font-medium leading-6 text-gray-900">{{ $form['label'] }}
                                                        </label>
                                                        <div class="mt-2">
                                                            <input id="text"
                                                                wire:model.live="formsDynamic.{{ $key }}.value"
                                                                type="{{ $form['input_type'] }}" autocomplete="number"
                                                                placeholder="{{ $form['placeholder'] }}"
                                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 text-sm sm:leading-6">
                                                        </div>
                                                        @error('formsDynamic.' . $key)
                                                            <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                @break

                                                @case('number')
                                                    <div class="sm:col-span-4">
                                                        <label for="number"
                                                            class="block text-sm font-medium leading-6 text-gray-900">{{ $form['label'] }}
                                                        </label>
                                                        <div class="mt-2">
                                                            <input id="number"
                                                                wire:model.live="formsDynamic.{{ $key }}.value"
                                                                type="number" placeholder="{{ $form['placeholder'] }}"
                                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 text-sm sm:leading-6">
                                                        </div>
                                                        @error('formsDynamic.' . $key)
                                                            <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                @break

                                                @case('textarea')
                                                    <div class="sm:col-span-4">
                                                        <label for="textarea"
                                                            class="block text-sm font-medium leading-6 text-gray-900">{{ $form['label'] }}
                                                        </label>
                                                        <div class="mt-2">
                                                            <textarea id="textarea" wire:model.live="formsDynamic.{{ $key }}.value" rows="3"
                                                                placeholder="{{ $form['placeholder'] }}"
                                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 text-sm sm:leading-6"></textarea>
                                                        </div>
                                                        @error('formsDynamic.' . $key)
                                                            <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                @break

                                                @case('toggle')
                                                    <div class="sm:col-span-4" x-data="{ checked: @entangle('formsDynamic.' . $key . '.value') }">
                                                        <label for="toggle"
                                                            class="block text-sm font-medium leading-6 text-gray-900">
                                                            {{ $form['label'] }}
                                                        </label>

                                                        <div class="mt-2">
                                                            <button type="button"
                                                                class="relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:ring-offset-2"
                                                                role="switch" aria-checked="false"
                                                                :aria-checked="checked.toString()" @click="checked = !checked"
                                                                :class="{ 'bg-indigo-600': checked, 'bg-gray-200': !checked }">
                                                                <span class="sr-only">Toggle</span>
                                                                <span
                                                                    class="pointer-events-none relative inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out"
                                                                    :class="{
                                                                        'translate-x-5': checked,
                                                                        'translate-x-0': !
                                                                            checked
                                                                    }">

                                                                    {{-- Icono cuando está apagado (X) --}}
                                                                    <span
                                                                        class="absolute inset-0 flex h-full w-full items-center justify-center transition-opacity opacity-100 duration-200 ease-in"
                                                                        aria-hidden="true"
                                                                        :class="{
                                                                            'opacity-0 duration-100 ease-out': checked,
                                                                            'opacity-100 duration-200 ease-in':
                                                                                !checked
                                                                        }">
                                                                        <svg class="h-3 w-3 text-gray-400" fill="none"
                                                                            viewBox="0 0 12 12">
                                                                            <path d="M4 8l2-2m0 0l2-2M6 6L4 4m2 2l2 2"
                                                                                stroke="currentColor" stroke-width="2"
                                                                                stroke-linecap="round"
                                                                                stroke-linejoin="round"></path>
                                                                        </svg>
                                                                    </span>

                                                                    {{-- Icono cuando está encendido (check) --}}
                                                                    <span
                                                                        class="absolute inset-0 flex h-full w-full items-center justify-center transition-opacity opacity-0 duration-100 ease-out"
                                                                        aria-hidden="true"
                                                                        :class="{
                                                                            'opacity-100 duration-200 ease-in': checked,
                                                                            'opacity-0 duration-100 ease-out':
                                                                                !checked
                                                                        }">
                                                                        <svg class="h-3 w-3 text-indigo-600"
                                                                            fill="currentColor" viewBox="0 0 12 12">
                                                                            <path
                                                                                d="M3.707 5.293a1 1 0 00-1.414 1.414l1.414-1.414zM5 8l-.707.707a1 1 0 001.414 0L5 8zm4.707-3.293a1 1 0 00-1.414-1.414l1.414 1.414zm-7.414 2l2 2 1.414-1.414-2-2-1.414 1.414zm3.414 2l4-4-1.414-1.414-4 4 1.414 1.414z">
                                                                            </path>
                                                                        </svg>
                                                                    </span>
                                                                </span>
                                                            </button>
                                                        </div>

                                                        {{-- Mostrar errores de validación de Livewire, si los hay --}}
                                                        @error('formsDynamic.' . $key . '.value')
                                                            <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                @break

                                                @case('select')
                                                    <div class="sm:col-span-4">
                                                        <label for="select-{{ $key }}"
                                                            class="block text-sm font-medium leading-6 text-gray-900">
                                                            {{ $form['label'] }}
                                                        </label>

                                                        <div class="mt-2">
                                                            <select id="select-{{ $key }}"
                                                                wire:model.live="formsDynamic.{{ $key }}.value"
                                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 text-sm sm:leading-6">

                                                                <option value="{{ null }}">Selecciona una opción
                                                                </option>

                                                                @foreach (json_decode($form['options'], true) as $option)
                                                                    <option value="{{ $option['value'] }}">
                                                                        {{ $option['label'] }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        @error('formsDynamic.' . $key . '.value')
                                                            <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                @break

                                                @default
                                            @endswitch
                                        @endforeach
                                    @endif


                                    <hr class="sm:col-span-full">


                                    <div class="sm:col-span-full">
                                        <label for="message"
                                            class="block text-sm font-medium leading-6 text-gray-900">Comentario
                                            (*)</label>
                                        <div class="mt-2">
                                            <textarea wire:model.live="message" autocomplete="off" placeholder="Agrege un comentario"id="message" name="message"
                                                rows="3"
                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 text-sm  sm:leading-6"></textarea>
                                        </div>
                                        @error('message')
                                            <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                        @enderror

                                    </div>




                                    <hr class="sm:col-span-full">


                                    @can('access-function', 'visit-file-add')
                                        <div class="col-span-full">
                                            <label for="files"
                                                class="block text-sm font-medium leading-6 text-gray-900">Archivos</label>

                                            <livewire:components.upload-file :multiple="true" :extensions="[
                                                'jpg',
                                                'jpeg',
                                                'png',
                                                'gif',
                                                'pdf',
                                                'doc',
                                                'docx',
                                                'txt',
                                                'xls',
                                                'xlsx',
                                                'ppt',
                                                'pptx',
                                            ]" />

                                        </div>
                                    @endcan

                                    <hr class="sm:col-span-full">
                                    <div class="col-span-full">
                                        <livewire:components.add-date-availability-general />
                                    </div>



                                    <hr class="sm:col-span-full">
                                    @can('access-function', 'visit-add')
                                        <div class="col-span-full content-end">

                                            <button wire:click="addVisit" type="button"
                                                class="rounded-md mt-2 bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Crear
                                                visita</button>
                                        </div>
                                    @endcan


                                </div>



                            </div>

                        </div>
                    </div>


                    @foreach ($errors->all() as $error)
                        {{ $error }}<br>
                    @endforeach



                </div>




            </div>
        </div>




    </main>

</div>
