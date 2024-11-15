

<div class="p-4 bg-gray-50 border border-gray-300 rounded-lg">
    {{-- Etiqueta del input --}}

    @dump($label, $required, $placeholder)
    <label class="block text-sm font-medium text-gray-700">
        {{ $label }} 
       
    </label>

    {{-- Input de texto readonly --}}
    <input 
        type="text" 
        class="mt-2 block w-full px-3 py-2 border border-gray-300 bg-gray-200 text-gray-900 rounded-md shadow-sm focus:outline-none focus:ring-0 sm:text-sm" 
        placeholder="{{ $placeholder }}"
        readonly
    >


</div>
