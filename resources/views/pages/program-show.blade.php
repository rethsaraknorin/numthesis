<!DOCTYPE html>
<html lang="en" x-data :class="{ 'dark': $store.theme.isDarkMode }">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $program->name }} - Curriculum</title>
    
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
                <h1 class="text-4xl md:text-5xl font-bold">{{ $program->name }} ({{$program->code}})</h1>
                <p class="mt-4 text-lg text-gray-300 max-w-3xl mx-auto">{{ $program->description }}</p>
            </div>
        </header>

        <section class="py-20">
            <div class="container mx-auto px-6 lg:px-8">
                {{-- UPDATED: Changed from space-y-12 to a two-column grid --}}
                <div class="max-w-6xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-8">
                    @forelse($coursesByYearAndSemester->sortKeys() as $year => $yearCourses)
                        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden flex flex-col">
                            <div class="p-6 flex-grow">
                                <h2 class="text-2xl font-bold text-gray-800 dark:text-white border-b border-gray-200 dark:border-gray-700 pb-4 mb-6">Year {{ $year }}</h2>
                                <div class="space-y-6">
                                    @foreach($yearCourses->sortKeys() as $semester => $semesterCourses)
                                        <div>
                                            <h3 class="text-xl font-semibold text-gray-700 dark:text-gray-300 mb-4">Semester {{ $semester }}</h3>
                                            <ul class="space-y-3">
                                                @foreach($semesterCourses as $course)
                                                    <li class="flex items-start">
                                                        <div class="flex-shrink-0 pt-1">
                                                            <svg class="w-4 h-4 text-cyan-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                                            </svg>
                                                        </div>
                                                        <div class="ml-3">
                                                            <p class="font-medium text-gray-800 dark:text-gray-200">{{ $course->name }}</p>
                                                            <p class="text-sm text-gray-500 dark:text-gray-400">{{ $course->credits }} Credits / {{ $course->hours }} Hours</p>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="bg-white dark:bg-gray-800 text-center text-gray-500 col-span-full py-10 rounded-xl shadow-lg">
                            <p class="text-lg font-semibold">No Curriculum Available</p>
                            <p class="mt-1">The curriculum for this program has not been defined yet. Please check back later.</p>
                        </div>
                    @endforelse
                </div>

                <div class="mt-12 text-center">
                    <a href="{{ route('page.programs') }}" class="text-indigo-600 dark:text-indigo-400 hover:underline">&larr; Back to Academic Programs</a>
                </div>
            </div>
        </section>
    </main>

    <x-footer />
</body>
</html>