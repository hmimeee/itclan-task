<?php

namespace App\Console\Commands;

use App\Models\Tournament;
use Illuminate\Console\Command;

class StartTournament extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tournament:start';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check and start a new tournament';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $runnginTournament = Tournament::inProgress()
            ->first();

        if ($runnginTournament) :
            $hasFinalPhase = $runnginTournament->tournamentWinners()
                ->finalPhase()
                ->first();

            if ($hasFinalPhase)
                $runnginTournament->update([
                    'status' => 'completed'
                ]);
        endif;

        if (!$runnginTournament || $hasFinalPhase) :
            $waitingTournament = Tournament::latest()
                ->waiting()
                ->first();

            if (!$waitingTournament)
                return false;

            $waitingTournament->update([
                'status' => 'in progress'
            ]);

            info('Tournament started: ' . $waitingTournament->name);
        endif;

        return true;
    }
}
