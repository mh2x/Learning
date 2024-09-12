<?php

use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Volt\Component;
use Livewire\livewire;

new class extends Component {
    public $options;
    public $selection;
    public $icon;
    public $label;
    public $isOpen = false;
    public $onSelectionChanged;

    public function changeSelection($newSelection)
    {
        $this->selection = $newSelection;
        $this->isOpen = false;
        $this->Refresh();
        // Emit an event
        $this->dispatch('dropdown-SelectionChange', ['selection' => $newSelection, 'data' => $this->options[$newSelection]]);
    }

    public function Refresh()
    {
        $this->dispatch('$refresh');
    }

    // Mount function to initialize component properties
    public function mount($options = [], $selectedKey = null, $icon = null, $label = null, $selectionChanged = null)
    {
        $this->icon = $icon;
        $this->label = $label;
        $this->selection = $selectedKey;
        $this->onSelectionChanged = $selectionChanged;
        $optionsArray = [];

        foreach ($options as $key => $value) {
            if (is_array($value)) {
                $optionsArray[] = $value;
            } else {
                $optionsArray[] = ['id' => $key, 'name' => $value];
            }
        }
        $this->options = $optionsArray;
    }

    public function toggleDropdown()
    {
        $this->isOpen = !$this->isOpen;
    }
}; ?>

<div class="flex flex-row items-center">
    @if ($this->label)
        <p class="font-semibold text-sm mr-3">{{ $this->label }}</p>
    @endif
    <div class="dropdown">
        <div tabindex="0" class="btn btn-ghost border border-base-300">
            @if ($this->icon)
                <x-icon name="{{ $this->icon }}" />
            @endif
            {{ Str::upper($this->options[$this->selection]['name']) }}
            <svg class="inline w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5"></path>
            </svg>
        </div>
        <ul tabindex="0"
            class="dropdown-content menu bg-base-100 rounded-box z-[1] w-full min-w-96 p-2 shadow-2xl overflow-y-auto border border-base-300 ">

            @foreach ($this->options as $option)
                @if ($option['id'] == $this->selection)
                    <li class="pointer-events-none">
                        <a href="">
                            <span class="w-2">&#10003;</span>
                            {{ $option['name'] }}</a>
                    </li>
                @else
                    <li><a href="" wire:click.prevent="changeSelection('{{ $option['id'] }}')"
                            class="font-semibold p-1" aria-label="{{ $option['name'] }}">
                            <span class="w-2"></span>
                            {{ $option['name'] }}</a>
                    </li>
                @endif
            @endforeach
        </ul>
    </div>
</div>
