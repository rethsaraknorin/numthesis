{{-- Sidebar for an authenticated user's dashboard --}}
<div class="flex flex-col justify-between h-full py-4 px-6">
    <div>
        {{-- UPDATED: Logo and application name --}}
        <a href="{{ route('dashboard') }}" class="flex items-center text-xl font-semibold text-gray-900 dark:text-white mb-8">
            <img src="{{ asset('assets/logo/num-logo.png') }}" class="h-10 w-10 rounded-full object-cover" alt="NUM Logo">
            <span class="ml-3">NUM</span>
        </a>

        {{-- Navigation Links --}}
        <nav class="flex flex-col space-y-2">
            <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                <svg class="w-5 h-5 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h7.5" /></svg>
                {{ __('Dashboard') }}
            </x-nav-link>

            <x-nav-link :href="route('programs.index')" :active="request()->routeIs('programs.*')">
                <svg class="w-5 h-5 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path d="M12 18.375a9.375 9.375 0 100-18.75 9.375 9.375 0 000 18.75z" /><path d="M8.25 9.75h7.5v.008h-7.5V9.75z" /><path d="M12 14.25v.008" /><path d="M10.125 12h3.75" /><path d="M12 3.75v1.5" /><path d="M12 18.75v1.5" /><path d="M3.75 12h1.5" /><path d="M18.75 12h1.5" /><path d="M5.69 6.075l1.06-1.06" /><path d="M17.25 18.31l1.06-1.06" /><path d="M5.69 17.925l1.06 1.06" /><path d="M17.25 5.69l1.06 1.06" /></svg>
                {{ __('Academic Program') }}
            </x-nav-link>

            <x-nav-link :href="route('library.index')" :active="request()->routeIs('library.index')">
                <svg class="w-5 h-5 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" /></svg>
                {{ __('Library') }}
            </x-nav-link>

            <x-nav-link href="#" :active="request()->routeIs('user.jobs.*')">
                <svg class="w-5 h-5 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.07a2.25 2.25 0 01-2.25 2.25h-13.5a2.25 2.25 0 01-2.25-2.25v-4.07m16.5 0a2.25 2.25 0 00-2.25-2.25h-13.5a2.25 2.25 0 00-2.25 2.25m16.5 0v-4.07a2.25 2.25 0 00-2.25-2.25h-13.5a2.25 2.25 0 00-2.25 2.25v4.07" /></svg>
                {{ __('Job Opportunity') }}
            </x-nav-link>

            <x-nav-link href="https://t.me/YOUR_BOT_USERNAME_HERE" target="_blank" :active="false">
                <svg class="w-5 h-5 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M8.625 12a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H8.25m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H12m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 01-2.555-.337A5.972 5.972 0 015.41 20.97a5.969 5.969 0 01-.474-.065 4.48 4.48 0 00.978-2.025c.09-.457-.133-.901-.467-1.226C3.93 16.178 3 14.189 3 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25z" /></svg>
                {{ __('Chatbot') }}
            </x-nav-link>
        </nav>
    </div>
</div>
