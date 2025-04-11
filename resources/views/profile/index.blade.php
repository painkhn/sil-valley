@extends('layouts.app')

@section('content')
    <section class="flex w-full gap-10">
        <div class="w-1/3 p-5 border-2 border-dashed dark:border-white/50 rounded-md">
            <div class="flex items-center gap-5">
                <img src="/img/avatar-default.webp" alt="" class="max-w-[250px] w-full">
                <div class="space-y-2">
                    <h2 class="text-xl font-semibold capitalize">{{ auth()->user()->name }}</h2>
                    <p>{{ auth()->user()->email }}</p>
                    <p class="dark:text-white/80">Доликашин Пенис Бимбавич</p>
                </div>
            </div>
        </div>
        <div class="w-2/3">
            <h2 class="text-center text-2xl font-black mb-10">Доставки</h2>
            <ul class="grid grid-cols-2 gap-5">
                <li>
                    <div class="w-full border border-white/50 rounded-md p-5 flex gap-5">
                        <img src="/img/pc-example-image.webp" alt="" class="w-1/2 rounded-md">
                        <div>
                            <h3 class="font-semibold text-lg">Доставка #123</h3>
                            <p>Дата заказа: 03.04.2025</p>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="w-full border border-white/50 rounded-md p-5 flex gap-5">
                        <img src="/img/pc-example-image.webp" alt="" class="w-1/2 rounded-md">
                        <div>
                            <h3 class="font-semibold text-lg">Доставка #123</h3>
                            <p>Дата заказа: 03.04.2025</p>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </section>
@endsection