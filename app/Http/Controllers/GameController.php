<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Game;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Str;

class GameController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $games = Game::paginate(21);

        return view('games.index')->with('games', $games);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('games.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'bet' => 'required|integer',
            'tags' => 'nullable|string',
            'game_type' => 'required|string',
            'competitive' => 'required|boolean',
            'more_information' => 'nullable|string',
            'exact_location' => 'nullable|string',
            'city' => 'required|string',
            'contact_email' => 'required|email',
            'contact_phone' => 'nullable|string',
            'team_name' => 'nullable|string',
            'team_description' => 'nullable|string',
            'team_logo' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:2048'
        ]);

        // Hardcoded user id
        $validatedData['user_id'] = Auth::user()->id;

        // Check for image
        if ($request->hasFile('team_logo')) {
            // Store the file and get path
            $path = $request->file('team_logo')->store('logos', 'public');

            // Add path to validated data
            $validatedData['team_logo'] = $path;
        }

        // Submit to Database
        Game::create($validatedData);

        return redirect()->route('games.index')->with('success', 'Game Listing created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Game $game): View
    {
        return view('games.show')->with('game', $game);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Game $game): View
    {
        $this->authorize('update', $game);

        return view('games.edit')->with('game', $game);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Game $game)
    {
        // Check if user is authorized
        $this->authorize('update', $game);

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'bet' => 'required|integer',
            'tags' => 'nullable|string',
            'game_type' => 'required|string',
            'competitive' => 'required|boolean',
            'more_information' => 'nullable|string',
            'exact_location' => 'nullable|string',
            'city' => 'required|string',
            'contact_email' => 'required|email',
            'contact_phone' => 'nullable|string',
            'team_name' => 'nullable|string',
            'team_description' => 'nullable|string',
            'team_logo' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:2048'
        ]);

        // Check for image
        if ($request->hasFile('team_logo')) {
            // Delete old logo
            Storage::delete('public/logos/' . basename($game->team_logo));
            // Store the file and get path
            $path = $request->file('team_logo')->store('logos', 'public');

            // Add path to validated data
            $validatedData['team_logo'] = $path;
        }

        // Submit to Database
        $game->update($validatedData);

        return redirect()->route('games.index')->with('success', 'Game Listing updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Game $game): RedirectResponse
    {
        // Check if User is authorized
        $this->authorize('delete', $game);

        // Delete team logo if exists
        if ($game->team_logo) {
            Storage::disk('public')->delete($game->team_logo);
        }

        $game->delete();

        // Check if the request came from the Dashboard
        if (request()->query('from') == 'dashboard') {
            return redirect()->route('dashboard.index')->with('success', 'Game Listing deleted successfully');
        }

        return redirect()->route('games.index')->with('success', 'Game Listing deleted successfully');
    }

    /**
     * Search Game Listings 
     * GET /games/search
     */
    /**
     * Search Game Listings 
     * GET /games/search
     */
    public function search(Request $request): View
    {
        $keywords = trim($request->input('keywords') ?? $request->input('search') ?? '');
        $location = trim($request->input('location', ''));

        $query = Game::query();

        if ($keywords !== '') {
            $query->where(function ($q) use ($keywords) {
                $q->where('title', 'ilike', "%{$keywords}%")
                    ->orWhere('description', 'ilike', "%{$keywords}%")
                    ->orWhere('tags', 'ilike', "%{$keywords}%")
                    ->orWhere('game_type', 'ilike', "%{$keywords}%")
                    ->orWhere('team_name', 'ilike', "%{$keywords}%")
                    ->orWhere('more_information', 'ilike', "%{$keywords}%")
                    ->orWhere('team_description', 'ilike', "%{$keywords}%");
            });
        }

        if ($location !== '') {
            $query->where(function ($q) use ($location) {
                $q->where('city', 'ilike', "%{$location}%")
                    ->orWhere('exact_location', 'ilike', "%{$location}%");
            });
        }

        $games = $query->paginate(12)->appends($request->query());

        return view('games.index')->with('games', $games);
    }
}
