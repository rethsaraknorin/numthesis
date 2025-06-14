<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            {{-- Grid for the summary cards --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

                <!-- Total Users Card -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h3 class="text-lg font-medium text-gray-500 dark:text-gray-400">Total Users</h3>
                        <p class="mt-1 text-3xl font-semibold">
                            {{ $users->count() }}
                        </p>
                    </div>
                </div>

                <!-- Total Program Card (Placeholder) -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h3 class="text-lg font-medium text-gray-500 dark:text-gray-400">Total Program</h3>
                        <p class="mt-1 text-3xl font-semibold">
                            0 <!-- Replace with actual data later -->
                        </p>
                    </div>
                </div>

                <!-- Total Job Opportunity Card (Placeholder) -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h3 class="text-lg font-medium text-gray-500 dark:text-gray-400">Total Job Opportunity</h3>
                        <p class="mt-1 text-3xl font-semibold">
                            0 <!-- Replace with actual data later -->
                        </p>
                    </div>
                </div>

                <!-- Total Book Card (Placeholder) -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h3 class="text-lg font-medium text-gray-500 dark:text-gray-400">Total Book</h3>
                        <p class="mt-1 text-3xl font-semibold">
                            0 <!-- Replace with actual data later -->
                        </p>
                    </div>
                </div>

            </div>

        </div>
    </div>
</x-admin-layout>
