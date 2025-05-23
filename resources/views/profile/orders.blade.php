@extends('layouts.app')

@section('content')
    <section class="w-full space-y-8">
        <h1 class="text-2xl font-semibold text-black dark:text-white text-center">Мои заказы</h1>

        <ul class="max-w-6xl w-full mx-auto grid grid-cols-1 gap-5">
            @forelse ($orders as $order)
                <li>
                    <div
                        class="border border-gray-300 dark:border-gray-600 p-4 rounded-md shadow-sm space-y-3 bg-white dark:bg-white/5">
                        <div class="flex justify-between items-center">
                            <h2 class="text-lg font-semibold dark:text-white text-black">Заказ #{{ $order->id }}</h2>
                            <span class="text-sm text-gray-500">
                                Статус:
                                <strong>
                                    {{ $order->status === 'pending' ? 'В обработке' : 'Завершён' }}
                                </strong>
                            </span>

                        </div>

                        <p class="text-sm text-gray-600 dark:text-gray-300">Оплата:
                            {{ $order->payment_method === 'cash' ? 'Наличными' : 'Картой' }}</p>
                        <p class="text-sm text-gray-600 dark:text-gray-300">Доставка:
                            {{ $order->delivery_method === 'delivery' ? 'Доставка' : 'Самовывоз' }}</p>

                        <div class="mt-4 space-y-2">
                            @foreach ($order->items as $item)
                                <div
                                    class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 border-b border-gray-200 dark:border-gray-700 pb-4 mb-4">
                                    <div class="flex items-start gap-4 w-[80%]">
                                        <img src={{ asset('storage/' . $item->computer->image) }}
                                            alt="{{ $item->computer->name }}"
                                            class="w-24 h-24 object-cover rounded-md border dark:border-gray-600">

                                        <div>
                                            <div class="flex items-center justify-between">
                                                <p class="text-lg font-semibold text-black dark:text-white">
                                                    {{ $item->computer->name }}</p>
                                                <p
                                                    class="text-lg font-semibold text-black dark:text-white min-[640px]:hidden">
                                                    {{ number_format($item->price, 0, ',', ' ') }} ₽
                                                </p>
                                            </div>
                                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                                {{ $item->computer->description }}
                                            </p>
                                            <p class="text-sm text-gray-600 dark:text-gray-300 mt-1">Количество:
                                                x{{ $item->quantity }}</p>
                                        </div>
                                    </div>

                                    <div class="text-right w-[20%] max-[640px]:hidden">
                                        <p class="text-sm font-semibold text-black dark:text-white">
                                            {{ number_format($item->price, 0, ',', ' ') }} ₽
                                        </p>
                                    </div>
                                </div>
                            @endforeach

                        </div>

                        @php
                            $total = $order->items->sum('price');
                        @endphp

                        @if ($order->delivery_method === 'delivery' && $order->deliveryDetail)
                            <details class="text-sm text-gray-700 dark:text-gray-200 mt-2">
                                <summary class="cursor-pointer hover:underline text-blue-600 dark:text-blue-400">
                                    Данные доставки
                                </summary>
                                <div class="mt-2 space-y-1">
                                    <p>ФИО: {{ $order->deliveryDetail->full_name }}</p>
                                    <p>Город: {{ $order->deliveryDetail->city }}</p>
                                    <p>Адрес:
                                        {{ $order->deliveryDetail->address }}{{ $order->deliveryDetail->apartment ? ', кв. ' . $order->deliveryDetail->apartment : '' }}
                                    </p>
                                    <p>Индекс: {{ $order->deliveryDetail->postal_code }}</p>
                                    @php
                                        $phone = $order->deliveryDetail->phone;
                                        $formattedPhone = preg_replace(
                                            '/^(\d)(\d{3})(\d{3})(\d{2})(\d{2})$/',
                                            '+$1 ($2) $3-$4-$5',
                                            $phone,
                                        );
                                    @endphp
                                    <p>Телефон: {{ $formattedPhone }}</p>
                                </div>
                            </details>
                        @endif

                        <div class="text-right text-green-600 dark:text-green-400 font-semibold">
                            Итого: {{ number_format($total, 0, ',', ' ') }} ₽
                        </div>
                    </div>
                @empty
                    <section class="max-w-6xl w-full mx-auto space-y-10">
                        <div class="text-center text-gray-600 dark:text-gray-300 space-y-4">
                            <p class="text-lg">Заказов не найдено</p>
                        </div>
                    </section>
                </li>
            @endforelse
        </ul>
    </section>
@endsection
