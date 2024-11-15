<div>

    <div class="overflow-x-au
    to">
        <div class="inline-block min-w-full py-6 align-middle px-0.5">

            <table
                class="min-w-full divide-y divide-gray-300 bg-white ring-1 ring-black ring-opacity-5 md:rounded-lg md:shadow mt-4">
                <thead class="">
                    <tr>
                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Fecha</th>
                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Hora</th>
                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Dirección
                        </th>
                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Cliente</th>
                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Teléfono
                        </th>
                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Precio</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($unassignedVisits as $visit)
                        <tr class="border-t border-gray-300">
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                {{ $visit->date ? \Carbon\Carbon::parse($visit->date)->format('d/m/Y') : '-' }}</td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                {{ $visit->time ? \Carbon\Carbon::parse($visit->time)->format('H:i') : '-'}}</td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                {{ $visit->property->address }}</td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                {{ $visit->customer->name }}</td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                @if ($visit->customer->phones->count() > 0)
                                    {{ $visit->customer->phones->first()->number }}
                                @else
                                    <span class="text-red-500">Sin teléfono</span>
                                @endif
                            </td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                ${{ $visit->price }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-4">
                {{ $unassignedVisits->links() }}
            </div>
        </div>
    </div>


</div>
