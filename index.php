<?php

require_once (__DIR__ . '/data.php');
require_once (__DIR__ . '/TeamCalc.php');

function match($c1, $c2)
{

    global $data;

    $averageGoals = TeamCalc::getAverageGoals($data);

    $team1 = $data[$c1];
    $team2 = $data[$c2];

    $team1Attack = ($team1['games'] > 0)
        ? ($team1['goals']['scored'] / $team1['games']) / $averageGoals['scored']
        : 0;
    $team1Defense = ($team1['games'] > 0)
        ? ($team1['goals']['skiped'] / $team1['games']) / $averageGoals['skiped']
        : 0;

    $team2Attack = ($team2['games'] > 0)
        ? ($team2['goals']['scored'] / $team2['games']) / $averageGoals['scored']
        : 0;
    $team2Defense = ($team2['games'] > 0)
        ? ($team2['goals']['skiped'] / $team2['games']) / $averageGoals['skiped']
        : 0;

    $g1 = $team1Attack * $team2Defense * $averageGoals['scored'];
    $g2 = $team2Attack * $team1Defense * $averageGoals['scored'];

    for ($x = 0; $x <= 5; $x++) {
        $goalsTeam1[] = round(TeamCalc::golaso($g1, $x) * 100);
        $goalsTeam2[] = round(TeamCalc::golaso($g2, $x) * 100);
    }

    $goal1 = TeamCalc::customRandom($goalsTeam1);
    $goal2 = TeamCalc::customRandom($goalsTeam2);

    return [$goal1, $goal2];

}





