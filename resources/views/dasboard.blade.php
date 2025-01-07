<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Dashboard')</title>
    <link href="https://assets.codepen.io/344846/style.css" rel="stylesheet">
    <link rel="stylesheet" href="./style.css">

</head>

<body>
    <!-- partial:index.partial.html -->
    <div class="bg-gray-100 dark:bg-gray-900 dark:text-white text-gray-600 h-screen flex overflow-hidden text-sm">
        <div
            class="bg-white dark:bg-gray-900 dark:border-gray-800 w-20 flex-shrink-0 border-r border-gray-200 flex-col hidden sm:flex">
            <div class="h-16 text-blue-500 flex items-center justify-center">
                <img src="log.png" alt="E-KSHETRA Logo" class="w-12 h-12 rounded-full">
            </div>
            <div class="flex mx-auto flex-grow mt-4 flex-col text-gray-400 space-y-4">
                <a href="/dashboard" class="{{ request()->is('dashboard')
    ? 'h-10 w-12 dark:bg-gray-700 dark:text-white rounded-md flex items-center justify-center text-blue-500'
    : 'h-10 w-12 dark:text-gray-500 rounded-md flex items-center justify-center' }}">
                    <svg viewBox="0 0 24 24" class="h-5" stroke="currentColor" stroke-width="2" fill="none"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                        <polyline points="9 22 9 12 15 12 15 22"></polyline>
                    </svg>
                </a>
                <a href={{url('/add')}} class="{{ request()->is('add')
    ? 'h-10 w-12 dark:bg-gray-700 dark:text-white rounded-md flex items-center justify-center text-blue-500'
    : 'h-10 w-12 dark:text-gray-500 rounded-md flex items-center justify-center' }}">
                    <svg viewBox="0 0 24 24" class="h-5" stroke="currentColor" stroke-width="2" fill="none"
                        stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="12" y1="8" x2="12" y2="16"></line>
                        <line x1="8" y1="12" x2="16" y2="12"></line>
                    </svg>
                </a>
                <a href="{{url('/admincreate')}}" class="{{ request()->is('admincreate')
    ? 'h-10 w-12 dark:bg-gray-700 dark:text-white rounded-md flex items-center justify-center text-blue-500'
    : 'h-10 w-12 dark:text-gray-500 rounded-md flex items-center justify-center' }}">
                    <svg viewBox="0 0 24 24" class="h-5" stroke="currentColor" stroke-width="2" fill="none"
                        stroke-linecap="round" stroke-linejoin="round">
                        <!-- Shield outline -->
                        <path d="M12 2L20 6V12C20 16.4183 16.4183 20 12 22C7.58172 20 4 16.4183 4 12V6L12 2Z"></path>
                        <!-- Checkmark -->
                        <path d="M9 12L11 14L15 10"></path>
                    </svg>
                </a>

                <a href={{url('/logout')}}
                    class="h-10 w-12 dark:text-gray-500 rounded-md flex items-center justify-center hover:dark:bg-gray-700 hover:dark:text-white hover:text-blue-500">
                    <svg viewBox="0 0 24 24" class="h-5" stroke="currentColor" stroke-width="2" fill="none"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="M9 16l-4-4 4-4" />
                        <path d="M5 12h14" />
                        <rect x="16" y="3" width="5" height="18" rx="1" />
                    </svg>
                </a>



            </div>
        </div>
        <div class="flex-grow overflow-hidden h-full flex flex-col">
            <div class="flex-grow flex overflow-x-hidden">
                <div
                    class="xl:w-72 w-48 flex-shrink-0 border-r border-gray-200 dark:border-gray-800 h-full overflow-y-auto lg:block hidden p-5">
                    <div class="text-xs text-gray-400 tracking-wider">USERS</div>

                    <div class="space-y-4 mt-3">
                        @foreach($admin as $user)
                            <button class="bg-white p-3 w-full flex flex-col rounded-md dark:bg-gray-800 shadow">
                                <div
                                    class="flex xl:flex-row flex-col items-center font-medium text-gray-900 dark:text-white pb-2 mb-2 xl:border-b border-gray-200 border-opacity-75 dark:border-gray-700 w-full">
                                    <img src="https://img.freepik.com/free-photo/3d-rendered-illustration-businessman-with-laptop-books_1057-45897.jpg?t=st=1736235929~exp=1736239529~hmac=4da6f4f6e2a583b59b8f6f888e0b3e60ad1babb838c01d1c6cd8f4c2da025997&w=1060"
                                        class="w-7 h-7 mr-2 rounded-full" alt="profile" />
                                    {{ $user->username }} <!-- Display the username -->
                                </div>
                                <div class="flex items-center w-full">
                                    <div
                                        class="text-xs py-1 px-2 leading-none dark:bg-gray-900 bg-blue-100 text-blue-500 rounded-md">
                                        {{ $user->role }} <!-- Display the role -->
                                    </div>
                                </div>
                            </button>
                        @endforeach
                    </div>

                </div>
                <div class="flex-grow bg-white dark:bg-gray-900 overflow-y-auto">
                    <div
                        class="sm:px-7 sm:pt-7 px-4 pt-4 flex flex-col w-full border-b border-gray-200 bg-white dark:bg-gray-900 dark:text-white dark:border-gray-800 sticky top-0">
                        <div class="flex w-full items-center">
                            <div class="flex items-center text-3xl text-gray-900 dark:text-white">
                                <img src="https://assets.codepen.io/344846/internal/avatars/users/default.png?fit=crop&format=auto&height=512&version=1582611188&width=512"
                                    class="w-12 mr-4 rounded-full" alt="profile" />
                                {{session('username')}}
                            </div>
                        </div>
                        <div class="flex items-center space-x-3 sm:mt-7 mt-4">
                            @if (!request()->is('add'))
                                <a href="{{ url('/dashboard') }}"
                                    class="{{ request()->is('dashboard', 'bgmi_duo', 'bgmi_solo') ? 'px-3 border-b-2 border-blue-500 text-blue-500 dark:text-white dark:border-white pb-1.5' : 'px-3 border-b-2 border-transparent text-gray-600 dark:text-gray-400 pb-1.5' }}">
                                    BGMI
                                </a>
                                <a href="{{ url('/freefire_team') }}"
                                    class="{{ request()->is('freefire_team', 'freefire_duo', 'freefire_solo') ? 'px-3 border-b-2 border-blue-500 text-blue-500 dark:text-white dark:border-white pb-1.5' : 'px-3 border-b-2 border-transparent text-gray-600 dark:text-gray-400 pb-1.5' }}">
                                    FREE FIRE
                                </a>
                                <a href="{{ url('/fcmobile') }}"
                                    class="{{ request()->is('fcmobile') ? 'px-3 border-b-2 border-blue-500 text-blue-500 dark:text-white dark:border-white pb-1.5' : 'px-3 border-b-2 border-transparent text-gray-600 dark:text-gray-400 pb-1.5' }}">
                                    FC MOBILE
                                </a>
                            @endif
                        </div>
                    </div>
                    <div class="sm:p-7 p-4">
                        @yield('section')
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>