<?php

namespace App\Livewire;

use App\Enums\TaskPriority;
use App\Enums\TaskStatus;
use App\Models\Task;
use Auth;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Attributes\On;
use Livewire\Component;

class MainView extends Component
{
    public array $state = [
        "all_tasks_count" => 0,
        "done_tasks" => [],
        "todo_tasks" => [],
        "in_progress_tasks" => [],
        "read_only" => false
    ];

    public array $filters = [];

    #[On('refresh')]
    public function refresh(): void
    {
        $this->reFetchStateWhenNotReadOnly();
    }

    #[On("deleteTask")]
    public function deleteFromDom($taskId): void
    {
        $authedUser = Auth::user();
        $task = $authedUser->tasks->find($taskId);
        $status = $task->status;

        if ($status === TaskStatus::ToDo->value) {
            $this->state["todo_tasks"] = $authedUser->tasks()->get()
                ->where('status', TaskStatus::ToDo)
                ->whereNotIn('id', $taskId)
                ->all();
        } else if ($status === TaskStatus::InProgress->value) {
            $this->state["in_progress_tasks"] = $authedUser->tasks()->get()
                ->where('status', TaskStatus::InProgress)
                ->whereNotIn('id', $taskId)
                ->all();
        } else if ($status === TaskStatus::Done->value) {
            $this->state["done_tasks"] = $authedUser->tasks()->get()
                ->where('status', TaskStatus::Done)
                ->whereNotIn('id', $taskId)
                ->all();
        }

        $this->dispatch("postDeleteTaskFromDom", taskId: $taskId);
    }

    #[On("postDeleteTaskFromDom")]
    public function postDeleteFromDom($taskId): void
    {
        Task::find($taskId)->deleteQuietly();
        $this->mount();
    }

    #[On('taskFilters')]
    public function filters($filters): void {
        $this->filters = $filters;

        $this->refresh();
    }

    public function mount($readOnly = false, $state = []): void
    {
        if (!$readOnly) {
            $this->reFetchStateWhenNotReadOnly();
        } else {
            $this->state = $state;
            $this->state['read_only'] = true;
        }
    }

    public function reFetchStateWhenNotReadOnly(): void
    {
        if ($this->state['read_only']) {
            return;
        }

        $authedUser = Auth::user();

        $tasksQuery = $authedUser->tasks();

        if (array_key_exists('after', $this->filters) && array_key_exists('before', $this->filters)) {
            $tasksQuery->whereBetween('completion_date', [
                $this->filters['after'],
                $this->filters['before']
            ]);
        }

        // search for late tasks: before today
        else if (array_key_exists('late', $this->filters)) {
            $tasksQuery->whereBeforeToday('completion_date');
        }

        // priority filters
        if (array_key_exists('priority', $this->filters)) {
            $tasksQuery->where('priority', $this->filters['priority']);
        }

        // status filters
        if (array_key_exists('status', $this->filters)) {
            $tasksQuery->where('status', $this->filters['status']);
        }

        $groupedTasks = $tasksQuery
            ->orderBy('completion_date')
            ->get()
            ->groupBy('status');

        $this->state = [
            "read_only" => false,
            "all_tasks_count" => $authedUser->tasks()->get()->count(),
            "count" => $groupedTasks->count(),
            "done_tasks" => $groupedTasks[TaskStatus::Done->value] ?? [],
            "todo_tasks" => $groupedTasks[TaskStatus::ToDo->value] ?? [],
            "in_progress_tasks" => $groupedTasks[TaskStatus::InProgress->value] ?? [],
        ];
    }

    public function render(): View|Application|Factory|\Illuminate\View\View
    {
        return view('views.main-view');
    }
}
