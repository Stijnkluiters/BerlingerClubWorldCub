<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Cub World Cub</title>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="f">
    <div class="container px-4 py-5">
        <h2 class="pb-2 border-bottom">Cub World Cub</h2>
            <div class="d-flex flex-column gap-2">
                <h4 class="fw-semibold mb-0">Latest League</h4>
                <p class="text-muted">Displaying the latests played league from today!</p>

                <hr/>
                <h4>End scores:</h4>
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Score</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($leagueResult->getTeamScores() as $teamName => $teamScore)
                            <tr>
                                <td>{{ $teamName  }}</td>
                                <td>{{ $teamScore  }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <h4>Matches:</h4>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Team A</th>
                        <th>Team B</th>
                        <th>Score</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($leagueResult->getMatchResults() as $matchResult)
                        <tr>
                            <td>
                                {{ $matchResult->getTeamA()->getName() }}
                            </td>
                            <td>
                                {{ $matchResult->getTeamB()->getName() }}
                            </td>
                            <td>
                                {{ $matchResult->getTeamA()->getAmountOfGoals() }} -  {{ $matchResult->getTeamB()->getAmountOfGoals() }}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    </body>
