<div>
    <div class="px-4 py-6 sm:p-8">
        <h1 class="sr-only">Edición de módulos</h1>

        <div class="mt-2 sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-base font-semibold leading-6 text-white">Editar módulo</h1>
                <p class="mt-2 text-sm text-gray-300">Llena el formulario para editar el módulo</p>
            </div>
            <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                <a wire:navigate href="{{ route('master.modules.index') }}"
                    class="inline-flex items-center gap-x-1.5 rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="-ml-0.5 h-5 w-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                    </svg>
                    Atrás
                </a>
            </div>
        </div>

        <div class="ring-1 ring-gray-900/5 sm:rounded-xl md:col-span-full mt-6" x-data="{ name: @entangle('name'), slug: @entangle('slug') }">
            <div class="grid w-full gap-x-6 gap-y-8 grid-cols-9 md:col-span-2">
                <div class="lg:col-span-3 col-span-full">
                    <label for="name" class="block text-sm font-medium leading-6 text-white">Nombre del
                        módulo</label>
                    <div class="mt-2">
                        <input type="text" wire:model="name" id="name" autocomplete="off"
                            placeholder="Ingrese el nombre del módulo"
                            class="block w-full rounded-md border-0 bg-white/5 py-1.5 text-white shadow-sm ring-1 ring-inset ring-white/10 focus:ring-2 focus:ring-inset focus:ring-indigo-500 text-sm sm:leading-6"
                            @input="slug = name.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/^-+|-+$/g, '')">
                    </div>
                    @error('name')
                        <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                    @enderror
                </div>

                <div class="lg:col-span-3 col-span-full">
                    <label for="slug" class="block text-sm font-medium leading-6 text-white">Slug del módulo</label>
                    <div class="mt-2">
                        <input type="text" wire:model.live="slug" id="slug" autocomplete="slug" x-model="slug"
                            class="block w-full rounded-md border-0 bg-white/5 py-1.5 text-white shadow-sm ring-1 ring-inset ring-white/10 focus:ring-2 focus:ring-inset focus:ring-indigo-500 text-sm sm:leading-6"
                            placeholder="Slug" disabled>
                    </div>
                    @error('slug')
                        <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                    @enderror
                </div>

                <div class="lg:col-span-3 col-span-full">
                    <label for="status" class="block text-sm font-medium leading-6 text-white">Estado</label>
                    <div class="mt-2">
                        <select wire:model.live="status" id="status"
                            class="block w-full rounded-md border-0 py-1.5 text-gray-200 bg-gray-800 shadow-sm ring-1 ring-inset ring-white/10 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs text-sm sm:leading-6">
                            <option value="">Seleccione una opción</option>
                            <option value="1">Activo</option>
                            <option value="0">Inactivo</option>
                        </select>
                    </div>
                    @error('status')
                        <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-span-9">
                    <label for="description" class="block text-sm font-medium leading-6 text-white">Descripción</label>
                    <div class="mt-2">
                        <textarea id="description" wire:model="description" rows="3"
                            class="block w-full rounded-md border-0 py-1.5 bg-white/5 text-white shadow-sm ring-1 ring-inset ring-white/10 ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
                    </div>
                    @error('description')
                        <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>

        <div class="flex items-center md:justify-between justify-start gap-x-6 py-4">
            <button wire:click="update()"
                class="rounded-md bg-indigo-600 px-3 py-2 font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 text-sm focus-visible:outline-indigo-600">Editar</button>
        </div>



    </div>

    <div class="px-4 py-6 sm:p-8" >
        <div class="bg-gray-900">
            <div class="mx-auto max-w-7xl">
                <div class="bg-gray-900 py-10">
                    <div class="sm:flex sm:items-center">
                        <div class="sm:flex-auto">
                            <h1 class="text-base font-semibold leading-6 text-white">Funciones</h1>
                            <p class="mt-2 text-sm text-gray-300">Lista de funciones asociadas al modulo
                                {{ $module->name }}</p>
                        </div>
                        <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                            <a wire:navigate href="{{ route('master.modules.feature.create', $module->id) }}"
                                class="block rounded-md cursor-pointer bg-indigo-500 px-3 py-2 text-center text-sm font-semibold text-white hover:bg-indigo-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">Nueva funcion</a>
                        </div>
                    </div>
                    <div class="mt-8 flow-root">
                        <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">



                                <table class="min-w-full divide-y divide-gray-700">
                                    <thead>
                                        <tr>


                                            <th scope="col"
                                                class="px-3 py-3.5 text-left text-sm font-semibold text-white">
                                                Nombre</th>
                                            <th scope="col"
                                                class="px-3 py-3.5 text-left text-sm font-semibold text-white">
                                                Archivo
                                            </th>
                                            <th scope="col"
                                                class="px-3 py-3.5 text-left text-sm font-semibold text-white">
                                                Descripción</th>
                                            <th scope="col"
                                                class="py-2 pl-0 pr-4 text-right font-semibold sm:pr-8 text-white text-sm sm:text-left lg:pr-20">
                                                Estado</th>

                                            <th scope="col"
                                                class="relative py-3.5 text-right font-semibold pl-3 pr-4 text-white text-sm">
                                                <span class="sr-only">Acciones</span>Acciones
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-800">
                                        @forelse ($features as $feature)
                                            <!-- Selected: "bg-gray-50" -->

                                            <tr wire:key="{{ $feature->id }}">

                                                <td
                                                    class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-white sm:pl-0">
                                                    {{ $feature->name }} </td>
                                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-300">
                                                    {{ $feature->file ? $feature->file : 'Sin archivo' }}</td>
                                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-300">
                                                    {{ $feature->description }}</td>
                                                <td class="py-4 pl-0 pr-4 text-sm leading-6 sm:pr-8 lg:pr-20">
                                                    <div
                                                        class="flex items-center justify-end gap-x-2 sm:justify-start">
                                                        @if ($feature->deleted_at)
                                                            <div
                                                                class="flex-none rounded-full bg-rose-400/10 p-1 text-rose-400">
                                                                <div class="h-1.5 w-1.5 rounded-full bg-current">
                                                                </div>
                                                            </div>
                                                            <div class="hidden text-white sm:block">Inactiva</div>
                                                        @else
                                                            <div
                                                                class="flex-none rounded-full bg-green-400/10 p-1 text-green-400">
                                                                <div class="h-1.5 w-1.5 rounded-full bg-current">
                                                                </div>
                                                            </div>
                                                            <div class="text-white sm:block">Activa</div>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td
                                                    class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-0">


                                                    @if ($feature->deleted_at)
                                                        <button
                                                            wire:click="forceDeleteFeature('{{ $feature->id }}')"
                                                            wire:confirm="¿Estás seguro de que deseas eliminar esta funcion?"
                                                            class="text-red-600 hover:text-red-900 ml-4">Eliminar</button>

                                                        <button
                                                            wire:click="restoreFeature('{{ $feature->id }}')"
                                                            class="text-green-600 hover:text-green-900 ml-4">Activar</button>
                                                    @else
                                                   <a wire:navigate href="{{ route('master.modules.feature.edit', [$module->id, $feature->id ]) }}"


                                                            class="text-indigo-600 hover:text-indigo-900">Editar<span
                                                                class="sr-only">{{ $feature->name }}</span></a>
                                                        <button wire:click="softDeleteFeature('{{ $feature->id }}')"
                                                            class="text-red-600 hover:text-red-900 ml-4">Desactivar</button>
                                                    @endif
                                            </tr>
                                        @empty
                                            <tr>
                                                <td class="py-4 pl-4 pr-3 text-sm font-medium text-white sm:pl-0"
                                                    colspan="6">No hay funciones asociadas a este modulo.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>

                                {{ $features->links(data: ['scrollTo' => false]) }}

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>
