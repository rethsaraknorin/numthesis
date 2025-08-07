<!DOCTYPE html>
<html lang="en" x-data="{ 'dark': $store.theme.isDarkMode, 'loginModalOpen': false }" :class="{ 'dark': isDarkMode }">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('Digital Library') }} - National University of Management</title>
    
    <link rel="icon" href="{{ asset('assets/logo/num-logo.png') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    
    <style>
        .hero-bg-library {
            background: linear-gradient(rgba(17, 24, 39, 0.8), rgba(17, 24, 39, 0.8)), url('https://numer.digital/public/faculties/MainSlide/num_front.jpg');
            background-size: cover;
            background-position: center;
        }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-gray-100 dark:bg-gray-900">
    <div class="absolute top-0 left-0 w-full z-10">
        <x-navbar />
    </div>

    <main>
        <header class="hero-bg-library h-96 flex items-center justify-center text-white">
            <div class="text-center px-4">
                <h1 class="text-5xl font-bold">{{ __('Digital Library') }}</h1>
                <p class="mt-4 text-xl text-gray-300">{{ __('library_subtitle') }}</p>
            </div>
        </header>

        <section class="py-20 bg-white dark:bg-gray-800">
            <div class="container mx-auto px-6 lg:px-8">

                <div class="mb-16 p-6 bg-white dark:bg-gray-800/50 border border-gray-200 dark:border-gray-700 rounded-xl shadow-lg">
                    <form action="{{ route('page.library') }}" method="GET">
                        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6 items-end">
                            <div class="md:col-span-2 lg:col-span-3">
                                <label for="search" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Search by Title or Author') }}</label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" /></svg>
                                    </div>
                                    <input type="text" name="search" id="search" class="block w-full pl-10 sm:text-sm border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 focus:ring-indigo-500 focus:border-indigo-500 rounded-md" placeholder="e.g. Laravel, Final Thesis, etc." value="{{ request('search') }}">
                                </div>
                            </div>
                            <div>
                                <label for="type" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Filter by Type') }}</label>
                                <select id="type" name="type" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md" onchange="this.form.submit()">
                                    <option value="">{{ __('All Types') }}</option>
                                    @foreach($bookTypes as $type)
                                        <option value="{{ $type }}" @selected(request('type') == $type)>{{ $type }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="space-y-16">
                    @forelse ($groupedBooks as $type => $books)
                        <div>
                            <div class="flex items-center mb-6">
                                <h2 class="text-3xl font-bold text-gray-900 dark:text-white">{{ $type }}</h2>
                                <div class="flex-grow h-px bg-gray-300 dark:bg-gray-700 ml-4"></div>
                            </div>
                            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-6 gap-8">
                                @foreach ($books as $book)
                                    <button @click="loginModalOpen = true" class="text-left bg-white dark:bg-gray-800/50 rounded-lg shadow-md overflow-hidden flex flex-col group transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                                        <div class="relative">
                                            <img class="aspect-[4/5] w-full object-cover" src="{{ $book->picture ? asset('storage/' . $book->picture) : 'https://placehold.co/400x500/4A5568/E2E8F0?text=No+Image' }}" alt="Cover of {{ $book->title }}">
                                            <div class="absolute inset-0 bg-black/10 group-hover:bg-black/20 transition-colors"></div>
                                        </div>
                                        <div class="p-4 flex flex-col flex-grow">
                                            <h4 class="text-md font-bold text-gray-900 dark:text-gray-100 truncate" title="{{ $book->title }}">{{ $book->title }}</h4>
                                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">{{ __('by') }} {{ $book->author }}</p>
                                        </div>
                                    </button>
                                @endforeach
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full text-center text-gray-500 dark:text-gray-400 py-10 bg-white dark:bg-gray-800/50 rounded-lg shadow-md">
                            <p class="text-2xl font-semibold">{{ __('no_books_found_public_title') }}</p>
                            <p class="mt-2">{{ __('no_books_found_public_desc') }}</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </section>
        
        <div x-show="loginModalOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-75 p-4" x-cloak>
            <div @click.away="loginModalOpen = false" x-show="loginModalOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="relative bg-white dark:bg-gray-800 rounded-lg shadow-xl overflow-hidden max-w-sm w-full p-8 text-center">
                <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-blue-100 dark:bg-blue-900/50">
                    <svg class="h-6 w-6 text-blue-600 dark:text-blue-300" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" /></svg>
                </div>
                <h3 class="mt-5 text-lg font-semibold leading-6 text-gray-900 dark:text-white">{{ __('login_to_read_title') }}</h3>
                <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">{{ __('login_to_read_desc') }}</p>
                <div class="mt-6 flex flex-col sm:flex-row gap-3">
                    <a href="{{ route('login') }}" class="w-full inline-flex justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500">{{ __('go_to_login') }}</a>
                    <a href="{{ route('register') }}" class="w-full inline-flex justify-center rounded-md bg-white dark:bg-gray-700 px-3 py-2 text-sm font-semibold text-gray-900 dark:text-gray-200 shadow-sm ring-1 ring-inset ring-gray-300 dark:ring-gray-600 hover:bg-gray-50 dark:hover:bg-gray-600">{{ __('create_an_account') }}</a>
                </div>
            </div>
        </div>

    </main>

    <x-footer />
</body>
</html>