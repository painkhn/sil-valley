<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parameter extends Model
{
    /** @use HasFactory<\Database\Factories\ParameterFactory> */
    use HasFactory;

    protected $fillable = ['name'];

    /**
     * Связь с параметрами значений
     *
     */
    public function values()
    {
        return $this->hasMany(ParameterValue::class);
    }
}
