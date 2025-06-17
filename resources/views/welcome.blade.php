<!DOCTYPE html>
<html lang="en" x-data :class="{ 'dark': $store.theme.isDarkMode }">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome - National University of Management</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    
    <style>
        body { font-family: 'Figtree', sans-serif; scroll-behavior: smooth; }
        .hero-bg {
            background: linear-gradient(rgba(17, 24, 39, 0.7), rgba(17, 24, 39, 0.7)), url('https://numer.digital/public/faculties/MainSlide/num_front.jpg');
            background-size: cover;
            background-position: center;
        }
        .typed-cursor { opacity: 1; animation: blink 0.7s infinite; }
        @keyframes blink { 50% { opacity: 0; } }
        .fade-in-up { opacity: 0; transform: translateY(30px); transition: opacity 0.6s ease-out, transform 0.6s ease-out; }
        .is-visible { opacity: 1; transform: translateY(0); }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-gray-50 dark:bg-gray-900 text-gray-800 dark:text-gray-200">

    <div class="absolute top-0 left-0 w-full">
        <x-navbar />
    </div>

    <!-- Header & Hero Section -->
    <header id="home" class="hero-bg h-screen flex flex-col items-center justify-center text-white text-center p-4">
        <h1 class="text-4xl md:text-6xl font-bold leading-tight mb-4">
            National University of Management <br> Faculty of <span id="typed-text" class="text-cyan-400"></span><span class="typed-cursor">|</span>
        </h1>
        <p class="text-lg md:text-xl text-gray-300 max-w-2xl mb-8">
            Your gateway to a successful career in the world of technology. Find your passion with us.
        </p>
        <a href="#faculties" class="bg-cyan-500 text-white font-bold py-3 px-8 rounded-full hover:bg-cyan-600 transition-transform transform hover:scale-105 duration-300">
            Explore Our Programs
        </a>
    </header>

    <!-- Main Content: Faculties Section -->
    <main id="faculties" class="container mx-auto px-6 py-20">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white">Our Premier Faculties</h2>
            <p class="text-gray-600 dark:text-gray-400 mt-2">Discover the path that inspires you.</p>
            <div class="w-24 h-1 bg-cyan-500 mx-auto mt-4"></div>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-10">
            <!-- Card: Information Technology -->
            <div class="program-card bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden transform hover:-translate-y-2 transition-transform duration-300 fade-in-up">
                <div class="p-8">
                    <div class="text-cyan-500 mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/></svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-3">Information Technology (IT)</h3>
                    <p class="text-gray-600 dark:text-gray-400 leading-relaxed mb-6">
                        Dive deep into software development, network systems, and cybersecurity to build the digital world of tomorrow.
                    </p>
                    <a href="#" class="font-semibold text-cyan-600 hover:text-cyan-800 dark:text-cyan-400 dark:hover:text-cyan-200 transition duration-300">Learn More &rarr;</a>
                </div>
            </div>

            <!-- Card: Business Information Technology -->
            <div class="program-card bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden transform hover:-translate-y-2 transition-transform duration-300 fade-in-up">
                 <div class="p-8">
                    <div class="text-emerald-500 mb-4">
                       <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" /></svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-3">Business IT (BIT)</h3>
                    <p class="text-gray-600 dark:text-gray-400 leading-relaxed mb-6">
                        Merge technology with business acumen. Learn to leverage IT to solve complex business challenges and drive growth.
                    </p>
                    <a href="#" class="font-semibold text-emerald-600 hover:text-emerald-800 dark:text-emerald-400 dark:hover:text-emerald-200 transition duration-300">Learn More &rarr;</a>
                </div>
            </div>

            <!-- Card: Robotic Engineering -->
            <div class="program-card bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden transform hover:-translate-y-2 transition-transform duration-300 fade-in-up">
                 <div class="p-8">
                    <div class="text-purple-500 mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-3">Robotic Engineering</h3>
                    <p class="text-gray-600 dark:text-gray-400 leading-relaxed mb-6">
                        Design, build, and program intelligent systems. Pioneer the next generation of automation and artificial intelligence.
                    </p>
                    <a href="#" class="font-semibold text-purple-600 hover:text-purple-800 dark:text-purple-400 dark:hover:text-purple-200 transition duration-300">Learn More &rarr;</a>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white">
        <div class="container mx-auto px-6 py-8 text-center">
            <p>&copy; 2024 National University of Management. All Rights Reserved.</p>
            <p class="text-gray-400 text-sm mt-2">St. 96 Christopher Howes, Phnom Penh, Cambodia</p>
        </div>
    </footer>
    
    {{-- FIXED: Restored the script for animations --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const typedTextSpan = document.getElementById('typed-text');
            if (typedTextSpan) {
                const words = ["Information Technology.", "Business IT.", "Robotic Engineering."];
                let wordIndex = 0;
                let charIndex = 0;
                let isDeleting = false;

                function type() {
                    const currentWord = words[wordIndex];
                    if (isDeleting) {
                        typedTextSpan.textContent = currentWord.substring(0, charIndex - 1);
                        charIndex--;
                    } else {
                        typedTextSpan.textContent = currentWord.substring(0, charIndex + 1);
                        charIndex++;
                    }
                    if (!isDeleting && charIndex === currentWord.length) {
                        setTimeout(() => isDeleting = true, 2000);
                    } else if (isDeleting && charIndex === 0) {
                        isDeleting = false;
                        wordIndex = (wordIndex + 1) % words.length;
                    }
                    const typingSpeed = isDeleting ? 100 : 200;
                    setTimeout(type, typingSpeed);
                }
                type();
            }

            const cards = document.querySelectorAll('.fade-in-up');
            if (cards.length > 0) {
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            entry.target.classList.add('is-visible');
                        }
                    });
                }, { threshold: 0.1 });
                cards.forEach(card => observer.observe(card));
            }
        });
    </script>
</body>
</html>
