<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Schedule for: {{ $program->name }} - Year {{ $year }}, Semester {{ $semester }}
        </h2>
    </x-slot>

    <div class="py-12" x-data="scheduleManager({
        initialPromotion: '{{ $activePromotion }}',
        allCourses: {{ json_encode($courses->keyBy('id')) }},
        allSessions: {{ json_encode($sessionsForActivePromotion) }}
    })">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Success/Error Messages --}}
            @if (session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-md shadow-md" role="alert">
                    <p>{{ session('success') }}</p>
                </div>
            @endif
            @if ($errors->any())
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-md shadow-md" role="alert">
                    <p class="font-bold">Please fix the following errors:</p>
                    <ul class="mt-2 list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Add New Session Form --}}
            <div id="add-session-form" class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg mb-6 scroll-mt-6">
                <div class="p-6">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100 mb-4 border-b dark:border-gray-700 pb-3">
                        Add New Class Session
                    </h3>
                    <form method="POST" action="{{ route('admin.schedules.store', ['program' => $program, 'year' => $year, 'semester' => $semester]) }}" class="space-y-4">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            <div>
                                <x-input-label for="course_id" value="Course" />
                                <select required id="course_id_select" name="course_id" x-model="newSession.course_id" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm">
                                    <option value="">Select a course...</option>
                                    <template x-for="course in filteredCourses" :key="course.id">
                                        <option :value="course.id" x-text="course.name"></option>
                                    </template>
                                </select>
                            </div>
                            <div><x-input-label for="lecturer_name" value="Lecturer" /><x-text-input required name="lecturer_name" x-model="newSession.lecturer_name" class="mt-1 block w-full" /></div>
                            <div><x-input-label for="room_number" value="Room" /><x-text-input required name="room_number" x-model="newSession.room_number" class="mt-1 block w-full" /></div>
                            <div>
                                <x-input-label for="promotion_name" value="Promotion" />
                                <x-text-input required name="promotion_name" x-model="newSession.promotion_name" class="mt-1 block w-full bg-gray-100 dark:bg-gray-700" readonly />
                            </div>
                            <div><x-input-label for="group_name" value="Group" /><x-text-input required name="group_name" x-model="newSession.group_name" class="mt-1 block w-full" /></div>
                            <div>
                                <x-input-label for="day_of_week" value="Day of Week" />
                                <select required name="day_of_week" x-model="newSession.day_of_week" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm">
                                    @foreach($days as $day)
                                        <option value="{{ ucfirst($day) }}">{{ ucfirst($day) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <x-input-label for="shift" value="Shift" />
                                <select required name="shift" x-model="newSession.shift" @change="updateTimesBasedOnShift()" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm">
                                    <option value="Morning">Morning</option>
                                    <option value="Afternoon">Afternoon</option>
                                    <option value="Night">Night</option>
                                </select>
                            </div>
                            <div><x-input-label for="start_time" value="Start Time" /><x-text-input required name="start_time" type="time" x-model="newSession.start_time" class="mt-1 block w-full" /></div>
                            <div><x-input-label for="end_time" value="End Time" /><x-text-input required name="end_time" type="time" x-model="newSession.end_time" class="mt-1 block w-full" /></div>
                        </div>
                        <div class="flex justify-end items-center gap-4 mt-4">
                            <x-secondary-button type="button" @click="resetForm()">
                                Reset / Add New Group
                            </x-secondary-button>
                            <x-primary-button>Save Session</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Schedule Viewer --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    @if($promotions->isEmpty())
                        <p class="text-center text-gray-500 dark:text-gray-400 py-8">No schedules have been created for this program yet.</p>
                    @else
                        {{-- Promotion Tabs --}}
                        <div class="border-b border-gray-200 dark:border-gray-700">
                             <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                                @foreach($promotions as $promotion)
                                <a href="{{ url()->current() }}?promotion={{ $promotion }}"
                                   class="{{ ($activePromotion == $promotion) ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                                    Promotion {{ $promotion }}
                                </a>
                                @endforeach
                            </nav>
                        </div>

                        {{-- Schedule Tables per Group --}}
                        @forelse($scheduleData as $group => $timeSlots)
                            <div class="mt-8">
                                <div class="flex items-center justify-between mb-4">
                                    <h4 class="text-xl font-bold text-gray-800 dark:text-gray-200">Group: {{ $group }}</h4>
                                    <a href="{{ route('admin.schedules.bulkEdit', ['program' => $program, 'year' => $year, 'semester' => $semester, 'promotion' => $activePromotion, 'group' => $group]) }}" class="text-sm font-medium text-indigo-600 dark:text-indigo-400 hover:underline">
                                        Bulk Edit Group
                                    </a>
                                </div>
                                <div class="mt-4 overflow-x-auto">
                                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                        <thead class="bg-gray-50 dark:bg-gray-700">
                                            <tr>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider w-1/6">Time</th>
                                                @foreach($days as $day)
                                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">{{ ucfirst($day) }}</th>
                                                @endforeach
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                        @foreach($timeSlots as $time => $daySessions)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100 align-top">{{ $time }}</td>
                                                @foreach($days as $day)
                                                    <td class="p-2 align-top h-full">
                                                        @if(isset($daySessions[ucfirst($day)]))
                                                            @foreach($daySessions[ucfirst($day)] as $session)
                                                            <div class="p-3 mb-2 bg-indigo-50 dark:bg-indigo-800/30 rounded-lg shadow-sm">
                                                                <p class="font-bold text-indigo-800 dark:text-indigo-200">{{ $session->course->name }}</p>
                                                                <p class="mt-1 text-xs text-gray-600 dark:text-gray-400">Lecturer: {{ $session->lecturer_name }}</p>
                                                                <p class="text-xs text-gray-600 dark:text-gray-400">Room: {{ $session->room_number }}</p>
                                                                <div class="flex items-center justify-end space-x-3 mt-2">
                                                                    <a href="{{ route('admin.schedules.edit', ['session' => $session->id]) }}" class="text-xs font-medium text-blue-600 hover:text-blue-800 hover:underline">Edit</a>
                                                                    <form action="{{ route('admin.schedules.destroy', ['session' => $session->id]) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                                                        @csrf @method('DELETE')
                                                                        <button type="submit" class="text-xs font-medium text-red-600 hover:text-red-800 hover:underline">Delete</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                            @endforeach
                                                        @else
                                                            @php
                                                                $adjacentRoom = '';
                                                                foreach($days as $otherDay) {
                                                                    if (isset($daySessions[ucfirst($otherDay)])) {
                                                                        $adjacentRoom = $daySessions[ucfirst($otherDay)][0]->room_number;
                                                                        break;
                                                                    }
                                                                }
                                                            @endphp
                                                            <div class="h-full flex items-center justify-center">
                                                                <button
                                                                    type="button"
                                                                    @click="fillForm('{{ $group }}', '{{ ucfirst($day) }}', '{{ $time }}', '{{ $adjacentRoom }}')"
                                                                    class="text-xs text-gray-400 dark:text-gray-500 hover:text-indigo-600 dark:hover:text-indigo-400 p-4 w-full h-full border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-lg hover:border-indigo-400 dark:hover:border-indigo-500 transition">
                                                                    + Add
                                                                </button>
                                                            </div>
                                                        @endif
                                                    </td>
                                                @endforeach
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @empty
                            <p class="text-center text-gray-500 dark:text-gray-400 py-8">No schedule data found for Promotion {{ $activePromotion }}.</p>
                        @endforelse
                    @endif
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
    <script>
        function scheduleManager(config) {
            return {
                allCourses: config.allCourses,
                allSessions: config.allSessions,
                filteredCourses: [],
                newSession: {
                    course_id: '',
                    lecturer_name: '',
                    room_number: '',
                    promotion_name: config.initialPromotion,
                    group_name: '',
                    day_of_week: 'Monday',
                    shift: 'Morning',
                    start_time: '',
                    end_time: ''
                },
                init() {
                    this.resetForm();
                    this.newSession.promotion_name = new URLSearchParams(window.location.search).get('promotion') || config.initialPromotion;
                },
                updateTimesBasedOnShift() {
                    const shift = this.newSession.shift;
                    switch (shift) {
                        case 'Morning':
                            this.newSession.start_time = '07:00';
                            this.newSession.end_time = '11:00';
                            break;
                        case 'Afternoon':
                            this.newSession.start_time = '13:00';
                            this.newSession.end_time = '17:00';
                            break;
                        case 'Night':
                            this.newSession.start_time = '18:00';
                            this.newSession.end_time = '21:00';
                            break;
                        default:
                            this.newSession.start_time = '';
                            this.newSession.end_time = '';
                    }
                },
                fillForm(group, day, timeLabel, room) {
                    this.newSession.group_name = group;
                    this.newSession.day_of_week = day;
                    this.newSession.room_number = room;
                    this.newSession.course_id = '';
                    this.newSession.lecturer_name = '';

                    const [startTime12, endTime12] = timeLabel.split(' - ');
                    const startTime24 = this.convertTo24Hour(startTime12);
                    const endTime24 = this.convertTo24Hour(endTime12);
                    this.newSession.start_time = startTime24;
                    this.newSession.end_time = endTime24;
                    
                    const startHour = parseInt(startTime24.split(':')[0], 10);
                    if (startHour >= 18) this.newSession.shift = 'Night';
                    else if (startHour >= 12) this.newSession.shift = 'Afternoon';
                    else this.newSession.shift = 'Morning';

                    const scheduledCourseIds = this.allSessions
                        .filter(session => session.group_name === group)
                        .map(session => session.course_id);
                    
                    this.filteredCourses = Object.values(this.allCourses)
                        .filter(course => !scheduledCourseIds.includes(course.id));

                    const formEl = document.getElementById('add-session-form');
                    formEl.scrollIntoView({ behavior: 'smooth' });
                    setTimeout(() => document.getElementById('course_id_select').focus(), 400);
                },
                resetForm() {
                    this.newSession.course_id = '';
                    this.newSession.lecturer_name = '';
                    this.newSession.room_number = '';
                    this.newSession.group_name = '';
                    this.newSession.day_of_week = 'Monday';
                    this.newSession.shift = 'Morning';
                    this.filteredCourses = Object.values(this.allCourses);
                    this.updateTimesBasedOnShift();
                },
                convertTo24Hour(time12h) {
                    const [time, modifier] = time12h.split(' ');
                    let [hours, minutes] = time.split(':');
                    if (hours === '12') hours = '00';
                    if (modifier.toUpperCase() === 'PM') hours = parseInt(hours, 10) + 12;
                    return `${String(hours).padStart(2, '0')}:${minutes}`;
                }
            }
        }
    </script>
    @endpush
</x-admin-layout>