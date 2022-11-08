<?php

namespace App\Services\ValueObjects;

class LeagueResults
{
    /**
     * @param MatchResult[] $matchResults
     */
    public function __construct(
        private readonly array $matchResults,
        private readonly array $teamScores,
    ) {
    }

    public function getMatchResults(): array
    {
        return $this->matchResults;
    }

    public function getTeamScores(): array
    {
        return $this->teamScores;
    }
}
