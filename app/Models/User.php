<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Атрибуты, которые можно массово назначить
     *
     */
    protected $fillable = [
        'name',
        'email',
        'provider',
        'role',
        'password',
    ];

    /**
     * Атрибуты, которые необходимо скрыть
     *
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Получить все избранные товары пользователя
     *
     */
    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    /**
     * Получить корзину пользователя
     *
     */
    public function cart()
    {
        return $this->hasOne(Cart::class);
    }

    /**
     * Получить все сравнения пользователя
     *
     */
    public function comparisons()
    {
        return $this->hasMany(Comparison::class);
    }

    /**
     * Приведение атрибутов к нужному виду
     *
     */
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }
}
