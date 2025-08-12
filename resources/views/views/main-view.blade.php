<div class="app-container w-full h-full flex bg-white min-h-screen">
    <livewire:side-bar tasks-count="{{ $all_tasks_count }}"/>

    <main class="flex-1 flex flex-col h-full">
        <livewire:topbar/>

        <section class="p-6 flex flex-col gap-6 h-full overflow-y-auto">
            <div>
                <span class="badge badge-success rounded-lg px-6 py-2 text-lg font-semibold shadow-md">
                  Done
                </span>
            </div>

            <div class="flex flex-col gap-4">
                @foreach ($done_tasks as $task)
                    @livewire('single-task-list-view', ['task' => $task])
                @endforeach
            </div>
        </section>
    </main>
</div>
