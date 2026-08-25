<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $user = Auth::user();

        if ($user && $user->location) {
            // Case-insensitive search matching city or location
            $games = Game::where('city', 'ilike', '%' . $user->location . '%')
                ->orWhere('exact_location', 'ilike', '%' . $user->location . '%')
                ->latest()
                ->limit(6)
                ->get();

            $title = "Games in " . $user->location;
        } else {
            $games = Game::latest()->limit(6)->get();
            $title = "Upcoming Games";
        }

        return view('pages.index', compact('games', 'title'));
    }
}
