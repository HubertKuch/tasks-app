<?php

use App\Models\TaskShare;
use App\Models\Task;
use function Livewire\Volt\{on, state};

state([
    'show_all' => true,
    'selected_tasks' => [],
    'share_link' => null,
    'modal_open' => false,
]);

$generateShare = function () {
    $share = TaskShare::create([
        'user_id' => auth()->id(),
        'show_all' => $this->show_all,
        'tasks' => $this->show_all ? null : $this->selected_tasks,
    ]);

    $this->share_link = $share->hash;
};

on([
    'task-share-modal-open' => fn() => $this->modal_open = true
]);

?>

<dialog class="modal modal-open:bg-black/40 backdrop-blur-sm" id="share_tasks_modal" {{$modal_open ? "open" : ""}}>
    <form class="modal-box max-w-md rounded-xl bg-base-100 shadow-xl p-6 flex flex-col gap-3">
        <fieldset className="fieldset bg-base-100 border-base-300 rounded-box w-64 border p-4">
            <legend className="fieldset-legend">Share options</legend>
            <label className="label">
                <input type="checkbox" wire:model.live="show_all" className="checkbox"/>
                Share all tasks
            </label>
        </fieldset>

        @if (!$show_all)
            <div class="flex flex-col gap-2 max-h-48 overflow-y-auto">
                @foreach (Task::where('user_id', auth()->id())->get() as $task)
                    <label>
                        <input type="checkbox" value="{{ $task->id }}" wire:model="selected_tasks">
                        {{ $task->title }}
                    </label>
                @endforeach
            </div>
        @endif

        <button type="button" class="btn text-white flex w-full justify-center rounded-md bg-indigo-500 px-3 py-1.5 text-sm/6 font-semibold hover:bg-indigo-400 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500" wire:click="generateShare">Generate Link</button>

        @if ($share_link)
            <div class="flex items-stretch gap-2 w-full max-w-xl">
                <input
                    id="share-url"
                    type="text"
                    value="{{ $share_link }}"
                    readonly
                    class="input input-bordered grow font-mono text-xs sm:text-sm bg-base-100/70 focus:outline-none"
                />

                <button
                    type="button"
                    class="btn btn-primary shrink-0 copy-btn"
                    data-copy-target="#share-url"
                    aria-label="Copy link"
                    onclick="TasksApp.copyToClipboard('{{$share_link}}')"
                >
                    <iconify-icon icon="octicon:copy-16" class="w-4 h-4"></iconify-icon>
                    <span class="hidden sm:inline copy-label">Copy</span>
                </button>
            </div>
        @endif
    </form>
</dialog>
