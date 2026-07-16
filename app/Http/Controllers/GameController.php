<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class GameController extends Controller
{
    public function show(string $game): View
    {
        $details = config("games.{$game}");

        abort_unless($details, 404);

        return view('games.show', [
            'slug' => $game,
            'game' => $details,
        ]);
    }
}
