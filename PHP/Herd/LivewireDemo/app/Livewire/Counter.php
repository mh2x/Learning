<?php

namespace App\Livewire;

use Livewire\Component;

class Counter extends Component
{
    public $count = 1;

    public function increment($inc = 1)
    {
        //*! DO NOT TRUST FRONT-END INPUT
        //*? Always validate input

        $this->count += $inc;
    }
    public function render()
    {
        return view('livewire.counter');
    }
}