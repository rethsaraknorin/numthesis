<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Bulk Edit Schedule: {{ $program->name }} (Year {{ $year }}, Sem {{ $semester }}) - Group {{ $group }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('admin.schedules.bulkUpdate') }}">
                        @csrf
                        @method('PUT')

                        {{-- Hidden fields to identify the group --}}
                        <input type="hidden" name="program_id" value="{{ $program->id }}">
                        <input type="hidden" name="year" value="{{ $year }}">
                        <input type="hidden" name="semester" value="{{ $semester }}">
                        <input type="hidden" name="promotion_name" value="{{ $promotion }}">
                        <input type="hidden" name="group_name" value="{{ $group }}">

                        <div class="space-y-6">
                            @foreach ($formSessions as $day => $session)
                                <div class="p-4 border border-gray-200 dark:border-gray-700 rounded-lg">
                                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">{{ $day }}</h3>
                                    <div class="mt-4 grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-4 items-end">
                                        
                                        {{-- Course --}}
                                        <div class="lg:col-span-2">
                                            <x-input-label :for="'course_'.$day" value="Course" />
                                            <select name="sessions[{{ $day }}][course_id]" id="course_{{ $day }}" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm">
                                                <option value="">-- No Class --</option>
                                                @foreach($courses as $course)
                                                    <option value="{{ $course->id }}" @selected(optional($session)->course_id == $course->id)>
                                                        {{ $course->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        {{-- Shift --}}
                                        <div>
                                             <x-input-label :for="'shift_'.$day" value="Shift" />
                                             <select name="sessions[{{ $day }}][shift]" id="shift_{{ $day }}" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm">
                                                <option value="Morning" @selected(optional($session)->shift == 'Morning')>Morning</option>
                                                <option value="Afternoon" @selected(optional($session)->shift == 'Afternoon')>Afternoon</option>
                                                <option value="Night" @selected(optional($session)->shift == 'Night')>Night</option>
                                             </select>
                                        </div>

                                        {{-- Start Time --}}
                                        <div>
                                            <x-input-label :for="'start_time_'.$day" value="Start Time" />
                                            <x-text-input type="time" name="sessions[{{ $day }}][start_time]" id="start_time_{{ $day }}" class="mt-1 block w-full" :value="optional($session)->start_time ? \Carbon\Carbon::parse(optional($session)->start_time)->format('H:i') : ''" />
                                        </div>
                                        
                                        {{-- End Time --}}
                                        <div>
                                            <x-input-label :for="'end_time_'.$day" value="End Time" />
                                            <x-text-input type="time" name="sessions[{{ $day }}][end_time]" id="end_time_{{ $day }}" class="mt-1 block w-full" :value="optional($session)->end_time ? \Carbon\Carbon::parse(optional($session)->end_time)->format('H:i') : ''" />
                                        </div>

                                        {{-- Lecturer --}}
                                        <div class="lg:col-span-2">
                                            <x-input-label :for="'lecturer_'.$day" value="Lecturer" />
                                            <x-text-input type="text" name="sessions[{{ $day }}][lecturer_name]" id="lecturer_{{ $day }}" class="mt-1 block w-full" :value="optional($session)->lecturer_name" />
                                        </div>
                                        
                                        {{-- Room --}}
                                        <div>
                                            <x-input-label :for="'room_'.$day" value="Room" />
                                            <x-text-input type="text" name="sessions[{{ $day }}][room_number]" id="room_{{ $day }}" class="mt-1 block w-full" :value="optional($session)->room_number" />
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="mt-6 flex items-center justify-end gap-4">
                            <a href="{{ route('admin.schedules.manage', ['program' => $program->id, 'year' => $year, 'semester' => $semester, 'promotion' => $promotion]) }}" class="text-sm text-gray-600 dark:text-gray-400 hover:underline">
                                Cancel
                            </a>
                            <x-primary-button>
                                Update Schedule
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>