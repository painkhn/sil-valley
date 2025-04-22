<?php

namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
{
    /**
     * Можно ли выполнить этот запрос
     */
    public function authorize(): bool
    {
        return true;
    }

    public function prepareForValidation()
    {
        $this->merge([
            'phone' => preg_replace('/\D+/', '', $this->phone),
            'paymentMethod' => strtolower($this->paymentMethod),
            'deliveryMethod' => strtolower($this->deliveryMethod),
        ]);
    }

    /**
     * Правила валидации
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'comment' => 'nullable|string|max:1000',
            'paymentMethod' => 'required|in:cash,card',
            'deliveryMethod' => 'required|in:pickup,delivery',
        ];
    }
}
