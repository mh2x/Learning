<?php

namespace App\Livewire;

use App\Models\Todo;
use Exception;
use Livewire\Component;
use Livewire\Attributes\Rule;
use Livewire\Attributes\On;

class TodoItem extends Component
{
    public $todo;

    #[Rule('required|min:3|max:20|unique:todos,name')]
    public $newTodo;

    public $editMode = false;
    public function mount($todo)
    {
        //get the param
        $this->todo = $todo;
    }

    public function updating() {}
    public function updated() {}

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
        try {
            $this->todo->delete();
            $this->dispatch('todo-deleted')->to(TodoList::class);
            $this->dispatch('refreshParent');
        } catch (Exception $e) {
            session()->flash('error', $e->getMessage());
            return;
        }
    }

    public function edit()
    {
        try {
            $this->todo = Todo::findOrFail($this->todo->id);
            $this->newTodo = $this->todo->name;
        } catch (Exception $e) {
            session()->flash('error', $e->getMessage());
        }
        $this->editMode = true;
    }

    public function cancelEdit()
    {
        $this->todo = Todo::findOrFail($this->todo->id);
        $this->editMode = false;
    }

    public function update()
    {
        try {
            $this->todo = Todo::findOrFail($this->todo->id);
            if ($this->newTodo !== $this->todo->name) {
                $this->todo->name = $this->newTodo;
                $this->validateOnly('newTodo');
                $this->todo->save();
            }
        } catch (Exception $e) {
            session()->flash('error', $e->getMessage());
        }

        $this->editMode = false;
        $this->reset('newTodo');
    }


    public function render()
    {
        return view('livewire.pages.todo.todo-item');
    }
}
