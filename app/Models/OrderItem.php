<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    /** @use HasFactory<\Database\Factories\OrderItemFactory> */
    use HasFactory;

    protected $fillable = [
        'order_id',
        'computer_id',
        'quantity',
        'price'
    ];

    /**
     * Связь с моделью Order
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Связь с моделью Computer
     */
    public function computer()
    {
        return $this->belongsTo(Computer::class)->withTrashed();
    }
}
