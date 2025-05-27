@extends('layouts.app')

@section('content')
    <section class="max-w-[550px] w-full mx-auto text-center space-y-8 pt-10">
        <div>
            <img src="/img/logo.svg" alt="" class="hidden dark:inline w-80">
            <img src="/img/logo-forLight-2.svg" alt="" class="w-80 inline dark:hidden">
        </div>
        <p class="text-xl text-black dark:text-white">Место, где вы можете быстро приобрести лучший ПК для любых задач по самым
            справедливым ценам.</p>
    </section>
    <!-- почему выбирают нас -->
    <section class="max-w-6xl w-full space-y-10 mx-auto">
        <h2 class="text-center text-2xl font-semibold dark:text-white text-black">Почему выбирают нас?</h2>
        <ul class="grid grid-cols-3 max-[768px]:grid-cols-2 max-[500px]:grid-cols-1 gap-10 text-black dark:text-white">
            <li>
                <div class="w-full p-5 min-h-[130px] border-2 border-dashed dark:border-green-400 border-green-600 rounded-md space-y-2">
                    <div class="flex items-center gap-5 justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"
                            fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="lucide lucide-badge-check dark:stroke-green-400 stroke-green-600">
                            <path
                                d="M3.85 8.62a4 4 0 0 1 4.78-4.77 4 4 0 0 1 6.74 0 4 4 0 0 1 4.78 4.78 4 4 0 0 1 0 6.74 4 4 0 0 1-4.77 4.78 4 4 0 0 1-6.75 0 4 4 0 0 1-4.78-4.77 4 4 0 0 1 0-6.76Z" />
                            <path d="m9 12 2 2 4-4" />
                        </svg>
                        <h3 class="text-xl font-semibold">Надёжность</h3>
                    </div>
                    <p class="text-center">Каждый ПК доезжает до адресата вовремя и в лучшем виде!</p>
                </div>
            </li>
            <li>
                <div class="w-full p-5 min-h-[130px] border-2 border-dashed dark:border-green-400 border-green-600 rounded-md space-y-2">
                    <div class="flex items-center gap-5 justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"
                            fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="lucide lucide-badge-dollar-sign dark:stroke-green-400 stroke-green-600">
                            <path
                                d="M3.85 8.62a4 4 0 0 1 4.78-4.77 4 4 0 0 1 6.74 0 4 4 0 0 1 4.78 4.78 4 4 0 0 1 0 6.74 4 4 0 0 1-4.77 4.78 4 4 0 0 1-6.75 0 4 4 0 0 1-4.78-4.77 4 4 0 0 1 0-6.76Z" />
                            <path d="M16 8h-6a2 2 0 1 0 0 4h4a2 2 0 1 1 0 4H8" />
                            <path d="M12 18V6" />
                        </svg>
                        <h3 class="text-xl font-semibold">Стоимость</h3>
                    </div>
                    <p class="text-center">Минимальные наценки на ПК, скидки и акции для всех покупателей!</p>
                </div>
            </li>
            <li>
                <div class="w-full p-5 min-h-[130px] border-2 border-dashed dark:border-green-400 border-green-600 rounded-md space-y-2">
                    <div class="flex items-center gap-5 justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"
                            fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="lucide lucide-badge-help dark:stroke-green-400 stroke-green-600">
                            <path
                                d="M3.85 8.62a4 4 0 0 1 4.78-4.77 4 4 0 0 1 6.74 0 4 4 0 0 1 4.78 4.78 4 4 0 0 1 0 6.74 4 4 0 0 1-4.77 4.78 4 4 0 0 1-6.75 0 4 4 0 0 1-4.78-4.77 4 4 0 0 1 0-6.76Z" />
                            <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3" />
                            <line x1="12" x2="12.01" y1="17" y2="17" />
                        </svg>
                        <h3 class="text-xl font-semibold">Открытость</h3>
                    </div>
                    <p class="text-center">Вы заранее узнаете обо всех тонкостях создания и доставки ПК!</p>
                </div>
            </li>
        </ul>
    </section>
    <!-- кнопка прокрутки -->
    <section class="max-w-6xl mx-auto w-full">
        <a href="#second-main-section">
            <button class="w-full text-center py-4 dark:bg-white/5 bg-black/5 rounded-md transition-all hover:bg-black/10 dark:hover:bg-white/10">
                <svg class="w-6 h-6 text-gray-800 dark:text-white mx-auto" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m19 9-7 7-7-7" />
                </svg>
            </button>
        </a>
    </section>
    <!-- инфо блок -->
    <section class="w-full max-w-6xl mx-auto text-black dark:text-white" id="second-main-section">
        <div class="flex max-[875px]:flex-col w-full gap-10">
            <div class="p-4 border border-white w-1/2 max-[875px]:mx-auto max-[500px]:w-full">
                <img src="/img/zxczxxc.jpg" alt="" class="rounded-md">
            </div>
            <div
                class="w-1/2 max-[875px]:w-full flex flex-col justify-between max-[875px]:space-y-8 max-[875px]:text-center">
                <div class="space-y-4">
                    <h2 class="font-black text-2xl">Самые современные сборки ПК</h2>
                    <p class="font-semibold">
                        Мы используем самые актуальные и проверенные комплектующие, чтобы ваш ПК не отставал от
                        требований всех современные игр и программ
                    </p>
                </div>
                <div class="space-y-4">
                    <h2 class="font-black text-2xl">Контроль качества</h2>
                    <p class="font-semibold">
                        Все наши продукты проходят проверку качества, так что не бойтесь получить бракованный
                        товар. Всё, что вы закажите, определённо порадует вас
                    </p>
                </div>
                <div class="space-y-4">
                    <h2 class="font-black text-2xl">Всё-таки ПК работает некорректно?</h2>
                    <p class="font-semibold">
                        При покупке ПК вы получаете гарантию от 3-х лет. Просто расскажите нам о проблеме, мы
                        всегда готовы вам помочь или вернуть деньги
                    </p>
                </div>
            </div>
        </div>
    </section>
    <section class="max-w-6xl w-full mx-auto">
        <div class="w-full border-b dark:border-white border-black"></div>
    </section>
    @auth
        <section class="max-w-6xl w-full mx-auto text-center pb-10">
            <a href={{ route('shop.index') }}
                class="inline text-black dark:text-white text-center text-2xl font-black transition-all hover:text-green-500 dark:hover:text-green-500">Чего вы ждёте? Переходите в
                магазин и выбирайте ПК своей мечты!</a>
        </section>
    @else
        <!-- авторизация на главной странице -->
        <section class="max-w-6xl w-full mx-auto space-y-12 pb-10">
            <h2 class="text-center text-2xl font-black text-black dark:text-white">Авторизируйтесь, чтобы заказать ПК своей мечты</h2>
            <form class="w-[55%] mx-auto space-y-8" method="POST" action="{{ route('login') }}">
                @csrf
                <div class="space-y-2">
                    <label for="email" class="font-semibold text-black/80 dark:text-white/80">Электронная почта</label>
                    <input type="email" name="email" :value="old('email')" required autofocus
                        class="transition-all w-full py-2 dark:bg-white/5 bg-black/5 text-black dark:text-white dark:focus:bg-white/10 focus:bg-black/10 border-0 outline-none focus:ring-0 ring-0 rounded-xl px-4">
                </div>
                <div class="space-y-2">
                    <label for="password" class="font-semibold text-black/80 dark:text-white/80">Пароль</label>
                    <input type="password" name="password" required
                        class="transition-all w-full py-2 dark:bg-white/5 bg-black/5 text-black dark:text-white dark:focus:bg-white/10 focus:bg-black/10 border-0 outline-none focus:ring-0 ring-0 rounded-xl px-4">
                </div>
                <button type="submit"
                    class="w-full py-4 font-semibold bg-green-500 transition-all hover:dark:bg-green-400 rounded-xl dark:text-black">
                    Войти
                </button>
            </form>
            <div class="text-center">
                <button onclick="getRegister()" class="font-semibold transition-all hover:text-green-500">
                    Регистрация
                </button>
            </div>
        </section>
    @endauth

    <script>
        document.querySelector('a[href="#second-main-section"]').addEventListener('click', (e) => {
            e.preventDefault();
            document.getElementById('second-main-section').scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        });
    </script>
@endsection
