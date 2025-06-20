<x-admin-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
      {{ __('Add New Book') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900 dark:text-gray-100">
          <form method="POST" action="{{ route('admin.library.store') }}" class="space-y-6"
            enctype="multipart/form-data">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
              <div>
                <x-input-label for="title" :value="__('Title')" />
                <x-text-input id="title" name="title" type="text" class="mt-1 block w-full"
                  :value="old('title')" required autofocus />
                <x-input-error class="mt-2" :messages="$errors->get('title')" />
              </div>

              <div>
                <x-input-label for="author" :value="__('Author')" />
                <x-text-input id="author" name="author" type="text" class="mt-1 block w-full"
                  :value="old('author')" required />
                <x-input-error class="mt-2" :messages="$errors->get('author')" />
              </div>

              <div>
                <x-input-label for="book_link" :value="__('Book Link')" />
                <x-text-input id="book_link" name="book_link" type="url" class="mt-1 block w-full"
                  :value="old('book_link')" placeholder="https://" />
                <x-input-error class="mt-2" :messages="$errors->get('book_link')" />
              </div>

              <div>
                <x-input-label for="picture" :value="__('Book Cover')" />
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
                  :value="old('publisher')" />
                <x-input-error class="mt-2" :messages="$errors->get('publisher')" />
              </div>

              <div>
                <x-input-label for="publication_year" :value="__('Publication Year')" />
                <x-text-input id="publication_year" name="publication_year" type="number"
                  min="1800" max="{{ date('Y') }}" class="mt-1 block w-full"
                  :value="old('publication_year')" required />
                <x-input-error class="mt-2" :messages="$errors->get('publication_year')" />
              </div>

              {{-- UPDATED: Multi-select dropdown for Book Types --}}
              <div class="md:col-span-2" x-data="multiSelect({ allOptions: {{ json_encode($bookTypes) }}, selectedOptions: {{ json_encode(old('book_types', [])) }} })" @click.away="open = false">
                  <x-input-label for="book_types" :value="__('Book Types')" />
                  <template x-for="option in selectedOptions" :key="option">
                      <input type="hidden" name="book_types[]" :value="option">
                  </template>
                  <div class="relative mt-1">
                      <div class="w-full flex border border-gray-300 dark:border-gray-700 rounded-md bg-white dark:bg-gray-900">
                          <div class="flex flex-wrap gap-2 p-2 flex-grow">
                              <template x-for="option in selectedOptions" :key="option">
                                  <span class="inline-flex items-center px-2 py-1 bg-indigo-100 text-indigo-800 text-sm font-medium rounded dark:bg-indigo-900 dark:text-indigo-300">
                                      <span x-text="option"></span>
                                      <button @click.prevent="deselect(option)" type="button" class="ms-1.5 flex-shrink-0 text-indigo-500 hover:text-indigo-700">
                                          <svg class="h-3 w-3" stroke="currentColor" fill="none" viewBox="0 0 8 8"><path stroke-linecap="round" stroke-width="1.5" d="M1 1l6 6m0-6L1 7" /></svg>
                                      </button>
                                  </span>
                              </template>
                              <input x-ref="newOptionInput" x-model="newOption" @input="filterOptions" @focus="open = true" class="flex-grow bg-transparent border-0 focus:ring-0 p-1" placeholder="Add or select a type...">
                          </div>
                          <button @click.prevent="open = !open" type="button" class="flex-shrink-0 px-2">
                            <svg class="w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" /></svg>
                          </button>
                      </div>
                      <div x-show="open" class="absolute z-10 w-full mt-1 bg-white dark:bg-gray-800 shadow-lg max-h-60 rounded-md py-1 text-base ring-1 ring-black ring-opacity-5 overflow-auto focus:outline-none sm:text-sm" x-cloak>
                          <template x-for="option in filteredOptions" :key="option">
                              <div @click="select(option)" class="cursor-pointer select-none relative py-2 ps-3 pe-9 text-gray-900 dark:text-gray-200 hover:bg-indigo-500 hover:text-white">
                                  <span class="block truncate" x-text="option"></span>
                              </div>
                          </template>
                          <div x-show="newOption && !allOptions.includes(newOption) && !selectedOptions.includes(newOption)" @click="addNew" class="cursor-pointer select-none relative py-2 ps-3 pe-9 text-gray-700 dark:text-gray-400 hover:bg-indigo-500 hover:text-white">
                              Create "<span x-text="newOption"></span>"
                          </div>
                      </div>
                  </div>
                  <x-input-error class="mt-2" :messages="$errors->get('book_types')" />
              </div>

            </div>

            <div>
              <x-input-label for="description" :value="__('Description')" />
              <textarea id="description" name="description"
                class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                rows="4">{{ old('description') }}</textarea>
              <x-input-error class="mt-2" :messages="$errors->get('description')" />
            </div>

            <div class="flex items-center gap-4">
              <x-primary-button>{{ __('Add Book') }}</x-primary-button>
              <a href="{{ route('admin.library.index') }}" class="text-sm text-gray-600 dark:text-gray-400 hover:underline">
                {{ __('Cancel') }}
              </a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script>
    function multiSelect(config) {
      return {
        allOptions: config.allOptions || [],
        selectedOptions: config.selectedOptions || [],
        newOption: '',
        filteredOptions: [],
        open: false,
        init() {
            this.filteredOptions = this.allOptions.filter(opt => !this.selectedOptions.includes(opt));
        },
        deselect(option) {
            this.selectedOptions = this.selectedOptions.filter(item => item !== option);
            this.filterOptions();
        },
        select(option) {
            if (!this.isSelected(option)) {
                this.selectedOptions.push(option);
            }
            this.newOption = '';
            this.open = false;
            this.filterOptions();
        },
        addNew() {
            const newOpt = this.newOption.trim();
            if (newOpt && !this.allOptions.includes(newOpt) && !this.selectedOptions.includes(newOpt)) {
                this.allOptions.push(newOpt);
                this.selectedOptions.push(newOpt);
            }
            this.newOption = '';
            this.open = false;
            this.filterOptions();
        },
        filterOptions() {
            this.filteredOptions = this.allOptions.filter(option => {
                return !this.selectedOptions.includes(option) && option.toLowerCase().includes(this.newOption.toLowerCase());
            });
        },
        isSelected(option) {
            return this.selectedOptions.includes(option);
        }
      }
    }
  </script>
</x-admin-layout>
