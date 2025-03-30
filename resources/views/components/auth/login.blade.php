<!-- форма авторизации -->
<div class="login">
    <div class="w-full text-center py-4">
        <h2 class="text-2xl font-black">Авторизация</h2>
    </div>
    <form class="w-[55%] mx-auto space-y-8" method="POST" action="{{ route('login') }}">
        @csrf

        <div class="space-y-2">
            <label for="" class="font-semibold dark:text-white/80">Электронная почта</label>
            <input type="email" name="email" :value="old('email')" required autofocus autocomplete="username"
                class="transition-all w-full py-4 bg-white/5 border-0 outline-none focus:ring-0 ring-0 focus:bg-white/10 rounded-xl px-4 pr-12">
        </div>
        <div class="space-y-2">
            <label for="" class="font-semibold dark:text-white/80">Пароль</label>
            <input type="password" name="password" required autocomplete="current-password"
                class="transition-all w-full py-4 bg-white/5 border-0 outline-none focus:ring-0 ring-0 focus:bg-white/10 rounded-xl px-4 pr-12">
        </div>
        <button type="submit"
            class="w-full py-4 font-semibold bg-green-500 transition-all hover:dark:bg-green-400 rounded-xl dark:text-black">
            Войти
        </button>
        <div class="text-center">
            <button type="button" onclick="getRegister()" class="font-semibold transition-all hover:text-green-500">
                Регистрация
            </button>
        </div>
        <div class="relative w-full text-center">
            <div class="w-full border-b border-white absolute top-1/2 -translate-y-1/2 z-10"></div>
            <span class="bg-[#1a1a1a] z-20 relative px-4">или</span>
        </div>
        <div class="mx-auto flex justify-center">
            <button
                class="font-semibold transition-all hover:text-green-500 flex items-center justify-center gap-2 hover:gap-1">
                <img src="/img/icons/vk-logo.svg" alt="" class="w-8">
                Вход по VK ID
            </button>
        </div>
    </form>
</div>
