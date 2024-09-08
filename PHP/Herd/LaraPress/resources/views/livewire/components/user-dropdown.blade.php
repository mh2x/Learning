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
        <div class="dropdown">
            <div tabindex="0" role="button" class="btn btn-ghost">
                <x-avatar image="{{ $user->avatar ?? '/images/empty-user.jpg' }}" :title="$user->name" />
                <svg class="inline w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5"></path>
                </svg>
            </div>

            <div tabindex="0" class="dropdown-content menu bg-base-100 rounded-box z-[1] w-full p-2 shadow">
                <div class="border border-gray-800 p-3">
                    <p class="text-md">{{ __('Admin') }}</p>
                    <p class="text-sm text-gray-400">{{ $user->email }}</p>
                    <x-hr />
                    <x-menu-item title="{{ __('Profile') }}" icon="o-user" link="/profile" />
                    <x-menu-separator />
                    <x-menu-item title="{{ __('Logout') }}" icon="o-power" wire:click="Logout" />
                </div>
            </div>
        </div>
    @endif
</div>
