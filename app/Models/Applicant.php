<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Applicant extends Model
{
    use HasFactory;
    protected $fillable = [
        'game_id',
        'user_id',
        'full_name',
        'contact_phone',
        'contact_email',
        'message',
        'location',
        'resume_path'
    ];

    // Relation to Game
    public function game(): BelongsTo
    {
        return $this->belongsTo(Game::class);
    }

    // Relation to User
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
