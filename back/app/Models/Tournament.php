<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tournament extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'status'
    ];

    public function scopeWaiting($query)
    {
        return $query->where('status', 'waiting');
    }

    public function scopeinProgress($query)
    {
        return $query->where('status', 'in progress');
    }

    /**
     * Get all of the ideas for the Tournament
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ideas()
    {
        return $this->hasMany(Idea::class);
    }

    /**
     * Get all of the tournamentWinners for the Tournament
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tournamentWinners()
    {
        return $this->hasMany(TournamentWinner::class);
    }

    /**
     * The winners that belong to the Tournament
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function winners()
    {
        return $this->belongsToMany(Idea::class, TournamentWinner::class, 'tournament_id', 'idea_id');
    }
}
