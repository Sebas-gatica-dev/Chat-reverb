<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component {
    /**
     * Log the current user out of the application.
     */

    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
}; ?>


<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-gray-900">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Master</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles

</head>

<body class="font-sans antialiased h-full">

    <livewire:master.partials.navigation-master>

        <div class="xl:pl-72">
            <!-- Sticky search header -->

            {{-- SEARCH --}}

            {{-- CONTENIDO PRINCIPAL --}}
            <main>
                <h1 class="sr-only">Configuracion del sistema</h1>

                @if (isset($subroutes))
                    <!-- SUBMENU  -->
                    <header class="border-b border-white/5">
                        <!-- Secondary navigation -->
                        <nav class="flex overflow-x-auto py-4">
                            <ul role="list"
                                class="flex min-w-full flex-none gap-x-6 px-4 text-sm font-semibold leading-6 text-gray-400 sm:px-6 lg:px-8">
                                @foreach ($subroutes as $subroute)
                                    <li>
                                        <a href="{{ $subroute['url'] }}" wire:navigate
                                            class="{{ Request::is($subroute['url']) ? 'text-indigo-400' : '' }}">
                                            {{ $subroute['name'] }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </nav>
                    </header>
                @endif

                <!-- Settings forms -->
                <div class="divide-y divide-white/5">
                    <div class="grid max-w-7xl grid-cols-1 gap-x-8 gap-y-10 px-4 sm:px-6 md:grid-cols-1 lg:px-8">

                        {{-- <h2 class="text-base font-semibold leading-7 text-white">Contenido principal</h2>
                        <p class="mt-1 text-sm leading-6 text-gray-400">Use a permanent address where you can
                            receive mail.</p> --}}
                        {{ $slot }}



                    </div>

                </div>
            </main>
        </div>

        @livewireScripts
</body>

</html>
