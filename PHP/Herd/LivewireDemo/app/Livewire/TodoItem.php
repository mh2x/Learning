<?php

namespace App\Livewire;

use App\Models\Todo;
use Livewire\Component;

class TodoItem extends Component
{
    public $todo;
    public $newName;

    public $editMode = false;
    public function mount($todo)
    {
        //get the param
        $this->todo = $todo;
    }

    public function toggleStatus()
    {
        $newState = !$this->todo->completed;
        $this->todo = Todo::findOrFail($this->todo->id);
        $this->todo->completed = $newState;
        $this->todo->save();
    }
    public function status()
    {
        return $this->todo->completed ? "Done" : "Todo";
    }
    public function statusTextColor()
    {
        return $this->todo->completed ? "text-green-400" : "text-red-400";
    }

    public function delete()
    {
        $this->todo->delete();
        $this->dispatch('todo-deleted')->to(TodoList::class);
        $this->dispatch('refreshParent');
    }

    public function edit()
    {
        $this->todo = Todo::findOrFail($this->todo->id);
        $this->newName = $this->todo->name;
        $this->editMode = true;
    }
    public function cancelEdit()
    {
        $this->todo = Todo::findOrFail($this->todo->id);
        $this->editMode = false;
    }

    public function update()
    {
        $this->todo = Todo::findOrFail($this->todo->id);
        $this->todo->name = $this->newName;
        $this->todo->save();
        $this->editMode = false;
        $this->reset('newName');
    }


    public function render()
    {
        return view('livewire.pages.todo.todo-item');
    }
}
