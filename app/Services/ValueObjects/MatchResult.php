<?php

namespace App\Services\ValueObjects;

class MatchResult
{
    public function __construct(
        private readonly Team $teamA,
        private readonly Team $teamB,
        private readonly int $teamAScore,
        private readonly int $teamBScore,
        private readonly Team $winner,
        private readonly int $highestScore,
    )
    {
    }

    public function getTeamA(): Team
    {
        return $this->teamA;
    }

    public function getTeamB(): Team
    {
        return $this->teamB;
    }

    public function getTeamAScore(): int
    {
        return $this->teamAScore;
    }

    public function getTeamBScore(): int
    {
        return $this->teamBScore;
    }

    public function getWinner(): Team
    {
        return $this->winner;
    }

    public function getHighestScore(): int
    {
        return $this->highestScore;
    }
}
