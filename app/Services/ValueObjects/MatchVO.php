<?php

namespace App\Services\ValueObjects;

/**
 * Match is a reserved word since php 8
 */
class MatchVO
{
    /**
     * @param int $id
     * @param Team $teamA
     * @param Team $teamB
     * @param Goal[] $goals
     */
    public function __construct(
        private readonly int $id,
        private readonly Team $teamA,
        private readonly Team $teamB,
        private readonly array $goals
    ) {
    }

    public function getTeamA(): Team
    {
        return $this->teamA;
    }

    public function getTeamB(): Team
    {
        return $this->teamB;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getGoals(): array
    {
        return $this->goals;
    }
}
