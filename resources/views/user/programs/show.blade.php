<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $program->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            {{-- Program Details --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-6 md:p-8">
                    <div class="flex items-center mb-4">
                        <div class="p-3 rounded-full text-white bg-indigo-500 mr-4">
                             @if($program->code === 'IT')
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/></svg>
                            @elseif($program->code === 'BIT')
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" /></svg>
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

            {{-- Tab Navigation --}}
             <div x-data="{ activeTab: 'schedule' }" class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="border-b border-gray-200 dark:border-gray-700">
                    <nav class="flex space-x-4 p-4" aria-label="Tabs">
                        <button @click="activeTab = 'schedule'" :class="{'bg-indigo-100 dark:bg-indigo-900/50 text-indigo-700 dark:text-indigo-300': activeTab === 'schedule', 'text-gray-500 dark:text-gray-400 hover:text-gray-700': activeTab !== 'schedule'}" class="px-3 py-2 font-medium text-sm rounded-md">
                            Class Schedule
                        </button>
                        <button @click="activeTab = 'curriculum'" :class="{'bg-indigo-100 dark:bg-indigo-900/50 text-indigo-700 dark:text-indigo-300': activeTab === 'curriculum', 'text-gray-500 dark:text-gray-400 hover:text-gray-700': activeTab !== 'curriculum'}" class="px-3 py-2 font-medium text-sm rounded-md">
                            4-Year Curriculum
                        </button>
                    </nav>
                </div>

                {{-- Schedule Viewer --}}
                <div x-show="activeTab === 'schedule'" class="p-6 text-gray-900 dark:text-gray-100" x-data="scheduleViewer({ schedules: {{ json_encode($schedules) }}, promotions: {{ json_encode($promotions) }} })">
                    <h4 class="text-xl font-semibold mb-4">Weekly Class Schedule</h4>
                    
                    @if($promotions->isNotEmpty())
                        {{-- Filters --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6 p-4 bg-gray-50 dark:bg-gray-700/50 rounded-lg">
                            <div>
                                <label for="promotion_filter" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Filter by Promotion</label>
                                <select x-model="selectedPromotion" @change="updateGroups" id="promotion_filter" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm">
                                    <template x-for="promotion in promotions" :key="promotion">
                                        <option :value="promotion" x-text="promotion"></option>
                                    </template>
                                </select>
                            </div>
                            <div>
                                <label for="group_filter" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Filter by Group</label>
                                <select x-model="selectedGroup" id="group_filter" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm">
                                     <template x-for="group in availableGroups" :key="group">
                                        <option :value="group" x-text="group"></option>
                                    </template>
                                </select>
                            </div>
                        </div>

                        {{-- Timetable --}}
                        <div class="overflow-x-auto">
                           <table class="w-full min-w-max border-collapse text-left">
                                <thead>
                                    <tr>
                                        <th class="border-b-2 dark:border-gray-700 p-4 w-1/5">Shift</th>
                                        @foreach($days as $dayName)
                                            <th class="border-b-2 dark:border-gray-700 p-4 text-center">{{ $dayName }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($shifts as $shiftName)
                                    <tr class="border-b dark:border-gray-700">
                                        <td class="p-4 font-bold align-top">{{ $shiftName }}</td>
                                        @foreach($days as $dayName)
                                            <td class="p-2 align-top">
                                                <div class="space-y-2">
                                                    <template x-for="session in filteredSchedule(dayName, shiftName)" :key="session.id">
                                                        <div class="bg-gray-100 dark:bg-gray-900/50 p-3 rounded-lg text-sm">
                                                            <p class="font-bold text-gray-800 dark:text-gray-200" x-text="session.course.name"></p>
                                                            <p class="text-xs text-gray-600 dark:text-gray-400" x-text="formatTime(session.start_time) + ' - ' + formatTime(session.end_time)"></p>
                                                            <p class="text-xs text-gray-600 dark:text-gray-400 mt-1" x-text="'Lecturer: ' + session.lecturer_name"></p>
                                                             <template x-if="session.room_number">
                                                                <p class="text-xs text-gray-600 dark:text-gray-400" x-text="'Room: ' + session.room_number"></p>
                                                            </template>
                                                        </div>
                                                    </template>
                                                </div>
                                            </td>
                                        @endforeach
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-gray-500 dark:text-gray-400">No schedules are available for this program yet.</p>
                    @endif
                </div>
                
                {{-- Curriculum Viewer --}}
                <div x-show="activeTab === 'curriculum'" class="p-6 text-gray-900 dark:text-gray-100">
                    <h4 class="text-xl font-semibold mb-4">4-Year Curriculum</h4>
                    <div x-data="{ openYear: 1 }" class="space-y-2">
                        @forelse($coursesByYearAndSemester->sortKeys() as $year => $semesters)
                            <div class="border border-gray-200 dark:border-gray-700 rounded-lg">
                                <button @click="openYear = openYear === {{ $year }} ? null : {{ $year }}" class="w-full flex justify-between items-center p-4 text-left font-semibold text-gray-800 dark:text-gray-200">
                                    <span>Year {{ $year }}</span>
                                    <svg class="w-5 h-5 transition-transform" :class="{'rotate-180': openYear === {{ $year }}}" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                </button>
                                <div x-show="openYear === {{ $year }}" x-transition class="p-4 border-t border-gray-200 dark:border-gray-700 grid md:grid-cols-2 gap-6">
                                    @foreach($semesters->sortKeys() as $semester => $courses)
                                        <div>
                                            <h6 class="font-bold text-gray-600 dark:text-gray-300">Semester {{ $semester }}</h6>
                                            <ul class="mt-2 space-y-2">
                                                @foreach($courses as $course)
                                                    <li class="flex items-start p-3 bg-gray-50 dark:bg-gray-900/50 rounded-md">
                                                        <svg class="w-5 h-5 text-indigo-500 mr-3 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
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
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Back to All Programs
                </a>
            </div>
        </div>
    </div>

    <script>
        function scheduleViewer(data) {
            return {
                schedules: data.schedules || {},
                promotions: data.promotions || [],
                selectedPromotion: data.promotions[0] || '',
                availableGroups: [],
                selectedGroup: '',

                init() {
                    this.updateGroups();
                },

                updateGroups() {
                    if (this.schedules[this.selectedPromotion]) {
                        this.availableGroups = Object.keys(this.schedules[this.selectedPromotion]);
                        this.selectedGroup = this.availableGroups[0] || '';
                    } else {
                        this.availableGroups = [];
                        this.selectedGroup = '';
                    }
                },

                filteredSchedule(day, shift) {
                    if (this.schedules[this.selectedPromotion] && this.schedules[this.selectedPromotion][this.selectedGroup] && this.schedules[this.selectedPromotion][this.selectedGroup][day] && this.schedules[this.selectedPromotion][this.selectedGroup][day][shift]) {
                        return this.schedules[this.selectedPromotion][this.selectedGroup][day][shift];
                    }
                    return [];
                },

                formatTime(time) {
                    const [hour, minute] = time.split(':');
                    const hourInt = parseInt(hour, 10);
                    const ampm = hourInt >= 12 ? 'PM' : 'AM';
                    const formattedHour = hourInt % 12 || 12;
                    return `${String(formattedHour).padStart(2, '0')}:${minute} ${ampm}`;
                }
            }
        }
    </script>
</x-app-layout>