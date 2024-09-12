<?php

use App\Livewire\Actions\Logout;
use Illuminate\Support\Facades\Auth;
use Livewire\Volt\Component;

new class extends Component {
    public $icon;
    public $theme;

    public function mount()
    {
        $this->theme = getActiveTheme();
        $this->icon = $this->theme === 'dark' ? 'o-moon' : 's-sun';
    }

    public function toggleTheme()
    {
        setActiveTheme($this->theme === 'light' ? 'dark' : 'light');
    }
}; ?>

<div>
    <x-button :icon="$icon" class="btn-circle btn-ghost" wire:click.prevent="toggleTheme" spinner />
</div>
