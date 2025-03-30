<header class="w-full border-b-2 dark:border-green-400/20 dark:bg-gradient-to-t dark:from-[#111111] dark:to-[#0a0a0a]">
    <div class="min-h-28 grid grid-cols-2 items-center px-10">
        <div class="justify-self-start flex items-center gap-8">
            <!-- лого -->
            <a href="#!" class="transition-all hover:opacity-80">
                <img src="/img/logo.svg" alt="" class="w-[250px]">
            </a>
            <span class="h-[52px] w-1 border-r border-white"></span>
            <!-- поисковая строка -->
            <div class="relative w-[400px] flex items-center">
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
                <input type="text"
                    class="opacity-0 pointer-events-none searchInput transition-all h-[52px] max-w-[400px] w-[52px] bg-white/5 border-0 outline-none focus:ring-0 ring-0 focus:bg-white/10 rounded-xl px-4 pr-12"
                    placeholder="Поиск...">
                <!-- кнопка для закрытия посиковой строки -->
                <button onclick="closeSearchInput()"
                    class="absolute right-4 top-1/2 -translate-y-1/2 searchCloseBtn opacity-0 pointer-events-none">
                    <svg class="w-6 h-6 text-gray-800 dark:text-green-500" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                        viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m15 9-6 6m0-6 6 6m6-3a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                </button>
            </div>
        </div>
        <nav class="justify-self-end">
            <ul class="flex items-center gap-5">
                <li>
                    <a href="#!">
                        <button
                            class="px-4 py-2 transition-all dark:hover:border-b border-green-500 hover:dark:text-green-500 font-semibold">
                            Магазин
                        </button>
                    </a>
                </li>
                <li>
                    <a href="#!">
                        <button
                            class="px-4 py-2 transition-all dark:hover:border-b border-green-500 hover:dark:text-green-500 font-semibold">
                            О нас
                        </button>
                    </a>
                </li>
                <li>
                    <a href="#!">
                        <button
                            class="px-4 py-2 transition-all dark:hover:border-b border-green-500 hover:dark:text-green-500 font-semibold">
                            FaQ
                        </button>
                    </a>
                </li>
                <li>
                    @auth
                        <a href="{{ route('profile.index') }}"
                            class="transition-all px-4 py-2 dark:text-black rounded-md hover:opacity-80 font-semibold bg-green-500">
                            Профиль
                        </a>
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
