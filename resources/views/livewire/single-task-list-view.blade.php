<div class="w-full  p-3 bg-base-100/70 border border-base-300 rounded-2xl shadow-sm flex items-center justify-between hover:shadow-lg transition-shadow duration-300">

    <div class="flex items-center gap-4">
        <!-- Status Icon -->
        <div class="w-3 h-3 rounded-full
            {{ $task->status->value === 'done' ? 'bg-success' : ($task->status->value === 'in-progress' ? 'bg-yellow-400' : 'bg-gray-400') }}">
        </div>

        <div>
            <div class="font-medium text-base-content">{{ $task->title }}</div>
            <div class="text-xs text-gray-500 flex items-center gap-1">
                <iconify-icon icon="mdi:flag"
                              class="{{ $task->priority->value === 'high' ? 'text-red-500' : ($task->priority->value === 'medium' ? 'text-yellow-500' : 'text-gray-400') }}">
                </iconify-icon>
                <span class="capitalize">{{ $task->priority->value }}</span>
            </div>
        </div>
    </div>

    <details class="dropdown dropdown-end">
        <summary class="list-none p-2 rounded-xl hover:bg-base-200 transition-colors duration-200 cursor-pointer">
            <iconify-icon
                class="inline-icon cursor-pointer text-xl text-gray-600 hover:text-gray-900 transition-colors duration-200 z-10"
                icon="octicon:three-bars-24">
            </iconify-icon>
        </summary>

        <div class="dropdown-content bg-base-100 rounded-2xl shadow-lg border border-base-300 p-1 fade-in">
            <ul class="menu menu-sm min-w-[9rem] z-40">
                <li>
                    <a class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-base-200 transition-colors duration-150 cursor-pointer">
                        <iconify-icon class="text-blue-500" icon="mdi:pencil-outline"></iconify-icon>
                        <span>Edit</span>
                    </a>
                </li>
                <li>
                    <a class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-base-200 transition-colors duration-150 cursor-pointer">
                        <iconify-icon class="text-green-500" icon="mdi:check-circle-outline"></iconify-icon>
                        <span>Mark as Done</span>
                    </a>
                </li>
                <li>
                    <a class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-base-200 transition-colors duration-150 cursor-pointer">
                        <iconify-icon class="text-red-500" icon="octicon:trash-24"></iconify-icon>
                        <span>Delete</span>
                    </a>
                </li>
            </ul>
        </div>
    </details>
</div>
