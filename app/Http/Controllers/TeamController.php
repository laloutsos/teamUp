<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Http\Requests\StoreTeamRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;

class TeamController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    public function index(Request $request)
    {
        $teams = Team::with('creator')
            ->withCount([
                'memberships as members_count' => function ($query) {
                    $query->where('status', 'active');
                }
            ])
            ->when($request->filled('keywords'), function ($query) use ($request) {
                $query->where('name', 'ILIKE', '%' . $request->keywords . '%');
            })
            ->when($request->filled('sport'), function ($query) use ($request) {
                $query->where('sport', $request->sport);
            })
            ->when($request->filled('city'), function ($query) use ($request) {
                $query->where('city', 'ILIKE', '%' . $request->city . '%');
            })
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return view('teams.index', compact('teams'));
    }

    public function create()
    {
        return view('teams.create');
    }

    public function store(StoreTeamRequest $request)
    {
        $userId = $request->user()->id;

        $team = DB::transaction(function () use ($request, $userId) {

            $team = Team::create([
                ...$request->validated(),
                'created_by' => $userId,
            ]);

            $team->memberships()->create([
                'user_id' => $userId,
                'role' => 'owner',
                'status' => 'active',
                'joined_at' => now(),
            ]);

            return $team;
        });

        return redirect()
            ->route('teams.show', $team)
            ->with('success', 'Team created successfully!');
    }

    public function show(Team $team)
    {
        $team->load([
            'members',
            'pendingRequests.user'
        ]);

        $membership = Auth::check()
            ? $team->memberships()
            ->where('user_id', Auth::id())
            ->first()
            : null;

        return view('teams.show', compact('team', 'membership'));
    }

    public function edit(Team $team)
    {
        abort_unless(
            $team->created_by === Auth::id(),
            403
        );

        return view('teams.edit', compact('team'));
    }

    public function update(Request $request, Team $team)
    {
        abort_unless(
            $team->created_by === Auth::id(),
            403
        );

        $activeMembersCount = $team->memberships()
            ->where('status', 'active')
            ->count();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],

            'sport' => [
                'required',
                'in:football,basketball,volleyball',
            ],

            'city' => ['required', 'string', 'max:255'],

            'description' => ['nullable', 'string'],

            'max_members' => [
                'nullable',
                'integer',
                'min:' . $activeMembersCount,
            ],
        ]);

        $team->update($validated);

        return redirect()
            ->route('teams.show', $team)
            ->with('success', 'Team updated successfully!');
    }
}
