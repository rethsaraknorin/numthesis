{{-- Program Cards Section --}}
<section id="faculties" class="container mx-auto px-6 py-20">
    <div class="text-center mb-16">
        <h2 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white">{{ __('our_faculties') }}</h2>
        <p class="text-gray-600 dark:text-gray-400 mt-2">{{ __('discover_path') }}</p>
        <div class="w-24 h-1 bg-cyan-500 mx-auto mt-4"></div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-5xl mx-auto">
        {{-- Card: Information Technology --}}
        <div class="program-card bg-white dark:bg-gray-800 rounded-xl shadow-lg flex items-center transform hover:-translate-y-1 transition-transform duration-300 fade-in-up">
            <div class="p-8">
                <div class="text-cyan-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/></svg>
                </div>
            </div>
            <div class="p-6 flex-grow">
                <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100">{{ __('it_title') }}</h3>
                <p class="text-gray-600 dark:text-gray-400 leading-relaxed mt-1">
                    {{ __('it_desc') }}
                </p>
                 {{-- FINAL Link Update --}}
                 <a href="{{ route('page.program.show', ['program' => 1]) }}" class="font-semibold text-cyan-600 hover:text-cyan-800 dark:text-cyan-400 dark:hover:text-cyan-200 transition duration-300 mt-4 inline-block">{{ __('learn_more') }} &rarr;</a>
            </div>
        </div>

        {{-- Card: Business Information Technology --}}
        <div class="program-card bg-white dark:bg-gray-800 rounded-xl shadow-lg flex items-center transform hover:-translate-y-1 transition-transform duration-300 fade-in-up">
             <div class="p-8">
                <div class="text-emerald-500">
                   <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" /></svg>
                </div>
             </div>
             <div class="p-6 flex-grow">
                <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100">{{ __('bit_title') }}</h3>
                <p class="text-gray-600 dark:text-gray-400 leading-relaxed mt-1">
                    {{ __('bit_desc') }}
                </p>
                 {{-- FINAL Link Update --}}
                 <a href="{{ route('page.program.show', ['program' => 2]) }}" class="font-semibold text-emerald-600 hover:text-emerald-800 dark:text-emerald-400 dark:hover:text-emerald-200 transition duration-300 mt-4 inline-block">{{ __('learn_more') }} &rarr;</a>
             </div>
        </div>

        {{-- Card: Robotic Engineering --}}
        <div class="program-card bg-white dark:bg-gray-800 rounded-xl shadow-lg flex items-center transform hover:-translate-y-1 transition-transform duration-300 fade-in-up">
             <div class="p-8">
                <div class="text-purple-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
                </div>
             </div>
             <div class="p-6 flex-grow">
                <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100">{{ __('robotics_title') }}</h3>
                <p class="text-gray-600 dark:text-gray-400 leading-relaxed mt-1">
                    {{ __('robotics_desc') }}
                </p>
                 {{-- FINAL Link Update --}}
                 <a href="{{ route('page.program.show', ['program' => 3]) }}" class="font-semibold text-purple-600 hover:text-purple-800 dark:text-purple-400 dark:hover:text-purple-200 transition duration-300 mt-4 inline-block">{{ __('learn_more') }} &rarr;</a>
             </div>
        </div>

        {{-- Card: Computer Science --}}
        <div class="program-card bg-white dark:bg-gray-800 rounded-xl shadow-lg flex items-center transform hover:-translate-y-1 transition-transform duration-300 fade-in-up">
             <div class="p-8">
                <div class="text-rose-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                </div>
             </div>
             <div class="p-6 flex-grow">
                <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100">Computer Science (CS)</h3>
                <p class="text-gray-600 dark:text-gray-400 leading-relaxed mt-1">
                    Explores the theoretical foundations of information and computation, from algorithms to AI.
                </p>
                 {{-- FINAL Link Update --}}
                 <a href="{{ route('page.program.show', ['program' => 4]) }}" class="font-semibold text-rose-600 hover:text-rose-800 dark:text-rose-400 dark:hover:text-rose-200 transition duration-300 mt-4 inline-block">{{ __('learn_more') }} &rarr;</a>
            </div>
        </div>
    </div>
</section>