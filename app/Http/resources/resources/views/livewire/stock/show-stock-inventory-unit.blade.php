@php
    use App\Enums\Units\UnitMeditionTypeEnum;
    use App\Enums\Units\UnitsHistoryTypeEnum;
    use App\Enums\Units\UnitsStatusEnum;
    use App\Enums\ProductTypeEnum;
@endphp

<div class="bg-gray-100 min-h-screen">
    <header class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <h1 class="text-2xl font-bold text-gray-900">
                        Unidad {{ $unit->tag }} del producto {{ $product->name }}
                    </h1>
                    <div x-data="{ copied: false }" class="relative">
                        <button @click="navigator.clipboard.writeText('{{ $unit->tag }}'); copied = true; setTimeout(() => copied = false, 2000)"
                                class="text-gray-500 hover:text-gray-700 focus:outline-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M8 3a1 1 0 011-1h2a1 1 0 110 2H9a1 1 0 01-1-1z" />
                                <path d="M6 3a2 2 0 00-2 2v11a2 2 0 002 2h8a2 2 0 002-2V5a2 2 0 00-2-2 3 3 0 01-3 3H9a3 3 0 01-3-3z" />
                            </svg>
                        </button>
                        <span x-show="copied" x-transition:enter="transition ease-out duration-300"
                              x-transition:enter-start="opacity-0 transform scale-90"
                              x-transition:enter-end="opacity-100 transform scale-100"
                              x-transition:leave="transition ease-in duration-300"
                              x-transition:leave-start="opacity-100 transform scale-100"
                              x-transition:leave-end="opacity-0 transform scale-90"
                              class="absolute left-0 -bottom-8 bg-black text-white text-xs px-2 py-1 rounded">
                            Copiado!
                        </span>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
            
                    {{-- ESTO ES EXPERIMENTAL!!!!!! --}}
                    <a wire:navigate  href="{{ url()->previous() }}""
                    class="inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                     Volver
                 </a>



                   
                </div>
            </div>
        </div>
    </header>

    <main class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-900 mb-6">Detalles de la Unidad</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 divide-y md:divide-y-0 md:divide-x divide-gray-200">
                    <div class="pt-6 md:pt-0 md:px-6">
                        <h3 class="text-md font-medium text-gray-900 mb-4">Información General</h3>
                        <dl class="space-y-3">
                            <div class="flex items-center justify-between py-3 border-b border-gray-100">
                                <dt class="text-sm font-medium text-gray-500">Tag:</dt>
                                <dd class="text-sm text-gray-900 font-semibold">{{ $unit->tag }}</dd>
                            </div>
                            <div class="flex items-center justify-between py-3 border-b border-gray-100">
                                <dt class="text-sm font-medium text-gray-500">Producto:</dt>
                                <dd class="text-sm text-gray-900">{{ $product->name }}</dd>
                            </div>
                            <div class="flex items-center justify-between py-3">
                                <dt class="text-sm font-medium text-gray-500">Estado:</dt>
                                <dd class="text-sm text-gray-900">{{ $unit->status->getName() }}</dd>
                            </div>
                        </dl>
                    </div>
                    <div class="pt-6 md:pt-0 md:px-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Cantidades</h3>
                        <dl class="space-y-3">
                            <div class="flex items-center justify-between py-3 border-b border-gray-100">
                                <dt class="text-sm font-medium text-gray-500">Inicial:</dt>
                                {{-- @dd($unit->product) --}}
                                <dd class="text-sm text-gray-900">{{ $unit->initial_quantity }} {{ UnitMeditionTypeEnum::from($unit->product->unit_of_measurement)->abbreviation() }}</dd>
                            </div>
                            <div class="flex items-center justify-between py-3">
                                <dt class="text-sm font-medium text-gray-500">Actual:</dt>
                                <dd class="text-sm text-gray-900 font-semibold">{{ $unit->current_quantity }} {{ UnitMeditionTypeEnum::from($unit->product->unit_of_measurement)->abbreviation() }}</dd>
                            </div>
                        </dl>
                    </div>
                    <div class="pt-6 md:pt-0 md:px-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Información Adicional</h3>
                        <dl class="space-y-3">
                            <div class="flex items-center justify-between py-3 border-b border-gray-100">
                                <dt class="text-sm font-medium text-gray-500">Fecha de Expiración:</dt>
                                <dd class="text-sm text-gray-900">{{ $unit->expiration_date }}</dd>
                            </div>
                            <div class="flex items-center justify-between py-3 border-b border-gray-100">
                                <dt class="text-sm font-medium text-gray-500">Lote:</dt>
                                <dd class="text-sm text-gray-900">{{ $unit->batch }}</dd>
                            </div>
                            <div class="flex items-center justify-between py-3 border-b border-gray-100">
                                <dt class="text-sm font-medium text-gray-500">Depósito:</dt>
                                 {{-- @dump($unit->warehouse->name) --}}
                                <dd class="text-sm text-gray-900">{{ $unit->warehouse->name ?? 'Sin depósito' }}</dd>
                            </div>
                            <div class="flex items-center justify-between py-3">
                                <dt class="text-sm font-medium text-gray-500">Operario:</dt>
                                {{-- @dump($unit->worker->name) --}}
                                <dd class="text-sm text-gray-900">{{ $unit->worker->name ?? 'Sin operario' }}</dd>
                            </div>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-8 bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-900 mb-6">Historial de la Unidad</h2>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-sm font-semibold text-gray-900">Fecha</th>
                                <th scope="col" class="px-6 py-3 text-left text-sm font-semibold text-gray-900">Tipo</th>
                                <th scope="col" class="px-6 py-3 text-left text-sm font-semibold text-gray-900">Descripcion</th>
                                <th scope="col" class="px-6 py-3 text-left text-sm font-semibold text-gray-900">cant. inicial</th>
                                <th scope="col" class="px-6 py-3 text-left text-sm font-semibold text-gray-900">cant. final</th>
                                <th scope="col" class="px-6 py-3 text-left text-sm font-semibold text-gray-900">Description</th>
                            </tr>
                        </thead>
                        {{-- @dd($unit_histories) --}}
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($unit_histories as $unit_history)
                                @php
                                    $unit_history_type = $unit_history->type;
                                    // dump(UnitsHistoryTypeEnum::getStatus($unit_history_type->value));
                                @endphp
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ Carbon\Carbon::parse($unit_history->created_at)->format('d/m/Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{-- @dd( UnitsHistoryTypeEnum::getBackgroundColor($unit_history_type->value), UnitsHistoryTypeEnum::getTextColor($unit_history_type) , UnitsHistoryTypeEnum::getRingColor($unit_history_type) ) --}}
                                        <span class="inline-flex items-center rounded-full {{ UnitsHistoryTypeEnum::getBackgroundColor($unit_history_type->value) }} px-2 py-1 text-xs font-medium {{ UnitsHistoryTypeEnum::getTextColor($unit_history_type->value) }} ring-1 ring-inset {{ UnitsHistoryTypeEnum::getRingColor($unit_history_type->value) }}">                                         
                                            {{ UnitsHistoryTypeEnum::getStatus($unit_history_type->value) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">

                                        {!!  $unit_history->getDescription() !!}

                                        {{-- @dump($unit_history_type->value == UnitsHistoryTypeEnum::Baja->value , $unit_history->reason_action_description) --}}

                                        @if ($unit_history_type->value == UnitsHistoryTypeEnum::Baja->value)

                                          {{  ' ' .   $unit_history->reason_action_description }} 
                                        
                                        @endif
                                        {{-- {{ dd($unit_history->getDescription()) }} --}}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                         {{$unit_history->initial_quantity }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                         {{ $unit_history->current_quantity }}
                                    </td>
                                    <td>
                                        @if($unit_history->description)
                                        {{-- <button >
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
                                              </svg>
                                        </button> --}}


                                        <div x-data="{ modalOpen: false }"
                                            @keydown.escape.window="modalOpen = false"
                                            :class="{ 'z-40': modalOpen }" class="ml-8 relative w-auto h-auto">
                                            <button @click="modalOpen=true" class="inline-flex items-center justify-center h-10 px-4 py-2 text-sm font-medium transition-colors bg-white border rounded-md hover:bg-neutral-100 active:bg-white focus:bg-white focus:outline-none focus:ring-2 focus:ring-neutral-200/60 focus:ring-offset-2 disabled:opacity-50 disabled:pointer-events-none">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
                                                  </svg>
                                            </button>
                                            <template x-teleport="body">
                                                <div x-show="modalOpen" class="fixed top-0 left-0 z-[99] flex items-center justify-center w-screen h-screen" x-cloak>
                                                    <div x-show="modalOpen"
                                                        x-transition:enter="ease-out duration-300"
                                                        x-transition:enter-start="opacity-0"
                                                        x-transition:enter-end="opacity-100"
                                                        x-transition:leave="ease-in duration-300"
                                                        x-transition:leave-start="opacity-100"
                                                        x-transition:leave-end="opacity-0"
                                                        @click="modalOpen=false" class="absolute inset-0 w-full h-full bg-white backdrop-blur-sm bg-opacity-70"></div>
                                                    <div x-show="modalOpen"
                                                        x-trap.inert.noscroll="modalOpen"
                                                        x-transition:enter="ease-out duration-300"
                                                        x-transition:enter-start="opacity-0 -translate-y-2 sm:scale-95"
                                                        x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                                                        x-transition:leave="ease-in duration-200"
                                                        x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                                        x-transition:leave-end="opacity-0 -translate-y-2 sm:scale-95"
                                                        class="relative w-full py-6 bg-white border shadow-lg px-7 border-neutral-200 sm:max-w-lg sm:rounded-lg">
                                                        <div class="flex items-center justify-between pb-3">
                                                            <h3 class="text-lg font-semibold"> {{ $product->slug . '-' . $unit->tag  }} <br> <span class="text-xs">{{ UnitsHistoryTypeEnum::getStatus($unit_history_type->value) == 'Baja de unidad' ?  UnitsHistoryTypeEnum::getStatus($unit_history_type->value) . ' (' . $unit_history->reason_action_description . ').' :  UnitsHistoryTypeEnum::getStatus($unit_history_type->value) }}</span></h3>
                                                            <button @click="modalOpen=false" class="absolute top-0 right-0 flex items-center justify-center w-8 h-8 mt-5 mr-5 text-gray-600 rounded-full hover:text-gray-800 hover:bg-gray-50">
                                                                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>  
                                                            </button>
                                                        </div>

                                                        <div class="relative w-auto pb-8">
                                                            <div class="relative lg:order-last lg:col-span-5">
                                                                <svg class="absolute -top-[40rem] left-1 -z-10 h-[64rem] w-[175.5rem] -translate-x-1/2 stroke-gray-900/10 [mask-image:radial-gradient(64rem_64rem_at_111.5rem_0%,white,transparent)]" aria-hidden="true">
                                                                  <defs>
                                                                    <pattern id="e87443c8-56e4-4c20-9111-55b82fa704e3" width="200" height="200" patternUnits="userSpaceOnUse">
                                                                      <path d="M0.5 0V200M200 0.5L0 0.499983" />
                                                                    </pattern>
                                                                  </defs>
                                                                  <rect width="100%" height="100%" stroke-width="0" fill="url(#e87443c8-56e4-4c20-9111-55b82fa704e3)" />
                                                                </svg>
                                                                <figure class="border-l border-indigo-600 pl-8">
                                                                  <blockquote class="text-xl font-semibold leading-8 tracking-tight text-gray-900">
                                                                    <p>“{{ $unit_history->description }}”</p>
                                                                  </blockquote>
                                                               
                                                                  <figcaption class="mt-8 flex gap-x-4">
                                                                    <a wire:navigate href="{{ route('panel.users.show', $unit_history->createdBy) }}" target="_BLANK">
                                                                        <img src={{ $unit_history->createdBy->photo }} alt="" class="mt-1 h-10 w-10 flex-none rounded-full bg-gray-50">
                                                                        <div class="text-sm leading-6">
                                                                        <div class="font-semibold text-gray-900">{{ $unit_history->createdBy->name }}</div>
                                                                        <div class="text-gray-600">{{  $unit_history->createdBy->email }}</div>
                                                                        </div>
                                                                    </a>
                                                                  </figcaption>
                                                                </figure>
                                                              </div>
                                                        </div>
                                                        <div class="flex flex-col-reverse sm:flex-row sm:justify-end sm:space-x-2">
                                                            <button @click="modalOpen=false" type="button" class="inline-flex items-center justify-center h-10 px-4 py-2 text-sm font-medium text-white transition-colors border border-transparent rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-700 focus:ring-offset-2 bg-indigo-700 hover:bg-indigo-600">Aceptar</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </template>
                                        </div>
                                        
                                          @else
                                           <span class="text-xs">
                                            no hay descripcion.
                                           </span>
                                          @endif
                                        
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                        No hay registros de historial para esta unidad.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                        
                        
                        
                    </table>
                </div>
            </div>
        </div>
    </main>
</div>