<?php
use App\Livewire\Actions\Logout;
use Illuminate\Support\Facades\Auth;
use Livewire\Volt\Component;

new class extends Component {
    public function Logout(): void
    {
        Auth::guard('web')->logout();

        Session::invalidate();
        Session::regenerateToken();

        header('Location: /', true);
        die();
    }
}; ?>
<div class="hidden md:block">
    {{-- User --}}
    @if ($user = auth()->user())
        <x-dropdown :label="$user->name" class="w-full bg-transparent border-transparent">
            <x-menu-item title="{{ __('Profile') }}" icon="o-user" link="/profile" />
            <x-menu-separator />
            <x-menu-item title="{{ __('Logout') }}" icon="o-power" wire:click="Logout" />
        </x-dropdown>
    @endif
</div>
