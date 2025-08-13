<div class="app-container w-full h-full flex bg-white min-h-screen">
    @livewire('side-bar', ['tasksCount' => $state["all_tasks_count"]])

    <main class="flex-1 flex flex-col h-full">
        @livewire('topbar')

        <section class="tasks-container p-6 flex gap-4 h-full overflow-y-auto" data-view="board">
            <div class="flex flex-col gap-3 w-full">
                <div>
                <span class="badge badge-success rounded-lg px-6 py-2 text-lg font-semibold shadow-md">
                  Done
                </span>
                </div>

                <div class="flex flex-col gap-4">
                    @foreach ($state['done_tasks'] as $task)
                        @livewire('singletask', ['task' => $task], key('done-'.$task->id))
                    @endforeach
                </div>
            </div>

            <div class="flex flex-col gap-3 w-full">
                <div>
                <span class="badge badge-accent rounded-lg px-6 py-2 text-lg font-semibold shadow-md">
                  In-progress
                </span>
                </div>

                <div class="flex flex-col gap-4">
                    @foreach ($state["in_progress_tasks"] as $task)
                        @livewire('singletask', ['task' => $task], key('in-progress-'.$task->id))
                    @endforeach
                </div>
            </div>

            <div class="flex flex-col gap-3 w-full">
                <div>
                <span class="badge badge-primary rounded-lg px-6 py-2 text-lg font-semibold shadow-md">
                  Todo
                </span>
                </div>

                <div class="flex flex-col gap-4">
                    @foreach ($state["todo_tasks"] as $task)
                        @livewire('singletask', ['task' => $task], key('todo-'.$task->id))
                    @endforeach
                </div>
            </div>
        </section>
    </main>

    <livewire:task-share-modal />
</div>
