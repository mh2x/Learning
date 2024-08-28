<?php

namespace App\Livewire;

use App\Models\Todo;
use Livewire\Attributes\Rule;
use Livewire\Attributes\On;

use Livewire\Component;
use Livewire\WithPagination;

class TodoList extends Component
{
    use WithPagination;

    protected $listeners = ['refreshParent' => '$refresh'];

    #[Rule('required|min:3|max:20')]
    public $newTodo;
    public $search;
    public $hideDone = false;
    public function getTodos()
    {
        //return Todo::latest()->get();
        //return Todo::latest()->paginate(5);

        $result =  Todo::query()->where('name', 'like', '%' . $this->search . '%');

        if ($this->hideDone) {
            //only show incomplete items
            $result =  $result->where('completed', false);
        }
        return $result->latest()->paginate(5);
    }

    public function toggleHideDone()
    {
        $this->hideDone = !$this->hideDone;
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

    #[On('todo-deleted')]
    public function handleDeleteTodo()
    {
        //Dispatched from child component
    }
    public function render()
    {
        return view(
            'livewire.pages.todo.todo-list',
            ['todos' => $this->getTodos()]
        );
    }
}
