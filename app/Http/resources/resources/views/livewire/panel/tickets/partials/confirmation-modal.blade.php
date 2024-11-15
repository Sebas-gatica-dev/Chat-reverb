<div x-show="{{ $showModal }}" x-cloak class="relative z-10" aria-labelledby="modal-title" role="dialog"
    aria-modal="true">
    <!--
    Background backdrop, show/hide based on modal state.

    Entering: "ease-out duration-300"
      From: "opacity-0"
      To: "opacity-100"
    Leaving: "ease-in duration-200"
      From: "opacity-100"
      To: "opacity-0"
  -->
    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

    <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <!--
        Modal panel, show/hide based on modal state.

        Entering: "ease-out duration-300"
          From: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
          To: "opacity-100 translate-y-0 sm:scale-100"
        Leaving: "ease-in duration-200"
          From: "opacity-100 translate-y-0 sm:scale-100"
          To: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
      -->
            <div
                class="relative transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-auto sm:max-w-lg sm:p-6">
                <div class="sm:inline-flex sm:items-center">
                    <div
                        class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full 
                           {{ $iconBgColor }} sm:mx-0 sm:h-10 sm:w-10">
                        {!! $icon !!}
                    </div>



                    <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                        <h3 class="text-base font-semibold text-gray-900" id="modal-title"> {{ $title }}</h3>
                        @if (!$photo)
                            <div class="mt-2">
                                <p class="text-sm text-gray-500">{{ $message }}</p>
                            </div>
                        @endif


                    </div>

                </div>
                <div class="">
                    {{-- mostrar foto --}}
                    @if ($photo)
                        <div class="aspect-h-1 aspect-w-2 overflow-hidden rounded-lg">
                            <img src="{{ $photo }}" alt="Model wearing plain gray basic tee."
                                class="h-48 w-48 object-cover object-center">
                        </div>

                        <div class="mt-2">
                            <p class="text-sm text-gray-500">{{ $message }}</p>
                        </div>
                    @endif

                </div>

                @if ($modalToggle)
            
                    <div class="mt-5 ml-4 text-red-500">

                        <livewire:components.toggle 
                        :answer="$modalToggleAnswer"
                        :colorTextAnswer="'text-gray-600'"
                        :checked="$modalModel->discount_bill" :toggleId="$modalModel['id']" 
                        />


                    </div>
                @endif

                <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse" x-cloak>

                    @if (!$modalView)
                        <button wire:click="{{ $confirmAction }}" type="button"
                            class="inline-flex w-full justify-center rounded-md {{ $confirmButtonColor }} px-4 py-2 text-base font-medium text-white shadow-sm hover:{{ $confirmButtonHoverColor }} sm:ml-3 sm:w-auto sm:text-sm">
                            {{ $confirmButtonText }}
                        </button>
                    @endif
                    <button wire:click='cancelAction' type="button"
                        class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-4 py-2 text-base font-medium text-gray-700 shadow-sm hover:bg-gray-50 sm:mt-0 sm:w-auto sm:text-sm">
                        Cancelar
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
