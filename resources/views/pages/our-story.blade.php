<!DOCTYPE html>
<html lang="en" x-data :class="{ 'dark': $store.theme.isDarkMode }">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Story - IT Faculty - National University of Management</title>
    
    <link rel="icon" href="{{ asset('assets/logo/num-logo.png') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    
    <style>
        .hero-bg-about {
            background: linear-gradient(rgba(17, 24, 39, 0.8), rgba(17, 24, 39, 0.8)), url('https://images.unsplash.com/photo-1523050854058-8df90110c9f1?q=80&w=2070&auto=format&fit=crop');
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
        <header class="hero-bg-about h-96 flex items-center justify-center text-white">
            <div class="text-center px-4">
                <h1 class="text-5xl font-bold">Our Faculty's Story</h1>
                <p class="mt-4 text-xl text-gray-300">A Legacy of Excellence and Innovation in Technology</p>
            </div>
        </header>

        <section class="py-20 bg-white dark:bg-gray-800">
            <div class="container mx-auto px-6 lg:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                    <div>
                        <h2 class="text-3xl font-bold text-gray-900 dark:text-white">Our Journey in Technology</h2>
                        <p class="mt-4 text-lg text-gray-600 dark:text-gray-400">
                           The Faculty of Information Technology is a proud and dynamic part of the National University of Management (NUM). While the university was founded in 1983, our faculty represents the cutting-edge of its evolution, born from a spirit of innovation and a commitment to Cambodia's technological future.
                        </p>
                        <p class="mt-4 text-lg text-gray-600 dark:text-gray-400">
                           Our programs in Information Technology, Business IT, and Robotic Engineering were established to meet the growing demands of the digital age and Industry 4.0. We are dedicated to nurturing the next generation of tech leaders, developers, and innovators who will drive Cambodia's growth on the global stage.
                        </p>
                    </div>
                    <div>
                        <img src="{{ asset('assets/num-image.jpg') }}" alt="NUM Campus" class="rounded-lg shadow-xl" style="filter: brightness(85%);">
                    </div>
                </div>

                <div class="mt-20 grid grid-cols-1 md:grid-cols-2 gap-10">
                    <div class="bg-gray-50 dark:bg-gray-900/50 p-8 rounded-lg">
                        <h3 class="text-2xl font-bold text-indigo-600 dark:text-indigo-400 mb-3">Our Mission</h3>
                        <p class="text-gray-600 dark:text-gray-300">
                            To be a leading faculty in Cambodia, providing world-class education, research, and community service with a focus on developing competent and socially responsible technologists, innovators, and leaders for the digital economy.
                        </p>
                    </div>
                    <div class="bg-gray-50 dark:bg-gray-900/50 p-8 rounded-lg">
                        <h3 class="text-2xl font-bold text-indigo-600 dark:text-indigo-400 mb-3">Our Vision</h3>
                        <p class="text-gray-600 dark:text-gray-300">
                            To become a nationally and internationally recognized hub of technological excellence, fostering innovation and contributing to the sustainable development of Cambodia and the region through technology.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-20">
             <div class="container mx-auto px-6 lg:px-8">
                <h2 class="text-3xl font-bold text-center text-gray-900 dark:text-white mb-12">Key Milestones of NUM</h2>
                <div class="relative">
                    <div class="absolute left-1/2 w-0.5 h-full bg-indigo-300 dark:bg-gray-700 -translate-x-1/2"></div>
                    
                    <div class="space-y-16">
                        <div class="relative flex items-center">
                            <div class="w-1/2 pr-8 text-right">
                                <p class="font-bold text-indigo-600 dark:text-indigo-400">1983</p>
                                <h4 class="text-xl font-semibold text-gray-800 dark:text-gray-200">Establishment</h4>
                                <p class="text-gray-600 dark:text-gray-400">The university is founded as the Economic Institute.</p>
                            </div>
                            <div class="absolute left-1/2 -translate-x-1/2 w-4 h-4 bg-white dark:bg-gray-800 border-2 border-indigo-500 rounded-full"></div>
                        </div>
                        <div class="relative flex items-center">
                            <div class="w-1/2"></div>
                            <div class="w-1/2 pl-8">
                                <p class="font-bold text-indigo-600 dark:text-indigo-400">1998</p>
                                <h4 class="text-xl font-semibold text-gray-800 dark:text-gray-200">Becoming NIM</h4>
                                <p class="text-gray-600 dark:text-gray-400">The institution is renamed the National Institute of Management (NIM).</p>
                            </div>
                             <div class="absolute left-1/2 -translate-x-1/2 w-4 h-4 bg-white dark:bg-gray-800 border-2 border-indigo-500 rounded-full"></div>
                        </div>
                         <div class="relative flex items-center">
                            <div class="w-1/2 pr-8 text-right">
                                <p class="font-bold text-indigo-600 dark:text-indigo-400">2004</p>
                                <h4 class="text-xl font-semibold text-gray-800 dark:text-gray-200">University Status</h4>
                                <p class="text-gray-600 dark:text-gray-400">Officially becomes the National University of Management (NUM).</p>
                            </div>
                            <div class="absolute left-1/2 -translate-x-1/2 w-4 h-4 bg-white dark:bg-gray-800 border-2 border-indigo-500 rounded-full"></div>
                        </div>
                        <div class="relative flex items-center">
                            <div class="w-1/2"></div>
                            <div class="w-1/2 pl-8">
                                <p class="font-bold text-indigo-600 dark:text-indigo-400">2011 - Present</p>
                                <h4 class="text-xl font-semibold text-gray-800 dark:text-gray-200">Focus on Technology</h4>
                                <p class="text-gray-600 dark:text-gray-400">The Faculty of IT grows, launching programs for Industry 4.0 and establishing the International College.</p>
                            </div>
                             <div class="absolute left-1/2 -translate-x-1/2 w-4 h-4 bg-white dark:bg-gray-800 border-2 border-indigo-500 rounded-full"></div>
                        </div>
                    </div>
                </div>
             </div>
        </section>
    </main>
    <x-footer />
</body>
</html>