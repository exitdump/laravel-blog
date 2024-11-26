@props(['active', 'hasSubmenu' => false])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-1 pt-1 border-b-2 border-indigo-400 text-sm font-medium leading-5 text-gray-900 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out'
            : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out';

$submenuClasses = 'relative group cursor-pointer';
@endphp

<div {{ $hasSubmenu ? $attributes->merge(['class' => $submenuClasses]) : '' }}>
    <a {{ $attributes->merge(['class' => $hasSubmenu ? "inline-flex items-center px-1" : $classes.' py-5' ]) }}>
        {{ $slot }}
        @if($hasSubmenu)
            <svg class="ml-2 w-4 h-4 text-gray-500 group-hover:text-gray-700" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
        @endif
    </a>

    @if($hasSubmenu)
        <div class="absolute left-0 hidden w-48 py-2 bg-white border border-gray-200 rounded shadow-lg group-hover:block">
            {{ $submenu }}
        </div>
    @endif
</div>
