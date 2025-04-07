<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    /** @use HasFactory<\Database\Factories\FavoriteFactory> */
    use HasFactory;

    protected $fillable = ['user_id', 'computer_id'];

    /**
     * Связь с пользователем
     *
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Связь с компьютером
     *
     */
    public function computer()
    {
        return $this->belongsTo(Computer::class);
    }
}
