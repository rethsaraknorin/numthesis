<x-admin-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Schedule for: {{ $program->name }} - Year {{ $year }}, Semester {{ $semester }}
            </h2>
            <a href="{{ route('admin.schedules.selectSemester', ['program' => $program, 'year' => $year]) }}" class="text-sm text-indigo-600 dark:text-indigo-400 hover:underline">
                &larr; Back to semester selection
            </a>
        </div>
    </x-slot>

    {{-- UPDATED: Pass all necessary data into the Alpine.js component --}}
    <div x-data="scheduleManager({
        courses: {{ json_encode($courses) }},
        scheduledCoursesMap: {{ json_encode($scheduledCoursesMap) }},
        sessions: {{ json_encode($sessions) }},
        days: {{ json_encode($days) }}
    })" class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-md" role="alert">
                    <p>{{ session('success') }}</p>
                </div>
            @endif
             @if ($errors->any())
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-md" role="alert">
                    <p class="font-bold">Please correct the errors below:</p>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>- {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <button @click="showAddForm = !showAddForm" class="w-full text-left font-semibold text-lg text-gray-800 dark:text-gray-200 flex justify-between items-center">
                        <span>Add New Class Session for Year {{ $year }}, Semester {{ $semester }}</span>
                         <svg class="w-6 h-6 transition-transform" :class="{'rotate-180': showAddForm}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <div x-show="showAddForm" x-transition class="mt-6">
                        <form action="{{ route('admin.schedules.store', ['program' => $program, 'year' => $year, 'semester' => $semester]) }}" method="POST" class="space-y-6">
                            @csrf
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                                {{-- Promotion Input --}}
                                <div>
                                    <x-input-label for="promotion_name" :value="__('Promotion')" />
                                    <x-text-input id="promotion_name" name="promotion_name" type="text" class="mt-1 block w-full" x-model.debounce.300ms="promotionName" required placeholder="e.g., 30" />
                                </div>
                                
                                {{-- Dynamic Group Input/Select --}}
                                <div>
                                    <x-input-label for="group_name_select" :value="__('Group')" />
                                    <select id="group_name_select" x-model="selectedGroup" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm">
                                        <option value="">-- Select or Create Group --</option>
                                        <template x-for="group in groupsForSelectedPromotion" :key="group">
                                            <option :value="group" x-text="group"></option>
                                        </template>
                                        <option value="new_group">--- Create New Group ---</option>
                                    </select>
                                </div>
                                <div x-show="selectedGroup === 'new_group'">
                                    <x-input-label for="group_name_text" :value="__('New Group Name')" />
                                    <x-text-input id="group_name_text" x-model="newGroupName" type="text" class="mt-1 block w-full" placeholder="e.g., 33 or 33+45" />
                                </div>
                                <input type="hidden" name="group_name" :value="finalGroupName">

                                {{-- Dynamic Course Dropdown --}}
                                <div class="md:col-span-2">
                                    <x-input-label for="course_id" :value="__('Course')" />
                                    <select id="course_id" name="course_id" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm" required>
                                        <option value="">Select a course</option>
                                        <template x-for="course in availableCourses" :key="course.id">
                                            <option :value="course.id" x-text="course.name"></option>
                                        </template>
                                        <template x-if="finalGroupName && availableCourses.length === 0">
                                            <option value="" disabled>All courses for this group are scheduled</option>
                                        </template>
                                    </select>
                                </div>
                                
                                {{-- Dynamic Day of Week Dropdown --}}
                                <div>
                                    <x-input-label for="day_of_week" :value="__('Day of Week')" />
                                    <select id="day_of_week" name="day_of_week" x-model="dayOfWeek" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm" required>
                                        <template x-for="day in availableDays" :key="day">
                                            <option :value="day" x-text="day"></option>
                                        </template>
                                    </select>
                                </div>
                                
                                {{-- Other fields --}}
                                <div>
                                    <x-input-label for="shift" :value="__('Shift')" />
                                    <select id="shift" name="shift" x-model="shift" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm" required>
                                        @foreach($shifts as $shift) <option value="{{ $shift }}">{{ $shift }}</option> @endforeach
                                    </select>
                                </div>
                                <div>
                                    <x-input-label for="start_time" :value="__('Start Time')" />
                                    <x-text-input id="start_time" name="start_time" type="time" x-model="startTime" class="mt-1 block w-full" required />
                                </div>
                                <div>
                                    <x-input-label for="end_time" :value="__('End Time')" />
                                    <x-text-input id="end_time" name="end_time" type="time" x-model="endTime" class="mt-1 block w-full" required />
                                </div>
                                <div>
                                    <x-input-label for="room_number" :value="__('Room Number')" />
                                    <x-text-input id="room_number" name="room_number" type="text" class="mt-1 block w-full" x-model="roomNumber" placeholder="e.g., A-101" />
                                </div>
                                <div>
                                    <x-input-label for="lecturer_name" :value="__('Lecturer Name')" />
                                    <x-text-input id="lecturer_name" name="lecturer_name" type="text" class="mt-1 block w-full" required />
                                </div>
                                 <div class="md:col-span-2">
                                    <x-input-label for="lecturer_phone" :value="__('Lecturer Phone (Optional)')" />
                                    <x-text-input id="lecturer_phone" name="lecturer_phone" type="text" class="mt-1 block w-full" />
                                </div>
                            </div>
                            <div class="flex justify-end">
                                <x-primary-button>{{ __('Add Session') }}</x-primary-button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            {{-- The rest of the file remains the same for displaying schedules --}}
            <div class="space-y-8">
                @forelse($groupedSessions as $promotionName => $groups)
                    @foreach($groups as $groupName => $scheduleData)
                        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6 text-gray-900 dark:text-gray-100">
                                <h3 class="text-xl font-bold text-gray-900 dark:text-white">
                                    Promotion: {{ $promotionName }} / Group: {{ $groupName }}
                                </h3>
                                @php
                                    $firstSession = $scheduleData->flatten()->first();
                                    $groupShift = $firstSession ? $firstSession->shift : null;

                                    if ($groupShift === 'Weekend') {
                                        $daysToShow = ['Saturday', 'Sunday'];
                                        $shiftsToShow = ['Weekend'];
                                    } elseif ($groupShift) {
                                        $daysToShow = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];
                                        $shiftsToShow = [$groupShift];
                                    } else {
                                        $daysToShow = $days;
                                        $shiftsToShow = $shifts;
                                    }
                                @endphp
                                <div class="overflow-x-auto mt-4">
                                    <table class="w-full min-w-max border-collapse text-left">
                                        <thead>
                                            <tr>
                                                <th class="border-b-2 dark:border-gray-700 p-4 w-1/5">Shift</th>
                                                @foreach($daysToShow as $dayName)
                                                    <th class="border-b-2 dark:border-gray-700 p-4 text-center">{{ $dayName }}</th>
                                                @endforeach
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($shiftsToShow as $shiftName)
                                            <tr class="border-b dark:border-gray-700">
                                                <td class="p-4 font-bold align-top">{{ $shiftName }}</td>
                                                @foreach($daysToShow as $dayName)
                                                    <td class="p-2 align-top">
                                                        @if(isset($scheduleData[$dayName][$shiftName]))
                                                            <div class="space-y-2">
                                                                @foreach($scheduleData[$dayName][$shiftName] as $session)
                                                                    <div class="bg-indigo-100 dark:bg-indigo-900/50 p-3 rounded-lg text-sm">
                                                                        <p class="font-bold text-indigo-800 dark:text-indigo-200">{{ $session->course->name }}</p>
                                                                        <p class="text-xs text-gray-600 dark:text-gray-400">{{ \Carbon\Carbon::parse($session->start_time)->format('h:i A') }} - {{ \Carbon\Carbon::parse($session->end_time)->format('h:i A') }}</p>
                                                                        <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">Lecturer: {{ $session->lecturer_name }}</p>
                                                                        @if($session->room_number) <p class="text-xs text-gray-600 dark:text-gray-400">Room: {{ $session->room_number }}</p> @endif
                                                                        <div class="flex items-center justify-end space-x-3 mt-2">
                                                                            <a href="{{ route('admin.schedules.edit', $session) }}" class="text-blue-500 hover:text-blue-700 dark:hover:text-blue-400 text-xs font-semibold">Edit</a>
                                                                            <form action="{{ route('admin.schedules.destroy', $session) }}" method="POST" onsubmit="return confirm('Are you sure?');"> @csrf @method('DELETE') <button type="submit" class="text-red-500 hover:text-red-700 dark:hover:text-red-400 text-xs font-semibold">Delete</button></form>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
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
                        </div>
                    @endforeach
                @empty
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                         <div class="p-6 text-center text-gray-500 dark:text-gray-400">
                            No schedules have been created for Year {{ $year }}, Semester {{ $semester }} yet.
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    {{-- UPDATED: Alpine.js script with all the new dynamic logic --}}
    <script>
        function scheduleManager(data) {
            return {
                showAddForm: false,
                // Form state
                promotionName: '',
                selectedGroup: '',
                newGroupName: '',
                dayOfWeek: 'Monday',
                shift: 'Morning',
                startTime: '07:00',
                endTime: '11:00',
                roomNumber: '',
                // Data from controller
                allCourses: data.courses || [],
                allSessions: data.sessions || [],
                allDays: data.days || [],
                scheduledCoursesMap: data.scheduledCoursesMap || {},

                init() {
                    // Watch for changes to the selected group to auto-fill
                    this.$watch('selectedGroup', (newVal) => {
                        if (newVal && newVal !== 'new_group') {
                            this.autoFillFromGroup(newVal);
                        } else {
                            this.resetFormFields();
                        }
                    });
                },

                // Determines the final group name to be submitted
                get finalGroupName() {
                    return this.selectedGroup === 'new_group' ? this.newGroupName : this.selectedGroup;
                },

                // Returns a list of existing groups for the selected promotion
                get groupsForSelectedPromotion() {
                    if (!this.promotionName || !this.scheduledCoursesMap[this.promotionName]) {
                        return [];
                    }
                    return Object.keys(this.scheduledCoursesMap[this.promotionName]);
                },

                // Returns a list of courses not yet scheduled for the selected group
                get availableCourses() {
                    const scheduledIds = this.scheduledCoursesMap[this.promotionName]?.[this.finalGroupName] || [];
                    if (scheduledIds.length === 0) return this.allCourses;
                    return this.allCourses.filter(course => !scheduledIds.includes(course.id));
                },

                // Returns a list of days not yet scheduled for the selected group
                get availableDays() {
                    const sessionsForGroup = this.allSessions.filter(s => s.promotion_name === this.promotionName && s.group_name === this.finalGroupName);
                    const scheduledDays = sessionsForGroup.map(s => s.day_of_week);
                    if (scheduledDays.length === 0) return this.allDays;
                    return this.allDays.filter(day => !scheduledDays.includes(day));
                },
                
                // Auto-fills form fields based on the selected group
                autoFillFromGroup(group) {
                    const firstSession = this.allSessions.find(s => s.promotion_name === this.promotionName && s.group_name === group);
                    if (firstSession) {
                        this.shift = firstSession.shift;
                        this.startTime = firstSession.start_time.substring(0, 5);
                        this.endTime = firstSession.end_time.substring(0, 5);
                        this.roomNumber = firstSession.room_number;
                    }
                },

                // Resets form fields when creating a new group
                resetFormFields() {
                    this.shift = 'Morning';
                    this.startTime = '07:00';
                    this.endTime = '11:00';
                    this.roomNumber = '';
                }
            }
        }
    </script>
</x-admin-layout>