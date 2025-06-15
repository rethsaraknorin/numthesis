<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Digital Library') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-md" role="alert">
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @forelse ($books as $book)
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
                        <img src="{{ $book->picture ? asset('storage/' . $book->picture) : 'https://placehold.co/600x400/4A5568/E2E8F0?text=No+Image' }}" alt="Cover of {{ $book->title }}" class="w-full h-48 object-cover">
                        <div class="p-4">
                            <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100">{{ $book->title }}</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">by {{ $book->author }}</p>
                            
                            <div class="mt-4">
                                @if(auth()->user()->books->contains($book))
                                    <form action="{{ route('library.unsave', $book) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-full text-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500">
                                            Unsave
                                        </button>
                                    </form>
                                @else
                                    <form action="{{ route('library.save', $book) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="w-full text-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500">
                                            Save to Dashboard
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-500 dark:text-gray-400 col-span-full">No books are available in the library at the moment.</p>
                @endforelse
            </div>

            @if($books->hasPages())
                <div class="mt-8">
                    {{ $books->links() }}
                </div>
            @endif

        </div>
    </div>
</x-app-layout>