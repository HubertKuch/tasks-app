<div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-sm">
        <h1 class="mt-10 text-center text-2xl/9 font-bold tracking-tight title">Create your account</h1>
    </div>

    <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
        @if($errors->any())
            <span class="error">{{$errors->first()}}</span>
        @endif
        <form action="/register" method="POST" class="space-y-6">
            @csrf
            <div>
                <label for="email" class="block text-sm/6 font-medium secondary-text">Email address</label>
                <div class="mt-2">
                    <input id="email" type="email" name="email" required autocomplete="email"
                           class="input block w-full rounded-md bg-base-200 active:bg-base-300/20 px-3 py-1.5 text-base secondary-text outline-1 -outline-offset-1 outline-indigo-400/40 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6"/>
                </div>
            </div>

            <div>
                <div class="flex items-center justify-between">
                    <label for="password" class="block text-sm/6 font-medium secondary-text">Password</label>
                </div>
                <div class="mt-2">
                    <input id="password" type="password" name="password" required autocomplete="current-password"
                           class="input block w-full rounded-md bg-base-200 active:bg-base-300/20 px-3 py-1.5 text-base secondary-text outline-1 -outline-offset-1 outline-indigo-400/40 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6"/>
                </div>
            </div>
            <div>
                <div class="flex items-center justify-between">
                    <label for="password_conf" class="block text-sm/6 font-medium secondary-text">Password
                        confirmation</label>
                </div>
                <div class="mt-2">
                    <input id="password_conf" type="password" name="password_conf" required
                           autocomplete="current-password"
                           class="input block w-full rounded-md bg-base-200 active:bg-base-300/20 px-3 py-1.5 text-base secondary-text outline-1 -outline-offset-1 outline-indigo-400/40 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6"/>
                </div>
            </div>

            <div>
                <button type="submit"
                        class="btn text-white flex w-full justify-center rounded-md bg-indigo-500 px-3 py-1.5 text-sm/6 font-semibold hover:bg-indigo-400 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">
                    Sign up
                </button>
            </div>
        </form>
        <p class="text-sm">If you already has account you can log in <a class="inline-link" href="/login">here</a></p>
    </div>
</div>

