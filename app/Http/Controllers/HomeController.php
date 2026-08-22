<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $games = Game::latest()->limit(6)->get();
        return view('pages.index')->with('games', $games);
    }
}
