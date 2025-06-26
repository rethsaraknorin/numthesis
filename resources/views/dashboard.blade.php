<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- This is the main conditional block that makes the dashboard "smart" --}}
            @if (isset($is_current_student) && $is_current_student)

                {{-- ################################################# --}}
                {{-- ##      CONTENT FOR CURRENT, APPROVED STUDENTS     ## --}}
                {{-- ################################################# --}}
                
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <div class="lg:col-span-3 space-y-6">
                        {{-- Today's Schedule Widget --}}
                        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6 text-gray-900 dark:text-gray-100">
                                <h3 class="text-xl font-semibold mb-4">Today's Schedule ({{ \Carbon\Carbon::now()->format('l, F jS') }})</h3>
                                @if(isset($todaysSchedule) && $todaysSchedule->isNotEmpty())
                                    <div class="space-y-4">
                                        @foreach($todaysSchedule as $session)
                                        <div class="bg-indigo-50 dark:bg-indigo-900/50 p-4 rounded-lg flex items-start space-x-4">
                                            <div class="text-center flex-shrink-0 w-24">
                                                <p class="text-sm font-bold text-indigo-700 dark:text-indigo-300">{{ \Carbon\Carbon::parse($session->start_time)->format('h:i A') }}</p>
                                                <p class="text-xs text-gray-500 dark:text-gray-400">to</p>
                                                <p class="text-sm font-bold text-indigo-700 dark:text-indigo-300">{{ \Carbon\Carbon::parse($session->end_time)->format('h:i A') }}</p>
                                            </div>
                                            <div class="border-l border-indigo-200 dark:border-indigo-700 pl-4 flex-grow">
                                                <p class="font-bold text-gray-800 dark:text-gray-200">{{ $session->course->name }}</p>
                                                <p class="text-sm text-gray-600 dark:text-gray-400">Lecturer: {{ $session->lecturer_name }}</p>
                                                <p class="text-sm text-gray-600 dark:text-gray-400">Room: {{ $session->room_number ?? 'N/A' }}</p>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                @else
                                    <p class="text-gray-500 dark:text-gray-400">You have no classes scheduled for today.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

            @else

                {{-- ########################################################### --}}
                {{-- ##      CONTENT FOR PROSPECTIVE / UNAPPROVED STUDENTS     ## --}}
                {{-- ########################################################### --}}
                
                <div class="space-y-8">
                    {{-- Verification Notice --}}
                    @if(Auth::user()->student_id)
                        <div class="bg-blue-100 border-l-4 border-blue-500 text-blue-800 p-4 dark:bg-blue-900/50 dark:border-blue-500 dark:text-blue-200" role="alert">
                            <p class="font-bold">Verification Pending</p>
                            <p>Your Student ID has been submitted and is awaiting admin approval. Please check back later.</p>
                        </div>
                    @else
                        <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 dark:bg-yellow-900/50 dark:border-yellow-500">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M8.257 3.099c.636-1.21 2.862-1.21 3.5 0l5.485 10.477c.61 1.166-.35 2.673-1.75 2.673H4.512c-1.4 0-2.36-1.507-1.75-2.673L8.257 3.099zM9 13a1 1 0 112 0 1 1 0 01-2 0zm1-3a1 1 0 00-1 1v1a1 1 0 102 0v-1a1 1 0 00-1-1z" clip-rule="evenodd" /></svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm text-yellow-700 dark:text-yellow-200">
                                        Are you a current student? 
                                        <a href="{{ route('profile.edit') }}" class="font-medium underline text-yellow-700 hover:text-yellow-600 dark:text-yellow-200 dark:hover:text-yellow-100">
                                            Submit your Student ID on your profile page
                                        </a>
                                        to get access to your personal class schedule.
                                    </p>
                                </div>
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
                                    <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                                        @foreach($programs as $program)
                                            <a href="{{ route('programs.show', $program) }}" class="block p-4 bg-gray-50 dark:bg-gray-700/50 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                                                <h4 class="font-semibold text-indigo-600 dark:text-indigo-400">{{ $program->name }}</h4>
                                                <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">{{ $program->description }}</p>
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            {{-- Library Preview --}}
                            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                                <div class="p-6">
                                    <h3 class="text-xl font-bold text-gray-900 dark:text-white">Glimpse Into Our Library</h3>
                                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Includes senior theses, research papers, and more. Full access available to verified students.</p>
                                    <div class="mt-4 grid grid-cols-2 md:grid-cols-4 gap-4">
                                        @foreach($featuredBooks as $book)
                                            <div>
                                                <div class="aspect-[2/3] w-full bg-gray-100 dark:bg-gray-700 rounded shadow-md overflow-hidden">
                                                    <img src="{{ $book->picture ? asset('storage/' . $book->picture) : 'https://placehold.co/200x300/4A5568/E2E8F0?text=Book' }}" alt="Cover of {{ $book->title }}" class="w-full h-full object-cover">
                                                </div>
                                                <p class="text-xs text-center mt-1 text-gray-500 dark:text-gray-400 truncate">{{ $book->title }}</p>
                                            </div>
                                        @endforeach
                                    </div>
                                     <a href="{{ route('library.index') }}" class="inline-block mt-4 text-sm font-semibold text-indigo-600 dark:text-indigo-400 hover:underline">Browse all items &rarr;</a>
                                </div>
                            </div>
                        </div>
                        {{-- Right Column: Key Dates and Chat --}}
                        <div class="space-y-8">
                            {{-- Key Dates --}}
                            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                                <div class="p-6">
                                    <h3 class="text-xl font-bold text-gray-900 dark:text-white">Key Dates & Deadlines</h3>
                                    <ul class="mt-4 space-y-3">
                                        @forelse($keyDates as $keyDate)
                                            <li>
                                                <p class="font-semibold text-gray-700 dark:text-gray-300">{{ $keyDate->title }}</p>
                                                <p class="text-sm text-indigo-600 dark:text-indigo-400">{{ $keyDate->date->format('F j, Y') }}</p>
                                            </li>
                                        @empty
                                            <p class="text-sm text-gray-500">No upcoming dates have been posted.</p>
                                        @endforelse
                                    </ul>
                                </div>
                            </div>
                            {{-- Chatbot --}}
                            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                                <div class="p-6 text-center">
                                    <h3 class="text-xl font-bold text-gray-900 dark:text-white">Have Questions?</h3>
                                    <p class="text-sm mt-2 text-gray-600 dark:text-gray-400">Our AI assistant can help with questions about enrollment, courses, and fees.</p>
                                    <a href="#" class="inline-block mt-4 px-6 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 dark:bg-gray-700 dark:hover:bg-gray-600 dark:text-white font-bold rounded-lg transition duration-300">
                                        Chat Now (Coming Soon)
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>