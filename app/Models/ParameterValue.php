<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParameterValue extends Model
{
    /** @use HasFactory<\Database\Factories\ParameterValueFactory> */
    use HasFactory;

    protected $fillable = ['value', 'parameter_id'];

    /**
     * Связь с параметром
     *
     */
    public function parameter()
    {
        return $this->belongsTo(Parameter::class);
    }

    /**
     * Связь с компонентом через component_parameters (много к многим)
     *
     */
    public function components()
    {
        return $this->belongsToMany(Component::class, 'component_parameters');
    }
}
