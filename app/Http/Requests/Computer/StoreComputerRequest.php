<?php

namespace App\Http\Requests\Computer;

use Illuminate\Foundation\Http\FormRequest;

class StoreComputerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',

            // Правила для компонентов
            'components' => 'required|array',
            'components.cpu' => 'nullable|array',
            'components.cpu.name' => 'nullable|string|max:255',
            'components.cpu.cores' => 'nullable|integer|min:1',
            'components.cpu.threads' => 'nullable|integer|min:1',
            'components.cpu.base_clock' => 'nullable|numeric|min:0',

            'components.ram' => 'nullable|array',
            'components.ram.name' => 'nullable|string|max:255',
            'components.ram.capacity' => 'nullable|numeric|min:1',
            'components.ram.speed' => 'nullable|numeric|min:1',

            'components.gpu' => 'nullable|array',
            'components.gpu.name' => 'nullable|string|max:255',
            'components.gpu.memory' => 'nullable|numeric|min:1',
            'components.gpu.clock' => 'nullable|numeric|min:1',

            'components.storage' => 'nullable|array',
            'components.storage.name' => 'nullable|string|max:255',
            'components.storage.capacity' => 'nullable|numeric|min:1',
            'components.storage.type' => 'nullable|in:HDD,SSD',

            'components.motherboard' => 'nullable|array',
            'components.motherboard.name' => 'nullable|string|max:255',
            'components.motherboard.chipset' => 'nullable|string|max:255',
            'components.motherboard.form_factor' => 'nullable|string|max:255',

            'components.psu' => 'nullable|array',
            'components.psu.name' => 'nullable|string|max:255',
            'components.psu.wattage' => 'nullable|numeric|min:1',
            'components.psu.efficiency' => 'nullable|numeric|min:1',

            'components.case' => 'nullable|array',
            'components.case.name' => 'nullable|string|max:255',
            'components.case.form_factor' => 'nullable|string|max:255',
        ];
    }

    // /**
    //  * Get custom attributes for validator errors.
    //  *
    //  * @return array
    //  */
    // public function attributes()
    // {
    //     return [
    //         'components.cpu.name' => 'название процессора',
    //         'components.cpu.cores' => 'ядра процессора',
    //         'components.cpu.threads' => 'потоки процессора',
    //         'components.cpu.base_clock' => 'базовая частота процессора',

    //         'components.ram.name' => 'название оперативной памяти',
    //         'components.ram.capacity' => 'объем оперативной памяти',
    //         'components.ram.speed' => 'частота оперативной памяти',

    //         'components.gpu.name' => 'название видеокарты',
    //         'components.gpu.memory' => 'объем памяти видеокарты',
    //         'components.gpu.clock' => 'частота видеокарты',

    //         'components.storage.name' => 'название жесткого диска',
    //         'components.storage.capacity' => 'объем жесткого диска',
    //         'components.storage.type' => 'тип жесткого диска',

    //         'components.motherboard.name' => 'название материнской платы',
    //         'components.motherboard.chipset' => 'чипсет материнской платы',
    //         'components.motherboard.form_factor' => 'форм-фактор материнской платы',

    //         'components.psu.name' => 'название блока питания',
    //         'components.psu.wattage' => 'мощность блока питания',
    //         'components.psu.efficiency' => 'эффективность блока питания',

    //         'components.case.name' => 'название корпуса',
    //         'components.case.form_factor' => 'форм-фактор корпуса',

    //         'components.cooler.name' => 'название системы охлаждения',
    //         'components.cooler.type' => 'тип системы охлаждения',
    //     ];
    // }
}
