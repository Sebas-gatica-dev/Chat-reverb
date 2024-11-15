<div>
    @if ($type == 'role')
    <label for="created_by"
    class="block text-sm font-medium leading-6 text-gray-900">Rol creado por </label>
    @else

    <label for="user" class="block text-sm font-medium leading-6 text-white">Usuario</label>
    @endif

    <div class="mt-2">
        <div x-data="{ open: false }" @click.away="open = false" @keyup.escape= "open = false" class="relative mb-4">
            <button @click="open = !open" type="button"
                class="relative w-full cursor-default rounded-md bg-white py-1.5 pl-3 pr-10 text-left text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-600 sm:text-sm sm:leading-6"
                aria-haspopup="listbox" :aria-expanded="open" aria-labelledby="listbox-label">
                <span class="block truncate text-sm"> {{ $selectedUser ?  $selectedUser->name : 'Seleccione un usuario' }} </span>
                <span class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2">
                    <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="none" stroke="currentColor">
                        <path d="M7 7l3-3 3 3m0 6l-3 3-3-3" />
                    </svg>
                </span>
            </button>
            <div x-show="open" x-cloak class="absolute z-10 mt-1 w-full bg-white rounded-md shadow-lg">
                <input type="text" wire:model.live.debounce.300ms="searchTerm" placeholder="Buscar usuario..."
                    class="w-full px-3 py-2 border-b border-gray-300 text-sm focus:outline-none focus:ring-1 focus:ring-indigo-600 focus:border-indigo-600" />
                <ul class="max-h-60 w-full overflow-auto py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm"
                    tabindex="-1" role="listbox" aria-labelledby="listbox-label">
                    @forelse ($users as $user)
                        <li class="text-gray-900 text-sm relative cursor-default select-none py-2 pl-8 pr-4"
                            id="listbox-option-{{ $user['id'] }}" role="option">
                            <button wire:click.prevent="selectUser('{{ $user['id'] }}')" class="w-full text-left" @click="open = false" >
                                <span class="font-normal block truncate">{{ $user['name'] }}</span>
                                @if (isset($selectedUser) && $selectedUser->id == $user['id'])
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
                    @empty
                        <li class="text-gray-900 text-sm relative cursor-default select-none py-2 pl-8 pr-4">No se
                            encontraron usuarios.</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</div>