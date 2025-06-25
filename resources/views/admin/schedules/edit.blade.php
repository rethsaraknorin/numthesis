<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Class Session') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 md:p-8 text-gray-900 dark:text-gray-100">

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

                    <form action="{{ route('admin.schedules.update', $session) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')

                        {{-- The semester is fixed for an existing session and cannot be changed here --}}
                        <input type="hidden" name="semester" value="{{ $session->semester }}">

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            {{-- Promotion & Group --}}
                            <div>
                                <x-input-label for="promotion_name" :value="__('Promotion')" />
                                <x-text-input id="promotion_name" name="promotion_name" type="text" class="mt-1 block w-full" :value="old('promotion_name', $session->promotion_name)" required />
                            </div>
                            <div>
                                <x-input-label for="group_name" :value="__('Group')" />
                                <x-text-input id="group_name" name="group_name" type="text" class="mt-1 block w-full" :value="old('group_name', $session->group_name)" required />
                            </div>

                            {{-- Course --}}
                            <div class="md:col-span-2">
                                <x-input-label for="course_id" :value="__('Course')" />
                                {{-- UPDATED: The course list is now also filtered by semester --}}
                                <select id="course_id" name="course_id" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm" required>
                                    <option value="">Select a course for Year {{ $session->year }}, S{{ $session->semester }}</option>
                                    @foreach($courses as $course)
                                        <option value="{{ $course->id }}" @selected(old('course_id', $session->course_id) == $course->id)>
                                            {{ $course->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Day of Week & Shift --}}
                            <div>
                                <x-input-label for="day_of_week" :value="__('Day of Week')" />
                                <select id="day_of_week" name="day_of_week" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm" required>
                                    @foreach($days as $day)
                                        <option value="{{ $day }}" @selected(old('day_of_week', $session->day_of_week) == $day)>{{ $day }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <x-input-label for="shift" :value="__('Shift')" />
                                <select id="shift" name="shift" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm" required>
                                    @foreach($shifts as $shift)
                                        <option value="{{ $shift }}" @selected(old('shift', $session->shift) == $shift)>{{ $shift }}</option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Start & End Time --}}
                            <div>
                                <x-input-label for="start_time" :value="__('Start Time')" />
                                <x-text-input id="start_time" name="start_time" type="time" class="mt-1 block w-full" :value="old('start_time', \Carbon\Carbon::parse($session->start_time)->format('H:i'))" required />
                            </div>
                            <div>
                                <x-input-label for="end_time" :value="__('End Time')" />
                                <x-text-input id="end_time" name="end_time" type="time" class="mt-1 block w-full" :value="old('end_time', \Carbon\Carbon::parse($session->end_time)->format('H:i'))" required />
                            </div>

                            {{-- Room & Lecturer --}}
                            <div class="md:col-span-2">
                                <x-input-label for="room_number" :value="__('Room Number')" />
                                <x-text-input id="room_number" name="room_number" type="text" class="mt-1 block w-full" :value="old('room_number', $session->room_number)" placeholder="e.g., A-101" />
                            </div>
                            <div>
                                <x-input-label for="lecturer_name" :value="__('Lecturer Name')" />
                                <x-text-input id="lecturer_name" name="lecturer_name" type="text" class="mt-1 block w-full" :value="old('lecturer_name', $session->lecturer_name)" required />
                            </div>
                             <div>
                                <x-input-label for="lecturer_phone" :value="__('Lecturer Phone (Optional)')" />
                                <x-text-input id="lecturer_phone" name="lecturer_phone" type="text" class="mt-1 block w-full" :value="old('lecturer_phone', $session->lecturer_phone)" />
                            </div>
                        </div>

                        {{-- Action Buttons --}}
                        <div class="flex items-center gap-4 mt-6">
                            <x-primary-button>{{ __('Update Session') }}</x-primary-button>
                             {{-- UPDATED: The cancel link now correctly redirects to the semester-specific page --}}
                            <a href="{{ route('admin.schedules.manage', ['program' => $session->program_id, 'year' => $session->year, 'semester' => $session->semester]) }}" class="text-sm text-gray-600 dark:text-gray-400 hover:underline">
                                {{ __('Cancel') }}
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>