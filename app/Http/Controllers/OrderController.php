<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Computer;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderDeliveryDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreOrderRequest;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Создание заказа
     */
    public function store(StoreOrderRequest $request)
    {
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

            return redirect()->route('profile.index')->with('success', 'Заказ успешно оформлен!');
        } catch (\Throwable $e) {
            DB::rollBack();
            report($e);
            return back()->with('error', 'Произошла ошибка при оформлении заказа.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
