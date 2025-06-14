{{-- Sidebar content --}}
<div class="py-4 px-6 h-full">
    {{-- Logo --}}
    <a href="{{ route('dashboard') }}" class="flex items-center text-xl font-semibold text-gray-900 dark:text-white mb-8">
        <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
        <span class="ml-3">{{ config('app.name', 'Laravel') }}</span>
    </a>

    {{-- Navigation Links --}}
    <nav class="flex flex-col space-y-2">
        
        {{-- Dashboard Link --}}
        <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
            {{ __('Dashboard') }}
        </x-nav-link>

        {{-- Users Link --}}
        <x-nav-link :href="route('admin.users.index')" :active="request()->routeIs('admin.users.index')">
            {{ __('Users') }}
        </x-nav-link>
        
        {{-- Library Link --}}
        <x-nav-link href="#" :active="request()->routeIs('admin.library.*')">
            {{ __('Library') }}
        </x-nav-link>

        {{-- Job Opportunity Link --}}
        <x-nav-link href="#" :active="request()->routeIs('admin.jobs.*')">
            {{ __('Job Opportunity') }}
        </x-nav-link>

        {{-- Academic Program Link --}}
        <x-nav-link href="#" :active="request()->routeIs('admin.academics.*')">
            {{ __('Academic Program') }}
        </x-nav-link>

    </nav>
</div>
