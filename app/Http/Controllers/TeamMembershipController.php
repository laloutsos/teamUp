<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class TeamMembershipController extends Controller
{
    use AuthorizesRequests;

    /**
     * Submit a join request.
     */
    public function store(Request $request, Team $team)
    {
        $user = $request->user();

        // The owner cannot request to join their own team.
        if ($team->created_by === $user->id) {
            return back()->with('error', 'You are already the owner of this team.');
        }

        // Prevent duplicate membership or requests.
        $alreadyExists = $team->memberships()
            ->where('user_id', $user->id)
            ->exists();

        if ($alreadyExists) {
            return back()->with('error', 'You have already joined or requested to join this team.');
        }

        // Check team capacity.
        $activeMembers = $team->memberships()
            ->where('status', 'active')
            ->count();

        if ($team->max_members !== null && $activeMembers >= $team->max_members) {
            return back()->with('error', 'This team is already full.');
        }

        $team->memberships()->create([
            'user_id' => $user->id,
            'role' => 'member',
            'status' => 'pending',
            'requested_at' => now(),
        ]);

        return back()->with(
            'success',
            'Your join request has been submitted!'
        );
    }

    /**
     * Approve a pending join request.
     */
    public function approve(Request $request, Team $team, User $user)
    {
        $this->authorize('manageMembers', $team);

        $membership = $team->memberships()
            ->where('user_id', $user->id)
            ->where('status', 'pending')
            ->firstOrFail();

        // Check capacity again before approval.
        $activeMembers = $team->memberships()
            ->where('status', 'active')
            ->count();

        if ($team->max_members !== null && $activeMembers >= $team->max_members) {
            return back()->with('error', 'The team is already full. You cannot approve this request.');
        }

        $membership->update([
            'status' => 'active',
            'joined_at' => now(),
        ]);

        return back()->with(
            'success',
            $user->name . ' has been added to the team!'
        );
    }

    /**
     * Reject a pending join request.
     */
    public function reject(Request $request, Team $team, User $user)
    {
        $this->authorize('manageMembers', $team);

        $membership = $team->memberships()
            ->where('user_id', $user->id)
            ->where('status', 'pending')
            ->firstOrFail();

        $membership->delete();

        return back()->with(
            'success',
            'Join request from ' . $user->name . ' has been rejected.'
        );
    }

    public function remove(Request $request, Team $team, User $user)
    {
        $this->authorize('manageMembers', $team);

        $membership = $team->memberships()
            ->where('user_id', $user->id)
            ->where('status', 'active')
            ->where('role', 'member')
            ->firstOrFail();

        $membership->delete();

        return back()->with(
            'success',
            $user->name . ' has been removed from the team.'
        );
    }
}
