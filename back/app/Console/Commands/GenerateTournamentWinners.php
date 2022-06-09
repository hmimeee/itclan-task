<?php

namespace App\Console\Commands;

use App\Models\Idea;
use App\Models\Tournament;
use App\Notifications\PhaseWinningNotification;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Notification;

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
                ->with('user')
                ->inRandomOrder()
                ->limit(4)
                ->get();

            Notification::send($selected->pluck('user'), new PhaseWinningNotification('first', $tournament));

            $tournament->tournamentWinners()
                ->createMany($selected->map(fn ($d) => [
                    'idea_id' => $d->id,
                    'phase' => 'first'
                ]));

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

            $winners = $tournament->winners()
                ->with('user')
                ->whereHas('status', fn ($q) => $q->where('phase', 'second'))
                ->get()
                ->pluck('user');

            Notification::send($winners, new PhaseWinningNotification('second', $tournament));

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

            $tournament->update([
                'status' => 'completed'
            ]);

            $winners = $tournament->winners()
                ->with('user')
                ->whereHas('status', fn ($q) => $q->where('phase', 'final'))
                ->get()
                ->pluck('user');

            Notification::send($winners, new PhaseWinningNotification('final', $tournament));

            return true;
        endif;

        return true;
    }
}
