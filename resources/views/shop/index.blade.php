@extends('layouts.app')

@section('content')
    <section class="flex justify-between">
        <div class="w-[20%] p-5 border-2 border-dashed border-white/50 rounded-md">
            <form class="space-y-6" method="GET">
                <div class="space-y-2">
                    <label class="font-semibold dark:text-white/80">Название ПК</label>
                    <input type="text" placeholder="Введите название ПК" name="title" value="{{ request('title') }}"
                        class="transition-all w-full py-2 bg-white/5 border-0 outline-none focus:ring-0 ring-0 focus:bg-white/10 rounded-xl px-4 pr-12">
                </div>
                <div class="space-y-2">
                    <label class="font-semibold dark:text-white/80">Видеокарта</label>
                    <select name="videocard"
                        class="transition-all w-full py-2 bg-white/5 border-0 outline-none focus:ring-0 ring-0 focus:bg-white/10 rounded-xl px-4 pr-12">
                        <option value="" class="bg-black" {{ request('videocard') ? '' : 'selected' }}>Выберите
                            видеокарту</option>
                        @foreach ($videocards as $item)
                            <option value="{{ $item['title'] }}" class="bg-black"
                                {{ request('videocard') == $item['title'] ? 'selected' : '' }}>
                                {{ $item['title'] }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="space-y-2">
                    <label class="font-semibold dark:text-white/80">Процессор</label>
                    <select name="cpu"
                        class="transition-all w-full py-2 bg-white/5 border-0 outline-none focus:ring-0 ring-0 focus:bg-white/10 rounded-xl px-4 pr-12">
                        <option value="" class="bg-black" {{ request('cpu') ? '' : 'selected' }}>Выберите процессор
                        </option>
                        @foreach ($cpus as $item)
                            <option value="{{ $item['title'] }}" class="bg-black"
                                {{ request('cpu') == $item['title'] ? 'selected' : '' }}>
                                {{ $item['title'] }}
                            </option>
                        @endforeach
                    </select>
                </div>
                {{-- <div class="space-y-2">
                    <label class="font-semibold dark:text-white/80">ОЗУ</label>
                    <select name="ram"
                        class="transition-all w-full py-2 bg-white/5 border-0 outline-none focus:ring-0 ring-0 focus:bg-white/10 rounded-xl px-4 pr-12">
                        <option value="" class="bg-black" {{ request('ram') ? '' : 'selected' }}>Выберите объём ОЗУ
                        </option>
                        @foreach ($ram as $item)
                            <option value="{{ $item['value'] }}" class="bg-black"
                                {{ request('ram') == $item['value'] ? 'selected' : '' }}>
                                {{ $item['value'] }}
                            </option>
                        @endforeach
                    </select>
                </div> --}}
                <div class="space-y-2 flex flex-col">
                    <label class="font-semibold dark:text-white/80">Стоимость от: <output
                            id="shopMinPriceValue">{{ request('min_price', 1000) }}</output> ₽</label>
                    <input type="range" min="0" max="{{ $maxPrice }}" step="1" id="shopMinPriceInput"
                        name="min_price" value="{{ request('min_price', 1000) }}" class="shopMinPriceInput">
                </div>
                <div class="space-y-2 flex flex-col">
                    <label class="font-semibold dark:text-white/80">Стоимость до: <output
                            id="shopMaxPriceValue">{{ request('max_price', 100000) }}</output> ₽</label>
                    <input type="range" min="0" max="{{ $maxPrice }}" step="1" id="shopMaxPriceInput"
                        name="max_price" value="{{ request('max_price', 100000) }}" class="shopPriceInput">
                </div>
                <button type="submit"
                    class="w-full py-2 font-semibold bg-green-500 transition-all hover:dark:bg-green-400 rounded-xl dark:text-black">Поиск</button>
            </form>

        </div>
        <div class="w-[75%]">
            <ul class="grid grid-cols-4 w-full gap-y-5">
                @foreach ($pc_list as $item)
                    <x-computer-card :item="$item" />
                @endforeach
            </ul>
        </div>
    </section>
@endsection
