{{--
  This is the sidebar for an authenticated user's dashboard.
  It contains navigation links based on the provided image.
--}}
<div class="py-4 px-6 h-full">
    {{-- Logo --}}
    <a href="{{ route('dashboard') }}" class="flex items-center text-xl font-semibold text-gray-900 dark:text-white mb-8">
        <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
        <span class="ml-3">{{ config('app.name', 'Laravel') }}</span>
    </a>

    {{-- Navigation Links --}}
    <nav class="flex flex-col space-y-2">

        {{-- Dashboard Link --}}
        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
            {{ __('Dashboard') }}
        </x-nav-link>

        {{-- Academic Program Link (UPDATED) --}}
        <x-nav-link :href="route('programs.index')" :active="request()->routeIs('programs.*')">
            {{ __('Academic Program') }}
        </x-nav-link>

        {{-- Library Link --}}
        <x-nav-link :href="route('library.index')" :active="request()->routeIs('library.index')">
            {{ __('Library') }}
        </x-nav-link>

        {{-- Job Opportunity Link --}}
        <x-nav-link href="#" :active="request()->routeIs('user.jobs.*')">
            {{ __('Job Opportunity') }}
        </x-nav-link>

        {{-- Chatbot Link to Telegram --}}
        <x-nav-link href="https://t.me/YOUR_BOT_USERNAME_HERE" target="_blank" :active="false">
            {{ __('Chatbot') }}
        </x-nav-link>

    </nav>
</div>
