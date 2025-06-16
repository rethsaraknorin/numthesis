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
          <form method="POST" action="{{ route('admin.library.update', ['library' => $book->id]) }}" class="space-y-6" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
              <div>
                <x-input-label for="title" :value="__('Title')" />
                <x-text-input id="title" name="title" type="text" class="mt-1 block w-full"
                  :value="old('title', $book->title)" required autofocus />
                <x-input-error class="mt-2" :messages="$errors->get('title')" />
              </div>

              <div>
                <x-input-label for="author" :value="__('Author')" />
                <x-text-input id="author" name="author" type="text" class="mt-1 block w-full"
                  :value="old('author', $book->author)" required />
                <x-input-error class="mt-2" :messages="$errors->get('author')" />
              </div>

              <div>
                <x-input-label for="book_link" :value="__('Book Link')" />
                <x-text-input id="book_link" name="book_link" type="url" class="mt-1 block w-full"
                  :value="old('book_link', $book->book_link)" placeholder="https://" />
                <x-input-error class="mt-2" :messages="$errors->get('book_link')" />
              </div>

              <div>
                <x-input-label for="picture" :value="__('Book Cover')" />
                @if($book->picture)
                <div class="mb-2">
                  <img src="{{ asset('storage/' . $book->picture) }}"
                    alt="{{ $book->title }}"
                    class="w-32 h-40 object-cover rounded">
                </div>
                @endif
                <input type="file" id="picture" name="picture" accept="image/*"
                  class="mt-1 block w-full text-sm text-gray-900 dark:text-gray-300
                                       file:mr-4 file:py-2 file:px-4
                                       file:rounded-md file:border-0
                                       file:text-sm file:font-semibold
                                       file:bg-indigo-50 file:text-indigo-700
                                       hover:file:bg-indigo-100
                                       dark:file:bg-gray-700 dark:file:text-gray-200" />
                <x-input-error class="mt-2" :messages="$errors->get('picture')" />
              </div>

              <div>
                <x-input-label for="publisher" :value="__('Publisher')" />
                <x-text-input id="publisher" name="publisher" type="text" class="mt-1 block w-full"
                  :value="old('publisher', $book->publisher)" />
                <x-input-error class="mt-2" :messages="$errors->get('publisher')" />
              </div>

              <div>
                <x-input-label for="publication_year" :value="__('Publication Year')" />
                <x-text-input id="publication_year" name="publication_year" type="number"
                  min="1800" max="{{ date('Y') }}" class="mt-1 block w-full"
                  :value="old('publication_year', $book->publication_year)" required />
                <x-input-error class="mt-2" :messages="$errors->get('publication_year')" />
              </div>
              
              <div class="md:col-span-2">
                <x-input-label for="book_types" :value="__('Book Types (comma-separated)')" />
                @php
                  // Ensure book_types is an array before imploding
                  $types_string = '';
                  if (!empty($book->book_types)) {
                      $types_array = is_array($book->book_types) ? $book->book_types : json_decode($book->book_types, true);
                      $types_string = implode(', ', $types_array ?? []);
                  }
                @endphp
                <x-text-input id="book_types" name="book_types" type="text" class="mt-1 block w-full"
                  :value="old('book_types', $types_string)" placeholder="e.g. Fiction, Non-Fiction, Sci-Fi" />
                <x-input-error class="mt-2" :messages="$errors->get('book_types')" />
              </div>
            </div>

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