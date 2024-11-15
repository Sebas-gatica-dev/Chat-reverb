@php
use App\Enums\Units\UnitsStatusEnum;
use App\Enums\Units\UnitMeditionTypeEnum;
    
@endphp
<div>
  <header class="bg-white shadow">
      <div class="mx-auto max-w-screen-2xl px-4 py-4 sm:px-6 lg:px-8">
          <div class="flex justify-between items-center">
              <div class="min-w-0 sm:flex-1">
                  <h1 class="items-center text-[1em] sm:text-2xl sm:mt-2 font-bold tracking-tight text-gray-900">
                    Unidades de inventario del producto {{ $product->name }}
                  </h1>
              </div>

              {{-- @can('access-function', 'customer-add') --}}
              <div class="mt-4 flex md:ml-4 md:mt-0">
                <a wire:navigate href="{{ route('panel.stock.list') }}"
                    class="inline-flex items-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">Volver</a>
            </div>
              {{-- @endcan --}}
          </div>
      </div>
  </header>


  <section aria-labelledby="filter-heading" class="border-b border-t border-gray-200 bg-slate-100"
  x-data="{ openFilters: false }">
  <h2 id="filter-heading" class="sr-only">Filters</h2>
  <div class="max-w-screen-2xl mx-auto sm:grid items-center sm:grid-cols-3">


      <div class="relative flex justify-between sm:justify-none sm:block sm:col-span-1  items-center sm:py-4">
          <div
              class="sm:mx-auto flex max-w-screen-2xl space-x-6 divide-x divide-gray-200 px-4 text-sm sm:px-6 lg:px-8">
              <div>
                  <button type="button" class="group flex items-center font-medium text-gray-700"
                      aria-controls="disclosure-1" aria-expanded="false" @click="openFilters = !openFilters">
                      <svg class="mr-2 h-5 w-5 flex-none text-gray-400 group-hover:text-gray-500"
                          aria-hidden="true" viewBox="0 0 20 20" fill="currentColor">
                          <path fill-rule="evenodd"
                              d="M2.628 1.601C5.028 1.206 7.49 1 10 1s4.973.206 7.372.601a.75.75 0 01.628.74v2.288a2.25 2.25 0 01-.659 1.59l-4.682 4.683a2.25 2.25 0 00-.659 1.59v3.037c0 .684-.31 1.33-.844 1.757l-1.937 1.55A.75.75 0 018 18.25v-5.757a2.25 2.25 0 00-.659-1.591L2.659 6.22A2.25 2.25 0 012 4.629V2.34a.75.75 0 01.628-.74z"
                              clip-rule="evenodd" />
                      </svg>
                      {{ !$countFilters ? 'Filtros' : $countFilters . ' Filtros' }}
                  </button>
              </div>
              <div class="pl-6">
                  <button type="button" class="text-gray-500 text-sm" wire:click="resetFilters">Limpiar
                      filtros</button>
              </div>



          </div>
          <!-- Sorting -->
          <div class="sm:hidden col-span-1 py-4">
              <div class="mx-auto flex items-center max-w-screen-2xl justify-end px-4 sm:px-6 lg:px-8">



                  <div class="relative inline-block" x-data="{ open: false }" @click.away="open = false"
                      @close.stop="open = false">
                      <div class="flex">
                          <button type="button"
                              class="group inline-flex justify-center text-sm font-medium text-gray-700 hover:text-gray-900"
                              id="menu-button" aria-expanded="false" aria-haspopup="true" @click="open = !open"
                              aria-controls="menu" aria-label="Filters">
                              Ordenar
                              <svg class="-mr-1 ml-1 h-5 w-5 flex-shrink-0 text-gray-400 group-hover:text-gray-500"
                                  viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                  <path fill-rule="evenodd"
                                      d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                                      clip-rule="evenodd" />
                              </svg>
                          </button>
                      </div>

                      <div class="absolute right-0 z-10 mt-2 w-40 origin-top-right rounded-md bg-white shadow-2xl ring-1 ring-black ring-opacity-5 focus:outline-none"
                          role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1"
                          x-show="open" x-transition:enter="transition ease-out duration-100"
                          x-transition:enter-start="transform opacity-0 scale-95"
                          x-transition:enter-end="transform opacity-100 scale-100"
                          x-transition:leave="transition ease-in duration-75"
                          x-transition:leave-start="transform opacity-100 scale-100"
                          x-transition:leave-end="transform opacity-0 scale-95" x-cloak>

                          <div class="py-1" role="none">
                              <a class="block px-4 py-2 text-sm text-gray-500 hover:bg-gray-100 hover:text-gray-900 {{ $sort === 'newest' ? 'font-medium text-gray-900' : '' }}"
                                  role="menuitem" tabindex="-1" id="menu-item-0"
                                  wire:click="updateSort('newest')">Más
                                  recientes</a>
                              <a class="block px-4 py-2 text-sm text-gray-500 hover:bg-gray-100 hover:text-gray-900 {{ $sort === 'oldest' ? 'font-medium text-gray-900' : '' }}"
                                  role="menuitem" tabindex="-1" id="menu-item-1"
                                  wire:click="updateSort('oldest')">Más
                                  antiguos</a>
                          </div>
                      </div>
                  </div>

              </div>
          </div>

      </div>

      <!-- Centro: Input de Búsqueda -->
      <div class="relative col-span-1 py-2 hidden sm:block">
          <div class="w-full">
              <input type="text" wire:model.live.debounce.500ms="searchTerm"
                  class="bg-transparent block w-full border-0 border-b border-slate-300 focus:border-slate-400 focus:ring-0 sm:text-sm"
                  placeholder="Buscar..." />
          </div>
      </div>

      <div class="hidden sm:block col-span-1 py-4">
          <div class="mx-auto flex items-center max-w-screen-2xl justify-end px-4 sm:px-6 lg:px-8">



              <div class="relative inline-block" x-data="{ open: false }" @click.away="open = false"
                  @close.stop="open = false">
                  <div class="flex">
                      <button type="button"
                          class="group inline-flex justify-center text-sm font-medium text-gray-700 hover:text-gray-900"
                          id="menu-button" aria-expanded="false" aria-haspopup="true" @click="open = !open"
                          aria-controls="menu" aria-label="Filters">
                          Ordenar
                          <svg class="-mr-1 ml-1 h-5 w-5 flex-shrink-0 text-gray-400 group-hover:text-gray-500"
                              viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                              <path fill-rule="evenodd"
                                  d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                                  clip-rule="evenodd" />
                          </svg>
                      </button>
                  </div>

                  <div class="absolute right-0 z-10 mt-2 w-40 origin-top-right rounded-md bg-white shadow-2xl ring-1 ring-black ring-opacity-5 focus:outline-none"
                      role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1"
                      x-show="open" x-transition:enter="transition ease-out duration-100"
                      x-transition:enter-start="transform opacity-0 scale-95"
                      x-transition:enter-end="transform opacity-100 scale-100"
                      x-transition:leave="transition ease-in duration-75"
                      x-transition:leave-start="transform opacity-100 scale-100"
                      x-transition:leave-end="transform opacity-0 scale-95" x-cloak>

                      <div class="py-1" role="none">
                          <a class="block px-4 py-2 text-sm text-gray-500 hover:bg-gray-100 hover:text-gray-900 {{ $sort === 'newest' ? 'font-medium text-gray-900' : '' }}"
                              role="menuitem" tabindex="-1" id="menu-item-0"
                              wire:click="updateSort('newest')">Más
                              recientes</a>
                          <a class="block px-4 py-2 text-sm text-gray-500 hover:bg-gray-100 hover:text-gray-900 {{ $sort === 'oldest' ? 'font-medium text-gray-900' : '' }}"
                              role="menuitem" tabindex="-1" id="menu-item-1"
                              wire:click="updateSort('oldest')">Más
                              antiguos</a>
                      </div>
                  </div>
              </div> 

          </div>
      </div>


  </div>

  <div class="border-t border-gray-200 md:py-10 py-5 col-span-3 bg-white shadow-sm" id="disclosure-1"
      x-show="openFilters" x-transition:enter="transition ease-out duration-100"
      x-transition:enter-start="transform opacity-0 scale-95"
      x-transition:enter-end="transform opacity-100 scale-100"
      x-transition:leave="transition ease-in duration-75"
      x-transition:leave-start="transform opacity-100 scale-100"
      x-transition:leave-end="transform opacity-0 scale-95" x-cloak>
      <div
          class="mx-auto grid max-w-screen-2xl grid-cols-1 lg:grid-cols-2 gap-y-4 lg:gap-x-6 px-4 text-sm sm:px-6 lg:px-8">
          <!-- First Row -->
          <div class="grid auto-rows-min grid-cols-1 md:gap-y-10 gap-y-4 md:grid-cols-2 md:gap-x-6">
          
              <!-- Date Picker -->
              <fieldset>
                  <legend class="block font-medium">Rango fecha de alta</legend>
                  <div class="space-y-4 pt-2">
                      <livewire:components.date-picker :name="'entryDate'" :defaultRange="'Año actual'" :rangeOptions="[
                          'Último mes',
                          'Hoy',
                          'Anteriores 7 días',
                          'Anteriores 15 días',
                          'Anteriores 30 días',
                          'Mes actual',
                          'Año actual',
                      ]" 
                       :key="'1323112SDasd'"
                      />
                  </div>
              </fieldset>
              <fieldset>
                <legend class="block font-medium">Rango fecha de vencimiento</legend>
                <div class="space-y-4 pt-2">
                    <livewire:components.date-picker :name="'expirationDate'" :defaultRange="'Año actual'" :rangeOptions="[
                        'Último mes',
                        'Hoy',
                        'Próximos 7 días',
                        'Próximos 15 días',
                        'Próximos 30 días',
                        'Mes actual',
                        'Año actual',
                    ]" 
                    
                    :key="'13112SDasd'"
                    />
                </div>
            </fieldset>

        

          </div>

          <div class="grid auto-rows-min grid-cols-1 md:gap-y-10 gap-y-4 md:grid-cols-2 md:gap-x-6">

            <fieldset>
                <legend class="block font-medium">Selecciona un estado.</legend>
                <div class="space-y-4 pt-2">
                    {{-- @dump($selectedStatus) --}}
                    <livewire:components.select-general :selectedValue="$selectedStatus" :values="$listStatus" :imageValue="false"
                        :searchEnabled="false" :name="'unitStatus'" :model="false">
                </div>
            </fieldset>

            <fieldset>
                <legend class="block font-medium">Ubicacion de unidad</legend>
                <div class="space-y-4 pt-2">
                    <livewire:components.select-general :selectedValue="$selectedUnitUbication" :values="$selectUnitUbication" :imageValue="false"
                        :searchEnabled="true" :name="'unitUbication'" :model="true">
                </div>
            </fieldset>

          </div>            
     
      </div>
  </div>


</section>

  


  <div class="mx-auto max-w-screen-2xl">
      <div class="mt-1 flow-root">
          <div class="overflow-x-auto">
              <div class="inline-block min-w-full py-6 align-middle md:px-6 lg:px-8">
                  <table
                      class="min-w-full divide-y divide-gray-300 bg-white ring-1 ring-black ring-opacity-5 md:rounded-lg md:shadow">
                  
                        <thead class="">
                            <tr>
                                @foreach(['Tag', 'Fecha de ingreso', 'Fecha vencimiento', 'Lote', 'Costo', 'Ganancia', 'Status', 'Valor actual', 'Paradero', 'Acciones'] as $header)
                                    <th scope="col" class="px-6 py-3.5 text-left text-sm font-semibold text-gray-900  ">
                                        {{ $header }}
                                    </th>
                                @endforeach
                            </tr>
                        </thead>
                
                      <tbody class="divide-y divide-gray-200">
                  
                        @forelse($units as $unit)
                            <tr wire:key="{{ $unit->id }}" class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 rounded-lg">
                                    <div class="flex items-center">
                                        <span>{{ $unit->tag ?? 'no definido' }}</span>
                                

                                        <div x-data="{ copied: false }" class="ml-2 relative">
                                            <button @click="navigator.clipboard.writeText('{{ $unit->tag }}'); copied = true; setTimeout(() => copied = false, 2000)"
                                                    class="text-gray-500 hover:text-gray-700 focus:outline-none">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                    <path d="M8 3a1 1 0 011-1h2a1 1 0 110 2H9a1 1 0 01-1-1z" />
                                                    <path d="M6 3a2 2 0 00-2 2v11a2 2 0 002 2h8a2 2 0 002-2V5a2 2 0 00-2-2 3 3 0 01-3 3H9a3 3 0 01-3-3z" />
                                                </svg>
                                            </button>
                                            <span x-show="copied" x-transition:enter="transition ease-out duration-300"
                                                  x-transition:enter-start="opacity-0 transform scale-90"
                                                  x-transition:enter-end="opacity-100 transform scale-100"
                                                  x-transition:leave="transition ease-in duration-300"
                                                  x-transition:leave-start="opacity-100 transform scale-100"
                                                  x-transition:leave-end="opacity-0 transform scale-90"
                                                  class="absolute left-4 -bottom-4 bg-black text-white text-xs px-2 py-1 rounded">
                                                Copiado!
                                            </span>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $unit->entry_date ?? 'no definido' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 {{ \Carbon\Carbon::parse($unit->expiration_date)->isPast() ? 'text-red-500' : '' }}">
                                    {{ $unit->expiration_date ?? 'no definido' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $unit->batch ?? 'no definido' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                   
                                    {{ $unit->cost ? '$' . $unit->cost : 'no definido' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $unit->profit_margin ? number_format($unit->profit_margin, 2) . '%' : 'no definido' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                              
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full  {{ $unit->status->getBackgroundColor() }} {{ $unit->status->getTextColor() }} ring-1 ring-inset {{ $unit->status->getRingColor() }}">
                                        {{ $unit->status->getName() ?? 'no definido' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                   
                                    {{ $unit->current_quantity ?? 'no definido' }} {{ UnitMeditionTypeEnum::from($unit->product->unit_of_measurement)->abbreviation() }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $unit->warehouse ? $unit->warehouse->name : $unit->worker->name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium  rounded-lg">
                                    <div class="flex justify-end space-x-2">
                                        <a wire:navigate href="{{ route('panel.stock.inventory-show', [$product, $unit]) }}"
                                           class="text-indigo-600 hover:text-indigo-900">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                                <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                                            </svg>
                                        </a>
                            

                                        @if($unit->status->getName() !== 'Desechado' && $unit->status->getName() !== 'Vencido' && $unit->status->getName() !== 'Dado de baja')
                                        <a wire:navigate href="{{ route('panel.stock.inventory-add-action', [$product, $unit]) }}"
                                           class="text-indigo-600 hover:text-indigo-900">
                                        

                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" >
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M7.217 10.907a2.25 2.25 0 1 0 0 2.186m0-2.186c.18.324.283.696.283 1.093s-.103.77-.283 1.093m0-2.186 9.566-5.314m-9.566 7.5 9.566 5.314m0 0a2.25 2.25 0 1 0 3.935 2.186 2.25 2.25 0 0 0-3.935-2.186Zm0-12.814a2.25 2.25 0 1 0 3.933-2.185 2.25 2.25 0 0 0-3.933 2.185Z" />
                                              </svg>
        
                                        </a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                        <tr>
                            <td colspan="10" class="py-6 px-4 sm:px-8">
                                <div class="rounded-md bg-yellow-50 p-4">
                                    <div class="text-sm font-medium text-yellow-700 text-center">
                                        <p>No hay unidades de inventario disponibles.</p>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                  </table>
              </div>
          </div>
      </div>

      <div class="pb-6 px-4 sm:px-8">
          {{ $units->links(data: ['scrollTo' => false]) }}
      </div>
  </div>
</div>





  