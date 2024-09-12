<?php

use App\Livewire\Actions\Logout;
use Illuminate\Support\Facades\Auth;
use Livewire\Volt\Component;

new class extends Component {
    public $mode;
    public function mount()
    {
        $style = getThemesStyle();
        if ($style == 'toggle' || $style == 'list') {
            $this->mode = $style;
        }
    }
}; ?>

<div>
    @if ($mode === 'toggle')
        @livewire('theme-switch')
    @else
        @if ($mode === 'list')
            @livewire('themes-dropdown')
        @endif
    @endif
</div>
