<?php

namespace App\Livewire;

use App\Enums\TaskStatus;
use Livewire\Component;

class MainView extends Component
{

    public function render()
    {
        $authedUser = \Auth::user();

        return view('views.main-view',
            [
                "all_tasks_count" => $authedUser->tasks()->get()->count(),
                "done_tasks" => $authedUser->tasks()->get()->where('status', TaskStatus::Done)->all(),
                "todo_tasks" => $authedUser->tasks()->get()->where('status', TaskStatus::ToDo)->all(),
                "in_progress_tasks" => $authedUser->tasks()->get()->where('status', TaskStatus::InProgress)->all(),
            ]);
    }
}
