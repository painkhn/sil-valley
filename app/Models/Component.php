<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Component extends Model
{
    /** @use HasFactory<\Database\Factories\ComponentFactory> */
    use HasFactory;

    protected $fillable = ['name', 'type'];

    /**
     * Связь с таблицей component_parameters (много к многим)
     *
     */
    public function parameters()
    {
        return $this->belongsToMany(ParameterValue::class, 'component_parameters');
    }

    /**
     * Связь с таблицей computer_component (много к многим)
     *
     */
    public function computers()
    {
        return $this->belongsToMany(Computer::class, 'computer_component');
    }
}
