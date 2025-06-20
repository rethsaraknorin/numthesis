<!DOCTYPE html>
<html lang="en" x-data :class="{ 'dark': $store.theme.isDarkMode }">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Story - National University of Management</title>
    
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
                <h1 class="text-5xl font-bold">Our Story</h1>
                <p class="mt-4 text-xl text-gray-300">A Legacy of Excellence and Innovation in Education</p>
            </div>
        </header>

        <!-- Main Content Section -->
        <section class="py-20 bg-white dark:bg-gray-800">
            <div class="container mx-auto px-6 lg:px-8">
                <!-- History Section -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                    <div>
                        <h2 class="text-3xl font-bold text-gray-900 dark:text-white">A Rich History</h2>
                        <p class="mt-4 text-lg text-gray-600 dark:text-gray-400">
                            Founded in 1983, the National University of Management began as the Economics Science Institute (ESI). With the nation's transition to a market-driven economy in 1991, the ESI was renamed the National School of Management. In 2004, it was officially established as the National University of Management (NUM).
                        </p>
                        <p class="mt-4 text-lg text-gray-600 dark:text-gray-400">
                            For over four decades, NUM has been at the forefront of educating Cambodia's future leaders in business, technology, and governance, adapting and growing to meet the demands of a rapidly evolving global landscape.
                        </p>
                    </div>
                    <div>
                        <img src="https://www.num.edu.kh/img/about/num-about.jpg" alt="NUM Campus" class="rounded-lg shadow-xl">
                    </div>
                </div>

                <!-- Mission & Vision Section -->
                <div class="mt-20 grid grid-cols-1 md:grid-cols-2 gap-10">
                    <div class="bg-gray-50 dark:bg-gray-900/50 p-8 rounded-lg">
                        <h3 class="text-2xl font-bold text-indigo-600 dark:text-indigo-400 mb-3">Our Mission</h3>
                        <p class="text-gray-600 dark:text-gray-300">
                            To be a leading institution of higher learning in Cambodia, providing quality education, research, and community service with a focus on developing competent and socially responsible managers, economists, and entrepreneurs.
                        </p>
                    </div>
                    <div class="bg-gray-50 dark:bg-gray-900/50 p-8 rounded-lg">
                        <h3 class="text-2xl font-bold text-indigo-600 dark:text-indigo-400 mb-3">Our Vision</h3>
                        <p class="text-gray-600 dark:text-gray-300">
                            To become a nationally and internationally recognized hub of academic excellence, fostering innovation and contributing to the sustainable development of Cambodia and the region.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Timeline Section -->
        <section class="py-20">
             <div class="container mx-auto px-6 lg:px-8">
                <h2 class="text-3xl font-bold text-center text-gray-900 dark:text-white mb-12">Key Milestones</h2>
                <div class="relative">
                    <!-- The vertical line -->
                    <div class="absolute left-1/2 w-0.5 h-full bg-indigo-300 dark:bg-gray-700 -translate-x-1/2"></div>
                    
                    <!-- Timeline Items -->
                    <div class="space-y-16">
                        <!-- Item 1 -->
                        <div class="relative flex items-center">
                            <div class="w-1/2 pr-8 text-right">
                                <p class="font-bold text-indigo-600 dark:text-indigo-400">1983</p>
                                <h4 class="text-xl font-semibold text-gray-800 dark:text-gray-200">Establishment</h4>
                                <p class="text-gray-600 dark:text-gray-400">Founded as the Economics Science Institute (ESI).</p>
                            </div>
                            <div class="absolute left-1/2 -translate-x-1/2 w-4 h-4 bg-white dark:bg-gray-800 border-2 border-indigo-500 rounded-full"></div>
                        </div>
                        <!-- Item 2 -->
                        <div class="relative flex items-center">
                            <div class="w-1/2"></div>
                            <div class="w-1/2 pl-8">
                                <p class="font-bold text-indigo-600 dark:text-indigo-400">1991</p>
                                <h4 class="text-xl font-semibold text-gray-800 dark:text-gray-200">Rebranding</h4>
                                <p class="text-gray-600 dark:text-gray-400">Renamed to the National School of Management.</p>
                            </div>
                             <div class="absolute left-1/2 -translate-x-1/2 w-4 h-4 bg-white dark:bg-gray-800 border-2 border-indigo-500 rounded-full"></div>
                        </div>
                         <!-- Item 3 -->
                        <div class="relative flex items-center">
                            <div class="w-1/2 pr-8 text-right">
                                <p class="font-bold text-indigo-600 dark:text-indigo-400">2004</p>
                                <h4 class="text-xl font-semibold text-gray-800 dark:text-gray-200">University Status</h4>
                                <p class="text-gray-600 dark:text-gray-400">Officially became the National University of Management.</p>
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
