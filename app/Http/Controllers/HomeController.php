<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Display the homepage with games filtered by user location.
     */
    public function index(): View
    {
        $user = Auth::user();
        $radiusKm = 15;

        if ($user && $user->latitude && $user->longitude) {
            $lat = $user->latitude;
            $lng = $user->longitude;

            // Raw SQL formula for Haversine calculation
            $haversine = "( 6371 * acos( cos( radians(?) ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians(?) ) + sin( radians(?) ) * sin( radians( latitude ) ) ) )";

            $games = Game::selectRaw("*, {$haversine} AS distance", [$lat, $lng, $lat])
                ->whereRaw("{$haversine} <= ?", [$lat, $lng, $lat, $radiusKm])
                ->orderBy("distance", "asc")
                ->limit(6)
                ->get();

            $title = "Games Near " . ($user->city ?? 'Your Location');
        } elseif ($user && $user->city) {
            // Filter games by user city
            $games = Game::where('city', 'ilike', "%{$user->city}%")
                ->latest()
                ->limit(6)
                ->get();

            $title = "Games in " . $user->city;
        } else {
            // Fallback for users/guests without location set
            $games = Game::latest()->limit(6)->get();
            $title = "Upcoming Games";
        }

        return view('pages.index', compact('games', 'title'));
    }
}
