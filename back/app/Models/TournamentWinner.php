<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TournamentWinner extends Model
{
    use HasFactory;

    protected $fillable = [
        'tournament_id',
        'idea_id',
        'phase'
    ];

    public function scopeFinalPhase($query)
    {
        return $query->where('phase', 'final');
    }

    public function scopeFirstPhase($query)
    {
        return $query->where('phase', 'first');
    }

    public function scopeSecondPhase($query)
    {
        return $query->where('phase', 'second');
    }
}
