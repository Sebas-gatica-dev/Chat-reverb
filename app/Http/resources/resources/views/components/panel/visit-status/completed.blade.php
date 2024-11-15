<div>
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
                <p class="text-sm text-blue-700">¿Terminaste el servicio? Apenas confirmes se le enviara el informe al
                    cliente y podrás calificarte.</p>
            </div>
        </div>
    </div>


    {{-- @dd($visitCompleted) --}}

    @if($formsDynamic && $visit->status->name == 'Completed')
    <div class="col-span-full mt-6">
     
                                      <hr class="sm:col-span-full">

                                         @foreach ($formsDynamic as $key => $form)
                                            @switch($form['input_type']->value)
                                                @case('text')
                                                    <div class="sm:col-span-4 my-4">
                                                        <label for="text" class="block text-sm font-medium leading-6 text-gray-900">{{ $form['label'] }} </label>
                                                        <div class="mt-2">
                                                            <input id="text" wire:model.live="formsDynamic.{{ $key }}.value" type="{{ $form['input_type'] }}"
                                                                autocomplete="number" placeholder="{{ $form['placeholder'] }}"
                                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 text-sm sm:leading-6">
                                                        </div>
                                                        @error('formsDynamic.' . $key)
                                                            <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    @break

                                                @case('number')
                                                    <div class="sm:col-span-4 my-4">
                                                        <label for="number" class="block text-sm font-medium leading-6 text-gray-900">{{ $form['label'] }} </label>
                                                        <div class="mt-2">
                                                            <input id="number" wire:model.live="formsDynamic.{{ $key }}.value" type="number"
                                                                placeholder="{{ $form['placeholder'] }}"
                                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 text-sm sm:leading-6">
                                                        </div>
                                                        @error('formsDynamic.' . $key)
                                                            <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    @break

                                                @case('textarea')
                                                        <div class="sm:col-span-4 my-4">
                                                            <label for="textarea" class="block text-sm font-medium leading-6 text-gray-900">{{ $form['label'] }} </label>
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
                                                                            :class="{ 'opacity-0 duration-100 ease-out': checked, 'opacity-100 duration-200 ease-in': !checked }">
                                                                            <svg class="h-3 w-3 text-gray-400" fill="none" viewBox="0 0 12 12">
                                                                                <path d="M4 8l2-2m0 0l2-2M6 6L4 4m2 2l2 2" stroke="currentColor" stroke-width="2"
                                                                                    stroke-linecap="round" stroke-linejoin="round"></path>
                                                                            </svg>
                                                                        </span>
                                                                        
                                                                        {{-- Icono cuando está encendido (check) --}}
                                                                        <span
                                                                            class="absolute inset-0 flex h-full w-full items-center justify-center transition-opacity opacity-0 duration-100 ease-out"
                                                                            aria-hidden="true"
                                                                            :class="{ 'opacity-100 duration-200 ease-in': checked, 'opacity-0 duration-100 ease-out': !checked }">
                                                                            <svg class="h-3 w-3 text-indigo-600" fill="currentColor" viewBox="0 0 12 12">
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
                                                        <label for="select-{{ $key }}" class="block text-sm font-medium leading-6 text-gray-900">
                                                            {{ $form['label'] }} 
                                                        </label>
                                                        
                                                        <div class="mt-2">
                                                            <select id="select-{{ $key }}" wire:model.live="formsDynamic.{{ $key }}.value"
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
