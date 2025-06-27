<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
      x-data="themeSwitcher()"
      x-init="init()"
      :class="{ 'dark': isDarkMode }">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>NUM - Admin</title>
    <link rel="icon" href="{{ asset('assets/logo/num-logo.png') }}">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kantumruy+Pro:ital,wght@0,100..700;1,100..700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .sidebar {
            transition: transform 0.3s ease-in-out;
        }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="font-sans antialiased bg-gray-100 dark:bg-gray-900">
    <div x-data="{ sidebarOpen: true }" class="flex h-screen bg-gray-100 dark:bg-gray-900">
        <aside
            class="sidebar flex-shrink-0 w-72 bg-white dark:bg-gray-800 border-r dark:border-gray-700 md:block"
            :class="{ 'block': sidebarOpen, 'hidden': !sidebarOpen }"
        >
            @include('layouts.partials.admin-sidebar')
        </aside>

        <div class="flex flex-col flex-1 overflow-y-auto">
            <header class="flex items-center justify-between p-4 bg-white dark:bg-gray-800 border-b dark:border-gray-700">
                <div>
                    <button @click="sidebarOpen = !sidebarOpen" class="text-gray-500 dark:text-gray-400 focus:outline-none focus:text-gray-600 dark:focus:text-gray-300 md:hidden">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>
                 <div class="flex items-center space-x-4">
                    
                    {{-- Notification Dropdown --}}
                    <div x-data="notificationManager({
                        initialUnread: {{ json_encode($pendingUsersForLayout) }},
                        initialCount: {{ $pendingUserCount }}
                    })" class="relative">
                        
                        {{-- Notification Bell Button --}}
                        <button @click="open = !open" class="relative p-2 rounded-full text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none">
                            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" /></svg>
                            <template x-if="count > 0">
                                <span class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-red-100 transform translate-x-1/2 -translate-y-1/2 bg-red-600 rounded-full" x-text="count"></span>
                            </template>
                        </button>

                        {{-- Notification Dropdown Panel --}}
                        <div x-show="open" @click.outside="open = false" x-transition class="absolute right-0 mt-2 w-80 bg-white dark:bg-gray-800 rounded-lg shadow-xl overflow-hidden z-10" x-cloak>
                            <div class="py-2 px-4 text-sm font-semibold text-gray-700 dark:text-gray-200 border-b dark:border-gray-700 flex justify-between items-center">
                                <span>You have <span x-text="count"></span> pending requests.</span>
                                <button @click="markAllAsRead" x-show="count > 0" class="text-xs text-blue-500 hover:underline focus:outline-none">Clear All</button>
                            </div>
                            <div class="divide-y divide-gray-100 dark:divide-gray-700">
                                <template x-for="notification in unread" :key="notification.id">
                                    <a @click.prevent="markAsRead(notification.id)" href="{{ route('admin.users.requests') }}" class="block py-3 px-4 hover:bg-gray-100 dark:hover:bg-gray-700">
                                        <p class="text-sm font-medium text-gray-800 dark:text-gray-200" x-text="notification.data.message"></p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400" x-text="'Student ID: ' + notification.data.student_id"></p>
                                    </a>
                                </template>
                                <template x-if="count === 0">
                                    <p class="py-4 text-center text-sm text-gray-500 dark:text-gray-400">No new notifications.</p>
                                </template>
                            </div>
                            @if($pendingUserCount > 0)
                                <a href="{{ route('admin.users.requests') }}" class="block bg-gray-50 dark:bg-gray-700/50 py-2 px-4 text-sm font-semibold text-center text-indigo-600 dark:text-indigo-400 hover:underline">
                                    View All Requests
                                </a>
                            @endif
                        </div>
                    </div>

                    <button @click="toggleTheme" class="p-2 rounded-full text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none">
                        <template x-if="!isDarkMode"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg></template>
                        <template x-if="isDarkMode"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m8.657-12.657l-.707.707M5.05 18.95l-.707.707M21 12h-1M4 12H3m15.657.343l.707.707M5.05 5.05l.707.707M12 18a6 6 0 100-12 6 6 0 000 12z"></path></svg></template>
                    </button>

                    {{-- User Profile Dropdown --}}
                    <div class="hidden sm:flex sm:items-center">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                                    <img class="h-8 w-8 rounded-full object-cover me-2" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                    <div>{{ Auth::user()->name }}</div>
                                    <div class="ms-1">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <x-dropdown-link :href="route('profile.edit')">
                                    {{ __('Profile') }}
                                </x-dropdown-link>

                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <x-dropdown-link :href="route('logout')"
                                            onclick="event.preventDefault(); this.closest('form').submit();">
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    </div>
                 </div>
            </header>

            <main class="flex-1 p-6">
                @if (isset($header))
                    <header class="bg-white dark:bg-gray-800 shadow rounded-lg mb-6">
                        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                            {{ $header }}
                        </div>
                    </header>
                @endif
                {{ $slot }}
            </main>
            
            <x-footer />
        </div>
    </div>
    
    <script>
        function themeSwitcher() {
            return {
                isDarkMode: false,
                init() {
                    if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                        this.isDarkMode = true;
                    } else {
                        this.isDarkMode = false;
                    }
                },
                toggleTheme() {
                    this.isDarkMode = !this.isDarkMode;
                    localStorage.setItem('theme', this.isDarkMode ? 'dark' : 'light');
                }
            }
        }

        function notificationManager(data) {
            return {
                open: false,
                unread: data.initialUnread || [],
                count: data.initialCount || 0,
                
                markAsRead(notificationId) {
                    fetch(`/admin/notifications/${notificationId}/mark-as-read`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Content-Type': 'application/json',
                            'Accept': 'application/json'
                        }
                    }).then(response => {
                        if (response.ok) {
                            window.location.href = "{{ route('admin.users.requests') }}";
                        }
                    });
                },

                markAllAsRead() {
                    fetch('/admin/notifications/mark-all-as-read', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        }
                    }).then(response => {
                        if (response.ok) {
                            this.unread = [];
                            this.count = 0;
                        }
                    });
                }
            }
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @stack('scripts')
</body>
</html>
