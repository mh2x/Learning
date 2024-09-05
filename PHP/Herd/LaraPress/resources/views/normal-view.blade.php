<?php

use Livewire\Volt\Component;

new class extends Component {
    public function mount()
    {
        //it doesn't mount
        dd('mounted');
    }
}; ?>

<x-general-layout>
    <div class="max-w-5xl">
        <div class="h-20"></div>
        <span class="font-bold text-gray-200 max-w-5xl text-7xl">
            Normal Blade View
        </span>
    </div>
</x-general-layout>
