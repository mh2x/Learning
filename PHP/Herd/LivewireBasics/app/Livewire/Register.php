<?php

namespace App\Livewire;

use Livewire\Attributes\Layout;
use Livewire\Component;

class Register extends Component
{
    //You can use attributes to specify unique layout files:
    //#[Layout('components.layouts.app')]
    public function render()
    {
        return view('livewire.register');
    }
}