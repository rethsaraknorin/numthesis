<!DOCTYPE html>
<html lang="en" x-data :class="{ 'dark': $store.theme.isDarkMode }">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Achievements - IT Faculty - National University of Management</title>
    
    <link rel="icon" href="{{ asset('assets/logo/num-logo.png') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    
    <style>
        .hero-bg-achievements {
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
        <header class="hero-bg-achievements h-96 flex items-center justify-center text-white">
            <div class="text-center px-4">
                <h1 class="text-5xl font-bold">Our Achievements</h1>
                <p class="mt-4 text-xl text-gray-300">Celebrating the success of our students and faculty.</p>
            </div>
        </header>

        <section class="py-20 bg-white dark:bg-gray-800">
            <div class="container mx-auto px-6 lg:px-8">

                <div>
                    <h2 class="text-3xl font-bold text-center text-gray-900 dark:text-white mb-12">Student Competitions & Awards</h2>
                    <div class="grid md:grid-cols-1 lg:grid-cols-2 gap-10">
                        
                        <div class="bg-gray-50 dark:bg-gray-900/50 p-6 rounded-xl shadow-lg transition-transform transform hover:-translate-y-1">
                            <h3 class="text-2xl font-bold text-indigo-600 dark:text-indigo-400 mb-4">International Business Model Competition</h3>
                            <p class="text-gray-600 dark:text-gray-400">
                                NUM's student team, "Khmer Social Tour," achieved incredible success by advancing to the top 10 and receiving an "Honorable Mention" at this prestigious competition in the USA, placing ahead of teams from Harvard and MIT.
                            </p>
                        </div>

                        <div class="bg-gray-50 dark:bg-gray-900/50 p-6 rounded-xl shadow-lg transition-transform transform hover:-translate-y-1">
                            <h3 class="text-2xl font-bold text-indigo-600 dark:text-indigo-400 mb-4">Mekong Business Challenge</h3>
                            <p class="text-gray-600 dark:text-gray-400">
                                The student team "RIP Funeral Event Agency" won the gold medal in this highly competitive regional tournament, showcasing their skills against top universities from across the Mekong region.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="mt-20">
                    <h2 class="text-3xl font-bold text-center text-gray-900 dark:text-white mb-12">Scholarships & Key Partnerships</h2>
                     <div class="grid md:grid-cols-1 lg:grid-cols-2 gap-10">
                        
                        <div class="bg-gray-50 dark:bg-gray-900/50 p-6 rounded-xl shadow-lg transition-transform transform hover:-translate-y-1">
                            <h3 class="text-2xl font-bold text-indigo-600 dark:text-indigo-400 mb-4">USAID Digital Workforce Development</h3>
                            <p class="text-gray-600 dark:text-gray-400">
                                Through this project, 18 students from our IT and Digital Economy faculties received full scholarships. The project also provided international training for faculty and helped establish a Career Placement Centre at NUM.
                            </p>
                        </div>

                        <div class="bg-gray-50 dark:bg-gray-900/50 p-6 rounded-xl shadow-lg transition-transform transform hover:-translate-y-1">
                            <h3 class="text-2xl font-bold text-indigo-600 dark:text-indigo-400 mb-4">The Chen Zhi Scholarship</h3>
                            <p class="text-gray-600 dark:text-gray-400">
                                In partnership with Prince Group and the Ministry of Education, this program provides full tuition and stipends for students in the Digital Economy program, supporting the next generation of digital leaders.
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </main>
    <x-footer />
</body>
</html>