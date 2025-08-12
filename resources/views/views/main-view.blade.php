<div class="app-container w-full h-full flex flex-wrap bg-white">
    <livewire:side-bar tasks-count="{{$all_tasks_count}}"></livewire:side-bar>
    <main>
        <livewire:topbar></livewire:topbar>

        <div class="p-5">
            <div>
                <div>
                    <span class="badge badge-success rounded-sm pl-8 pr-8">
                        Done
                    </span>
                </div>

                <div class="flex gap-2 flex-col">
                    @foreach ($done_tasks as $task)
                        @livewire('single-task-list-view', ['task' => $task])
                    @endforeach
                </div>
            </div>

        </div>
    </main>
</div>
