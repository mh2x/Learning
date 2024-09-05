<?php

use Livewire\Volt\Component;

new class extends Component {
    public function mount()
    {
        //dd('mounted');
    }
}; ?>

<div>
    <x-slot:title>
        {{ __('VoltView') }}
    </x-slot:title>
    <div class="max-w-5xl">
        <div class="h-20"></div>
        <span class="font-bold text-gray-200 max-w-5xl text-7xl">
            Volt View
        </span>
    </div>
</div>
