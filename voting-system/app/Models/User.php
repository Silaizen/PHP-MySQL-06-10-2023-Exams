<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use App\Models\Vote;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function votes(): BelongsToMany
    {
        return $this->belongsToMany(Vote::class, 'user_votes')->withTimestamps();
    }


    public function hasVotedIn($voteId)
{
    return $this->votedVotes()->where('vote_id', $voteId)->exists();
}

public function markAsVotedIn($voteId)
{
    $this->votedVotes()->attach($voteId);
}

public function votedVotes()
{
    return $this->belongsToMany(Vote::class, 'user_votes');
}
}
