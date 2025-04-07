<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComparisonItem extends Model
{
    /** @use HasFactory<\Database\Factories\ComparisonItemFactory> */
    use HasFactory;

    protected $fillable = ['comparison_id', 'computer_id'];

    /**
     * Связь с сравнением
     *
     */
    public function comparison()
    {
        return $this->belongsTo(Comparison::class);
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
