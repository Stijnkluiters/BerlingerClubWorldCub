<?php

namespace App\Services;

use App\Factory\GoalFactory;
use App\Factory\MatchFactory;
use App\Models\MatchModel;
use App\Repostitories\LeagueRepository;
use App\Repostitories\MatchRepository;
use App\Services\ValueObjects\League;
use App\Services\ValueObjects\LeagueResults;
use App\Services\ValueObjects\MatchResult;
use App\Services\ValueObjects\Team;

class LeagueService
{
    public function __construct(
        private readonly LeagueRepository $leagueRepository,
        private readonly MatchService $matchService,
        private readonly MatchFactory $matchFactory,
        private readonly MatchRepository $matchRepository,
    ) {
    }

    public function createLeague(string $leagueName, \App\Models\Team ...$teams): League
    {
        $matches = [];
        $eloquentLeague = $this->leagueRepository->createLeague($leagueName);
        foreach ($teams as $teamA) {
            foreach ($teams as $teamB) {
                if ($teamA->name === $teamB->name) {
                    continue;
                }
                // if team already exists in existing matches skip too.
                if (
                    $this->matchRepository->checkIfMatchExists($eloquentLeague->id, $teamA->id, $teamB->id) ||
                    $this->matchRepository->checkIfMatchExists($eloquentLeague->id, $teamB->id, $teamA->id)
                ) {
                    continue;
                }



                // create empty match in db to provide identifier
                $eloquentMatch = $this->matchRepository->createEmptyMatch($eloquentLeague->id, $teamA->id, $teamB->id);

                // convert eloquent to value object to be able to test more easily and faster with MockeryTestCase.
                $newMatch = $this->matchFactory->createRandomMatch($eloquentMatch->id, $teamA, $teamB);

                $matches[] = $newMatch;
            }
        }

        return new League($leagueName, $matches);
    }

    public function playLeague(League $league): LeagueResults
    {
        $matchResults = [];
        // randomised amount of goals here
        foreach ($league->getMatches() as $match) {
            $matchResult = $this->matchService->getMatchResults($match);

            // store result in DB
            $this->matchRepository->updateScoreForMatch(
                $match->getId(),
                $matchResult->getTeamAScore(),
                $matchResult->getTeamBScore(),
                $matchResult->getWinner()->getId(),
                $matchResult->getHighestScore()
            );
            $matchResults[] = $matchResult;
        }

        return $this->matchService->getWinnerFromMatchResults($matchResults);
    }

    public function getLeagueResults(string $leagueName): LeagueResults
    {
        $league = $this->leagueRepository->getLeagueByName($leagueName);
        $matchResults = [];
        foreach ($league->matches as $match) {
            $matchResults[] = $this->matchService->getMatchResults(
                $this->matchFactory->fromEloquent($match)
            );
        }
        return new LeagueResults($matchResults);
    }
}
