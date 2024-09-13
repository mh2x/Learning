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

    public $default_theme = 0;
    public $user_theme;
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
        getUserTheme/ setUserTheme => "user_theme": "bumblebee",
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
        $user_theme = getUserTheme();
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
        $allThemes = getAllThemes();
        if ($this->default_theme < 0 || $this->default_theme >= count($allThemes)) {
            $this->addError('default-theme-err', __('You must select a valid default theme!'));
            return;
        }
        $newThemesStyle = getThemesStyleValidValues()[$this->theme_styles_index];
        $newThemeList = arrayKeys2ArrayValues($this->app_themes, $allThemes);
        if ($newThemesStyle == 'list' && count($newThemeList) < 2) {
            $this->addError('theme-list', __('You must select at least 2 themes'));
            return;
        }

        //new ative theme may have changed...
        $newUserTheme = 'light';
        if ($newThemesStyle === 'list') {
            $newUserTheme = $newThemeList[0];
        } elseif ($newThemesStyle === 'dark') {
            $newUserTheme = 'dark';
        }

        //save to file
        setThemesList($newThemeList);
        setThemeStyle($newThemesStyle);
        setDefaultTheme($allThemes[$this->default_theme]);
        setUserTheme($newUserTheme);
        $this->success('New themes saved successfully.');
        header('Location: ' . $_SERVER['HTTP_REFERER']);
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
                    <p class="text-primary text-sm font-semibold">Default website theme</p>
                    <select class="select select-bordered max-w-60 mb-8 mt-2" wire:model="default_theme">
                        @foreach ($this->all_themes as $theme)
                            <option value="{{ $theme['id'] }}">{{ $theme['name'] }}</option>
                        @endforeach
                    </select>
                    @error('default-theme-err')
                        <p class="text-error text-xs font-semibold mt-1 mb-1">{{ $message }}</p>
                    @enderror

                    @livewire('dropdown-select', [
                        'options' => $theme_styles,
                        'selectedKey' => $theme_styles_index,
                        'icon' => 'o-bars-3-bottom-right',
                        'label' => __('What themes to allow for users?'),
                    ])

                    <div class="mt-6 mb-4">
                        @if ($this->isThemeListSelected())
                            <x-choices-offline wire:model="app_themes" :options="$allThemes" class="border-neutral"
                                searchable />
                            @error('theme-list')
                                <p class="text-error text-xs font-semibold mt-1 mb-1">{{ $message }}</p>
                            @enderror
                        @endif
                        <div class="mt-8">
                            <x-separator />
                        </div>
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
