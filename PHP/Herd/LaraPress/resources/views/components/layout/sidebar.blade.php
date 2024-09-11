<div class="w-full">
    <x-slot:sidebar drawer="main-drawer" collapsible {{ $attributes }}>
        {{-- User --}}
        @if (auth()->user())
            @livewire('sidebar-user')
            <hr class="border-base-300 m-2" />
        @endif
        {{-- Menu --}}
        @livewire('sidebar-menu')
    </x-slot:sidebar>
</div>
