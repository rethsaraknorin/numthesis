<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $program->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            {{-- Program Details Header --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-6 md:p-8">
                    <div class="flex items-center mb-4">
                        <div class="p-3 rounded-full text-white bg-indigo-500 mr-4">
                            @if($program->code === 'IT')
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/></svg>
                            @elseif($program->code === 'BIT')
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" /></svg>
                            @elseif($program->code === 'CS')
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 18v2H8v-2m4-14v14m-4-10h8m-8 4h8m-8 4h8"/></svg>
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
                            @endif
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $program->name }} ({{ $program->code }})</h3>
                            <p class="mt-1 text-gray-600 dark:text-gray-400">{{ $program->description }}</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Curriculum Viewer (for All Users) --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h4 class="text-xl font-semibold mb-4">4-Year Curriculum</h4>
                    <div x-data="{ openYear: 1 }" class="space-y-2">
                        @forelse($coursesByYearAndSemester->sortKeys() as $year => $semesters)
                            <div class="border border-gray-200 dark:border-gray-700 rounded-lg">
                                <button @click="openYear = openYear === {{ $year }} ? null : {{ $year }}" class="w-full flex justify-between items-center p-4 text-left font-semibold text-gray-800 dark:text-gray-200">
                                    <span>Year {{ $year }}</span>
                                    <svg class="w-5 h-5 transition-transform" :class="{'rotate-180': openYear === {{ $year }}}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                </button>
                                <div x-show="openYear === {{ $year }}" x-transition class="p-4 border-t border-gray-200 dark:border-gray-700 grid md:grid-cols-2 gap-6">
                                    @foreach($semesters->sortKeys() as $semester => $courses)
                                        <div>
                                            <h6 class="font-bold text-gray-600 dark:text-gray-300">Semester {{ $semester }}</h6>
                                            <ul class="mt-2 space-y-2">
                                                @foreach($courses as $course)
                                                    <li class="flex items-start p-3 bg-gray-50 dark:bg-gray-900/50 rounded-md">
                                                        <svg class="w-5 h-5 text-indigo-500 mr-3 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                        <div>
                                                           <p class="font-semibold text-gray-800 dark:text-gray-200">{{ $course->name }}</p>
                                                           <p class="text-sm text-gray-500 dark:text-gray-400">{{ $course->description ?? 'No description available.' }}</p>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @empty
                             <p class="text-gray-500 dark:text-gray-400">No curriculum has been added for this program yet.</p>
                        @endforelse
                    </div>
                </div>
            </div>

            <div class="mt-6">
                <a href="{{ route('programs.index') }}" class="inline-flex items-center text-indigo-600 dark:text-indigo-400 hover:underline">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Back to All Programs
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
