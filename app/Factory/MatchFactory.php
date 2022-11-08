<?php

namespace App\Factory;

use App\Models\MatchModel;
use App\Services\ValueObjects\MatchVO;
use App\Services\ValueObjects\Team;

class MatchFactory
{
    public function __construct(
        private readonly TeamFactory $teamFactory,
        private readonly GoalFactory $goalFactory,
    ) {
    }

    public function createRandomMatch(int $matchId, \App\Models\Team $teamAEloquent, \App\Models\Team $teamBEloquent): MatchVO
    {
        $goals = $this->goalFactory->createRandomGoals();
        $teamA = $this->teamFactory->fromEloquent($teamAEloquent, $goals);

        $goals = $this->goalFactory->createRandomGoals();
        $teamB = $this->teamFactory->fromEloquent($teamBEloquent, $goals);
        return new MatchVO($matchId, $teamA, $teamB, $goals);
    }

    public function fromEloquent(MatchModel $match): MatchVO
    {
        return new MatchVO(
            $match->id,
            $this->teamFactory->fromEloquent($match->teamA, null),
            $this->teamFactory->fromEloquent($match->teamB, null),
            $this->goalFactory->fromEloquent($match->goals)
        );
    }
}
