<div class="app-container w-full h-full flex flex-wrap bg-white">
    <livewire:side-bar tasks-count="{{$all_tasks_count}}"></livewire:side-bar>
    <main>
        <livewire:topbar></livewire:topbar>

{{--        @foreach ($done_tasks as $task)--}}
{{--            <div wire:key="{{$task->id}}">--}}
{{--                {{$task->status}}--}}
{{--            </div>--}}
{{--        @endforeach--}}
    </main>
</div>
