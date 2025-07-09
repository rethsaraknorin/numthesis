<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Schedule for: {{ $program->name }} - Year {{ $year }}, Semester {{ $semester }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Success/Error Messages --}}
            @if (session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-md shadow-md" role="alert">
                    <p class="font-bold">Success</p>
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
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100 mb-4 border-b dark:border-gray-700 pb-3">
                        Add New Class Session
                    </h3>
                    <form method="POST" action="{{ route('admin.schedules.store', ['program' => $program, 'year' => $year, 'semester' => $semester]) }}" class="space-y-4">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            <div>
                                <x-input-label for="course_id" value="Course" />
                                <select id="course_id" name="course_id" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm">
                                    <option value="">Select a course...</option>
                                    @foreach($courses as $course)
                                        <option value="{{ $course->id }}" {{ old('course_id') == $course->id ? 'selected' : '' }}>{{ $course->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <x-input-label for="lecturer_name" value="Lecturer" />
                                <x-text-input id="lecturer_name" name="lecturer_name" class="mt-1 block w-full" :value="old('lecturer_name')" />
                            </div>
                            <div>
                                <x-input-label for="lecturer_phone" value="Lecturer Phone (Optional)" />
                                <x-text-input id="lecturer_phone" name="lecturer_phone" class="mt-1 block w-full" :value="old('lecturer_phone')" />
                            </div>
                            <div>
                                <x-input-label for="room_number" value="Room" />
                                <x-text-input id="room_number" name="room_number" class="mt-1 block w-full" :value="old('room_number')" />
                            </div>
                             <div>
                                <x-input-label for="promotion_name" value="Promotion" />
                                <x-text-input id="promotion_name" name="promotion_name" class="mt-1 block w-full" :value="old('promotion_name', $activePromotion)" />
                            </div>
                            <div>
                                <x-input-label for="group_name" value="Group" />
                                <x-text-input id="group_name" name="group_name" class="mt-1 block w-full" :value="old('group_name')" />
                            </div>
                             <div>
                                <x-input-label for="day_of_week" value="Day of Week" />
                                <select id="day_of_week" name="day_of_week" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm">
                                    @foreach($days as $day)
                                        <option value="{{ ucfirst($day) }}" {{ old('day_of_week') == ucfirst($day) ? 'selected' : '' }}>{{ ucfirst($day) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <x-input-label for="shift" value="Shift" />
                                <select id="shift" name="shift" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm">
                                    <option value="Morning" {{ old('shift') == 'Morning' ? 'selected' : '' }}>Morning</option>
                                    <option value="Afternoon" {{ old('shift') == 'Afternoon' ? 'selected' : '' }}>Afternoon</option>
                                    <option value="Night" {{ old('shift') == 'Night' ? 'selected' : '' }}>Night</option>
                                </select>
                            </div>
                            <div>
                                <x-input-label for="start_time" value="Start Time" />
                                <x-text-input id="start_time" name="start_time" type="time" class="mt-1 block w-full" :value="old('start_time')" />
                            </div>
                            <div>
                                <x-input-label for="end_time" value="End Time" />
                                <x-text-input id="end_time" name="end_time" type="time" class="mt-1 block w-full" :value="old('end_time')" />
                            </div>
                        </div>
                        <div class="flex justify-end items-center gap-4 mt-4">
                            <x-primary-button>Save Session</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Schedule Viewer --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
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
                        @if(isset($scheduleData[$activePromotion]))
                            @foreach($scheduleData[$activePromotion] as $group => $timeSlots)
                            <div class="mt-8">
                                <h4 class="text-xl font-bold text-gray-800 dark:text-gray-200">Group: {{ $group }}</h4>
                                <div class="mt-4 overflow-x-auto">
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
                                        @forelse($timeSlots as $time => $daySessions)
                                                <tr>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100 align-top">{{ $time }}</td>
                                                    @foreach($days as $day)
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300 align-top">
                                                            @if(isset($daySessions[ucfirst($day)]))
                                                                @foreach($daySessions[ucfirst($day)] as $session)
                                                                <div class="p-3 bg-indigo-50 dark:bg-indigo-900/50 rounded-lg shadow-sm">
                                                                    <p class="font-bold text-indigo-800 dark:text-indigo-300">{{ $session->course->name }}</p>
                                                                    <p class="mt-1 text-xs text-gray-600 dark:text-gray-400">Lecturer: {{ $session->lecturer_name }}</p>
                                                                    <p class="text-xs text-gray-600 dark:text-gray-400">Room: {{ $session->room_number }}</p>
                                                                    <div class="flex items-center justify-end space-x-3 mt-2">
                                                                        <a href="{{ route('admin.schedules.edit', ['session' => $session->id]) }}" class="text-xs font-medium text-blue-600 hover:text-blue-800 hover:underline">Edit</a>
                                                                        <form action="{{ route('admin.schedules.destroy', ['session' => $session->id]) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this session?');">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <button type="submit" class="text-xs font-medium text-red-600 hover:text-red-800 hover:underline">Delete</button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                                @endforeach
                                                            @endif
                                                        </td>
                                                    @endforeach
                                                </tr>
                                        @empty
                                            <tr>
                                                <td colspan="{{ count($days) + 1 }}" class="text-center text-gray-500 py-6">No schedule data for this group.</td>
                                            </tr>
                                        @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            @endforeach
                        @else
                            <p class="text-center text-gray-500 dark:text-gray-400 py-8">No schedule data for this promotion.</p>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>