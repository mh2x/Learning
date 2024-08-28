<?php

namespace App\Livewire;

use Livewire\Component;

class TodoItem extends Component
{
    public $todo;

    public function status()
    {
        return $this->todo->completed ? "Done" : "Open";
    }
    public function statusColor()
    {
        return $this->todo->completed ? "text-red-400" : "text-green-400";
    }
    public function render()
    {
        return view('livewire.pages.todo.todo-item');
    }
}