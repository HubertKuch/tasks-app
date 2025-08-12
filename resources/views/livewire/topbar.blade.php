<div class="w-full flex items-center justify-between border-b-2 border-base-300 shadow-[0_4px_20px_-13px_rgba(0,0,0,0.2)] bg-base-100/70 backdrop-blur-sm px-4 h-10">
    <button
            title="Toggle sidebar"
            class="toggle-sidebar cursor-pointer w-8 h-8 flex items-center justify-center rounded-lg hover:bg-base-200 transition-colors duration-200 text-gray-600 hover:text-gray-900"
            aria-label="Toggle Sidebar"
    >
        <iconify-icon icon="octicon:sidebar-expand-16" class="w-5 h-5 hidden sidebar__expand"></iconify-icon>
        <iconify-icon icon="octicon:sidebar-collapse-16" class="w-5 h-5 sidebar__collapse"></iconify-icon>
    </button>

    <ul class="flex items-center tabs-nav-container tasks-view-nav gap-2">
        <li>
            <div data-set-view="list" class="tab-item rounded-lg px-4 py-1 text-sm font-semibold  hover:bg-base-300 transition">
                List
            </div>
        </li>
        <li>
            <div data-set-view="board" class="tab-item active-tab rounded-lg px-4 py-1 text-sm font-semibold hover:bg-base-300 transition">
                Board
            </div>
        </li>
    </ul>

    <div class="flex items-center gap-3">
        <button
                class="w-8 h-8 flex items-center justify-center rounded-lg hover:bg-base-200 text-green-600 hover:text-green-800 transition-colors duration-200"
                aria-label="Add New Task"
        >
            <iconify-icon icon="octicon:plus-circle-16" class="w-5 h-5"></iconify-icon>
        </button>

        <details class="relative dropdown dropdown-end">
            <summary
                    class="w-8 h-8 flex items-center justify-center rounded-lg hover:bg-base-200 text-gray-600 hover:text-gray-900 cursor-pointer transition-colors duration-200"
                    aria-label="Settings"
            >
                <iconify-icon icon="octicon:gear-16" class="w-5 h-5"></iconify-icon>
            </summary>

            <ul
                    class="menu menu-md z-[9999] dropdown-content bg-base-200 rounded-xl shadow-lg border border-base-300 p-2 w-52 mt-2 right-0 text-gray-700"
            >
                <li>
                    <a href="/preferences" class="flex items-center gap-2 px-3 py-2 rounded-md hover:bg-base-300 transition">
                        <iconify-icon icon="octicon:sliders-16" class="w-4 h-4"></iconify-icon>
                        Preferences
                    </a>
                </li>
                <li class="divider my-1"></li>
                <li>
                    <a href="/logout" class="flex items-center gap-2 px-3 py-2 rounded-md hover:bg-base-300 transition">
                        <iconify-icon icon="octicon:sign-out-16" class="w-4 h-4"></iconify-icon>
                        Sign out
                    </a>
                </li>
            </ul>
        </details>
    </div>
</div>
