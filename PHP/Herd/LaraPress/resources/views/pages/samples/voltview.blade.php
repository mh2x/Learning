<?php

use Livewire\Volt\Component;
use function Laravel\Folio\{name};
name('voltview');

new class extends Component {
    public function mount()
    {
        //dd('mounted');
    }
}; ?>

<x-guest-layout>
    @volt
        <div class="flex flex-col items-center justify-center">
            <x-slot:title>
                {{ __('VoltView') }}
            </x-slot:title>
            <div class="max-w-5xl">
                <div class="h-20"></div>
                <span class="font-bold text-gray-200 max-w-5xl text-7xl">
                    Volt View
                </span>
                <div>
                    <h1 class="m-10 text-violet-500 text-xl font-bold text-center">using guest layout</h1>
                </div>
            </div>
        </div>
    @endvolt
</x-guest-layout>
