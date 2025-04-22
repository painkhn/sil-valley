<?php

namespace App\Http\Requests\Comparison;

use Illuminate\Foundation\Http\FormRequest;

class StoreComparisonRequest extends FormRequest
{
    /**
     * Можно ли выполнить этот запрос
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Правила валидации
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'computer' => ['required', 'exists:computers,id'],
        ];
    }
}
