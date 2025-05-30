<footer
    class="w-full min-h-20 py-4 bg-gradient-to-l dark:from-[#0a0a0a] dark:to-[#1f1f1f] border-t-2 dark:border-green-500/50 border-green-600/70 flex items-center justify-between px-10">
    <a href="{{ route('index') }}">
        <img src="/img/logo.svg" alt="Logo" class="w-[200px] dark:block hidden">
        <img src="/img/logo-forLight-2.svg" alt="Logo" class="w-[200px] dark:hidden block">
    </a>
    <div class="max-[425px]:hidden">
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
    </div>
</footer>
