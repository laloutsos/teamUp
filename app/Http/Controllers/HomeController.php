<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $user = Auth::user();
        $location = $user?->location;

        if ($user && $location) {
            $games = Game::where('city', 'ilike', '%' . $location . '%')
                ->orWhere('exact_location', 'ilike', '%' . $location . '%')
                ->latest()
                ->limit(6)
                ->get();

            $title = "Games in " . $location;
        } else {
            $games = Game::latest()->limit(6)->get();
            $title = "Upcoming Games";
        }

        $teams = Team::with('creator')
            ->withCount([
                'memberships as members_count' => function ($query) {
                    $query->where('status', 'active');
                }
            ])
            ->when($location, function ($query) use ($location) {
                $query->where('city', 'ILIKE', '%' . $location . '%');
            })
            ->where(function ($query) {
                $query->whereNull('max_members')
                    ->orWhereRaw(
                        '(SELECT COUNT(*) FROM team_memberships
                         WHERE team_memberships.team_id = teams.id
                         AND team_memberships.status = ?) < teams.max_members',
                        ['active']
                    );
            })
            ->whereDoesntHave('memberships', function ($query) use ($user) {
                $query->where('user_id', $user?->id)
                    ->where('status', 'active');
            })
            ->latest()
            ->take(6)
            ->get();

        return view('pages.index', compact('games', 'teams', 'title'));
    }
}
