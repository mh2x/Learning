<?php
use App\Livewire\Actions\Logout;
use Illuminate\Support\Facades\Auth;
use Livewire\Volt\Component;

new class extends Component {}; ?>

<div class="w-full">
    <x-slot:sidebar drawer="main-drawer" collapsible class="dark:bg-gray-700">
        {{-- User --}}
        @if ($user = auth()->user())
            <x-list-item :item="$user" value="name" sub-value="email" no-separator no-hover class="text-sm">
                <x-slot:actions>
                    <x-button icon="o-power" class="btn-circle btn-ghost btn-xs" tooltip-left="Logout" no-wire-navigate link="/logout" />
                </x-slot:actions>
            </x-list-item>

            <x-menu-separator />
        @endif

        {{-- MENU --}}
        <x-menu activate-by-route>
            <x-menu-item title="{{ __('Dashboard') }}" icon="o-sparkles" link="/dashboard" />
            <x-menu-item title="{{ __('Users') }}" icon="o-users" link="/users" />
            <x-menu-sub title="{{ __('Settings') }}" icon="o-cog-6-tooth">
                <x-menu-item title="{{ __('Wifi') }}" icon="o-wifi" link="####" />
                <x-menu-item title="{{ __('Archives') }}" icon="o-archive-box" link="####" />
            </x-menu-sub>
        </x-menu>
    </x-slot:sidebar>

</div>
