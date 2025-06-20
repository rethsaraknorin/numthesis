@props(['active'])

@php
$classes = ($active ?? false)
            ? 'flex items-center w-full px-3 py-3 text-sm font-semibold text-gray-900 dark:text-white border-b-2 border-indigo-500 transition-colors duration-150'
            : 'flex items-center w-full px-3 py-3 text-sm font-medium text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white border-b-2 border-transparent hover:border-gray-300 dark:hover:border-gray-600 transition-colors duration-150';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>