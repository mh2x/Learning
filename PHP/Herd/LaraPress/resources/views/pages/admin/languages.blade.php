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
    public $allTranslationData = [];
    public $edit_row_id = 0;
    public $edit_translation = [];
    public $showTranslationDialog = false;
    public $autoSaveTranslations = false;

    public function Refresh()
    {
        $this->dispatch('$refresh');
    }

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
        $this->allTranslationData = $langManager->getAllTranslationsWithLocales($this->app_locales, $default_locale);
        //dd($this->allTranslationData);
        if (count($this->allTranslationData) > 1) {
            //set the new $translation_locales array
            $translation_locales = $this->allTranslationData[1];
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
        //dd($this->allTranslationData);
    }

    public function translations(): LengthAwarePaginator
    {
        $data = $this->allTranslationData;
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

    public function toggleAutoSaveTranslations()
    {
        $this->autoSaveTranslations = !$this->autoSaveTranslations;
        if ($this->autoSaveTranslations && !empty($this->edit_translation)) {
            //We have some changes not saved
            $this->saveTranslations();
        } else {
            $this->Refresh();
        }
    }

    public function editRow($id)
    {
        if ($this->edit_row_id !== 0) {
            return;
        }
        $this->edit_row_id = $id;
        $this->edit_translation = $this->allTranslationData[$id];
        //dd($this->edit_translation);
        $this->showTranslationDialog = true;
    }

    public function endEditRow($confirm)
    {
        if ($confirm) {
            //update the text
            $this->allTranslationData[$this->edit_row_id] = $this->edit_translation;

            if ($this->autoSaveTranslations) {
                //Commit the changes to the backend / files
                $this->saveTranslations();
            }
            //dd($this->allTranslationData);
            $this->Refresh();
        }
        //dd($this->edit_translation);
        $this->showTranslationDialog = false;
        $this->edit_row_id = 0;
    }

    public function saveLocales()
    {
        updateSettingsValue('allowed_locales', $this->app_locales ?? ['en']);
        $this->success('New locales saved successfully.');
        //$names = getLocaleName($this->app_locales);
    }

    public function saveTranslations()
    {
        $langManager = app(LangManager::class);
        $langManager->saveTranslations($this->allTranslationData, Settings('default_locale', ['en']));

        $this->edit_translation = [];
        $this->success('Translations saved successfully.');
    }
}; ?>

<x-layouts.app>
    @volt
        <div class="p-6">
            <x-slot:title>
                {{ __('Languages') }}
            </x-slot:title>
            <x-form wire:submit="saveLocales" no-separator>
                <div class="lg:grid grid-cols-9">
                    <div class="col-span-2">
                        <x-header title="Locales" subtitle="Choose locales you want to support" size="text-2xl"
                            class="text-secondary" />
                    </div>
                    <div class="col-span-4 gap-3 ">
                        <x-choices-offline label="Supported Locales" wire:model="app_locales" :options="$locales"
                            class="border-neutral" searchable />
                    </div>
                </div>
                <x-slot:actions>
                    {{-- The important thing here is `type="submit"` --}}
                    {{-- The spinner property is nice! --}}
                    <x-button label="Save Locales" icon="o-paper-airplane" spinner="save" type="submit"
                        class="btn-primary" />
                </x-slot:actions>
            </x-form>
            {{--  Translation section --}}
            <x-hr class="my-5" />
            <div>
                <div class="flex flex-row justify-between">
                    <x-header title="Translations" subtitle="Localize your app messages" size="text-2xl"
                        class="text-secondary" />
                    <x-checkbox label="Auto-save translation changes" wire:click="toggleAutoSaveTranslations"
                        class="checkbox-warning" right tight />
                </div>
                <div class="lg:grid grid-cols-1">
                    <x-form wire:submit='saveTranslations'>
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
                                        <tr class="hover" wire:click="editRow({{ $translation['#'] }})">
                                            @foreach ($translation as $value)
                                                <td>{{ $value }}</td>
                                            @endforeach
                                            <td>
                                                <x-button icon="o-pencil-square" class="btn-circle btn-ghost"
                                                    wire:click="editRow({{ $translation['#'] }})" />
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <x-slot:actions>
                            @if (!$autoSaveTranslations)
                                <x-button label="Save Translations" icon="o-paper-airplane" spinner="save" type="submit"
                                    class="{{ empty($edit_translation) ? 'btn-disabled' : 'btn-error' }}" />
                            @else
                                <p class="text-md text-warning">Auto-save is ON</p>
                            @endif
                        </x-slot:actions>
                    </x-form>
                </div>
                <div class="mt-4 border border-base-300 p-4">
                    {{ $translations->links() }}
                </div>
            </div>
            <!---- EDIT DIALOG -->
            <x-modal wire:model="showTranslationDialog" title="Edit Translation" subtitle="edit translated text" persistent>
                @php
                    $index = 0;
                @endphp
                <x-form class="m-4 p-2" wire:submit='endEditRow(true)'>
                    @foreach ($edit_translation as $key => $value)
                        @if ($index < 2)
                            <x-input label="{{ $headers[$index]['label'] }}" value="{{ $value }}" inline readonly
                                class="text-secondary" />
                        @else
                            <x-input label="{{ $headers[$index]['label'] }}"
                                wire:model="edit_translation.{{ $key }}" required />
                        @endif
                        @php
                            $index++;
                        @endphp
                    @endforeach
                    <x-slot:actions>
                        <x-button label="Cancel" wire:click="endEditRow(false)" />
                        <x-button label="Confirm" class="btn-warning" spinner="save" type='submit' />
                    </x-slot:actions>
                </x-form>
            </x-modal>
        </div>
    @endvolt
</x-layouts.app>
