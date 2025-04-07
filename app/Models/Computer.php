<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Computer extends Model
{
    /** @use HasFactory<\Database\Factories\ComputerFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'description', 'image', 'price'];

    /**
     * Связь с компонентами (много к многим)
     *
     */
    public function components()
    {
        return $this->belongsToMany(Component::class, 'computer_component');
    }

    /**
     * Связь с таблицей избранных (пользователь добавил в избранное)
     *
     */
    public function favorites()
    {
        return $this->belongsToMany(User::class, 'favorites');
    }

    /**
     * Связь с корзиной
     *
     */
    public function cartItems()
    {
        return $this->belongsToMany(Cart::class, 'cart_items');
    }

    /**
     * Связь с таблицей сравнения
     *
     */
    public function comparisons()
    {
        return $this->belongsToMany(Comparison::class, 'comparison_items');
    }
}
