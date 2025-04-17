@extends('layouts.app')

@section('content')
    <section class="max-w-6xl w-full gap-5 mx-auto flex justify-center">
        @if (empty($computers))
            <h1 class="text-center text-black dark:text-white text-2xl font-semibold my-10 w-full">
                Корзина пуста
            </h1>
        @else
            <div class="w-3/5 p-5 border dark:border-white/40 border-black/40 rounded-md">
                <ul class="grid grid-cols-3 gap-5">
                    @foreach ($computers as $item)
                        <li>
                            <a href="{{ route('computer.show', $item->id) }}">
                                <div
                                    class="transition-all hover:scale-105 space-y-2 border dark:border-white/5 border-black/5 rounded-md">
                                    <div>
                                        @if (isset($item->image))
                                            <img src="{{ asset('storage/' . $item->image) }}"
                                                alt="{{ $item->name ?? 'Компьютер' }}"
                                                class="w-full block mx-auto rounded-md {{ isset($item->deleted_at) ? 'opacity-50' : '' }}">
                                        @else
                                            <div
                                                class="max-w-[250px] w-full mx-auto rounded-md {{ isset($item->deleted_at) ? 'bg-gray-900' : 'bg-gray-800' }} flex items-center justify-center">
                                                <svg class="w-16 h-16 {{ isset($item->deleted_at) ? 'text-gray-700' : 'text-gray-600' }}"
                                                    fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                                    </path>
                                                </svg>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="dark:bg-white/5 bg-black/5 px-4 py-2 rounded-b-md">
                                        <h3 class="font-black text-lg text-black dark:text-white">{{ $item->name }}</h3>
                                        <p class="font-semibold text-lg dark:text-green-500 text-green-600">
                                            {{ $item->price }} ₽
                                        </p>
                                    </div>
                                </div>
                            </a>
                            <div class="max-w-[128px] w-full mx-auto block mt-4">
                                <div class="relative flex items-center w-full">
                                    <form
                                        action="{{ route('cart.update', ['item' => $item->cart_item_id, 'status' => 'minus']) }}"
                                        method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit"
                                            class="bg-gray-100 dark:bg-transparent transition-all dark:hover:bg-white/5 dark:border-gray-600 hover:bg-gray-200 border border-gray-300 rounded-s-lg p-3 h-11 focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none">
                                            <svg class="w-3 h-3 text-gray-900 dark:text-white" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 2">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2" d="M1 1h16" />
                                            </svg>
                                        </button>
                                    </form>
                                    <input type="text" disabled id="quantity-input" min="1" data-input-counter
                                        aria-describedby="helper-text-explanation" value="{{ $item->quantity }}"
                                        class="focus:ring-0 focus:dark:border-gray-600 bg-gray-50 border-x-0 border-gray-300 h-11 text-center text-gray-900 text-sm block w-full py-2.5 dark:bg-transparent dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                                        placeholder="от 0" required />
                                    <form
                                        action="{{ route('cart.update', ['item' => $item->cart_item_id, 'status' => 'plus']) }}"
                                        method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit"
                                            class="bg-gray-100 dark:bg-transparent transition-all dark:hover:bg-white/5 dark:border-gray-600 hover:bg-gray-200 border border-gray-300 rounded-e-lg p-3 h-11 focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none">
                                            <svg class="w-3 h-3 text-gray-900 dark:text-white" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2" d="M9 1v16M1 9h16" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="w-2/5 space-y-4">
                <h1 class="text-center text-black dark:text-white text-2xl font-semibold">
                    Ваша корзина
                </h1>
                <ul class="grid grid-cols-2 gap-4 text-left">
                    <li>
                        <div class="w-full border dark:border-white/10 border-black/20 p-4 rounded-sm">
                            <h2 class="font-semibold text-lg text-black dark:text-white">
                                Количество товаров:
                            </h2>
                            <p class="text-green-500">
                                <span>{{ $totalQuantity }}</span> шт.
                            </p>
                        </div>
                    </li>
                    <li>
                        <div class="w-full border dark:border-white/10 border-black/20 p-4 rounded-sm">
                            <h2 class="font-semibold text-lg text-black dark:text-white">
                                Размер скидки:
                            </h2>
                            <p class="text-green-500">
                                <span>{{ $discountPercent }}</span> %
                            </p>
                        </div>
                    </li>
                    <li>
                        <div class="w-full border dark:border-white/10 border-black/20 p-4 rounded-sm">
                            <h2 class="font-semibold text-lg text-black dark:text-white">
                                Сумма заказа:
                            </h2>
                            <p class="text-green-500">
                                <span>{{ number_format($totalPrice, 0, ',', ' ') }}</span> ₽
                            </p>
                        </div>
                    </li>
                    <li>
                        <div class="w-full border dark:border-white/10 border-black/20 p-4 rounded-sm">
                            <h2 class="font-semibold text-lg text-black dark:text-white">
                                Сумма скидки:
                            </h2>
                            <p class="text-green-500">
                                <span>{{ number_format($discountAmount, 0, ',', ' ') }}</span> ₽
                            </p>
                        </div>
                    </li>
                </ul>
                <div class="text-green-500 flex justify-end items-center gap-2 text-xl font-semibold">
                    <h2>Итого:</h2>
                    <p class="text-black dark:text-white">
                        <span>{{ number_format($finalPrice, 0, ',', ' ') }}</span> ₽
                    </p>
                </div>
                <button
                    class="w-full py-2 bg-green-500 font-semibold dark:text-black/90 text-white rounded-md transition-all hover:bg-green-600 dark:hover:bg-green-400">
                    Перейти к оплате
                </button>
            </div>
        @endif
    </section>
@endsection
