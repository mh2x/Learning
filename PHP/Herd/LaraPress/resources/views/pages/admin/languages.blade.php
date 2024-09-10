<?php

use Livewire\Volt\Component;
use Livewire\WithPagination;
use Illuminate\Pagination\LengthAwarePaginator;
use Mary\Traits\Toast;
use App\Core\LangManager;

new class extends Component {
    use Toast;
    use WithPagination;

    public $app_locales = [];
    public $locales = [];
    public $table_headers = [];
    public $translationData = [];
    public $edit_mode_id = 0;

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
        //dd($this->translationData);
        if (count($this->translationData) > 1) {
            //set the new $translation_locales array
            $translation_locales = $this->translationData[1];
        }

        //Add columns for each locale
        foreach ($translation_locales as $key => $value) {
            if ($key === '#') {
                $label = $key;
            } else {
                //map the 'ar', 'es', .. to its 'Arabic', 'Spanish', ...label
                $localeInfo = array_filter($this->locales, function ($value) use ($key) {
                    return $value['id'] === $key;
                });
                $firstKey = array_key_first($localeInfo);
                $label = $localeInfo[$firstKey]['name'];
            }
            $this->table_headers[] = ['key' => "$key", 'label' => $label];
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

    public function editRow($id)
    {
        if ($this->edit_mode_id !== 0) {
            return;
        }
        $this->edit_mode_id = $id;
    }

    public function endEditRow()
    {
        $this->edit_mode_id = 0;
    }

    public function save()
    {
        updateSettingsValue('allowed_locales', $this->app_locales ?? ['en']);
        $this->success('Changes saved successfully.');
        //$names = getLocaleName($this->app_locales);
    }
}; ?>

<x-layouts.app>
    @volt
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
                    <div class="overflow-x-auto">
                        <table class="table">
                            <!-- head -->
                            <thead>
                                <tr>
                                    @foreach ($headers as $header)
                                        <th>{{ $header['label'] }}</th>
                                    @endforeach
                                    <th class="w-1"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- row -->
                                @foreach ($translations as $key => $translation)
                                    @php $index = 0; @endphp
                                    <tr class="hover">
                                        @foreach ($translation as $value)
                                            @if ($edit_mode_id === $translation['#'] && $index++ > 1)
                                                <td><input type="text" value="{{ $value }}" class="text-black" />
                                                </td>
                                            @else
                                                <td>{{ $value }}</td>
                                            @endif
                                        @endforeach
                                        @if ($edit_mode_id === 0)
                                            <td><x-button icon="o-pencil-square" class="btn-circle btn-ghost"
                                                    wire:click="editRow({{ $translation['#'] }})" /></td>
                                        @else
                                            @if ($edit_mode_id === $translation['#'])
                                                <td><x-button icon="m-check-circle" class="btn-circle btn-ghost"
                                                        wire:click="endEditRow" /></td>
                                            @else
                                                <td><x-button disabled icon="o-pencil-square" class="btn-circle btn-ghost"
                                                        wire:click="editRow({{ $translation['#'] }})" /></td>
                                            @endif
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $translations->links() }}
                </div>
            </div>
        </div>
    @endvolt
</x-layouts.app>
