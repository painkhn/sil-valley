<?php

namespace App\Http\Controllers;

use App\Models\{
    ParameterValue,
    Computer,
    Component,
    Parameter,
    ComponentParameter
};
use App\Http\Requests\Computer\{
    UpdateComputerRequest,
    StoreComputerRequest
};

class ComputerController extends Controller
{
    /**
     * Отображение списка всех компов
     */
    public function index()
    {
        $videocards = [
            ['title' => 'GeForce RTX 2060 SUPER'],
            ['title' => 'GeForce RTX 2080 TI'],
            ['title' => 'AMD Radeon RX 7800'],
            ['title' => 'AMD Radeon RX 7600'],
        ];
        $cpus = [
            ['title' => 'Intel Core i5 5600'],
            ['title' => 'Intel Core i7 7700'],
            ['title' => 'AMD Ryzen 5 3600'],
            ['title' => 'AMD Ryzen 5 5600'],
        ];
        $ram = [
            ['value' => '8 ГБ'],
            ['value' => '16 ГБ'],
            ['value' => '32 ГБ'],
            ['value' => '64 ГБ'],
        ];

        $pc_list = Computer::with('components')->get();

        return view('shop.index', compact('videocards', 'cpus', 'ram', 'pc_list'));
    }

    /**
     * Отображение одного компа
     */
    public function show(Computer $computer)
    {
        return view('product.index', compact('computer'));
    }

    /**
     * Отображение страницы добавления компа
     */
    public function create()
    {
        return view('admin.computer.create');
    }

    /**
     * Добавление компьютера
     */
    public function store(StoreComputerRequest $request)
    {
        $computer = Computer::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $request->file('image') ? $request->file('image')->store('images', 'public') : null,
        ]);

        foreach ($request->components as $componentType => $componentData) {
            $component = Component::create([
                'name' => $componentData['name'],
                'type' => strtoupper($componentType),
            ]);

            foreach ($componentData as $parameterKey => $parameterValue) {
                if ($parameterKey !== 'name') {
                    $parameter = Parameter::firstOrCreate(['name' => $parameterKey]);

                    $paramValue = ParameterValue::firstOrCreate([
                        'parameter_id' => $parameter->id,
                        'value' => $parameterValue,
                    ]);

                    ComponentParameter::create([
                        'component_id' => $component->id,
                        'parameter_value_id' => $paramValue->id,
                    ]);
                }
            }

            $computer->components()->attach($component->id);
        }

        return redirect()->route('admin.computer.create')->with('success', 'Компьютер успешно добавлен!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Computer $computer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateComputerRequest $request, Computer $computer)
    {
        //
    }

    /**
     * Удаление компьютера
     */
    public function destroy(Computer $computer)
    {
        $computer->delete();

        return redirect()->back()->with('success', 'Компьютер успешно удалён');
    }

    /**
     * Восстановление компьютера
     */
    public function restore(Computer $computer)
    {
        $computer->restore();

        return redirect()->back()->with('success', 'Компьютер успешно восстановлен');
    }
}
