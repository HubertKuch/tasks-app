<?php

namespace App\Livewire\Forms;

use App\Enums\TaskPriority;
use App\Enums\TaskStatus;
use App\Models\Task;
use Livewire\Attributes\Validate;
use Livewire\Form;

class TaskEditForm extends Form
{
    public $id;
    #[Validate('required|min:2')]
    public $title = '';
    public $description = '';
    public $status = TaskStatus::ToDo;
    public $priority = TaskPriority::Low;
    #[Validate('date')]
    public $completion_date = null;

    public Task $task;

    public function setTask(Task $task) {
        $this->id = $task->id;
        $this->title = $task->title;
        $this->description = $task->description;
        $this->priority = $task->priority;
        $this->status = $task->status;
        $this->completion_date = $task->completion_date;

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
