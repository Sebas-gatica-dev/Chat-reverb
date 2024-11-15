<div>
    <h2 class="text-lg font-semibold text-gray-700">Vista previa del input</h2>
    <p class="text-gray-500 mt-2">Selecciona un tipo de input para ver su vista previa.</p>

    <!-- Skeleton input with aggressive pulse -->
    <div class="grid grid-cols-12 mt-4 mx-auto h-12 w-full max-w-md rounded-lg bg-gray-300 animate-aggressive-pulse">
        <div class="col-span-2 m-4 bg-slate-50 rounded-full">
        </div>
        <div class="col-span-10 m-4 bg-slate-50  rounded-md"></div>

    </div>

    <!-- Styles for aggressive pulse -->
    <style>
        @keyframes aggressive-pulse {
            0%, 100% {
                opacity: 1;
            }
            50% {
                opacity: 0.5;
            }
        }
        
        .animate-aggressive-pulse {
            animation: aggressive-pulse 1.5s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }
    </style>
</div>









{{-- <div >
    <h2 class="text-lg font-semibold text-gray-700">Vista previa del input</h2>
    <p class="text-gray-500 mt-2">Selecciona un tipo de input para ver su vista previa.</p>
    <svg class="mx-auto mt-4 h-16 w-16 text-gray-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
    </svg>
      
</div> --}}
