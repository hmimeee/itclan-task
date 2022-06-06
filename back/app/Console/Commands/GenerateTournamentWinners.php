<?php

namespace App\Console\Commands;

use App\Models\Idea;
use App\Models\Tournament;
use Illuminate\Console\Command;

class GenerateTournamentWinners extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tournament:generate-winners';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check and generate winners of the running tournament';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $tournament = Tournament::inProgress()
            ->first();

        $firstPhase = $tournament->tournamentWinners()
            ->firstPhase()
            ->count();

        if (!$firstPhase) :
            $selected = $tournament->ideas()
                ->inRandomOrder()
                ->limit(4)
                ->get()
                ->map(fn ($d) => [
                    'idea_id' => $d->id,
                    'phase' => 'first'
                ]);

            $tournament->tournamentWinners()->createMany($selected);

            info('Tournament winners of first: ' . $selected);

            return true;
        endif;

        $secondPhase = $tournament->tournamentWinners()
            ->secondPhase()
            ->count();

        if (!$secondPhase) :
            $selected = $tournament->tournamentWinners()
                ->inRandomOrder()
                ->limit(2)
                ->update([
                    'phase' => 'second'
                ]);

            info('Tournament winners of second: ' . $selected);

            return true;
        endif;

        $finalPhase = $tournament->tournamentWinners()
            ->finalPhase()
            ->count();

        if (!$finalPhase) :
            $selected = $tournament->tournamentWinners()
                ->secondPhase()
                ->inRandomOrder()
                ->limit(1)
                ->update([
                    'phase' => 'final'
                ]);

            info('Tournament winners of final: ' . $selected);

            return true;
        endif;

        return true;
    }
}
