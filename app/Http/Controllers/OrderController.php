<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class OrderController extends Controller
{
    public function store(Request $request, string $game): RedirectResponse
    {
        $details = config("games.{$game}");
        abort_unless($details, 404);

        $packageNames = array_column($details['packages'], 'name');

        $request->validate([
            'player_id' => ['required', 'string', 'max:100'],
            'package' => ['required', Rule::in($packageNames)],
            'payment' => ['required', Rule::in(['bkash', 'nagad', 'wallet'])],
            'bkash_number' => ['required_if:payment,bkash', 'nullable', 'regex:/^01[3-9][0-9]{8}$/'],
            'bkash_transaction_id' => ['required_if:payment,bkash', 'nullable', 'string', 'min:8', 'max:16'],
            'nagad_number' => ['required_if:payment,nagad', 'nullable', 'regex:/^01[3-9][0-9]{8}$/'],
            'nagad_transaction_id' => ['required_if:payment,nagad', 'nullable', 'string', 'min:8', 'max:16'],
        ]);

        return back()->with('order_success', 'Your order has been received successfully.');
    }
}
