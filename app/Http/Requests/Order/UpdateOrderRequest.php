<?php

namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOrderRequest extends FormRequest
{
    /**
     * Можно ли выполнить этот запрос
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Правила валидацииПравила валидации
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'status' => 'required|in:pending,completed',
        ];
    }
}
