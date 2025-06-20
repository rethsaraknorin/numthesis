<!DOCTYPE html>
<html lang="en" x-data :class="{ 'dark': $store.theme.isDarkMode }">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Academic Programs - National University of Management</title>
    
    <link rel="icon" href="{{ asset('assets/logo/num-logo.png') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    
    <style>
        .hero-bg-programs {
            background: linear-gradient(rgba(17, 24, 39, 0.8), rgba(17, 24, 39, 0.8)), url('https://numer.digital/public/faculties/MainSlide/num_front.jpg');
            background-size: cover;
            background-position: center;
        }
    </style>
</head>
<body class="bg-gray-100 dark:bg-gray-900">
    <div class="absolute top-0 left-0 w-full z-10">
        <x-navbar />
    </div>

    <main>
        <header class="hero-bg-programs h-96 flex items-center justify-center text-white">
            <div class="text-center px-4">
                <h1 class="text-5xl font-bold">Academic Programs</h1>
                <p class="mt-4 text-xl text-gray-300">Discover your future in the world of technology and innovation.</p>
            </div>
        </header>

        <section class="py-20 bg-white dark:bg-gray-800">
            <div class="container mx-auto px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                    @foreach ($programs as $program)
                        <div class="bg-white dark:bg-gray-800/50 border border-transparent dark:border-gray-700/50 rounded-xl shadow-lg flex flex-col transition-shadow duration-300 hover:shadow-2xl">
                            <div class="p-8">
                                <div class="mb-5">
                                    @if($program->code === 'IT')
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-cyan-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/></svg>
                                    @elseif($program->code === 'BIT')
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>
                                    @else
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
                                    @endif
                                </div>
                                <h3 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $program->name }} ({{$program->code}})</h3>
                                <p class="font-normal text-gray-600 dark:text-gray-400 mb-4 h-24">{{ $program->description }}</p>
                            </div>
                            <div class="mt-auto bg-gray-50 dark:bg-gray-900/50 p-6 rounded-b-xl">
                                @if($program->price_per_year)
                                    <div class="text-sm text-gray-800 dark:text-gray-200 mb-4">
                                        <span class="font-semibold">Starting from:</span> 
                                        <span class="text-lg font-bold">${{ number_format($program->price_per_year, 2) }}</span>/year
                                    </div>
                                @endif
                                <a href="{{ route('login') }}" class="inline-flex items-center font-semibold text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-200">
                                    Login to View Curriculum
                                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    </main>

    <x-footer />
</body>
</html>