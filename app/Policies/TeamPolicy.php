<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Team;

class TeamPolicy
{
    public function update(User $user, Team $team): bool
    {
        return $team->memberships()
            ->where('user_id', $user->id)
            ->where('role', 'owner')
            ->where('status', 'active')
            ->exists();
    }

    public function delete(User $user, Team $team): bool
    {
        return $this->update($user, $team);
    }

    public function manageMembers(
        User $user,
        Team $team
    ): bool {
        return $this->update($user, $team);
    }
}
