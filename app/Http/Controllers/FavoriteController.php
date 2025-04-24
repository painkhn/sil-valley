<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Http\Requests\StoreFavoriteRequest;
use App\Http\Requests\UpdateFavoriteRequest;
use App\Models\Computer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{DB, Auth};

class FavoriteController extends Controller
{
    /**
     * Добавление/удаление из избранного
     */
    public function store(Computer $computer)
    {
        $user = auth()->user(); // Получаем пользователя

        // Получаем избранные
        $favorite = $user->favorites()->where('computer_id', $computer->id)->first();


        if ($favorite) { // Если уже в избранном, то удаляем
            $favorite->delete();
            return redirect()->back()->with('success', 'Товар удалён из избранного');
        } else {
            // Добавляем в избранное
            Favorite::create([
                'user_id' => $user->id,
                'computer_id' => $computer->id,
            ]);
            return redirect()->back()->with('success', 'Товар добавлен в избранное');
        }
    }

    /**
     * Отображение страницы избранных
     */
    public function show()
    {
        // Получаем избранные, которые не удалены
        $favorite = Favorite::whereHas('computer', function ($query) {
            $query->whereNull('deleted_at');
        })->with('computer')->where('user_id', Auth::id())->get();

        $isFavorite = true;

        return view('favourite.index', compact('favorite', 'isFavorite'));
    }

    /**
     * Удаление всех товаров из избранного
     */
    public function clear()
    {
        // Получаем и удаляем все товары из избранного
        Favorite::where('user_id', Auth::id())->delete();
        $favorite = Favorite::whereHas('computer', function ($query) {
            $query->whereNull('deleted_at');
        })->with('computer')->where('user_id', Auth::id())->get();

        return view('favourite.index', compact('favorite'));
    }
}
