<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Manage Program: ') }} {{ $program->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Program Details --}}
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">{{ $program->name }}
                        ({{ $program->code }})</h3>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        {{ $program->description ?? 'No description provided.' }}
                    </p>
                    <div class="mt-4">
                        <a href="{{ route('admin.programs.index') }}"
                            class="text-indigo-600 dark:text-indigo-400 hover:underline text-sm">
                            &larr; Back to all programs
                        </a>
                    </div>
                </div>
            </div>

            {{-- Tabbed Interface for Each Year --}}
            <div x-data="{ activeTab: {{ session('active_year', 1) }} }" class="bg-white dark:bg-gray-800 shadow-sm rounded-lg"> {{-- Tab Navigation --}}
                <div class="border-b border-gray-200 dark:border-gray-700">
                    <nav class="flex -mb-px" aria-label="Tabs">
                        @for ($year = 1; $year <= 4; $year++)
                            <button @click="activeTab = {{ $year }}"
                                :class="{ 'border-indigo-500 text-indigo-600 dark:border-indigo-400 dark:text-indigo-300': activeTab ===
                                        {{ $year }}, 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 dark:text-gray-400 dark:hover:text-gray-300 dark:hover:border-gray-600': activeTab !==
                                        {{ $year }} }"
                                class="w-1/4 py-4 px-1 text-center border-b-2 font-medium text-sm focus:outline-none">
                                Year {{ $year }} Courses
                            </button>
                        @endfor
                    </nav>
                </div>

                {{-- Tab Content Panels --}}
                <div class="p-6">
                    @for ($year = 1; $year <= 4; $year++)
                        <div x-show="activeTab === {{ $year }}" x-cloak>
                            @php
                                $coursesForYear = $program->courses->where('year', $year)->groupBy('semester');
                            @endphp

                            {{-- MOVED: Add New Course Form is now at the top --}}
                            <div
                                class="bg-gray-50 dark:bg-gray-900/50 p-6 mb-6 border border-gray-200 dark:border-gray-700 rounded-lg">
                                <h4 class="text-md font-medium text-gray-900 dark:text-gray-100">Add New Course to Year
                                    {{ $year }}</h4>
                                <form method="POST" action="{{ route('admin.programs.courses.store', $program) }}"
                                    class="mt-4 space-y-4">
                                    @csrf
                                    <input type="hidden" name="year" value="{{ $year }}">

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <x-input-label for="name_{{ $year }}" :value="__('Course Name')" />
                                            <x-text-input id="name_{{ $year }}" name="name" type="text"
                                                class="mt-1 block w-full" :value="old('name')" required />
                                        </div>
                                        <div>
                                            <x-input-label for="semester_{{ $year }}" :value="__('Semester')" />
                                            <select id="semester_{{ $year }}" name="semester"
                                                class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm">
                                                <option value="1">Semester 1</option>
                                                <option value="2">Semester 2</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div>
                                        <x-input-label for="description_{{ $year }}" :value="__('Course Description (Optional)')" />
                                        <textarea id="description_{{ $year }}" name="description" rows="2"
                                            class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm">{{ old('description') }}</textarea>
                                    </div>
                                    <div class="flex justify-end">
                                        <x-primary-button>{{ __('Add Course') }}</x-primary-button>
                                    </div>
                                </form>
                            </div>

                            {{-- Existing Courses List --}}
                            <h4 class="text-md font-medium text-gray-900 dark:text-gray-100 mb-4">Existing Courses for
                                Year {{ $year }}</h4>
                            @if ($coursesForYear->isNotEmpty())
                                <div class="space-y-4">
                                    @foreach ($coursesForYear as $semester => $semesterCourses)
                                        <div>
                                            <h5 class="font-semibold text-gray-600 dark:text-gray-400 mb-2">Semester
                                                {{ $semester }}</h5>
                                            <div class="space-y-2">
                                                @foreach ($semesterCourses as $course)
                                                    <div
                                                        class="flex justify-between items-center bg-gray-50 dark:bg-gray-700/50 p-3 rounded-md">
                                                        <p class="text-sm font-medium text-gray-900 dark:text-gray-200">
                                                            {{ $course->name }}</p>
                                                        <div class="flex items-center space-x-4">
                                                            <a href="{{ route('admin.courses.edit', $course) }}"
                                                                class="text-sm font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                                                            <form
                                                                action="{{ route('admin.courses.destroy', $course) }}"
                                                                method="POST"
                                                                onsubmit="return confirm('Are you sure?');">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    class="text-sm font-medium text-red-600 dark:text-red-500 hover:underline">Remove</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-gray-500 dark:text-gray-400 text-sm">No courses have been added for Year
                                    {{ $year }} yet.</p>
                            @endif
                        </div>
                    @endfor
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
