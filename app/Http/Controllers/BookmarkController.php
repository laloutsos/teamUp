<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class BookmarkController extends Controller
{
    public function index(): View
    {
        /** @var User $user */
        $user = Auth::user();

        $bookmarks = $user->bookmarkedGames()->paginate(9);

        return view('games.bookmarked')->with('bookmarks', $bookmarks);
    }

    public function store(Game $game): RedirectResponse
    {
        /** @var User $user */
        $user = Auth::user();

        if ($user->bookmarkedGames()->where('game_id', $game->id)->exists()) {
            return back()->with('status', 'Game is already bookmarked');
        }

        $user->bookmarkedGames()->attach($game->id);

        return back()->with('success', 'Game bookmarked successfully!');
    }

    public function destroy(Game $game): RedirectResponse
    {
        /** @var User $user */
        $user = Auth::user();

        $user->bookmarkedGames()->detach($game->id);

        return back()->with('success', 'Game removed from bookmarks!');
    }
}
