<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Applicant Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-2xl font-bold">Welcome, {{ Auth::user()->name }}!</h3>
                    <p class="mt-1 text-gray-600 dark:text-gray-400">Your journey into the world of technology starts here. Explore our programs and find your passion.</p>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                <div class="lg:col-span-2 space-y-6">
                    
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h4 class="text-xl font-semibold text-gray-900 dark:text-gray-100 mb-4">Explore Our IT Faculties</h4>
                            <div class="space-y-6">
                                <div class="flex items-start">
                                    <div class="flex-shrink-0 h-12 w-12 flex items-center justify-center bg-cyan-100 dark:bg-cyan-900 rounded-lg text-cyan-500">
                                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/></svg>
                                    </div>
                                    <div class="ml-4">
                                        <h5 class="font-bold text-gray-800 dark:text-gray-200">Information Technology (IT)</h5>
                                        <p class="text-sm text-gray-600 dark:text-gray-400">Master software development, network systems, and cybersecurity to build the digital world of tomorrow.</p>
                                    </div>
                                </div>
                                <div class="flex items-start">
                                    <div class="flex-shrink-0 h-12 w-12 flex items-center justify-center bg-emerald-100 dark:bg-emerald-900 rounded-lg text-emerald-500">
                                       <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" /></svg>
                                    </div>
                                    <div class="ml-4">
                                        <h5 class="font-bold text-gray-800 dark:text-gray-200">Business Information Technology (BIT)</h5>
                                        <p class="text-sm text-gray-600 dark:text-gray-400">Combine technology with business strategy. Learn to use IT to solve complex business problems and innovate.</p>
                                    </div>
                                </div>
                                <div class="flex items-start">
                                     <div class="flex-shrink-0 h-12 w-12 flex items-center justify-center bg-purple-100 dark:bg-purple-900 rounded-lg text-purple-500">
                                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
                                    </div>
                                    <div class="ml-4">
                                        <h5 class="font-bold text-gray-800 dark:text-gray-200">Robotic Engineering</h5>
                                        <p class="text-sm text-gray-600 dark:text-gray-400">Design and build the future of automation and artificial intelligence with hands-on projects.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-1 space-y-6">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h4 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Application Helper</h4>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">Ready to take the next step? Our chatbot can help answer your questions about the application process.</p>
                             <a href="#" class="block w-full bg-indigo-500 hover:bg-indigo-600 text-white font-bold py-3 px-4 rounded-lg text-center transition duration-300">
                                Start Application
                            </a>
                        </div>
                    </div>
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                         <div class="p-6">
                            <h4 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Upcoming Events</h4>
                            <ul class="space-y-3">
                                <li class="text-sm text-gray-700 dark:text-gray-300"><span class="font-bold">July 15:</span> Virtual Open House</li>
                                <li class="text-sm text-gray-700 dark:text-gray-300"><span class="font-bold">Aug 01:</span> Application Deadline</li>
                                <li class="text-sm text-gray-700 dark:text-gray-300"><span class="font-bold">Aug 10:</span> Scholarship Info Session</li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>

            <div class="mt-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h4 class="text-xl font-semibold mb-4">My Saved Books</h4>

                        @if($savedBooks->isNotEmpty())
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                @foreach ($savedBooks as $book)
                                    <div class="flex items-start space-x-4 bg-gray-50 dark:bg-gray-700/50 p-4 rounded-lg">
                                        <img src="{{ $book->picture ? asset('storage/' . $book->picture) : 'https://placehold.co/200x200/4A5568/E2E8F0?text=Book' }}" alt="Cover of {{ $book->title }}" class="w-16 h-20 object-cover rounded flex-shrink-0">
                                        <div class="flex-grow">
                                            <h5 class="font-bold text-gray-800 dark:text-gray-200">{{ $book->title }}</h5>
                                            <p class="text-sm text-gray-600 dark:text-gray-400">by {{ $book->author }}</p>
                                            <div class="mt-2 flex space-x-2">
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
                        @else
                            <p class="text-gray-500 dark:text-gray-400">You haven't saved any books yet. <a href="{{ route('library.index') }}" class="text-indigo-600 dark:text-indigo-400 hover:underline">Explore the Library</a> to get started.</p>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>