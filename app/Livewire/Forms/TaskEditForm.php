<?php

namespace App\Livewire\Forms;

use App\Models\Task;
use Livewire\Attributes\Validate;
use Livewire\Form;

class TaskEditForm extends Form
{
    public $id;
    #[Validate('required|min:2')]
    public $title = '';
    public $description = '';
    public $status;
    public $priority;

    public Task $task;

    public function setTask(Task $task) {
        $this->id = $task->id;
        $this->title = $task->title;
        $this->description = $task->description;
        $this->priority = $task->priority;
        $this->status = $task->status;

        $this->task = $task;
    }

    public function store(): void
    {
        \Illuminate\Log\log($this->id);
        $this->validate();

        if ($this->id) {
            $this->task->update($this->all());
        }
    }
}
