{{-- This component inherits the Alpine.js scope from the parent page --}}
<div x-data="{ mobileMenuOpen: false }" class="w-full z-50 p-4">

  <nav class="flex items-center justify-between w-full max-w-6xl mx-auto px-4 sm:px-6 py-3 bg-gray-100/80 dark:bg-gray-900/50 backdrop-blur-lg border dark:border-white/10 rounded-[20px] shadow-lg text-gray-800 dark:text-white">
    
    <a href="{{ url('/') }}" class="flex-shrink-0 flex items-center space-x-2">
      <img src="{{ asset('assets/logo/num-logo.png') }}" 
           class="w-10 h-10 rounded-full object-cover border-2 border-white/30" 
           alt="NUM Logo" />
      <span class="font-bold text-lg hidden sm:inline">NUM</span>
    </a>

    <div class="hidden md:flex items-center space-x-6">
        <a href="/" class="text-sm font-medium hover:text-cyan-500 dark:hover:text-cyan-300 transition-colors">Home</a>
        <div class="relative group">
            <button class="flex items-center space-x-1 text-sm font-medium hover:text-cyan-500 dark:hover:text-cyan-300 transition-colors">
                <span>Academics</span>
                <svg class="w-4 h-4 transition-transform duration-300 group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
            </button>
            <div class="absolute hidden group-hover:block pt-3 -ml-4 w-48 z-10">
                <div class="bg-white/80 dark:bg-gray-900/70 backdrop-blur-xl border dark:border-white/10 rounded-[15px] shadow-2xl space-y-1 p-2">
                    {{-- UPDATED: Point to public programs page --}}
                    <a href="{{ route('page.programs') }}" class="block px-3 py-2 text-sm rounded-md text-gray-800 dark:text-white hover:bg-black/5 dark:hover:bg-white/10 transition-colors">Academic Programs</a>
                    <a href="{{ route('page.library') }}" class="block px-3 py-2 text-sm rounded-md text-gray-800 dark:text-white hover:bg-black/5 dark:hover:bg-white/10 transition-colors">Library</a>
                </div>
            </div>
        </div>
        <div class="relative group">
            <button class="flex items-center space-x-1 text-sm font-medium hover:text-cyan-500 dark:hover:text-cyan-300 transition-colors">
                <span>About</span>
                <svg class="w-4 h-4 transition-transform duration-300 group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
            </button>
            <div class="absolute hidden group-hover:block pt-3 -ml-4 w-48 z-10">
                <div class="bg-white/80 dark:bg-gray-900/70 backdrop-blur-xl border dark:border-white/10 rounded-[15px] shadow-2xl space-y-1 p-2">
                    <a href="{{ route('about.our-story') }}" class="block px-3 py-2 text-sm rounded-md text-gray-800 dark:text-white hover:bg-black/5 dark:hover:bg-white/10 transition-colors">Our Story</a>
                    <a href="{{ route('about.achievements') }}" class="block px-3 py-2 text-sm rounded-md text-gray-800 dark:text-white hover:bg-black/5 dark:hover:bg-white/10 transition-colors">Achievements</a>
                    <a href="#" class="block px-3 py-2 text-sm rounded-md text-gray-800 dark:text-white hover:bg-black/5 dark:hover:bg-white/10 transition-colors">Careers</a>
                </div>
            </div>
        </div>
        <a href="{{ route('contact') }}" class="text-sm font-medium hover:text-cyan-500 dark:hover:text-cyan-300 transition-colors">Contact Us</a>
    </div>

    <div class="hidden md:flex items-center space-x-2">
        <button @click="$store.theme.toggle()" class="p-2 rounded-full text-gray-700 dark:text-gray-300 hover:bg-black/10 dark:hover:bg-white/10 focus:outline-none transition-colors">
            <template x-if="!$store.theme.isDarkMode"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg></template>
            <template x-if="$store.theme.isDarkMode"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m8.657-12.657l-.707.707M5.05 18.95l-.707.707M21 12h-1M4 12H3m15.657.343l.707.707M5.05 5.05l.707.707M12 18a6 6 0 100-12 6 6 0 000 12z"></path></svg></template>
        </button>
        @auth
            <a href="{{ url('/dashboard') }}" class="text-sm font-semibold bg-gray-500/20 dark:bg-white/10 hover:bg-gray-500/30 dark:hover:bg-white/20 transition-colors px-4 py-2 rounded-lg">Dashboard</a>
        @else
            <a href="{{ route('login') }}" class="text-sm font-medium hover:bg-black/10 dark:hover:bg-white/10 transition-colors px-4 py-2 rounded-lg">Sign In</a>
            <a href="{{ route('register') }}" class="text-sm font-semibold bg-cyan-500/20 text-cyan-700 hover:bg-cyan-500/30 dark:bg-cyan-500/20 dark:text-cyan-300 dark:hover:bg-cyan-500/30 transition-colors px-4 py-2 rounded-lg">Join Us</a>
        @endauth
    </div>

    <div class="md:hidden">
        <button @click="mobileMenuOpen = !mobileMenuOpen" aria-label="Open menu" class="text-gray-800 dark:text-white hover:text-cyan-500 dark:hover:text-cyan-300 focus:outline-none">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path></svg>
        </button>
    </div>
  </nav>
  
  <div x-show="mobileMenuOpen" x-transition class="md:hidden fixed inset-0 bg-gray-900/90 backdrop-blur-sm p-4 z-50" @click.away="mobileMenuOpen = false" x-cloak>
    <div class="bg-gray-800/80 border border-white/10 rounded-[20px] p-6 shadow-2xl">
        <div class="flex items-center justify-between mb-8">
            <a href="{{ url('/') }}" class="flex-shrink-0">
                <img src="{{ asset('assets/logo/num-logo.png') }}" class="w-10 h-10 rounded-full object-cover" alt="Logo" />
            </a>
            <div class="flex items-center space-x-2">
                <button @click="$store.theme.toggle()" class="p-2 rounded-full text-gray-300 hover:bg-white/10 focus:outline-none transition-colors">
                    <template x-if="!$store.theme.isDarkMode"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg></template>
                    <template x-if="$store.theme.isDarkMode"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m8.657-12.657l-.707.707M5.05 18.95l-.707.707M21 12h-1M4 12H3m15.657.343l.707.707M5.05 5.05l.707.707M12 18a6 6 0 100-12 6 6 0 000 12z"></path></svg></template>
                </button>
                <button @click="mobileMenuOpen = false" aria-label="Close menu" class="text-gray-400 hover:text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
        </div>
        <nav class="flex flex-col space-y-4 text-center">
            <a href="/" @click="mobileMenuOpen = false" class="text-lg font-medium text-gray-200 hover:text-cyan-300 py-2">Home</a>
            {{-- UPDATED: Point to public programs page --}}
            <a href="{{ route('page.programs') }}" @click="mobileMenuOpen = false" class="text-lg font-medium text-gray-200 hover:text-cyan-300 py-2">Programs</a>
            <a href="{{ route('page.library') }}" @click="mobileMenuOpen = false" class="text-lg font-medium text-gray-200 hover:text-cyan-300 py-2">Library</a>
            <a href="{{ route('about.our-story') }}" @click="mobileMenuOpen = false" class="text-lg font-medium text-gray-200 hover:text-cyan-300 py-2">About Us</a>
            <a href="{{ route('about.achievements') }}" @click="mobileMenuOpen = false" class="text-lg font-medium text-gray-200 hover:text-cyan-300 py-2">Achievements</a>
            <a href="{{ route('contact') }}" @click="mobileMenuOpen = false" class="text-lg font-medium text-gray-200 hover:text-cyan-300 py-2">Contact Us</a>
            <hr class="border-gray-700 my-4"/>
            <div class="flex flex-col space-y-4 pt-4">
                 @auth
                    <a href="{{ url('/dashboard') }}" class="text-lg font-semibold text-white bg-cyan-500 hover:bg-cyan-600 transition-colors px-4 py-3 rounded-lg">Dashboard</a>
                 @else
                    <a href="{{ route('login') }}" class="text-lg font-medium text-gray-200 hover:text-white transition-colors px-4 py-3 rounded-lg bg-white/10">Sign In</a>
                    <a href="{{ route('register') }}" class="text-lg font-semibold text-white bg-cyan-500 hover:bg-cyan-600 transition-colors px-4 py-3 rounded-lg">Join Us</a>
                 @endauth
            </div>
        </nav>
    </div>
  </div>
</div>
<style>
.group:hover .group-hover\:block { display: block; }
[x-cloak] { display: none !important; }
</style>