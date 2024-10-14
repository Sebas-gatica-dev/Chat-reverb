<div>

    <div class="mx-auto max-w-screen-2xl pt-2 lg:flex lg:gap-x-16 lg:px-8">
        <h1 class="sr-only">Crear un nuevo producto</h1>

        <aside
            class="flex overflow-x-auto border-b border-gray-900/5 py-4 lg:block lg:w-64 lg:flex-none lg:border-0 lg:py-20">

            @include('components.panel.settings.menu-side-bar-settings')

        </aside>

        <main class="px-4 py-16 sm:px-6 lg:flex-auto lg:px-0 lg:pt-20 ">
            <div class="mx-auto max-w-2xl space-y-4 sm:space-y-4 lg:mx-0 lg:max-w-none">

                <div class="sm:flex sm:items-center">
                    <div class="sm:flex-auto">
                        <h1 class="text-base font-semibold leading-6 text-gray-900">Producto</h1>
                        <p class="mt-2 text-sm text-gray-700">Crea un nuevo producto para tu inventario
                        </p>
                    </div>
                    <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                        <a wire:navigate href="{{ route('panel.settings.stock.product.list') }}"
                            class="cursor-pointer block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                            Atras
                        </a>
                    </div>
                </div>

                <div class="mt-8 flow-root">

                    <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl md:col-span-3">
                                        
                        <div class="px-4 py-6 sm:p-8">
                            <div class="grid w-full grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-9">
                                                   
                                    <div class="lg:col-span-3 col-span-full">
                                        <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Nombre
                                            del producto </label>
                                        <div class="mt-2">
                                            <input type="text" wire:model="name" name="name" id="name"
                                                autocomplete="off" placeholder="Escriba un nombre para la sucursal"
                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 text-sm sm:leading-6">
                                        </div>
                                        @error('name')
                                            <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                        @enderror
                                    </div>
    
                                
                                    <div class="lg:col-span-6 col-span-full">
                                        <label for="description" class="block text-sm font-medium leading-6 text-gray-900">Descripción del producto.</label>
                                        <div class="mt-2">
                                            <textarea type="text" wire:model="description" name="description" id="description"
                                                autocomplete="off" placeholder="Escriba una descripción para tu producto."
                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 text-sm sm:leading-6">
                                            
                                            </textarea>
                                        </div>
                                        @error('description')
                                            <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                        @enderror
                                    </div>
                                  
                                    <div class="lg:col-span-3 col-span-full">
                                        <label for="profit" class="block text-sm font-medium leading-6 text-gray-900">Margen de ganancia.</label>
                                        <div class="mt-2">
                                            <input type="number" wire:model="profit" name="profit" id="profit"
                                                autocomplete="off" placeholder="Escriba un nombre para la sucursal"
                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 text-sm sm:leading-6">
                                        </div>
                                        @error('profit')
                                            <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                        @enderror
                                    </div>
                               
                                    <div class="lg:col-span-3 col-span-full">
                                        <label for="cost" class="block text-sm font-medium leading-6 text-gray-900">Costo parcial.</label>
                                        <div class="mt-2">
                                            <input type="number" wire:model="cost" name="cost" id="cost"
                                                autocomplete="off" placeholder="Escriba una descripción para tu producto."
                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 text-sm sm:leading-6">
                                        </div>
                                        @error('cost')
                                            <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                        @enderror
                                    </div>


                                    @if($radioGroupSelectedValue ==  0 || $radioGroupSelectedValue ==  1)

                                    <div class="sm:col-span-3">
                                        <label for="unitMeditionTypes" class="block text-sm font-medium leading-6 text-gray-900">Unidades de medida.</label>
                                            <div class="mt-2">
                                                <livewire:components.select-general :values="$unitMeditionTypes"
                                                    :imageValue="false" :searchEnabled="false" :name="'unit-of-measurement'"
                                                    :selectAllActivated="false"
                                                    :model="false">
                                            </div>
                                            @error('unit_of_measurement')
                                                <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                            @enderror
                                      </div>


                                      <div class="sm:col-span-3">
                                        <label for="measure" class="block text-sm font-medium leading-6 text-gray-900">Medida de producto.</label>
                                        <div class="mt-2">
                                            <input type="number" wire:model="measure" name="measure" id="measure"
                                                autocomplete="off" placeholder="Escriba un nombre para la sucursal"
                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 text-sm sm:leading-6">
                                        </div>
                                        @error('measure')
                                            <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
                                        @enderror
                                      </div>


                                      @endif
                            
                            </div>
                        </div>

                        <div x-data="{
                            radioGroupSelectedValue: @entangle('radioGroupSelectedValue'),
                            radioGroupOptions: [
                                {
                                    title: 'Un solo uso',
                                    description: 'Producto que sera usado y descartado',
                                    value: 'single-use'
                                },
                                {
                                    title: 'Administrable',
                                    description: 'Insumo que contienen una cantidad de unidades o medidas, y se gestiona su cantidad progresivamente, hasta ser descartado',
                                    value: 'administrable'
                                },
                                {
                                    title: 'Multiples usos',
                                    description: 'Usos multiples hasta quedar inutilizable, como herramientas.',
                                    value: 'infinite'
                                },
                            ]
                        }" class="w-full bg-white">

                            <div class="w-[1100px] mx-auto space-y-3 px-4"> <!-- Contenedor centrado -->
                                <template x-for="(option, index) in radioGroupOptions" :key="index">
                                    <label @click="radioGroupSelectedValue=option.value" class="flex items-start p-5 space-x-3 bg-white border rounded-md shadow-sm hover:bg-gray-50 border-neutral-200/70">
                                        <input type="radio" name="radio-group" :value="option.value" class="text-indigo-600 translate-y-px focus:ring-indigo-600" />
                                        <span class="relative flex flex-col text-left space-y-1.5 leading-none">
                                            <span x-text="option.title" class="font-semibold"></span>
                                            <span x-text="option.description" class="text-sm opacity-50"></span>
                                        </span>
                                    </label>
                                </template>
                            </div>

                        </div>


                        <div class="grid grid-cols-1 gap-x-8 gap-y-8 pt-2 m-10">
            

            
                            <div class="col-span-full mb-7">
                                <label for="files"
                                    class="block text-sm font-medium leading-6 text-gray-900">Imagenes del producto</label>
         
                                <livewire:components.upload-file wire:key="'product-images'" :multiple="true" :types="[
                                    'image',
                                ]" 
                                :name="'product-images'"
                                />
         
                            </div>
         
                             
                         </div>
                         <div class="grid grid-cols-1 gap-x-8 gap-y-8 pt-2 m-10">


                            <div class="col-span-full mb-7">
                                <label for="files"
                                    class="block text-sm font-medium leading-6 text-gray-900">Documentos relacionados</label>
         
                                <livewire:components.upload-file wire:key="'product-documents'" :multiple="true" :types="[
                                    'document',
                                ]" 
                                :name="'product-documents'"
                                />
         
                            </div>
        
                         </div>

                    </div>

                </div>
    
    


                <div class="flex items-center justify-end gap-x-4  px-4  sm:px-8">
                    <button wire:click="save('save')"
                        class="rounded-md bg-indigo-600 px-3 py-2 font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 text-sm focus-visible:outline-indigo-600">Crear</button>

                    <button wire:click="save('save-new')"
                        class="rounded-md bg-indigo-600 px-3 py-2 font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 text-sm focus-visible:outline-indigo-600">Crear
                        y crear otra</button>
                 </div>


             {{--  --}}

        </main>

    </div>
</div>
