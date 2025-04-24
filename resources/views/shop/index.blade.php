@extends('layouts.app')

@section('content')
    <section class="flex justify-between gap-10 max-[800px]:flex-col max-[800px]:items-center">
        <div
            class="max-w-[380px] max-[800px]:max-w-[500px] w-full p-5 border-2 border-dashed border-black/50 dark:border-white/50 rounded-md">
            <form class="space-y-6" method="GET">
                <div class="space-y-2">
                    <label class="font-semibold text-black/80 dark:text-white/80">Название ПК</label>
                    <input type="text" placeholder="Введите название ПК" name="title" value="{{ request('title') }}"
                        class="transition-all w-full py-2 dark:bg-white/5 bg-black/5 focus:bg-black/10 border-0 outline-none focus:ring-0 ring-0 dark:focus:bg-white/10 rounded-xl px-4 pr-12 text-black dark:text-white">
                </div>
                <div class="space-y-2">
                    <label class="font-semibold text-black/80 dark:text-white/80">Видеокарта</label>
                    <select name="videocard"
                        class="transition-all w-full py-2 dark:bg-white/5 bg-black/5 focus:bg-black/10 border-0 outline-none focus:ring-0 ring-0 dark:focus:bg-white/10 rounded-xl px-4 pr-12 text-black dark:text-white">
                        <option value="" class="dark:bg-black bg-white/90 dark:text-white text-black"
                            {{ request('videocard') ? '' : 'selected' }}>Выберите
                            видеокарту</option>
                        @foreach ($videocards as $item)
                            <option value="{{ $item['title'] }}"
                                class="dark:bg-black bg-white/90 dark:text-white text-black"
                                {{ request('videocard') == $item['title'] ? 'selected' : '' }}>
                                {{ $item['title'] }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="space-y-2">
                    <label class="font-semibold text-black/80 dark:text-white/80">Процессор</label>
                    <select name="cpu"
                        class="transition-all w-full py-2 dark:bg-white/5 bg-black/5 focus:bg-black/10 border-0 outline-none focus:ring-0 ring-0 dark:focus:bg-white/10 rounded-xl px-4 pr-12 text-black dark:text-white">
                        <option value="" class="dark:bg-black bg-white/90 dark:text-white text-black"
                            {{ request('cpu') ? '' : 'selected' }}>Выберите процессор
                        </option>
                        @foreach ($cpus as $item)
                            <option value="{{ $item['title'] }}"
                                class="dark:bg-black bg-white/90 dark:text-white text-black"
                                {{ request('cpu') == $item['title'] ? 'selected' : '' }}>
                                {{ $item['title'] }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="space-y-2 flex flex-col">
                    <label class="font-semibold text-black/80 dark:text-white/80">Стоимость от: <output
                            id="shopMinPriceValue">{{ request('min_price', 1000) }}</output> ₽</label>
                    <input type="range" min="0" max="{{ $maxPrice }}" step="1" id="shopMinPriceInput"
                        name="min_price" value="{{ request('min_price', 1000) }}" class="shopMinPriceInput">
                </div>
                <div class="space-y-2 flex flex-col">
                    <label class="font-semibold text-black/80 dark:text-white/80">Стоимость до: <output
                            id="shopMaxPriceValue">{{ request('max_price', 100000) }}</output> ₽</label>
                    <input type="range" min="0" max="{{ $maxPrice }}" step="1" id="shopMaxPriceInput"
                        name="max_price" value="{{ request('max_price', 100000) }}" class="shopPriceInput">
                </div>
                <button type="submit"
                    class="w-full py-2 font-semibold bg-green-500 transition-all hover:bg-green-600 hover:dark:bg-green-400 rounded-xl dark:text-black">Поиск</button>
                <a href={{ route('shop.index') }} class="block">
                    <button type="button"
                        class="mx-auto block font-semibold transition-all text-black/80 dark:text-white hover:text-green-500">
                        Сброс
                    </button>
                </a>
            </form>

        </div>
        <div class="w-[75%] max-[600px]:w-full">
            @if ($pc_list->isEmpty())
                <h1 class="text-center font-semibold text-2xl text-black dark:text-white">
                    Товара не найдено
                </h1>
            @else
                <ul class="flex gap-10 flex-wrap max-[800px]:justify-center max-[800px]:gap-x-5 w-full gap-y-5">
                    @foreach ($pc_list as $item)
                        <x-computer-card :item="$item" />
                    @endforeach
                </ul>
            @endif
        </div>
    </section>
@endsection
