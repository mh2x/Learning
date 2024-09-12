<?php

use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Volt\Component;
use Livewire\livewire;

new class extends Component {
    public $ThemeOptions = [];
    public $appTheme;

    public function changeTheme($theme)
    {
        setActiveTheme($theme);
        $this->appTheme = $theme;
        $this->Refresh();
    }

    public function Refresh()
    {
        $this->dispatch('$refresh');
    }

    public function mount()
    {
        $this->appTheme = getActiveTheme();
    }
}; ?>

{{-- Use `right` if dropdown is on right side of screen --}}
<div class="dropdown">
    <div tabindex="0" class="btn btn-ghost">
        <x-icon name="c-sun" />
        {{ Str::upper($this->appTheme) }}
        <svg class="inline w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
            stroke="currentColor" aria-hidden="true" data-slot="icon">
            <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5"></path>
        </svg>
    </div>
    <input type="radio" name="theme-changer"
        class="theme-controller btn btn-sm btn-block btn-ghost justify-start hidden" aria-label="{{ $this->appTheme }}"
        value="{{ $this->appTheme }}" checked>

    <ul tabindex="0" class="dropdown-content menu bg-base-100 rounded-box z-[1] w-52 p-2 shadow-2xl overflow-y-auto">
        @foreach (getSupportedThemes() as $key => $value)
            @if ($value === $this->appTheme)
                <li class="pointer-events-none">
                    <a href="#">
                        <span class="w-2">&#10003;</span>
                        {{ __($value) }}</a>
                </li>
            @else
                <li><a href="#" wire:click.prevent="changeTheme('{{ $value }}')" class="font-semibold p-1"
                        aria-label="{{ ucfirst(__($value)) }}">
                        <span class="w-2"></span>
                        {{ ucfirst(__($value)) }}</a>
                </li>
            @endif
        @endforeach
        @auth
            <x-hr />
            <li><a href="{{ route('admin.themes') }}" class="text-warning">
                    <x-icon name="s-cog-6-tooth" />
                    {{ __('Configure...') }}
                </a>
            </li>
        @endauth
    </ul>
</div>
