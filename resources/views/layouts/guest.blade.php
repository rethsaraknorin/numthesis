<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="{
    isDarkMode: localStorage.getItem('theme') === 'dark' || 
                (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)
}" x-init="$watch('isDarkMode', val => localStorage.setItem('theme', val ? 'dark' : 'light'))" :class="{ 'dark': isDarkMode }">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>NUM</title>
        <link rel="icon" href="{{ asset('assets/logo/num-logo.png') }}">


        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Kantumruy+Pro:ital,wght@0,100..700;1,100..700&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            .hero-bg {
                background: linear-gradient(rgba(17, 24, 39, 0.7), rgba(17, 24, 39, 0.7)), url('https://numer.digital/public/faculties/MainSlide/num_front.jpg');
                background-size: cover;
                background-position: center;
            }
        </style>
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 hero-bg">
            <div>
                <a href="/" class="flex flex-col items-center">
                    <img src="{{ asset('assets/logo/num-logo.png') }}" class="w-20 h-20" alt="NUM Logo">
                    <span class="mt-4 text-2xl font-semibold text-white">National University of Management</span>
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white/90 dark:bg-gray-800/80 backdrop-blur-sm shadow-2xl overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
