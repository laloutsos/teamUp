<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use App\Models\Game;
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
        // 1. Check if the user has already applied (Χρήση Auth::id())
        $existingApplication = Applicant::where('game_id', $game->id)
            ->where('user_id', Auth::id())
            ->exists();

        if ($existingApplication) {
            return redirect()->back()->with('error', 'You have already applied to this game');
        }

        // 2. Validation incoming data
        $validatedData = $request->validate([
            'full_name'     => 'required|string|max:255',
            'contact_phone' => 'nullable|string|max:20',
            'contact_email' => 'required|string|email|max:255',
            'location'      => 'nullable|string|max:255',
            'message'       => 'nullable|string',
            'resume_path'   => 'nullable|file|mimes:pdf|max:2048',
        ]);

        // 3. Handle file upload (if present)
        if ($request->hasFile('resume_path')) {
            $validatedData['resume_path'] = $request->file('resume_path')->store('resumes', 'public');
        }

        // 4. Assign Game ID & User ID
        $validatedData['game_id'] = $game->id;
        $validatedData['user_id'] = Auth::id();

        // 5. Save application
        Applicant::create($validatedData);

        return redirect()->back()->with('success', 'Application submitted successfully!');
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

        return redirect()->back()->with('success', 'Applicant deleted successfully');
    }
}
