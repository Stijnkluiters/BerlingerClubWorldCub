<?php

namespace App\Http\Controllers;

use App\Factory\TeamFactory;
use App\Models\League;
use App\Models\Team;
use App\Services\LeagueService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct(
        private readonly LeagueService $leagueService,
        private readonly TeamFactory $teamFactory
    ) {
    }

    public function playLeague()
    {
        $teams = Team::limit(5)->get();
        // provide eloquent models, which is better so the outside should not have to make team objects themselves
        $league = $this->leagueService->createLeague('test-league', ...$teams);

        $leagueResult = $this->leagueService->playLeague($league);

        return view('welcome', compact('leagueResult'));
    }
}
