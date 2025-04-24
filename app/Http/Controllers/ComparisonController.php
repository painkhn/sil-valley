<?php

namespace App\Http\Controllers;

use App\Models\Comparison;
use App\Http\Requests\Comparison\StoreComparisonRequest;
use Illuminate\Support\Facades\{DB, Auth};

class ComparisonController extends Controller
{
    /**
     * Добавление для сравнения
     */
    public function store(StoreComparisonRequest $request)
    {
        $user = Auth::user(); // Получаем пользователя

        // Получаем товары в сравнениие
        $comparison = Comparison::firstOrCreate([
            'user_id' => $user->id,
        ]);

        // Проверяем, есть ли этот товар уже в сравнении
        $alreadyExists = $comparison->items()
            ->where('computer_id', $request->computer)
            ->exists();

        // Если нет, то добавляем
        if (!$alreadyExists) {
            $comparison->items()->create([
                'computer_id' => $request->computer,
            ]);
        }

        return redirect()->back()->with('success', 'Компьютер добавлен к сравнению');
    }

    /**
     * Отображение списка сравнения
     */
    public function show()
    {
        // Получаем компьютеры, которые добавлены в сравнение
        $comparison = Comparison::with([
            'computers.components.parameters.parameter'
        ])->where('user_id', Auth::id())->first();

        $computers = $comparison ? $comparison->computers : collect(); // Проверяем, есть ли они

        return view('comparison.index', compact('computers'));
    }
}
