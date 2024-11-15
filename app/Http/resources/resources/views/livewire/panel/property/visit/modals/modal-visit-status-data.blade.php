@php
    use App\Enums\StatusVisitEnum;
@endphp
<template x-teleport="body">
    <div 
    {{-- x-data="{
        modalStatusChangeData: @entangle('modalStatusChangeData'),
    
    }" --}}
    
    x-show="modalStatusChangeData"
      
        class="fixed top-0 left-0 z-[99] flex items-center justify-center w-screen h-screen p-4" x-cloak>



        <div x-show="modalStatusChangeData"  x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-300"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
            @click="modalStatusChangeData=false" class="absolute inset-0 w-full h-full bg-gray-900/60 backdrop-blur-sm">
        </div>

         <div x-show="modalStatusChangeData" 
            x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 scale-90"
            x-transition:enter-end="opacity-100 scale-100" x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90"
            class="relative w-full max-w-3xl max-h-[90vh] overflow-y-auto bg-white shadow-xl px-4 sm:px-6 py-6 bg-opacity-95 rounded-xl">
            <div class="mb-6">
                {{-- <h2 class="text-xl font-semibold text-gray-900 mb-2">Detalles del estado {{ $statusName }}</h2> --}}
            </div>

            <div class="space-y-6">
                <!-- Mapa -->
                <div class="rounded-lg overflow-hidden shadow-sm border border-gray-200">
                    <livewire:components.maps.google-map-form-field-component />
                </div>

                <div class="bg-gray-50 rounded-lg p-4 space-y-4">
                    <div class="grid sm:grid-cols-2 gap-4">
                        <div class="flex flex-col">
                            <span class="text-sm font-medium text-gray-500">Estado Actual:</span>
                            <span class="text-sm font-semibold text-blue-600">
                             @dump($this->visit ?? 'hola')
                                {{-- {{ StatusVisitEnum::getStatus($visit['status']) }} --}}
                            </span>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-sm font-medium text-gray-500">Fecha y Hora:</span>
                            <span class="text-sm text-gray-700">
                                {{ $statusChange ? $statusChange->created_at->format('Y-m-d H:i') : '' }}
                            </span>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-sm font-medium text-gray-500">Intervalo:</span>
                            <span class="text-sm text-gray-700">

                                {{ $statusChange ? $statusChange->interval_status : '' }}
                            </span>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-sm font-medium text-gray-500">Técnico:</span>
                            <span class="text-sm text-gray-700">
                                Ernesto Juarez
                            </span>
                        </div>
                    </div>
                    @if ($defaultDataFields)
                        <div class="grid sm:grid-cols-2 gap-4">
                            @foreach ($defaultDataFields as $index => $defaultField)
                                <div class="flex flex-col">
                                    <span class="text-sm font-medium text-gray-500">{{ $index }}</span>
                                    <span class="text-sm font-semibold text-blue-600">
                                        {{ $defaultField }}
                                    </span>
                                </div>
                            @endforeach
                        </div>
                    @endif
                    @if ($dataFormsDynamic)
                        <div class="grid sm:grid-cols-2 gap-4">
                            @foreach ($dataFormsDynamic as $formDynamic)
                                <div class="flex flex-col">
                                    <span class="text-sm font-medium text-gray-500">
                                        {{ $formDynamic['label'] }}
                                    </span>
                                    <span class="text-sm font-semibold text-blue-600">
                                        {{ json_decode($formDynamic['input_data'][0]['data'], true)['value'] }}
                                    </span>
                                </div>
                            @endforeach
                        </div>
                    @endif

                </div>
            </div> 

            <div class="mt-6 flex justify-end">
                <button @click="modalStatusChangeData=false; $dispatch('close-status-change-data-modal');"
                    type="button"
                    class="inline-flex items-center justify-center px-4 py-2 border border-gray-300 
                                    rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 
                                    
                                    transition duration-150 ease-in-out">
                    Cerrar
                </button>
            </div>
        </div>


    </div>
</template>
