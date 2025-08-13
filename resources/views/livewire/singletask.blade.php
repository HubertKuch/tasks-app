<?php

use App\Enums\TaskStatus;
use App\Livewire\Forms\TaskEditForm;
use App\Models\Task;
use function Livewire\Volt\{form, mount, state};

state(['task', 'isReadOnly'])->reactive();

form(TaskEditForm::class);

mount(function () {
    $this->form->setTask($this->task);
});

$edit = function (Task $taskToUpdate) {
    $taskToUpdate->update([
        "title" => $this->form->title,
        "status" => $this->form->status,
        "description" => $this->form->description,
        "priority" => $this->form->priority
    ]);

    $this->dispatch('refresh');
};

$markAsDone = function (Task $completedTask) {
    $completedTask->update([
        "status" => TaskStatus::Done
    ]);

    $this->dispatch("refresh");
};

$deleteTask = function (Task $taskToDelete) {
    $this->dispatch("deleteTask", taskId: $taskToDelete->id, status: $taskToDelete->status);
}

?>


<div
    id="task-{{$task->id}}"
    class="w-full p-3 static bg-base-100/70 border border-base-300 rounded-2xl shadow-sm flex items-center justify-between hover:shadow-lg transition-shadow duration-300">

    @if(!$this->isReadOnly)
        <dialog id="dialog_{{$task->id}}_task_modal" class="modal modal-open:bg-black/40 backdrop-blur-sm">
            <form method="dialog" wire:submit="edit({{$task->id}})"
                  class="modal-box max-w-md rounded-xl bg-base-100 shadow-xl p-6">
                @csrf
                <input type="hidden" name="task_id" wire:model="task.id">
                <input
                    wire:model="form.title"
                    type="text"
                    class="input input-bordered w-full text-lg font-semibold mb-4"
                    placeholder="Task Title"
                    name="title"
                    autofocus
                />

                <textarea
                    wire:model="form.description"
                    class="textarea textarea-bordered w-full min-h-[150px] resize-none mb-6 text-gray-700"
                    contenteditable="true"
                ></textarea>

                <div>
                    <label class="label text-xs font-semibold text-gray-500">Status</label>
                    <select
                        wire:model="form.status"
                        name="status" class="select select-bordered w-full">
                        <option value="to-do" @selected($task->status === 'to-do')>To-do</option>
                        <option value="in-progress" @selected($task->status === 'in-progress')>In Progress</option>
                        <option value="done" @selected($task->status === 'done')>Done</option>
                    </select>
                </div>

                <div>
                    <label class="label text-xs font-semibold text-gray-500">Priority</label>
                    <select
                        wire:model="form.priority"

                        name="priority" class="select select-bordered w-full">
                        <option value="low" @selected($task->priority === 'low')>Low</option>
                        <option value="medium" @selected($task->priority === 'medium')>Medium</option>
                        <option value="high" @selected($task->priority === 'high')>High</option>
                    </select>
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
    @endif

    <div class="flex items-center gap-4"
         onclick="document.querySelector('#dialog_{{$task->id}}_task_modal').showModal()">
        <div class="w-3 h-3 rounded-full
            {{ $task->status->value === 'done' ? 'bg-success' : ($task->status->value === 'in-progress' ? 'bg-yellow-400' : 'bg-gray-400') }}">
        </div>

        <div>
            <div class="font-medium text-base-content">{{ $task->title }}</div>
            <div class="text-xs text-gray-500 flex items-center gap-1">
                <iconify-icon icon="mdi:flag"
                              class="{{ $task->priority->value === 'high' ? 'text-red-500' : ($task->priority->value === 'medium' ? 'text-yellow-500' : 'text-gray-400') }}">
                </iconify-icon>
                <span class="capitalize">{{ $task->priority->value }}</span>
            </div>
        </div>
    </div>

    @if(!$this->isReadOnly)
        <details class="dropdown static inline">
            <summary
                class="list-none p-2 rounded-xl block hover:bg-base-200 transition-colors duration-200 cursor-pointer">
                <iconify-icon
                    class="inline-icon cursor-pointer text-xl text-gray-600 hover:text-gray-900 transition-colors duration-200 z-10"
                    icon="octicon:three-bars-24">
                </iconify-icon>
            </summary>

            <div class="dropdown-content bg-base-100 rounded-2xl shadow-lg border border-base-300 p-1 fade-in">
                <ul class="menu menu-sm min-w-[9rem] z-40">
                    <li>
                        <a onclick="document.querySelector('#dialog_{{$task->id}}_task_modal').showModal()"
                           class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-base-200 transition-colors duration-150 cursor-pointer">
                            <iconify-icon class="text-blue-500" icon="mdi:pencil-outline"></iconify-icon>
                            <span>Edit</span>
                        </a>
                    </li>
                    @if($task->status !== TaskStatus::Done)
                        <li>
                            <a wire:click="markAsDone({{$task->id}})"
                               class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-base-200 transition-colors duration-150 cursor-pointer">
                                <iconify-icon class="text-green-500" icon="mdi:check-circle-outline"></iconify-icon>
                                <span>Mark as Done</span>
                            </a>
                        </li>
                    @endif
                    <li>
                        <a wire:click.prevent="deleteTask({{$task->id}})"
                           class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-base-200 transition-colors duration-150 cursor-pointer">
                            <iconify-icon class="text-red-500" icon="octicon:trash-24"></iconify-icon>
                            <span>Delete</span>
                        </a>
                    </li>
                </ul>
            </div>
        </details>
    @endif
</div>

