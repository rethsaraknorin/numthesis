<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Manage Program: ') }} {{ $program->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">{{ $program->name }} ({{ $program->code }})</h3>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        {{ $program->description ?? 'No description provided.' }}
                    </p>
                    <div class="mt-4">
                        <a href="{{ route('admin.programs.index') }}" class="text-indigo-600 dark:text-indigo-400 hover:underline text-sm">
                            &larr; Back to all programs
                        </a>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-6">
                <h4 class="text-md font-medium text-gray-900 dark:text-gray-100 mb-4">Courses in this Program</h4>
                @if ($program->courses->isNotEmpty())
                    <div class="space-y-4">
                        @foreach ($program->courses->groupBy('year') as $year => $yearCourses)
                            <h5 class="font-semibold text-gray-600 dark:text-gray-400 mt-4">Year {{ $year }}</h5>
                            @foreach ($yearCourses->groupBy('semester') as $semester => $semesterCourses)
                                <h6 class="font-semibold text-gray-500 dark:text-gray-500 ml-4">Semester {{ $semester }}</h6>
                                <ul class="space-y-2 ml-8">
                                    @foreach ($semesterCourses as $course)
                                        <li class="text-sm text-gray-900 dark:text-gray-200">{{ $course->name }}</li>
                                    @endforeach
                                </ul>
                            @endforeach
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-500 dark:text-gray-400 text-sm">No courses have been added to this program yet.</p>
                @endif
            </div>

        </div>
    </div>
</x-admin-layout>