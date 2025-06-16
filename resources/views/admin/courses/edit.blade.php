<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Course') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('admin.courses.update', $course) }}" class="space-y-6">
                        @csrf
                        @method('PUT')

                        {{-- Course Name --}}
                        <div>
                            <x-input-label for="name" :value="__('Course Name')" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $course->name)" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>

                        {{-- Year and Semester --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <x-input-label for="year" :value="__('Year')" />
                                <select id="year" name="year" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm">
                                    <option value="1" @selected(old('year', $course->year) == 1)>Year 1</option>
                                    <option value="2" @selected(old('year', $course->year) == 2)>Year 2</option>
                                    <option value="3" @selected(old('year', $course->year) == 3)>Year 3</option>
                                    <option value="4" @selected(old('year', $course->year) == 4)>Year 4</option>
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('year')" />
                            </div>
                             <div>
                                <x-input-label for="semester" :value="__('Semester')" />
                                <select id="semester" name="semester" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm">
                                    <option value="1" @selected(old('semester', $course->semester) == 1)>Semester 1</option>
                                    <option value="2" @selected(old('semester', $course->semester) == 2)>Semester 2</option>
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('semester')" />
                            </div>
                        </div>

                        {{-- Description --}}
                        <div>
                            <x-input-label for="description" :value="__('Course Description')" />
                            <textarea id="description" name="description" rows="3" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm">{{ old('description', $course->description) }}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('description')" />
                        </div>

                        {{-- Action Buttons --}}
                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Update Course') }}</x-primary-button>
                            <a href="{{ route('admin.programs.show', $course->program_id) }}" class="text-gray-600 dark:text-gray-400 hover:underline">
                                {{ __('Cancel') }}
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
