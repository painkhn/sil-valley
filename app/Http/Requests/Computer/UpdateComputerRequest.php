<?php

namespace App\Http\Requests\Computer;

use Illuminate\Foundation\Http\FormRequest;

class UpdateComputerRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:500',
            'price' => 'required|numeric|min:0',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',

            // Правила для компонентов
            'components' => 'required|array',
            'components.cpu' => 'required|array',
            'components.cpu.name' => 'required|string|max:255',
            'components.cpu.cores' => 'required|integer|min:1',
            'components.cpu.threads' => 'required|integer|min:1',
            'components.cpu.base_clock' => 'required|numeric|min:0',

            'components.ram' => 'required|array',
            'components.ram.name' => 'required|string|max:255',
            'components.ram.capacity' => 'required|numeric|min:1',
            'components.ram.speed' => 'required|numeric|min:1',

            'components.gpu' => 'required|array',
            'components.gpu.name' => 'required|string|max:255',
            'components.gpu.memory' => 'required|numeric|min:1',
            'components.gpu.clock' => 'required|numeric|min:1',

            'components.storage' => 'required|array',
            'components.storage.name' => 'required|string|max:255',
            'components.storage.capacity' => 'required|numeric|min:1',
            'components.storage.type' => 'required|in:HDD,SSD',

            'components.motherboard' => 'required|array',
            'components.motherboard.name' => 'required|string|max:255',
            'components.motherboard.chipset' => 'required|string|max:255',
            'components.motherboard.form_factor' => 'required|string|max:255',

            'components.psu' => 'required|array',
            'components.psu.name' => 'required|string|max:255',
            'components.psu.wattage' => 'required|numeric|min:1',
            'components.psu.efficiency' => 'required|numeric|min:1',

            'components.case' => 'required|array',
            'components.case.name' => 'required|string|max:255',
            'components.case.form_factor' => 'required|string|max:255',
        ];
    }
}
