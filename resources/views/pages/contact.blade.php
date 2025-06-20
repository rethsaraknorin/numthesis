<!DOCTYPE html>
<html lang="en" x-data :class="{ 'dark': $store.theme.isDarkMode }">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - National University of Management</title>
    
    <link rel="icon" href="{{ asset('assets/logo/num-logo.png') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    
    <style>
        .hero-bg-contact {
            background: linear-gradient(rgba(17, 24, 39, 0.8), rgba(17, 24, 39, 0.8)), url('https://numer.digital/public/faculties/MainSlide/num_front.jpg');
            background-size: cover;
            background-position: center;
        }
    </style>
</head>
<body class="bg-gray-100 dark:bg-gray-900">
    <div class="absolute top-0 left-0 w-full z-10">
        <x-navbar />
    </div>

    <main>
        <header class="hero-bg-contact h-96 flex items-center justify-center text-white">
            <div class="text-center">
                <h1 class="text-5xl font-bold">Contact Us</h1>
                <p class="mt-4 text-xl text-gray-300">We're here to help. Reach out to us anytime.</p>
            </div>
        </header>

        <!-- Main Content Section -->
        <section class="py-20">
            <div class="container mx-auto px-6">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                    
                    <!-- Get in Touch Form -->
                    <div class="lg:col-span-2 bg-white dark:bg-gray-800 p-8 rounded-lg shadow-lg">
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">Get in Touch</h2>
                        
                        @if (session('success'))
                            <div class="bg-green-100 dark:bg-green-900/50 border-l-4 border-green-500 text-green-700 dark:text-green-300 p-4 mb-6 rounded-md" role="alert">
                                <p class="font-bold">Success</p>
                                <p>{{ session('success') }}</p>
                            </div>
                        @endif
                        
                        <form action="{{ route('contact.store') }}" method="POST" class="space-y-6">
                            @csrf
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                                <div>
                                    <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Full Name</label>
                                    <input type="text" name="name" id="name" autocomplete="name" class="mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                </div>
                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email Address</label>
                                    <input type="email" name="email" id="email" autocomplete="email" class="mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                </div>
                            </div>
                            <div>
                                <label for="subject" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Subject</label>
                                <input type="text" name="subject" id="subject" class="mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                            <div>
                                <label for="message" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Message</label>
                                <textarea id="message" name="message" rows="4" class="mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
                            </div>
                            <div>
                                <button type="submit" class="w-full justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Send Message
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Contact Information & Map -->
                    <div class="space-y-8">
                        <div class="bg-white dark:bg-gray-800 p-8 rounded-lg shadow-lg">
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Contact Information</h3>
                            <div class="space-y-4 text-gray-600 dark:text-gray-300">
                                <p class="flex items-start">
                                    <svg class="w-6 h-6 mr-3 text-indigo-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                                    <span>St. 96 Christopher Howes, Phnom Penh, Cambodia</span>
                                </p>
                                <p class="flex items-center">
                                    <svg class="w-6 h-6 mr-3 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" /></svg>
                                    <a href="tel:061991912" class="hover:underline">061 991 912</a>
                                </p>
                                <p class="flex items-center">
                                    <svg class="w-6 h-6 mr-3 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                                    {{-- UPDATED: Wrapped email in a mailto link --}}
                                    <a href="mailto:sawen0254@gmail.com" class="hover:underline">chhayphang@num.edu.kh</a>
                                </p>
                            </div>
                        </div>
                        <div class="rounded-lg shadow-lg overflow-hidden">
                             <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3908.823525238218!2d104.919702314794!3d11.564472991789786!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31095145b5465e61%3A0x863b90c6bdc9a419!2sNational%20University%20of%20Management!5e0!3m2!1sen!2skh!4v1628886326130!5m2!1sen!2skh" width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </main>
    <x-footer />
</body>
</html>
