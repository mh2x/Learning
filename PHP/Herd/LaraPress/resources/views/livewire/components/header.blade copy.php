<?php
use App\Livewire\Actions\Logout;
use Illuminate\Support\Facades\Auth;
use Livewire\Volt\Component;

new class extends Component {}; ?>

<div class="w-ful">
    {{-- NAVBAR mobile only --}}
    <x-nav sticky full-width progress-indicator class="dark:bg-gray-900/20">
        <x-slot:brand>
            <x-app-brand />
            <div class="w-full flex flex-row justify-center">
                <x-nav-menu />
            </div>

        </x-slot:brand>
        <div>
            <x-slot:middle class="!justify-center">
                <x-slot:actions>
                    <livewire:user-dropdown />
                    <label for="main-drawer" class="lg:hidden me-3">
                        <x-icon name="o-bars-3" class="cursor-pointer" />
                    </label>
                </x-slot:actions>
            </x-slot:middle>
        </div>
    </x-nav>

</div>
