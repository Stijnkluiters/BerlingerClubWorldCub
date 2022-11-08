<?php

namespace Tests\Unit\Services;

use App\Services\MatchService;
use App\Services\ValueObjects\MatchVO;
use Mockery;
use Mockery\Adapter\Phpunit\MockeryTestCase;
use App\Services\ValueObjects\Team;

class MatchServiceTest extends MockeryTestCase
{
    private Mockery\LegacyMockInterface|Mockery\MockInterface|Team $teamAMock;
    private Mockery\LegacyMockInterface|Mockery\MockInterface|Team $teamBMock;
    private MatchVO|Mockery\LegacyMockInterface|Mockery\MockInterface $matchVO;
    private MatchService $matchService;

    protected function setUp(): void
    {
        $this->matchService = new MatchService();
        $this->teamAMock = Mockery::mock(Team::class);
        $this->teamBMock = Mockery::mock(Team::class);
        $this->matchVO = Mockery::mock(MatchVO::class);

        $this->matchVO->shouldReceive('getTeamA')->andReturn($this->teamAMock);
        $this->matchVO->shouldReceive('getTeamB')->andReturn($this->teamBMock);
    }

    public function test_getMatchResults_should_return_matchScores_team_A_3_points_when_teamA_has_more_scores_than_teamB()
    {
        $expectedTeamAScore = 3;
        $expectedTeamBScore = 0;

        $this->teamAMock->expects('getAmountOfGoals')->andReturn(5);
        $this->teamBMock->expects('getAmountOfGoals')->andReturn(4);

        $result = $this->matchService->getMatchResults($this->matchVO);

        $this->assertEquals($expectedTeamAScore, $result->getTeamAScore());
        $this->assertEquals($expectedTeamBScore, $result->getTeamBScore());
    }

    public function test_getMatchResults_should_return_matchScores_team_B_3_points_when_teamB_has_more_scores_than_teamA()
    {
        $expectedTeamAScore = 0;
        $expectedTeamBScore = 3;
        $this->teamAMock->expects('getAmountOfGoals')->twice()->andReturn(4);
        $this->teamBMock->expects('getAmountOfGoals')->twice()->andReturn(5);

        $result = $this->matchService->getMatchResults($this->matchVO);

        $this->assertEquals($expectedTeamAScore, $result->getTeamAScore());
        $this->assertEquals($expectedTeamBScore, $result->getTeamBScore());
    }

    public function test_getMatchResults_should_return_1_score_on_both_teams_when_equal()
    {
        $expectedTeamAScore = 1;
        $expectedTeamBScore = 1;
        $this->teamAMock->expects('getAmountOfGoals')->twice()->andReturn(5);
        $this->teamBMock->expects('getAmountOfGoals')->twice()->andReturn(5);

        $result = $this->matchService->getMatchResults($this->matchVO);

        $this->assertEquals($expectedTeamAScore, $result->getTeamAScore());
        $this->assertEquals($expectedTeamBScore, $result->getTeamBScore());
    }
}
