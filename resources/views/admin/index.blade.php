@extends('layouts.app')

@section('content')
    <section class="w-1/3 mx-auto text-center space-y-8 pt-10">
        <h1 class="text-xl font-semibold text-black dark:text-white">Товары</h1>
    </section>

    <div class="max-w-[200px] w-full mx-auto">
        <a href="{{ route('admin.computer.create') }}"
            class="flex items-center justify-center transition-all rounded-md gap-1 px-4 py-2 hover:bg-gray-100 dark:hover:bg-white/10 dark:hover:text-white dark:text-white text-black">
            <svg class="w-6 h-5 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                <path
                    d="M12.013 6.175 7.006 9.369l5.007 3.194-5.007 3.193L2 12.545l5.006-3.193L2 6.175l5.006-3.194 5.007 3.194ZM6.981 17.806l5.006-3.193 5.006 3.193L11.987 21l-5.006-3.194Z" />
                <path
                    d="m12.013 12.545 5.006-3.194-5.006-3.176 4.98-3.194L22 6.175l-5.007 3.194L22 12.562l-5.007 3.194-4.98-3.211Z" />
            </svg>
            Добавить товар
        </a>
    </div>
    <section class="max-w-[730px] mx-auto text-center">
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
            <a href={{ route('admin.products') }} class="block">
                <button type="button"
                    class="mx-auto block font-semibold transition-all text-black/80 dark:text-white hover:text-green-500">
                    Сброс
                </button>
            </a>
        </form>
    </section>

    <div class="w-[75%] max-[500px]:w-full mx-auto">
        <ul class="flex flex-wrap max-[1100px]:justify-center w-full gap-y-5 gap-x-10">
            @foreach ($pc_list as $item)
                <li>
                    <x-computer-card :item="$item" variant="admin" />
                </li>
            @endforeach
        </ul>
    </div>
@endsection
