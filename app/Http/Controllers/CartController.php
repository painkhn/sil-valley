<?php

namespace App\Http\Controllers;

use App\Models\{Cart, CartItem};
use App\Http\Requests\Cart\StoreCartItemRequest;
use App\Models\Computer;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Добавление в корзину
     */
    public function store(StoreCartItemRequest $request)
    {
        $cart = Cart::firstOrCreate([
            'user_id' => Auth::id(),
        ]);

        $computerId = $request->input('computer');
        $cartItem = CartItem::where('cart_id', $cart->id)
            ->where('computer_id', $computerId)
            ->first();

        if ($cartItem) {
            $cartItem->increment('quantity');
        } else {
            CartItem::create([
                'cart_id' => $cart->id,
                'computer_id' => $computerId,
                'quantity' => 1,
            ]);
        }

        return redirect()->back()->with('success', 'Товар успешно добавлен в корзину');
    }

    /**
     *  Отображение страницы корзины
     */
    public function show()
    {
        $cart = Cart::with(['items.computer'])->where('user_id', Auth::id())->first();

        if (!$cart || $cart->items->isEmpty()) {
            return $this->emptyCartView();
        }

        $computers = [];
        $totalQuantity = 0;
        $totalPrice = 0;
        $discountAmount = 0;

        foreach ($cart->items as $item) {
            $computerObj = $this->processCartItem($item);
            if (!$computerObj) continue;

            $computers[] = $computerObj;
            $totalQuantity += $computerObj->quantity;
            $totalPrice += $computerObj->sum;
            $discountAmount += $computerObj->discount;
        }

        $finalPrice = $totalPrice - $discountAmount;
        $discountPercent = $totalPrice > 0 ? round(($discountAmount / $totalPrice) * 100) : 0;

        return view('cart.index', compact(
            'computers',
            'totalQuantity',
            'totalPrice',
            'discountAmount',
            'discountPercent',
            'finalPrice'
        ));
    }

    private function processCartItem($item): ?object
    {
        $computer = $item->computer;
        if (!$computer) return null;

        $quantity = $item->quantity;
        $pricePerOne = $computer->price;
        $priceForAll = $pricePerOne * $quantity;
        $discount = $quantity >= 3 ? $priceForAll * 0.1 : 0;

        return (object) [
            'id' => $computer->id,
            'name' => $computer->name,
            'price' => $pricePerOne,
            'image' => $computer->image,
            'quantity' => $quantity,
            'sum' => $priceForAll,
            'discount' => $discount,
            'final' => $priceForAll - $discount,
        ];
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCartRequest $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cart $cart)
    {
        //
    }
}
