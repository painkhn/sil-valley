<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
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
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'comment' => 'nullable|string|max:1000',
            'paymentMethod' => 'required|in:cash,card',
            'deliveryMethod' => 'required|in:pickup,delivery',

            // Delivery details (только если доставка)
            'full_name' => 'required_if:deliveryMethod,delivery|string|max:255',
            'city' => 'required_if:deliveryMethod,delivery|string|max:255',
            'address' => 'required_if:deliveryMethod,delivery|string|max:255',
            'postal_code' => 'required_if:deliveryMethod,delivery|digits:6',
            'apartment' => 'nullable|string|max:10',
            'phone' => 'required_if:deliveryMethod,delivery|digits_between:10,15',
        ];
    }
}
