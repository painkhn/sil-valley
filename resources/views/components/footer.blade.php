<footer
    class="w-full min-h-20 py-4 bg-gradient-to-l dark:from-[#0a0a0a] dark:to-[#1f1f1f] border-t-2 dark:border-green-500/50 flex items-center justify-between px-10">
    <a href="#!">
        <img src="{{ route('index') }}" alt="Logo" class="w-[200px]">
    </a>
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
</footer>
