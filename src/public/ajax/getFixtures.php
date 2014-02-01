<?php
    require_once(__DIR__."/../../config/config.php");
    $resultArray = array();

    $gameweek = DB::queryFirstRow("select gameweek from fixture where fixture.played = 0 order by gameweek asc limit 1;");

    if (!$gameweek) { // season is finished
        $gameweek = 38; // last round of fixtures
    } else {
        $gameweek = (int) $gameweek['gameweek'];
    }

    $query = "select fixture.*, c1.name as home, c2.name as away from fixture ";
    $query .= "join club as c1 on c1.id = fixture.home_team ";
    $query .= "join club as c2 on c2.id = fixture.away_team ";
    $query .= "where gameweek = %d order by kickoff_time asc;";

    $fixtures = DB::query($query, $gameweek);

    $resultArray['gameweek'] = $gameweek;
    $resultArray['fixtures'] = $fixtures;

    return json_encode($resultArray);

?>
