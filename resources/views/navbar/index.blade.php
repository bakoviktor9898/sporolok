<header class="w-full flex flex-col fixed z-50">
    <div class="w-full bg-white ring-1 ring-gray-50 flex flex-row items-center justify-between px-4">    
        <a href="{{ route('index') }}"
            class=" items-center font-semibold text-indigo-800 hover:text-indigo-900 rounded-sm my-2">
            <h3 class="py-2 text-xl font-black text-center tracking-wider px-2">
                Spórolok
            </h3>
        </a>
        @if(!Auth::check())
        <div class="flex flex-row space-x-2 items-center">
            <a
                href="{{ route('login') }}"
                class="hover:bg-indigo-100 my-auto px-2 h-10 items-center rounded-sm flex flex-row space-x-2">
                <span class="text-indigo-600 font-light hidden md:block pr-1">
                    Bejelentkezés
                </span>
                <!-- Login Icon -->
                <x-icons.login-icon></x-icons.login-icon>
                <!-- End of login Icon -->
            </a>
        </div>
        @else
        <div
            class="flex flex-row space-x-2 items-center">
            <a href="{{ route('shoppingList.index') }}" class="px-3 flex flex-row items-center hover:bg-indigo-100 py-2 rounded-sm">
                <span class="text-indigo-600 font-light hidden md:block">
                    Kedvencek
                </span>
                <x-icons.list-icon></x-icons.list-icon>
            </a>
        <a
            href="{{ route('profile.show', auth()->user()) }}"
            class="hover:bg-indigo-100 my-auto space-x-2 px-2 h-10 items-center rounded-sm flex flex-row justify-center self-end">
            <span class="text-indigo-600 font-light hidden md:block">
                Profilom
            </span>
            <x-icons.profile-icon></x-icons.profile-icon>
        </a>
        <form
            method="POST"
            action="{{ route('logout') }}"
            class="hover:bg-indigo-100 my-auto space-x-2 px-2 h-10 items-center rounded-sm flex flex-row justify-center">
            @csrf
            <button type="submit" class="flex flex-row space-x-2 items-center justify-center">
                <span class="text-indigo-600 font-light hidden md:block h-full">
                    Kijelentkezés
                </span>
                <!-- Logout Icon -->
                <x-icons.logout-icon></x-icons.logout-icon>
            </button>
            <!-- End of Logout Icon -->
        </form>
        </div>
        @endif
    </div>

    @if(optional(auth()->user())->isAdmin() && str_contains(url()->current(), 'admin'))
    <x-navbar.admin></x-navbar.admin>
    @endif

</header>