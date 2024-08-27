<?php

namespace App\Livewire;

use Livewire\Component;

class HelloWorld extends Component
{
    public function render()
    {
        //under resouces\views\livewire
        return view('livewire.hello-world');
    }
}
