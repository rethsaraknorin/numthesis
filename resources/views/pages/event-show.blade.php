<!DOCTYPE html>
<html lang="en" x-data :class="{ 'dark': $store.theme.isDarkMode }">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $event->title }} - NUM</title>
    
    <link rel="icon" href="{{ asset('assets/logo/num-logo.png') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    
</head>
<body class="bg-gray-50 dark:bg-gray-800">
    <div class="fixed top-0 left-0 w-full z-10 bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm shadow-sm">
        <x-navbar />
    </div>

    <main class="pt-24">
        {{-- UPDATED: Redesigned Content Section to match the new style --}}
        <section class="py-12 md:py-20">
            <div class="container mx-auto px-6 lg:px-8 max-w-4xl">
                
                <h2 class="text-3xl font-bold text-gray-800 dark:text-gray-200 uppercase tracking-wider mb-8">News & Events</h2>

                <div class="bg-white dark:bg-gray-800/50 rounded-lg p-8 shadow-md">
                    <h1 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white leading-tight">
                        {{ $event->title }}
                    </h1>
                    
                    <div class="flex items-center space-x-6 text-sm text-gray-500 dark:text-gray-400 my-4 pb-4 border-b border-gray-200 dark:border-gray-700">
                        <div class="flex items-center space-x-2">
                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" /></svg>
                            <span>{{ \Carbon\Carbon::parse($event->date)->format('F j, Y') }}</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" /></svg>
                            <span>By {{ $event->user->name ?? 'Admin' }}</span>
                        </div>
                    </div>

                    <div class="prose prose-lg dark:prose-invert max-w-none text-gray-800 dark:text-gray-200">
                        {{-- Display the event image within the content if it exists --}}
                        @if($event->image_path)
                            <img src="{{ asset('storage/' . $event->image_path) }}" class="rounded-lg shadow-md mb-8" alt="{{ $event->title }}">
                        @endif
                        <p>{{ $event->description }}</p>
                    </div>
                </div>

                 <div class="mt-12 text-center">
                    <a href="{{ route('welcome') }}#events" class="text-indigo-600 dark:text-indigo-400 hover:underline">&larr; Back to Homepage</a>
                </div>
            </div>
        </section>
    </main>

    <x-footer />
</body>
</html>