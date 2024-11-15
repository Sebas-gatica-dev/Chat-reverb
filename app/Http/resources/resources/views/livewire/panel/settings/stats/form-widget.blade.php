<div class="grid w-full grid-cols-1 gap-x-6 gap-y-6 md:gap-y-8 sm:grid-cols-12">

    <div class="col-span-full">
        <label for="typeWidget" class="block text-sm font-medium leading-6 text-gray-900">Tipo</label>
        <div class="mt-2">
            <livewire:components.select-general :selectedValue="$selectedTypeWidget" :values="$typesWidget" :imageValue="false" :searchEnabled="false"
                :name="'typesWidget'" :model="false">

        </div>
        @error('selectedTypeWidget')
            <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
        @enderror
    </div>


    <div class="col-span-full">
        <label for="logicsWidget" class="block text-sm font-medium leading-6 text-gray-900">Lógica</label>
        <div class="mt-2">
            <livewire:components.select-general :selectedValue="$selectedLogicWidget" :values="$logicsWidget" :imageValue="false" :searchEnabled="true"
                :name="'logicsWidget'" :model="false">

        </div>
        @error('selectedLogicWidget')
            <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
        @enderror
    </div>



    <div class="col-span-full">
        <label for="datesWidget" class="block text-sm font-medium leading-6 text-gray-900">Fechas</label>
        <div class="mt-2">
            <livewire:components.select-general :selectedValue="$selectedDateWidget" :values="$datesWidget" :imageValue="false"
                :searchEnabled="true" :name="'datesWidget'" :model="false">

        </div>
        @error('selectedDateWidget')
            <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
        @enderror
    </div>


    <div class="col-span-full">
        <label for="sizesWidget" class="block text-sm font-medium leading-6 text-gray-900">Tamaño</label>
        <div class="mt-2">
            <livewire:components.select-general :selectedValue="$selectedSizeWidget" :values="$sizesWidget" :imageValue="false"
                :searchEnabled="false" :name="'sizesWidget'" :model="false">

        </div>
        @error('selectedSizeWidget')
            <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
        @enderror
    </div>
    <div class="col-span-full">
        <label for="description" class="block text-sm font-medium leading-6 text-gray-900">Descripción</label>
        <div class="mt-2">
            <textarea wire:model="description" autocomplete="off" placeholder="Agrege una descripción" id="description"
                name="description" rows="2"
                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 text-sm  sm:leading-6"></textarea>
        </div>
        @error('description')
            <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
        @enderror
    </div>





    <div class="col-span-full">
        <div x-data="{
            isOpen: false,
            colors: [
                '#FFFFFF', '#F3F4F6', '#D1D5DB', '#6B7280', '#000000',
                '#FEE2E2', '#FCA5A5', '#F87171', '#EF4444', '#B91C1C',
                '#FEF3C7', '#FDE68A', '#FBBF24', '#F59E0B', '#D97706',
                '#D1FAE5', '#A7F3D0', '#6EE7B7', '#34D399', '#059669',
                '#DBEAFE', '#BFDBFE', '#60A5FA', '#3B82F6', '#1D4ED8',
                '#EDE9FE', '#DDD6FE', '#C4B5FD', '#A78BFA', '#6D28D9'
            ],
            selectedColor: @entangle('widgetColor').live,
            dropdownPosition: 'bottom',
        
            selectColor(color) {
                this.selectedColor = color;
                this.isOpen = false;
            },
        
            updateDropdownPosition() {
                this.$nextTick(() => {
                    const button = this.$refs.colorButton.getBoundingClientRect();
                    const dropdownHeight = this.$refs.colorDropdown.offsetHeight;
                    const spaceBelow = window.innerHeight - button.bottom;
                    const spaceAbove = button.top;
        
                    if (spaceBelow < dropdownHeight && spaceAbove > dropdownHeight) {
                        this.dropdownPosition = 'top';
                    } else {
                        this.dropdownPosition = 'bottom';
                    }
                });
            }
        }" x-init="$watch('isOpen', value => { if (value) updateDropdownPosition(); })" class="relative flex items-center">

            <button @click="isOpen = !isOpen" @click="updateDropdownPosition"
                :style="{ backgroundColor: selectedColor }" x-ref="colorButton"
                class="w-6 h-6
                
        
                sm:w-10 sm:h-10 rounded cursor-pointer border-2 border-gray-800 focus:outline-none">
            </button>

            <span class="ml-2 text-base">Elegir un color</span>

            <!-- Selector desplegable -->
            <div x-show="isOpen" x-ref="colorDropdown" @click.outside="isOpen = false"
                x-transition:enter="transition ease-out duration-100" x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-75"
                x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                :class="dropdownPosition === 'top' ? 'bottom-full mb-2' : 'top-full mt-2'"
                class="absolute bg-white p-4 rounded-lg shadow-lg grid grid-cols-5 gap-2 w-auto z-10">

                <!-- Cuadrícula de colores -->
                <template x-for="(color, index) in colors" :key="index">
                    <div :style="{ backgroundColor: color }" @click="selectColor(color)"
                        class="w-10 h-10 rounded cursor-pointer border-2"
                        :class="{ 'border-black': selectedColor === color, 'border-transparent': selectedColor !== color }">
                    </div>
                </template>
            </div>
        </div>

        @error('widgetColor')
            <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
        @enderror
    </div>



    <div class="col-span-full">
        <div {{ $widget ? 'wire:click=update' : 'wire:click=save' }}
            class="relative md:absolute w-full bg-gradient-to-r from-indigo-500 to-purple-500 py-2 sm:py-4 pr-3 text-white font-bold text-center bottom-0 rounded-md text-sm">
            GUARDAR
        </div>
    </div>
</div>
