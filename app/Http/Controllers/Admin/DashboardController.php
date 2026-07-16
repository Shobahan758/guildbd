<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        return view('admin.dashboard', [
            'stats' => [
                'total' => Order::query()->count(),
                'pending' => Order::query()->where('status', 'pending')->count(),
                'processing' => Order::query()->where('status', 'processing')->count(),
                'completed' => Order::query()->where('status', 'completed')->count(),
                'revenue' => Order::query()->where('status', 'completed')->sum('amount'),
            ],
            'recentOrders' => Order::query()->with('user')->latest()->limit(8)->get(),
            'gameCount' => count(config('games')),
        ]);
    }
}
