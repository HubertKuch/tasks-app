<nav id="main-sidebar" class="flex sidebar fade-in active flex-col h-full bg-secondary text-gray-600 border-r-2 border-base-300">
    <div class="px-6 py-4 border-b border-base-300 flex items-center gap-2 select-none">
        <iconify-icon icon="octicon:tasklist-16" class="w-5 h-5 text-gray-500 inline-block"></iconify-icon>
        <span class="text-sm font-semibold text-gray-700 leading-none">TaskMaster</span>
    </div>


    <div class="flex-1 overflow-y-auto pt-4 text-xs">
        <div class="p-4">
            <div
                class="w-full mb-2 cursor-pointer flex items-center justify-between rounded-md px-3 py-2 hover-bg transition-colors duration-200 select-none"
                role="button"
                tabindex="0"
                aria-label="All Tasks"
            >
                <div class="flex items-center gap-2 font-normal text-gray-700">
                    <iconify-icon icon="octicon:archive-16" width="1em" height="1em" class="text-gray-500"></iconify-icon>
                    All
                </div>
                <div
                    class="inline-flex items-center justify-center min-w-[1.6rem] min-h-[1.6rem] text-[0.65rem] font-semibold rounded-full bg-base-300 text-gray-700 shadow-sm"
                    aria-label="Total tasks count"
                >
                    {{ $tasksCount }}
                </div>
            </div>
        </div>
    </div>
</nav>
