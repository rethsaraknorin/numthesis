<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Manage Key Dates') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if (session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-md" role="alert">
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            {{-- Add New Key Date Form --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">Add New Key Date</h3>
                    <form action="{{ route('admin.key-dates.store') }}" method="POST" class="flex items-end space-x-4">
                        @csrf
                        <div class="flex-grow">
                            <x-input-label for="title" :value="__('Event Title')" />
                            <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" placeholder="e.g., Application Deadline" required />
                        </div>
                        <div>
                            <x-input-label for="date" :value="__('Date')" />
                            <x-text-input id="date" name="date" type="date" class="mt-1 block w-full" required />
                        </div>
                        <x-primary-button>Add Date</x-primary-button>
                    </form>
                </div>
            </div>

            {{-- Existing Key Dates List --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">Existing Dates</h3>
                    <div class="space-y-3">
                        @forelse($keyDates as $keyDate)
                            <div class="flex justify-between items-center bg-gray-50 dark:bg-gray-700/50 p-3 rounded-md">
                                <div>
                                    <p class="font-semibold text-gray-800 dark:text-gray-200">{{ $keyDate->title }}</p>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">{{ \Carbon\Carbon::parse($keyDate->date)->format('F j, Y') }}</p>
                                </div>
                                <div class="flex items-center space-x-4">
                                    <a href="{{ route('admin.key-dates.edit', $keyDate) }}" class="text-sm font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                                    <form action="{{ route('admin.key-dates.destroy', $keyDate) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-sm font-medium text-red-600 dark:text-red-500 hover:underline">Delete</button>
                                    </form>
                                </div>
                            </div>
                        @empty
                            <p class="text-gray-500 dark:text-gray-400">No key dates have been added yet.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>