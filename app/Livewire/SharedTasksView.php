<?php

namespace App\Livewire;

use App\Enums\TaskStatus;
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

        $this->state = [
            "done_tasks" => [],
            "todo_tasks" => [],
            "in_progress_tasks" => [],
        ];
    }

    public function render()
    {
        return view('livewire.shared-tasks-view');
    }
}
