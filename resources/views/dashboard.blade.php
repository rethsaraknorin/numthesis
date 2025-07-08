<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-900 rounded-xl shadow p-6">
            {{-- This view now dynamically displays content based on user approval status --}}
            @if(Auth::user()->is_approved)
                @include('dashboard.partials.student-dashboard')
            @else
                @include('dashboard.partials.normal-dashboard')
            @endif
        </div>
    </div>
</x-app-layout>
