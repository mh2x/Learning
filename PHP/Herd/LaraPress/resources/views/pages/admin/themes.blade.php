<?php

use Livewire\Volt\Component;
use Livewire\WithPagination;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Validator;
use Mary\Traits\Toast;
use App\Core\LangManager;

use function Laravel\Folio\{middleware, name};

name('admin.themes');
middleware(['auth', 'verified']);

new class extends Component {
    use Toast;
    use WithPagination;

    //listen to dropdown selection events
    protected $listeners = ['dropdown-SelectionChange' => 'onDropdownSelectionChange'];

    public $active_theme;
    public $all_themes = [];
    public $app_themes = [];

    public $enableThemeSelection = false;
    public $theme_styles = [];
    public $theme_styles_index;

    public function onDropdownSelectionChange($eventData)
    {
        // Handle the event and the data passed from the selection change
        $selection = $eventData['selection'];
        $data = $eventData['data'];
        $this->theme_styles_index = $selection;
        //$this->setEnableThemesList();
    }

    public function Refresh()
    {
        $this->dispatch('$refresh');
    }

    public function isThemeListSelected()
    {
        $enabled = $this->theme_styles_index == count($this->theme_styles) - 1;
        return $enabled;
    }

    public function setEnableThemesList($enable)
    {
        $this->enableThemeSelection = $enable;
        $this->Refresh();
    }

    /*
        file settings:        
        ------------------------------------------------------------------------------------
        getThemesStyle/setThemeStyle => "themes_style": ['light', 'dark, 'toggle', "list"]
        getActiveTheme/ setActiveTheme => "active_theme": "bumblebee",
        getThemesList / setThemesList => "themes_list": [...]
        ------------------------------------------------------------------------------------
    */
    public function mount()
    {
        //theme theme_styles
        $this->theme_styles = [__('Light'), __('Dark'), __('Toggle (Light & Dark)'), __('Themes dropdown...')];
        $this->app_themes = array_keys(getThemesList());
        $this->theme_styles_index = array_search(getThemesStyle(), getThemesStyleValidValues());
        //active theme
        $active_theme = getActiveTheme();
    }

    public function allthemes()
    {
        if (empty($this->all_themes)) {
            $this->all_themes = convertArray(getAllThemes(), true);
        }
        return $this->all_themes;
    }

    public function with(): array
    {
        return [
            'allThemes' => $this->allThemes(),
        ];
    }

    public function saveThemes()
    {
        //save theme list and theme style
        $newThemesStyle = getThemesStyleValidValues()[$this->theme_styles_index];
        $newThemeList = arrayKeys2ArrayValues($this->app_themes, getAllThemes());
        if ($newThemesStyle == 'list' && count($newThemeList) < 2) {
            $this->addError('theme-list', __('You must select at least 2 themes'));
            return;
        }

        //new ative theme may have changed...
        $newActiveTheme = 'light';
        if ($newThemesStyle === 'list') {
            $newActiveTheme = $newThemeList[0];
        } elseif ($newThemesStyle === 'dark') {
            $newActiveTheme = 'dark';
        }

        //save to file
        setThemesList($newThemeList);
        setThemeStyle($newThemesStyle);
        setActiveTheme($newActiveTheme);

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

                    @livewire('dropdown-select', [
                        'options' => $theme_styles,
                        'selectedKey' => $theme_styles_index,
                        'icon' => 'o-bars-3-bottom-right',
                        'label' => __('What themes to support?'),
                    ])

                    <div class="mt-4 mb-4">
                        @if ($this->isThemeListSelected())
                            <x-choices-offline wire:model="app_themes" :options="$allThemes" class="border-neutral" searchable />
                            @error('theme-list')
                                <p class="text-error text-xs font-semibold mt-1 mb-1">{{ $message }}</p>
                            @enderror
                        @endif
                        <x-separator />
                        <x-slot:actions>
                            {{-- The important thing here is `type="submit"` --}}
                            {{-- The spinner property is nice! --}}
                            <x-button label="Save" icon="o-paper-airplane" spinner="save" type="submit"
                                class="btn-primary" />
                        </x-slot:actions>
                    </div>
                </div>
            </x-form>
        </div>
    @endvolt
</x-layouts.app>
