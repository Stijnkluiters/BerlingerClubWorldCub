<?php

namespace App\Repostitories;

use App\Models\Team;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use InvalidArgumentException;

class TeamRepository
{
    /**
     * @throws InvalidArgumentException
     * @throws ModelNotFoundException<Team>
     */
    public function getTeamByName(string $name): Team
    {
        if (empty($name)) {
            throw new InvalidArgumentException("TeamRepository error: name cannot be empty");
        }

        return Team::where('name', $name)
            ->firstOrFail()
            ;
    }
}
