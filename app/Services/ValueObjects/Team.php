<?php

namespace App\Services\ValueObjects;


class Team
{
    /**
     * @param int $id
     * @param string $name
     * @param Goal[] $goals
     */
    public function __construct(
        private readonly int $id,
        private readonly string $name,
        private readonly array $goals
    ) {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getAmountOfConcededGoals(): int
    {
        $amountOfgoals = 0;
        foreach ($this->goals as $goal) {
            if ($goal->getGoalType() === 'conceded') {
                $amountOfgoals += 1;
            }
        }
        return $amountOfgoals;
    }

    public function getAmountOfScoredGoals(): int
    {
        $amountOfGoals = 0;
        foreach ($this->goals as $goal) {
            if ($goal->getGoalType() === 'scored') {
                $amountOfGoals += 1;
            }
        }
        return $amountOfGoals;
    }

    public function getAmountOfGoals(): int
    {
        return count($this->goals);
    }

}
