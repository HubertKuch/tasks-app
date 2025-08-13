<?php

namespace App\Livewire;

use App\Enums\TaskStatus;
use App\Models\Task;
use Auth;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Attributes\On;
use Livewire\Component;
use function Termwind\render;

class MainView extends Component
{
    public array $state = [
        "all_tasks_count" => 0,
        "done_tasks" => [],
        "todo_tasks" => [],
        "in_progress_tasks" => [],
    ];

    #[On('refresh')]
    public function refresh(): void
    {
        $this->reFetchState();
    }

    #[On("deleteTask")]
    public function deleteFromDom($taskId, $status): void
    {
        $authedUser = Auth::user();

        if ($status === TaskStatus::ToDo->value) {
            $this->state["todo_tasks"] = $authedUser->tasks()->get()
                -> where('status', TaskStatus::ToDo)
                -> whereNotIn('id', $taskId)
                -> all();
        } else if ($status === TaskStatus::InProgress->value) {
            $this->state["in_progress_tasks"] = $authedUser->tasks()->get()
                ->where('status', TaskStatus::InProgress)
                ->whereNotIn('id', $taskId)
                ->all();
        } else if ($status === TaskStatus::Done->value) {
            $this->state["done_tasks"] = $authedUser->tasks()->get()
                -> where('status', TaskStatus::Done)
                -> whereNotIn('id', $taskId)
                -> all();
        }

        $this->dispatch("postDeleteTaskFromDom", taskId: $taskId);
    }

    #[On("postDeleteTaskFromDom")]
    public function postDeleteFromDom($taskId)
    {
        Task::find($taskId)->deleteQuietly();
    }


    public function mount(): void
    {
        $this->reFetchState();
    }

    public function reFetchState(): void
    {
        $authedUser = Auth::user();

        $this->state = [
            "all_tasks_count" => $authedUser->tasks()->get()->count(),
            "done_tasks" => $authedUser->tasks()->get()->where('status', TaskStatus::Done)->all(),
            "todo_tasks" => $authedUser->tasks()->get()->where('status', TaskStatus::ToDo)->all(),
            "in_progress_tasks" => $authedUser->tasks()->get()->where('status', TaskStatus::InProgress)->all(),
        ];
    }

    public function render(): View|Application|Factory|\Illuminate\View\View
    {
        return view('views.main-view');
    }
}
