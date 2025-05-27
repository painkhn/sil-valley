<!-- модалка авторизиции и регистрации -->
<div id="default-modal" tabindex="-1" aria-hidden="true"
    class="hidden bg-black/50 overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-screen max-h-full">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <!-- контент -->
        <div
            class="relative bg-white rounded-lg shadow-sm dark:bg-gradient-to-b dark:from-[#0a0a0a] dark:to-[#1f1f1f] border-2 border-dashed border-white/50 space-y-8 p-4">
            <x-auth.login />
            <x-auth.register />
            <!-- футер модалки -->
            <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                <button data-modal-hide="default-modal" type="button"
                    class="mx-auto font-semibold text-black dark:text-white transition-all hover:text-green-500 dark:hover:text-green-500">Отмена</button>
            </div>
        </div>
    </div>
</div>
<script>
    // переменные для форм авторизации и регистрации
    const register = document.querySelector('.register');
    const login = document.querySelector('.login');
    const goLoginBtn = document.querySelector('.goLoginBtn')

    // вывести форму регистрации
    const getRegister = () => {
        register.classList.remove('hidden');
        goLoginBtn.classList.remove('hidden');
        login.classList.add('hidden');
    }

    // вывести форму авторизации
    const getLogin = () => {
        register.classList.add('hidden');
        goLoginBtn.classList.add('hidden');
        login.classList.remove('hidden');
    }
</script>
