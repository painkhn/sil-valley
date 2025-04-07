<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comparison extends Model
{
    /** @use HasFactory<\Database\Factories\ComparisonFactory> */
    use HasFactory;

    protected $fillable = ['user_id'];

    /**
     * Связь с пользователем
     *
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Связь с компьютерами через comparison_items
     *
     */
    public function computers()
    {
        return $this->belongsToMany(Computer::class, 'comparison_items');
    }
}
