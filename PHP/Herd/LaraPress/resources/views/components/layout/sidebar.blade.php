<div class="w-full">
    <x-slot:sidebar drawer="main-drawer" collapsible {{ $attributes }}>
        {{-- User --}}
        @if (auth()->user())
            @livewire('sidebar-user')
            <x-separator />
        @endif
        {{-- Menu --}}
        @livewire('sidebar-menu')
    </x-slot:sidebar>
</div>
