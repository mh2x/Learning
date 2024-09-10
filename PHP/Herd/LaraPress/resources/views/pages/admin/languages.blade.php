<?php

use function Laravel\Folio\{middleware, name};
use Livewire\Volt\Component;
use Mary\Traits\Toast;
use App\Core\LangManager;
use Livewire\WithPagination;
use Illuminate\Pagination\LengthAwarePaginator;

name('admin.languages');
middleware(['auth', 'verified']);

new class extends Component {
    use Toast;
    use WithPagination;

    public $app_locales = [];
    public $locales = [];
    public $table_headers = [];
    public $translationData = [];

    // Reset pagination when any component property changes
    public function updated($property): void
    {
        if (!is_array($property) && $property != '') {
            $this->resetPage();
        }
    }

    public function mount()
    {
        $langManager = app(LangManager::class);

        //locales
        $this->locales = $langManager->getLocalesArray();

        //Current supported locales
        $this->app_locales = Settings('allowed_locales', ['en']);
        //dd('mounted');

        //Translations
        $default_locale = Settings('default_locale', ['en']);
        $this->translationData = $langManager->getAllTranslationsWithLocales($this->app_locales, $default_locale);
        if (count($this->translationData) > 1) {
            $firstKey = array_key_first($this->translationData);
            //set the new $translation_locales array
            $translation_locales = $this->translationData[$firstKey];
        }

        //Add columns for each locale
        foreach ($translation_locales as $key => $value) {
            $localeInfo = array_filter($this->locales, function ($value) use ($key) {
                return $value['id'] === $key; // Example condition: value starts with 'A'
            });
            $firstKey = array_key_first($localeInfo);
            //dd($localeInfo);
            $this->table_headers[] = ['key' => "$key", 'label' => $localeInfo[$firstKey]['name']];
        }

        //dd($this->translationData);
    }

    public function translations(): LengthAwarePaginator
    {
        $data = $this->translationData;
        // Pagination variables
        $itemsPerPage = 10;
        $page = LengthAwarePaginator::resolveCurrentPage() ?: 1;

        // Calculate total items and pages
        $totalItems = count($data);
        $totalPages = ceil($totalItems / $itemsPerPage);

        // Validate the current page number
        if ($page < 1) {
            $page = 1;
        } elseif ($page > $totalPages) {
            $page = $totalPages;
        }

        // Calculate the offset for array_slice
        $offset = ($page - 1) * $itemsPerPage;

        // Get the subset of the array for the current page
        $currentPageItems = array_slice($data, $offset, $itemsPerPage);

        // Create the LengthAwarePaginator instance
        $paginatedItems = new LengthAwarePaginator($currentPageItems, $totalItems, $itemsPerPage, $page, ['path' => LengthAwarePaginator::resolveCurrentPath()]);
        return $paginatedItems;
    }

    public function with(): array
    {
        return [
            'translations' => $this->Translations(),
            'headers' => $this->table_headers,
        ];
    }

    public function save()
    {
        updateSettingsValue('allowed_locales', $this->app_locales ?? ['en']);
        $this->success('Changes saved successfully.');
        //$names = getLocaleName($this->app_locales);
    }
}; ?>

<x-layouts.app>
    @volt('languages.locales')
        <div class="bg-gray-700 p-6">
            <x-slot:title>
                {{ __('Languages') }}
            </x-slot:title>
            <x-form wire:submit="save" no-separator>
                <div class="lg:grid grid-cols-6">
                    <div class="col-span-2">
                        <x-header title="Locales" subtitle="Choose locales you want to support" size="text-2xl" />
                    </div>
                    <div class="col-span-2 grid gap-3">
                        <x-choices-offline label="Supported Locales" wire:model="app_locales" :options="$locales" searchable
                            class="focus:text-red-500" />
                    </div>
                </div>
                <x-slot:actions>
                    {{-- The important thing here is `type="submit"` --}}
                    {{-- The spinner property is nice! --}}
                    <x-button label="Save" icon="o-paper-airplane" spinner="save" type="submit" class="btn-primary" />
                </x-slot:actions>
            </x-form>
            {{--  Translation section --}}
            <x-hr class="my-5" />
            <div class="lg:grid grid-cols-1">
                <div class="col-span-1">
                    <x-header title="Translations" subtitle="Localize your app messages" size="text-2xl" />
                </div>
                <div>
                    <x-table :headers="$table_headers" :rows="$translations" with-pagination />
                </div>
            </div>
        </div>
    @endvolt
</x-layouts.app>
