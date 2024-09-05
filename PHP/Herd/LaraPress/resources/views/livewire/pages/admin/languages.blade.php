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
        {{ __('Languages') }}
    </x-slot:title>
    <div class="max-w-5xl">
        <span class="font-bold text-yellow-400 max-w-5xl text-3xl">
            Languages Management...
        </span>
    </div>
</div>