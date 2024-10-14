@php

    $mainLinks = [
        [
            'title' => 'Plan',
            'url' => route('master.plans.index'),
            'active' => 'master.plans.*',
            'icon' => 'M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z',
        ],


    ];

@endphp


<nav class="flex-none px-4 sm:px-6 lg:px-0">
    <ul role="list" class="flex gap-x-3 gap-y-1 whitespace-nowrap lg:flex-col">
        @foreach ($mainLinks as $link)
        <li>

            <!-- Current: "bg-gray-50 text-indigo-600", Default: "text-gray-700 hover:text-indigo-600 hover:bg-gray-50" -->
                <a href="{{ $link['url'] }}" wire:navigate
                class="group flex gap-x-3 rounded-md py-2 pl-2 pr-3 text-sm leading-6 font-semibold
                {{ isset($link['active']) && request()->routeIs($link['active']) ? 'bg-gray-50 text-indigo-600 ' :  'text-gray-700 hover:text-indigo-600 hover:bg-gray-50' }}
                ">


                <svg class="h-6 w-6 shrink-0 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="{{ $link['icon'] }}" />
                </svg>
                {{ $link['title'] }}
            </a>
        </li>
        @endforeach

    </ul>
</nav>
