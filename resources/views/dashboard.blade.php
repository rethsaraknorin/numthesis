<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Conditionally include the correct dashboard partial based on user status --}}
            @if (isset($is_current_student) && $is_current_student)
                @include('dashboard.partials.student-dashboard')
            @else
                @include('dashboard.partials.normal-dashboard')
            @endif

            {{-- Saved Books Section (This is common to all authenticated users) --}}
            <div class="mt-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white">My Saved Books</h3>
                        @if(isset($savedBooks) && $savedBooks->isNotEmpty())
                            <div class="mt-4 grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-6">
                                @foreach($savedBooks as $book)
                                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden flex flex-col group transition-all duration-300 hover:shadow-xl hover:-translate-y-2">
                                    <div class="relative">
                                        <img class="aspect-[4/5] w-full object-cover" src="{{ $book->picture ? asset('storage/' . $book->picture) : 'https://placehold.co/400x500/4A5568/E2E8F0?text=No+Image' }}" alt="Cover of {{ $book->title }}">
                                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                                    </div>
                                    <div class="p-4 flex flex-col flex-grow">
                                        <h4 class="text-md font-bold text-gray-900 dark:text-gray-100 truncate" title="{{ $book->title }}">{{ $book->title }}</h4>
                                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">by {{ $book->author }}</p>
                                        <div class="mt-auto pt-4">
                                            <form action="{{ route('library.unsave', $book) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="w-full text-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition">
                                                    {{ __('Unsave') }}
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        @else
                            <p class="mt-4 text-gray-500 dark:text-gray-400">You haven't saved any books yet. <a href="{{ route('library.index') }}" class="text-indigo-600 hover:underline">Explore the library</a> to find some!</p>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
