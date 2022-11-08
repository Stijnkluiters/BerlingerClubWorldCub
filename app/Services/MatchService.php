<?php

namespace App\Services;

use App\Services\ValueObjects\LeagueResults;
use App\Services\ValueObjects\MatchResult;
use App\Services\ValueObjects\MatchVO;
use App\Services\ValueObjects\Team;

class MatchService
{
    public function getMatchResults(MatchVO $matchVO): MatchResult
    {
        $teamAScore = 0;
        $teamBScore = 0;
        if ($matchVO->getTeamA()->getAmountOfGoals() > $matchVO->getTeamB()->getAmountOfGoals()) {
            $teamAScore += 3;
        } else if ($matchVO->getTeamA()->getAmountOfGoals() < $matchVO->getTeamB()->getAmountOfGoals()) {
            $teamBScore += 3;
        } else {
            $teamBScore++;
            $teamAScore++;
        }

        $winner = null;
        $highestScore = 0;
        if ($teamAScore === $teamBScore) {
            $winner = $this->getWinnerFromEqualScore($matchVO);
            $highestScore = 1;
        } else if ($teamAScore > $teamBScore) {
            $winner = $matchVO->getTeamA();
            $highestScore = $teamAScore;
        } else if ($teamAScore < $teamBScore) {
            $winner = $matchVO->getTeamB();
            $highestScore = $teamBScore;
        }

        return new MatchResult(
            $matchVO->getTeamA(),
            $matchVO->getTeamB(),
            $teamAScore,
            $teamBScore,
            $winner,
            $highestScore
        );
    }

    // if 2 or more teams are equal in points, the goal difference (goals scored - goals conceded) decides
    private function getWinnerFromEqualScore(MatchVO $match): Team
    {
        $actualScoredTeamA = $match->getTeamA()->getAmountOfScoredGoals() - $match->getTeamB()->getAmountOfConcededGoals();
        $actualScoredTeamB = $match->getTeamB()->getAmountOfScoredGoals() - $match->getTeamB()->getAmountOfConcededGoals();
        if ($actualScoredTeamA > $actualScoredTeamB) {
            $winningTeam = $match->getTeamA();
        } else if ($actualScoredTeamA < $actualScoredTeamB) {
            $winningTeam = $match->getTeamB();
        } else {
            // If 2 or more teams are equal in goals scored, then the winner their own game counts
            $winningTeam = $match->getTeamA();
        }
        return $winningTeam;
    }

    public function getWinnerFromMatchResults(array $matchResults): LeagueResults
    {
        /** @var MatchResult $matchResult */
        $league = [];
        foreach ($matchResults as $matchResult) {
            $name = $matchResult->getWinner()->getName();
            if (!array_key_exists($name, $league)) {
                $league[$name] = $matchResult->getHighestScore();
            } else {
                $league[$name] += $matchResult->getHighestScore();
            }
        }
        arsort($league);
        return new LeagueResults(
            $matchResults,
            $league
        );
    }
}
