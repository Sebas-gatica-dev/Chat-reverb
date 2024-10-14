<div>
    <div class="col-span-3">
        <label for="modules" class="block text-sm font-medium leading-6 text-gray-900">Módulos</label>
        <div class="mt-2">
            <select wire:model.live="selectedModule" id="modules" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                <option value="">Seleccione un módulo</option>
                @foreach ($modules as $module)
                    <option value="{{ $module['id'] }}">{{ $module['name'] }}</option>
                @endforeach
            </select>
        </div>
    </div>

    @if ($selectedModule)
        <div class="col-span-3 mt-4">
            <label for="features" class="block text-sm font-medium leading-6 text-gray-900">Funciones</label>
            <div class="mt-2">
                <div x-data="{ open: false }" @click.away="open = false" class="relative mb-4">
                    <button @click="open = !open" type="button"
                        class="relative w-full cursor-default rounded-md bg-white py-1.5 pl-3 pr-10 text-left text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-600 sm:text-sm sm:leading-6"
                        aria-haspopup="listbox" :aria-expanded="open" aria-labelledby="listbox-label">
                        <span class="block truncate text-sm">
                            {{ count($selectedFeatures) }} Funciones(es) seleccionada(s)
                        </span>
                        <span class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2">
                            <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="none" stroke="currentColor">
                                <path d="M7 7l3-3 3 3m0 6l-3 3-3-3" />
                            </svg>
                        </span>
                    </button>

                    <ul x-show="open"
                        class="absolute z-10 mt-1 max-h-60 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm"
                        tabindex="-1" role="listbox" aria-labelledby="listbox-label">
                        @foreach ($features as $feature)
                            <li class="text-gray-900 text-sm relative cursor-default select-none py-2 pl-8 pr-4"
                                id="listbox-option-{{ $feature['id'] }}" role="option">
                                <button wire:click.prevent="toggleFeature('{{ $feature['id'] }}', '{{ $feature['name'] }}')"
                                    class="w-full text-left">
                                    <span class="font-normal block truncate">{{ $feature['name'] }}</span>
                                    @if (in_array($feature['id'], array_column($this->selectedFeatures, 'id')))
                                        <span class="text-indigo-600 absolute inset-y-0 left-0 flex items-center pl-1.5">
                                            <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                <path fill-rule="evenodd"
                                                    d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </span>
                                    @endif
                                </button>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif

    @if ($selectedModule)
        <div class="col-span-3 mt-4">
            <button type="button" wire:click="saveFeatures"
                class="inline-flex items-center rounded-md bg-indigo-600 px-2.5 py-1.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                Guardar Funciones Seleccionadas
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="-mr-0.5 h-5 w-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
            </button>
        </div>
    @endif
</div>
