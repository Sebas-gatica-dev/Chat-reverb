@php
    use App\Enums\ProductTypeEnum;
@endphp

<div>

    <header class=" bg-white shadow">
        <div class="mx-auto max-w-screen-2xl px-4 py-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center">
                <div class="min-w-0 sm:flex-1">
                    <h1 class="items-center	text-[1em] sm:text-2xl sm:mt-2 font-bold tracking-tight text-gray-900">
                        Stock</h1>
                </div>

                {{-- @can('access-function', 'customer-add')  --}}
                @if ($hasProductsWithoutUnits)
                    <div class="items-center sm:flex md:ml-4 md:mt-0 justify-end">
                        <a wire:navigate href="{{ route('panel.stock.inventory-add') }}"
                            class="ml-3 inline-flex items-center rounded-md bg-indigo-600 px-2 py-1.5 sm:px-3 sm:py-2 text-[0.8em] sm:text-sm font-semibold
                        text-white shadow-sm hover:bg-indigo-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2
                        focus-visible:outline-indigo-600">
                            Agregar producto
                        </a>
                    </div>
                @endif
                {{-- @endcan --}}
            
            </div>

        </div>

    </header>







    <section aria-labelledby="filter-heading" class="border-b border-t border-gray-200 bg-slate-100"
        x-data="{ openFilters: false }">
        <h2 id="filter-heading" class="sr-only">Filters</h2>

        <div
            class="max-w-screen-2xl mx-auto grid grid-cols-1 sm:grid-cols-3 items-center gap-y-4 sm:gap-y-0 py-2 px-4 sm:px-6 lg:px-8">

            <!-- Primer Columna: Filtros -->
            <div class="relative flex justify-between sm:block items-center">
                <div class="flex space-x-6 divide-x divide-gray-200 text-sm">
                    <div class="grid auto-rows-min grid-cols-1 md:gap-y-10 gap-y-4 md:grid-cols-2 md:gap-x-6">
                        <!-- Users -->
                        <fieldset>

                            <div class="pt-2">
                                <livewire:components.select-general :selectedValue="$selectedProductType" :values="$selectProductTypes"
                                    :imageValue="false" :searchEnabled="false" :name="'productType'" :model="false"
                                    :defaultOption="'Selecciona un usuario'"
                                    >
                            </div>
                        </fieldset>
                    </div>
                </div>
            </div>

            <div class="relative col-span-1 hidden sm:block">
                <div class="w-full">
                    <input type="text" wire:model.live.debounce.500ms="searchTerm"
                        class="bg-transparent block w-full border-0 border-b border-slate-300 focus:border-slate-400 focus:ring-0 sm:text-sm"
                        placeholder="Buscar por nombre de producto..." />
                </div>
            </div>

            <div class="col-span-1">
                <div class="flex justify-end">
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
                                <a class="block px-4 py-2 text-sm text-gray-500 hover:bg-gray-100 hover:text-gray-900 {{ $sort === 'mas' ? 'font-medium text-gray-900' : '' }}"
                                    role="menuitem" tabindex="-1" id="menu-item-0" wire:click="updateSort('mas')">Más
                                    unidades</a>
                                <a class="block px-4 py-2 text-sm text-gray-500 hover:bg-gray-100 hover:text-gray-900 {{ $sort === 'menos' ? 'font-medium text-gray-900' : '' }}"
                                    role="menuitem" tabindex="-1" id="menu-item-1"
                                    wire:click="updateSort('menos')">Menos unidades</a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>



    @if (auth()->user()->business->warehouses->count() == 0)

{{-- 
        <div class="rounded-md bg-yellow-50 p-4 my-6">
            <div class="text-sm font-medium text-yellow-700 text-center">
                <p>No se encontraron Depositos registrados.</p><a class="text-indigo-600 underline underline-offset-2"
                    wire:navigation href="{{ route('panel.settings.stock.warehouse.create') }}">Registra un nuevo
                    deposito.</a>
            </div>
        </div> --}}
    
            {{-- 
        <div class="rounded-md bg-yellow-50 p-4 my-6">
            <div class="text-sm font-medium text-yellow-700 text-center">
                <p>No se encontraron productos en tu inventario.</p><a class="text-indigo-600 underline underline-offset-2" wire:navigation href="{{ route('panel.stock.inventory-add' ) }}" >¿Deseas agregar un producto a tu inventario?</a>
            </div>
        </div>
 --}}

 <div class="mx-auto max-w-screen-2xl md:px-6 lg:px-8 rounded-md bg-white p-4 my-6">
    <div class="text-center">
        {{-- <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
          <path vector-effect="non-scaling-stroke" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
        </svg> --}}
        <svg class="mx-auto h-12 w-12 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
            <path d="M19.006 3.705a.75.75 0 1 0-.512-1.41L6 6.838V3a.75.75 0 0 0-.75-.75h-1.5A.75.75 0 0 0 3 3v4.93l-1.006.365a.75.75 0 0 0 .512 1.41l16.5-6Z" />
            <path fill-rule="evenodd" d="M3.019 11.114 18 5.667v3.421l4.006 1.457a.75.75 0 1 1-.512 1.41l-.494-.18v8.475h.75a.75.75 0 0 1 0 1.5H2.25a.75.75 0 0 1 0-1.5H3v-9.129l.019-.007ZM18 20.25v-9.566l1.5.546v9.02H18Zm-9-6a.75.75 0 0 0-.75.75v4.5c0 .414.336.75.75.75h3a.75.75 0 0 0 .75-.75V15a.75.75 0 0 0-.75-.75H9Z" clip-rule="evenodd" />
          </svg>
          
        <h3 class="mt-2 text-sm font-semibold text-gray-900">No hay depositos registrados.</h3>
        <p class="mt-1 text-sm text-gray-500">Registra tus depositos, para gestionar productos y unidades.</p>
        <div class="mt-6">
          <a wire:navigation href="{{ route('panel.settings.stock.warehouse.create')}}"  type="button" class="inline-flex items-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
            <svg class="-ml-0.5 mr-1.5 h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
              <path d="M10.75 4.75a.75.75 0 0 0-1.5 0v4.5h-4.5a.75.75 0 0 0 0 1.5h4.5v4.5a.75.75 0 0 0 1.5 0v-4.5h4.5a.75.75 0 0 0 0-1.5h-4.5v-4.5Z" />
            </svg>
            Agregar Deposito.
          </a>
        </div>
      </div>
      
    
</div>




  



{{-- 

            <div class="text-center">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                    aria-hidden="true">
                    <path vector-effect="non-scaling-stroke" stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="2"
                        d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                </svg>
                <h3 class="mt-2 text-sm font-semibold text-gray-900">No se encontraron unidades registradas.</h3>
                <p class="mt-1 text-sm text-gray-500">Registrar nuevas unidades al inventario te permitira gestionarlas
                    a voluntad.</p>
                <div class="mt-6">
                    <a wire:navigation href="{{ route('panel.stock.inventory-add') }}" type="button"
                        class="inline-flex items-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                        <svg class="-ml-0.5 mr-1.5 h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"
                            data-slot="icon">
                            <path
                                d="M10.75 4.75a.75.75 0 0 0-1.5 0v4.5h-4.5a.75.75 0 0 0 0 1.5h4.5v4.5a.75.75 0 0 0 1.5 0v-4.5h4.5a.75.75 0 0 0 0-1.5h-4.5v-4.5Z" />
                        </svg>
                        Registra unidades al inventario.
                    </a>
                </div>
            </div> --}}
        @else
            <div class="mx-auto max-w-screen-2xl md:px-6 lg:px-8">

                <div class="mt-1 flow-root">

                    <div class="inline-block min-w-full py-6 align-middle ">

                        <table
                            class="min-w-full divide-y divide-gray-300 bg-white ring-1 ring-black ring-opacity-5 md:rounded-lg md:shadow">
                            <thead>
                                <tr>
                                    <th scope="col"
                                        class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                                        Nombre
                                    </th>
                                    <th scope="col"
                                        class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                        Tipo
                                    </th>
                                    <th scope="col"
                                        class="px-3 py-3.5 text-center text-sm font-semibold text-gray-900">
                                        Cantidad
                                    </th>
                                    <th scope="col"
                                        class="px-3 py-3.5 text-center text-sm font-semibold text-gray-900">
                                        Costo
                                    </th>
                                    <th scope="col"
                                        class="px-3 py-3.5 text-center text-sm font-semibold text-gray-900">
                                        Ganancia
                                    </th>
                                    <th scope="col"
                                        class="px-3 py-3.5 text-center text-sm font-semibold text-gray-900">
                                        Acciones
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @forelse ($products as $product)
                                    <tr>
                                        <td
                                            class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">
                                            {{ $product->name }}
                                        </td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                            {{ ProductTypeEnum::getType($product->type) }}
                                        </td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 text-center">
                                            {{ $product->quantity }}
                                        </td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 text-center">
                                            {{ $product->cost }}$
                                        </td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 text-center">
                                            {{ $product->profit }}%
                                        </td>
                                        <td
                                            class="relative whitespace-nowrap px-3 py-4 text-center text-sm font-medium">
                                            <div class="flex justify-center space-x-2">
                                                <a href="{{ route('panel.stock.inventory-list', $product) }}"
                                                    class="text-indigo-600 hover:text-indigo-900">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                        fill="currentColor" class="w-6 h-6">
                                                        <path
                                                            d="M12.378 1.602a.75.75 0 0 0-.756 0L3 6.632l9 5.25 9-5.25-8.622-5.03ZM21.75 7.93l-9 5.25v9l8.628-5.032a.75.75 0 0 0 .372-.648V7.93ZM11.25 22.18v-9l-9-5.25v8.57a.75.75 0 0 0 .372.648l8.628 5.033Z" />
                                                    </svg>
                                                </a>
                                                <a href="{{ route('panel.stock.inventory-edit', $product) }}"
                                                    class="text-indigo-600 hover:text-indigo-900">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                        fill="currentColor" class="w-6 h-6">
                                                        <path fill-rule="evenodd"
                                                            d="M12 3.75a.75.75 0 0 1 .75.75v6.75h6.75a.75.75 0 0 1 0 1.5h-6.75v6.75a.75.75 0 0 1-1.5 0v-6.75H4.5a.75.75 0 0 1 0-1.5h6.75V4.5a.75.75 0 0 1 .75-.75Z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty


                                        <tr
                                            class="text-center mt-6 min-w-full   md:rounded-b-md md:shadow">
                                                <th colspan="10" class="py-6 px-4 sm:px-8 rounded-md">
                                                    <div class="rounded-md bg-yellow-50 p-4 border border-yellow-600 shadow-sm">
                                                        <div class="text-sm font-medium text-yellow-700 text-center ">
                                                            <p>No se encontraron productos en tu inventario, podes agregarlo o buscar de otra manera.</p>
                                                        </div>
                                                    </div>
                                                </th>
                                        </tr>
                                @endforelse
                            </tbody>
                        </table>


                    </div>
                </div>



                <div class="pb-6 px-4 sm:px-8">
                    {{ $products->links(data: ['scrollTo' => false]) }}

                </div>


            </div>




    @endif


</div>
