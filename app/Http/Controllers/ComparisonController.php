<?php

namespace App\Http\Controllers;

use App\Models\Comparison;
use App\Http\Requests\Comparison\StoreComparisonRequest;
use Illuminate\Support\Facades\{DB, Auth};

class ComparisonController extends Controller
{
    /**
     * Добавлени е для сравнения
     */
    public function store(StoreComparisonRequest $request)
    {
        $user = Auth::user();

        $comparison = Comparison::firstOrCreate([
            'user_id' => $user->id,
        ]);

        $alreadyExists = $comparison->items()
            ->where('computer_id', $request->computer)
            ->exists();

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
        $comparison = Comparison::with([
            'computers.components.parameters.parameter' // жёсткая загрузка
        ])->where('user_id', Auth::id())->first();

        // Только если выбрано ровно 2 компьютера
        // if (!$comparison || $comparison->computers->count() !== 2) {
        //     return redirect()->back()->with('error', 'Выберите ровно 2 компьютера для сравнения.');
        // }

        $computers = $comparison->computers;

        return view('comparison.index', compact('computers'));
    }

}
