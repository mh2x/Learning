@props(['size' => 'base'])

@php
    $classes = 'bg-white/10 hover:bg-white/30 rounded-xl text-2xs transition-colors duration 300';

    if ($size == 'small') {
        $classes .= ' px-3 y-1 text-2xs';
    } else {
        $classes .= ' px-4 y-1 text-sm';
    }
@endphp
<a class="{{ $classes }}">
    {{ $slot }}
</a>
