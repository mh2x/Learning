<?php

use App\Livewire\Actions\Logout;
use Illuminate\Support\Facades\Auth;
use Livewire\Volt\Component;

new class extends Component {
    public $localeOptions = [];
    public $appLocale;

    public function changeLocale($locale)
    {
        setAppLocale($locale);
        // Redirect back to the same page
        //header("Location: " . $_SERVER['HTTP_REFERER'] . "?lang=$locale");
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        // Refresh the page immediately
        //header("Refresh:0");
        exit();
    }

    public function mount()
    {
        $this->appLocale = App::getLocale();
    }
}; ?>
{{-- Use `right` if dropdown is on right side of screen --}}
<div class="dropdown">
    <div tabindex="0" role="button" class="btn btn-ghost">
        <x-icon name="o-globe-alt" />
        {{ Str::upper($this->appLocale) }}
        <svg class="inline w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
            stroke="currentColor" aria-hidden="true" data-slot="icon">
            <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5"></path>
        </svg>
    </div>
    <ul tabindex="0" class="dropdown-content menu bg-base-100 rounded-box z-[1] w-40 p-2 shadow">
        @foreach (getAllowedLocaleNames() as $key => $value)
            @if ($key === $this->appLocale)
                <li class="text-slate-500 pointer-events-none">
                    <a href="#">
                        <span class="w-2">&#10003;</span>
                        {{ __($value) }}</a>
                </li>
            @else
                <li><a href="#" wire:click.prevent="changeLocale('{{ $key }}')">
                        <span class="w-2"></span>
                        {{ __($value) }}</a></li>
            @endif
        @endforeach
        <x-hr />
        <li><a href="/languages" class="text-yellow-500">
                <x-icon name="s-cog-6-tooth" />
                {{ __('Configure...') }}</a></li>
    </ul>
</div>
