<div>
  <div class="mx-auto max-w-screen-2xl pt-2 lg:flex lg:gap-x-16 lg:px-8">
      <h1 class="sr-only">Configuracion de Depositos</h1>

      <aside
          class="flex overflow-x-auto border-b border-gray-900/5 py-4 lg:block lg:w-64 lg:flex-none lg:border-0 lg:py-20">

          @include('components.panel.settings.menu-side-bar-settings')

      </aside>
      <main class="px-4 py-16 sm:px-6 lg:flex-auto lg:px-0 lg:py-20">
          <div class="mx-auto max-w-2xl space-y-16 sm:space-y-20 lg:mx-0 lg:max-w-none">

              <div class="sm:flex sm:items-center" x-data="{ open: false }">
                  <div class="sm:flex-auto">
                      <h1 class="text-base font-semibold leading-6 text-gray-900">Depositos</h1>
                      <p class="mt-2 text-sm text-gray-700">Administra los depositos de tu inventario.
                      </p>
                  </div>
                 
                  <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                      @can('access-function', 'stock-warehouse-add')
                      <a href={{ route('panel.settings.stock.warehouse.create') }} wire:navigate
                          class="cursor-pointer block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                         Agregar deposito
                      </a>
                      @endcan
                  </div>
              </div>
              <div class="mt-8 flow-root">
                  <div
                      class="-mx-4 -mt-2 mb-4 overflow-x-auto sm:-mx-6 lg:mx-0 sm:shadow sm:rounded-lg bg-white  border-t border-gray-200">
                      <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-4">
                          <table class="min-w-full divide-y divide-gray-300">
                              <thead>
                                  <tr>
                                      <th scope="col"
                                          class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">
                                          Nombre</th>
                                      <th scope="col"
                                          class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Direccion
                                      </th>
                                      <th scope="col"
                                          class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Creado por
                                      </th>
                                      <th scope="col"
                                          class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Estado
                                      </th>
                                      {{-- <th scope="col"
                                                  class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Role
                                              </th> --}}
                                      {{-- @if(Gate::allows('access-function', 'branch-edit') || Gate::allows('access-function', 'branch-soft') || Gate::allows('access-function', 'branch-delete'))   --}}
                                      <th scope="col" class="relative py-3.5 pl-3 pr-16 sm:pr-11">
                                          <span class="sr-only">Editar</span>Acciones 

                                          <svg wire:loading.inline wire:target="restoreBranch, forceDeleteBranch, deleteBranch" class="absolute right-1 hidden animate-spin mx-4 h-5 w-5 text-gray-800" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                              <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                              <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                            </svg>
                                      </th>
                                      {{-- @endif --}}
                                  </tr>
                              </thead>
                              <tbody class="divide-y divide-gray-200">

                                  @forelse ($warehouses as $warehouse)
                                  {{-- @dd($warehouse->id) --}}
                                      <div wire:key="{{ $warehouse->id }}">
                                          <tr>
                                              <td
                                                  class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-0">
                                                  {{ $warehouse->name }}</td>
                                              <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                  {{ $warehouse->address }}
                                              </td>
                                              <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                  {{ $warehouse->createdBy->name }}
                                              </td>

                                              <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                  <div class="flex items-center justify-end gap-x-2 sm:justify-start">
                                                      @if ($warehouse->deleted_at)
                                                          <div
                                                              class="flex-none rounded-full bg-rose-400/10 p-1 text-rose-400">
                                                              <div class="h-1.5 w-1.5 rounded-full bg-current"></div>
                                                          </div>
                                                          <div class="sm:block">Inactiva</div>
                                                      @else
                                                          <div
                                                              class="flex-none rounded-full bg-green-400/10 p-1 text-green-400">
                                                              <div class="h-1.5 w-1.5 rounded-full bg-current"></div>
                                                          </div>
                                                          <div class="sm:block">Activa</div>
                                                      @endif
                                                  </div>
                                              </td>

                                              <td
                                                  class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-0">

                                                      @can('access-function', 'stock-warehouse-edit')
                                                          <a wire:navigate
                                                              href="{{ route('panel.settings.stock.warehouse.edit',$warehouse->id) }}"
                                                              class="text-indigo-600 hover:text-indigo-900">Editar<span
                                                                  class="sr-only">{{ $warehouse->name }}</span></a>
                                                      @endcan
                                                      @can('access-function', 'stock-warehouse-soft')
                                                          <button wire:click="deleteWarehouse('{{ $warehouse->id }}')"
                                                              class="text-red-600 hover:text-red-900 ml-4">Eliminar</button>
                                                      @endcan

                                              </td>
                                          </tr>
                                      @empty
                                          <tr>
                                              <td
                                                  class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-500">
                                                  No hay depositos registradas
                                              </td>
                                          </tr>
                                  @endforelse

                      </div>

                      <!-- More people... -->
                      </tbody>
                      </table>
                  </div>
              </div>

              {{ $warehouses->links(data: ['scrollTo' => false]) }}
          </div>

  </div>
  </main>




</div>

</div>
