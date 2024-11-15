@php
use App\Enums\StatusVisitEnum;

@endphp
@props([
    'grupedAvailabilities'
])
<template x-teleport="body">
    <div 
         x-show="modalShowAvailabilities" 
         class="fixed inset-0 z-50 overflow-y-auto rounded-lg" 
         x-trap.inert.noscroll="modalShowAvailabilities"
         x-cloak>
        <div class="min-h-screen flex items-center justify-center p-0">
            <div x-show="modalShowAvailabilities"
                 x-transition:enter="ease-out duration-300"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="ease-in duration-200"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75" 
                 @click="modalShowAvailabilities = false">
            </div>

            <div x-show="modalShowAvailabilities"
                 x-transition:enter="ease-out duration-300"
                 x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave="ease-in duration-200"
                 x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 class="relative w-full transform bg-white mx-8 shadow-xl transition-all sm:rounded-lg
                       {{ count($grupedAvailabilities) > 1  ?  'sm:max-w-' . count($grupedAvailabilities) . 'xl' : 'sm:max-w-sm ' }}
                        sm:w-full"
                 @click.away="modalShowAvailabilities = false">
                

                 {{-- <div class="hidden sm:max-w-6xl sm:max-w-5xl sm:max-w-4xl sm:max-w-3xl sm:max-w-2xl sm:max-w-xl lg:grid-cols-6 lg:grid-cols-5 lg:grid-cols-4 lg:grid-cols-3 lg:grid-cols-2"></div> --}}
                <!-- Header -->
                <div class="sticky top-0 z-10 bg-white border-b border-gray-200 sm:rounded-t-lg">
                    <div class="flex items-center justify-between p-4 sm:p-6">
                        <h3 class="text-lg font-medium text-gray-900">Disponibilidad</h3>
                        <button @click="modalShowAvailabilities = false" 
                                class="text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                            <span class="sr-only">Cerrar</span>
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Content -->
                <div class="p-4 sm:p-6 overflow-y-auto" style="max-height: calc(100% - 136px);">
                    @if ($grupedAvailabilities)
                        <div class="space-y-3 sm:space-y-0 sm:grid sm:grid-cols-2 lg:grid-cols-{{ count($grupedAvailabilities) }} sm:gap-4">
                            @foreach ($grupedAvailabilities as $day => $availabilities)
                                <!-- Mobile: Compact cards -->
                                <div class="bg-white border border-gray-200 rounded-lg shadow-sm sm:p-4
                                  {{ count($grupedAvailabilities) === 1 ? 'w-full sm:w-72 sm:ml-6' : '' }}
                                ">
                                    <div class="flex items-center justify-between p-3 sm:p-0 sm:mb-2">
                                        <h4 class="text-sm font-semibold text-gray-900">{{ $this->translateDay($day) }}</h4>
                                        <div class="sm:hidden flex items-center">
                                            @foreach($availabilities as $availability)
                                                <div class="flex items-center text-sm text-indigo-600
                                                  
                                                ">
                                                    <span>{{ $availability['start_time'] }}</span>
                                                    <span class="text-indigo-400 mx-1">-</span>
                                                    <span>{{ $availability['end_time'] }}</span>
                                                </div>
                                                @unless($loop->last)
                                                    <div class="mx-2 h-4 w-px bg-gray-200"></div>
                                                @endunless
                                            @endforeach
                                        </div>
                                    </div>
                                    
                                    <!-- Desktop: Original layout -->
                                    <div class="hidden sm:block mx-4">
                                        @foreach($availabilities as $availability)
                                            <div class="flex items-center justify-between p-3 bg-indigo-50 rounded-md
                                              {{ $loop->last ? '' : 'mb-2' }}
                                            ">
                                                <span class="text-sm text-indigo-700">{{ $availability['start_time'] }}</span>
                                                <span class="text-xs text-indigo-500 px-1">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-4">
                                                        <path fill-rule="evenodd" d="M4.25 12a.75.75 0 0 1 .75-.75h14a.75.75 0 0 1 0 1.5H5a.75.75 0 0 1-.75-.75Z" clip-rule="evenodd" />
                                                      </svg>
                                                      
                                                                                                       
                                                </span>
                                                <span class="text-sm text-indigo-700">{{ $availability['end_time'] }}</span>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-sm text-gray-500">No hay disponibilidad registrada.</p>
                    @endif
                </div>

                <!-- Footer -->
                <div class="sticky bottom-0 bg-white border-t border-gray-200 sm:rounded-b-lg">
                    <div class="flex justify-end p-4 sm:p-6">
                        <button @click="modalShowAvailabilities = false"
                                type="button"
                                class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                            Cerrar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>