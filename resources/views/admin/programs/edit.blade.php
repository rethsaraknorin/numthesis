<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Academic Program') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('admin.programs.update', $program) }}" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div>
                            <x-input-label for="name" :value="__('Program Name')" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $program->name)" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>
                        <div>
                            <x-input-label for="code" :value="__('Program Code')" />
                            <x-text-input id="code" name="code" type="text" class="mt-1 block w-full" :value="old('code', $program->code)" required />
                            <x-input-error class="mt-2" :messages="$errors->get('code')" />
                        </div>

                        {{-- NEW: Price Inputs --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                             <div>
                                <x-input-label for="price_per_year" :value="__('Price Per Year ($)')" />
                                <x-text-input id="price_per_year" name="price_per_year" type="number" step="0.01" class="mt-1 block w-full" :value="old('price_per_year', $program->price_per_year)" placeholder="e.g., 2500.00" />
                                <x-input-error class="mt-2" :messages="$errors->get('price_per_year')" />
                            </div>
                             <div>
                                <x-input-label for="price_per_semester" :value="__('Price Per Semester ($)')" />
                                <x-text-input id="price_per_semester" name="price_per_semester" type="number" step="0.01" class="mt-1 block w-full" :value="old('price_per_semester', $program->price_per_semester)" placeholder="e.g., 1250.00" />
                                <x-input-error class="mt-2" :messages="$errors->get('price_per_semester')" />
                            </div>
                        </div>

                        <div>
                            <x-input-label for="description" :value="__('Description')" />
                            <textarea id="description" name="description" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" rows="4">{{ old('description', $program->description) }}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('description')" />
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Update Program') }}</x-primary-button>
                            <a href="{{ route('admin.programs.index') }}" class="text-gray-600 dark:text-gray-400 hover:underline">
                                {{ __('Cancel') }}
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>