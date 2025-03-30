<!-- форма регистрации -->
<div class="register hidden">
    <div class="w-full text-center py-4">
        <h2 class="text-2xl font-black">Регистрация</h2>
    </div>
    <form class="w-[55%] mx-auto space-y-8">
        <div class="space-y-2">
            <label for="" class="font-semibold dark:text-white/80">Логин</label>
            <input type="text"
                class="transition-all w-full py-4 bg-white/5 border-0 outline-none focus:ring-0 ring-0 focus:bg-white/10 rounded-xl px-4 pr-12">
        </div>
        <div class="space-y-2">
            <label for="" class="font-semibold dark:text-white/80">Электронная
                почта</label>
            <input type="text"
                class="transition-all w-full py-4 bg-white/5 border-0 outline-none focus:ring-0 ring-0 focus:bg-white/10 rounded-xl px-4 pr-12">
        </div>
        <div class="space-y-2">
            <label for="" class="font-semibold dark:text-white/80">Пароль</label>
            <input type="password"
                class="transition-all w-full py-4 bg-white/5 border-0 outline-none focus:ring-0 ring-0 focus:bg-white/10 rounded-xl px-4 pr-12">
        </div>
        <div class="space-y-2">
            <label for="" class="font-semibold dark:text-white/80">Повторите
                пароль</label>
            <input type="password"
                class="transition-all w-full py-4 bg-white/5 border-0 outline-none focus:ring-0 ring-0 focus:bg-white/10 rounded-xl px-4 pr-12">
        </div>
        <button type="submit"
            class="w-full py-4 font-semibold bg-green-500 transition-all hover:dark:bg-green-400 rounded-xl dark:text-black">
            Зарегистрироваться
        </button>
        <div class="text-center goLoginBtn hidden">
            <button type="button" onclick="getLogin()" class="font-semibold transition-all hover:text-green-500">
                У меня уже есть аккаунт
            </button>
        </div>
    </form>
</div>
