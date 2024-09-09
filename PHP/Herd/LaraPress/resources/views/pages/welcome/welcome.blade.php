<?php

use Livewire\Volt\Component;

new class extends Component {
    public function mount()
    {
        dd('mounted');
    }
}; ?>

<x-general-layout>
    <div class="max-w-5xl">
        <div class="h-20"></div>
        <span class="font-bold text-gray-200 max-w-5xl text-7xl">
            Spend less time coding and more time creating with
        </span>
        <span class="font-bold text-7xl bg-gradient-to-r from-purple-500 to-pink-300 bg-clip-text text-transparent ">
            LaraPress!
        </span>
    </div>
    <div class="h-10"></div>
    <p class="max-w-2xl font-serif text-xl text-gray-400 md:text-2xl">
        Building <span class="text-purple-400 font-bold">Laravel</span> websites with <strong>low-code / no-code</strong>
    <p class="self-start inline font-sans text-xl font-medium text-transparent bg-clip-text bg-gradient-to-br from-purple-700 to-purple-300">
        made simple and fun!
    </p>

    </p>

    <div class="grid md:grid-cols-2">
        <div class="flex flex-col justify-stretch">
        </div>
        <div>
            <div class="-mr-10 rounded-lg md:rounded-l-full bg-gradient-to-br from-purple-700 to-purple-300 h-64">
            </div>
        </div>
    </div>

    <div class="h-32 md:h-40"></div>
    <div class="grid gap-4 md:grid-cols-3">
        <div class="flex-col p-8 py-16 rounded-lg shadow-2xl md:p-12 bg-gradient-to-br from-gray-800 to-black">
            <p class="flex items-center justify-center text-4xl font-semibold text-white bg-green-800 rounded-full shadow-lg w-14 h-14">
                1
            </p>
            <div class="h-6"></div>
            <p class="font-serif text-3xl">Build your website directly in the browser</p>
        </div>
        <div class="flex-col p-8 py-16 rounded-lg shadow-2xl md:p-12 bg-gradient-to-b from-gray-800 to-black">
            <p class="flex items-center justify-center text-4xl font-semibold text-white bg-blue-800 rounded-full shadow-lg w-14 h-14">
                2
            </p>
            <div class="h-6"></div>
            <p class="font-serif text-3xl">
                Add pages, menus, tables, users, relations and much more..
            </p>
        </div>
        <div class="flex-col p-8 py-16 rounded-lg shadow-2xl md:p-12 bg-gradient-to-bl from-gray-800 to-black">
            <p class="flex items-center justify-center text-4xl font-semibold text-white bg-purple-800 rounded-full shadow-lg w-14 h-14">
                3
            </p>
            <div class="h-6"></div>
            <p class="font-serif text-3xl">We made it simple and easy to do</p>
        </div>
    </div>


    <div class="h-32 md:h-40"></div>
</x-general-layout>
