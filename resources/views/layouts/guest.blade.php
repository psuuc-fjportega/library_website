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

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center px-4 py-10 bg-gradient-to-br from-indigo-50 via-white to-white dark:from-gray-950 dark:via-gray-900 dark:to-gray-900">
            <div class="w-full sm:max-w-md">
                <div class="flex items-center justify-center gap-3">
                    <a href="/" wire:navigate class="flex items-center gap-3">
                        <x-application-logo class="w-12 h-12 fill-current text-indigo-600 dark:text-indigo-400" />
                        <span class="text-xl font-bold text-gray-900 dark:text-white">Library</span>
                    </a>
                </div>

                <div class="mt-8 px-6 py-6 bg-white/90 dark:bg-gray-800/90 backdrop-blur border border-gray-200/70 dark:border-gray-700/70 shadow-lg overflow-hidden sm:rounded-2xl">
                    {{ $slot }}
                </div>

                <p class="mt-6 text-center text-xs text-gray-500 dark:text-gray-400">
                    {{ config('app.name') }}
                </p>
            </div>
        </div>
    </body>
</html>
