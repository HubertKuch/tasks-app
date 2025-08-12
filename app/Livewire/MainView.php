<?php

namespace App\Livewire;

use App\Enums\TaskStatus;
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
    ];

    #[On('refresh')]
    public function refresh(): void
    {
        \Illuminate\Log\log("test refresh pls work that time");
        $this->reFetchState();
    }

    public function mount(): void
    {
        $this->reFetchState();
    }

    public function reFetchState(): void {
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
