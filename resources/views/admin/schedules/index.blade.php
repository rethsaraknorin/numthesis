<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Manage Schedules') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">
                        Select a Program
                    </h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-6">
                        Please select an academic program below to view or manage its weekly class schedule.
                    </p>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($programs as $program)
                            <div class="bg-gray-50 dark:bg-gray-700/50 p-6 rounded-lg shadow-md flex flex-col justify-between">
                                <div>
                                    <h4 class="font-bold text-lg text-gray-900 dark:text-white">{{ $program->name }}</h4>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">{{ $program->code }}</p>
                                    <p class="text-xs text-gray-600 dark:text-gray-300 mt-2">{{ $program->class_sessions_count }} scheduled sessions</p>
                                </div>
                                <div class="mt-4">
                                    {{-- UPDATED a:href ROUTE --}}
                                    <a href="{{ route('admin.schedules.selectYear', $program) }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500">
                                        Manage Schedule
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>