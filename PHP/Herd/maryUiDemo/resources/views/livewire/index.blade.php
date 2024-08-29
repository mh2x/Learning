<?php

use Livewire\Volt\Component;

new class extends Component {
    //
}; ?>

<div>
    <x-header title="Home" separator progress-indicator>
        <x-slot:middle class="!justify-end">
            <x-slot:actions>
                <x-button label="Login" icon="o-paper-airplane" class="btn-outline btn-primary" link="/login" />
                <x-button label="Register" icon="m-user-plus" type="submit" class="btn-outline btn-secondary" spinner="register" />
            </x-slot:actions>
        </x-slot:middle>
    </x-header>
</div>
