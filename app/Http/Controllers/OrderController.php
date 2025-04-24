<?php

namespace App\Http\Controllers;

use App\Models\{Cart, Computer, OrderDeliveryDetail, OrderItem, Order};
use Illuminate\Support\Facades\{DB, Auth};
use Illuminate\Http\Request;
use App\Http\Requests\Order\{StoreOrderRequest, UpdateOrderRequest};

class OrderController extends Controller
{
    /**
     * Отображение заказов пользователя
     */
    public function index()
    {
        // Получаем заказ пользователя
        $orders = Order::with(['items.computer', 'deliveryDetail'])->where('user_id', auth()->id())->latest()->get();
        return view('profile.orders', compact('orders'));
    }

    /**
     * Создание заказа
     */
    public function store(StoreOrderRequest $request)
    {
        // Если выбран метод доставка, то валидируем данные
        if ($request->deliveryMethod === 'delivery') {
            $request->validate([
                'full_name' => 'required|string|max:255',
                'city' => 'required|string|max:255',
                'address' => 'required|string|max:255',
                'postal_code' => 'required|digits:6',
                'phone' => 'required|digits_between:10,15',
            ]);
        }

        $user = Auth::user(); // Получаем пользователя

        $cart = Cart::with('items.computer')->where('user_id', $user->id)->first(); // Получаем корщину

        // Если корзина пуста, возвращаем уведомление об ошибке
        if (!$cart || $cart->items->isEmpty()) {
            return back()->with('error', 'Корзина пуста');
        }

        DB::beginTransaction(); // Начало транзакции

        try {
            // Создаем заказ
            $order = Order::create([
                'user_id' => $user->id,
                'delivery_method' => $request->deliveryMethod,
                'payment_method' => $request->paymentMethod === 'card' ? 'non-cash' : 'cash',
                'comment' => $request->comment,
            ]);

            // Получаем данные из корзины и переносим в заказ
            foreach ($cart->items as $item) {
                $computer = $item->computer;

                if (!$computer) continue;

                $quantity = $item->quantity;
                $pricePerItem = $computer->price;

                // Учитывая скидку
                $finalPricePerItem = $quantity >= 3 ? $pricePerItem * 0.9 : $pricePerItem;

                // Заносим данные в заказ
                OrderItem::create([
                    'order_id' => $order->id,
                    'computer_id' => $computer->id,
                    'quantity' => $quantity,
                    'price' => round($finalPricePerItem * $quantity),
                ]);
            }

            // Если доставка, то сохраняем данные о доставке
            if ($request->deliveryMethod === 'delivery') {
                OrderDeliveryDetail::create([
                    'order_id' => $order->id,
                    'full_name' => $request->full_name,
                    'city' => $request->city,
                    'address' => $request->address,
                    'postal_code' => $request->postal_code,
                    'apartment' => $request->apartment,
                    'phone' => $request->phone,
                ]);
            }

            $cart->items()->delete(); // Удаляем данные из корзины

            DB::commit(); // Сохраняем изменения

            return redirect()->route('profile.orders')->with('success', 'Заказ успешно оформлен!');
        } catch (\Throwable $e) {
            // Если ошибка, то отменяем изменения
            DB::rollBack();
            report($e);
            return back()->with('error', 'Произошла ошибка при оформлении заказа.');
        }
    }

    /**
     * Обновление статуса заказа
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        // Обновляем статус
        $order->status = $request->validated()['status'];
        $order->save(); // Сохраняем

        // Возвращаем назад с сообщение о обновлении статуса
        return redirect()->back()->with('success', 'Статус заказа обновлён');
    }
}
