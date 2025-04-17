@extends('layouts.app')

@section('content')
    <section class="w-1/3 mx-auto text-center space-y-8 pt-10">
        <h1 class="text-xl font-semibold text-black dark:text-white">Панель администратора</h1>
    </section>

    <section class="w-1/3 mx-auto text-center">
        <form class="space-y-4">
            <div class="space-y-2">
                <label class="font-semibold text-black/80 dark:text-white/80">Название ПК</label>
                <input type="text" placeholder="Введите название ПК" name="title" value="{{ request('title') }}"
                    class="transition-all w-full py-2 dark:bg-white/5 bg-black/5 focus:bg-black/10 border-0 outline-none focus:ring-0 ring-0 dark:focus:bg-white/10 rounded-xl px-4 pr-12 text-black dark:text-white">
            </div>
            <div class="space-y-2">
                <label class="font-semibold text-black/80 dark:text-white/80">Статус</label>
                <select name="status"
                    class="transition-all w-full py-2 dark:bg-white/5 bg-black/5 focus:bg-black/10 border-0 outline-none focus:ring-0 ring-0 dark:focus:bg-white/10 rounded-xl px-4 pr-12 text-black dark:text-white">
                    <option value="" {{ request('status') ? '' : 'selected' }}
                        class="dark:bg-black bg-white/90 dark:text-white text-black">
                        Выберите статус товара
                    </option>
                    <option value="deleted" {{ request('status') == 'deleted' ? 'selected' : '' }}
                        class="dark:bg-black bg-white/90 dark:text-white text-black">Удалённые</option>
                    <option value="actual" {{ request('status') == 'actual' ? 'selected' : '' }}
                        class="dark:bg-black bg-white/90 dark:text-white text-black">Актуальные</option>
                </select>
            </div>
            <div class="space-y-2">
                <label class="font-semibold text-black/80 dark:text-white/80">Порядок</label>
                <select name="order"
                    class="transition-all w-full py-2 dark:bg-white/5 bg-black/5 focus:bg-black/10 border-0 outline-none focus:ring-0 ring-0 dark:focus:bg-white/10 rounded-xl px-4 pr-12 text-black dark:text-white">
                    <option value="" {{ request('order') ? '' : 'selected' }}
                        class="dark:bg-black bg-white/90 dark:text-white text-black">
                        Выберите порядок
                    </option>
                    <option value="alphabet" {{ request('order') == 'alphabet' ? 'selected' : '' }}
                        class="dark:bg-black bg-white/90 dark:text-white text-black">По алфавиту
                    </option>
                    <option value="desc" {{ request('order') == 'desc' ? 'selected' : '' }}
                        class="dark:bg-black bg-white/90 dark:text-white text-black">Цена (по убыванию)
                    </option>
                    <option value="asc" {{ request('order') == 'asc' ? 'selected' : '' }}
                        class="dark:bg-black bg-white/90 dark:text-white text-black">Цена (по
                        возрастанию)</option>
                </select>
            </div>
            <div class="space-y-2 flex flex-col">
                <label class="font-semibold text-black/80 dark:text-white/80">Стоимость от: <output
                        id="shopMinPriceValue">{{ request('min_price', 1000) }}</output> ₽</label>
                <input type="range" min="0" step="1" max="{{ $maxPrice }}" id="shopMinPriceInput"
                    name="min_price" value="{{ request('min_price', 1000) }}" class="shopMinPriceInput">
            </div>
            <div class="space-y-2 flex flex-col">
                <label class="font-semibold text-black/80 dark:text-white/80">Стоимость до: <output
                        id="shopMaxPriceValue">{{ request('max_price', 100000) }}</output> ₽</label>
                <input type="range" min="0" step="1" max="{{ $maxPrice }}" id="shopMaxPriceInput"
                    name="max_price" value="{{ request('max_price', $maxPrice) }}" class="shopPriceInput">
            </div>
            <button type="submit"
                class="w-full py-2 font-semibold bg-green-500 transition-all hover:bg-green-600 hover:dark:bg-green-400 rounded-xl dark:text-black">Поиск</button>
            <a href="/admin" class="block">
                <button type="button"
                    class="mx-auto block font-semibold transition-all text-black/80 dark:text-white hover:text-green-500">
                    Сброс
                </button>
            </a>
        </form>
    </section>

    <div class="w-[75%] mx-auto">
        <ul class="grid grid-cols-4 w-full gap-y-5 gap-x-10">
            @foreach ($pc_list as $item)
                <li>
                    <x-computer-card :item="$item" variant="admin" />
                </li>
            @endforeach
        </ul>
    </div>
@endsection
