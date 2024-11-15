@php
use App\Enums\StatusVisitEnum;
@endphp
<template x-teleport="body">
    <div x-data="{ modalVisitInfoData: @entangle('modalVisitInfoData') }"
    x-show="modalVisitInfoData" class="fixed top-0 left-0 z-[99] flex items-center justify-center w-screen h-screen" x-cloak>
        <div x-show="modalVisitInfoData"
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="ease-in duration-300"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            @click="modalVisitInfoData=false" class="absolute inset-0 w-full h-full bg-gray-900 bg-opacity-50 backdrop-blur-sm"></div>
        <div x-show="modalVisitInfoData"
            x-trap.inert.noscroll="modalVisitInfoData"
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0 scale-90"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-90"
            class="relative w-full py-6 bg-white shadow-md px-7 bg-opacity-90 drop-shadow-md backdrop-blur-sm sm:max-w-lg sm:rounded-lg">
            <div class="flex items-center justify-between pb-3">
                <h3 class="text-lg font-semibold">Informacion extra de la visita</h3>
                {{-- <button @click="modalUnitsUsed=false" class="absolute top-0 right-0 flex items-center justify-center w-8 h-8 mt-5 mr-5 text-gray-600 rounded-full hover:text-gray-800 hover:bg-gray-50">
                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>  
                </button> --}}
            </div>
            <div class="relative w-auto pb-8">
                <div class="col-span-full rounded-md">
                 
                    <div class="grid sm:grid-cols-2 gap-4">
                        @forelse ($dataFormsDynamic as $formDynamic)
                            @isset($formDynamic['input_data'])
                                <div class="flex flex-col">
                                    <span class="text-sm font-medium text-gray-500">{{ $formDynamic['label'] }}</span>
                                    <span class="text-sm font-semibold text-blue-600">
                                        {{ $formDynamic['input_data'] }}
                                    </span>
                                </div>
                            @endisset
                        @empty
                            <span>
                                No hay campos dinamicos.
                            </span>
                        @endforelse
                  
                    </div>
              
                    
                </div>
            </div>
            <div class="flex flex-col-reverse sm:flex-row sm:justify-between sm:space-x-2">
                <button
                @click="modalVisitInfoData=false"
                type="button" class="inline-flex items-center justify-center h-10 px-4 py-2 text-sm font-medium transition-colors border bg-indigo-600 text-white rounded-md hover:bg-indigo-500 focus:outline-none focus:ring-0">Cerrar</button>
            </div>
        </div>
    </div>
</template>