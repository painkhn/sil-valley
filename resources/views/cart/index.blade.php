@extends('layouts.app')

@section('content')
    <section class="max-w-6xl w-full gap-5 mx-auto flex justify-center max-[800px]:flex-col-reverse max-[800px]:items-center max-[800px]:gap-y-10">
        @if (empty($computers))
            <h1 class="text-center text-black dark:text-white text-2xl font-semibold my-10 w-full">
                Корзина пуста
            </h1>
        @else
            <div class="w-3/5 max-[800px]:max-w-[450px] max-[800px]:w-full p-5 border dark:border-white/40 border-black/40 rounded-md">
                <ul class="flex flex-wrap max-[900px]:justify-center gap-x-5 gap-y-10">
                    @foreach ($computers as $item)
                        <li class="max-w-[220px] max-[900px]:max-w-full w-full">
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
            <div class="w-2/5 max-[800px]:max-w-[450px] max-[800px]:w-full space-y-4">
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
                <button onclick="openOrderInput()"
                    class="w-full py-2 bg-green-500 font-semibold dark:text-black/90 text-white rounded-md transition-all hover:bg-green-600 dark:hover:bg-green-400">
                    Перейти к оплате
                </button>

                <form id="orderForm" action="{{ route('order.store') }}" method="POST"
                    class="hidden mt-4 bg-white dark:bg-white/5 border border-black/20 dark:border-white/10 rounded-md p-4 space-y-5 transition-all">
                    @csrf
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <textarea name="comment" id="comment"
                        class="w-full px-3 py-2 bg-gray-100 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md text-black dark:text-white focus:outline-none focus:ring-2 focus:ring-green-400 dark:focus:ring-green-500 transition-all"></textarea>
                    <!-- Способ оплаты -->
                    <div>
                        <label for="paymentMethod" class="block mb-2 text-black dark:text-white font-semibold">Способ
                            оплаты:</label>
                        <select id="paymentMethod" name="paymentMethod"
                            class="w-full px-3 py-2 bg-gray-100 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md text-black dark:text-white focus:outline-none focus:ring-2 focus:ring-green-400 dark:focus:ring-green-500 transition-all">
                            <option value="card">Картой при получении</option>
                            <option value="cash">Наличными при получении</option>
                        </select>
                    </div>

                    <!-- Тип доставки -->
                    <div>
                        <label for="deliveryMethod" class="block mb-2 text-black dark:text-white font-semibold">Тип
                            доставки:</label>
                        <select id="deliveryMethod" name="deliveryMethod" onchange="toggleDeliveryDetails()"
                            class="w-full px-3 py-2 bg-gray-100 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md text-black dark:text-white focus:outline-none focus:ring-2 focus:ring-green-400 dark:focus:ring-green-500 transition-all">
                            <option value="pickup">Самовывоз</option>
                            <option value="delivery">Доставка</option>
                        </select>
                    </div>

                    <!-- Детали доставки -->
                    <div id="deliveryDetails" class="hidden space-y-4">
                        <!-- ФИО -->
                        <div>
                            <label for="full_name" class="block mb-1 text-black dark:text-white">ФИО:</label>
                            <input type="text" id="full_name" name="full_name"
                                value="{{ old('full_name', $deliveryDetails->full_name ?? '') }}"
                                class="w-full px-3 py-2 bg-gray-100 dark:bg-transparent border border-gray-300 dark:border-gray-600 rounded-md text-black dark:text-white placeholder-gray-400 dark:placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-green-400 dark:focus:ring-green-500 transition-all"
                                placeholder="Введите ваше полное имя">
                        </div>

                        <!-- Город -->
                        <div>
                            <label for="city" class="block mb-1 text-black dark:text-white">Город:</label>
                            <input type="text" id="city" name="city"
                                value="{{ old('city', $deliveryDetails->city ?? '') }}"
                                class="w-full px-3 py-2 bg-gray-100 dark:bg-transparent border border-gray-300 dark:border-gray-600 rounded-md text-black dark:text-white placeholder-gray-400 dark:placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-green-400 dark:focus:ring-green-500 transition-all"
                                placeholder="Ваш город">
                        </div>

                        <!-- Адрес -->
                        <div>
                            <label for="address" class="block mb-1 text-black dark:text-white">Адрес:</label>
                            <input type="text" id="address" name="address"
                                value="{{ old('address', $deliveryDetails->address ?? '') }}"
                                class="w-full px-3 py-2 bg-gray-100 dark:bg-transparent border border-gray-300 dark:border-gray-600 rounded-md text-black dark:text-white placeholder-gray-400 dark:placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-green-400 dark:focus:ring-green-500 transition-all"
                                placeholder="Улица, дом">
                        </div>

                        <!-- Квартира (необязательная) -->
                        <div>
                            <label for="apartment" class="block mb-1 text-black dark:text-white">Квартира (если
                                есть):</label>
                            <input type="text" id="apartment" name="apartment"
                                value="{{ old('apartment', $deliveryDetails->apartment ?? '') }}"
                                class="w-full px-3 py-2 bg-gray-100 dark:bg-transparent border border-gray-300 dark:border-gray-600 rounded-md text-black dark:text-white placeholder-gray-400 dark:placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-green-400 dark:focus:ring-green-500 transition-all"
                                placeholder="Квартира, подъезд и т.д.">
                        </div>

                        <!-- Почтовый индекс -->
                        <div>
                            <label for="postal_code" class="block mb-1 text-black dark:text-white">Почтовый
                                индекс:</label>
                            <input type="text" id="postal_code" name="postal_code" maxlength="6"
                                value="{{ old('postal_code', $deliveryDetails->postal_code ?? '') }}"
                                class="w-full px-3 py-2 bg-gray-100 dark:bg-transparent border border-gray-300 dark:border-gray-600 rounded-md text-black dark:text-white placeholder-gray-400 dark:placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-green-400 dark:focus:ring-green-500 transition-all"
                                placeholder="Например, 123456">
                        </div>

                        <!-- Телефон -->
                        <div>
                            <label for="phone" class="block mb-1 text-black dark:text-white">Телефон:</label>
                            <input type="tel" id="phone" name="phone"
                                value="{{ old('phone', $deliveryDetails->phone ?? '') }}"
                                class="w-full px-3 py-2 bg-gray-100 dark:bg-transparent border border-gray-300 dark:border-gray-600 rounded-md text-black dark:text-white placeholder-gray-400 dark:placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-green-400 dark:focus:ring-green-500 transition-all"
                                placeholder="+7 (___) ___-__-__">
                        </div>
                    </div>

                    <!-- Кнопка отправки -->
                    <button type="submit"
                        class="w-full py-2 bg-green-500 font-semibold dark:text-black/90 text-white rounded-md transition-all hover:bg-green-600 dark:hover:bg-green-400">
                        Оформить заказ
                    </button>
                </form>
            </div>
        @endif
    </section>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script>
        $(document).ready(function() {
            $("[type='tel']").mask('+7 (999) 999-99-99');
        });

        const openOrderInput = () => {
            const form = document.getElementById('orderForm');
            form.classList.remove('hidden');
        }

        const toggleDeliveryDetails = () => {
            const deliverySelect = document.getElementById('deliveryMethod');
            const deliveryDetails = document.getElementById('deliveryDetails');
            if (deliverySelect.value === 'delivery') {
                deliveryDetails.classList.remove('hidden');
            } else {
                deliveryDetails.classList.add('hidden');
            }
        }
    </script>
@endsection
