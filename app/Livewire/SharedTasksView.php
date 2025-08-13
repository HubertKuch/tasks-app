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
            redirect('/', 301);
        }

        $this->shareHash = $shareHash;

        $shareEntity = TaskShare::where(["hash" => $shareHash])->first();

        if (!$shareEntity) {
            $this->redirect('/not-found');
        }

        $query = match ($shareEntity->show_all) {
            true => Task::where('user_id', $shareEntity->user_id),
            false => Task::whereIn('id', $shareEntity->tasks)
        };

        $tasks = $query->get()->groupBy('status');

        $this->state = [
            "count" => $query->count(),
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
