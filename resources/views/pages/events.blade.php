<!DOCTYPE html>
<html lang="en" x-data :class="{ 'dark': $store.theme.isDarkMode }">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>University Events - National University of Management</title>
    
    <link rel="icon" href="{{ asset('assets/logo/num-logo.png') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    
</head>
<body class="bg-gray-100 dark:bg-gray-900">
    <div class="absolute top-0 left-0 w-full z-10">
        <x-navbar />
    </div>

    <main>
        <header class="bg-gray-800 dark:bg-gray-900/50 pt-32 pb-20 text-white">
            <div class="container mx-auto px-6 lg:px-8 text-center">
                <h1 class="text-4xl md:text-5xl font-bold">University Events & News</h1>
                <p class="mt-4 text-lg text-gray-300 max-w-3xl mx-auto">Stay up-to-date with the latest happenings at NUM.</p>
            </div>
        </header>

        <section class="py-20">
            <div class="container mx-auto px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @forelse ($events as $event)
                        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden transform hover:-translate-y-2 transition-transform duration-300">
                            <img src="{{ $event->image_path ? asset('storage/' . $event->image_path) : 'https://images.unsplash.com/photo-1523050854058-8df90110c9f1?q=80&w=2070&auto=format&fit=crop' }}" 
                                 class="w-full h-56 object-cover" 
                                 alt="{{ $event->title }}">
                            <div class="p-6">
                                <p class="text-sm font-semibold text-cyan-500">{{ \Carbon\Carbon::parse($event->date)->format('M d, Y') }}</p>
                                <h3 class="text-xl font-bold text-gray-900 dark:text-white mt-2">{{ $event->title }}</h3>
                                <p class="text-gray-600 dark:text-gray-400 mt-2 line-clamp-3">{{ $event->description }}</p>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full text-center py-12">
                            <p class="text-lg text-gray-600 dark:text-gray-400">No events have been posted yet. Please check back soon!</p>
                        </div>
                    @endforelse
                </div>

                {{-- Pagination Links --}}
                @if($events->hasPages())
                    <div class="mt-12">
                        {{ $events->links() }}
                    </div>
                @endif
            </div>
        </section>
    </main>

    <x-footer />
</body>
</html>