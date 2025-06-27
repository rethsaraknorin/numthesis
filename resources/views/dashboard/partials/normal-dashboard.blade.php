{{-- resources/views/dashboard/partials/normal-dashboard.blade.php --}}
{{-- This is the redesigned view for prospective students or users pending verification. --}}

<div class="space-y-8">
    
    {{-- Welcome Message & Verification Call to Action --}}
    @if(Auth::user()->student_id)
        {{-- Message for users who have submitted their ID and are waiting --}}
        <div class="bg-blue-100 border-l-4 border-blue-500 text-blue-800 p-6 rounded-lg dark:bg-blue-900/50 dark:border-blue-500 dark:text-blue-200" role="alert">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" /></svg>
                </div>
                <div class="ml-4">
                    <h3 class="text-lg font-bold">Verification Pending</h3>
                    <p class="mt-1">Your Student ID has been submitted and is awaiting admin approval. You'll get access to your personal schedule once approved. Thanks for your patience!</p>
                </div>
            </div>
        </div>
    @else
        {{-- Call to action for users who have NOT submitted an ID --}}
         <div class="bg-gradient-to-r from-yellow-500 to-orange-500 dark:from-indigo-700 dark:to-purple-700 text-white p-6 rounded-lg shadow-lg">
            <h2 class="text-2xl font-bold">Welcome, {{ Auth::user()->name }}!</h2>
            <p class="mt-2 text-yellow-100 dark:text-indigo-200">Are you a current NUM student? Unlock your full potential.</p>
            <div class="mt-4">
                 <a href="{{ route('profile.edit') }}" class="inline-block bg-white text-yellow-800 dark:bg-white/90 dark:text-indigo-900 font-bold py-2 px-5 rounded-lg hover:bg-yellow-50 dark:hover:bg-white transition-transform transform hover:scale-105 duration-300">
                    Submit Your Student ID Now
                </a>
            </div>
        </div>
    @endif


    {{-- Main Content Grid --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        {{-- Left Column: Programs and Library --}}
        <div class="lg:col-span-2 space-y-8">
            {{-- Featured Programs --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white">Explore Our Programs</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Find the degree that will launch your career in tech.</p>
                    <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach($programs as $program)
                            <a href="{{ route('programs.show', $program) }}" class="block p-4 bg-gray-50 dark:bg-gray-700/50 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition group">
                                <h4 class="font-semibold text-indigo-600 dark:text-indigo-400 group-hover:underline">{{ $program->name }}</h4>
                                <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">{{ $program->description }}</p>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
            
            {{-- Featured Books --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white">Featured from the Library</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Check out some of our most popular resources.</p>
                    <div class="mt-4 grid grid-cols-2 md:grid-cols-4 gap-4">
                        @foreach($featuredBooks as $book)
                            <a href="{{ route('library.index') }}" class="block group">
                                <div class="aspect-[2/3] w-full bg-gray-100 dark:bg-gray-700 rounded-lg shadow-md overflow-hidden transform transition-transform duration-300 group-hover:-translate-y-1 group-hover:shadow-xl">
                                    <img src="{{ $book->picture ? asset('storage/' . $book->picture) : 'https://placehold.co/200x300/4A5568/E2E8F0?text=Book' }}" alt="Cover of {{ $book->title }}" class="w-full h-full object-cover">
                                </div>
                                <p class="text-xs text-center mt-2 font-semibold text-gray-600 dark:text-gray-400 truncate group-hover:underline" title="{{ $book->title }}">{{ $book->title }}</p>
                            </a>
                        @endforeach
                    </div>
                     <a href="{{ route('library.index') }}" class="inline-block mt-4 text-sm font-semibold text-indigo-600 dark:text-indigo-400 hover:underline">Browse the full library &rarr;</a>
                </div>
            </div>
        </div>

        {{-- Right Column: Key Dates and Chat --}}
        <div class="space-y-8">
            {{-- Key Dates Widget --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white">Key Dates & Deadlines</h3>
                    <ul class="mt-4 space-y-4">
                        @forelse($keyDates as $keyDate)
                            <li class="flex items-start">
                                <svg class="w-5 h-5 mr-3 mt-1 text-indigo-500 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0h18M-4.5 12h22.5" /></svg>
                                <div>
                                    <p class="font-semibold text-gray-700 dark:text-gray-300">{{ $keyDate->title }}</p>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">{{ $keyDate->date->format('F j, Y') }}</p>
                                </div>
                            </li>
                        @empty
                            <p class="text-sm text-gray-500 dark:text-gray-400">No upcoming key dates have been posted.</p>
                        @endforelse
                    </ul>
                </div>
            </div>
            
            {{-- Chatbot --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-center">
                    <div class="mx-auto bg-gray-100 dark:bg-gray-700 rounded-full h-16 w-16 flex items-center justify-center">
                        <svg class="w-8 h-8 text-gray-600 dark:text-gray-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M8.625 12a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H8.25m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H12m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 01-2.555-.337A5.972 5.972 0 015.41 20.97a5.969 5.969 0 01-.474-.065 4.48 4.48 0 00.978-2.025c.09-.457-.133-.901-.467-1.226C3.93 16.178 3 14.189 3 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25z" /></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mt-4">Have Questions?</h3>
                    <p class="text-sm mt-2 text-gray-600 dark:text-gray-400">Our AI assistant can help with questions about enrollment, courses, and fees.</p>
                    <a href="#" class="inline-block mt-4 px-6 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 dark:bg-gray-700 dark:hover:bg-gray-600 dark:text-white font-bold rounded-lg transition duration-300">
                        Chat Now (Coming Soon)
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
