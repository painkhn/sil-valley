<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /** @use HasFactory<\Database\Factories\OrderFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'delivery_method',
        'status',
        'payment_method',
        'comment'
    ];

    /**
     * Связь с моделью User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Связь с моделью OrderItem
     */
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Связь с моделью OrderDeliveryDetail
     */
    public function deliveryDetail()
    {
        return $this->hasOne(OrderDeliveryDetail::class);
    }
}
