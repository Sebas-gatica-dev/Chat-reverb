<div x-data="{
    options: @entangle('optionsForSelect') ?? [], // Aseguramos que sea un array desde el inicio
    newOption: '',
    showOptions: false,
    showInputCreateOption: false,
    editOptionIndex: null, // Para almacenar el índice de la opción en modo edición
    editedOptionText: '', // Almacena el texto de la opción editada
    selectDropdownPosition: 'bottom', // Variable para controlar la posición

    addOption() {
        console.log(this.options); // Verificar el valor actual

        if (this.newOption.trim() !== '') {
            const slug = this.slugify(this.newOption); // Genera el slug basado en el label

            // Si 'this.options' está vacío o es null, inicializamos el array
            if (this.options != null) {
                this.options.push({ label: this.newOption, value: slug }); // Añade la opción con el slug
            } else {
                this.options = [{ label: this.newOption, value: slug }];
            }

            this.newOption = '';
            this.showInputCreateOption = false;

            $wire.$set('optionsForSelect', this.options); // Actualizamos el valor en Livewire
        }
    },

    slugify(text) {
        return text.toString().toLowerCase()
            .replace(/\s+/g, '-') // Reemplaza espacios por guiones
            .replace(/[^\w\-]+/g, '') // Elimina caracteres no válidos
            .replace(/\-\-+/g, '-') // Reemplaza múltiples guiones por uno solo
            .replace(/^-+/, '') // Elimina guiones del inicio
            .replace(/-+$/, ''); // Elimina guiones del final
    },

    deleteOption(index) {
        this.options.splice(index, 1); // Eliminar opción por índice
        $wire.$set('optionsForSelect', this.options); // Actualizamos el valor en Livewire
    },

    enableEditOption(index) {
        this.editOptionIndex = index;
        this.editedOptionText = this.options[index].label;
    },

    saveEditOption(index) {
        if (this.editedOptionText.trim() !== '') {
            this.options[index].label = this.editedOptionText;
            this.options[index].value = this.slugify(this.editedOptionText); // Actualiza el slug al editar
            this.editOptionIndex = null;
            this.editedOptionText = '';
            $wire.$set('optionsForSelect', this.options); // Actualizamos el valor en Livewire
        }
    },

    cancelEditOption() {
        this.editOptionIndex = null;
        this.editedOptionText = '';
    },

    selectPositionUpdate() {
        const buttonRect = this.$refs.selectButton.getBoundingClientRect();
        const dropdownHeight = parseInt(window.getComputedStyle(this.$refs.selectableItemsList).maxHeight);
        const availableSpaceBelow = window.innerHeight - (buttonRect.top + buttonRect.height);
        const availableSpaceAbove = buttonRect.top;

        if (availableSpaceBelow < dropdownHeight && availableSpaceAbove > dropdownHeight) {
            this.selectDropdownPosition = 'top';
        } else {
            this.selectDropdownPosition = 'bottom';
        }
    }
}" x-init="
$watch('showOptions', value => { if (value) selectPositionUpdate(); });
if (!options) options = []; // Aseguramos que 'options' no sea null
console.log(options);"
@resize.window="selectPositionUpdate"
class="p-4 bg-gray-50 border border-gray-300 rounded-lg w-full relative">

    {{-- Etiqueta del "select" --}}
    <label class="block text-sm font-medium text-gray-700 mb-1">
        {{ $label }}

    </label>

    {{-- Contenedor simulado del "select" --}}
    <div @click="showOptions = !showOptions" x-ref="selectButton"
        class="mt-2 w-full px-3 py-2 border border-gray-300 bg-white text-gray-900 rounded-md shadow-sm cursor-pointer flex justify-between items-center">
        <span x-text="(this.options && this.options.length > 0) ? 'Seleccione una opción' : 'No hay opciones'"></span>
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
        </svg>
    </div>

    {{-- Lista desplegable de opciones simulada --}}
    <div x-show="showOptions" @click.away="showOptions = false" x-ref="selectableItemsList"
        x-transition:enter="transition ease-out duration-100" x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-75"
        x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
        :class="{ 'bottom-full mb-1': selectDropdownPosition == 'top', 'top-full mt-1': selectDropdownPosition == 'bottom' }"
        class="absolute z-10 w-full bg-white border border-gray-300 rounded-md shadow-lg max-h-48 overflow-y-auto">
        <ul class="max-h-48 overflow-y-auto">
            {{-- Opciones dinámicas --}}
            <template x-for="(option, index) in options" :key="index" x-show="this.options !== null">
                <li class="px-4 py-2 hover:bg-gray-100 cursor-pointer flex justify-between items-center">
                    <div class="flex-grow">
                        {{-- Si la opción está en modo edición, mostramos un input --}}
                        <template x-if="editOptionIndex === index">
                            <input x-model="editedOptionText" type="text"
                                class="px-2 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-600">
                        </template>
                        {{-- Si no está en modo edición, mostramos el texto normal --}}
                        <template x-if="editOptionIndex !== index">
                            <span x-text="option.label"></span>
                        </template>
                    </div>

                    {{-- Botones de editar/guardar y eliminar --}}
                    <div class="flex items-center space-x-2">
                        {{-- Botón para guardar cambios si estamos editando, si no, botón de editar --}}
                        <template x-if="editOptionIndex === index">
                            <button @click="saveEditOption(index)" class="text-green-500 hover:text-green-700">
                                💾
                            </button>
                        </template>
                        <template x-if="editOptionIndex !== index">
                            <button @click="enableEditOption(index)" class="text-indigo-600 hover:bg-indigo-500">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M16.862 3.487a2.25 2.25 0 113.182 3.182l-9.68 9.681-3.82.637a.75.75 0 01-.872-.872l.637-3.82 9.681-9.68z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 5.25L18 3.75" />
                                </svg>
                            </button>
                        </template>

                        {{-- Botón para eliminar --}}
                        <button @click="deleteOption(index)" class="text-red-500 hover:text-red-700">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19.5 6.75L17.25 21h-10.5L4.5 6.75M21 6.75h-18M14.25 10.5v6.75m-4.5-6.75v6.75M16.5 6.75v-.75A2.25 2.25 0 0014.25 3.75h-4.5A2.25 2.25 0 007.5 6v.75" />
                            </svg>
                        </button>
                    </div>
                </li>
            </template>

            {{-- Botón para agregar nueva opción --}}
            <li @click="showInputCreateOption = !showInputCreateOption"
                class="px-4 py-2 text-indigo-600 hover:bg-gray-100 cursor-pointer flex items-center">
                <template x-if="!showInputCreateOption">
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" class="w-5 h-5 mr-2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Agregar nueva opción
                    </div>
                </template>
                <template x-if="showInputCreateOption">
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" class="w-5 h-5 mr-2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        Cancelar
                    </div>
                </template>
            </li>
        </ul>

        {{-- Input para agregar nueva opción (se muestra al hacer clic en el botón +) --}}
        <div x-show="showInputCreateOption" class="p-2 border-t border-gray-200">
            <input x-model="newOption" type="text" placeholder="Nueva opción"
                class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-0 sm:text-sm">
            <button @click="addOption" type="button"
                class="mt-2 px-4 py-2 bg-gradient-to-t from-violet-800 to-purple-700 hover:from-purple-600 hover:to-purple-700 text-white rounded-md focus:outline-none focus:ring-0 w-full">
                Guardar opción
            </button>
        </div>
    </div>


    @if ($required)
        <span class="text-red-500">*Requerido*</span>
    @endif
</div>
