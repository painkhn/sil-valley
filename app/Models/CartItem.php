<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    /** @use HasFactory<\Database\Factories\CartItemFactory> */
    use HasFactory;

    protected $fillable = ['cart_id', 'computer_id', 'quantity'];

    /**
     * Связь с корзиной
     *
     */
    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    /**
     * Связь с товаром
     *
     */
    public function computer()
    {
        return $this->belongsTo(Computer::class);
    }
}
