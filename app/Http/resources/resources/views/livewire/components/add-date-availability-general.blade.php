<div>
    {{-- @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif --}}



    <h3 class="mb-4 mt-4 text-sm font-medium text-gray-900">Agregar disponibilidad horaria</h3>






    <div class="flex flex-col md:items-center md:flex-row gap-2">
        <select wire:model="newAvailability.day" class="rounded-md text-sm w-full md:w-auto
        {{ $errors->has('newAvailability.day') ? 'border-red-500 focus:ring-red-500 focus:border-red-500 ' : 'border-gray-300 ' }}">
            <option value="">Seleccione un día</option>
            <option value="Todos los días">Todos los días</option>
            <option value="Lunes a viernes">Lunes a viernes</option>
            <option value="Sábados y domingos">Sábados y domingos</option>
            <option value="Lunes">Lunes</option>
            <option value="Martes">Martes</option>
            <option value="Miércoles">Miércoles</option>
            <option value="Jueves">Jueves</option>
            <option value="Viernes">Viernes</option>
            <option value="Sábado">Sábado</option>
            <option value="Domingo">Domingo</option>
        </select>

        <div class="flex gap-2">

            <input type="time" wire:model="newAvailability.start_time"
            class="rounded-md text-sm w-full md:w-auto
            {{ $errors->has('newAvailability.start_time') ? 'border-red-500 focus:ring-red-500 focus:border-red-500 ' : 'border-gray-300 ' }}">

            <input type="time" wire:model="newAvailability.end_time"
            class="rounded-md text-sm w-full md:w-auto
            {{ $errors->has('newAvailability.end_time') ? 'border-red-500 focus:ring-red-500 focus:border-red-500 ' : 'border-gray-300 ' }}">
        </div>
        <button type="button" wire:click="addAvailability"
            class="rounded-md bg-indigo-500 px-3 py-2 font-semibold  text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 text-sm focus-visible:outline-indigo-600">Agregar
            franja horaria</button>
    </div>

    <div class="flex flex-col md:items-center md:flex-row gap-2">

        @foreach ($errors->all() as $error)
        <p class="mt-2 text-sm text-red-600 dark:text-red-500">{!! $error !!}</p>
        @endforeach
    </div>

    @if ($groupedAvailabilities)
        <div
            class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-7 gap-x-4 border-t border-gray-200 pt-6 border-dashed gap-y-4 xl:gap-y-0 mt-8">
            @foreach ($groupedAvailabilities as $day => $availabilities)
                <div>
                    <span class="font-semibold text-sm">{{ $this->translateDay($day) }}:</span>
                    <div class="flex flex-wrap gap-2 mt-2">
                        @foreach ($availabilities as $availability)
                            <div
                                class="flex items-center gap-x-2 p-2 border border-gray-300 rounded-md text-sm w-full justify-between">
                                <span class="text-[13px]">{{ $availability['start_time'] }} -
                                    {{ $availability['end_time'] }}</span>

                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    class="size-4 text-red-500 hover:bg-red-500 hover:text-white hover:rounded cursor-pointer"
                                    wire:click="removeAvailability('{{ $availability['id'] }}')">
                                    <path fill-rule="evenodd"
                                        d="M5.47 5.47a.75.75 0 0 1 1.06 0L12 10.94l5.47-5.47a.75.75 0 1 1 1.06 1.06L13.06 12l5.47 5.47a.75.75 0 1 1-1.06 1.06L12 13.06l-5.47 5.47a.75.75 0 0 1-1.06-1.06L10.94 12 5.47 6.53a.75.75 0 0 1 0-1.06Z"
                                        clip-rule="evenodd" />
                                </svg>

                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    @endif

</div>
