<x-nav-link href="/" :active="request()->routeIs('home')" wire:navigate>
    {{ __('Home') }}
</x-nav-link>

@auth
    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" wire:navigate>
        {{ __('Dashboard') }}
    </x-nav-link>
    <x-nav-link href="/chirper" :active="request()->routeIs('chirper')" wire:navigate>
        {{ __('Chirper') }}
    </x-nav-link>
    <x-nav-link href="/todo" :active="request()->routeIs('todo')" wire:navigate>
        {{ __('TODO') }}
    </x-nav-link>
@endauth

@guest
@endguest
<x-nav-link href="/facedetection" :active="request()->routeIs('facedetection')" wire:navigate>
    {{ __('Face Detection') }}
</x-nav-link>

<x-nav-link href="/playground" :active="request()->routeIs('playground')" wire:navigate>
    {{ __('Playground') }}
</x-nav-link>
