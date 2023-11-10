<div x-cloak :class="sidebarOpen ? 'block' : 'hidden'" @click="sidebarOpen = false"
    class="fixed inset-0 z-20 transition-opacity bg-black opacity-50 lg:hidden"></div>

<div x-cloak :class="sidebarOpen ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'"
    class="fixed inset-y-0 left-0 z-30 w-64 overflow-y-auto transition duration-300 transform bg-green-600 lg:translate-x-0 lg:static lg:inset-0">
    <div class="flex items-center justify-center mt-8">
        <div class="p-2 max-w-sm w-full">
            <div class="flex justify-center bg-white  rounded p-2">

                <img src="{{ asset('images/logo.jpeg') }}" alt="logo" class="w-20 h-20 rounded-full">
            </div>
        </div>
    </div>

    <!-- Sidebar links -->
    <nav aria-label="Main" class="flex-1 w-64 px-2 py-4 space-y-2 overflow-y-hidden hover:overflow-y-auto">
        <!-- Dashboards links -->
        <div x-data="{ isActive: false, open: false }">
            <!-- active & hover classes 'bg-blue-400' -->
            <a href="{{ route('dashboard') }}"
                class="flex items-center p-2 text-gray-100 transition-colors rounded-md hover:bg-green-600"
                :class="{ 'bg-green-400': isActive || open }" role="button" aria-haspopup="true"
                :aria-expanded="(open || isActive) ? 'true' : 'false'">
                <span aria-hidden="true">
                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011-1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                </span>
                <span class="ml-2 text-sm"> Dashboard </span>
                <span aria-hidden="true" class="ml-auto">
                </span>
            </a>
        </div>


        <!-- Pages links -->
        <div x-data="{ isActive: false, open: false }">
            <!-- active classes 'bg-indigo-100 dark:bg-indigo-600' -->
            <a href="#" @click="$event.preventDefault(); open = !open"
                class="flex items-center p-2 text-gray-100 transition-colors rounded-md hover:bg-green-600"
                :class="{ 'bg-green-600': isActive || open }" role="button" aria-haspopup="true"
                :aria-expanded="(open || isActive) ? 'true' : 'false'">
                <span aria-hidden="true">
                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                    </svg>
                </span>
                <span class="ml-2 text-sm"> Pages </span>
                <span aria-hidden="true" class="ml-auto">
                    <!-- active class 'rotate-180' -->
                    <svg class="w-4 h-4 transition-transform transform" :class="{ 'rotate-180': open }"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </span>
            </a>
            <div x-show="open" class="mt-2 space-y-2 px-7" role="menu" arial-label="Pages">
                <!-- active & hover classes 'text-gray-700 dark:text-light' -->
                <!-- inActive classes 'text-gray-400 dark:text-gray-400' -->
                <x-jet-responsive-nav-link href="{{ route('tickets') }}" :active="request()->routeIs('tickets')"
                    class="flex items-center p-2 text-sm text-white hover:bg-gray-100 hover:text-gray-700 rounded-lg bg-green-600">
                    Tickets
                </x-jet-responsive-nav-link>

                {{-- @if (auth()->user()->isAdmin) --}}
                    <x-jet-responsive-nav-link href="{{ route('departments') }}" role="menuitem" :active="request()->routeIs('departments')"
                        class="flex items-center p-2 text-sm text-gray-100 hover:bg-gray-100 hover:text-gray-700 rounded-lg">
                        Departments
                    </x-jet-responsive-nav-link>
                    <x-jet-responsive-nav-link href="{{ route('categories') }}" role="menuitem" :active="request()->routeIs('categories')"
                        class="flex items-center p-2 text-sm text-gray-100 hover:bg-gray-100 hover:text-gray-700 rounded-lg">
                        Categories
                    </x-jet-responsive-nav-link>
                    <x-jet-responsive-nav-link href="{{ route('plans') }}" role="menuitem" :active="request()->routeIs('plans')"
                        class="flex items-center p-2 text-sm text-gray-100 hover:bg-gray-100 hover:text-gray-700 rounded-lg">
                        Plans
                    </x-jet-responsive-nav-link>
                {{-- @endif --}}
            </div>
        </div>

        <!-- Authentication links -->
        {{-- <div x-data="{ isActive: false, open: false }">
            <!-- active & hover classes 'bg-indigo-100 dark:bg-indigo-600' -->
            <a href="#" @click="$event.preventDefault(); open = !open"
                class="flex items-center p-2 text-gray-100 transition-colors rounded-md hover:bg-blue-800"
                :class="{ 'bg-indigo-100 dark:bg-indigo-600': isActive || open }" role="button" aria-haspopup="true"
                :aria-expanded="(open || isActive) ? 'true' : 'false'">
                <span aria-hidden="true">
                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </span>
                <span class="ml-2 text-sm"> Authentication </span>
                <span aria-hidden="true" class="ml-auto">
                    <!-- active class 'rotate-180' -->
                    <svg class="w-4 h-4 transition-transform transform" :class="{ 'rotate-180': open }"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </span>
            </a>
            <div x-show="open" class="mt-2 space-y-2 px-7" role="menu" aria-label="Authentication">
                <!-- active & hover classes 'text-gray-700 dark:text-light' -->
                <!-- inActive classes 'text-gray-400 dark:text-gray-400' -->
                <a href="#" role="menuitem"
                    class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md dark:hover:text-light hover:text-gray-700">
                    Register
                </a>
                <a href="#" role="menuitem"
                    class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md dark:hover:text-light hover:text-gray-700">
                    Login
                </a>
                <a href="#" role="menuitem"
                    class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md dark:hover:text-light hover:text-gray-700">
                    Password Reset
                </a>
            </div>
        </div>  --}}
    </nav>
    </aside>

    <!-- Sidebars button -->
</div>
