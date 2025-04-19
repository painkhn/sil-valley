@extends('layouts.app')

@section('content')
    <section class="w-full space-y-8">
        <h1 class="text-2xl font-bold text-black dark:text-white">Управление заказами</h1>

        @forelse ($orders as $order)
            <div
                class="overflow-x-auto bg-white dark:bg-white/5 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm p-4">
                <table class="w-full text-sm text-left text-gray-700 dark:text-gray-200">
                    <thead class="text-xs text-gray-700 uppercase dark:text-gray-300 border-b dark:border-gray-600">
                        <tr>
                            <th class="px-4 py-2">ID заказа</th>
                            <th class="px-4 py-2">Статус</th>
                            <th class="px-4 py-2">Оплата</th>
                            <th class="px-4 py-2">Доставка</th>
                            <th class="px-4 py-2">Позиции</th>
                            <th class="px-4 py-2">Данные доставки</th>
                            <th class="px-4 py-2 text-right">Итого</th>
                            <th class="px-4 py-2 text-center">Действия</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b dark:border-gray-600">
                            <td class="px-4 py-3 font-medium">#{{ $order->id }}</td>
                            <td class="px-4 py-3">
                                <span class="font-semibold">
                                    {{ $order->status === 'pending' ? 'В обработке' : 'Завершён' }}
                                </span>
                            </td>
                            <td class="px-4 py-3">{{ $order->payment_method === 'cash' ? 'Наличными' : 'Картой' }}</td>
                            <td class="px-4 py-3">{{ $order->delivery_method === 'delivery' ? 'Доставка' : 'Самовывоз' }}
                            </td>
                            <td class="px-4 py-3">
                                @foreach ($order->items as $item)
                                    <div class="mb-2">
                                        <div class="font-semibold">{{ $item->computer->name }} (x{{ $item->quantity }})
                                        </div>
                                        <div class="text-gray-500 dark:text-gray-400">{{ $item->computer->description }}
                                        </div>
                                        <div>{{ number_format($item->price, 0, ',', ' ') }} ₽</div>
                                    </div>
                                @endforeach
                            </td>
                            <td class="px-4 py-3">
                                @if ($order->delivery_method === 'delivery' && $order->deliveryDetail)
                                    <div class="space-y-1">
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
                                @else
                                    <span class="text-gray-500">-</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-right text-green-600 dark:text-green-400 font-semibold">
                                {{ number_format($order->items->sum('price'), 0, ',', ' ') }} ₽
                            </td>
                            <td class="px-4 py-3 text-center space-y-2">
                                @if ($order->status === 'pending')
                                    <form method="POST" action="{{ route('admin.orders.update', $order->id) }}">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="completed">
                                        <button type="submit"
                                            class="bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700 text-xs">
                                            Завершить
                                        </button>
                                    </form>
                                @elseif ($order->status === 'completed')
                                    <form method="POST" action="{{ route('admin.orders.update', $order->id) }}">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="pending">
                                        <button type="submit"
                                            class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600 text-xs">
                                            Вернуть в обработку
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        @empty
            <p class="text-gray-500 dark:text-gray-400">Нет доступных заказов.</p>
        @endforelse

        <div class="mt-6">
            {{ $orders->links() }}
        </div>
    </section>
@endsection
