<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Computer;

class AdminController extends Controller
{
    /*
    * Отображение страницы администратора
    */
    public function index(Request $request)
    {
        $query = Computer::withTrashed()->with('components');

        // Поиск по названию
        if ($request->filled('title')) {
            $query->where('name', 'like', '%' . $request->title . '%');
        }

        // Фильтр по статусу
        if ($request->status === 'deleted') {
            $query->onlyTrashed();
        } elseif ($request->status === 'actual') {
            $query->whereNull('deleted_at');
        }

        // Фильтр по цене
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }

        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        // Сортировка
        switch ($request->order) {
            case 'alphabet':
                $query->orderBy('name');
                break;
            case 'asc':
                $query->orderBy('price', 'asc');
                break;
            case 'desc':
                $query->orderBy('price', 'desc');
                break;
        }

        $pc_list = $query->get();
        $maxPrice = Computer::max('price') ?? 100000;
        return view('admin.index', compact('pc_list', 'maxPrice'));
    }
}
