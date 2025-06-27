<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Digital Library') }}
        </h2>
    </x-slot>

    <div class="py-12">
        {{-- Alpine.js component for the dynamic library --}}
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8"
             x-data="library({ bookTypes: {{ json_encode($bookTypes) }} })"
             x-init="fetchBooks()">

            @if (session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-md" role="alert">
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            <div class="mb-8 p-4 bg-white dark:bg-gray-800 rounded-lg shadow-md">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end">
                    <div class="md:col-span-2">
                        <label for="search" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Search by Title or Author') }}</label>
                        <div class="mt-1 relative rounded-md shadow-sm">
                             <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                 <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <input type="text" name="search" id="search"
                                   class="block w-full pl-10 sm:text-sm border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 focus:ring-indigo-500 focus:border-indigo-500 rounded-md"
                                   placeholder="e.g. Laravel, Final Thesis, etc."
                                   x-model.debounce.500ms="searchQuery"
                                   @input.debounce.500ms="fetchBooks()">
                        </div>
                    </div>
                    <div>
                        <label for="type" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Filter by Type') }}</label>
                        <select id="type" name="type"
                                class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md"
                                x-model="filterType"
                                @change="fetchBooks()">
                            <option value="">{{ __('All Types') }}</option>
                            <template x-for="type in allBookTypes" :key="type">
                                <option :value="type" x-text="type"></option>
                            </template>
                        </select>
                    </div>
                </div>
            </div>

            {{-- Loading Spinner --}}
            <template x-if="isLoading">
                <div class="flex justify-center items-center p-10">
                    <svg class="animate-spin -ml-1 mr-3 h-10 w-10 text-gray-700 dark:text-gray-200" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <span class="text-lg text-gray-600 dark:text-gray-400">Loading Books...</span>
                </div>
            </template>
            
            {{-- Grouped Books Display --}}
            <div x-show="!isLoading" class="space-y-12">
                <template x-for="(books, type) in groupedBooks" :key="type">
                    <div class="bg-white dark:bg-gray-800/50 rounded-lg shadow-md overflow-hidden">
                        <div class="p-6">
                            <h3 class="text-2xl font-bold text-gray-900 dark:text-white border-b border-gray-200 dark:border-gray-700 pb-3 mb-6" x-text="type"></h3>
                            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-6">
                                <template x-for="book in books" :key="book.id">
                                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden flex flex-col group transition-all duration-300 hover:shadow-2xl hover:-translate-y-2">
                                        <button @click="selectedBook = book; isModalOpen = true" class="block w-full text-left">
                                            <div class="relative">
                                                <img class="aspect-[4/5] w-full object-cover" :src="book.picture ? '/storage/' + book.picture : 'https://placehold.co/400x500/4A5568/E2E8F0?text=No+Image'" :alt="'Cover of ' + book.title">
                                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                                            </div>
                                        </button>
                                        <div class="p-4 flex flex-col flex-grow">
                                            <h4 class="text-md font-bold text-gray-900 dark:text-gray-100 truncate" x-text="book.title"></h4>
                                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1" x-text="'by ' + book.author"></p>
                                            <div class="mt-auto pt-4">
                                                <template x-if="book.users.length > 0">
                                                    <form :action="'/dashboard/library/' + book.id + '/unsave'" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="w-full text-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition">
                                                            {{ __('Unsave') }}
                                                        </button>
                                                    </form>
                                                </template>
                                                <template x-if="book.users.length === 0">
                                                    <form :action="'/dashboard/library/' + book.id + '/save'" method="POST">
                                                        @csrf
                                                        <button type="submit" class="w-full text-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition">
                                                            {{ __('Save to Dashboard') }}
                                                        </button>
                                                    </form>
                                                </template>
                                            </div>
                                        </div>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </div>
                </template>
            </div>

            {{-- Message for no results --}}
            <template x-if="!isLoading && Object.keys(groupedBooks).length === 0">
                 <div class="text-center text-gray-500 dark:text-gray-400 col-span-full py-10 bg-white dark:bg-gray-800 rounded-lg shadow-md">
                    <p class="text-lg font-semibold">No Books Found</p>
                    <p class="mt-1">No books match your current search criteria.</p>
                 </div>
            </template>
            
            <div
                x-show="isModalOpen"
                x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-75 p-4"
                x-cloak
            >
                <div @click.away="isModalOpen = false" class="relative bg-white dark:bg-gray-800 rounded-lg shadow-xl overflow-hidden max-w-4xl w-full">
                    <template x-if="selectedBook">
                        <div class="md:flex">
                            {{-- UPDATED: Added padding around the image --}}
                            <div class="md:flex-shrink-0 p-8 bg-gray-100 dark:bg-gray-900/50">
                                <img class="rounded-lg shadow-lg h-96 w-full object-cover md:w-64" :src="selectedBook.picture ? '/storage/' + selectedBook.picture : 'https://placehold.co/400x600/4A5568/E2E8F0?text=No+Image'" :alt="'Cover of ' + selectedBook.title">
                            </div>
                            <div class="p-8 flex flex-col justify-between flex-grow">
                                <div>
                                    <h2 class="text-3xl font-bold text-gray-900 dark:text-white" x-text="selectedBook.title"></h2>
                                    <p class="mt-2 text-lg text-gray-600 dark:text-gray-400" x-text="'by ' + selectedBook.author"></p>
                                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-500">
                                        Published by <span x-text="selectedBook.publisher || 'N/A'"></span> in <span x-text="selectedBook.publication_year"></span>
                                    </p>
                                    <p class="mt-4 text-gray-700 dark:text-gray-300 max-h-32 overflow-y-auto" x-text="selectedBook.description || 'No description available.'"></p>
                                </div>
                                <div class="mt-6 flex flex-wrap gap-2">
                                    <template x-for="type in selectedBook.book_types" :key="type">
                                        <span class="inline-block bg-indigo-100 text-indigo-800 dark:bg-indigo-900/50 dark:text-indigo-300 rounded-full px-3 py-1 text-sm font-semibold" x-text="type"></span>
                                    </template>
                                </div>
                                <div class="mt-6 flex gap-4">
                                    <a :href="selectedBook.book_link" x-show="selectedBook.book_link" target="_blank" class="flex-1 text-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 focus:outline-none">Read Now</a>
                                </div>
                            </div>
                        </div>
                    </template>
                    {{-- UPDATED: Close button moved to top right --}}
                    <button @click="isModalOpen = false" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 dark:hover:text-gray-200">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>
            </div>

        </div>
    </div>

    <script>
        function library(config) {
            return {
                isLoading: true,
                groupedBooks: {},
                searchQuery: '',
                filterType: '',
                allBookTypes: config.bookTypes || [],
                baseUrl: '{{ route('api.books.index') }}',
                isModalOpen: false,
                selectedBook: null,

                fetchBooks() {
                    this.isLoading = true;
                    const params = new URLSearchParams();
                    if (this.searchQuery) {
                        params.append('search', this.searchQuery);
                    }
                    if (this.filterType) {
                        params.append('type', this.filterType);
                    }
                    
                    const url = `${this.baseUrl}?${params.toString()}`;

                    fetch(url)
                        .then(response => response.json())
                        .then(data => {
                            this.groupedBooks = data;
                            this.isLoading = false;
                        })
                        .catch(error => {
                            this.isLoading = false;
                            console.error('Error fetching books:', error);
                        });
                }
            }
        }
    </script>
</x-app-layout>