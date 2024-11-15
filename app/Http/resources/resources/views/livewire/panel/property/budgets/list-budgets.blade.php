<div>


    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 mt-2">

        <div class="flex justify-between">
            <div>
                <h2 class="mx-auto max-w-2xl text-base font-semibold text-gray-900 lg:mx-0 lg:max-w-none">

                    @if (!$showAllBudgets)
                        Presupuestos de la propiedad
                    @else
                        Todos los presupuestos del cliente
                    @endif



                </h2>
            </div>

            <div>
                <livewire:components.toggle :checked="$showAllBudgets" name="allbudgets" :dark="true" />
            </div>



        </div>

    </div>


    <div class="mt-6 overflow-x-auto sm:overflow-hidden border-t border-gray-100">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-2xl lg:mx-0 lg:max-w-none">
                <table class="w-full text-left">
                    <thead class="sr-only">
                        <tr>
                            <th>Precio</th>
                            <th>Estado</th>
                            <th class="hidden sm:table-cell">Cliente</th>
                            <th>Más detalles</th>
                        </tr>
                    </thead>
                    <tbody>


                        @forelse ($budgets as $budget)
                            <tr wire:key="{{ $budget->id }}">
                                <td class="relative py-5 pr-8">
                                    <div class="flex gap-x-6 items-center">
                                        {{-- Icono dependiendo del estado del presupuesto --}}
                                        @if ($budget->deleted_at)
                                            {{-- Presupuesto inactivo (eliminado lógicamente) --}}
                                            <div class=" rounded-full bg-red-600/10 p-2 text-red-600 animate-pulse">
                                                <div class="h-2.5 w-2.5 rounded-full bg-current"></div>
                                            </div>
                                        @else
                                            {{-- Presupuesto activo --}}

                                            <div class=" rounded-full bg-green-600/10 p-2 text-green-600 animate-pulse">
                                                <div class="h-2.5 w-2.5 rounded-full bg-current"></div>
                                            </div>
                                        @endif
                                        <div class="flex-auto">
                                            <div class="flex items-start gap-x-3">

                                                <div class="text-sm/6 font-medium text-gray-900 has-tooltip">

                                                    @if ($budget->iva)
                                                        ${{ number_format($budget->total * 1.21, 0, ',', '.') }}
                                                        <span class="tooltip">
                                                            ${{ number_format($budget->total, 0, ',', '.') }} </span>
                                                    @else
                                                        ${{ number_format($budget->total, 0, ',', '.') }}
                                                    @endif

                                                </div>

                                                @if ($budget->iva)
                                                    <div
                                                        class="rounded-md bg-blue-50 px-2 py-1 text-xs font-medium text-blue-700 ring-1 ring-inset ring-blue-600/20">
                                                        CON IVA</div>
                                                @else
                                                    <div
                                                        class="rounded-md bg-gray-50 px-2 py-1 text-xs font-medium text-gray-600 ring-1 ring-inset ring-gray-500/10">
                                                        SIN IVA</div>
                                                @endif
                                            </div>
                                            {{-- Puedes agregar más información aquí si lo deseas --}}
                                        </div>
                                    </div>
                                    <div class="absolute bottom-0 right-full h-px w-screen bg-gray-100"></div>
                                    <div class="absolute bottom-0 left-0 h-px w-screen bg-gray-100"></div>
                                </td>

                                <td class="relative py-5 pr-6">


                                    <div class="flex gap-x-6 items-center">


                                        <span
                                            class="inline-flex items-center gap-x-1.5 rounded-md px-2 py-1 text-xs font-medium 
                                                {{ $budget->status->getBadgeClasses() }}">

                                            <svg class="h-1.5 w-1.5 {{ $budget->status->getBadgeFillClasses() }}"
                                                viewBox="0 0 6 6" aria-hidden="true">
                                                <circle cx="3" cy="3" r="3" />
                                            </svg>
                                            {{ $budget->status->getName() }}
                                        </span>


                                    </div>
                                </td>


                                <td class="hidden py-5 pr-6 sm:table-cell">
                                    {{-- <div class="text-sm/6 text-gray-900">{{ $budget->customer->name }}
                                        {{ $budget->customer->surname }}</div> --}}
                                    {{-- <div class="mt-1 text-xs/5 text-gray-500">{{ $budget->name }}</div> --}}
                                    <div class="mt-1 text-sm text-gray-500">{{ $budget->name }}</div>
                                </td>

                                @if (!$budget->deleted_at)
                                <td class="py-5 text-right">

                                    <div class="flex justify-end gap-x-2">

                                        <a wire:navigate
                                            href="{{ route('panel.customers.property.budget.edit', [$budget->customer->id, $budget->property->id, $budget->id]) }}"
                                            class="text-sm/6 font-medium text-indigo-600 hover:text-indigo-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                            </svg>

                                            <span class="sr-only">, código #{{ $budget->code }},
                                                {{ $budget->customer->name }}</span>
                                        </a>




                                        @if ($budget->status == App\Enums\StatusBudgetEnum::GENERATED && $budget->pdfExists())
                                            <a target="_blank" href="{{ $budget->getPdfUrl() }}"
                                                class="text-sm/6 font-medium text-indigo-600 hover:text-indigo-500">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                    class="size-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                                </svg>



                                                <span class="sr-only">, código #{{ $budget->code }},
                                                    {{ $budget->customer->name }}</span>

                                            </a>
                                            {{-- <div class="mt-1 text-xs/5 text-gray-500">Código <span
                                                    class="text-gray-900">

                                                    #{{ $budget->code }}

                                                </span>
                                            </div> --}}
                                        @endif

                                        <button wire:click="deleteBudget('{{ $budget->id }}')"
                                            class="text-sm/6 font-medium text-indigo-600 hover:text-indigo-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5m6 4.125 2.25 2.25m0 0 2.25 2.25M12 13.875l2.25-2.25M12 13.875l-2.25 2.25M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
                                              </svg>
                                              




                                            <span class="sr-only">, código #{{ $budget->code }},
                                                {{ $budget->customer->name }}</span>

                                        </button>




                                    </div>

                                </td>

                                @endif
                            </tr>

                        @empty
                            <tr>
                                <td class="py-5 pr-6">
                                    <div class="text-sm/6 text-gray-500">No hay presupuestos para esta propiedad.</div>
                                </td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>
        </div>

        <div class="pb-6 px-4 sm:px-8">
            {{ $budgets->links(data: ['scrollTo' => false]) }}

        </div>

    </div>



</div>
