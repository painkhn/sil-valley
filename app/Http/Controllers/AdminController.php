<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Computer;

class AdminController extends Controller
{
    /*
    * Отображение страницы администратора
    */
    public function index() {
        $pc_list = Computer::withTrashed()->with('components')->get();
        return view('admin.index', compact('pc_list'));
    }
}
