<?php

use App\Enums\TaskPriority;
use App\Enums\TaskStatus;
use App\Models\Task;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use function Livewire\Volt\{on, state, mount};

state([
    'taskId',
    'history' => [],
    'task'
]);

on([
    'refresh' => fn() => $this->mount()
]);

mount(function () {
    $task = Task::find($this->taskId);

    $this->task = $task;

    $snapshots = $task
        ->snapshots()
        ->orderBy('created_at')
        ->get();


    $previousData = null;
    $history = [];

    foreach ($snapshots as $snapshot) {
        $currentData = $snapshot['data']['attributes'];
        $changes = [];

        if ($previousData) {
            foreach ($currentData as $field => $value) {
                $oldValue = $previousData[$field] ?? null;

                if ($oldValue !== $value) {
                    $changes[$field] = [
                        'old' => $oldValue,
                        'new' => $value,
                    ];

                    if ($field == "completion_date") {
                        $changes[$field] = [
                            'old' => Carbon::parse($oldValue)->toDateString(),
                            'new' => Carbon::parse($value)->toDateString(),
                        ];
                    }

                }
            }
        }

        $previousData = $currentData;

        $history[] = [
            'changes' => $changes,
            'created_at' => Carbon::parse($snapshot->created_at)->diffForHumans(),
        ];
    }

    $this->history = $history;
});

?>

<dialog class="modal modal-open:bg-black/40 backdrop-blur-sm" id="task-{{$taskId}}-history-modal">
    <div class="modal-box max-w-3xl mx-auto p-6 space-y-4">
        <div class="flex justify-between">
            <div>
                <p class="text-2xl">Changes of <strong>{{$task->title}}</strong> task</p>
            </div>
            <div class="w-8 h-8">
                <a onclick="document.querySelector('#task-{{$taskId}}-history-modal').close()"
                   class="cursor-pointer hover-bg text-xl text-center">
                    <iconify-icon icon="octicon:x-circle-16" class="text-2xl"></iconify-icon>
                </a>
            </div>
        </div>
        @foreach($history as $item)
            @if(!empty($item['changes']))
                <div
                    class="rounded-2xl border border-white/20 bg-white/30 backdrop-blur-md shadow-md p-4 hover:shadow-lg transition">
                    <div class="flex items-center justify-between">
                        <span class="text-xs text-gray-500">{{ $item['created_at'] }}</span>
                    </div>
                    @foreach($item['changes'] as $field => $change)
                        <div class="mt-2 text-sm text-gray-700 space-y-1">
                            <div>
                                <span class="font-medium">{{ ucfirst(str_replace('_', ' ', $field)) }}:</span>
                                <span class="text-red-500 line-through">{{ $change['new'] ?? '—' }}</span>
                                <span class="text-gray-500">→</span>
                                <span class="text-gray-700">{{ $change['old'] ?? '—' }}</span>
                            </div>

                        </div>
                    @endforeach

                </div>
            @endif
        @endforeach
    </div>
</dialog>
