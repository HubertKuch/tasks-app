<?php

use App\Models\TaskShare;
use App\Models\Task;
use function Livewire\Volt\{on, state};

state([
    'show_all' => true,
    'selected_tasks' => [],
    'share_link' => null,
    'modal_open' => false
]);

$generateShare = function () {

    $share = TaskShare::create([
        'user_id' => auth()->id(),
        'show_all' => $this->show_all,
        'tasks' => $this->show_all ? null : $this->selected_tasks,
    ]);

    $this->share_link = route('share.show', $share->hash);
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
            <div>
                @foreach (Task::where('user_id', auth()->id())->get() as $task)
                    <label>
                        <input type="checkbox" value="{{ $task->id }}" wire:model="selected_tasks">
                        {{ $task->title }}
                    </label>
                @endforeach
            </div>
        @endif

        <button wire:click="generateShare">Generate Link</button>

        @if ($share_link)
            <div>
                <input type="text" readonly value="{{ $share_link }}">
            </div>
        @endif
    </form>
</dialog>
