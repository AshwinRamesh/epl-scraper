<?php
    require_once(__DIR__."/../../config/config.php");

    $query = "select player.* , club.name as club, player_cost.now_cost as cost from player";
    $query .=" join club on club.id = player.club_id join player_cost on player_cost.player_id = player.fpl_id";
    $query .=" where first_name like %ss or second_name like %ss";

    if ($_GET['query']) {
        $result = DB::query($query, $_GET['query'], $_GET['query']);
        if (sizeof($result) > 0) {
            echo(json_encode($result));
            return;
        }
    }
    echo(json_encode(array("outcome" => false)));
    return;
?>
