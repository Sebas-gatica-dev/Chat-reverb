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
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="session-notification" content="{{ json_encode(session('notification', [])) }}">


    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    @stack('scripts-dates')

    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css">

    @livewireStyles

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {{-- Recibir push scripts --}}
    @stack('scripts')
 

    <style>
        .scroll-container {
            display: flex;
            overflow-x: scroll;
            white-space: nowrap;
        }

        .scroll-item {
            flex: 0 0 auto;
            margin-right: 10px;
            /* Ajusta el espacio entre los elementos si es necesario */
        }
    </style>

</head>

<body class="font-sans bg-gray-50 antialiased flex flex-col min-h-screen">
    <!-- Navigation -->
    <livewire:layout.navigation>


        @session('subscription')
            <div class="bg-yellow-50">
                <div class="md:flex md:items-center md:justify-between mx-auto max-w-screen-2xl py-3">
                    <div class="min-w-0 flex-1 text-center">
                        <span class="text-md tracking-tight text-yellow-950">{{ $value }}
                    </div>
                </div>
            </div>
        @endsession

        <div x-data="{ open: $store.notification.open, message: $store.notification.message }" aria-live="assertive"
            class="pointer-events-none fixed inset-0 flex items-end px-4 py-6 z-50 sm:p-6">
            <div class="flex w-full flex-col items-center space-y-4 sm:items-end">
                <!-- Control de visibilidad basado en 'open', con transiciones -->
                <div x-cloak x-show="$store.notification.open"
                    x-transition:enter="transform ease-out duration-300 transition"
                    x-transition:enter-start="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
                    x-transition:enter-end="translate-y-0 opacity-100 sm:translate-x-0"
                    x-transition:leave="transition ease-in duration-100" x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0"
                    class="animate-[pulse_3s_ease-in-out_infinite]   pointer-events-auto w-full max-w-sm overflow-hidden rounded-lg bg-gradient-to-t from-gray-800 to-gray-900 shadow-lg ring-1 ring-white ring-opacity-5">
                    <div class="p-4">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <!-- Icono de éxito -->
                                <span x-html="$store.notification.type"></span>
                            </div>
                            <div class="ml-3 w-0 flex-1 pt-0.5">
                                <!-- Mensaje dinámico -->
                                <p class="text-sm font-medium text-gray-200" x-text="$store.notification.message"></p>
                                {{-- <p class="mt-1 text-sm text-gray-500">Anyone with a link can now view this file.</p> --}}
                            </div>
                            <!-- Botón de cierre -->
                            <div class="ml-4 flex flex-shrink-0">
                                <button @click="$store.notification.toggle()" type="button"
                                    class="inline-flex rounded-md bg-gradient-to-t from-gray-700 to-gray-800 text-gray-200 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                    <span class="sr-only">Close</span>
                                    <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path
                                            d="M6.28 5.22a.75.75 0 00-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 101.06 1.06L10 11.06l3.72 3.72a.75.75 0 101.06-1.06L11.06 10l3.72-3.72a.75.75 0 00-1.06-1.06L10 8.94 6.28 5.22z" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @livewireScripts

        <!-- Main content -->
        <main class="flex-grow bg-gray-50">
            {{ $slot }}
        </main>

        <!-- Footer -->
        <footer class="bg-gray-800 text-white text-center py-4">
            <p>© 2024 {{ config('app.name') }}. Todos los derechos reservados.</p>
        </footer>


</body>

</html>
