<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\Game;
use App\Models\Team;

class DashboardController extends Controller
{
    // @desc    Show all users game listings and teams
    // @route   GET /dashboard

    public function index(): View
    {
        $user = Auth::user();

        // Get the user's game listings
        $games = Game::where('user_id', $user->id)->with('applicants')->get();

        // Get teams created by user OR where the user is an active member
        $teams = Team::with('creator')
            ->withCount([
                'memberships as members_count' => function ($query) {
                    $query->where('status', 'active');
                }
            ])
            ->where(function ($query) use ($user) {
                $query->where('created_by', $user->id)
                    ->orWhereHas('memberships', function ($subQuery) use ($user) {
                        $subQuery->where('user_id', $user->id)
                            ->where('status', 'active');
                    });
            })
            ->latest()
            ->get();

        // Pass both $games and $teams to the view
        return view('dashboard.index', compact('user', 'games', 'teams'));
    }
}
