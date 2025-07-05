{{--
  This is the new sidebar for prospective students/applicants.
  It focuses on exploration and information gathering.
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

        {{-- Academic Program Link --}}
        <x-nav-link href="#" :active="request()->routeIs('programs.*')">
            {{ __('Explore IT Programs') }}
        </x-nav-link>
        
        {{-- Job Opportunity Link --}}
        <x-nav-link href="#" :active="request()->routeIs('jobs.*')">
            {{ __('Career Opportunities') }}
        </x-nav-link>

        {{-- Library Link --}}
        <x-nav-link href="#" :active="request()->routeIs('library.*')">
            {{ __('Virtual Tour') }}
        </x-nav-link>
        
        {{-- Chatbot Link to Telegram --}}
        <x-nav-link href="https://t.me/num_chatbot" target="_blank" :active="false">
            {{ __('Ask a Question (Chatbot)') }}
        </x-nav-link>

    </nav>
</div>