<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add New Course') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('admin.courses.store') }}" class="space-y-6">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <x-input-label for="name" :value="__('Course Name')" />
                                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name')" required autofocus />
                            </div>
                            <div>
                                <x-input-label for="program_id" :value="__('Program')" />
                                <select id="program_id" name="program_id" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm">
                                    @foreach($programs as $program)
                                        <option value="{{ $program->id }}">{{ $program->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <x-input-label for="year" :value="__('Year')" />
                                <x-text-input id="year" name="year" type="number" class="mt-1 block w-full" :value="old('year')" required />
                            </div>
                            <div>
                                <x-input-label for="semester" :value="__('Semester')" />
                                <x-text-input id="semester" name="semester" type="number" class="mt-1 block w-full" :value="old('semester')" required />
                            </div>
                             <div>
                                <x-input-label for="credits" :value="__('Credits')" />
                                <x-text-input id="credits" name="credits" type="number" class="mt-1 block w-full" :value="old('credits')" />
                            </div>
                            <div>
                                <x-input-label for="hours" :value="__('Hours')" />
                                <x-text-input id="hours" name="hours" type="number" class="mt-1 block w-full" :value="old('hours')" />
                            </div>
                        </div>

                        <div>
                            <x-input-label for="description" :value="__('Description')" />
                            <textarea id="description" name="description" rows="4" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm">{{ old('description') }}</textarea>
                        </div>
                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Save Course') }}</x-primary-button>
                            <a href="{{ route('admin.courses.index') }}" class="text-gray-600 dark:text-gray-400 hover:underline">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>