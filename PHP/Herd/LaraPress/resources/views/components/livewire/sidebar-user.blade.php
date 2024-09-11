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
<div class="m-2 p-1">
    @if ($user = auth()->user())
        <x-list-item :item="$user" value="name" sub-value="email" no-separator no-hover
            class="text-sm font-semibold">
            <x-slot:actions>
                <x-button icon="o-power" class="btn-circle btn-ghost btn-xs" tooltip-bottom="Logout" wire:click="Logout"
                    wire:confirm="{{ __('Are you sure you want to logout?') }}" />
            </x-slot:actions>
        </x-list-item>
    @endif
</div>
