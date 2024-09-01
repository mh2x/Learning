<?php

use App\Livewire\Actions\Logout;
use Illuminate\Support\Facades\Auth;
use Livewire\Volt\Component;

new class extends Component {}; ?>
<div>
    {{--  COLOR AND STYLE --}}
    <x-button label="Hi!" class="btn-outline" />
    <x-button label="How" class="btn-warning" />
    <x-button label="Are" class="btn-success" />
    <x-button label="You?" class="btn-error btn-sm" />

    {{-- SLOT --}}
    <x-button class="btn-primary">
        With default slot 😃
    </x-button>

    {{-- CIRCLE --}}
    <x-button icon="o-user" class="btn-circle" />
    <x-button icon="o-user" class="btn-circle btn-outline" />

    {{-- SQUARE --}}
    <x-button icon="o-user" class="btn-circle btn-ghost" />
    <x-button icon="o-user" class="btn-square" />
</div>
