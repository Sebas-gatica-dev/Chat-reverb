<div>
    <!-- Multiselect de PDFs -->
    <div class="mb-4">
        <livewire:components.multi-select-general
            :selectedValues="collect($pdfResources)->whereIn('id', $selectedPdfResources)->toArray()"
            :values="collect($pdfResources)"
            :name="'pdf_resources'"
            :label="'Seleccionar PDFs'"
            :searchEnabled="true" />
    </div>

    <!-- Lista ordenable de PDFs seleccionados -->
    <div class="overflow-x-auto" x-data="{ handle: (item, position) => { $wire.sortOrderedPdfResources(item, position) } }">
        <table class="min-w-full divide-y divide-gray-300 bg-white ring-1 ring-black ring-opacity-5 md:rounded-lg md:shadow">
            <thead>
                <tr>
                    <th class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Orden</th>
                    <th class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Nombre</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200" x-sort="handle">
                @foreach ($orderedPdfResources as $index => $resource)
                    <tr x-sort:item="'{{ $resource['id'] }}'" wire:key="'{{ $index }}'" class="hover:bg-slate-50 cursor-move">
                        <td class="px-3 py-3 text-sm text-gray-500">{{ $resource['order'] }}</td>
                        <td class="px-3 py-3 text-sm text-gray-500">{{ $resource['name'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
