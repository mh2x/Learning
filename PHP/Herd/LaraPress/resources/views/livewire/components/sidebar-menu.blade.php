<?php
use App\Livewire\Actions\Logout;
use Illuminate\Support\Facades\Auth;
use Livewire\Volt\Component;

new class extends Component {}; ?>
<div>
    {{-- MENU --}}
    {{-- heroicons: https://blade-ui-kit.com/blade-icons?set=1#search --}}
    <x-menu activate-by-route>
        <x-menu-item title="{{ __('Dashboard') }}" icon="o-sparkles" link="/dashboard" />
        <x-menu-item title="{{ __('Users') }}" icon="o-users" link="/users" />
        <x-menu-sub title="{{ __('Settings') }}" icon="o-cog-6-tooth">
            <x-menu-item title="{{ __('General') }}" icon="m-newspaper" link="####" />
            <x-menu-item title="{{ __('Maintenance') }}" icon="s-stop-circle" link="####" />
            <x-menu-item title="{{ __('Mail') }}" icon="o-envelope" link="####" />
            <x-menu-item title="{{ __('Currency') }}" icon="o-archive-box" link="####" />
            <x-menu-item title="{{ __('Logo') }}" icon="o-archive-box" link="####" />
            <x-menu-item title="{{ __('SMS') }}" icon="o-archive-box" link="####" />
            <x-menu-item title="{{ __('Social Logins') }}" icon="o-archive-box" link="####" />
            <x-menu-item title="{{ __('Payment Methods') }}" icon="o-archive-box" link="####" />
        </x-menu-sub>
    </x-menu>
</div>
