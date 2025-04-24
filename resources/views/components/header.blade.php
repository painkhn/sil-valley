<header
    class="w-full border-b-2 dark:border-green-400/20 border-green-600/40 bg-gradient-to-t from-white to-[#eaeaea] dark:from-[#111111] dark:to-[#0a0a0a]">
    <div
        class="min-h-28 grid grid-cols-2 max-[1370px]:grid-cols-1 max-[1370px]:py-5 max-[1370px]:space-y-4 items-center px-10">
        <div class="justify-self-start flex items-center gap-8">
            <!-- дравер -->
            <button data-drawer-target="drawer-example" data-drawer-show="drawer-example" aria-controls="drawer-example"
                class="min-[1000px]:hidden">
                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                    <path
                        d="M10.83 5a3.001 3.001 0 0 0-5.66 0H4a1 1 0 1 0 0 2h1.17a3.001 3.001 0 0 0 5.66 0H20a1 1 0 1 0 0-2h-9.17ZM4 11h9.17a3.001 3.001 0 0 1 5.66 0H20a1 1 0 1 1 0 2h-1.17a3.001 3.001 0 0 1-5.66 0H4a1 1 0 1 1 0-2Zm1.17 6H4a1 1 0 1 0 0 2h1.17a3.001 3.001 0 0 0 5.66 0H20a1 1 0 1 0 0-2h-9.17a3.001 3.001 0 0 0-5.66 0Z" />
                </svg>
            </button>
            <!-- drawer component -->
            <div id="drawer-example"
                class="fixed top-0 left-0 z-40 h-screen p-4 overflow-y-auto transition-transform -translate-x-full bg-white w-80 dark:bg-[#111111] border-r dark:border-white"
                tabindex="-1" aria-labelledby="drawer-label">
                <h5 id="drawer-label"
                    class="inline-flex items-center mb-4 text-base font-semibold text-gray-500 dark:text-gray-400"><svg
                        class="w-4 h-4 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        viewBox="0 0 20 20">
                        <path
                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                    </svg>Info</h5>
                <button type="button" data-drawer-hide="drawer-example" aria-controls="drawer-example"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 absolute top-2.5 end-2.5 flex items-center justify-center dark:hover:bg-gray-600 dark:hover:text-white">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close menu</span>
                </button>

                <ul>
                    <li>
                        <a href={{ route('shop.index') }}>
                            <button
                                class="px-4 py-2 transition-all hover:border-b border-green-600 dark:border-green-500 hover:dark:text-green-500 hover:text-green-600 text-black dark:text-white font-semibold">
                                Магазин
                            </button>
                        </a>
                    </li>
                    @auth
                        @if (auth()->user()->role === 'admin')
                            <div class="p-4 border dark:border-white/50 rounded-md my-4">
                                <h2 class="text-black dark:text-white">Панель администратора</h2>
                                <li>
                                    <a href="{{ route('admin.products') }}"
                                        class="flex items-center gap-1 py-2 text-black dark:text-white">
                                        <svg class="w-6 h-6 text-gray-800 dark:text-white"
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                            viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M12 15v5m-3 0h6M4 11h16M5 15h14a1 1 0 0 0 1-1V5a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1v9a1 1 0 0 0 1 1Z" />
                                        </svg>
                                        Товар
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.orders') }}"
                                        class="flex items-center gap-1 py-2 text-black dark:text-white">
                                        <svg class="w-6 h-6 text-gray-800 dark:text-white"
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                            viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M12 6h8m-8 6h8m-8 6h8M4 16a2 2 0 1 1 3.321 1.5L4 20h5M4 5l2-1v6m-2 0h4" />
                                        </svg>
                                        Заказы
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.orders') }}"
                                        class="flex items-center gap-1 py-2 text-black dark:text-white">
                                        <svg class="w-6 h-6 text-gray-800 dark:text-white"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M4 6h16M4 10h16M4 14h10M4 18h6" />
                                        </svg>
                                        Отчет
                                    </a>
                                </li>
                            </div>
                        @endif
                    @endauth
                    <li>
                        <a href="{{ route('profile.orders') }}"
                            class="flex items-center gap-1 pr-4 py-2 text-black dark:text-white">
                            <svg class="w-6 h-5 text-gray-800 dark:text-white" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                viewBox="0 0 24 24">
                                <path
                                    d="M12.013 6.175 7.006 9.369l5.007 3.194-5.007 3.193L2 12.545l5.006-3.193L2 6.175l5.006-3.194 5.007 3.194ZM6.981 17.806l5.006-3.193 5.006 3.193L11.987 21l-5.006-3.194Z" />
                                <path
                                    d="m12.013 12.545 5.006-3.194-5.006-3.176 4.98-3.194L22 6.175l-5.007 3.194L22 12.562l-5.007 3.194-4.98-3.211Z" />
                            </svg>
                            Заказы
                        </a>
                    </li>
                    <li>
                        <a href={{ route('profile.index') }}
                            class="flex items-center gap-1 pr-4 py-2 text-black dark:text-white">
                            <svg class="w-6 h-5 text-gray-800 dark:text-white" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M21 13v-2a1 1 0 0 0-1-1h-.757l-.707-1.707.535-.536a1 1 0 0 0 0-1.414l-1.414-1.414a1 1 0 0 0-1.414 0l-.536.535L14 4.757V4a1 1 0 0 0-1-1h-2a1 1 0 0 0-1 1v.757l-1.707.707-.536-.535a1 1 0 0 0-1.414 0L4.929 6.343a1 1 0 0 0 0 1.414l.536.536L4.757 10H4a1 1 0 0 0-1 1v2a1 1 0 0 0 1 1h.757l.707 1.707-.535.536a1 1 0 0 0 0 1.414l1.414 1.414a1 1 0 0 0 1.414 0l.536-.535 1.707.707V20a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1v-.757l1.707-.708.536.536a1 1 0 0 0 1.414 0l1.414-1.414a1 1 0 0 0 0-1.414l-.535-.536.707-1.707H20a1 1 0 0 0 1-1Z" />
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                            </svg>
                            Настройки
                        </a>
                    </li>
                    <li class="mb-4">
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                            class="flex items-center gap-1 pr-4 py-2 text-black dark:text-white">
                            <svg class="w-6 h-5 text-gray-800 dark:text-white" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M20 12H8m12 0-4 4m4-4-4-4M9 4H7a3 3 0 0 0-3 3v10a3 3 0 0 0 3 3h2" />
                            </svg>
                            Выход
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                    <div class="flex justify-between">
                        <li>
                            <button
                                onclick="
                                    const html = document.documentElement;
                                    const isDark = html.classList.toggle('dark');
                                    localStorage.theme = isDark ? 'dark' : 'light';
                                    document.getElementById('theme-icon').setAttribute('data-theme', isDark ? 'dark' : 'light');
                                "
                                class="flex items-center justify-center px-4 py-2 transition-all hover:border-b border-green-600 dark:border-green-500 hover:dark:text-green-500 font-semibold"
                                aria-label="Сменить тему">
                                <svg id="theme-icon" data-theme="light"
                                    class="w-6 h-6 flex items-center justify-center text-center relative dark:text-white text-black"
                                    fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <!-- Солнце -->
                                    <g data-theme="light">
                                        <circle cx="12" cy="12" r="5"></circle>
                                        <path
                                            d="M12 1v2M12 21v2M4.22 4.22l1.42 1.42M18.36 18.36l1.42 1.42M1 12h2M21 12h2M4.22 19.78l1.42-1.42M18.36 5.64l1.42-1.42" />
                                    </g>
                                    <!-- Луна -->
                                    <g data-theme="dark" style="display: none;">
                                        <path d="M21 12.79A9 9 0 1111.21 3a7 7 0 009.79 9.79z" />
                                    </g>
                                </svg>
                            </button>
                        </li>
                        @auth
                            <li>
                                <a href={{ route('favorites.show') }}>
                                    <button
                                        class="px-4 py-2 transition-all hover:border-b border-green-600 dark:border-green-500 hover:dark:text-green-500 font-semibold">
                                        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            fill="currentColor" viewBox="0 0 24 24">
                                            <path
                                                d="m12.75 20.66 6.184-7.098c2.677-2.884 2.559-6.506.754-8.705-.898-1.095-2.206-1.816-3.72-1.855-1.293-.034-2.652.43-3.963 1.442-1.315-1.012-2.678-1.476-3.973-1.442-1.515.04-2.825.76-3.724 1.855-1.806 2.201-1.915 5.823.772 8.706l6.183 7.097c.19.216.46.34.743.34a.985.985 0 0 0 .743-.34Z" />
                                        </svg>
                                    </button>
                                </a>
                            </li>
                            <li>
                                <a href={{ route('cart.show') }}>
                                    <button
                                        class="px-4 py-2 transition-all hover:border-b border-green-600 dark:border-green-500 hover:dark:text-green-500 font-semibold">
                                        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            fill="currentColor" viewBox="0 0 24 24">
                                            <path fill-rule="evenodd"
                                                d="M4 4a1 1 0 0 1 1-1h1.5a1 1 0 0 1 .979.796L7.939 6H19a1 1 0 0 1 .979 1.204l-1.25 6a1 1 0 0 1-.979.796H9.605l.208 1H17a3 3 0 1 1-2.83 2h-2.34a3 3 0 1 1-4.009-1.76L5.686 5H5a1 1 0 0 1-1-1Z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </a>
                            </li>
                            <li>
                                <a href={{ route('comparisons.show') }}>
                                    <button
                                        class="px-4 py-2 transition-all hover:border-b border-green-600 dark:border-green-500 hover:dark:text-green-500 font-semibold">
                                        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M4 4v15a1 1 0 0 0 1 1h15M8 16l2.5-5.5 3 3L17.273 7 20 9.667" />
                                        </svg>
                                    </button>
                                </a>
                            </li>
                        @else
                            {{ null }}
                        @endauth
                    </div>
                    <li class="mt-4">
                        <!-- поисковая строка (для поиска нажать enter) -->
                        <form class="space-y-6 max-w-[400px] w-full" method="GET" action={{ route('shop.index') }}>
                            <input type="text" name="title" value="{{ request('title') }}"
                                class="w-full focus:ring-green-700 transition-all h-[52px] max-w-[400px] text-black dark:text-white dark:bg-white/5 border-0 outline-none dark:focus:ring-0 focus:ring-2 dark:ring-0 ring-2 ring-green-600 focus:bg-white/10 rounded-xl px-4 pr-12"
                                placeholder="Поиск...">
                        </form>
                    </li>
                </ul>

                <!-- <div class="grid grid-cols-2 gap-4">
                    <a href="#" class="px-4 py-2 text-sm font-medium text-center text-gray-900 bg-white border border-gray-200 rounded-lg focus:outline-none hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Learn more</a>
                    <a href="#" class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Get access <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                        </svg>
                    </a>
                </div> -->
            </div>
            <!-- логотип -->
            <a href={{ route('index') }} class="transition-all hover:opacity-80">
                <img src="/img/logo.svg" alt="" class="w-[250px] hidden dark:block">
                <img src="/img/logo-forLight-2.svg" alt="" class="w-[250px] dark:hidden">
            </a>
            <span class="h-[52px] w-1 border-r dark:border-white border-black max-[1000px]:hidden"></span>
            <!-- поисковая строка -->
            <div class="relative w-[400px] flex items-center max-[1000px]:hidden">
                <!-- кнопка для отображения поисковой строки -->
                <button onclick="openSearchInput()"
                    class="p-3 rounded-full hover:dark:bg-white/10 transition-all absolute left-0 top-1/2 -translate-y-1/2 searchBtn">
                    <svg class="w-7 h-7 text-gray-800 dark:text-white" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                        viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                            d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z" />
                    </svg>
                </button>
                <!-- поисковая строка (для поиска нажать enter) -->
                <form class="space-y-6 max-w-[400px] w-full" method="GET" action={{ route('shop.index') }}>
                    <input type="text" name="title" value="{{ request('title') }}"
                        class="w-full focus:ring-green-700 opacity-0 pointer-events-none searchInput transition-all h-[52px] max-w-[400px] text-black dark:text-white dark:bg-white/5 border-0 outline-none dark:focus:ring-0 focus:ring-2 dark:ring-0 ring-2 ring-green-600 focus:bg-white/10 rounded-xl px-4 pr-12"
                        placeholder="Поиск...">
                </form>
                <!-- кнопка для закрытия посиковой строки -->
                <button onclick="closeSearchInput()"
                    class="absolute right-4 top-1/2 -translate-y-1/2 searchCloseBtn opacity-0 pointer-events-none">
                    <svg class="w-6 h-6 text-green-600 dark:text-green-500" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                        viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m15 9-6 6m0-6 6 6m6-3a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                </button>
            </div>
        </div>
        <!-- навигация -->
        <nav class="justify-self-end max-[1370px]:justify-self-start max-[1000px]:hidden">
            <ul class="flex items-center flex-wrap gap-2">
                @auth
                    @if (auth()->user()->role === 'admin')
                        <li>
                            <button id="adminDropdownDefaultButton" data-dropdown-toggle="adminDropdown"
                                class="px-4 py-2 transition-all hover:border-b border-green-600 dark:border-green-500 hover:dark:text-green-500 hover:text-green-600 text-black dark:text-white font-semibold">
                                Панель администратора
                            </button>
                            <div id="adminDropdown"
                                class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow-sm w-44 dark:bg-gradient-to-l dark:from-[#111111] dark:to-[#0a0a0a] border-2 border-dashed border-white/50">
                                <ul class="py-2 text-sm text-gray-700 dark:text-white/80 space-y-2"
                                    aria-labelledby="dropdownDefaultButton">
                                    <li>
                                        <a href="{{ route('admin.products') }}"
                                            class="flex items-center gap-1 px-4 py-2 hover:bg-gray-100 dark:hover:bg-white/10 dark:hover:text-white">
                                            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                fill="none" viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2"
                                                    d="M12 15v5m-3 0h6M4 11h16M5 15h14a1 1 0 0 0 1-1V5a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1v9a1 1 0 0 0 1 1Z" />
                                            </svg>
                                            Товар
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('admin.orders') }}"
                                            class="flex items-center gap-1 px-4 py-2 hover:bg-gray-100 dark:hover:bg-white/10 dark:hover:text-white">
                                            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                fill="none" viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2"
                                                    d="M12 6h8m-8 6h8m-8 6h8M4 16a2 2 0 1 1 3.321 1.5L4 20h5M4 5l2-1v6m-2 0h4" />
                                            </svg>
                                            Заказы
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('admin.orders') }}"
                                            class="flex items-center gap-1 px-4 py-2 hover:bg-gray-100 dark:hover:bg-white/10 dark:hover:text-white">
                                            <svg class="w-6 h-6 text-gray-800 dark:text-white"
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M4 6h16M4 10h16M4 14h10M4 18h6" />
                                            </svg>
                                            Отчет
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    @endif
                @endauth
                <li>
                    <a href={{ route('shop.index') }}>
                        <button
                            class="px-4 py-2 transition-all hover:border-b border-green-600 dark:border-green-500 hover:dark:text-green-500 hover:text-green-600 text-black dark:text-white font-semibold">
                            Магазин
                        </button>
                    </a>
                </li>
                <li>
                    <button
                        onclick="
                            const html = document.documentElement;
                            const isDark = html.classList.toggle('dark');
                            localStorage.theme = isDark ? 'dark' : 'light';
                            document.getElementById('theme-icon').setAttribute('data-theme', isDark ? 'dark' : 'light');
                        "
                        class="flex items-center justify-center px-4 py-2 transition-all hover:border-b border-green-600 dark:border-green-500 hover:dark:text-green-500 font-semibold"
                        aria-label="Сменить тему">
                        <svg id="theme-icon" data-theme="light"
                            class="w-6 h-6 flex items-center justify-center text-center relative dark:text-white text-black"
                            fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <!-- Солнце -->
                            <g data-theme="light">
                                <circle cx="12" cy="12" r="5"></circle>
                                <path
                                    d="M12 1v2M12 21v2M4.22 4.22l1.42 1.42M18.36 18.36l1.42 1.42M1 12h2M21 12h2M4.22 19.78l1.42-1.42M18.36 5.64l1.42-1.42" />
                            </g>
                            <!-- Луна -->
                            <g data-theme="dark" style="display: none;">
                                <path d="M21 12.79A9 9 0 1111.21 3a7 7 0 009.79 9.79z" />
                            </g>
                        </svg>
                    </button>
                </li>
                @auth
                    <li>
                        <a href={{ route('favorites.show') }}>
                            <button
                                class="px-4 py-2 transition-all hover:border-b border-green-600 dark:border-green-500 hover:dark:text-green-500 font-semibold">
                                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="m12.75 20.66 6.184-7.098c2.677-2.884 2.559-6.506.754-8.705-.898-1.095-2.206-1.816-3.72-1.855-1.293-.034-2.652.43-3.963 1.442-1.315-1.012-2.678-1.476-3.973-1.442-1.515.04-2.825.76-3.724 1.855-1.806 2.201-1.915 5.823.772 8.706l6.183 7.097c.19.216.46.34.743.34a.985.985 0 0 0 .743-.34Z" />
                                </svg>
                            </button>
                        </a>
                    </li>
                    <li>
                        <a href={{ route('cart.show') }}>
                            <button
                                class="px-4 py-2 transition-all hover:border-b border-green-600 dark:border-green-500 hover:dark:text-green-500 font-semibold">
                                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                    viewBox="0 0 24 24">
                                    <path fill-rule="evenodd"
                                        d="M4 4a1 1 0 0 1 1-1h1.5a1 1 0 0 1 .979.796L7.939 6H19a1 1 0 0 1 .979 1.204l-1.25 6a1 1 0 0 1-.979.796H9.605l.208 1H17a3 3 0 1 1-2.83 2h-2.34a3 3 0 1 1-4.009-1.76L5.686 5H5a1 1 0 0 1-1-1Z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>
                        </a>
                    </li>
                    <li>
                        <a href={{ route('comparisons.show') }}>
                            <button
                                class="px-4 py-2 transition-all hover:border-b border-green-600 dark:border-green-500 hover:dark:text-green-500 font-semibold">
                                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                    viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M4 4v15a1 1 0 0 0 1 1h15M8 16l2.5-5.5 3 3L17.273 7 20 9.667" />
                                </svg>
                            </button>
                        </a>
                    </li>
                @else
                    {{ null }}
                @endauth
                <li>
                    @auth
                        <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown"
                            class="px-4 py-2 capitalize transition-all hover:border-b border-green-600 dark:border-green-500 hover:dark:text-green-500 font-semibold block">
                            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                viewBox="0 0 24 24">
                                <path fill-rule="evenodd"
                                    d="M12 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4h-4Z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                        <div id="dropdown"
                            class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow-sm w-44 dark:bg-gradient-to-l dark:from-[#111111] dark:to-[#0a0a0a] border-2 border-dashed border-white/50">
                            <ul class="py-2 text-sm text-gray-700 dark:text-white/80 space-y-2"
                                aria-labelledby="dropdownDefaultButton">
                                <li>
                                    <a href="{{ route('profile.orders') }}"
                                        class="flex items-center gap-1 px-4 py-2 hover:bg-gray-100 dark:hover:bg-white/10 dark:hover:text-white">
                                        <svg class="w-6 h-5 text-gray-800 dark:text-white" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            fill="currentColor" viewBox="0 0 24 24">
                                            <path
                                                d="M12.013 6.175 7.006 9.369l5.007 3.194-5.007 3.193L2 12.545l5.006-3.193L2 6.175l5.006-3.194 5.007 3.194ZM6.981 17.806l5.006-3.193 5.006 3.193L11.987 21l-5.006-3.194Z" />
                                            <path
                                                d="m12.013 12.545 5.006-3.194-5.006-3.176 4.98-3.194L22 6.175l-5.007 3.194L22 12.562l-5.007 3.194-4.98-3.211Z" />
                                        </svg>
                                        Заказы
                                    </a>
                                </li>
                                <li>
                                    <a href={{ route('profile.index') }}
                                        class="flex items-center gap-1 px-4 py-2 hover:bg-gray-100 dark:hover:bg-white/10 dark:hover:text-white">
                                        <svg class="w-6 h-5 text-gray-800 dark:text-white" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M21 13v-2a1 1 0 0 0-1-1h-.757l-.707-1.707.535-.536a1 1 0 0 0 0-1.414l-1.414-1.414a1 1 0 0 0-1.414 0l-.536.535L14 4.757V4a1 1 0 0 0-1-1h-2a1 1 0 0 0-1 1v.757l-1.707.707-.536-.535a1 1 0 0 0-1.414 0L4.929 6.343a1 1 0 0 0 0 1.414l.536.536L4.757 10H4a1 1 0 0 0-1 1v2a1 1 0 0 0 1 1h.757l.707 1.707-.535.536a1 1 0 0 0 0 1.414l1.414 1.414a1 1 0 0 0 1.414 0l.536-.535 1.707.707V20a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1v-.757l1.707-.708.536.536a1 1 0 0 0 1.414 0l1.414-1.414a1 1 0 0 0 0-1.414l-.535-.536.707-1.707H20a1 1 0 0 0 1-1Z" />
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                                        </svg>
                                        Настройки
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                        class="flex items-center gap-1 px-4 py-2 hover:bg-gray-100 dark:hover:bg-white/10 dark:hover:text-white">
                                        <svg class="w-6 h-5 text-gray-800 dark:text-white" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M20 12H8m12 0-4 4m4-4-4-4M9 4H7a3 3 0 0 0-3 3v10a3 3 0 0 0 3 3h2" />
                                        </svg>
                                        Выход
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @else
                        <button type="button" data-modal-target="default-modal" data-modal-toggle="default-modal"
                            class="transition-all px-4 py-2 dark:text-black rounded-md hover:opacity-80 font-semibold bg-green-500">
                            Войти
                        </button>
                    @endauth
                </li>
            </ul>
        </nav>
    </div>

    <x-auth.index />
</header>
<script>
    // переменные для строки поиска в шапке
    const searchInput = document.querySelector('.searchInput');
    const searchBtn = document.querySelector('.searchBtn');
    const searchCloseBtn = document.querySelector('.searchCloseBtn');

    // открыть поисковую строку
    const openSearchInput = () => {
        searchInput.classList.add('!opacity-100', '!w-full');
        searchInput.classList.remove('pointer-events-none');
        searchBtn.classList.add('hidden');

        searchCloseBtn.classList.add('!opacity-100');
        searchCloseBtn.classList.remove('pointer-events-none');
    }

    // закрыть поисковую строку
    const closeSearchInput = () => {
        searchInput.classList.remove('!opacity-100', '!w-full');
        searchInput.classList.add('pointer-events-none');
        searchBtn.classList.remove('hidden');

        searchCloseBtn.classList.remove('!opacity-100');
        searchCloseBtn.classList.add('pointer-events-none');
    }
</script>
