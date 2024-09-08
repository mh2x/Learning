<?php

use Livewire\Volt\Component;
use Mary\Traits\Toast;

new class extends Component {
    use Toast;

    public $app_locales = [];
    public $locales = [];

    public function mount()
    {
        $this->locales = getAllLocales();
        //Current supported locales
        $this->app_locales = Settings('allowed_locales', ['en']);
        //dd('mounted');
    }

    public function save()
    {
        updateSettingsValue('allowed_locales', $this->app_locales ?? ['en']);
        $this->success('Changes saved successfully.');
        //$names = getLocaleName($this->app_locales);
    }
}; ?>

<div class="">
    <x-slot:title>
        {{ __('Languages') }}
    </x-slot:title>
    <div>
        <x-form wire:submit="save">
            {{--  Basic section  --}}
            <div class="lg:grid grid-cols-8">
                <div class="col-span-2">
                    <x-header title="Locales" subtitle="Choose locales you want to support" size="text-2xl" />
                </div>
                <div class="col-span-2 grid gap-3">
                    {{-- Multi selection --}}
                    <x-choices-offline label="Supported Locales" wire:model="app_locales" :options="$locales" searchable
                        class="focus:text-red-500" />
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
