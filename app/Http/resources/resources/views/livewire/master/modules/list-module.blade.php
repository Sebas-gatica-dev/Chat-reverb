<div>

    <h1 class="sr-only">Lista de modulos</h1>


    <div class="bg-gray-900">
        <div class="mx-auto max-w-7xl">
          <div class="bg-gray-900 py-10">
            <div class="px-4 sm:px-6 lg:px-8">
              <div class="sm:flex sm:items-center">
                <div class="sm:flex-auto">
                  <h1 class="text-base font-semibold leading-6 text-white">Modulos</h1>
                  <p class="mt-2 text-sm text-gray-300">Lista de modulos creados</p>
                </div>
                <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                    <a wire:navigate href="{{ route('master.modules.create') }}"
                    wire:navigate
                  class="block rounded-md cursor-pointer bg-indigo-500 px-3 py-2 text-center text-sm font-semibold text-white hover:bg-indigo-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">Nuevo Modulo</a>
                </div>
              </div>
              <div class="mt-8 flow-root">
                <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                  <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                    <table class="min-w-full divide-y divide-gray-700">
                      <thead>
                        <tr>
                          <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-white sm:pl-0">Nombre</th>
                          <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-white">Descripcion</th>
                          <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-white">Estado</th>
                          <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-0">
                            <span class="sr-only">Acciones</span>
                          </th>
                        </tr>
                      </thead>
                      <tbody class="divide-y divide-gray-800">
                        @forelse ($modules as $module)
                        <div wire:key="{{ $module->id }}">
                        <tr>
                          <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-white sm:pl-0">{{ $module->name }}</td>
                          <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-300"> {{ $module->description }}</td>
                          <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-300">
                            @if (!$module->deleted_at)
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                              Activo
                            </span>
                            @else
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                              Inactivo
                            </span>
                            @endif

                          </td>
                          <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-0">
                            <a wire:navigate href="{{ route('master.modules.edit', $module->id) }}" class="text-indigo-600 hover:text-indigo-900">Editar</a>
                            </td>
                        </tr>
                    </div>
                        @empty
                        <tr>
                          <td class="whitespace
                            -nowrap py-4 pl-4 pr-3 text-sm font-medium text-white sm:pl-0">No hay modulos creados aun</td>
                        @endforelse
                        <!-- More people... -->
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>



</div>
