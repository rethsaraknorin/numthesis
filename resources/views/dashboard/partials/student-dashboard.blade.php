{{-- resources/views/dashboard/partials/student-dashboard.blade.php --}}
{{-- This view is for currently enrolled and approved students. --}}

{{-- Welcome and Next Class Highlight --}}
<div class="mb-6 bg-gradient-to-r from-indigo-600 to-purple-600 text-white p-6 rounded-lg shadow-lg">
    <h2 class="text-2xl font-bold">Good {{ date('H') < 12 ? 'Morning' : (date('H') < 17 ? 'Afternoon' : 'Evening') }}, {{ Auth::user()->name }}!</h2>
    
    @if(isset($nextClass))
        <p class="mt-2 text-indigo-200">Your next class is starting soon:</p>
        <div class="mt-3 bg-white/20 p-4 rounded-lg flex items-center space-x-4">
            <div class="flex-shrink-0">
                <svg class="w-8 h-8 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
            </div>
            <div>
                <p class="text-xl font-bold">{{ $nextClass->course->name }}</p>
                <p class="text-indigo-100">at {{ \Carbon\Carbon::parse($nextClass->start_time)->format('h:i A') }} in Room: {{ $nextClass->room_number ?? 'N/A' }}</p>
            </div>
        </div>
    @else
         <p class="mt-2 text-indigo-200">You have no more classes scheduled for today. Enjoy your day!</p>
    @endif
</div>


<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="lg:col-span-2 space-y-6">
        {{-- Today's Schedule Widget --}}
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <h3 class="text-xl font-semibold mb-4">Today's Schedule ({{ \Carbon\Carbon::now()->format('l, F jS') }})</h3>
                @if(isset($todaysSchedule) && $todaysSchedule->isNotEmpty())
                    <div class="space-y-4">
                        @foreach($todaysSchedule as $session)
                        <div class="bg-indigo-50 dark:bg-gray-800/60 p-4 rounded-lg flex items-start space-x-4">
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
    
    {{-- Right Column Widgets --}}
    <div class="space-y-6">
        {{-- Quick Links Widget --}}
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Quick Links</h3>
                <div class="space-y-3">
                    <a href="{{ route('schedule.my') }}" class="flex items-center w-full p-4 bg-gray-50 dark:bg-gray-700/50 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                        <svg class="w-6 h-6 mr-4 text-indigo-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0h18M-4.5 12h22.5" /></svg>
                        <span class="font-medium text-gray-700 dark:text-gray-200">My Full Schedule</span>
                    </a>
                    <a href="{{ route('library.index') }}" class="flex items-center w-full p-4 bg-gray-50 dark:bg-gray-700/50 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                        <svg class="w-6 h-6 mr-4 text-green-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" /></svg>
                        <span class="font-medium text-gray-700 dark:text-gray-200">Digital Library</span>
                    </a>
                    <a href="{{ route('profile.edit') }}" class="flex items-center w-full p-4 bg-gray-50 dark:bg-gray-700/50 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                         <svg class="w-6 h-6 mr-4 text-yellow-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" /></svg>
                        <span class="font-medium text-gray-700 dark:text-gray-200">My Profile</span>
                    </a>
                </div>
            </div>
        </div>

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
                        <p class="text-sm text-gray-500">No upcoming dates have been posted.</p>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</div>
