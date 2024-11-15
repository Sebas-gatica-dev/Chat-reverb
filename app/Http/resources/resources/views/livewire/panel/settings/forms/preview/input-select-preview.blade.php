<div class="p-4 bg-gray-50 border border-gray-300 rounded-lg">
    {{-- Etiqueta del select --}}
    <label class="block text-sm font-medium text-gray-700">
        {{ $label }} 
        @if ($required)
            <span class="text-red-500">*</span>
        @endif
    </label>

    {{-- Select readonly (simulado con disabled) --}}
    <select class="mt-2 block w-full px-3 py-2 border border-gray-300 bg-gray-200 text-gray-900 rounded-md shadow-sm focus:outline-none focus:ring-0 sm:text-sm" disabled>
        @foreach ($options as $option)
            <option value="{{ $option['id'] }}">{{ $option['label'] }}</option>
        @endforeach
    </select>
</div>
