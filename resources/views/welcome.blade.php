<!DOCTYPE html>
<html lang="en" x-data :class="{ 'dark': $store.theme.isDarkMode }">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome - National University of Management</title>
    
    <link rel="icon" href="{{ asset('assets/logo/num-logo.png') }}">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kantumruy+Pro:ital,wght@0,100..700;1,100..700&display=swap" rel="stylesheet">
    
    <style>
        body { font-family: 'Figtree', 'Kantumruy Pro', sans-serif; scroll-behavior: smooth; }
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

    <x-navbar />

    <header id="home" class="hero-bg h-screen flex flex-col items-center justify-center text-white text-center p-4">
        <h1 class="text-4xl md:text-6xl font-bold leading-tight mb-4">
            {{ __('welcome_title_prefix') }} <br> <span id="typed-text" class="text-cyan-400"></span><span class="typed-cursor">|</span>
        </h1>
        <p class="text-lg md:text-xl text-gray-300 max-w-2xl mb-8">
            {{ __('welcome_subtitle') }}
        </p>
        <a href="#faculties" class="bg-cyan-500 text-white font-bold py-3 px-8 rounded-full hover:bg-cyan-600 transition-transform transform hover:scale-105 duration-300">
            {{ __('explore_programs') }}
        </a>
    </header>

    <main>
        <x-landing.rector-message />
        <x-landing.vision-mission />
        <x-landing.program-cards />
        <x-landing.school-events />
        <x-landing.chatbot-intro />

    </main>

    <x-footer />
    
    <script>
        // Your existing JS for typed text and fade-in effects
        document.addEventListener('DOMContentLoaded', function() {
            const typedTextSpan = document.getElementById('typed-text');
            if (typedTextSpan) {
                const words = ["{{ __('welcome_typed_it') }}", "{{ __('welcome_typed_bit') }}", "{{ __('welcome_typed_robotics') }}"];
                let wordIndex = 0, charIndex = 0, isDeleting = false;
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
                    setTimeout(type, isDeleting ? 100 : 200);
                }
                type();
            }
            const cards = document.querySelectorAll('.fade-in-up');
            if (cards.length > 0) {
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) entry.target.classList.add('is-visible');
                    });
                }, { threshold: 0.1 });
                cards.forEach(card => observer.observe(card));
            }
        });
    </script>
</body>
</html>