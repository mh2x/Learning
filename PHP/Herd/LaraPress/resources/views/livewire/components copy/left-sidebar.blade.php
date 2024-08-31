<?php
use App\Livewire\Actions\Logout;
use Illuminate\Support\Facades\Auth;
use Livewire\Volt\Component;

new class extends Component {}; ?>

<div class="w-full">

    <x-slot:sidebar drawer="main-drawer" collapsible class="bg-gray-900">
        {{-- MENU --}}
        <x-menu activate-by-route>
            <x-menu-item title="Home" icon="o-sparkles" link="/" />
            <x-menu-item title="Users" icon="o-users" link="/users" />
            <x-menu-sub title="Settings" icon="o-cog-6-tooth">
                <x-menu-item title="Wifi" icon="o-wifi" link="####" />
                <x-menu-item title="Archives" icon="o-archive-box" link="####" />
            </x-menu-sub>
        </x-menu>
    </x-slot:sidebar>

</div>
