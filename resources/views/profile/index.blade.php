@extends('layouts.app')

@section('content')
    <section class="flex w-full gap-10">
        <div class="max-w-[580px] w-full mx-auto space-y-5">
            <h1 class="text-black dark:text-white font-semibold text-2xl text-center">Редактировать профиль</h1>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="w-full p-5 rounded-md bg-black/5 dark:bg-white/5 mx-auto">
                <form method="post" action="{{ route('profile.update') }}" class="space-y-4">
                    @csrf
                    @method('patch')
                    <div class="space-y-2">
                        <label for="name" class="text-black dark:text-white">Логин:</label>
                        <input
                            class="transition-all w-full py-2 dark:bg-white/5 bg-black/5 text-black dark:text-white dark:focus:bg-white/10 focus:bg-black/10 border-0 outline-none focus:ring-0 ring-0 rounded-xl px-4"
                            type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                    </div>
                    <div class="space-y-2">
                        <label for="email" class="text-black dark:text-white">Электронная почта:</label>
                        <input
                            class="transition-all w-full py-2 dark:bg-white/5 bg-black/5 text-black dark:text-white dark:focus:bg-white/10 focus:bg-black/10 border-0 outline-none focus:ring-0 ring-0 rounded-xl px-4"
                            type="email" id="email" name="email" value="{{ old('name', $user->email) }}" required>
                    </div>
                    <button type="submit"
                        class="w-full block mt-5 py-3 font-semibold bg-green-500 transition-all hover:dark:bg-green-400 hover:bg-green-600 rounded-xl dark:text-black">Сохранить</button>
                </form>
            </div>
            @if ($user->provider === 'email')
                <div class="w-full p-5 rounded-md bg-black/5 dark:bg-white/5 mx-auto">
                    <form method="post" action="{{ route('password.update') }}" class="space-y-4">
                        @csrf
                        @method('put')
                        <div class="space-y-2">
                            <label for="current_password" class="text-black dark:text-white">Дейсвительный пароль:</label>
                            <input
                                class="transition-all w-full py-2 dark:bg-white/5 bg-black/5 text-black dark:text-white dark:focus:bg-white/10 focus:bg-black/10 border-0 outline-none focus:ring-0 ring-0 rounded-xl px-4"
                                type="password" id="update_password_current_password" name="current_password" required>
                        </div>
                        <div class="space-y-2">
                            <label for="password" class="text-black dark:text-white">Новый пароль:</label>
                            <input
                                class="transition-all w-full py-2 dark:bg-white/5 bg-black/5 text-black dark:text-white dark:focus:bg-white/10 focus:bg-black/10 border-0 outline-none focus:ring-0 ring-0 rounded-xl px-4"
                                type="password" id="update_password_password" name="password" required>
                        </div>
                        <div class="space-y-2">
                            <label for="password_confirmation" class="text-black dark:text-white">Подтвердите
                                пароль:</label>
                            <input
                                class="transition-all w-full py-2 dark:bg-white/5 bg-black/5 text-black dark:text-white dark:focus:bg-white/10 focus:bg-black/10 border-0 outline-none focus:ring-0 ring-0 rounded-xl px-4"
                                type="password" id="update_password_password_confirmation" name="password_confirmation"
                                required>
                        </div>
                        <button type="submit"
                            class="w-full block mt-5 py-3 font-semibold bg-green-500 transition-all hover:dark:bg-green-400 hover:bg-green-600 rounded-xl dark:text-black">Сохранить</button>
                    </form>
                </div>
            @endif
        </div>
    </section>
@endsection
