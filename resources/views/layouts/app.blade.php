<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
    </head>
    <body class="font-sans antialiased">
        <x-jet-banner />

        <body class="font-sans antialiased">
            <div x-data="{ sidebarOpen: false }" class="flex h-screen bg-gray-200 font-roboto">
                {{-- @livewire('navigation-menu') --}}
                <x-asidebar />
    
                <!-- Page Heading -->
                <div class="flex-1 flex flex-col overflow-hidden">
                    <x-headers />
                    <header class="bg-white shadow">
                        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                            {{ $header }}
                        </div>
                    </header>
                    <x-notification />
                    <!-- Page Content -->
                    <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
                        <div class="container mx-auto px-6 py-8">
                            {{ $slot }}
                        </div>
                        <footer class="pt-4">
                            <div class="flex justify-center">
                                <div class="text-center">
                                    <p class="text-sm text-gray-600">© <script>
                                        document.write(new Date().getFullYear() + ",");
                                    </script> - {{ config('app.name', 'Laravel') }} -
                                        All rights reserved.</p>
                                </div>
                            </div>
                        </footer>
                    </main>
                </div>
            </div>

        @stack('modals')

        @livewireScripts
    </body>
</html>
