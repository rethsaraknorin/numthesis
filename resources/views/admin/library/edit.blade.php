<x-admin-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
      {{ __('Edit Book') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900 dark:text-gray-100">
          <form method="POST" action="{{ route('admin.library.update', $book) }}" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
              <!-- Title -->
              <div>
                <x-input-label for="title" :value="__('Title')" />
                <x-text-input id="title" name="title" type="text" class="mt-1 block w-full"
                  :value="old('title', $book->title)" required autofocus />
                <x-input-error class="mt-2" :messages="$errors->get('title')" />
              </div>

              <!-- Author -->
              <div>
                <x-input-label for="author" :value="__('Author')" />
                <x-text-input id="author" name="author" type="text" class="mt-1 block w-full"
                  :value="old('author', $book->author)" required />
                <x-input-error class="mt-2" :messages="$errors->get('author')" />
              </div>

              <!-- ISBN -->
              <div>
                <x-input-label for="isbn" :value="__('ISBN')" />
                <x-text-input id="isbn" name="isbn" type="text" class="mt-1 block w-full"
                  :value="old('isbn', $book->isbn)" required />
                <x-input-error class="mt-2" :messages="$errors->get('isbn')" />
              </div>

              <!-- Publisher -->
              <div>
                <x-input-label for="publisher" :value="__('Publisher')" />
                <x-text-input id="publisher" name="publisher" type="text" class="mt-1 block w-full"
                  :value="old('publisher', $book->publisher)" />
                <x-input-error class="mt-2" :messages="$errors->get('publisher')" />
              </div>

              <!-- Publication Year -->
              <div>
                <x-input-label for="publication_year" :value="__('Publication Year')" />
                <x-text-input id="publication_year" name="publication_year" type="number"
                  min="1800" max="{{ date('Y') }}" class="mt-1 block w-full"
                  :value="old('publication_year', $book->publication_year)" required />
                <x-input-error class="mt-2" :messages="$errors->get('publication_year')" />
              </div>

              <!-- Copies Available -->
              <div>
                <x-input-label for="copies_available" :value="__('Copies Available')" />
                <x-text-input id="copies_available" name="copies_available" type="number"
                  min="0" class="mt-1 block w-full"
                  :value="old('copies_available', $book->copies_available)" required />
                <x-input-error class="mt-2" :messages="$errors->get('copies_available')" />
              </div>

              <!-- Status -->
              <div>
                <x-input-label for="status" :value="__('Status')" />
                <select id="status" name="status" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                  <option value="available" {{ old('status', $book->status) == 'available' ? 'selected' : '' }}>Available</option>
                  <option value="borrowed" {{ old('status', $book->status) == 'borrowed' ? 'selected' : '' }}>Borrowed</option>
                  <option value="maintenance" {{ old('status', $book->status) == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                </select>
                <x-input-error class="mt-2" :messages="$errors->get('status')" />
              </div>
            </div>

            <!-- Description -->
            <div>
              <x-input-label for="description" :value="__('Description')" />
              <textarea id="description" name="description"
                class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                rows="4">{{ old('description', $book->description) }}</textarea>
              <x-input-error class="mt-2" :messages="$errors->get('description')" />
            </div>

            <div class="flex items-center gap-4">
              <x-primary-button>{{ __('Update Book') }}</x-primary-button>
              <a href="{{ route('admin.library.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                {{ __('Cancel') }}
              </a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</x-admin-layout>