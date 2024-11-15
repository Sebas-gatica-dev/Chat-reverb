  <table class="min-w-full divide-y divide-gray-300 bg-white ring-1 ring-black ring-opacity-5 md:rounded-lg md:shadow">
                  
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
                        {{-- @dd($units) --}}
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
                   
                                    {{ $product->cost ? '$' . $product->cost : 'no definido' }}
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