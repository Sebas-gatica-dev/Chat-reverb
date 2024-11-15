@props([
    'model', // El wire:model
    'label', // Label del campo
    'placeholder' => '', // Placeholder del input
    'type' => 'text', // Tipo del input
    'disabled' => false, // New disabled attribute
])





<label for="{{ $model }}" class="block text-sm font-medium leading-6 text-gray-900">
    {{ $label }}
</label>
<div class="mt-2 relative" x-data="{ iconVisible: false }" x-init="@this.on('{{ $model }}', () => { iconVisible = true;
    setTimeout(() => iconVisible = false, 1500); })">


    @if($type == 'textarea')
<textarea wire:model.live.debounce.500ms="{{ $model }}" id="{{ $model }}" autocomplete="{{ $model }}" placeholder="{{ $placeholder }}"
@if($disabled) disabled @endif  
    wire:loading.class="pr-10" wire:target="{{ $model }}" rows="5"  
    :class="iconVisible ? 'pr-10' : 'transition-all duration-700'"
        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm text-sm
        ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2
        focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"> </textarea>
    @else

    <!-- Input de texto con padding ajustado dinámicamente -->
    <input type="{{ $type }}" wire:model.live.debounce.500ms="{{ $model }}" id="{{ $model }}"
        @if($disabled) disabled @endif
        autocomplete="{{ $model }}" placeholder="{{ $placeholder }}" wire:loading.class="pr-10"
        wire:target="{{ $model }}" :class="iconVisible ? 'pr-10' : ' transition-all duration-700'"
        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm
        ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2
        focus:ring-inset focus:ring-indigo-600 text-sm sm:leading-6">
        @endif

    <!-- Indicador de carga (spinner) dentro del input -->
    <span class="absolute right-2 top-1/2 -translate-y-1/2" wire:loading wire:target="{{ $model }}">
        <svg class="animate-spin h-4 w-4 text-black" xmlns="http://www.w3.org/2000/svg" fill="none"
            viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
            </circle>
            <path class="opacity-75" fill="currentColor"
                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
            </path>
        </svg>
    </span>

    <!-- Tilde que aparece cuando termina de cargar, dentro del input -->
    <span class="absolute right-2 top-1/2 -translate-y-1/2 text-green-500" x-data="{ showCheck: false }" x-show="showCheck"
        x-transition.opacity.out.duration.1000ms x-init="@this.on('{{ $model }}', () => { showCheck = true;
            iconVisible = true;
            setTimeout(() => { showCheck = false;
                iconVisible = false }, 1500); })" wire:loading.remove
        wire:target="{{ $model }}" x-cloak>
        ✓
    </span>

    <!-- Cruz que aparece si hay un error, dentro del input -->
    @error($model)
        <span class="absolute right-2 top-1/2 -translate-y-1/2 text-red-500" wire:loading.remove
            wire:target="{{ $model }}" x-init="iconVisible = true" x-cloak>
            X
        </span>
    @enderror
</div>


<!-- Mensaje de error debajo del input -->
@error($model)
    <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
@enderror
