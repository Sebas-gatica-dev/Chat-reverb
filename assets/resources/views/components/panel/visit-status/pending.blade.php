<div>
    <div class="rounded-md bg-blue-50 p-4 mt-4">
        <div class="flex">
            <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-blue-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd"
                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a.75.75 0 000 1.5h.253a.25.25 0 01.244.304l-.459 2.066A1.75 1.75 0 0010.747 15H11a.75.75 0 000-1.5h-.253a.25.25 0 01-.244-.304l.459-2.066A1.75 1.75 0 009.253 9H9z"
                        clip-rule="evenodd" />
                </svg>
            </div>
            <div class="ml-3 flex-1 md:flex md:justify-between">
                <p class="text-sm text-blue-700">Es recomendable que tomes en cuenta tiempo extra de llegada por
                    cualquier inconveniente.</p>
            </div>
        </div>
    </div>

    <div class="col-span-full mt-6">
        <label for="approximateTime" class="block text-sm font-medium leading-6 text-gray-900">Tiempo aproximado
            de llegada (*)</label>
        <div class="mt-2">
            <input type="text" wire:model="approximateTime" id="approximateTime" autocomplete="approximateTime"
                placeholder="Ingrese el tiempo aproximado de llegada en minutos"
                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 text-sm sm:leading-6">
        </div>

        <label for="comment" class="block text-sm font-medium leading-6 text-gray-900 mt-4">Comentario</label>
        <div class="mt-2">
            <textarea wire:model="comment" autocomplete="off" placeholder="Agrege un comentario en caso de ser necesario"
                rows="3" id="comment"
                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 text-sm  sm:leading-6"></textarea>
        </div>
        @error('approximateTime')
            <span class="text-red-500 text-sm ml-0.5">{{ $message }}</span>
        @enderror

        {{-- @dump($latitude, $longitude)
        <a href="https://maps.google.com/?q={{ $latitude }},{{ $longitude }}" target="_blank"
            class="block mt-2 text-sm font-medium text-indigo-600 hover:text-indigo-900">Ver ubicación en Google Maps</a> --}}
    </div>
</div>
