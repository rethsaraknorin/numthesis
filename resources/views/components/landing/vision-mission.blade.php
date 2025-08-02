{{-- Vision and Mission Section --}}
<section class="py-20 bg-white dark:bg-gray-800">
    <div class="container mx-auto px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white">{{ __('vision_mission_title') }}</h2>
            <p class="text-gray-600 dark:text-gray-400 mt-2">{{ __('vision_mission_subtitle') }}</p>
            <div class="w-24 h-1 bg-cyan-500 mx-auto mt-4"></div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
            {{-- Vision Card --}}
            <div class="text-center p-8">
                <div class="flex justify-center items-center mb-4 w-20 h-20 mx-auto bg-cyan-100 dark:bg-cyan-900/50 rounded-full">
                    <svg class="w-10 h-10 text-cyan-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">{{ __('vision_title') }}</h3>
                <p class="text-gray-600 dark:text-gray-400 leading-relaxed">
                    {{ __('vision_body') }}
                </p>
            </div>

            {{-- Mission Card --}}
            <div class="text-center p-8">
                <div class="flex justify-center items-center mb-4 w-20 h-20 mx-auto bg-purple-100 dark:bg-purple-900/50 rounded-full">
                    <svg class="w-10 h-10 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">{{ __('mission_title') }}</h3>
                <p class="text-gray-600 dark:text-gray-400 leading-relaxed">
                    {{ __('mission_body') }}
                </p>
            </div>
        </div>
    </div>
</section>