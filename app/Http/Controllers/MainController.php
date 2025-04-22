<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    /*
    * Отображение главной страницы
    */
    public function index() {
        return view('index');
    }
}
