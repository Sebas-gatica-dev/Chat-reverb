<div x-data="{ modalOpen: false, }" @open-problems-modal="modalOpen = true, $wire.$set('reason', '')" x-cloak class="">

    <div x-show="modalOpen" class="fixed top-0 left-0 z-[99] flex items-center justify-center w-screen h-screen" >
        <div x-show="modalOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-300"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" @click="modalOpen=false"
            class="absolute inset-0 w-full h-full bg-gray-900 bg-opacity-50 backdrop-blur-sm"></div>


        <div x-show="modalOpen" x-trap.inert.noscroll="modalOpen"
            x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 scale-90"
            x-transition:enter-end="opacity-100 scale-100" x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90"
            class="flex min-h-full  items-center justify-center p-4 text-center sm:items-center sm:p-0">

            <div
                class=" relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg h-1/4">
                <div class="absolute right-0 top-0 hidden pr-4 pt-4 sm:block ">
                    <button @click="modalOpen=false" type="button"
                        class="rounded-md bg-white text-gray-400 hover:text-gray-500 ">
                        <span class="sr-only">Close</span>
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                            aria-hidden="true" data-slot="icon">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <div class="sm:flex sm:items-start p-5">
                    <div
                        class="mx-auto flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                        <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" aria-hidden="true" data-slot="icon">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                        </svg>
                    </div>
                    <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                        <h3 class="text-base font-semibold text-gray-900" id="modal-title">¿Deseas marcar como @if($problemStatus){{ Str::lower($problemStatus->getStatus($problemStatus)) }} @endif la visita?
                        </h3>
                        <div class="mt-2">
                            <p class="text-sm text-gray-500">Debes dejar una descripcion detallada del motivo de la decisión.</p>
                        </div>

                    </div>
                </div>
                <div class="col-span-full mt-6 h-96 sm:h-96 overflow-y-scroll px-6">




                    <label for="reason" class="block text-sm font-medium leading-6 text-gray-900 mt-4">Motivo</label>
                    <div class="mt-2">
                        <textarea x-data="{
                            resize() {
                                $el.style.height = '0px';
                                $el.style.height = $el.scrollHeight + 'px';
                                if ($el.scrollHeight > 130) {
                                    $el.style.height = '130px';
                                    $el.style.overflowY = 'auto';
                                }
                            }
                        }" x-init="resize()" @input="resize()" name="reason" type="text"
                            placeholder="¿Porque vas a dejar {{ $problemStatus ? Str::lower($problemStatus->getStatus($problemStatus)) : 'hacerle eso a' }} la visita??."  wire:model="reason" autocomplete="off"
                            class=
                "flex w-full h-auto min-h-[80px] max-h-[130px] px-3 py-2 
                text-sm bg-white border rounded-md border-neutral-300 
                ring-offset-background placeholder:text-neutral-400 focus:border-red-400 
                focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-400 
                disabled:cursor-not-allowed disabled:opacity-50">
                </textarea>
                @error('reason')
                <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
            @enderror
                    </div>
                

                    @if($problemStatus && $problemStatus->value == 'rescheduled')

                            <div class="sm:col-span-4 mt-4">
                                <label for="dateRescheduled"
                                    class="block text-sm font-medium leading-6 text-gray-900">Fecha de
                                    reprogramación de visita
                                    (*)</label>
                                <div class="mt-2">
                                    <input type="date" wire:model.live="dateRescheduled" id="dateRescheduled"
                                        autocomplete="off" placeholder="dd/mm/yyyy"
                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 text-sm  sm:leading-6">
                                </div>
                                @error('dateRescheduled')
                                    <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                @enderror
                            </div>

                    @endif




                    {{-- @dump($dateRescheduled) --}}


                    @if ($formsDynamic)
                        <div class="col-span-full mt-6">

                            <hr class="sm:col-span-full">

                            @foreach ($formsDynamic as $key => $form)
                                {{-- @dd($form, $key, $formsDynamic) --}}
                                @switch($form['input_type'])
                                    @case('text')
                                        <div class="sm:col-span-4 my-4">
                                            <label for="text"
                                                class="block text-sm font-medium leading-6 text-gray-900">{{ $form['label'] }}
                                            </label>
                                            <div class="mt-2">
                                                <input id="text" wire:model.live="formsDynamic.{{ $key }}.value"
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
                                        <div class="sm:col-span-4 my-4">
                                            <label for="number"
                                                class="block text-sm font-medium leading-6 text-gray-900">{{ $form['label'] }}
                                            </label>
                                            <div class="mt-2">
                                                <input id="number" wire:model.live="formsDynamic.{{ $key }}.value"
                                                    type="number" placeholder="{{ $form['placeholder'] }}"
                                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 text-sm sm:leading-6">
                                            </div>
                                            @error('formsDynamic.' . $key)
                                                <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    @break

                                    @case('textarea')
                                        <div class="sm:col-span-4 my-4">
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
                                        <div class="sm:col-span-4 my-4" x-data="{ checked: @entangle('formsDynamic.' . $key . '.value') }">
                                            <label for="toggle" class="block text-sm font-medium leading-6 text-gray-900">
                                                {{ $form['label'] }}
                                            </label>

                                            <div class="mt-2">
                                                <button type="button"
                                                    class="relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:ring-offset-2"
                                                    role="switch" aria-checked="false" :aria-checked="checked.toString()"
                                                    @click="checked = !checked"
                                                    :class="{ 'bg-indigo-600': checked, 'bg-gray-200': !checked }">
                                                    <span class="sr-only">Toggle</span>
                                                    <span
                                                        class="pointer-events-none relative inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out"
                                                        :class="{ 'translate-x-5': checked, 'translate-x-0': !checked }">

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
                                                                    stroke-linecap="round" stroke-linejoin="round">
                                                                </path>
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
                                                            <svg class="h-3 w-3 text-indigo-600" fill="currentColor"
                                                                viewBox="0 0 12 12">
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
                                        <div class="sm:col-span-4 my-4">
                                            <label for="select-{{ $key }}"
                                                class="block text-sm font-medium leading-6 text-gray-900">
                                                {{ $form['label'] }}
                                            </label>

                                            <div class="mt-2">
                                                <select id="select-{{ $key }}"
                                                    wire:model.live="formsDynamic.{{ $key }}.value"
                                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 text-sm sm:leading-6">

                                                    <option value="{{ null }}">Selecciona una opción</option>

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


                        </diV>
                    @endif







                </div>
                <div class="mt-5 sm:m-4 sm:flex sm:flex-row-reverse">
                    <button type="button"
                        wire:click="save()"
                        wire:loading.attr="disabled"
                        class="inline-flex w-full justify-center rounded-bl-md rounded-br-md sm:rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 sm:ml-3 sm:w-auto">Realizar acción</button>
                    <!-- <button @click="modalOpen=false" type="button" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">Cancel</button> -->
                </div>
            </div>
        </div>


    </div>



    {{-- <div>
    <div class="rounded-md bg-blue-50 p-4 mt-4">
        <div class="flex">
            <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-blue-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd"
                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a.75.75 0 000 1.5h.253a.25.25 0 01.244.304l-.459 2.066A1.75 1.75 0 0010.747 15H11a.75.75 0 000-1.5h-.253a.25.25 0 01-.244-.304l.459-2.066A1.75 1.75 0 009.253 9H9z"
                        clip-rule="evenodd" />
                </svg>
            </div>
            <div class="ml-3 flex-1 md:flex md:justify-between">
                <p class="text-sm text-red-700">Es recomendable que describir a lujo de detalles los motivos de la cancelación.</p>
            </div>
        </div>
    </div> --}}



    {{-- @dump($latitude, $longitude)
        <a href="https://maps.google.com/?q={{ $latitude }},{{ $longitude }}" target="_blank"
            class="block mt-2 text-sm font-medium text-indigo-600 hover:text-indigo-900">Ver ubicación en Google Maps</a> --}}



    {{-- 
</div> --}}
</div>
