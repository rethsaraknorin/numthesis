<!--
    Component Dependencies:
    - Tailwind CSS: This component is styled using Tailwind CSS classes.
    - Google Fonts (Inter): The recommended font family is 'Inter'.
    - A dark background image/color on the parent page is needed to see this light glass effect.
-->

<!-- Container to position the navbar. Use 'fixed' for a sticky navbar. -->
<div class="w-full z-50 flex justify-center p-4">

  <!-- Glassmorphism Navbar - Light Version -->
  <nav class="flex items-center justify-between w-full max-w-6xl px-6 py-3 bg-gray-200 backdrop-blur-lg border border-white/20 rounded-full shadow-lg text-gray-800">

    <!-- Left Side: Logo and Navigation Links -->
    <div class="flex items-center space-x-6">
      <!-- Logo: Replace with your actual logo -->
      <img src="{{ asset('assets/logo/logo.jpg') }}" class="w-12 h-12 rounded-full object-cover border-2 border-black/10" />

      <a href="#" class="text-sm font-medium hover:text-black transition-colors">Home</a>

      <!-- Dropdown 1: Institution Info -->
      <div class="relative group">
        <button class="flex items-center space-x-1 text-sm font-medium hover:text-black transition-colors">
          <span>Institution</span>
          <!-- Dropdown Arrow -->
          <svg class="w-4 h-4 transition-transform duration-300 group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
          </svg>
        </button>
        <!-- Dropdown Menu -->
        <div class="absolute hidden group-hover:block mt-4 p-2 w-48 bg-gray-200/50 backdrop-blur-xl border border-white/20 rounded-xl shadow-2xl space-y-1 text-gray-800">
          <a href="#" class="block px-3 py-2 text-sm rounded-md hover:bg-black/5 transition-colors">Who We Are</a>
          <a href="#" class="block px-3 py-2 text-sm rounded-md hover:bg-black/5 transition-colors">Faculty Members</a>
          <a href="#" class="block px-3 py-2 text-sm rounded-md hover:bg-black/5 transition-colors">Get in Touch</a>
        </div>
      </div>

      <!-- Dropdown 2: Learning Resources -->
      <div class="relative group">
        <button class="flex items-center space-x-1 text-sm font-medium hover:text-black transition-colors">
          <span>Academics</span>
          <!-- Dropdown Arrow -->
          <svg class="w-4 h-4 transition-transform duration-300 group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
          </svg>
        </button>
        <!-- Dropdown Menu -->
        <div class="absolute hidden group-hover:block mt-4 p-2 w-48 bg-gray-200/50 backdrop-blur-xl border border-white/20 rounded-xl shadow-2xl space-y-1 text-gray-800">
          <a href="#" class="block px-3 py-2 text-sm rounded-md hover:bg-black/5 transition-colors">Study Programs</a>
          <a href="#" class="block px-3 py-2 text-sm rounded-md hover:bg-black/5 transition-colors">Digital Library</a>
        </div>
      </div>

      <a href="#" class="text-sm font-medium hover:text-black transition-colors">Careers</a>
    </div>

    <!-- Right Side: Auth Links -->
    <div class="flex items-center space-x-2">
      <a href="/login" class="text-sm font-medium hover:text-black transition-colors px-4 py-2">Sign In</a>
      <a href="/register" class="text-sm font-semibold bg-black/5 hover:bg-black/10 transition-colors px-4 py-2 rounded-full">Join Us</a>
    </div>
  </nav>
</div>

<!-- 
    Custom CSS needed for dropdown arrow rotation. 
    You can add this to your main CSS file.
-->
<style>
  .group:hover .group-hover\:rotate-180 {
    transform: rotate(180deg);
  }
</style>