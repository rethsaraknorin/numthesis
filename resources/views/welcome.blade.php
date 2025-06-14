<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome - University of Innovation</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    
    <!-- Custom Styles -->
    <style>
        /* Use Poppins as the default font */
        body {
            font-family: 'Poppins', sans-serif;
            scroll-behavior: smooth;
        }
        
        /* Background for the hero section */
        .hero-bg {
            background: linear-gradient(rgba(17, 24, 39, 0.8), rgba(17, 24, 39, 0.8)), url('https://placehold.co/1920x1080/4A5568/E2E8F0?text=Modern+Campus');
            background-size: cover;
            background-position: center;
        }

        /* Typing cursor effect */
        .typed-cursor {
            opacity: 1;
            animation: blink 0.7s infinite;
        }
        @keyframes blink {
            0%, 100% { opacity: 1; }
            50% { opacity: 0; }
        }

        /* Scroll-in animation styles */
        .fade-in-up {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.6s ease-out, transform 0.6s ease-out;
        }

        .is-visible {
            opacity: 1;
            transform: translateY(0);
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-800">

   <!-- Navbar -->
    @include('layouts.navbar')

    <!-- Header & Hero Section -->
    <header id="home" class="hero-bg h-screen flex flex-col items-center justify-center text-white text-center p-4">
        <h1 class="text-4xl md:text-6xl font-bold leading-tight mb-4">
            Welcome to the Future of <br>
            <span id="typed-text" class="text-cyan-400"></span><span class="typed-cursor">|</span>
        </h1>
        <p class="text-lg md:text-xl text-gray-300 max-w-2xl mb-8">
            Pioneering education in technology and engineering to shape the innovators of tomorrow.
        </p>
        <a href="#faculties" class="bg-cyan-500 text-white font-bold py-3 px-8 rounded-full hover:bg-cyan-600 transition-transform transform hover:scale-105 duration-300">
            Explore Our Programs
        </a>
    </header>

    <!-- Main Content: Faculties Section -->
    <main id="faculties" class="container mx-auto px-6 py-20">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900">Our Premier Faculties</h2>
            <p class="text-gray-600 mt-2">Discover the path that inspires you.</p>
            <div class="w-24 h-1 bg-cyan-500 mx-auto mt-4"></div>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-10">
            <!-- Card: Information Technology -->
            <div class="program-card bg-white rounded-xl shadow-lg overflow-hidden transform hover:-translate-y-2 transition-transform duration-300 fade-in-up">
                <div class="p-8">
                    <div class="text-cyan-500 mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/></svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-3">Information Technology (IT)</h3>
                    <p class="text-gray-600 leading-relaxed mb-6">
                        Dive deep into software development, network systems, and cybersecurity to build the digital world of tomorrow.
                    </p>
                    <a href="#" class="font-semibold text-cyan-600 hover:text-cyan-800 transition duration-300">Learn More &rarr;</a>
                </div>
            </div>

            <!-- Card: Business Information Technology -->
            <div class="program-card bg-white rounded-xl shadow-lg overflow-hidden transform hover:-translate-y-2 transition-transform duration-300 fade-in-up">
                 <div class="p-8">
                    <div class="text-emerald-500 mb-4">
                       <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" /></svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-3">Business IT (BIT)</h3>
                    <p class="text-gray-600 leading-relaxed mb-6">
                        Merge technology with business acumen. Learn to leverage IT to solve complex business challenges and drive growth.
                    </p>
                    <a href="#" class="font-semibold text-emerald-600 hover:text-emerald-800 transition duration-300">Learn More &rarr;</a>
                </div>
            </div>

            <!-- Card: Robotic Engineering -->
            <div class="program-card bg-white rounded-xl shadow-lg overflow-hidden transform hover:-translate-y-2 transition-transform duration-300 fade-in-up">
                 <div class="p-8">
                    <div class="text-purple-500 mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-3">Robotic Engineering</h3>
                    <p class="text-gray-600 leading-relaxed mb-6">
                        Design, build, and program intelligent systems. Pioneer the next generation of automation and artificial intelligence.
                    </p>
                    <a href="#" class="font-semibold text-purple-600 hover:text-purple-800 transition duration-300">Learn More &rarr;</a>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white">
        <div class="container mx-auto px-6 py-8 text-center">
            <p>&copy; All Rights Reserved.</p>
            <p class="text-gray-400 text-sm mt-2">St.96 Christopher Howes Phnom Penh BS16, AP18</p>
        </div>
    </footer>

    <!-- JavaScript for interactivity -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            
            // --- Typing Animation ---
            const typedTextSpan = document.getElementById('typed-text');
            const words = ["Technology.", "Innovation.", "Engineering."];
            let wordIndex = 0;
            let charIndex = 0;
            let isDeleting = false;

            function type() {
                const currentWord = words[wordIndex];
                
                if (isDeleting) {
                    // Remove char
                    typedTextSpan.textContent = currentWord.substring(0, charIndex - 1);
                    charIndex--;
                } else {
                    // Add char
                    typedTextSpan.textContent = currentWord.substring(0, charIndex + 1);
                    charIndex++;
                }

                if (!isDeleting && charIndex === currentWord.length) {
                    // Pause at end of word
                    setTimeout(() => isDeleting = true, 2000);
                } else if (isDeleting && charIndex === 0) {
                    isDeleting = false;
                    wordIndex = (wordIndex + 1) % words.length;
                }
                
                const typingSpeed = isDeleting ? 100 : 200;
                setTimeout(type, typingSpeed);
            }
            
            type();

            // --- Scroll-in Animation for Program Cards ---
            const cards = document.querySelectorAll('.fade-in-up');
            
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('is-visible');
                    }
                });
            }, {
                threshold: 0.1 // Trigger when 10% of the element is visible
            });

            cards.forEach(card => {
                observer.observe(card);
            });
        });
    </script>
</body>
</html>
