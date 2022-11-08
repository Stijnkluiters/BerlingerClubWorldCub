<?php

namespace App\Services\ValueObjects;

class Goal
{
    public function __construct(
        private readonly string $goalType,
    ) {
    }

    public function getTeam(): Team
    {
        return $this->team;
    }

    public function getGoalType(): string
    {
        return $this->goalType;
    }
}
