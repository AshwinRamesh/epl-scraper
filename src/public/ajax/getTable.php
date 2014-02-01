<?php
    require_once(__DIR__."/../../config/config.php");
    $resultArray = array();

    $sql = "SELECT o.* ,";
    $sql .= "(o.home_wins + o.away_wins) as win, ";
    $sql .= "(o.away_loss + o.home_loss) as lose, ";
    $sql .= "(o.home_draws + o.away_draws) as draw, ";
    $sql .= "(3 * (o.home_wins + o.away_wins) + (o.home_draws + o. away_draws)) as points, "
    $sql .= "(o.home_draws + o.away_draws + o.home_wins + o.away_wins + o.home_loss + o.away_loss) as games ";
    $sql .= "FROM ( ";
    $sql .= "SELECT ";
    $sql .= "    SUM(CASE WHEN home_goals = away_goals AND home_team = %d THEN 1 ELSE 0 END) AS home_draws,";
    $sql .= "    SUM(CASE WHEN home_goals = away_goals AND away_team = %d THEN 1 ELSE 0 END) AS away_draws,";
    $sql .= "    SUM(CASE WHEN home_goals > away_goals AND home_team = %d THEN 1 ELSE 0 END) AS home_wins,";
    $sql .= "    SUM(CASE WHEN home_goals < away_goals AND away_team = %d THEN 1 ELSE 0 END) AS away_wins,";
    $sql .= "    SUM(CASE WHEN home_goals < away_goals AND home_team = %d THEN 1 ELSE 0 END) AS home_loss,";
    $sql .= "    SUM(CASE WHEN home_goals > away_goals AND away_team = %d THEN 1 ELSE 0 END) AS away_loss,";
    $sql .= "    club.name";
    $sql .= " FROM fixture join club on club.id = %d WHERE home_team = %d OR away_team = %d) as o";

    for ($i=1; $i <21 ; $i++) {
        $res = DB::query($sql, $i, $i, $i, $i, $i, $i, $i, $i);
        array_push($resultArray, $res);
    }
    return json_encode($resultArray);

?>
