@extends('layouts.app')

@section('content')
    <section class="flex w-full gap-10">
        <div class="max-w-[580px] w-full mx-auto space-y-5">
            <h1 class="text-black dark:text-white font-semibold text-2xl text-center">Редактировать профиль</h1>
            <div class="w-full p-5 rounded-md bg-black/5 dark:bg-white/5 mx-auto">
                <form action="" class="space-y-4">
                    <div class="space-y-2">
                        <label for="" class="text-black dark:text-white">Логин:</label>
                        <input
                            class="transition-all w-full py-2 dark:bg-white/5 bg-black/5 text-black dark:text-white dark:focus:bg-white/10 focus:bg-black/10 border-0 outline-none focus:ring-0 ring-0 rounded-xl px-4"
                            type="text" name="" id="" value="" required>
                    </div>
                    <div class="space-y-2">
                        <label for="" class="text-black dark:text-white">Электронная почта:</label>
                        <input
                            class="transition-all w-full py-2 dark:bg-white/5 bg-black/5 text-black dark:text-white dark:focus:bg-white/10 focus:bg-black/10 border-0 outline-none focus:ring-0 ring-0 rounded-xl px-4"
                            type="email" name="" id="" value="" required>
                    </div>
                    <button type="submit" class="w-full block mt-5 py-3 font-semibold bg-green-500 transition-all hover:dark:bg-green-400 hover:bg-green-600 rounded-xl dark:text-black">Сохранить</button>
                </form>
            </div>
            <div class="w-full p-5 rounded-md bg-black/5 dark:bg-white/5 mx-auto">
                <form action="" class="space-y-4">
                    <div class="space-y-2">
                        <label for="" class="text-black dark:text-white">Пароль:</label>
                        <input
                            class="transition-all w-full py-2 dark:bg-white/5 bg-black/5 text-black dark:text-white dark:focus:bg-white/10 focus:bg-black/10 border-0 outline-none focus:ring-0 ring-0 rounded-xl px-4"
                            type="text" name="" id="" value="" required>
                    </div>
                    <div class="space-y-2">
                        <label for="" class="text-black dark:text-white">Подтвердите пароль:</label>
                        <input
                            class="transition-all w-full py-2 dark:bg-white/5 bg-black/5 text-black dark:text-white dark:focus:bg-white/10 focus:bg-black/10 border-0 outline-none focus:ring-0 ring-0 rounded-xl px-4"
                            type="email" name="" id="" value="" required>
                    </div>
                    <button type="submit" class="w-full block mt-5 py-3 font-semibold bg-green-500 transition-all hover:dark:bg-green-400 hover:bg-green-600 rounded-xl dark:text-black">Сохранить</button>
                </form>
            </div>
            <div class="w-full p-5 rounded-md bg-black/5 dark:bg-white/5 mx-auto">
                <h2 class="font-semibold text-black/90 dark:text-white/90"><span class="text-red-500 dark:text-red-400">ВНИМАНИЕ!</span> Удалив аккаунт, вы не сможете восстановить его.</h2>
                <button data-modal-target="delete-modal" data-modal-toggle="delete-modal" type="button" class="w-full block mt-5 py-3 font-semibold bg-red-500 transition-all hover:dark:bg-red-400 hover:bg-red-600 rounded-xl dark:text-black">
                    Удалить аккант
                </button>
                <div id="delete-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                    <div class="relative p-4 w-full max-w-2xl max-h-full">
                        <!-- Modal content -->
                        <div class="relative bg-white rounded-lg shadow-sm dark:bg-[#252525] border dark:border-white border-black">
                            <!-- Modal header -->
                            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                    Вы уверены?
                                </h3>
                                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="delete-modal">
                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                    </svg>
                                    <span class="sr-only">Close modal</span>
                                </button>
                            </div>
                            <!-- Modal body -->
                            <div class="p-4 md:p-5 space-y-4">
                                <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                                    После удаления аккаунта, вы не сможете вновь восстановить его. Убедитесь, что вы сохранили все нужные вам данные.
                                </p>
                            </div>
                            <!-- Modal footer -->
                            <div class="p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600 space-y-2">
                                <button data-modal-hide="delete-modal" type="button" class="w-full block mt-5 py-3 font-semibold bg-red-500 transition-all hover:dark:bg-red-400 hover:bg-red-600 rounded-xl dark:text-black">Я уверен, удалить аккаунт</button>
                                <button data-modal-hide="delete-modal" type="button" class="w-full hover:bg-black/5 dark:hover:bg-white/5 py-2 rounded-md transition-all text-black dark:text-white">Отмена</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection