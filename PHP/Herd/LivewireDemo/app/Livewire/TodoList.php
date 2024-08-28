<?php

namespace App\Livewire;

use App\Models\Todo;
use Livewire\Attributes\Rule;
use Livewire\Component;

class TodoList extends Component
{
    #[Rule('required|min:5|max:20')]
    public $newTodo;
    public $search;

    public function all()
    {
        return Todo::latest()->get();
    }
    public function createNewTodo()
    {
        //! validate
        //? create to-do
        //* clear input
        //flash the message

        //We don't want to validate search
        $this->validateOnly('newTodo');
        Todo::create(['name' => $this->newTodo]);

        $this->reset('newTodo');

        session()->flash('success', 'Your TODO has been added successfully!');
    }

    public function render()
    {
        return view('livewire.pages.todo.todo-list');
    }
}