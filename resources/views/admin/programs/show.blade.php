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
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">{{ $program->name }} ({{ $program->code }})</h3>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        {{ $program->description ?? 'No description provided.' }}
                    </p>
                </div>
            </div>

            {{-- Add New Course Form --}}
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Add New Course</h3>
                    <form method="POST" action="{{ route('admin.programs.courses.store', $program) }}" class="mt-6 space-y-6">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <x-input-label for="name" :value="__('Course Name')" />
                                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name')" required />
                                <x-input-error class="mt-2" :messages="$errors->get('name')" />
                            </div>
                             <div>
                                <x-input-label for="year" :value="__('Year')" />
                                <select id="year" name="year" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                    <option value="1">Year 1</option>
                                    <option value="2">Year 2</option>
                                    <option value="3">Year 3</option>
                                    <option value="4">Year 4</option>
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('year')" />
                            </div>
                            <div>
                                <x-input-label for="semester" :value="__('Semester')" />
                                <select id="semester" name="semester" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                    <option value="1">Semester 1</option>
                                    <option value="2">Semester 2</option>
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('semester')" />
                            </div>
                        </div>
                        <div>
                            <x-input-label for="description" :value="__('Course Description')" />
                            <textarea id="description" name="description" rows="3" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">{{ old('description') }}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('description')" />
                        </div>
                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Add Course') }}</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Existing Courses List --}}
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">
                    Courses for {{ $program->name }}
                </h3>
                <div class="space-y-4">
                     @forelse($program->courses->groupBy('year') as $year => $courses)
                        <div class="p-4 border dark:border-gray-700 rounded-lg">
                             <h4 class="text-md font-semibold text-gray-800 dark:text-gray-200 mb-2">Year {{ $year }}</h4>
                            <div class="divide-y dark:divide-gray-700">
                                @foreach($courses->groupBy('semester') as $semester => $semesterCourses)
                                     <div class="py-2">
                                        <h5 class="text-sm font-semibold text-gray-600 dark:text-gray-400">Semester {{ $semester }}</h5>
                                        <ul class="list-inside mt-1 space-y-1">
                                             @foreach($semesterCourses as $course)
                                                <li class="text-gray-700 dark:text-gray-300 flex justify-between items-center">
                                                    <span>{{ $course->name }}</span>
                                                    <div class="flex items-center space-x-3">
                                                        {{-- ADDED EDIT LINK --}}
                                                        <a href="{{ route('admin.courses.edit', $course) }}" class="text-xs text-blue-500 hover:underline">Edit</a>
                                                        <form action="{{ route('admin.courses.destroy', $course) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="text-xs text-red-500 hover:underline">Remove</button>
                                                        </form>
                                                    </div>
                                                </li>
                                             @endforeach
                                        </ul>
                                     </div>
                                @endforeach
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-500 dark:text-gray-400">No courses have been added to this program yet.</p>
                    @endforelse
                </div>
                 <div class="mt-6">
                    <a href="{{ route('admin.programs.index') }}" class="text-indigo-600 dark:text-indigo-400 hover:underline">
                        &larr; Back to all programs
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
