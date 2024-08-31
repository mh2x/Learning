<?php
use App\Livewire\Actions\Logout;
use Illuminate\Support\Facades\Auth;
use Livewire\Volt\Component;

new class extends Component {}; ?>
<div>
    {{-- MENU --}}
    <x-menu activate-by-route>
        <x-menu-item title="{{ __('Dashboard') }}" icon="o-sparkles" link="/dashboard" />
        <x-menu-item title="{{ __('Users') }}" icon="o-users" link="/users" />
        <x-menu-sub title="{{ __('Settings') }}" icon="o-cog-6-tooth">
            <x-menu-item title="{{ __('Wifi') }}" icon="o-wifi" link="####" />
            <x-menu-item title="{{ __('Archives') }}" icon="o-archive-box" link="####" />
        </x-menu-sub>
    </x-menu>
</div>
