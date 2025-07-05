<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Our Academic Programs') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h3 class="text-3xl font-bold text-gray-900 dark:text-white">Find Your Path in Technology</h3>
                <p class="text-md text-gray-600 dark:text-gray-400 mt-2">Explore our specialized programs designed to launch your career in IT.</p>
            </div>

            {{-- UPDATED: Changed from a multi-column grid to a single-column layout (space-y-8) --}}
            <div class="space-y-8">
                @foreach ($programs as $program)
                    {{-- UPDATED: Card now uses a flexbox layout for a single row appearance --}}
                    <div class="bg-white dark:bg-gray-800 border border-transparent dark:border-gray-700 rounded-lg shadow-lg flex items-center hover:shadow-xl transition-shadow duration-300">
                        <div class="p-6">
                            {{-- Icon --}}
                            <div class="text-cyan-500">
                                @if($program->code === 'IT')
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/></svg>
                                @elseif($program->code === 'BIT')
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" /></svg>
                                @else
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
                                @endif
                            </div>
                        </div>
                        <div class="p-6 flex-grow">
                            <h5 class="text-xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $program->name }} ({{$program->code}})</h5>
                            <p class="font-normal text-gray-600 dark:text-gray-400 mt-1">{{ $program->description }}</p>
                            @if($program->price_per_year)
                                <div class="text-sm text-gray-800 dark:text-gray-200 mt-2">
                                    <span class="font-semibold">Starting from:</span> 
                                    <span class="text-lg font-bold">${{ number_format($program->price_per_year, 2) }}</span>/year
                                </div>
                            @endif
                        </div>
                        <div class="p-6">
                            <a href="{{ route('programs.show', $program) }}" class="inline-flex items-center font-semibold text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-200">
                                View Curriculum
                                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>