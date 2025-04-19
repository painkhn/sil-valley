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
        $orders = Order::with(['items.computer', 'deliveryDetail'])->where('user_id', auth()->id())->latest()->get();
        return view('profile.orders', compact('orders'));
    }


    /**
     * Создание заказа
     */
    public function store(StoreOrderRequest $request)
    {
        if ($request->deliveryMethod === 'delivery') {
            $validator->addRules([
                'full_name' => 'required|string|max:255',
                'city' => 'required|string|max:255',
                'address' => 'required|string|max:255',
                'postal_code' => 'required|digits:6',
                'phone' => 'required|digits_between:10,15',
            ]);
        }

        $user = Auth::user();

        $cart = Cart::with('items.computer')->where('user_id', $user->id)->first();

        if (!$cart || $cart->items->isEmpty()) {
            return back()->with('error', 'Корзина пуста');
        }

        DB::beginTransaction();

        try {
            // 1. Заказ
            $order = Order::create([
                'user_id' => $user->id,
                'delivery_method' => $request->deliveryMethod,
                'payment_method' => $request->paymentMethod === 'card' ? 'non-cash' : 'cash',
                'comment' => $request->comment,
            ]);

            // 2. Товары
            foreach ($cart->items as $item) {
                $computer = $item->computer;

                if (!$computer) continue;

                $quantity = $item->quantity;
                $pricePerItem = $computer->price;

                // скидка на 1 товар, если 3+
                $finalPricePerItem = $quantity >= 3 ? $pricePerItem * 0.9 : $pricePerItem;

                OrderItem::create([
                    'order_id' => $order->id,
                    'computer_id' => $computer->id,
                    'quantity' => $quantity,
                    'price' => round($finalPricePerItem * $quantity), // Общая цена за этот товар
                ]);
            }

            // 3. Адрес
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

            // 4. Очистить корзину
            $cart->items()->delete();

            DB::commit();

            return redirect()->route('profile.orders')->with('success', 'Заказ успешно оформлен!');
        } catch (\Throwable $e) {
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
        $order->status = $request->validated()['status'];
        $order->save();

        return redirect()->back()->with('success', 'Статус заказа обновлён.');
    }
}
