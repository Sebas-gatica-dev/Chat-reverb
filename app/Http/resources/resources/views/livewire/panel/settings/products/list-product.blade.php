<div>
    <div class="mx-auto max-w-screen-2xl pt-2 lg:flex lg:gap-x-16 lg:px-8">
        <h1 class="sr-only">Configuración de Productos</h1>
        <aside class="flex overflow-x-auto border-b border-gray-900/5 py-4 lg:block lg:w-64 lg:flex-none lg:border-0 lg:py-20">
            @include('components.panel.settings.menu-side-bar-settings')
        </aside>
        <main class="px-4 py-16 sm:px-6 lg:flex-auto lg:px-0 lg:py-20">
            <div class="mx-auto max-w-2xl space-y-16 sm:space-y-20 lg:mx-0 lg:max-w-none">
                                <div class="sm:flex sm:items-center" x-data="{ open: false }">
                    <div class="sm:flex-auto">
                        <h1 class="text-base font-semibold leading-6 text-gray-900">Productos</h1>
                        <p class="mt-2 text-sm text-gray-700">Administra los productos de tu inventario</p>
                    </div>
                    <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                        @can('access-function', 'stock-product-add')
                            @if($warehousesCount > 0)                             
                                <a href={{ route('panel.settings.stock.product.create') }} wire:navigate
                                   class="block cursor-pointer rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                                    Agregar Producto
                                </a>
                            @endif 
                        @endcan
                    </div>
                </div>
                <div class="mt-8 flow-root">
                    <div class="-mx-4 -mt-2 mb-4 overflow-x-auto sm:-mx-6 lg:mx-0 sm:shadow sm:rounded-lg bg-white border-t border-gray-200">
                        <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-4">
                            @if($warehousesCount > 0 && $products->count() > 0)
                                <table class="min-w-full divide-y divide-gray-300">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">Nombre</th>
                                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Tag</th>
                                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Descripción</th>
                                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Estado</th>
                                            <th scope="col" class="relative py-3.5 pl-3 pr-16 sm:pr-11">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200">
                                        @foreach ($products as $product)
                                            <tr wire:key="{{ $product->id }}">
                                                <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-0">{{ $product->name }}</td>
                                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $product->slug }}</td>
                                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $product->description }}</td>
                                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                    <div class="flex items-center justify-end gap-x-2 sm:justify-start">
                                                        @if ($product->deleted_at)
                                                            <div class="flex-none rounded-full bg-rose-400/10 p-1 text-rose-400">
                                                                <div class="h-1.5 w-1.5 rounded-full bg-current"></div>
                                                            </div>
                                                            <div class="sm:block">Inactivo</div>
                                                        @else
                                                            <div class="flex-none rounded-full bg-green-400/10 p-1 text-green-400">
                                                                <div class="h-1.5 w-1.5 rounded-full bg-current"></div>
                                                            </div>
                                                            <div class="sm:block">Activo</div>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-0">
                                                    @can('access-function', 'stock-product-edit')
                                                        <a wire:navigate href="{{ route('panel.settings.stock.product.edit', $product->id) }}"
                                                           class="text-indigo-600 hover:text-indigo-900">Editar<span class="sr-only">{{ $product->name }}</span></a>
                                                    @endcan
                                                    @can('access-function', 'stock-product-soft')
                                                        <button wire:confirm="¿Deseas eliminar este producto?" wire:click="deleteProduct('{{ $product->id }}')"
                                                                class="text-red-600 hover:text-red-900 ml-4">Eliminar</button>
                                                    @endcan
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            @elseif($warehousesCount  == 0)
                                <div class="rounded-md bg-yellow-50 p-4 my-6">
                                    <div class="text-sm font-medium text-yellow-700 text-center">
                                        <p>Debes registrar un depósito antes de crear productos.</p>
                                        <a class="text-indigo-600" wire:navigate href="{{ route('panel.settings.stock.warehouse.list') }}">Agrega un depósito.</a>
                                    </div>
                                </div>
                            @elseif($products->count() == 0)
                                <div class="rounded-md bg-yellow-50 p-4 my-6">
                                    <div class="text-sm font-medium text-yellow-700 text-center">
                                        <p>No tienes productos creados.</p>
                                        <a class="text-indigo-600" wire:navigate href="{{ route('panel.settings.stock.product.create') }}">Agrega un producto.</a>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                {{ $products->links(data: ['scrollTo' => false]) }}
            </div>
        </main>
    </div>
</div>
