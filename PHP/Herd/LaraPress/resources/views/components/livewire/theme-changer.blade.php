<?php

use App\Livewire\Actions\Logout;
use Illuminate\Support\Facades\Auth;
use Livewire\Volt\Component;

new class extends Component {}; ?>
<div class="flex flex-row justify-between">
    <x-theme-toggle class="btn btn-circle btn-ghost" />
    <div>
        <div class="dropdown">
            <div tabindex="0" class="btn btn-ghost">
                {{ __('Theme') }}
                <svg width="12px" height="12px" class="inline-block h-2 w-2 fill-current"
                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 2048 2048">
                    <path d="M1799 349l242 241-1017 1017L7 590l242-241 775 775 775-775z"></path>
                </svg>
            </div>
            <ul tabindex="0" class="dropdown-content rounded-box z-[1] w-52 p-2 shadow-2xl bg-base-100">
                <li>
                    <input type="radio" name="theme-dropdown"
                        class="theme-controller btn btn-sm btn-block btn-ghost justify-start" aria-label="Default"
                        value="default" />
                </li>
                <li>
                    <input type="radio" name="theme-dropdown"
                        class="theme-controller btn btn-sm btn-block btn-ghost justify-start" aria-label="Retro"
                        value="Retro" />
                </li>
                <li>
                    <input type="radio" name="theme-dropdown"
                        class="theme-controller btn btn-sm btn-block btn-ghost justify-start" aria-label="Cyberpunk"
                        value="cyberpunk" />
                </li>
                <li>
                    <input type="radio" name="theme-dropdown"
                        class="theme-controller btn btn-sm btn-block btn-ghost justify-start" aria-label="Valentine"
                        value="valentine" />
                </li>
                <li>
                    <input type="radio" name="theme-dropdown"
                        class="theme-controller btn btn-sm btn-block btn-ghost justify-start" aria-label="Aqua"
                        value="aqua" />
                </li>
            </ul>
        </div>
    </div>
</div>
