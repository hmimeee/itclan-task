<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Idea extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'tournament_id',
        'name',
        'email',
        'idea'
    ];

    /**
     * Get the tournament that owns the Idea
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tournament()
    {
        return $this->belongsTo(Tournament::class);
    }

    public function scopeWaiting($query)
    {
        return $query->whereNull('tournament_id');
    }

    /**
     * Get the user that owns the Idea
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the status associated with the Idea
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function status()
    {
        return $this->hasOne(TournamentWinner::class)->latest();
    }
}
