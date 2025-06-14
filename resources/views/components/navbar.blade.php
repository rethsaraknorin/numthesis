<!--
  Component for a responsive glassmorphism navbar.
  Dependencies: Tailwind CSS, Alpine.js
-->
<div x-data="{ mobileMenuOpen: false }" class="w-full z-50 p-4">

  <!-- Glassmorphism Navbar -->
  <nav class="flex items-center justify-between w-full max-w-6xl mx-auto px-4 sm:px-6 py-3 bg-gray-200/80 backdrop-blur-lg border border-white/20 rounded-full shadow-lg text-gray-800">

    <!-- Left Side: Logo -->
    <a href="{{ url('/') }}" class="flex-shrink-0">
      <!-- Use the asset() helper to link to your logo in the public folder -->
      <img src="{{ asset('images/logo.png') }}" 
           onerror="this.onerror=null;this.src='https://placehold.co/100x100/1a202c/FFFFFF?text=Logo';"
           class="w-12 h-12 rounded-full object-cover border-2 border-white/30" 
           alt="Your Company Logo" />
    </a>

    <!-- Center: Desktop Navigation Links (Hidden on mobile) -->
    <div class="hidden md:flex items-center space-x-6">
      <a href="#" class="text-sm font-medium hover:text-black transition-colors">Home</a>

      <!-- Dropdown 1: Institution -->
      <div class="relative group">
        <button class="flex items-center space-x-1 text-sm font-medium hover:text-black transition-colors">
          <span>Institution</span>
          <svg class="w-4 h-4 transition-transform duration-300 group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
        </button>
        <div class="absolute hidden group-hover:block mt-4 p-2 w-48 bg-gray-200/60 backdrop-blur-xl border border-white/20 rounded-xl shadow-2xl space-y-1">
          <a href="#" class="block px-3 py-2 text-sm rounded-md hover:bg-black/5 transition-colors">Who We Are</a>
          <a href="#" class="block px-3 py-2 text-sm rounded-md hover:bg-black/5 transition-colors">Faculty Members</a>
        </div>
      </div>

      <!-- Dropdown 2: Academics -->
      <div class="relative group">
        <button class="flex items-center space-x-1 text-sm font-medium hover:text-black transition-colors">
          <span>Academics</span>
           <svg class="w-4 h-4 transition-transform duration-300 group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
        </button>
        <div class="absolute hidden group-hover:block mt-4 p-2 w-48 bg-gray-200/60 backdrop-blur-xl border border-white/20 rounded-xl shadow-2xl space-y-1">
          <a href="#" class="block px-3 py-2 text-sm rounded-md hover:bg-black/5 transition-colors">Study Programs</a>
          <a href="#" class="block px-3 py-2 text-sm rounded-md hover:bg-black/5 transition-colors">Digital Library</a>
        </div>
      </div>

      <a href="#" class="text-sm font-medium hover:text-black transition-colors">Careers</a>
    </div>

    <!-- Right Side: Desktop Auth Links (Hidden on mobile) -->
    <div class="hidden md:flex items-center space-x-2">
        @auth
            <a href="{{ url('/dashboard') }}" class="text-sm font-semibold bg-black/10 hover:bg-black/20 transition-colors px-4 py-2 rounded-full">Dashboard</a>
        @else
            <a href="{{ route('login') }}" class="text-sm font-medium hover:text-black transition-colors px-4 py-2">Sign In</a>
            <a href="{{ route('register') }}" class="text-sm font-semibold bg-black/10 hover:bg-black/20 transition-colors px-4 py-2 rounded-full">Join Us</a>
        @endauth
    </div>


    <!-- Mobile Menu Button -->
    <div class="md:hidden">
        <button @click="mobileMenuOpen = !mobileMenuOpen" aria-label="Open menu" class="text-gray-800 hover:text-black focus:outline-none">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path></svg>
        </button>
    </div>

  </nav>
  
  <!-- Mobile Menu (Fullscreen Overlay) -->
  <div x-show="mobileMenuOpen" 
       x-transition
       class="md:hidden fixed inset-0 bg-gray-900/90 backdrop-blur-sm p-4 z-50"
       @click.away="mobileMenuOpen = false" x-cloak>
    
    <div class="bg-white/95 rounded-2xl p-6 shadow-2xl">
        <!-- Mobile Menu Header -->
        <div class="flex items-center justify-between mb-8">
            <a href="{{ url('/') }}" class="flex-shrink-0">
                <img src="{{ asset('images/logo.png') }}" onerror="this.onerror=null;this.src='https://placehold.co/100x100/1a202c/FFFFFF?text=Logo';" class="w-10 h-10 rounded-full object-cover" alt="Logo" />
            </a>
            <button @click="mobileMenuOpen = false" aria-label="Close menu" class="text-gray-600 hover:text-black">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>
        
        <!-- Mobile Navigation Links -->
        <nav class="flex flex-col space-y-4 text-center">
            <a href="#" class="text-lg font-medium text-gray-800 hover:text-black py-2">Home</a>
            <a href="#" class="text-lg font-medium text-gray-800 hover:text-black py-2">Institution</a>
            <a href="#" class="text-lg font-medium text-gray-800 hover:text-black py-2">Academics</a>
            <a href="#" class="text-lg font-medium text-gray-800 hover:text-black py-2">Careers</a>
            
            <hr class="border-gray-300 my-4"/>

            <!-- Mobile Auth Links -->
            <div class="flex flex-col space-y-4 pt-4">
                 @auth
                    <a href="{{ url('/dashboard') }}" class="text-lg font-semibold text-white bg-gray-800 hover:bg-black transition-colors px-4 py-3 rounded-full">Dashboard</a>
                 @else
                    <a href="{{ route('login') }}" class="text-lg font-medium text-gray-700 hover:text-black transition-colors px-4 py-3 rounded-full bg-gray-200/80">Sign In</a>
                    <a href="{{ route('register') }}" class="text-lg font-semibold text-white bg-gray-800 hover:bg-black transition-colors px-4 py-3 rounded-full">Join Us</a>
                 @endauth
            </div>
        </nav>
    </div>
  </div>

</div>

<style>
/* This ensures the dropdowns on desktop appear correctly on hover */
.group:hover .group-hover\:block {
    display: block;
}
</style>
