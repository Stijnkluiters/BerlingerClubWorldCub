<?php

namespace App\Repostitories;

use App\Models\League;
use App\Models\League as EloquentLeague;

class LeagueRepository
{
    public function getLeagueByName(string $name): EloquentLeague
    {
        return EloquentLeague::where('name', $name)->firstOrFail();
    }

    public function createLeague(string $leagueName): EloquentLeague
    {
        return EloquentLeague::create(['name' => $leagueName]);
    }
}
