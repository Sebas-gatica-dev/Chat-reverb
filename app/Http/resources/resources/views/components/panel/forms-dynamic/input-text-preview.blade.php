<div >

    <div class="flex justify-center">
    {{-- Etiqueta del input --}}
    <label class="block text-md font-medium text-gray-700">
        {{ $label }} 
        
    </label>

    @if ($required)
    <span class="ml-3 inline-flex items-center rounded-md bg-red-50 px-2 py-1 text-xs font-medium text-red-700 ring-1 ring-inset ring-red-600/10">Requerido</span>
    @endif

</div>


    {{-- Input de texto readonly --}}
    <input 
        type="text" 
        class="mt-2 block w-full px-3 py-2 border border-gray-300 bg-white text-gray-900 rounded-md shadow-sm focus:outline-none focus:ring-0 sm:text-sm" 
        placeholder="{{ $placeholder }}"
        readonly
    >

    {{-- @if ($required)
            <span class="text-red-600">*Requerido</span>
        @endif --}}
</div>
