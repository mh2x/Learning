<div class="w-ful">
    <x-slot:sidebar drawer="main-drawer" collapsible {{ $attributes }} class="bg-base-100">
        {{-- User --}}
        @if (auth()->user())
            @livewire('sidebar-user')
            <x-separator />
        @endif
        {{-- Menu --}}
        @livewire('sidebar-menu')
    </x-slot:sidebar>
</div>
