<?php

namespace App\Livewire;

use App\Models\Task;
use Livewire\Component;

class SingleTaskListView extends Component
{
    public Task $task;

    public function render()
    {
        return view('livewire.single-task-list-view', [
            "task" => $this->task
        ]);
    }
}
