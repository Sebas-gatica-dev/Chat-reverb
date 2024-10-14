<div>

    <h1 class="sr-only">Lista de negocios</h1>


    <div class="bg-gray-900">
        <div class="mx-auto max-w-7xl">
          <div class="bg-gray-900 py-10">
            <div class="px-4 sm:px-6 lg:px-8">
              <div class="sm:flex sm:items-center">
                <div class="sm:flex-auto">
                  <h1 class="text-base font-semibold leading-6 text-white">Negocios</h1>
                  <p class="mt-2 text-sm text-gray-300">Lista de negocios creados</p>
                </div>
                <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                    <a wire:navigate href="{{ route('master.businesses.create') }}"

                  class="block rounded-md cursor-pointer bg-indigo-500 px-3 py-2 text-center text-sm font-semibold text-white hover:bg-indigo-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">Nuevo Negocio</a>
                </div>
              </div>
              <div class="mt-8 flow-root">
                <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                  <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                    <table class="min-w-full divide-y divide-gray-700">
                      <thead>
                        <tr>
                          <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-white sm:pl-0">Nombre</th>
                          <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-white">Email</th>
                          <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-white">Telefono</th>
                          <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-white">Direccion</th>
                          <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-white">Creador</th>
                          <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-0">
                            <span class="sr-only">Acciones</span>
                          </th>
                        </tr>
                      </thead>
                      <tbody class="divide-y divide-gray-800">
                        @forelse ($businesses as $business)
                        <div wire:key="{{ $business->id }}">
                        <tr>
                          <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-white sm:pl-0">{{ $business->name }}</td>
                          <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-300"> {{ $business->email }}</td>
                          <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-300"> {{ $business->phone }}</td>
                          <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-300"> {{ $business->address }}</td>
                          <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-300"> {{ $business->createdBy ? $business->createdBy->name : 'Desconocido' }}</td>
                          <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-0">
                            <a wire:navigate href="{{ route('master.businesses.edit', $business->id) }}" class="text-indigo-600 hover:text-indigo-900">Editar</a>
                            </td>
                        </tr>
                    </div>
                        @empty
                        <tr>
                          <td class="whitespace
                            -nowrap py-4 pl-4 pr-3 text-sm font-medium text-white sm:pl-0">No hay negocios creados aun</td>
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
