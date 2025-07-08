{{-- Redesigned Normal User Dashboard --}}
<div class="space-y-8">
    <!-- Welcome Banner -->
    <div class="bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 rounded-xl shadow-lg p-8 flex flex-col md:flex-row items-center justify-between gap-6">
        <div>
            <h2 class="text-2xl md:text-3xl font-extrabold text-white mb-2">Welcome to the National University of Management Portal!</h2>
            <p class="text-indigo-100 text-base md:text-lg">Explore our academic programs and latest news. If you are a current student, please verify your status to unlock your personal dashboard, including your class schedule and more.</p>
            <a href="{{ route('profile.edit') }}" class="mt-4 inline-block px-6 py-2 bg-white text-indigo-700 font-semibold rounded-lg shadow hover:bg-indigo-50 transition">Verify Student Status</a>
        </div>
        <img src="/assets/logo/num-logo.png" alt="NUM Logo" class="w-24 h-24 md:w-32 md:h-32 rounded-full shadow-lg border-4 border-white hidden md:block">
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-8">
            <!-- Featured Programs -->
            <div class="bg-white dark:bg-gray-900 rounded-xl shadow p-6">
                <h3 class="text-xl font-bold text-gray-800 dark:text-white mb-4">Featured Programs</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @foreach($featuredPrograms as $program)
                        <a href="{{ route('programs.show', $program) }}" class="block p-5 bg-gray-50 dark:bg-gray-800 rounded-lg shadow hover:shadow-lg hover:bg-indigo-50 dark:hover:bg-indigo-900 transition group">
                            <h4 class="font-bold text-gray-800 dark:text-gray-200 group-hover:text-indigo-600 dark:group-hover:text-indigo-400">{{ $program->name }}</h4>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1 line-clamp-2">{{ $program->description }}</p>
                        </a>
                    @endforeach
                </div>
            </div>
            <!-- From Our Library -->
            <div class="bg-white dark:bg-gray-900 rounded-xl shadow p-6">
                <h4 class="text-xl font-bold text-gray-800 dark:text-white mb-4">From Our Library</h4>
                <div class="space-y-4">
                    @forelse($featuredBooks as $book)
                        <div class="flex items-center space-x-4">
                            <img src="{{ asset('storage/' . $book->cover_image_path) }}" alt="{{ $book->title }}" class="h-16 w-12 object-cover rounded-md shadow-md">
                            <div>
                                <p class="font-semibold text-gray-800 dark:text-gray-300">{{ $book->title }}</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">by {{ $book->author }}</p>
                            </div>
                        </div>
                    @empty
                        <p class="text-sm text-gray-500 dark:text-gray-400">No books to display.</p>
                    @endforelse
                </div>
            </div>
        </div>
        <!-- Sidebar -->
        <div class="space-y-8">
            <!-- Latest Events -->
            <div class="bg-white dark:bg-gray-900 rounded-xl shadow p-6">
                @include('dashboard.partials.events-list')
            </div>
        </div>
    </div>
</div>
