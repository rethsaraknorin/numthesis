<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Applicant Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Welcome Banner --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-2xl font-bold">Welcome, {{ Auth::user()->name }}!</h3>
                    <p class="mt-1 text-gray-600 dark:text-gray-400">Your journey into the world of technology starts here. Explore our programs and find your passion.</p>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                {{-- Main Content Column --}}
                <div class="lg:col-span-2 space-y-6">
                    
                    {{-- My Saved Books Section --}}
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            <h4 class="text-xl font-semibold mb-4">My Saved Books</h4>
                            @if($savedBooks->isNotEmpty())
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    @foreach ($savedBooks as $book)
                                        <div class="flex items-start space-x-4 bg-gray-50 dark:bg-gray-700/50 p-4 rounded-lg">
                                            <img src="{{ $book->picture ? asset('storage/' . $book->picture) : 'https://placehold.co/200x200/4A5568/E2E8F0?text=Book' }}" alt="Cover of {{ $book->title }}" class="w-16 h-20 object-cover rounded flex-shrink-0 shadow-md">
                                            <div class="flex-grow">
                                                <h5 class="font-bold text-gray-800 dark:text-gray-200">{{ $book->title }}</h5>
                                                <p class="text-sm text-gray-600 dark:text-gray-400">by {{ $book->author }}</p>
                                                <div class="mt-2 flex space-x-3">
                                                     @if($book->book_link)
                                                        <a href="{{ $book->book_link }}" target="_blank" class="text-sm text-indigo-600 dark:text-indigo-400 hover:underline">Read Now</a>
                                                     @endif
                                                     <form action="{{ route('library.unsave', $book) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="text-sm text-red-600 dark:text-red-400 hover:underline">Unsave</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="mt-6">
                                    <a href="{{ route('library.index') }}" class="font-semibold text-indigo-600 dark:text-indigo-400 hover:underline">
                                        Explore More in the Library &rarr;
                                    </a>
                                </div>
                            @else
                                <p class="text-gray-500 dark:text-gray-400">You haven't saved any books yet. <a href="{{ route('library.index') }}" class="text-indigo-600 dark:text-indigo-400 hover:underline">Explore the Library</a> to get started.</p>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Sidebar Column --}}
                <div class="lg:col-span-1 space-y-6">
                    {{-- Explore Programs Card --}}
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h4 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-2">Find Your Future</h4>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">View the full 4-year curriculum for all our IT programs to find the perfect fit for you.</p>
                             <a href="{{ route('programs.index') }}" class="block w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-4 rounded-lg text-center transition duration-300">
                                Explore Academic Programs
                            </a>
                        </div>
                    </div>

                    {{-- Upcoming Events Card --}}
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                         <div class="p-6">
                            <h4 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Upcoming Events</h4>
                            <ul class="space-y-3">
                                <li class="text-sm text-gray-700 dark:text-gray-300"><span class="font-bold text-gray-800 dark:text-gray-100">July 15:</span> Virtual Open House</li>
                                <li class="text-sm text-gray-700 dark:text-gray-300"><span class="font-bold text-gray-800 dark:text-gray-100">Aug 01:</span> Application Deadline</li>
                                <li class="text-sm text-gray-700 dark:text-gray-300"><span class="font-bold text-gray-800 dark:text-gray-100">Aug 10:</span> Scholarship Info Session</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
