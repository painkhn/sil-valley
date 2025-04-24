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
        // Получаем все доступные видеокарты и процессоры для фильтра
        $videocards = Component::where('type', 'GPU')->select('name as title')->distinct()->get()->toArray();
        $cpus = Component::where('type', 'CPU')->select('name as title')->distinct()->get()->toArray();

        // Создаём базовый запрос с подгрузкой компонентов
        $query = Computer::with('components');

        // Фильтрация по названию
        if ($request->filled('title')) {
            $query->where('name', 'like', '%' . $request->input('title') . '%');
        }

        // Фильтрация по видеокарте
        if ($request->filled('videocard')) {
            $query->whereHas('components', function ($query) use ($request) {
                $query->where('name', $request->input('videocard'))->where('type', 'GPU');
            });
        }

        // Фильтрация по процессору
        if ($request->filled('cpu')) {
            $query->whereHas('components', function ($query) use ($request) {
                $query->where('name', $request->input('cpu'))->where('type', 'CPU');
            });
        }

        // Фильтрация по минимальной цене
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->input('min_price'));
        }

        // Фильтрация по максимальной цене
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->input('max_price'));
        }

        $pc_list = $query->get(); // Выполняем запрос
        $maxPrice = Computer::max('price') ?? 100000; // Максимальная цена для фильтра

        return view('shop.index', compact('videocards', 'cpus', 'pc_list', 'maxPrice'));
    }


    /**
     * Отображение одного компа
     */
    public function show(Computer $computer)
    {
        // Если компьютер удален и роль не админ, то 404
        if ($computer->trashed() && !(auth()->check() && auth()->user()->role == 'admin')) {
            abort(404);
        }

        $isFavorite = false;

        // Проверяем, в избранном ли оно
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
        // Создаем запись в бд
        $computer = Computer::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $request->file('image') ? $request->file('image')->store('images', 'public') : null,
        ]);


        // Обрабатываем каждый компонент (CPU, GPU и т.д.)
        foreach ($request->components as $componentType => $componentData) {
            $component = Component::create([
                'name' => $componentData['name'],
                'type' => strtoupper($componentType),
            ]);

            // Добавляем параметры компонента
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

            // Привязываем компонент к компьютеру
            $computer->components()->attach($component->id);
        }

        return redirect()->route('admin.computer.create')->with('success', 'Компьютер успешно добавлен!');
    }

    /**
     * Открытие страницы редактирования компьютера
     */
    public function edit(Computer $computer)
    {
        $computer->load('components.parameters.parameter'); // Получаем параметры компьютера

        // записываем в массив
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
        // Обновляем данные о пк
        $computer->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $request->file('image')
                ? $request->file('image')->store('images', 'public')
                : $computer->image,
        ]);

        // Олновляем информацию о пк
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
        $computer->delete(); // Удаляем компьютер

        return redirect()->back()->with('success', 'Компьютер успешно удалён');
    }

    /**
     * Восстановление компьютера
     */
    public function restore(Computer $computer)
    {
        $computer->restore(); // Восстанавливаем компьютер

        return redirect()->back()->with('success', 'Компьютер успешно восстановлен');
    }
}
