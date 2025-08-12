<div class="w-full flex-as-row justify-between default-border border-b-2 h-8 shadow-[0px_4px_20px_-13px_rgba(0,_0,_0,_0.2)]">
    <div class="w-8 h-8 text-center pt-1 cursor-pointer ">
        <iconify-icon class="inline-icon secondary-text hover:bg-base-200 p-1"
                      icon="octicon:sidebar-expand-16"></iconify-icon>
    </div>
    <ul class="join justify-center items-center flex-as-row w-full">
        <li class="join-item">
            <button class="btn btn-ghost bg-base-200 secondary-text rounded h-fit">List</button>
        </li>
    </ul>
    <div class="w-fit h-full text-center pt-1 cursor-pointer flex-as-row">
        <iconify-icon class="inline-icon secondary-text hover:bg-base-200 p-1 rounded" icon="octicon:plus-circle-16"></iconify-icon>
        <details class="dropdown dropdown-end">
            <summary>
                <iconify-icon class="rounded inline-icon secondary-text hover:bg-base-200 p-1"
                              icon="octicon:gear-16"></iconify-icon>
            </summary>
            <ul class="menu text-sm text-neutral dropdown-content hover:shadow-3xl bg-base-200 glass backdrop-blur-3xl z-10 w-52 p-2 shadow right-2 -mt-1">
                <li class="">
                    <a href="/logout" class="p-1 pl-2 pr-2">
                        <iconify-icon icon="octicon:sliders-16" class="inline-icon"></iconify-icon>
                        Preferences
                    </a>
                </li>
                <div class="divider p-0 m-0"></div>
                <li class="">
                    <a href="/logout" class="p-1 pl-2 pr-2">
                        <iconify-icon icon="octicon:sign-out-16" class="inline-icon"></iconify-icon>
                        Sign out
                    </a>
                </li>
            </ul>
        </details>
    </div>
</div>
