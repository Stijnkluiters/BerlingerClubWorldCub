<?php

namespace App\Factory;

use App\Models\Team as EloquentTeam;
use App\Services\ValueObjects\Team;

class TeamFactory
{
    public function __construct(
        private readonly GoalFactory $goalFactory
    ) {
    }


    public function fromEloquent(EloquentTeam $team, ?array $goals): Team
    {
        if ($goals !== null) {
            return new Team(
                $team->id,
                $team->name,
                $goals
            );
        }
        return new Team(
            $team->id,
            $team->name,
            $this->goalFactory->fromEloquent($team->goals->toArray())
        );
    }
}
