{{-- Sidebar content --}}
<div class="flex flex-col justify-between h-full py-4 px-6">
    <div>
        {{-- UPDATED: Logo and application name --}}
        <a href="{{ route('admin.dashboard') }}" class="flex items-center text-xl font-semibold text-gray-900 dark:text-white mb-8">
            <img src="{{ asset('assets/logo/num-logo.png') }}" class="h-10 w-10 rounded-full object-cover" alt="NUM Logo">
            <span class="ml-3">NUM</span>
        </a>

        {{-- Navigation Links --}}
        <nav class="flex flex-col space-y-2">
            <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                <svg class="w-5 h-5 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h7.5" /></svg>
                {{ __('Dashboard') }}
            </x-nav-link>

            <x-nav-link :href="route('admin.users.index')" :active="request()->routeIs('admin.users.index')">
                <svg class="w-5 h-5 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-4.67c.12-.318.232-.656.328-1.014a7.454 7.454 0 011.472-3.053c.52-1.171 1.232-2.144 2.114-2.853M12 14.25a5.25 5.25 0 00-10.5 0v.25c0 .591.212 1.158.585 1.606a5.286 5.286 0 003.18 1.878A5.286 5.286 0 0012 14.25v-.25z" /></svg>
                {{ __('Users') }}
            </x-nav-link>

            <x-nav-link :href="route('admin.library.index')" :active="request()->routeIs('admin.library.*')">
                <svg class="w-5 h-5 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" /></svg>
                {{ __('Library') }}
            </x-nav-link>

            <x-nav-link :href="route('admin.programs.index')" :active="request()->routeIs('admin.programs.*')">
                <svg class="w-5 h-5 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path d="M12 18.375a9.375 9.375 0 100-18.75 9.375 9.375 0 000 18.75z" /><path d="M8.25 9.75h7.5v.008h-7.5V9.75z" /><path d="M12 14.25v.008" /><path d="M10.125 12h3.75" /><path d="M12 3.75v1.5" /><path d="M12 18.75v1.5" /><path d="M3.75 12h1.5" /><path d="M18.75 12h1.5" /><path d="M5.69 6.075l1.06-1.06" /><path d="M17.25 18.31l1.06-1.06" /><path d="M5.69 17.925l1.06 1.06" /><path d="M17.25 5.69l1.06 1.06" /></svg>
                {{ __('Academic Programs') }}
            </x-nav-link>

            <x-nav-link href="#" :active="request()->routeIs('admin.jobs.*')">
                <svg class="w-5 h-5 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.07a2.25 2.25 0 01-2.25 2.25h-13.5a2.25 2.25 0 01-2.25-2.25v-4.07m16.5 0a2.25 2.25 0 00-2.25-2.25h-13.5a2.25 2.25 0 00-2.25 2.25m16.5 0v-4.07a2.25 2.25 0 00-2.25-2.25h-13.5a2.25 2.25 0 00-2.25 2.25v4.07" /></svg>
                {{ __('Job Opportunity') }}
            </x-nav-link>
        </nav>
    </div>
</div>
