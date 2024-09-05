<div>
    <x-slot:title>
        {{ __('Livewire:View') }}
    </x-slot>

    <div class="max-w-5xl">
        <div class="h-20"></div>
        <span class="font-bold text-blue-300 max-w-5xl text-7xl">
            Livewire View Example
        </span>
    </div>
    <h1>Count: {{ $count }}</h1> <button wire:click='increment'>Increment</button>
    <button class="p-1 m-1 border border-red-600" wire:click='increment(10)'>Increment by 10</button>
</div>
