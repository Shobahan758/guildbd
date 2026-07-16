<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\GameController as AdminGameController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\OrderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::view('/login', 'auth.login')->name('login');
Route::view('/register', 'auth.register')->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login.store');
Route::post('/register', [AuthController::class, 'register'])->name('register.store');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', AdminDashboardController::class)->name('dashboard');
    Route::get('/orders', [AdminOrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [AdminOrderController::class, 'show'])->name('orders.show');
    Route::patch('/orders/{order}', [AdminOrderController::class, 'update'])->name('orders.update');
    Route::get('/games', [AdminGameController::class, 'index'])->name('games.index');
});

Route::get('/games/{game}', [GameController::class, 'show'])->name('games.show');
Route::post('/games/{game}/orders', [OrderController::class, 'store'])->name('orders.store');

Route::redirect('/index.html', '/');
Route::redirect('/login.html', '/login');
Route::redirect('/register.html', '/register');
Route::redirect('/free-fire.html', '/games/free-fire');
Route::get('/game-topup.html', function (Request $request) {
    $legacyGames = [
        'pubg' => 'pubg-mobile',
        'mlbb' => 'mobile-legends',
        'codm' => 'call-of-duty',
        'valorant' => 'valorant',
    ];

    return redirect()->route('games.show', $legacyGames[$request->query('game')] ?? 'pubg-mobile');
});
