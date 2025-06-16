<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Digital Library') }}
        </h2>
    </x-slot>

    {{-- Custom styles for enhanced card appearance --}}
    <style>
        .book-card {
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        }
        .book-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1);
        }
        .book-card-image {
            position: relative;
            padding-top: 100%; /* 1:1 Aspect Ratio */
        }
        .book-card-image img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
    </style>

    <div class="py-12">
        {{-- Alpine.js component for the dynamic library --}}
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8"
             x-data="library()"
             x-init="init()">

            @if (session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-md" role="alert">
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            <!-- Search and Filter Controls -->
            <div class="mb-8 p-4 bg-white dark:bg-gray-800/50 backdrop-blur-sm rounded-lg shadow-sm">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end">
                    <!-- Search Input -->
                    <div class="md:col-span-2">
                        <label for="search" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Search by Title or Author') }}</label>
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                 <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <input type="text" name="search" id="search"
                                   class="block w-full pl-10 sm:text-sm border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-300 focus:ring-indigo-500 focus:border-indigo-500 rounded-md"
                                   placeholder="e.g. Laravel, AI, etc."
                                   x-model.debounce.500ms="searchQuery"
                                   @input.debounce.500ms="applyFilters()">
                        </div>
                    </div>
                    <!-- Filter by Type Dropdown -->
                    <div>
                        <label for="type" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Filter by Type') }}</label>
                        <select id="type" name="type"
                                class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md"
                                x-model="filterType"
                                @change="applyFilters()">
                            <option value="">{{ __('All Types') }}</option>
                            <template x-for="type in bookTypes" :key="type">
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

            {{-- Books Grid --}}
            <div x-show="!isLoading" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                <template x-for="book in books" :key="book.id">
                    <div class="book-card bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden flex flex-col group">
                        <div class="book-card-image">
                            <img :src="book.picture ? '/storage/' + book.picture : 'https://placehold.co/400/4A5568/E2E8F0?text=No+Image'" :alt="'Cover of ' + book.title">
                        </div>
                        <div class="p-5 flex flex-col flex-grow">
                            <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100" x-text="book.title"></h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1" x-text="'by ' + book.author"></p>

                            <div class="mt-3 flex flex-wrap gap-2 min-h-[28px]">
                                <template x-for="type in book.book_types" :key="type">
                                    <span class="inline-block bg-gray-200 dark:bg-gray-700 rounded-full px-3 py-1 text-xs font-semibold text-gray-700 dark:text-gray-200" x-text="type"></span>
                                </template>
                            </div>

                            <div class="mt-auto pt-4">
                                {{-- Conditionally show Save or Unsave button --}}
                                <template x-if="book.users.length > 0">
                                    <form :action="'/library/' + book.id + '/unsave'" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-full px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition">
                                            {{ __('Unsave') }}
                                        </button>
                                    </form>
                                </template>
                                <template x-if="book.users.length === 0">
                                    <form :action="'/library/' + book.id + '/save'" method="POST">
                                        @csrf
                                        <button type="submit" class="w-full px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition">
                                            {{ __('Save to Dashboard') }}
                                        </button>
                                    </form>
                                </template>
                            </div>
                        </div>
                    </div>
                </template>
            </div>

            {{-- Message for no results --}}
            <template x-if="!isLoading && books.length === 0">
                 <p class="text-center text-gray-500 dark:text-gray-400 col-span-full py-10">No books match your search criteria.</p>
            </template>

            {{-- Pagination --}}
            <div class="mt-8 flex justify-between items-center" x-show="!isLoading && pagination.total > 0 && pagination.last_page > 1">
                <button @click="fetchBooks(pagination.prev_page_url)" :disabled="!pagination.prev_page_url" class="px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white disabled:opacity-25 transition">
                    {{ __('Previous') }}
                </button>
                <span class="text-sm text-gray-700 dark:text-gray-300" x-text="`{{ __('Page :current of :last', ['current' => '${pagination.current_page}', 'last' => '${pagination.last_page}']) }}`"></span>
                <button @click="fetchBooks(pagination.next_page_url)" :disabled="!pagination.next_page_url" class="px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white disabled:opacity-25 transition">
                    {{ __('Next') }}
                </button>
            </div>
        </div>
    </div>

    <script>
        function library() {
            return {
                isLoading: true,
                books: [],
                pagination: {},
                searchQuery: '',
                filterType: '',
                bookTypes: [],
                baseUrl: '{{ route('api.books.index') }}',

                init() {
                    this.fetchBookTypes();
                    this.applyFilters();
                },

                fetchBookTypes() {
                    fetch('{{ route('api.books.types') }}')
                        .then(response => response.json())
                        .then(data => {
                            this.bookTypes = data;
                        });
                },

                applyFilters() {
                    const params = new URLSearchParams();
                    if (this.searchQuery) {
                        params.append('search', this.searchQuery);
                    }
                    if (this.filterType) {
                        params.append('type', this.filterType);
                    }
                    this.fetchBooks(`${this.baseUrl}?${params.toString()}`);
                },

                fetchBooks(url) {
                    if (!url) return;
                    this.isLoading = true;
                    fetch(url)
                        .then(response => {
                            if (!response.ok) throw new Error('Network response was not ok');
                            return response.json();
                        })
                        .then(data => {
                            this.books = data.data;
                            delete data.data;
                            this.pagination = data;
                            this.isLoading = false;
                        })
                        .catch(error => {
                            this.isLoading = false;
                            console.error('Error fetching books from the API:', error);
                        });
                }
            }
        }
    </script>
</x-app-layout>