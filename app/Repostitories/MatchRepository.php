<?php

namespace App\Repostitories;

use App\Models\MatchModel;
use App\Models\Team;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use InvalidArgumentException;
use Throwable;

class MatchRepository
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

    /**
     * @throws Throwable
     */
    public function updateScoreForMatch(
        int $id,
        int $teamAScore,
        int $teamBScore,
        int $winningTeamId,
        int $highestScore
    ): void
    {
        MatchModel::whereId($id)
            ->update([
                'team_a_score' => $teamAScore,
                'team_b_score' => $teamBScore,
                'winning_team_id' => $winningTeamId,
                'highest_score' => $highestScore
            ]);
    }

    public function createEmptyMatch(int $leagueId, int $teamAId, int $teamBId)
    {
        if ($teamAId < 0 ) {
            throw new InvalidArgumentException("Id's cannot be lower than zero");
        }
        if ($teamBId < 0 ) {
            throw new InvalidArgumentException("Id's cannot be lower than zero");
        }

        return MatchModel::create([
            'league_id' => $leagueId,
            'team_a_id' => $teamAId,
            'team_b_id' => $teamBId,
            'team_a_score' => null,
            'team_b_score' => null,
            'winning_team_id' => null,
            'highest_score' => null,
        ]);
    }

    public function getMatchesDescendingHighestScore(): array
    {
        return MatchModel::orderBy('higest_score', 'descending')->get()->toArray();
    }

    public function checkIfMatchExists(int $leagueId, int $teamAId, int $teamBId): ?MatchModel
    {
        return MatchModel::where('team_a_id', $teamAId)
            ->where('team_b_id', $teamBId)
            ->where('league_id', $leagueId)
            ->first();
    }
}
