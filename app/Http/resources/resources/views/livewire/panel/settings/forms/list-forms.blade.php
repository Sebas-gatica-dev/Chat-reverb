<div>
    <div class="mx-auto max-w-screen-2xl pt-2 lg:flex lg:gap-x-16 lg:px-8">
        <aside class="flex overflow-x-auto border-b border-gray-900/5 py-4 lg:block lg:w-64 lg:flex-none lg:border-0 lg:py-20">
            @include('components.panel.settings.menu-side-bar-settings')
        </aside>
        <main class="px-4 py-16 sm:px-6 lg:flex-auto lg:px-0 lg:py-20 ">
            <div class="mt-8 flow-root">
                <h1 class="text-base font-semibold leading-6 text-gray-900">Formularios dinámicos</h1>
                <p class="mt-2 text-sm text-gray-700">Crear formularios dinámicos para cada sector de la aplicación.</p>
                <div class="-mx-4 mb-4 sm:-mx-6 lg:mx-0 sm:shadow sm:rounded-lg mt-4 bg-white border-t border-gray-200">
                    <div class="inline-block space-y-4 min-w-full align-middle">
                        <div class="lg:col-span-3 col-span-full">
                                    <div class="max-lg:block">
                                        <nav class="-mb-px flex space-x-8 border-b border-gray-200 max-w-7xl relative" aria-label="Tabs">
                                            <div class="overflow-x-auto flex scroll-smooth scrollbar-thin scrollbar-thumb-rounded-full scrollbar-thumb-indigo-100 scrollbar-track-indigo-50">
                                                @forelse ($sectors as $sector)
                                                    <button 
                                                        @if(!empty($sector['subcategories']))
                                                            wire:click="showSubcategoriesFromSector('{{ $sector['id'] }}')"
                                                        @else
                                                            wire:click="changeSector('{{ $sector['id'] }}')"
                                                        @endif
                                                        wire:key="{{ $sector['id'] }}"
                                                        class="group inline-flex items-center border-b-2 flex-shrink-0 whitespace-nowrap
                                                        px-2 py-4 text-sm font-medium 
                                                        {{ $sector['id'] == $selectedSector || $sector['id'] == $activeSector ? 'border-indigo-500 text-indigo-600 bg-indigo-50' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700' }}">
                                                            {{ $sector['name'] }}
                                                    </button>
                                                @empty
                                                    <span class="text-gray-400">No hay módulos</span>
                                                @endforelse

                                               
                                             
                                            </div>
                                        </nav>
                                        <div x-data="{ show: @entangle('showSubcategories') }" x-show="show" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform scale-90" x-transition:enter-end="opacity-100 transform scale-100" x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 transform scale-100" x-transition:leave-end="opacity-0 transform scale-90">
                                            <nav class="-mb-px flex space-x-8 border-b border-gray-200 max-w-7xl relative" aria-label="Tabs">
                                                
                                                <div class="overflow-x-auto flex scroll-smooth scrollbar-thin scrollbar-thumb-rounded-full scrollbar-thumb-indigo-100 scrollbar-track-indigo-50">

                                                @foreach ($sectorSubcategories as $sectorSub)
                                                    <button wire:click="changeSector('{{ $sectorSub['id'] }}')" wire:key="{{ $sectorSub['id'] }}"
                                                        class="group inline-flex items-center border-b-2 flex-shrink-0 whitespace-nowrap
                                                        px-2 py-3 text-sm font-medium 
                                                        {{ $sectorSub['id'] == $selectedSector ? 'border-amber-500 text-amber-600 bg-amber-50 ' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700' }}">
                                                            {{ $sectorSub['name'] }}
                                                    </button>
                                               
                                                    @endforeach

                                                   
                                                </div>

                                            </nav>
                                        </div>
                                        @if ($selectedSector)
                                                <div class="grid grid-cols-12 gap-4 px-4 py-6">
                                                    <div class="col-span-8">
                                                        <div class="grid grid-cols-12 gap-x-8">
                                                            <div class="col-span-4 items-center">
                                                                <livewire:components.select-general :values="$inputsType" :imageValue="false" :searchEnabled="false" :name="'typeInput'" :model="false" label="Tipo de campo" />
                                                                @error('selectedTypeInput')
                                                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        
                                                            <div class="col-span-4 items-center">
                                                                <label for="labelInput" class="block text-sm font-medium text-gray-700 flex-shrink-0 whitespace-nowrap mb-2">Titulo</label>
                                                                <input type="text" wire:model.live="labelInput" id="labelInput" autocomplete="labelInput" placeholder="Ingrese encabezado de este campo"
                                                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 text-sm sm:leading-6">
                                                                @error('labelInput')
                                                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                                                @enderror
                                                            </div>

                                                            <div class="col-span-4 items-center">
                                                                <label for="labelInput" class="block text-sm font-medium text-gray-700 flex-shrink-0 whitespace-nowrap mb-2">¿Obligatorio?</label>

                                                                <livewire:components.toggle :name="'is-required'" :checked="$inputIsRequired"/>
                                                                @error('inputIsRequired')
                                                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                            @if($selectedTypeInput !== 'select')
                                                                <div x-data="{ show: @entangle('showPlaceholderField') }" x-show="show"
                                                                    x-transition:enter="transition ease-out duration-300"
                                                                    x-transition:enter-start="opacity-0 transform scale-90"
                                                                    x-transition:enter-end="opacity-100 transform scale-100"
                                                                    x-transition:leave="transition ease-in duration-300"
                                                                    x-transition:leave-start="opacity-100 transform scale-100"
                                                                    x-transition:leave-end="opacity-0 transform scale-90"
                                                                    class="col-span-4 m-4 flex items-center h-full">
                                                                    <label for="labelInput" class="block text-sm font-medium text-gray-700 flex-shrink-0 whitespace-nowrap mb-2">¿Obligatorio?</label>
                                                                    <input type="text" wire:model.live="placeholderForm" id="placeholderForm" autocomplete="placeholderForm" placeholder="Ingrese encabezado de este campo"
                                                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 text-sm sm:leading-6">
                                                                </div>
                                                            @endif
                                                            <div class="col-span-full m-10">
                                                                <div class="bg-gray-50 border border-dashed border-gray-300 rounded-lg p-4 text-center">
                                                                    @if ($selectedTypeInput)
                                                                        @php
                                                                            $componentName = 'panel.forms-dynamic.' . \App\Enums\Forms\InputTypeEnum::from($selectedTypeInput)->getComponentPreview();
                                                                        @endphp
                                                                        <x-dynamic-component :component="$componentName" :label="$labelInput" :required="$inputIsRequired" :placeholder="$placeholderForm" :options="$optionsForSelect" />
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-span-4 overflow-y-auto max-h-96">
                                                        <ul class="space-y-2" wire:sortable="updateTaskOrder">
                                                            @forelse ($inputsForSector as $inputSector)
                                                                <li class="border border-gray-300 rounded-lg p-4 bg-white shadow-sm" wire:sortable.item="{{ $inputSector['id'] }}" wire:key="{{ $inputSector['id'] }}">
                                                                    <div class="flex justify-between items-center">
                                                                        <div>
                                                                            <p class="text-sm text-gray-500">
                                                                                Label: <span class="font-semibold text-gray-800">{{ $inputSector['label'] }}</span>
                                                                            </p>
                                                                            <p class="text-sm text-gray-500">Tipo: {{ $inputSector['input_type'] }}</p>
                                                                            <p class="text-sm text-gray-500">Orden: {{ $inputSector['order'] }}</p>
                                                                        </div>
                                                                        <div class="flex space-x-4">
                                                                            <button class="text-blue-500 hover:text-blue-700" wire:click="editForm('{{ $inputSector['id'] }}')" title="Editar">
                                                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 3.487a2.25 2.25 0 113.182 3.182l-9.68 9.681-3.82.637a.75.75 0 01-.872-.872l.637-3.82 9.681-9.68z" />
                                                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 5.25L18 3.75" />
                                                                                </svg>
                                                                            </button>
                                                                            <button class="text-red-500 hover:text-red-700" wire:click="deleteForm('{{ $inputSector['id'] }}')" title="Eliminar" wire:confirm="¿Estás seguro de eliminar este input?">
                                                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 6.75L17.25 21h-10.5L4.5 6.75M21 6.75h-18M14.25 10.5v6.75m-4.5-6.75v6.75M16.5 6.75v-.75A2.25 2.25 0 0014.25 3.75h-4.5A2.25 2.25 0 007.5 6v.75" />
                                                                                </svg>
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                            @empty
                                                                <div class="flex justify-center items-center h-48 bg-gray-50 border border-gray-300 rounded-lg p-4">
                                                                    <div class="text-center">
                                                                        <h2 class="text-md font-semibold text-gray-600 h-full">Aun no hay inputs creados para este sector</h2>
                                                                    </div>
                                                                </div>
                                                            @endforelse
                                                        </ul>
                                                    </div>
                                                </div>
                                     
                                            <div class="items-center justify-end gap-x-6 border-t border-gray-900/10 p-4 flex mt-2">
                                                <button wire:click="save" class="rounded-md bg-indigo-600 px-3 py-2 font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 text-sm focus-visible:outline-indigo-600">
                                                    {{ $selectedInput ? 'Actualizar' : 'Crear input' }}
                                                </button>
                                                @if($selectedInput)
                                                    <button wire:click="resetForm" class="rounded-md bg-gray-600 px-3 py-2 font-semibold text-white shadow-sm hover:bg-gray-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 text-sm focus-visible:outline-gray-600">
                                                        Cancelar edición
                                                    </button>
                                                @endif
                                            </div>
                                        @else
                                            <div class=" flex justify-center items-center h-48 bg-gray-50 border border-gray-300 rounded-lg p-4 m-4">
                                                <div class="text-center">
                                                    <h2 class="text-lg font-semibold text-gray-600">Ningún sector seleccionado</h2>
                                                    <p class="text-gray-500 mt-2">Selecciona un sector para empezar a configurar los formularios dinámicos.</p>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>