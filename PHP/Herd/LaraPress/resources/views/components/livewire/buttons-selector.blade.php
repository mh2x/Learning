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

    public function changeSelection($newSelection)
    {
        $this->selection = $newSelection;
        $this->isOpen = false;
        $this->Refresh();
    }

    public function Refresh()
    {
        $this->dispatch('$refresh');
    }

    // Mount function to initialize component properties
    public function mount($options = [], $selectedKey = null, $icon = null, $label = null)
    {
        $this->icon = $icon;
        $this->label = $label;
        $this->selection = $selectedKey;

        $optionsArray = [];

        foreach ($options as $key => $value) {
            if (is_array($value)) {
                $optionsArray[] = $value;
            } else {
                $optionsArray = ['id' => $key, 'name' => $value];
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
    <div clas='flex flex-row items-center'>

        @foreach ($this->options as $option)
            @if ($option['id'] == $this->selection)
                <button class="pointer-events-none btn btn-outline min-w-40" aria-label="{{ $option['name'] }}">
                    <span class="w-2">&#10003;</span>
                    {{ $option['name'] }}</button>
            @else
                <button wire:click.prevent="changeSelection('{{ $option['id'] }}')" class="btn btn-outline min-w-40"
                    aria-label="{{ $option['name'] }}">
                    <span class="w-2 hidden">&#10003;</span>
                    {{ $option['name'] }}</button>
            @endif
        @endforeach
    </div>
</div>
