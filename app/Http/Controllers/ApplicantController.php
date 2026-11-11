<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use App\Models\Game;
use App\Notifications\TeamNotification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ApplicantController extends Controller
{
    /**
     * Store new game application.
     * Route: POST /games/{game}/apply
     */
    public function store(Request $request, Game $game): RedirectResponse
    {
        $user = $request->user();

        // Prevent the game creator from applying to their own game.
        if ((int) $game->user_id === (int) $user->id) {
            return back()->with('error', 'You cannot apply to your own game.');
        }

        // Check if the user has already applied.
        $existingApplication = Applicant::where('game_id', $game->id)
            ->where('user_id', $user->id)
            ->exists();

        if ($existingApplication) {
            return back()->with('error', 'You have already applied to this game.');
        }

        // Validate application data.
        $validatedData = $request->validate([
            'full_name'     => 'required|string|max:255',
            'contact_phone' => 'nullable|string|max:20',
            'contact_email' => 'required|string|email|max:255',
            'location'      => 'nullable|string|max:255',
            'message'       => 'nullable|string',
            'resume_path'   => 'nullable|file|mimes:pdf|max:2048',
        ]);

        // Handle file upload.
        if ($request->hasFile('resume_path')) {
            $validatedData['resume_path'] = $request->file('resume_path')
                ->store('resumes', 'public');
        }

        // Assign Game ID & User ID.
        $validatedData['game_id'] = $game->id;
        $validatedData['user_id'] = $user->id;

        // Save application.
        Applicant::create($validatedData);

        // Notify the game creator.
        $gameCreator = $game->user;

        if ($gameCreator) {
            $gameCreator->notify(new TeamNotification([
                'category' => 'game',
                'title' => 'New Game Applicant',
                'message' => $user->name . ' has applied to your game: ' . $game->title . '.',
                'icon' => 'fa-user-plus',
                'url' => route('games.show', $game),
                'game_id' => $game->id,
                'actor_id' => $user->id,
                'actor_name' => $user->name,
            ]));
        }

        return back()->with('success', 'Application submitted successfully!');
    }

    /**
     * Delete Game applicant.
     * Route: DELETE /applicants/{applicant}
     */
    public function destroy(Applicant $applicant): RedirectResponse
    {
        if ($applicant->resume_path) {
            Storage::disk('public')->delete($applicant->resume_path);
        }

        $applicant->delete();

        return back()->with('success', 'Applicant deleted successfully');
    }
}
