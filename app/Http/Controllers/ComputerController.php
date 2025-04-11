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
     * Display a listing of the resource.
     */
    public function show(Computer $computer)
    {
        return view('product.index', compact($computer));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.computer.create');
    }

    /**
     * Store a newly created resource in storage.
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
     * Remove the specified resource from storage.
     */
    public function destroy(Computer $computer)
    {
        //
    }
}
