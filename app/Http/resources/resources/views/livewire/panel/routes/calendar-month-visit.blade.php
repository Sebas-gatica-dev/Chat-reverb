<div>
    <header class="bg-white shadow">
        <div class="mx-auto max-w-screen-2xl px-4 py-6 sm:px-6 lg:px-8">
            <div class="sm:flex sm:items-center sm:justify-between">
                <div class="min-w-0 flex-1">
                    <h1 class="text-2xl font-bold tracking-tight text-gray-900">Rutas</h1>
                </div>
                <div class="mt-4 flex md:ml-4 md:mt-0 justify-end gap-2">



                    <span class="isolate inline-flex rounded-md shadow-sm">


                        <button type="button" wire:click="previousMonth"
                            class="relative inline-flex items-center rounded-l-md bg-white px-3 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-10">
                            <span class="sr-only">Previous</span>
                            <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>


                        <div x-data="{ date: '{{ $currentYear }}-{{ str_pad($currentMonth, 2, '0', STR_PAD_LEFT) }}' }">
                            <input type="month" x-model="date" @change="$wire.goToMonth(date)"
                                class="border-y-gray-300 border-l-0 text-sm px-3 py-2">
                        </div>


                        <button type="button" wire:click="nextMonth"
                            class="relative -ml-px inline-flex items-center rounded-r-md bg-white px-3 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-10">
                            <span class="sr-only">Next</span>
                            <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>

                    </span>
                    <div class="hidden md:ml-4 md:flex md:items-center">
                        <div class="relative" x-data="{ open: false }">
                            <button type="button"
                                class="flex items-center gap-x-1.5 rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50"
                                id="menu-button" aria-expanded="false" aria-haspopup="true" @click="open = !open">
                                Vista mensual
                                <svg class="-mr-1 h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor"
                                    aria-hidden="true">
                                    <path fill-rule="evenodd"
                                        d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>


                            <div class="absolute right-0 z-10 mt-3 w-36 origin-top-right overflow-hidden rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                                role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1"
                                x-show="open" @click.away="open = false"
                                x-transition:enter="transition ease-out duration-100"
                                x-transition:enter-start="transform opacity-0 scale-95"
                                x-transition:enter-end="transform opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-75"
                                x-transition:leave-start="transform opacity-100 scale-100"
                                x-transition:leave-end="transform opacity-0 scale-95" x-cloak>

                                <div class="" role="none">
                                    <!-- Active: "bg-gray-100 text-gray-900", Not Active: "text-gray-700" -->
                                    <a wire:navigate href="{{ route('panel.routes.daily', ['year' => \Carbon\Carbon::now()->year, 'month' => \Carbon\Carbon::now()->month  , 'day' => \Carbon\Carbon::now()->day ] ) }}" class="block px-4 py-2 text-sm text-gray-700" role="menuitem"
                                        tabindex="-1" id="menu-item-0">Vista diaria</a>
                                    <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem"
                                        tabindex="-1" id="menu-item-1">Vista semanal</a>
                                    <a wire:navigate href="{{ route('panel.routes.monthly', ['year' => $currentYear, 'month' => str_pad($currentMonth, 2, '0', STR_PAD_LEFT) ]) }}" class="block px-4 py-2 text-sm bg-gray-100 text-gray-900" role="menuitem"
                                        tabindex="-1" id="menu-item-2">Vista mensual</a>
                                    <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem"
                                        tabindex="-1" id="menu-item-3">Vista anual</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 flex md:mt-0 justify-end">

                        <a wire:navigate href="{{ route('panel.routes.organizer') }}"
                            class="ml-3 inline-flex items-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Organizar
                            rutas

                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                class="size-5 ml-3">
                                <path fill-rule="evenodd"
                                    d="M11.622 1.602a.75.75 0 0 1 .756 0l2.25 1.313a.75.75 0 0 1-.756 1.295L12 3.118 10.128 4.21a.75.75 0 1 1-.756-1.295l2.25-1.313ZM5.898 5.81a.75.75 0 0 1-.27 1.025l-1.14.665 1.14.665a.75.75 0 1 1-.756 1.295L3.75 8.806v.944a.75.75 0 0 1-1.5 0V7.5a.75.75 0 0 1 .372-.648l2.25-1.312a.75.75 0 0 1 1.026.27Zm12.204 0a.75.75 0 0 1 1.026-.27l2.25 1.312a.75.75 0 0 1 .372.648v2.25a.75.75 0 0 1-1.5 0v-.944l-1.122.654a.75.75 0 1 1-.756-1.295l1.14-.665-1.14-.665a.75.75 0 0 1-.27-1.025Zm-9 5.25a.75.75 0 0 1 1.026-.27L12 11.882l1.872-1.092a.75.75 0 1 1 .756 1.295l-1.878 1.096V15a.75.75 0 0 1-1.5 0v-1.82l-1.878-1.095a.75.75 0 0 1-.27-1.025ZM3 13.5a.75.75 0 0 1 .75.75v1.82l1.878 1.095a.75.75 0 1 1-.756 1.295l-2.25-1.312a.75.75 0 0 1-.372-.648v-2.25A.75.75 0 0 1 3 13.5Zm18 0a.75.75 0 0 1 .75.75v2.25a.75.75 0 0 1-.372.648l-2.25 1.312a.75.75 0 1 1-.756-1.295l1.878-1.096V14.25a.75.75 0 0 1 .75-.75Zm-9 5.25a.75.75 0 0 1 .75.75v.944l1.122-.654a.75.75 0 1 1 .756 1.295l-2.25 1.313a.75.75 0 0 1-.756 0l-2.25-1.313a.75.75 0 1 1 .756-1.295l1.122.654V19.5a.75.75 0 0 1 .75-.75Z"
                                    clip-rule="evenodd" />
                            </svg>


                        </a>
                    </div>


                </div>
            </div>
        </div>
    </header>

    {{-- <header class="bg-white shadow">
        <div class="mx-auto max-w-screen-2xl px-4 py-6 sm:px-6 lg:px-8">
            <div class="sm:flex sm:items-center sm:justify-between">
                <div class="min-w-0 flex-1">
                    <h1 class="text-2xl font-bold tracking-tight text-gray-900">Rutas</h1>
                </div>


                <div class="mt-4 flex md:ml-4 md:mt-0 justify-end">

                    <a wire:navigate href="{{ route('panel.routes.organizer') }}"
                        class="ml-3 inline-flex items-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Organizar
                        rutas

                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                            class="size-5 ml-3">
                            <path fill-rule="evenodd"
                                d="M11.622 1.602a.75.75 0 0 1 .756 0l2.25 1.313a.75.75 0 0 1-.756 1.295L12 3.118 10.128 4.21a.75.75 0 1 1-.756-1.295l2.25-1.313ZM5.898 5.81a.75.75 0 0 1-.27 1.025l-1.14.665 1.14.665a.75.75 0 1 1-.756 1.295L3.75 8.806v.944a.75.75 0 0 1-1.5 0V7.5a.75.75 0 0 1 .372-.648l2.25-1.312a.75.75 0 0 1 1.026.27Zm12.204 0a.75.75 0 0 1 1.026-.27l2.25 1.312a.75.75 0 0 1 .372.648v2.25a.75.75 0 0 1-1.5 0v-.944l-1.122.654a.75.75 0 1 1-.756-1.295l1.14-.665-1.14-.665a.75.75 0 0 1-.27-1.025Zm-9 5.25a.75.75 0 0 1 1.026-.27L12 11.882l1.872-1.092a.75.75 0 1 1 .756 1.295l-1.878 1.096V15a.75.75 0 0 1-1.5 0v-1.82l-1.878-1.095a.75.75 0 0 1-.27-1.025ZM3 13.5a.75.75 0 0 1 .75.75v1.82l1.878 1.095a.75.75 0 1 1-.756 1.295l-2.25-1.312a.75.75 0 0 1-.372-.648v-2.25A.75.75 0 0 1 3 13.5Zm18 0a.75.75 0 0 1 .75.75v2.25a.75.75 0 0 1-.372.648l-2.25 1.312a.75.75 0 1 1-.756-1.295l1.878-1.096V14.25a.75.75 0 0 1 .75-.75Zm-9 5.25a.75.75 0 0 1 .75.75v.944l1.122-.654a.75.75 0 1 1 .756 1.295l-2.25 1.313a.75.75 0 0 1-.756 0l-2.25-1.313a.75.75 0 1 1 .756-1.295l1.122.654V19.5a.75.75 0 0 1 .75-.75Z"
                                clip-rule="evenodd" />
                        </svg>


                    </a>
                </div>

            </div>
        </div>


    </header> --}}
    <div class="mx-auto max-w-screen-2xl md:px-6 lg:px-8 pb-8">
        <div class="lg:flex lg:h-full lg:flex-col">
            <header class="flex items-center justify-between border-b border-gray-200 px-6 py-4 lg:flex-none">
                <h1 class="text-base font-semibold leading-6 text-gray-900">
                    <time datetime="{{ Carbon\Carbon::create($currentYear, $currentMonth, 1)->format('Y-m') }}">
                        {{ Carbon\Carbon::create($currentYear, $currentMonth, 1)->isoFormat('MMMM, YYYY') }}
                    </time>
                </h1>
            </header>
            <div class="shadow ring-1 ring-black ring-opacity-5 lg:flex lg:flex-auto lg:flex-col">
                <div
                    class="grid grid-cols-7 gap-px border-b border-gray-300 bg-gray-200 text-center text-xs font-semibold leading-6 text-gray-700 lg:flex-none">
                    <div class="flex justify-center bg-white py-2">
                        <span>L</span>
                        <span class="sr-only sm:not-sr-only">un</span>
                    </div>
                    <div class="flex justify-center bg-white py-2">
                        <span>M</span>
                        <span class="sr-only sm:not-sr-only">ar</span>
                    </div>
                    <div class="flex justify-center bg-white py-2">
                        <span>M</span>
                        <span class="sr-only sm:not-sr-only">ie</span>
                    </div>
                    <div class="flex justify-center bg-white py-2">
                        <span>J</span>
                        <span class="sr-only sm:not-sr-only">ue</span>
                    </div>
                    <div class="flex justify-center bg-white py-2">
                        <span>V</span>
                        <span class="sr-only sm:not-sr-only">ie</span>
                    </div>
                    <div class="flex justify-center bg-white py-2">
                        <span>S</span>
                        <span class="sr-only sm:not-sr-only">a</span>
                    </div>
                    <div class="flex justify-center bg-white py-2">
                        <span>D</span>
                        <span class="sr-only sm:not-sr-only">om</span>
                    </div>
                </div>
                <div class="flex bg-gray-200 text-xs leading-6 text-gray-700 lg:flex-auto">
                    <div class="hidden w-full lg:grid lg:grid-cols-7 lg:grid-rows-6 lg:gap-px">
                        @php
                            $currentDate = $startOfWeek->copy();
                            $endDate = $endOfWeek->copy()->addDay();
                            $daysDisplayed = 0;
                        @endphp
                        @while ($daysDisplayed < 42)
                            @php
                                $isCurrentMonth = $currentDate->month === $currentMonth;
                                $date = $currentDate->toDateString();
                                $isToday =
                                    $currentDate->isToday() && $currentDate->month === Carbon\Carbon::now()->month;
                                $daysDisplayed++;
                            @endphp
                            <div wire:click="goToDay('{{ $date }}')"
                                class="relative  {{ $isCurrentMonth ? ($isToday ? 'bg-indigo-100 hover:bg-indigo-200' : 'bg-white hover:bg-indigo-50') : 'bg-gray-50 text-gray-500 hover:bg-indigo-50' }} px-3 py-2 h-28  cursor-pointer">
                                <time datetime="{{ $date }}"
                                    class="{{ $isToday ? 'flex h-6 w-6 items-center justify-center rounded-full bg-indigo-600 font-semibold text-white' : '' }}">
                                    {{ $currentDate->day }}

                                </time>
                                @if (isset($events[$date]))
                                    <ol class="mt-2">
                                        @foreach ($events[$date] as $event)
                                            <li>
                                                <a href="#" class="group flex">
                                                    <p
                                                        class="flex-auto truncate font-medium text-gray-900 group-hover:text-indigo-600">
                                                        {{ $event['title'] }}
                                                    </p>
                                                    <time datetime="{{ $date }}T{{ $event['time'] }}"
                                                        class="ml-3 hidden flex-none text-gray-500 group-hover:text-indigo-600 xl:block">
                                                        {{ $event['time'] }}
                                                    </time>
                                                </a>

                                            </li>
                                        @endforeach
                                    </ol>
                                @endif
                            </div>
                            @php
                                $currentDate->addDay();
                            @endphp
                        @endwhile
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
