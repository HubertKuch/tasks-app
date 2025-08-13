<?php

use App\Enums\TaskStatus;
use App\Livewire\Forms\TaskEditForm;
use App\Models\Task;
use Carbon\Carbon;
use function Livewire\Volt\{form, mount, on, state};

state(['task', 'isReadOnly']);

form(TaskEditForm::class);

mount(function () {
    $this->form->setTask($this->task);
});

on([
    'refresh' => fn () => $this->mount(),
    'completion_date_change' => function ($date) {
        $this->form->completion_date = $date;
        $this->skipRender();
    },
    'markAsDone' => function($taskId) {
        $task = Task::find($taskId);

        $task->update([
            "status" => TaskStatus::Done
        ]);

        $this->dispatch("refresh");
    }
]);

?>


<div
    id="task-{{$task->id}}"
    class="fade-in w-full p-3 static bg-base-100/70 border border-base-300 rounded-2xl shadow-sm flex items-center justify-between hover:shadow-lg transition-shadow duration-300">
    @if(!$this->isReadOnly)
        @livewire('task-edit-dialog', ['task' => $task])
        @livewire('task-history-modal', ["taskId" => $task->id])
    @endif

    <div class="flex items-center gap-2 w-full">

        <div class="flex flex-col gap-2 w-full">
            <div class="flex-as-row justify-between w-full">
                <div class="font-bold text-xl text-base-content w-full">{{ $task->title }}</div>

                @if(!$this->isReadOnly)
                    @livewire('task-dropdown-options', ['task' => $task])
                @endif
            </div>

            <div class="pl-4 cursor-pointer whitespace-pre-line"
                 onclick="document.querySelector('#dialog_{{$task->id}}_task_modal').showModal()">
                {{$task->description}}
            </div>

            <div class="text-xs text-gray-500 flex-as-row justify-between gap-1 mt-2">
                <div>
                    {{Carbon::parse($task->completion_date)->toDateString()}}
                </div>
                <div>
                    <iconify-icon icon="mdi:flag"
                                  class="{{ $task->priority->value === 'high' ? 'text-red-500' : ($task->priority->value === 'medium' ? 'text-yellow-500' : 'text-gray-400') }}">
                    </iconify-icon>
                    <span class="capitalize">{{ $task->priority->value }}</span>
                </div>
            </div>
        </div>
    </div>
</div>

