<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;

class GameController extends Controller
{
    public function index(): View
    {
        return view('admin.games.index', ['games' => config('games')]);
    }
}
