@php
    use App\Enums\Units\UnitMeditionTypeEnum;
    use App\Enums\Units\UnitsHistoryTypeEnum;
    use App\Enums\Units\UnitsStatusEnum;
    use App\Enums\ProductTypeEnum;
@endphp

<div class="bg-gray-100 min-h-screen">
    <header class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <h1 class="text-2xl font-bold text-gray-900">
                        Unidad {{ $unit->tag }} del producto {{ $product->name }}
                    </h1>
                    <div x-data="{ copied: false }" class="relative">
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
                              class="absolute left-0 -bottom-8 bg-black text-white text-xs px-2 py-1 rounded">
                            Copiado!
                        </span>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <a wire:navigate href="{{ route('panel.stock.inventory-edit-unit', [$product, $unit]) }}"
                       class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                        </svg>
                        Editar
                    </a>
                    <a wire:navigate href="{{ route('panel.stock.inventory-list', $product) }}"
                       class="inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Volver
                    </a>
                </div>
            </div>
        </div>
    </header>

    <main class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-900 mb-6">Detalles de la Unidad</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 divide-y md:divide-y-0 md:divide-x divide-gray-200">
                    <div class="pt-6 md:pt-0 md:px-6">
                        <h3 class="text-md font-medium text-gray-900 mb-4">Información General</h3>
                        <dl class="space-y-3">
                            <div class="flex items-center justify-between py-3 border-b border-gray-100">
                                <dt class="text-sm font-medium text-gray-500">Tag:</dt>
                                <dd class="text-sm text-gray-900 font-semibold">{{ $unit->tag }}</dd>
                            </div>
                            <div class="flex items-center justify-between py-3 border-b border-gray-100">
                                <dt class="text-sm font-medium text-gray-500">Producto:</dt>
                                <dd class="text-sm text-gray-900">{{ $product->name }}</dd>
                            </div>
                            <div class="flex items-center justify-between py-3">
                                <dt class="text-sm font-medium text-gray-500">Estado:</dt>
                                <dd class="text-sm text-gray-900">{{ UnitsStatusEnum::getStatus(intval($unit->status)) }}</dd>
                            </div>
                        </dl>
                    </div>
                    <div class="pt-6 md:pt-0 md:px-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Cantidades</h3>
                        <dl class="space-y-3">
                            <div class="flex items-center justify-between py-3 border-b border-gray-100">
                                <dt class="text-sm font-medium text-gray-500">Inicial:</dt>
                                <dd class="text-sm text-gray-900">{{ $unit->initial_quantity }} {{ UnitMeditionTypeEnum::from($unit->measurement_unit)->abbreviation() }}</dd>
                            </div>
                            <div class="flex items-center justify-between py-3">
                                <dt class="text-sm font-medium text-gray-500">Actual:</dt>
                                <dd class="text-sm text-gray-900 font-semibold">{{ $unit->current_quantity }} {{ UnitMeditionTypeEnum::from($unit->measurement_unit)->abbreviation() }}</dd>
                            </div>
                        </dl>
                    </div>
                    <div class="pt-6 md:pt-0 md:px-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Información Adicional</h3>
                        <dl class="space-y-3">
                            <div class="flex items-center justify-between py-3 border-b border-gray-100">
                                <dt class="text-sm font-medium text-gray-500">Fecha de Expiración:</dt>
                                <dd class="text-sm text-gray-900">{{ $unit->expiration_date }}</dd>
                            </div>
                            <div class="flex items-center justify-between py-3 border-b border-gray-100">
                                <dt class="text-sm font-medium text-gray-500">Lote:</dt>
                                <dd class="text-sm text-gray-900">{{ $unit->batch }}</dd>
                            </div>
                            <div class="flex items-center justify-between py-3 border-b border-gray-100">
                                <dt class="text-sm font-medium text-gray-500">Depósito:</dt>
                                <dd class="text-sm text-gray-900">{{ $unit->warehouse->name ?? 'Sin depósito' }}</dd>
                            </div>
                            <div class="flex items-center justify-between py-3">
                                <dt class="text-sm font-medium text-gray-500">Operario:</dt>
                                <dd class="text-sm text-gray-900">{{ $unit->worker->name ?? 'Sin operario' }}</dd>
                            </div>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-8 bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-900 mb-6">Historial de la Unidad</h2>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tipo</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Desde</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Hasta</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cantidad Inicial</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cantidad Final</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($unit_histories as $unit_history)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ Carbon\Carbon::parse($unit_history->created_at)->format('d/m/Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ UnitsHistoryTypeEnum::getStatus(intval($unit_history->type)) }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $unit_history->from_type ?? 'N/A' }} {{ $unit_history->from_id ?? '' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $unit_history->to_type ?? 'N/A' }} {{ $unit_history->to_id ?? '' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $unit_history->initial_quantity ?? 'N/A' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $unit_history->final_quantity ?? 'N/A' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <button class="text-indigo-600 hover:text-indigo-900">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                                <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                        No hay registros de historial para esta unidad.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
</div>