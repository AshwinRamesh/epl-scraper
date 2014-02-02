<?php
    require_once(__DIR__."/../../config/config.php");

    $query = "select player.* , club.name as club, player_cost.now_cost as cost from player";
    $query .=" join club on club.id = player.club_id join player_cost on player_cost.player_id = player.fpl_id";
    $queryAnd = $query . " where first_name like %ss and second_name like %ss";
    $queryOr = $query . " where first_name like %ss or second_name like %ss";

    if ($_GET['query']) {
        $get = explode(" ", $_GET['query'], 2);
        if (sizeof($get) == 2) {
            $result = DB::query($queryAnd, $get[0], $get[1]);
        } else {
            $result = DB::query($queryOr, $get[0], $get[0]);
        }
        if (sizeof($result) > 0) {
            echo(json_encode($result));
            return;
        }
    }
    echo(json_encode(array("outcome" => false)));
    return;
?>
