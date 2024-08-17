@php
    $classes =
        'cursor-pointer p-5 bg-white/5 rounded-xl border border-transparent hover:border-blue-800 group transition-colors duration-300';
@endphp

<div {{ $attributes(['class' => $classes]) }}>

    {{ $slot }}
</div>
