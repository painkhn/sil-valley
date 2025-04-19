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
use Illuminate\Http\Request;

class ComputerController extends Controller
{
    /**
     * Отображение списка всех компов
     */
    public function index(Request $request)
    {
        $videocards = Component::where('type', 'GPU')->select('name as title')->distinct()->get()->toArray();
        $cpus = Component::where('type', 'CPU')->select('name as title')->distinct()->get()->toArray();
        $query = Computer::with('components');

        if ($request->filled('title')) {
            $query->where('name', 'like', '%' . $request->input('title') . '%');
        }

        if ($request->filled('videocard')) {
            $query->whereHas('components', function ($query) use ($request) {
                $query->where('name', $request->input('videocard'))
                    ->where('type', 'GPU');
            });
        }

        if ($request->filled('cpu')) {
            $query->whereHas('components', function ($query) use ($request) {
                $query->where('name', $request->input('cpu'))
                    ->where('type', 'CPU');
            });
        }

        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->input('min_price'));
        }

        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->input('max_price'));
        }

        $pc_list = $query->get();
        $maxPrice = Computer::max('price') ?? 100000;
        return view('shop.index', compact('videocards', 'cpus', 'pc_list', 'maxPrice'));
    }


    /**
     * Отображение одного компа
     */
    public function show(Computer $computer)
    {
        if ($computer->trashed() && !(auth()->check() && auth()->user()->role == 'admin')) {
            abort(404);
        }

        $isFavorite = false;

        if (auth()->check()) {
            $isFavorite = auth()->user()->favorites()
                ->where('computer_id', $computer->id)
                ->exists();
        }

        return view('product.index', compact('computer', 'isFavorite'));
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
     * Открытие страницы редактирования компьютера
     */
    public function edit(Computer $computer)
    {
        $computer->load('components.parameters.parameter');

        $components = $computer->components->mapWithKeys(function ($component) {
            $data = [
                'name' => $component->name,
            ];

            $params = $component->parameters->mapWithKeys(function ($param) {
                return [$param->parameter->name => $param->value];
            });

            return [$component->type => array_merge($data, $params->toArray())];
        });

        return view('admin.computer.edit', [
            'computer' => $computer,
            'components' => $components,
        ]);
    }


    /**
     * Обновление информации о компьютере
     */
    public function update(UpdateComputerRequest $request, Computer $computer)
    {
        $computer->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $request->file('image')
                ? $request->file('image')->store('images', 'public')
                : $computer->image,
        ]);

        $computer->components()->detach();
        foreach ($request->components as $componentType => $componentData) {
            $component = Component::updateOrCreate(
                [
                    'name' => $componentData['name'],
                    'type' => strtoupper($componentType),
                ],
                [
                    'name' => $componentData['name'],
                    'type' => strtoupper($componentType),
                ]
            );

            ComponentParameter::where('component_id', $component->id)->delete();

            foreach ($componentData as $paramKey => $paramValue) {
                if ($paramKey === 'name') continue;

                $parameter = Parameter::firstOrCreate(['name' => $paramKey]);
                $parameterValue = ParameterValue::firstOrCreate([
                    'parameter_id' => $parameter->id,
                    'value' => $paramValue,
                ]);

                ComponentParameter::create([
                    'component_id' => $component->id,
                    'parameter_value_id' => $parameterValue->id,
                ]);
            }

            $computer->components()->syncWithoutDetaching([$component->id]);
        }

        return redirect()->back()->with('success', 'Информация о компьютере успешно обновлена!');
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
