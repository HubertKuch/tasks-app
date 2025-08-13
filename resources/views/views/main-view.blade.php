<div class="app-container w-full h-full flex bg-white min-h-screen">
    @if(auth()->check())
        @livewire('side-bar', ['tasksCount' => $state["all_tasks_count"]])
    @endif

    <main class="flex-1 flex flex-col h-full">
        @livewire('topbar')

        <section class="tasks-container p-6 flex gap-4 h-full overflow-y-auto" data-view="board">
            @if($state['count'] !== 0)
                <div class="flex flex-col gap-3 w-full">
                    <div>
                <span class="badge badge-success rounded-lg px-6 py-2 text-lg font-semibold shadow-md">
                  Done
                </span>
                    </div>

                    <div class="flex flex-col gap-4">
                        @foreach ($state['done_tasks'] as $task)
                            @livewire('singletask', ['task' => $task, 'isReadOnly' => $state['read_only']], key('done-'.$task->id))
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
                            @livewire('singletask', ['task' => $task, "isReadOnly" => $state['read_only']], key('in-progress-'.$task->id))
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
                            @livewire('singletask', ['task' => $task, "isReadOnly" => $state['read_only']], key('todo-'.$task->id))
                        @endforeach
                    </div>
                </div>

            @else
                <div class="text-center w-full">
                    <h1 class="text-lg">
                        @if(array_key_exists('late', $filters))
                            Hopefully you don't have any late tasks!
                        @else
                            You dont have any tasks. Add them using a + sign in topbar.
                        @endif
                    </h1>
                </div>
            @endif
        </section>
    </main>

    @if(auth()->check())
        <livewire:task-share-modal/>
    @endif

</div>
