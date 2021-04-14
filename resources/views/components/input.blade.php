@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'rounded-sm bg-gray-50 px-4 ring-1 ring-gray-100 shadow-xs focus:ring-1 focus:ring-indigo-600 focus:outline-none  w-full py-2']) !!}>
