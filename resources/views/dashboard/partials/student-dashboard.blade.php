{{-- Redesigned Student Dashboard --}}
<div class="space-y-8">
    <div class="bg-gradient-to-r from-indigo-600 via-blue-500 to-cyan-400 rounded-xl shadow-lg p-8 flex flex-col md:flex-row items-center justify-between gap-6">
        <div>
            <h2 class="text-2xl md:text-3xl font-extrabold text-white mb-2">Welcome back, {{ Auth::user()->name }}!</h2>
            <p class="text-indigo-100 text-base md:text-lg">Here's what your day looks like. Let's make it a great one.</p>
        </div>
        <img src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" class="w-24 h-24 md:w-32 md:h-32 rounded-full shadow-lg border-4 border-white object-cover hidden md:block">
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2 space-y-8">
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-6">
                <h4 class="text-sm font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Next Class</h4>
                @if($nextClass)
                    <div class="mt-2 flex flex-col md:flex-row md:items-center md:gap-6">
                        <div class="flex-shrink-0">
                            <p class="text-4xl font-bold text-indigo-600 dark:text-indigo-400">{{ \Carbon\Carbon::parse($nextClass->start_time)->format('h:i A') }}</p>
                        </div>
                        <div>
                            <p class="text-xl font-semibold text-gray-800 dark:text-white mt-1">{{ $nextClass->course->name }}</p>
                            <p class="text-md text-gray-600 dark:text-gray-300">Room: {{ $nextClass->room_number }}</p>
                        </div>
                    </div>
                @else
                    <p class="mt-4 text-gray-500 dark:text-gray-400">No more classes scheduled for today. Enjoy your break!</p>
                @endif
            </div>
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-6">
                <h3 class="text-xl font-bold text-gray-800 dark:text-white mb-4">Today's Schedule ({{ \Carbon\Carbon::now()->format('l') }})</h3>
                @if($dailySchedule->isNotEmpty())
                    <div class="space-y-4">
                        @foreach($dailySchedule as $session)
                            <div class="flex items-center p-4 bg-gray-50 dark:bg-gray-700/50 rounded-lg shadow-sm">
                                <div class="mr-4 text-center w-24">
                                    <p class="text-sm font-bold text-indigo-600 dark:text-indigo-400">{{ \Carbon\Carbon::parse($session->start_time)->format('h:i A') }}</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">to {{ \Carbon\Carbon::parse($session->end_time)->format('h:i A') }}</p>
                                </div>
                                <div class="flex-grow">
                                    <p class="font-semibold text-gray-800 dark:text-gray-200">{{ $session->course->name }}</p>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">Lecturer: {{ $session->lecturer_name }} | Room: {{ $session->room_number }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-500 dark:text-gray-400">No classes scheduled for today.</p>
                @endif
            </div>
        </div>
        <div class="space-y-8">
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-6">
                @include('dashboard.partials.events-list')
            </div>
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-6">
                <h4 class="text-xl font-bold text-gray-800 dark:text-white mb-4">My Saved Books</h4>
                <div class="space-y-4">
                    @forelse($savedBooks as $book)
                        <a href="{{ route('library.index') }}" class="flex items-center space-x-4 group">
                            {{-- FIXED: Changed cover_image_path to picture --}}
                            <img src="{{ $book->picture ? asset('storage/' . $book->picture) : 'https://placehold.co/48x64/E2E8F0/4A5568?text=No+Image' }}" alt="{{ $book->title }}" class="h-16 w-12 object-cover rounded-md shadow-md">
                            <div>
                                <p class="font-semibold text-gray-800 dark:text-gray-300 group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors">{{ $book->title }}</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">by {{ $book->author }}</p>
                            </div>
                        </a>
                    @empty
                        <p class="text-sm text-gray-500 dark:text-gray-400">You haven't saved any books yet. <a href="{{ route('library.index') }}" class="text-indigo-500 hover:underline">Explore the library!</a></p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>