<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class OrderController extends Controller
{
    public function store(Request $request, string $game): RedirectResponse
    {
        $details = config("games.{$game}");
        abort_unless($details, 404);

        $packageNames = array_column($details['packages'], 'name');

        $validated = $request->validate([
            'player_id' => ['required', 'string', 'max:100'],
            'package' => ['required', Rule::in($packageNames)],
            'payment' => ['required', Rule::in(['bkash', 'nagad', 'wallet'])],
            'bkash_number' => ['required_if:payment,bkash', 'nullable', 'regex:/^01[3-9][0-9]{8}$/'],
            'bkash_transaction_id' => ['required_if:payment,bkash', 'nullable', 'string', 'min:8', 'max:16'],
            'nagad_number' => ['required_if:payment,nagad', 'nullable', 'regex:/^01[3-9][0-9]{8}$/'],
            'nagad_transaction_id' => ['required_if:payment,nagad', 'nullable', 'string', 'min:8', 'max:16'],
        ]);

        $package = collect($details['packages'])->firstWhere('name', $validated['package']);
        $payment = $validated['payment'];

        $order = Order::query()->create([
            'user_id' => $request->user()?->id,
            'reference' => 'GN-'.now()->format('ymd').'-'.Str::upper(Str::random(6)),
            'game_slug' => $game,
            'game_name' => $details['name'],
            'package_name' => $validated['package'],
            'amount' => $package['price'],
            'player_id' => $validated['player_id'],
            'payment_method' => $payment,
            'payer_number' => $validated[$payment.'_number'] ?? null,
            'transaction_id' => $validated[$payment.'_transaction_id'] ?? null,
            'status' => 'pending',
        ]);

        return back()->with('order_success', "Order {$order->reference} has been received successfully.");
    }
}
