<?php

namespace App\Livewire;

use App\Livewire\Forms\TaskEditForm;
use App\Models\Task;
use Livewire\Component;

class SingleTaskListView extends Component
{
    public Task $task;
    public TaskEditForm $form;

    public function render()
    {
        $this->form->setTask($this->task);

        return view('livewire.single-task-list-view');
    }

    public function editTask(): void
    {
        $this->form->store();
        $this->dispatch('refresh')->to(MainView::class);;
    }
}
