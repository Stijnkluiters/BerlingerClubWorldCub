<?php

namespace Tests\Unit\Services;

use App\Factory\GoalFactory;
use App\Factory\MatchFactory;
use App\Repostitories\LeagueRepository;
use App\Repostitories\MatchRepository;
use App\Services\LeagueService;
use App\Services\MatchService;
use App\Services\ValueObjects\MatchVO;
use Mockery;
use Mockery\Adapter\Phpunit\MockeryTestCase;
use App\Services\ValueObjects\Team;

class LeagueServiceTest extends MockeryTestCase
{
    private Mockery\LegacyMockInterface|Mockery\MockInterface|Team $teamAMock;
    private Mockery\LegacyMockInterface|Mockery\MockInterface|Team $teamBMock;
    private Mockery\LegacyMockInterface|Mockery\MockInterface|Team $teamCMock;
    private MatchVO|Mockery\LegacyMockInterface|Mockery\MockInterface $matchVO;
    private LeagueRepository|Mockery\LegacyMockInterface|Mockery\MockInterface $leagueRepository;
    private Mockery\LegacyMockInterface|MatchFactory|Mockery\MockInterface $matchFactory;
    private LeagueService|Mockery\LegacyMockInterface|MatchService|Mockery\MockInterface $matchService;
    private LeagueService $leagueService;
    private Mockery\LegacyMockInterface|MatchRepository|Mockery\MockInterface $matchRepository;
    private Mockery\LegacyMockInterface|Mockery\MockInterface|GoalFactory $goalFactory;

    protected function setUp(): void
    {
        $this->leagueRepository = Mockery::mock(LeagueRepository::class);
        $this->matchService = Mockery::mock(MatchService::class);
        $this->matchFactory = Mockery::mock(MatchFactory::class);
        $this->matchRepository = Mockery::mock(MatchRepository::class);
        $this->teamAMock = Mockery::mock(Team::class);
        $this->teamBMock = Mockery::mock(Team::class);
        $this->teamCMock = Mockery::mock(Team::class);
        $this->matchVO = Mockery::mock(MatchVO::class);

        $this->goalFactory = Mockery::mock(GoalFactory::class);

        $this->leagueService = new LeagueService(
            $this->leagueRepository,
            $this->matchService,
            $this->matchFactory,
            $this->goalFactory,
            $this->matchRepository,
        );

        $this->matchVO->shouldReceive('getTeamA')->andReturn($this->teamAMock);
        $this->matchVO->shouldReceive('getTeamB')->andReturn($this->teamBMock);
    }

    public function test_createLeague_should_return_2_match_when_provided_2_teams()
    {
        $expectedLeagueName = 'test_league_the_first';
        $this->teamAMock->expects('getName')->times(4)->andReturn('Team A');
        $this->teamBMock->expects('getName')->times(4)->andReturn('Team B');
        $this->matchFactory->shouldReceive('createMatch')
            ->andReturn($this->matchVO);
        ;

        $result = $this->leagueService->createLeague($expectedLeagueName, $this->teamAMock, $this->teamBMock);

        $this->assertEquals($expectedLeagueName, $result->getName());
        $this->assertEquals(2, count($result->getMatches()));
    }

    public function test_createLeague_should_return_6_match_when_provided_3_teams()
    {
        $expectedLeagueName = 'test_league_the_second';
        $this->teamAMock->expects('getName')->times(6)->andReturn('Team A');
        $this->teamBMock->expects('getName')->times(6)->andReturn('Team B');
        $this->teamCMock->expects('getName')->times(6)->andReturn('Team C');

        $this->matchFactory->shouldReceive('createMatch')
            ->andReturn($this->matchVO);

        $result = $this->leagueService->createLeague('test_league_the_second', $this->teamAMock, $this->teamBMock, $this->teamCMock);

        $this->assertEquals($expectedLeagueName, $result->getName());
        $this->assertEquals(6, count($result->getMatches()));
    }
}
