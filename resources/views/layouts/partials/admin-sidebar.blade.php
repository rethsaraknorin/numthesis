{{-- Sidebar content --}}
<div class="py-4 px-6">
    {{-- Logo --}}
    <a href="{{ route('dashboard') }}" class="flex items-center text-xl font-semibold text-gray-900 dark:text-white">
        <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
        <span class="ml-3">{{ config('app.name', 'Laravel') }}</span>
    </a>

    {{-- Navigation Links --}}
    <nav class="mt-6">
        <div>
            {{-- Dashboard Link --}}
            <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                {{ __('Dashboard') }}
            </x-nav-link>
        </div>

        {{-- Example Dropdown Menu --}}
        <div x-data="{ open: false }" class="mt-4">
            <button @click="open = !open" class="w-full flex justify-between items-center py-2 px-4 text-sm font-medium text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg focus:outline-none focus:ring">
                <span class="flex items-center">
                    {{-- You can add an icon here if you like --}}
                    <span>Management</span>
                </span>
                <svg class="h-5 w-5 transform transition-transform duration-200" :class="{'rotate-180': open}" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </button>
            <div x-show="open" x-cloak class="mt-2 pl-7 space-y-2" x-transition>
                <x-nav-link href="#" :active="request()->routeIs('admin.users.*')">
                    {{ __('Users') }}
                </x-nav-link>
                <x-nav-link href="#" :active="request()->routeIs('admin.roles.*')">
                    {{ __('Roles') }}
                </x-nav-link>
            </div>
        </div>

        {{-- Another regular link --}}
        <div class="mt-4">
             <x-nav-link href="#" :active="request()->routeIs('admin.settings')">
                {{ __('Settings') }}
            </x-nav-link>
        </div>
    </nav>
</div>
.