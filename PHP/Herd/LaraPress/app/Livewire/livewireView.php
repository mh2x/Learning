<?php

namespace app\Livewire;

use Livewire\Component;

//This is a sample test page
class livewireView extends Component
{
    public $count = 1;

    public function increment($inc = 1)
    {
        //*! DO NOT TRUST FRONT-END INPUT
        //*? Always validate input

        $this->count += $inc;
    }
    public function mount()
    {
        //dd('mounted');
    }
    public function render()
    {
        //dd('render');
        return view('pages.samples.livewireview');
    }
}