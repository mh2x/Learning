<?php

use Livewire\Volt\Component;
use Livewire\WithPagination;
use Illuminate\Pagination\LengthAwarePaginator;
use Mary\Traits\Toast;
use App\Core\LangManager;
use function Laravel\Folio\{middleware, name};

name('admin.themes');
middleware(['auth', 'verified']);

new class extends Component {
    use Toast;
    use WithPagination;

    public $app_themes = [];
    public $all_themes = [];
    public $default_theme;
    public $enableThemeSelection = false;

    public function Refresh()
    {
        $this->dispatch('$refresh');
    }

    public function ToggleEnableThemes()
    {
        $this->enableThemeSelection = !$this->enableThemeSelection;
        $this->Refresh();
    }

    public function mount()
    {
        //Current supported locales
        $this->app_themes = Settings('allowed_themes', ['en']);
        //dd('mounted');

        //Translations
        $default_locale = Settings('default_theme', ['light']);
    }

    public function allthemes()
    {
        if (empty($all_themes)) {
            $themes = getAllThemes();
            foreach ($themes as $key => $theme) {
                $all_themes[] = ['id' => $key, 'name' => ucfirst(__($theme))];
            }
        }
        return $all_themes;
    }
    public function with(): array
    {
        return [
            'allThemes' => $this->allThemes(),
        ];
    }

    public function saveThemes()
    {
        updateSettingsValue('allowed_themes', $this->app_themes ?? ['light']);
        $this->success('New themes saved successfully.');
    }
}; ?>

<x-layouts.app>
    @volt
        <div class="p-6">
            <x-slot:title>
                {{ __('Themes') }}
            </x-slot:title>
            <x-form wire:submit="saveThemes" no-separator>
                <div class="flex flex-col">
                    <x-header title="{{ __('App themes') }}" subtitle="{{ __('Choose themes you want your app to support') }}"
                        size="text-2xl" class="text-secondary" />

                    <div class="mb-5">
                        @php
                            $themeOptions = array_slice($this->allthemes(), 0, 3);
                        @endphp
                        <x-radio label="Select default theme" :options="$themeOptions" wire:model="default_theme"
                            class="w-full bg-red-50" />
                    </div>
                    <div class="mb-5">
                        <x-checkbox label="{{ __('Enable theme selection') }}" wire:click="ToggleEnableThemes"
                            class="checkbox-warning text-primary" tight />
                    </div>
                    @if ($enableThemeSelection)
                        <x-choices-offline wire:model="app_themes" :options="$allThemes" class="border-neutral" searchable />
                        <x-slot:actions>
                            {{-- The important thing here is `type="submit"` --}}
                            {{-- The spinner property is nice! --}}
                            <x-button label="Save Themes" icon="o-paper-airplane" spinner="save" type="submit"
                                class="btn-primary" />
                        </x-slot:actions>
                    @endif
                </div>
            </x-form>
        </div>
    @endvolt
</x-layouts.app>
