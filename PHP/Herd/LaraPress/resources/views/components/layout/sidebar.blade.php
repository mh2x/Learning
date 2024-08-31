<div class="w-full">
    <x-slot:sidebar drawer="main-drawer" collapsible class="dark:bg-gray-800" {{ $attributes }}>
        {{-- User --}}
        @if (auth()->user())
            <livewire:sidebar-user />
            <x-menu-separator />
        @endif
        {{-- Menu --}}
        <livewire:sidebar-menu />
    </x-slot:sidebar>
</div>
