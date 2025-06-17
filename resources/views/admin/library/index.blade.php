<x-admin-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-700 dark:text-gray-200 leading-tight">
      {{ __('Library Management') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      {{-- Display Success/Error Messages --}}
      @if (session('success'))
      <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-md" role="alert">
        <p>{{ session('success') }}</p>
      </div>
      @endif
      @if (session('error'))
      <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-md" role="alert">
        <p>{{ session('error') }}</p>
      </div>
      @endif

      <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900 dark:text-gray-100">
          <div class="flex justify-between items-center mb-6">
            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
              All Books ({{ $books->total() }})
            </h3>
            <a href="{{ route('admin.library.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500 active:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
              Add New Book
            </a>
          </div>

          {{-- IMPROVED: Books Table --}}
          <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
              <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                  <th scope="col" class="px-6 py-3">Picture</th>
                  <th scope="col" class="px-6 py-3">Title</th>
                  <th scope="col" class="px-6 py-3">Author</th>
                  <th scope="col" class="px-6 py-3">Book Types</th>
                  <th scope="col" class="px-6 py-3 text-center">Actions</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($books as $book)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                  <td class="px-6 py-4">
                    <img src="{{ $book->picture ? asset('storage/' . $book->picture) : 'https://placehold.co/200x280/4A5568/E2E8F0?text=No+Image' }}"
                         alt="Cover of {{ $book->title }}"
                         class="w-12 h-16 object-cover rounded shadow">
                  </td>
                  <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    <div class="flex flex-col">
                        <span>{{ $book->title }}</span>
                        @if($book->book_link)
                            <a href="{{ $book->book_link }}" target="_blank" class="text-xs text-gray-500 dark:text-gray-400 hover:underline">View Book Link</a>
                        @endif
                    </div>
                  </th>
                  <td class="px-6 py-4">{{ $book->author }}</td>
                  <td class="px-6 py-4">
                    @if(!empty($book->book_types))
                        <div class="flex flex-wrap gap-1">
                            @foreach($book->book_types as $type)
                                <span class="bg-gray-100 text-gray-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-300">{{ $type }}</span>
                            @endforeach
                        </div>
                    @else
                      <span class="text-gray-500">N/A</span>
                    @endif
                  </td>
                  <td class="px-6 py-4 text-center">
                    <div class="flex justify-center items-center space-x-3">
                      <a href="{{ route('admin.library.edit', $book) }}"
                        class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                        Edit
                      </a>
                      <form action="{{ route('admin.library.destroy', $book) }}"
                        method="POST"
                        onsubmit="return confirm('Are you sure you want to delete this book?');"
                        class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                          class="font-medium text-red-600 dark:text-red-500 hover:underline">
                          Delete
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
          <div class="mt-6">
            {{ $books->links() }}
          </div>
          @endif
        </div>
      </div>
    </div>
  </div>
</x-admin-layout>
