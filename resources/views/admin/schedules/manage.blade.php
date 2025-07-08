<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Schedule for: {{ $program->name }} - Year {{ $year }}, Semester {{ $semester }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8"
             x-data='{
                // --- Main Data ---
                scheduleData: @json($scheduleData),
                promotions: @json($promotions),
                allCourses: @json($courses),
                allDays: @json($days),

                // --- Active State ---
                activePromotion: null,
                activeGroup: null,
                
                // --- Form State ---
                formOpen: false,
                form: {
                    promotion_name: "{{ 33 - ($year - 1) }}",
                    group_name: "",
                    course_id: "",
                    lecturer_name: "",
                    lecturer_phone: "",
                    room_number: "",
                    day_of_week: "",
                    shift: "",
                    start_time: "",
                    end_time: ""
                },
                shifts: {
                    "Morning": { start: "07:00", end: "11:00" },
                    "Afternoon": { start: "13:00", end: "17:00" },
                    "Night": { start: "17:30", end: "20:00" }
                },
                availableCourses: [],
                availableDays: [],

                // --- Methods ---
                init() {
                    if (this.promotions.length > 0) {
                        this.activePromotion = this.promotions[0];
                        if (this.scheduleData[this.activePromotion]) {
                            this.activeGroup = Object.keys(this.scheduleData[this.activePromotion])[0];
                        }
                    }
                },
                selectPromotion(promotion) {
                    this.activePromotion = promotion;
                    this.activeGroup = this.scheduleData[promotion] ? Object.keys(this.scheduleData[promotion])[0] : null;
                },
                selectGroup(group) {
                    this.activeGroup = group;
                },
                openAddForm(group) {
                    this.form.group_name = group;
                    
                    const groupData = this.scheduleData[this.activePromotion]?.[group];
                    const scheduledCourseIds = new Set();
                    const scheduledDays = new Set();
                    let firstSession = null;

                    if (groupData) {
                        // Find the first session to get default values
                        const dayKeys = Object.keys(groupData.grid);
                        if (dayKeys.length > 0) {
                            const timeKeys = Object.keys(groupData.grid[dayKeys[0]]);
                            if (timeKeys.length > 0) {
                                firstSession = groupData.grid[dayKeys[0]][timeKeys[0]];
                            }
                        }

                        Object.values(groupData.grid).forEach(dayData => {
                            Object.values(dayData).forEach(session => {
                                scheduledCourseIds.add(session.course_id);
                                scheduledDays.add(session.day_of_week.toLowerCase());
                            });
                        });
                    }

                    // Pre-fill fields based on the first session found
                    this.form.shift = firstSession?.shift || "";
                    this.form.room_number = firstSession?.room_number || "";
                    this.updateTimesFromShift();

                    // Filter available courses and days
                    this.availableCourses = this.allCourses.filter(c => !scheduledCourseIds.has(c.id));
                    this.availableDays = this.allDays.filter(d => !scheduledDays.has(d));
                    
                    this.form.course_id = this.availableCourses[0]?.id || "";
                    this.form.day_of_week = this.availableDays[0] || "";

                    this.formOpen = true;
                },
                updateTimesFromShift() {
                    const shift = this.shifts[this.form.shift];
                    if (shift) {
                        this.form.start_time = shift.start;
                        this.form.end_time = shift.end;
                    } else {
                        this.form.start_time = "";
                        this.form.end_time = "";
                    }
                }
             }'>
            
            <!-- Add New Class Session Form -->
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <div x-show="!formOpen">
                         <x-primary-button @click="openAddForm(activeGroup || '')">Add New Session</x-primary-button>
                    </div>

                    <div x-show="formOpen" x-transition>
                        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">
                            Add New Class Session
                        </h3>
                        <form method="POST" action="{{ route('admin.schedules.store', ['program' => $program, 'year' => $year, 'semester' => $semester]) }}" class="space-y-4">
                            @csrf
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                <div>
                                    <x-input-label for="course_id" value="Course" />
                                    <select id="course_id" name="course_id" x-model="form.course_id" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm">
                                        <template x-for="course in availableCourses" :key="course.id">
                                            <option :value="course.id" x-text="course.name"></option>
                                        </template>
                                        <template x-if="availableCourses.length === 0"><option disabled>All courses are scheduled</option></template>
                                    </select>
                                </div>
                                <div>
                                    <x-input-label for="lecturer_name" value="Lecturer" />
                                    <x-text-input id="lecturer_name" name="lecturer_name" class="mt-1 block w-full" />
                                </div>
                                <div>
                                    <x-input-label for="lecturer_phone" value="Lecturer Phone" />
                                    <x-text-input id="lecturer_phone" name="lecturer_phone" class="mt-1 block w-full" />
                                </div>
                                <div>
                                    <x-input-label for="room_number" value="Room" />
                                    <x-text-input id="room_number" name="room_number" x-model="form.room_number" class="mt-1 block w-full" />
                                </div>
                                <div>
                                    <x-input-label for="promotion_name" value="Promotion" />
                                    <x-text-input id="promotion_name" name="promotion_name" x-model="form.promotion_name" class="mt-1 block w-full bg-gray-100 dark:bg-gray-800" readonly />
                                </div>
                                <div>
                                    <x-input-label for="group_name" value="Group" />
                                    <x-text-input id="group_name" name="group_name" x-model="form.group_name" class="mt-1 block w-full" />
                                </div>
                                 <div>
                                    <x-input-label for="day_of_week" value="Day of Week" />
                                    <select id="day_of_week" name="day_of_week" x-model="form.day_of_week" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm">
                                        <template x-for="day in availableDays" :key="day">
                                            <option :value="day" x-text="day.charAt(0).toUpperCase() + day.slice(1)"></option>
                                        </template>
                                        <template x-if="availableDays.length === 0"><option disabled>All days are scheduled</option></template>
                                    </select>
                                </div>
                                <div>
                                    <x-input-label for="shift" value="Shift" />
                                    <select id="shift" name="shift" x-model="form.shift" @change="updateTimesFromShift()" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm">
                                        <option value="">Select a shift...</option>
                                        <option value="Morning">Morning</option>
                                        <option value="Afternoon">Afternoon</option>
                                        <option value="Night">Night</option>
                                    </select>
                                </div>
                                <div>
                                    <x-input-label for="start_time" value="Start Time" />
                                    <x-text-input id="start_time" name="start_time" type="time" x-model="form.start_time" class="mt-1 block w-full" />
                                </div>
                                <div>
                                    <x-input-label for="end_time" value="End Time" />
                                    <x-text-input id="end_time" name="end_time" type="time" x-model="form.end_time" class="mt-1 block w-full" />
                                </div>
                            </div>
                            <div class="flex justify-end items-center gap-4">
                                <button type="button" @click="formOpen = false" class="text-sm text-gray-600 dark:text-gray-400">Cancel</button>
                                <x-primary-button>Save Session</x-primary-button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Schedule Viewer -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    @if(empty($scheduleData))
                        <p class="text-center text-gray-500 dark:text-gray-400 py-8">No schedules have been created for Year {{ $year }}, Semester {{ $semester }} yet.</p>
                    @else
                        <!-- Promotion Tabs -->
                        <div class="border-b border-gray-200 dark:border-gray-700">
                            <nav class="flex -mb-px space-x-6" aria-label="Tabs">
                                <template x-for="promotion in promotions" :key="promotion">
                                    <button @click="selectPromotion(promotion)"
                                        :class="activePromotion === promotion ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 dark:hover:text-gray-200'"
                                        class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                                        <span x-text="'Promotion ' + promotion"></span>
                                    </button>
                                </template>
                            </nav>
                        </div>

                        <!-- Group Tabs -->
                        <div class="mt-4 flex justify-between items-center">
                            <nav class="flex flex-wrap gap-2">
                                <template x-for="group in Object.keys(scheduleData[activePromotion] || {})" :key="group">
                                    <button @click="selectGroup(group)"
                                        :class="activeGroup === group ? 'bg-indigo-600 text-white' : 'bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 hover:bg-gray-300 dark:hover:bg-gray-600'"
                                        class="px-4 py-2 text-sm font-medium rounded-md transition">
                                        <span x-text="'Group ' + group"></span>
                                    </button>
                                </template>
                            </nav>
                             <div x-show="activeGroup">
                                <button @click="openAddForm(activeGroup)" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-indigo-700 bg-indigo-100 hover:bg-indigo-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Add to this Group
                                </button>
                            </div>
                        </div>

                        <!-- Schedule Calendar Grid -->
                        <div x-show="activeGroup" class="mt-6 overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead class="bg-gray-50 dark:bg-gray-700">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Time</th>
                                        @foreach($days as $day)
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">{{ ucfirst($day) }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                    <template x-for="(label, time) in scheduleData[activePromotion]?.[activeGroup]?.labels || {}" :key="time">
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100 align-top" x-text="label"></td>
                                            @foreach($days as $day)
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300 align-top">
                                                    <template x-if="scheduleData[activePromotion]?.[activeGroup]?.grid[time]?.['{{$day}}']">
                                                        <div class="p-2 bg-indigo-100 dark:bg-indigo-900/50 rounded-lg">
                                                            <p class="font-semibold text-indigo-800 dark:text-indigo-300" x-text="scheduleData[activePromotion][activeGroup].grid[time]['{{$day}}'].course.name"></p>
                                                            <p class="text-xs text-gray-600 dark:text-gray-400" x-text="'Lecturer: ' + scheduleData[activePromotion][activeGroup].grid[time]['{{$day}}'].lecturer_name"></p>
                                                            <p class="text-xs text-gray-600 dark:text-gray-400" x-text="'Room: ' + scheduleData[activePromotion][activeGroup].grid[time]['{{$day}}'].room_number"></p>
                                                            <div class="flex items-center space-x-2 mt-2">
                                                                <a :href="`/admin/schedules/session/${scheduleData[activePromotion][activeGroup].grid[time]['{{$day}}'].id}/edit`" class="text-xs font-medium text-blue-600 hover:underline">Edit</a>
                                                                <form :action="`/admin/schedules/session/${scheduleData[activePromotion][activeGroup].grid[time]['{{$day}}'].id}`" method="POST" onsubmit="return confirm('Are you sure?');">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="text-xs font-medium text-red-600 hover:underline">Delete</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </template>
                                                </td>
                                            @endforeach
                                        </tr>
                                    </template>
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
