<div class="p-4 bg-gray-50 border border-gray-300 rounded-lg">
    {{-- Etiqueta del textarea --}}
    <label class="block text-md font-medium text-gray-700">
        {{ $label }} 
    </label>

    {{-- Textarea readonly --}}
    <textarea 
        class="mt-2 block w-full px-3 py-2 border border-gray-300 bg-gray-200 text-gray-900 rounded-md shadow-sm focus:outline-none focus:ring-0 sm:text-sm resize-none" 
        style="font-family: monospace; white-space: pre-wrap;" 
        placeholder="{{ $placeholder }}"
        readonly
        rows="4"
    ></textarea>

    @if ($required)
        <span class="text-red-500">*Requerido*</span>
    @endif
</div>