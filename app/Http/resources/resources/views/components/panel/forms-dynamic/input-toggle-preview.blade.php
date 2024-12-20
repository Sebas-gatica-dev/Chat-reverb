<div>

         {{-- Etiqueta del input --}}
         <label class="block text-md font-medium text-gray-700">
            {{ $label }} 
            
        </label>

    <div x-data="{ checked: false }" class="p-4 bg-gray-50 border border-gray-300 rounded-lg">
   
    
        {{-- Input de texto readonly --}}
        <button type="button"
        class="relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:ring-offset-2 bg-gray-200"
        role="switch" aria-checked="false" :aria-checked="checked.toString()"
        @click="checked = !checked"
        :class="{ 'bg-indigo-600': checked, 'bg-gray-200': !checked }">
        <span class="sr-only">Toggle</span>
        <span
            class="pointer-events-none relative inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out translate-x-0"
            :class="{ 'translate-x-5': checked, 'translate-x-0': !checked }">
            <span
                class="absolute inset-0 flex h-full w-full items-center justify-center transition-opacity opacity-100 duration-200 ease-in"
                aria-hidden="true"
                :class="{ 'opacity-0 duration-100 ease-out': checked, 'opacity-100 duration-200 ease-in': !checked }">
                <svg class="h-3 w-3 text-gray-400" fill="none" viewBox="0 0 12 12">
                    <path d="M4 8l2-2m0 0l2-2M6 6L4 4m2 2l2 2" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
            </span>
            <span
                class="absolute inset-0 flex h-full w-full items-center justify-center transition-opacity opacity-0 duration-100 ease-out"
                aria-hidden="true"
                :class="{ 'opacity-100 duration-200 ease-in': checked, 'opacity-0 duration-100 ease-out': !checked }">
                <svg class="h-3 w-3 text-indigo-600" fill="currentColor" viewBox="0 0 12 12">
                    <path
                        d="M3.707 5.293a1 1 0 00-1.414 1.414l1.414-1.414zM5 8l-.707.707a1 1 0 001.414 0L5 8zm4.707-3.293a1 1 0 00-1.414-1.414l1.414 1.414zm-7.414 2l2 2 1.414-1.414-2-2-1.414 1.414zm3.414 2l4-4-1.414-1.414-4 4 1.414 1.414z">
                    </path>
                </svg>
            </span>
        </span>
    </button>
    
    </div>




    
    @if ($required)
            <span class="text-red-500">*Requerido*</span>
    @endif

</div>


