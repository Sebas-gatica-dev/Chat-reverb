<div>

   @if($label) <label id="listbox-label" class="block text-sm font-medium leading-6 text-gray-900">{{ $label }}</label> @endif
    <div class="relative" x-data="{ open: false }" @click.away="open = false" x-cloak>
        <button type="button"
            class="relative w-full cursor-default rounded-md bg-white py-1.5 pl-3 pr-10 text-left text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 sm:text-sm sm:leading-6"
            aria-haspopup="listbox" aria-expanded="true" aria-labelledby="listbox-label" @click="open = !open">
            <span class="flex items-center">
                @if ($imageValue)
                <img src="{{ asset('camera.webp') }}"
                alt="camera" class="h-5 w-5 flex-shrink-0 rounded-full">
                @endif
                <span class="{{ ($imageValue == null) ? '' : 'ml-3' }} block truncate text-sm">
                    @if ($selectedValue)
                        {{ $selectedValue['name'] }}
                    @else
                        Seleccionar una opción
                    @endif
                </span>
                <span class="pointer-events-none absolute inset-y-0 right-0 ml-3 flex items-center pr-2">
                    <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd"
                            d="M10 3a.75.75 0 01.55.24l3.25 3.5a.75.75 0 11-1.1 1.02L10 4.852 7.3 7.76a.75.75 0 01-1.1-1.02l3.25-3.5A.75.75 0 0110 3zm-3.76 9.2a.75.75 0 011.06.04l2.7 2.908 2.7-2.908a.75.75 0 111.1 1.02l-3.25 3.5a.75.75 0 01-1.1 0l-3.25-3.5a.75.75 0 01.04-1.06z"
                            clip-rule="evenodd" />
                    </svg>
                </span>
            </span>
        </button>


        <ul class="absolute z-10 max-h-56 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm"
            tabindex="-1" role="listbox" aria-labelledby="listbox-label" aria-activedescendant="listbox-option-3" x-cloak
            x-show="open" x-transition:enter="" x-transition:leave="transition ease-in duration-100 opacity-0"
            @keydown.arrow-up.prevent="open = true" @keydown.arrow-down.prevent="open = true"
            @keydown.escape="open = false" @keydown.enter.prevent="open = false" @keydown.tab="open = false">

            @if($searchEnabled)

            <div class="relative">
                <input type="text" wire:model.live="search" class="block w-full border-0 bg-white py-1.5 text-gray-900 focus:ring-0 text-sm sm:leading-6" placeholder="Escribe para buscar...">
                <div class="absolute inset-x-0 bottom-0 border-t border-indigo-100 peer-focus:border-t-2 peer-focus:border-indigo-600" aria-hidden="true"></div>
              </div>
            @endif

            @forelse ($values as $key => $value)
            <li wire:key="value-{{ $key }}" class="relative cursor-default select-none py-2 pl-3 pr-9 hover:bg-indigo-50 text-gray-900 text-sm"
                id="listbox-option-{{ $key }}" role="option" wire:click="selectValue('{{ $value['id'] }}')" @click="open = false">
                <div class="flex items-center">
                    @if ($imageValue)
                        <img src="{{ $value['image'] }}" alt="{{ $value['name'] }}" class="h-5 w-5 flex-shrink-0 rounded-full">
                    @endif
                    <span class="{{ ($imageValue == null) ? '' : 'ml-3' }} block truncate {{ $value == $selectedValue ? 'font-semibold' : 'font-normal' }}">
                        {{ $value['name'] }}
                    </span>
        
                    @if($model)
                        <span class="ml-2 truncate text-gray-500">{{ $value['model'] }}</span>
                    @endif
                </div>
        
                @if ($value == $selectedValue)
                    <span class="absolute inset-y-0 right-0 flex items-center pr-4 text-indigo-600 ">
                        <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
                        </svg>
                    </span>
                @endif
            </li>
        @empty
            <li class="relative cursor-default select-none py-2 pl-3 pr-9 hover:bg-indigo-50 text-gray-900">
                <span class="{{ ($imageValue == null) ? '' : 'ml-3' }} block font-normal">
                    No se encontraron resultados
                </span>
            </li>
        @endforelse
        

        </ul>
    </div>
</div>
