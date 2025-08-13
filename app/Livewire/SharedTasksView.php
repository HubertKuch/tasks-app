<?php

namespace App\Livewire;

use App\Enums\TaskStatus;
use App\Models\Task;
use App\Models\TaskShare;
use Livewire\Component;

class SharedTasksView extends Component
{
    public string $shareHash;
    public array $state;

    public function mount($shareHash): void
    {
        if (auth()->check()) {
            $this->redirect('/');
        }

        $this->shareHash = $shareHash;

        $shareEntity = TaskShare::where(["hash" => $shareHash])->first();

        if (!$shareEntity) {
            $this->redirect('/not-found');
        }

        $tasks = Task::whereIn('id', $shareEntity->tasks)
            ->get()
            ->groupBy('status');

        $this->state = [
            "done_tasks" => $tasks[TaskStatus::Done->value] ?? [],
            "todo_tasks" => $tasks[TaskStatus::ToDo->value] ?? [],
            "in_progress_tasks" => $tasks[TaskStatus::InProgress->value] ?? [],
        ];
    }

    public function render()
    {
        return view('livewire.shared-tasks-view');
    }
}
