<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Team extends Model
{
    protected $fillable = [
        'created_by',
        'name',
        'sport',
        'city',
        'description',
        'max_members',
    ];

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function memberships(): HasMany
    {
        return $this->hasMany(TeamMembership::class);
    }

    public function members(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            'team_memberships'
        )
            ->withPivot([
                'role',
                'status',
                'requested_at',
                'joined_at',
            ])
            ->wherePivot('status', 'active')
            ->withTimestamps();
    }

    public function pendingRequests(): HasMany
    {
        return $this->memberships()
            ->where('status', 'pending');
    }
}
