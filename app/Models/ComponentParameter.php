<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ComponentParameter extends Model
{
    protected $fillable = ['component_id', 'parameter_value_id'];

    /**
     * Связь с компонентом
     *
     */
    public function component()
    {
        return $this->belongsTo(Component::class);
    }

    /**
     * Связь с параметром значения
     *
     */
    public function parameterValue()
    {
        return $this->belongsTo(ParameterValue::class);
    }
}
