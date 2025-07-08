<div class="flex h-full flex-col bg-gray-100 dark:bg-gray-900">
    {{-- Sidebar content --}}
    <div class="flex flex-col justify-between h-full py-4 px-3">
        <div class="space-y-4">
            {{-- Logo and application name --}}
            <a href="{{ route('admin.dashboard') }}"
                class="flex items-center text-xl font-semibold text-gray-900 dark:text-white px-3 mb-6">
                <img src="{{ asset('assets/logo/num-logo.png') }}" class="h-10 w-10 rounded-full object-cover"
                    alt="NUM Logo">
                <span class="ml-3">NUM Admin</span>
            </a>

            {{-- Navigation Links --}}
            <nav class="flex flex-col space-y-2">
                <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                    <svg class="w-5 h-5 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h7.5" />
                    </svg>
                    {{ __('Dashboard') }}
                </x-nav-link>

                {{-- User Management Dropdown --}}
                <div x-data="{ open: {{ request()->routeIs('admin.users.*') ? 'true' : 'false' }} }" class="space-y-1">
                    <button @click="open = ! open"
                        class="flex items-center justify-between w-full px-3 py-2 text-sm font-medium text-left text-gray-600 dark:text-gray-400 hover:bg-gray-200 dark:hover:bg-gray-700 rounded-md focus:outline-none">
                        <span class="flex items-center">
                            <svg class="w-5 h-5 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-4.67c.12-.318.232-.656.328-1.014a7.454 7.454 0 011.472-3.053c.52-1.171 1.232-2.144 2.114-2.853M12 14.25a5.25 5.25 0 00-10.5 0v.25c0 .591.212 1.158.585 1.606a5.286 5.286 0 003.18 1.878A5.286 5.286 0 0012 14.25v-.25z" />
                            </svg>
                            <span>{{ __('Users') }}</span>
                        </span>
                        <svg class="w-4 h-4 transform transition-transform duration-200" :class="{ 'rotate-180': open }"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="open" x-transition class="pl-6 space-y-1">
                        <a href="{{ route('admin.users.all') }}"
                            class="block w-full px-3 py-2 rounded-md text-sm {{ request()->routeIs('admin.users.all') ? 'bg-indigo-100 text-indigo-700 dark:bg-indigo-900/50 dark:text-white font-semibold' : 'text-gray-500 hover:bg-gray-200 dark:text-gray-400 dark:hover:bg-gray-700' }}">Total
                            Users</a>
                        <a href="{{ route('admin.users.requests') }}"
                            class="block w-full px-3 py-2 rounded-md text-sm {{ request()->routeIs('admin.users.requests') ? 'bg-indigo-100 text-indigo-700 dark:bg-indigo-900/50 dark:text-white font-semibold' : 'text-gray-500 hover:bg-gray-200 dark:text-gray-400 dark:hover:bg-gray-700' }}">Student
                            Requests</a>
                        <a href="{{ route('admin.users.students') }}"
                            class="block w-full px-3 py-2 rounded-md text-sm {{ request()->routeIs('admin.users.students') ? 'bg-indigo-100 text-indigo-700 dark:bg-indigo-900/50 dark:text-white font-semibold' : 'text-gray-500 hover:bg-gray-200 dark:text-gray-400 dark:hover:bg-gray-700' }}">Approved
                            Students</a>
                        <a href="{{ route('admin.users.index') }}"
                            class="block w-full px-3 py-2 rounded-md text-sm {{ request()->routeIs('admin.users.index') ? 'bg-indigo-100 text-indigo-700 dark:bg-indigo-900/50 dark:text-white font-semibold' : 'text-gray-500 hover:bg-gray-200 dark:text-gray-400 dark:hover:bg-gray-700' }}">Normal
                            Users</a>
                    </div>
                </div>

                {{-- Academic Management Dropdown --}}
                <div x-data="{ open: {{ request()->routeIs(['admin.programs.*', 'admin.courses.*', 'admin.schedules.*']) ? 'true' : 'false' }} }" class="space-y-1">
                    <button @click="open = ! open"
                        class="flex items-center justify-between w-full px-3 py-2 text-sm font-medium text-left text-gray-600 dark:text-gray-400 hover:bg-gray-200 dark:hover:bg-gray-700 rounded-md focus:outline-none">
                        <span class="flex items-center">
                            <svg class="w-5 h-5 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0l-.07.004-.002.002a50.021 50.021 0 013.632 15.08M19.74 10.147l.07.004c.002.002.004.004.005.007a50.021 50.021 0 00-3.632 15.08" />
                            </svg>
                            <span>{{ __('Academics') }}</span>
                        </span>
                        <svg class="w-4 h-4 transform transition-transform duration-200" :class="{ 'rotate-180': open }"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="open" x-transition class="pl-6 space-y-1">
                        <a href="{{ route('admin.programs.index') }}"
                            class="block w-full px-3 py-2 rounded-md text-sm {{ request()->routeIs('admin.programs.*') ? 'bg-indigo-100 text-indigo-700 dark:bg-indigo-900/50 dark:text-white font-semibold' : 'text-gray-500 hover:bg-gray-200 dark:text-gray-400 dark:hover:bg-gray-700' }}">Programs</a>
                        <a href="{{ route('admin.courses.index') }}"
                            class="block w-full px-3 py-2 rounded-md text-sm {{ request()->routeIs('admin.courses.*') ? 'bg-indigo-100 text-indigo-700 dark:bg-indigo-900/50 dark:text-white font-semibold' : 'text-gray-500 hover:bg-gray-200 dark:text-gray-400 dark:hover:bg-gray-700' }}">Courses</a>
                        <a href="{{ route('admin.schedules.index') }}"
                            class="block w-full px-3 py-2 rounded-md text-sm {{ request()->routeIs('admin.schedules.*') ? 'bg-indigo-100 text-indigo-700 dark:bg-indigo-900/50 dark:text-white font-semibold' : 'text-gray-500 hover:bg-gray-200 dark:text-gray-400 dark:hover:bg-gray-700' }}">Schedules</a>
                    </div>
                </div>

                <x-nav-link :href="route('admin.library.index')" :active="request()->routeIs('admin.library.*')">
                    <svg class="w-5 h-5 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                    </svg>
                    {{ __('Library') }}
                </x-nav-link>

                <x-nav-link :href="route('admin.events.index')" :active="request()->routeIs('admin.events.*')">
                    <svg class="w-5 h-5 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0h18M-4.5 12h22.5" />
                    </svg>
                    {{ __('Events') }}
                </x-nav-link>

                <x-nav-link href="#" :active="request()->routeIs('admin.jobs.*')">
                    <svg class="w-5 h-5 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M20.25 14.15v4.07a2.25 2.25 0 01-2.25 2.25h-13.5a2.25 2.25 0 01-2.25-2.25v-4.07m16.5 0a2.25 2.25 0 00-2.25-2.25h-13.5a2.25 2.25 0 00-2.25 2.25m16.5 0v-4.07a2.25 2.25 0 00-2.25-2.25h-13.5a2.25 2.25 0 00-2.25 2.25v4.07" />
                    </svg>
                    {{ __('Job Opportunity') }}
                </x-nav-link>
            </nav>
        </div>

        {{-- Profile and Logout section has been removed --}}
    </div>
</div>
