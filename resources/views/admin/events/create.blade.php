<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create New Event') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('admin.events.store') }}" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        <div>
                            <x-input-label for="title" :value="__('Event Title')" />
                            <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title')" required />
                        </div>
                        <div>
                            <x-input-label for="date" :value="__('Event Date')" />
                            <x-text-input id="date" name="date" type="date" class="mt-1 block w-full" :value="old('date')" required />
                        </div>
                        <div>
                            <x-input-label for="description" :value="__('Description')" />
                            {{-- UPDATED: Textarea now auto-resizes --}}
                            <textarea
                                x-data="{
                                    resize: () => { $el.style.height = '120px'; $el.style.height = $el.scrollHeight + 'px' }
                                }"
                                x-init="resize()"
                                @input="resize"
                                id="description"
                                name="description"
                                class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm overflow-hidden"
                                style="resize: none;"
                            >{{ old('description') }}</textarea>
                        </div>
                        <div>
                            <x-input-label for="image" :value="__('Event Image (Optional)')" />
                            <input id="image" name="image" type="file" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                        </div>
                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Save Event') }}</x-primary-button>
                            <a href="{{ route('admin.events.index') }}" class="text-gray-600 dark:text-gray-400 hover:underline">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
