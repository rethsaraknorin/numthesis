@extends('layouts.app')

@section('content')
<div class="wrapper">
    {{-- Include static sidebar --}}
    @include('layouts.aside')

    {{-- Main Content --}}
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ __('Dashboard') }}
                </h2>
            </div>
        </div>

        <div class="content">
            <div class="container-fluid">
                <div class="py-12">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6 text-gray-900 dark:text-gray-100">
                                {{ __("You're logged in!") }}
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Logout Form --}}
                <div class="text-right mt-4">
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <x-dropdown-link :href="route('logout')"
                            onclick="event.preventDefault();
                                     this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-dropdown-link>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
