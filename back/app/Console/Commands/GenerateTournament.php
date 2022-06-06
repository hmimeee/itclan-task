<?php

namespace App\Console\Commands;

use App\Models\Idea;
use App\Models\Tournament;
use Illuminate\Console\Command;

class GenerateTournament extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tournament:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check and generate a new tournament';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $ideas = Idea::waiting()->limit(8)->get();
        if ($ideas->count() < 8)
            return false;

        $lastTournament = Tournament::latest()->first();
        if (!$lastTournament) :
            $name = 'Tournament ' . str_pad(1, 5, STR_PAD_LEFT);
        else :
            $explodes = explode(' ', $lastTournament->name);
            $name = 'Tournament ' . str_pad(intval($explodes[1]) + 1, 5, STR_PAD_LEFT);
        endif;

        $tournament = Tournament::create([
            'name' => $name
        ]);

        Idea::waiting()->limit(8)->update([
            'tournament_id' => $tournament->id
        ]);

        info('Tournament created: ' . $tournament->name);

        return true;
    }
}
