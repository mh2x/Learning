<?php

use App\Livewire\Actions\Logout;
use Illuminate\Support\Facades\Auth;
use Livewire\Volt\Component;

new class extends Component {}; ?>
{{-- Use `right` if dropdown is on right side of screen --}}
<x-dropdown label="EN" class="btn-warning">
    <x-menu-item title="English" />
    <x-menu-item title="Arabic" />
    <x-menu-separator />
    <x-menu-item title="Manage languages..." />
</x-dropdown>
