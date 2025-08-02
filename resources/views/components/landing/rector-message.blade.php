{{-- Rector's Welcome Message Section --}}
<section class="py-20 bg-gray-50 dark:bg-gray-800/50">
    <div class="container mx-auto px-6 lg:px-8">
        <div class="flex flex-col md:flex-row items-center gap-12">
            {{-- Rector's Image --}}
            <div class="md:w-1/3 text-center">
                <img src="https://num.e-khmer.com/wp-content/uploads/2023/08/rector3.png" alt="Rector of NUM" class="w-64 h-64 mx-auto object-cover">
            </div>
            
            {{-- Rector's Message --}}
            <div class="md:w-2/3">
                <h2 class="text-3xl font-bold text-gray-900 dark:text-white">{{ __('rector_message_title') }}</h2>
                <div class="w-24 h-1 bg-cyan-500 mt-2 mb-6"></div>
                <p class="text-lg text-gray-600 dark:text-gray-300 leading-relaxed mb-4">
                    "{{ __('rector_message_body') }}"
                </p>
                <p class="text-xl font-semibold text-gray-900 dark:text-white">{{ __('rector_name') }}</p>
                <p class="text-md text-gray-500 dark:text-gray-400">{{ __('rector_title') }}</p>
            </div>
        </div>
    </div>
</section>