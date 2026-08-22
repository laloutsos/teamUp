<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory as FactoriesHasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Game extends Model
{
    use FactoriesHasFactory;

    protected $table = 'game_listings';

    protected $fillable = [
        'title',
        'description',
        'bet',
        'tags',
        'game_type',
        'competitive',
        'more_information',
        'city',
        'exact_location',
        'contact_email',
        'contact_phone',
        'user_id',
        'team_name',
        'team_description',
        'team_logo'
    ];

    // Relation to user 
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Relation to Bookmarks

    public function bookmarkedByUsers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'game_user_bookmarks')->withTimestamps();
    }

    // Relation to applicants
    public function applicants(): HasMany
    {
        return $this->hasMany(Applicant::class);
    }
}
