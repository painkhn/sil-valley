@extends('layouts.app')

@section('content')
    <section class="flex justify-between">
        <div class="w-[20%] p-5 border-2 border-dashed border-white/50 rounded-md">
            <form class="space-y-6">
                <div class="space-y-2">
                    <label class="font-semibold dark:text-white/80">Название ПК</label>
                    <input type="text" placeholder="Введите название ПК" class="transition-all w-full py-2 bg-white/5 border-0 outline-none focus:ring-0 ring-0 focus:bg-white/10 rounded-xl px-4 pr-12">
                </div>
                <div class="space-y-2">
                    <label class="font-semibold dark:text-white/80">Год выпуска</label>
                    <input type="text" placeholder="Введите год выпуска" class="transition-all w-full py-2 bg-white/5 border-0 outline-none focus:ring-0 ring-0 focus:bg-white/10 rounded-xl px-4 pr-12">
                </div>
                <div class="space-y-2">
                    <label class="font-semibold dark:text-white/80">Видеокарта</label>
                    <select type="text" class="transition-all w-full py-2 bg-white/5 border-0 outline-none focus:ring-0 ring-0 focus:bg-white/10 rounded-xl px-4 pr-12">
                        <option class="bg-black" selected>Выберите видеокарту</option>
                        @foreach ($videocards as $item)
                            <option value="{{ $item['title'] }}" class="bg-black">{{ $item['title'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="space-y-2">
                    <label class="font-semibold dark:text-white/80">Процессор</label>
                    <select type="text" class="transition-all w-full py-2 bg-white/5 border-0 outline-none focus:ring-0 ring-0 focus:bg-white/10 rounded-xl px-4 pr-12">
                        <option class="bg-black" selected>Выберите процессор</option>
                        @foreach ($cpus as $item)
                            <option value="{{ $item['title'] }}" class="bg-black">{{ $item['title'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="space-y-2">
                    <label class="font-semibold dark:text-white/80">ОЗУ</label>
                    <select type="text" class="transition-all w-full py-2 bg-white/5 border-0 outline-none focus:ring-0 ring-0 focus:bg-white/10 rounded-xl px-4 pr-12">
                        <option class="bg-black" selected>Выберите объём ОЗУ</option>
                        @foreach ($ram as $item)
                            <option value="{{ $item['value'] }}" class="bg-black">{{ $item['value'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="space-y-2 flex flex-col">
                    <label class="font-semibold dark:text-white/80">Стоимость от: <output id="shopMinPriceValue"></output> ₽</label>
                    <input type="range" min="1000" max="100000" step="100" id="shopMinPriceInput" class="shopMinPriceInput">
                </div>
                <div class="space-y-2 flex flex-col">
                    <label class="font-semibold dark:text-white/80">Стоимость до: <output id="shopMaxPriceValue"></output> ₽</label>
                    <input type="range" min="1000" max="100000" step="100" id="shopMaxPriceInput" class="shopPriceInput">
                </div>
                <button type="submit" class="w-full py-2 font-semibold bg-green-500 transition-all hover:dark:bg-green-400 rounded-xl dark:text-black">Поиск</button>
            </form>
        </div>
        <div class="w-[75%]">
            <ul class="grid grid-cols-4 w-full gap-y-5">
                @foreach ($pc_list as $item)
                    <li class="w-[90%]">
                        <a href="#!">
                            <div class="p-5 border border-white/50 rounded-md space-y-4 text-center transition-all hover:scale-105 shadow-lg bg-[#1f1f1f]/50 shadow-black">
                                <img src="/img/pc-example-image.webp" class="max-w-[250px] w-full block mx-auto rounded-md" alt="">
                                <div class="space-y-2">
                                    <h3 class="text-lg font-semibold dark:text-white">{{ $item['title'] }}</h3>
                                    <p class="text-sm text-white/80 line-clamp-2">Intel Core i5-12400F, 6 x 2.5 ГГц, 16 ГБ DDR4, GeForce RTX 3050, SSD 1000 ГБ, без ОС, 1 x DisplayPort, 1 x DVI-D, 1 x HDMI, Intel H610, блок питания - 500 Вт</p>
                                </div>
                            </div>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </section>
@endsection