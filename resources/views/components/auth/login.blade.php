<!-- форма авторизации -->
<div class="login">
    <div class="w-full text-center py-4">
        <h2 class="text-2xl font-black text-black dark:text-white">Авторизация</h2>
    </div>
    <form class="w-[55%] mx-auto space-y-8" method="POST" action="{{ route('login') }}">
        @csrf

        <div class="space-y-2">
            <label for="" class="font-semibold text-black/80 dark:text-white/80">Электронная почта</label>
            <input type="email" name="email" :value="old('email')" required autofocus autocomplete="username"
                class="transition-all w-full py-2 dark:bg-white/5 bg-black/5 text-black dark:text-white dark:focus:bg-white/10 focus:bg-black/10 border-0 outline-none focus:ring-0 ring-0 rounded-xl px-4">
        </div>
        <div class="space-y-2">
            <label for="" class="font-semibold text-black/80 dark:text-white/80">Пароль</label>
            <input type="password" name="password" required autocomplete="current-password"
                class="transition-all w-full py-2 dark:bg-white/5 bg-black/5 text-black dark:text-white dark:focus:bg-white/10 focus:bg-black/10 border-0 outline-none focus:ring-0 ring-0 rounded-xl px-4">
        </div>
        <button type="submit"
            class="w-full py-4 font-semibold bg-green-500 transition-all hover:dark:bg-green-400 rounded-xl dark:text-black">
            Войти
        </button>
        <div class="text-center">
            <button type="button" onclick="getRegister()" class="font-semibold transition-all hover:text-green-500 text-black dark:text-white">
                Регистрация
            </button>
        </div>
        <div class="relative w-full text-center">
            <div class="w-full border-b border-black dark:border-white absolute top-1/2 -translate-y-1/2 z-10"></div>
            <span class="dark:bg-[#1a1a1a] bg-white z-20 text-black dark:text-white relative px-4">или</span>
        </div>
        <div class="mx-auto flex justify-center">
            <a href="{{ route('login.github') }}"
                class="font-semibold transition-all hover:text-green-500 flex items-center justify-center gap-2 hover:gap-1 text-white bg-black dark:bg-transparent px-4 py-2 rounded-md">
                <img src="/img/icons/github-logo.svg" alt="" class="w-8">
                GitHub
            </a>
        </div>
    </form>
</div>
