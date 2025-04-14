@extends('layouts.app')

@section('content')
    <section class="max-w-6xl w-full mx-auto flex gap-10">
        <div class="w-3/5 p-5 border dark:border-white/40 rounded-md">
            <ul class="grid grid-cols-3 gap-5">
                <li>
                    <a href="{{ route('computer.show', $computer->id) }}">
                        <div class="transition-all hover:scale-105 space-y-2 border border-white/5 rounded-[3px]">
                            <div>
                                @if (isset($computer->image))
                                    <img src="{{ asset('storage/' . $computer->image) }}" alt="{{ $computer->name ?? 'Компьютер' }}"
                                        class="w-full block mx-auto rounded-md {{ isset($computer->deleted_at) ? 'opacity-50' : '' }}">
                                @else
                                    <div
                                        class="max-w-[250px] w-full mx-auto rounded-md {{ isset($computer->deleted_at) ? 'bg-gray-900' : 'bg-gray-800' }} flex items-center justify-center">
                                        <svg class="w-16 h-16 {{ isset($computer->deleted_at) ? 'text-gray-700' : 'text-gray-600' }}" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                            </path>
                                        </svg>
                                    </div>
                                @endif
                            </div>
                            <div class="space-y-2 bg-white/5 px-4 py-2">
                                <h3 class="font-semibold text-xl">{{ $computer->name }}</h3>
                                <p class="font-semibold text-2xl text-green-500">
                                    {{ $computer->price }} ₽
                                </p>
                            </div>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
        <div class="w-2/5 space-y-4">
            <h1 class="text-center text-2xl font-semibold">
                Ваша корзина
            </h1>
            <ul class="grid grid-cols-2 gap-4 text-left">
                <li>
                    <div class="w-full border border-white/10 p-4 rounded-sm">
                        <h2 class="font-semibold text-lg">
                            Количество товаров:
                        </h2>
                        <p class="text-green-500">
                            <span>1</span> шт.
                        </p>
                    </div>
                </li>
                <li>
                    <div class="w-full border border-white/10 p-4 rounded-sm">
                        <h2 class="font-semibold text-lg">
                            Размер скидки:
                        </h2>
                        <p class="text-green-500">
                            <span>0</span> %
                        </p>
                    </div>
                </li>
                <li>
                    <div class="w-full border border-white/10 p-4 rounded-sm">
                        <h2 class="font-semibold text-lg">
                            Сумма заказа:
                        </h2>
                        <p class="text-green-500">
                            <span>95 900</span> ₽
                        </p>
                    </div>
                </li>
                <li>
                    <div class="w-full border border-white/10 p-4 rounded-sm">
                        <h2 class="font-semibold text-lg">
                            Сумма скидки:
                        </h2>
                        <p class="text-green-500">
                            <span>0</span> ₽
                        </p>
                    </div>
                </li>
            </ul>
            <div class="text-green-500 flex justify-end items-center gap-2 text-xl font-semibold">
                <h2>Итого:</h2>
                <p class="text-white">
                    <span>95 900</span> ₽
                </p>
            </div>
            <button class="w-full py-2 bg-green-500 font-semibold text-black/90 rounded-md transition-all hover:bg-green-400">
                Перейти к оплате
            </button>
        </div>
    </section>
@endsection