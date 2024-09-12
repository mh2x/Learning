<?php

use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Volt\Component;
use Livewire\livewire;

new class extends Component {
    public function mount()
    {
    }
}; ?>

<div class="dropdown">
    <div tabindex="0" class="btn btn-ghost">
        {{ __('Theme') }}
        <svg width="12px" height="12px" class="inline-block h-2 w-2 fill-current" xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 2048 2048">
            <path d="M1799 349l242 241-1017 1017L7 590l242-241 775 775 775-775z"></path>
        </svg>
    </div>
    <ul tabindex="0" class="dropdown-content menu bg-base-100 rounded-box z-[1] w-52 p-1 shadow-2xl">
        @foreach (getSupportedThemes() as $key => $value)
            <li>
                <input type="radio" name="theme-dropdown"
                    class="theme-controller btn btn-sm btn-block btn-ghost justify-start"
                    aria-label="{{ ucfirst(__($value)) }}" value="{{ $value }}" />
            </li>
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
