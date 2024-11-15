<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $budget->name }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen">
    <div class="bg-gradient-to-br from-purple-100 to-indigo-100 min-h-screen flex items-center justify-center px-6">
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden max-w-4xl w-full">
            <div class="p-8">
                <!-- Encabezado -->
                <div class="flex justify-between items-center mb-8">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-800">Presupuesto #{{ $budget->code }}</h1>
                        <div class="flex items-center mt-2 text-gray-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <span>{{ \Carbon\Carbon::parse($budget->created_at)->format('d M Y') }}</span>
                        </div>
                    </div>
                    <div class="text-right">
                        {{-- <svg class="w-12 h-12 text-indigo-600 inline-block" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"></path>
                        </svg> --}}

                        @if ($business->logo)
                            <img src="{{ $business->logo }}" class="inline-block h-12 rounded-md" alt="">
                        @else
                            <h2 class="text-xl font-semibold text-gray-800 mt-2">{{ $business->name }}</h2>
                        @endif

                        <p class="text-gray-600">
                            {{ $business->branches->first()->address ?? 'Dirección no disponible' }}</p>
                        <p class="text-gray-600">{{ $business->email ?? 'Correo no disponible' }}</p>
                    </div>
                </div>

                <!-- Datos del cliente -->
                <div class="border-t border-b border-gray-200 py-4 mb-8">
                    <h3 class="text-lg font-semibold text-gray-700 mb-2">Datos del cliente:</h3>
                    <p class="text-gray-600">{{ $lead->full_name }}</p>
                    <p class="text-gray-600">{{ $lead->phone ?? 'Teléfono no disponible' }}</p>
                    <p class="text-gray-600">Correo: {{ $lead->email ?? 'No disponible' }}</p>
                </div>

                <!-- Tabla de presupuesto -->
                <table class="w-full mb-8">
                    <thead>
                        <tr class="text-left text-gray-600 bg-gray-100">
                            <th class="py-3 px-4 font-semibold">Item</th>
                            <th class="py-3 px-4 font-semibold">Valor</th>
                            <th class="py-3 px-4 font-semibold">Cantidad</th>
                            <th class="py-3 px-4 font-semibold text-right">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>




                        @foreach ($budgetItems as $item)
                            <tr class="border-b border-gray-200">
                                <td class="py-4 px-4">
                                    <div class="font-semibold text-gray-800">{{ $item->name }}</div>
                                    <div class="text-sm text-gray-600">{{ $item->description }}</div>
                                </td>
                                <td class="py-4 px-4 text-gray-700">
                                    @if ($item->type === 'percentage')
                                        {{ $item->value }}%
                                    @else
                                        {{ number_format($item->pivot->value, 0) }}
                                    @endif
                                </td>
                                <td class="py-4 px-4 text-gray-700">
                                    @if ($item->type === 'percentage')
                                        {{ number_format($item->pivot->quantity, 0) }}%
                                    @else
                                        {{ number_format($item->pivot->quantity ?? 1, 0) }}
                                    @endif

                                </td>
                                <td class="py-4 px-4 text-right text-gray-700">
                                    ${{ number_format($item->pivot->total, 0, ',', '.') }}

                                </td>
                            </tr>
                        @endforeach

                        @if ($totalBudgetInvisibleItems > 0)
                            <tr class="border-b border-gray-200">
                                <td class="py-4 px-4">
                                    <div class="font-semibold text-gray-800">{{ $onceItemTitle ?? 'Otros' }}</div>
                                </td>
                                <td class="py-4 px-4 text-gray-700">-</td>
                                <td class="py-4 px-4 text-gray-700">-</td>
                                <td class="py-4 px-4 text-right text-gray-700">
                                    ${{ number_format($totalBudgetInvisibleItems, 0, ',', '.') }}
                                </td>
                            </tr>
                        @endif

                    </tbody>
                </table>

                <!-- Subtotales y Totales -->
                <div class="flex justify-end">
                    <div class="w-1/2 space-y-2">
                        <div class="flex justify-between">
                            <span class="font-semibold text-gray-600">Subtotal:</span>
                            <span class="text-gray-700">${{ number_format($budget->total, 0, ',', '.') }} </span>
                        </div>
                        <div class="flex justify-between">
                            <span class="font-semibold text-gray-600">IVA (21%):</span>
                            <span class="text-gray-700">
                                @if ($budget->iva)
                                    ${{ number_format($budget->total * 0.21, 0, ',', '.') }}
                                @else
                                    $0.00
                                @endif
                            </span>
                        </div>
                        <div class="flex justify-between pt-4 border-t border-gray-200">
                            <span class="text-xl font-bold text-gray-800">Total:</span>
                            <span class="text-xl font-bold text-indigo-600">
                                ${{ number_format($budget->total * ($budget->iva ? 1.21 : 1), 0, ',', '.') }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pie de página -->
            <div class="bg-gradient-to-r from-indigo-500 to-purple-600 p-6 text-white text-center">
                <p class="text-lg font-semibold">Gracias!</p>
                <p class="text-sm mt-2">Para cualquier consulta, por favor contactanos en
                    {{ $business->email ?? 'Correo no disponible' }}</p>
            </div>
        </div>
    </div>
    </div>
</body>

</html>
