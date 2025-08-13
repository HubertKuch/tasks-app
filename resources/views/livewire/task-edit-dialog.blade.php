<?php

use App\Enums\TaskStatus;
use App\Livewire\Forms\TaskEditForm;
use Carbon\Carbon;
use function Livewire\Volt\{state, form, on, mount};

state(['task']);

form(TaskEditForm::class);

on([
    'completion_date_change' => function ($date) {
        $this->form->completion_date = $date;
        $this->skipRender();
    }
]);

mount(function () {
    $this->form->setTask($this->task);
});

$edit = function () {
    $updated = $this->task->update([
        "title" => $this->form->title,
        "status" => $this->form->status,
        "description" => $this->form->description,
        "priority" => $this->form->priority,
        "completion_date" => $this->form->completion_date
    ]);

    if ($updated) {
        $this->task->snapshot();
    }

    $this->dispatch('refresh');
};

?>

<dialog id="dialog_{{$task->id}}_task_modal" class="modal modal-open:bg-black/40 backdrop-blur-sm">
    <form method="dialog" wire:submit="edit" class="modal-box max-w-md rounded-xl bg-base-100 shadow-xl p-6">
        @csrf
        <input type="hidden" wire:model="task.id">

        <input
                wire:model="form.title"
                type="text"
                class="input input-bordered w-full text-lg font-semibold mb-4"
                placeholder="Task Title"
                autofocus
        />

        <textarea
                wire:model="form.description"
                class="textarea textarea-bordered w-full min-h-[150px] resize-none mb-6 text-gray-700"
        ></textarea>

        <div>
            <label class="label text-xs font-semibold text-gray-500">Status</label>
            <select wire:model="form.status" class="select select-bordered w-full">
                <option value="to-do">To-do</option>
                <option value="in-progress">In Progress</option>
                <option value="done">Done</option>
            </select>
        </div>

        <div>
            <label class="label text-xs font-semibold text-gray-500">Priority</label>
            <select wire:model="form.priority" class="select select-bordered w-full">
                <option value="low">Low</option>
                <option value="medium">Medium</option>
                <option value="high">High</option>
            </select>
        </div>

        <div>
            <label class="label text-xs font-semibold text-gray-500">Completion date</label>
            <button type="button" popovertarget="cally-popover-{{$task->id}}" class="input input-border w-full"
                    id="cally-{{$task->id}}" style="anchor-name:--cally">
                {{ Carbon::parse($this->form->completion_date)->toDateString() }}
            </button>
            <div popover id="cally-popover-{{$task->id}}" wire:ignore
                 class="dropdown bg-base-100 rounded-box shadow-lg"
                 style="position-anchor:--cally">
                <calendar-date
                        value="{{ Carbon::parse($this->form->completion_date)->toDateString() }}"
                        min="{{ now()->toDateString() }}"
                        class="cally"
                        wire:model="form.completion_date"
                        wire:ignore
                        onchange="document.querySelector('#cally-{{$task->id}}').textContent = this.value"
                        wire:change="dispatchSelf('completion_date_change', [$event.target.value])"
                >
                    <svg aria-label="Previous" class="fill-current size-4" slot="previous"
                         xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path d="M15.75 19.5 8.25 12l7.5-7.5"></path>
                    </svg>
                    <svg aria-label="Next" class="fill-current size-4" slot="next"
                         xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path d="m8.25 4.5 7.5 7.5-7.5 7.5"></path>
                    </svg>
                    <calendar-month></calendar-month>
                </calendar-date>
            </div>
        </div>

        <div class="modal-action justify-end">
            <button onclick="document.querySelector('#dialog_{{$task->id}}_task_modal').close()"
                    type="submit"
                    class="btn btn-primary btn-sm px-6">
                Save
            </button>
            <button type="button"
                    onclick="document.querySelector('#dialog_{{$task->id}}_task_modal').close()"
                    class="btn btn-secondary btn-sm px-6">
                Close
            </button>
        </div>
    </form>
</dialog>
