<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div>
            @include('layouts.admin.navigation')
        </div>

        <div class="min-h-screen bg-gray-100">
            <div class="flex">
                <!-- Page Sidebar -->
                <div class="flex flex-col w-96 h-full">
                    @include('layouts.admin.sidebar')
                </div>

                <!-- Page Content -->
                <main class="flex flex-col w-full h-full">
                    @include('layouts.admin.session')
                    @include('layouts.admin.errors')

                    {{ $slot }}
                </main>
            </div>
        </div>
    </body>
</html>
