<?php

use App\Livewire\Forms\TaskEditForm;
use App\Models\Task;
use function Livewire\Volt\{form, mount, rules, state};

form(TaskEditForm::class);

rules([
    "title" => "required",
    "status" => "required",
    "priority" => "required"
]);

$createTask = function () {
    $user = Auth::user();

    Task::create([
        "user_id" => $user->id,
        ...$this->form->all()
    ]);

    $this->dispatch("refresh");
};

?>

<div class="w-full flex items-center justify-between border-b-2 border-base-300 shadow-[0_4px_20px_-13px_rgba(0,0,0,0.2)] bg-base-100/70 backdrop-blur-sm px-4 h-10">
    <button
            title="Toggle sidebar"
            class="toggle-sidebar cursor-pointer w-8 h-8 flex items-center justify-center rounded-lg hover:bg-base-200 transition-colors duration-200 text-gray-600 hover:text-gray-900"
            aria-label="Toggle Sidebar"
    >
        <iconify-icon icon="octicon:sidebar-expand-16" class="w-5 h-5 hidden sidebar__expand"></iconify-icon>
        <iconify-icon icon="octicon:sidebar-collapse-16" class="w-5 h-5 sidebar__collapse"></iconify-icon>
    </button>

    <ul class="flex items-center tabs-nav-container tasks-view-nav gap-2">
        <li>
            <div data-set-view="list"
                 class="tab-item rounded-lg px-4 py-1 text-sm font-semibold hover:bg-base-300 transition">
                List
            </div>
        </li>
        <li>
            <div data-set-view="board"
                 class="tab-item active-tab rounded-lg px-4 py-1 text-sm font-semibold hover:bg-base-300 transition">
                Board
            </div>
        </li>
    </ul>

    <div class="flex items-center gap-3">
        <button
                onclick="document.querySelector('#dialog_new_task').showModal()"
                class="w-8 h-8 flex items-center justify-center rounded-lg hover:bg-base-200 text-green-600 hover:text-green-800 transition-colors duration-200"
                aria-label="Add New Task"
        >
            <iconify-icon icon="octicon:plus-circle-16" class="w-5 h-5"></iconify-icon>
        </button>

        <details class="relative dropdown dropdown-end">
            <summary
                    class="w-8 h-8 flex items-center justify-center rounded-lg hover:bg-base-200 text-gray-600 hover:text-gray-900 cursor-pointer transition-colors duration-200"
                    aria-label="Settings"
            >
                <iconify-icon icon="octicon:gear-16" class="w-5 h-5"></iconify-icon>
            </summary>

            <ul
                    class="menu menu-md z-[9999] dropdown-content bg-base-200 rounded-xl shadow-lg border border-base-300 p-2 w-52 -mt-2 right-0 text-gray-700"
            >
                <li>
                    <a href="/preferences"
                       class="flex items-center gap-2 px-3 py-2 rounded-md hover:bg-base-300 transition">
                        <iconify-icon icon="octicon:sliders-16" class="w-4 h-4"></iconify-icon>
                        Preferences
                    </a>
                </li>
                <li class="divider my-1"></li>
                <li>
                    <a href="/logout" class="flex items-center gap-2 px-3 py-2 rounded-md hover:bg-base-300 transition">
                        <iconify-icon icon="octicon:sign-out-16" class="w-4 h-4"></iconify-icon>
                        Sign out
                    </a>
                </li>
            </ul>
        </details>
    </div>


    {{-- modals --}}
    <dialog id="dialog_new_task" class="modal modal-open:bg-black/40 backdrop-blur-sm">
        <form wire:submit="createTask" method="dialog" class="modal-box max-w-md rounded-xl bg-base-100 shadow-xl p-6">
            @csrf
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
                    <option value="to-do">To-do</option>
                    <option value="in-progress" >In Progress</option>
                    <option value="done">Done</option>
                </select>
            </div>

            <div>
                <label class="label text-xs font-semibold text-gray-500">Priority</label>
                <select
                        wire:model="form.priority"

                        name="priority" class="select select-bordered w-full">
                    <option value="low" >Low</option>
                    <option value="medium" >Medium</option>
                    <option value="high">High</option>
                </select>
            </div>

            <div class="modal-action justify-end">
                <button onclick="document.querySelector('#dialog_new_task').close()" type="submit"
                        class="btn btn-primary btn-sm px-6">
                    Save
                </button>
                <button type="button" onclick="document.querySelector('#dialog_new_task').close()"
                        class="btn btn-secondary btn-sm px-6">
                    Close
                </button>
            </div>
        </form>
    </dialog>
</div>
