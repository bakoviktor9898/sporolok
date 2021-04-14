@props(['right' => false])

<div {!! $attributes->merge(['class' => 'mt-3 flex flex-col md:flex-row md:items-center']) !!}>
    {{ $slot }}
</div>
