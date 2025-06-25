<x-admin-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Manage Schedule for: {{ $program->name }}
            </h2>
             <a href="{{ route('admin.schedules.index') }}" class="text-sm text-indigo-600 dark:text-indigo-400 hover:underline">
                &larr; Back to all programs
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">
                        Select an Academic Year
                    </h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-6">
                        Choose which year's schedule you would like to manage for the {{ $program->name }} program.
                    </p>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                        @for ($i = 1; $i <= 4; $i++)
                            {{-- UPDATED: This link now points to the selectSemester route --}}
                            <a href="{{ route('admin.schedules.selectSemester', ['program' => $program, 'year' => $i]) }}" class="block p-6 bg-gray-50 dark:bg-gray-700/50 rounded-lg shadow-md hover:bg-indigo-100 dark:hover:bg-indigo-900/50 hover:shadow-lg transform hover:-translate-y-1 transition-all duration-300">
                                <div class="text-center">
                                    <p class="text-xl font-bold text-indigo-600 dark:text-indigo-400">Year {{ $i }}</p>
                                    <p class="mt-2 text-sm text-gray-600 dark:text-gray-300">Manage Schedule</p>
                                </div>
                            </a>
                        @endfor
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>