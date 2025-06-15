<x-admin-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
      {{ __('Library Management') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      {{-- Display Success/Error Messages --}}
      @if (session('success'))
      <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
        <p>{{ session('success') }}</p>
      </div>
      @endif
      @if (session('error'))
      <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
        <p>{{ session('error') }}</p>
      </div>
      @endif

      <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900 dark:text-gray-100">
          <div class="flex justify-between items-center mb-6">
            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
              All Books ({{ $books->count() }})
            </h3>
            <a href="{{ route('admin.library.create') }}"
              class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
              Add New Book
            </a>
          </div>

          {{-- Books Table --}}
          <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
              <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                  <th scope="col" class="px-6 py-3">Picture</th>
                  <th scope="col" class="px-6 py-3">Title</th>
                  <th scope="col" class="px-6 py-3">Author</th>
                  <th scope="col" class="px-6 py-3">Book Link</th>
                  <th scope="col" class="px-6 py-3 text-center">Actions</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($books as $book)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                  <td class="px-6 py-4">
                    @if($book->picture)
                    <img src="{{ asset('storage/' . $book->picture) }}"
                      alt="{{ $book->title }}"
                      class="w-16 h-20 object-cover rounded">
                    @else
                    <div class="w-16 h-20 bg-gray-200 dark:bg-gray-700 rounded flex items-center justify-center">
                      <span class="text-gray-500 dark:text-gray-400 text-xs">No Image</span>
                    </div>
                    @endif
                  </td>
                  <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{ $book->title }}
                  </th>
                  <td class="px-6 py-4">{{ $book->author }}</td>
                  <td class="px-6 py-4">
                    @if($book->book_link)
                    <a href="{{ $book->book_link }}"
                      target="_blank"
                      class="text-blue-600 dark:text-blue-500 hover:underline">
                      View Book
                    </a>
                    @else
                    <span class="text-gray-500">No link available</span>
                    @endif
                  </td>
                  <td class="px-6 py-4 text-center">
                    <div class="flex justify-center space-x-3">
                      <a href="{{ route('admin.library.edit', ['library' => $book->id]) }}"
                        class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                        Edit
                      </a>
                      <form action="{{ route('admin.library.destroy', ['library' => $book->id]) }}"
                        method="POST"
                        onsubmit="return confirm('Are you sure you want to delete this book?');"
                        class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                          class="font-medium text-red-600 dark:text-red-500 hover:underline">
                          Remove
                        </button>
                      </form>
                    </div>
                  </td>
                </tr>
                @empty
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                  <td colspan="5" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                    No books found in the library.
                  </td>
                </tr>
                @endforelse
              </tbody>
            </table>
          </div>

          {{-- Pagination --}}
          @if($books->hasPages())
          <div class="mt-4">
            {{ $books->links() }}
          </div>
          @endif
        </div>
      </div>
    </div>
  </div>
</x-admin-layout>