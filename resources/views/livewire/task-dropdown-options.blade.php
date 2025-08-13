<?php

use App\Enums\TaskStatus;
use function Livewire\Volt\{state};

state('task');

?>

<details class="dropdown static inline">
    <summary
            class="list-none p-2 rounded-xl w-8 h-8 block hover:bg-base-200 transition-colors duration-200 cursor-pointer">
        <iconify-icon
                class="inline-icon cursor-pointer text-xl text-gray-600 hover:text-gray-900 transition-colors duration-200 z-10"
                icon="octicon:three-bars-24">
        </iconify-icon>
    </summary>

    <div
            class="dropdown-content bg-base-100 rounded-2xl shadow-lg border border-base-300 p-1 fade-in">
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
                    <a wire:click="dispatch('markAsDone', ['{{$task->id}}'])"
                       class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-base-200 transition-colors duration-150 cursor-pointer">
                        <iconify-icon class="text-green-500"
                                      icon="mdi:check-circle-outline"></iconify-icon>
                        <span>Mark as Done</span>
                    </a>
                </li>
            @endif

            <li>
                <a
                        onclick="document.querySelector('#task-{{$task->id}}-history-modal').showModal()"
                        class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-base-200 transition-colors duration-150 cursor-pointer">
                    <iconify-icon class="text-indigo-500" icon="octicon:history-24"></iconify-icon>
                    <span>History</span>
                </a>
            </li>

            <li>
                <a wire:click.prevent="dispatch('deleteTask', ['{{$task->id}}'])"
                   class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-base-200 transition-colors duration-150 cursor-pointer">
                    <iconify-icon class="text-red-500" icon="octicon:trash-24"></iconify-icon>
                    <span>Delete</span>
                </a>
            </li>
        </ul>
    </div>
</details>
