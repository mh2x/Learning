<?php

use Livewire\Volt\Component;
use App\Core\LangManager;

new class extends Component {
    public $app_locales = [];
    public $locales = [];
    public $LangManager;

    public function mount()
    {
        $this->langManager = app(LangManager::class);
        //dd('mounted');
    }
}; ?>

<div class="">
    <x-slot:title>
        {{ __('General Settings') }}
    </x-slot:title>
    <div>
        <x-form wire:submit="save">
            {{--  Basic section  --}}
            <div class="lg:grid grid-cols-8">
                <div class="col-span-2">
                    <x-header title="General" subtitle="General Settings" size="text-2xl" />
                </div>
                <div class="col-span-2 grid gap-3">
                    <p>Locales:</p>
                    {{ implode(', ', Settings('allowed_locales', [])) }}
                </div>
            </div>

            {{--  Details section --}}
            <x-hr class="my-5" />
            <div class="lg:grid grid-cols-5">
                <div class="col-span-2">
                    <x-header title="Details" subtitle="More about the user" size="text-2xl" />
                </div>
            </div>
            <x-slot:actions>
                {{-- The important thing here is `type="submit"` --}}
                {{-- The spinner property is nice! --}}
                <x-button label="Save" icon="o-paper-airplane" spinner="save" type="submit" class="btn-primary" />
            </x-slot:actions>
        </x-form>
    </div>


</div>
