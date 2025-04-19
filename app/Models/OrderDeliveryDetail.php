<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDeliveryDetail extends Model
{
    /** @use HasFactory<\Database\Factories\OrderDeliveryDetailFactory> */
    use HasFactory;

    protected $fillable = [
        'full_name',
        'order_id',
        'city',
        'address',
        'postal_code',
        'apartment',
        'phone'
    ];

    /**
     * Связь с моделью Order
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
