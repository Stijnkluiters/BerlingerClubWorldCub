<?php

namespace App\Factory;

use App\Services\ValueObjects\Goal;
use App\Services\ValueObjects\Team;

class GoalFactory
{
    public function createGoal(): Goal {
        $number = rand(0, 10);

        if ($number > 8) {
            return new Goal('conceded');
        }
        return new Goal('scored');
    }

    public function createRandomGoals(): array
    {
        $amountOfGoals = rand(0, 10);
        $goals = [];
        for ($y = 0; $y < $amountOfGoals; $y++) {
            $goals[] = $this->createGoal();
        }
        return $goals;
    }

    public function fromEloquent(array $goals): array
    {
        /** @var \App\Models\Goal $goal */
        $goalsVO = [];
        foreach ($goals as $goal) {
            $goalsVO[] = new Goal($goal->team, $goal->goal_type);
        }
        return $goalsVO;
    }
}
