<div>
    <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl md:col-span-3">
        <div class="px-4 py-6 sm:p-8">
            <div class="grid w-full grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-12">
                <div class="sm:col-span-3">
                    <label for="number" class="block text-sm font-medium leading-6 text-gray-900">Teléfono del
                        cliente</label>
                    <div class="mt-2">
                        <input id="number" wire:model="number" type="text" autocomplete="number"
                            placeholder="(011) 1234-5678"
                            class="block text-sm w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>

                    @error('number')
                        <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                    @enderror
                </div>

                <div class="sm:col-span-3">
                    <label for="phoneModel" class="block text-sm font-medium leading-6 text-gray-900">Vincular
                        con</label>
                    <div class="mt-2">
                        <select id="phoneModel" wire:model="phoneModel" autocomplete="phoneModel"
                            class="block w-full rounded-md border-0 py-1.5 text-sm text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                            <option value="">Seleccione una opción</option>
                            <option value="customer">Cliente</option>
                            <option value="property">Propiedad</option>
                        </select>
                    </div>
                    @error('phoneModel')
                        <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                    @enderror
                </div>
                <div class="sm:col-span-3">
                    <label for="tagNumber" class="block text-sm font-medium leading-6 text-gray-900">Etiqueta del
                        contacto</label>
                    <div class="mt-2">
                        <input id="tagNumber" wire:model="tagNumber" type="text" autocomplete="tagNumber"
                            placeholder="Personal, Trabajo, etc"
                            class="block w-full text-sm rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                    @error('tagNumber')
                        <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                    @enderror
                </div>



                <div class="sm:col-span-1 flex items-center">
                    <fieldset>

                        {{-- <p class="mt-1 text-sm leading-6 text-gray-600">These are delivered via SMS to your mobile phone.</p> --}}
                        <div class="mt-1 space-y-1">
                            <div class="flex items-center gap-x-3">
                                <input id="typeNumber" wire:model="typeNumber" type="radio" value="0"
                                    class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600">
                                <label for="typeNumber"
                                    class="block text-sm font-medium leading-6 text-gray-900">Celular</label>
                            </div>
                            <div class="flex items-center gap-x-3">
                                <input id="typeNumber" wire:model="typeNumber " type="radio" value="1"
                                    class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600">
                                <label for="typeNumber"
                                    class="block text-sm font-medium leading-6 text-gray-900">Teléfono</label>
                            </div>

                        </div>

                        @error('typeNumber')
                            <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                        @enderror
                    </fieldset>
                </div>

                <div class="sm:col-span-2 flex items-center justify-center">

                    <button type="button" wire:click="addPhone"
                        class="inline-flex items-center gap-x-1.5 rounded bg-gray-700 px-2 py-1 text-xs font-semibold text-white shadow-sm hover:bg-gray-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-700">
                        Agregar
                        <svg class="-mr-0.5 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                            fill="currentColor" class="w-5 h-5">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm.75-11.25a.75.75 0 0 0-1.5 0v2.5h-2.5a.75.75 0 0 0 0 1.5h2.5v2.5a.75.75 0 0 0 1.5 0v-2.5h2.5a.75.75 0 0 0 0-1.5h-2.5v-2.5Z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>

                </div>
            </div>
        </div>
    </div>

    <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl md:col-span-12 mt-6">
        <div class="px-4 py-6 sm:p-8">
            <div class="w-full">

                @if ($phones)
                    <ul class="space-y-4" wire:sortable="updateTaskOrder" x-data="{ isPressed: false }">
                        @foreach ($phones as $phone)
                            <li class="relative flex items-center bg-white border border-gray-200 shadow-sm rounded-lg p-4 hover:bg-gray-50 transition-opacity"
                                wire:key="phone-{{ $phone['id'] }}" wire:sortable.item="{{ $phone['id'] }}">
                                <div class="flex items-center gap-4 w-full cursor-move" wire:sortable.handle
                                    @mousedown="isPressed = true" @mouseup="isPressed = false">
                                    <div class="flex flex-col">
                                        <p class="text-lg font-semibold text-gray-800">{{ $phone['number'] }}</p>
                                        <div class="flex gap-2 mt-1  w-full">
                                            @if ($loop->index == 0)
                                                <span
                                                    class="inline-block px-2 py-0.5 text-xs border border-red-600 text-white bg-red-700 rounded-md">Principal</span>
                                            @endif
                                            <span
                                                class="inline-block px-2 py-0.5 text-xs border border-green-300 text-green-800 bg-green-100 rounded-md">{{ $phone['tag'] }}</span>
                                            <span
                                                class="inline-block px-2 py-0.5 text-xs border border-yellow-400 text-yellow-800 bg-yellow-100 rounded-md">{{ $phone['type'] == 0 ? 'Celular' : 'Fijo' }}</span>
                                            <span
                                                class="inline-block px-2 py-0.5 text-xs border border-indigo-400 text-indigo-800 bg-indigo-100 rounded-md">{{ $phone['model'] == 'customer' ? 'Cliente' : 'Propiedad' }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="relative" x-data="{ open: false }">
                                    <button @click="open = !open" class="p-2 text-gray-500 hover:text-gray-900">
                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 12h12M6 6h12M6 18h12"></path>
                                        </svg>
                                    </button>
                                    <div x-show="open" @click.away="open = false" x-cloak
                                        class="absolute right-0 mt-2 w-36 bg-white rounded-lg shadow-lg z-10">
                                        <a wire:click="removePhone('{{ $phone['id'] }}')"
                                            class="block px-4 py-2 text-sm text-red-600 hover:bg-red-50 cursor-pointer">Eliminar</a>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <div class="text-center w-full   md:rounded-b-md col-span-12">
                        <div class=" rounded-md">
                            <div class="rounded-md bg-yellow-50 p-4 border border-yellow-600 shadow-sm">
                                <div class="text-sm font-medium text-yellow-700 text-center ">
                                    <p>Todavía no agregaste ningún teléfono</p>
                                </div>
                            </div>
                        </div>
                    </div>

                @endif

            </div>
        </div>
    </div>
</div>
