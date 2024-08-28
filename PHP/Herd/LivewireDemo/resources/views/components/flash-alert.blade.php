@props(['key'])
@if (session($key))
    <span {{ $attributes->merge(['class' => 'text-sm text-green-600 dark:text-greeb-400 space-y-1']) }}>
        {{ session($key) }}
    </span>
@endif
