<?php
/*
    MY CRAZY PROBLEM
    ----------------
- Each team has 15 players
- Each team has 2 GK, 5 Def, 5 Mid, 3 Strikers
- Each team can only have a maximum of 3 players from the same club
- Each team can only value a total of $X, where X is predefined
- Each player has a "now_cost" and a "points_per_game" value (both decimal)

Assumptions
-----------
We reduced the dataset with the following conditions
    - Player is 100% fit to play the upcoming games
    - Player has a points_per_game > 2
    - Player has total_points >= 30
    - Player's now_cost/points_per_game < 2.2


Find the best 15 players for the remaining dataset
which maximises the total(points_per_game)


IN HINDSIGHT THIS WILL NOT WORK. WELL IT WILL IF YOU RUN THIS FOREVER, BUT IT IS SOOOO INEFFECIENT.

*/

include_once(__DIR__."/../../config/config.php");

const MAX_PLAYERS = 3;

$query  = "select player.fpl_id as id, player.club_id as club, player.first_name as first, player.second_name as last, player.points_per_game as ppg, cost.now_cost as c, player_type.type as type ";
$query .= "from player join player_cost as cost on cost.player_id = player.fpl_id ";
$query .= "join player_type on player_type.id = player.type ";
$query .= "join player_news on player_news.player_id = player.fpl_id ";
$query .= "where player_news.status = %s and player.points_per_game > 3.0";
$query .= "and player.total_points >= 40 and (cost.now_cost/player.points_per_game < 2.0) ";
$query .= "and player_type.type = %s ";
$query .= "order by player_type.type desc, player.points_per_game desc, cost.now_cost asc ";

$goalkeepers = DB::query($query, "a", "Goalkeeper");
$defenders = DB::query($query, "a", "Defender");
$midfielders = DB::query($query, "a", "Midfielder");
$forwards = DB::query($query, "a", "Forward");

echo("Number of Goalkeepers: " . sizeof($goalkeepers) . "\n");
echo("Number of Defenders: " . sizeof($defenders) . "\n");
echo("Number of Midfielders: " . sizeof($midfielders) . "\n");
echo("Number of Forwards: " . sizeof($forwards) . "\n");
/* Naive Approach */

// return an array of arrays, which represents the unordered combination of x items ($num) from the initaial array ($items)
function combinations($items, $num) {
    $returnArray = array();
    if (sizeof($items) == $num) { // required = remaining --> return that array
        return array($items); // make sure this is a copy
    }
    if ($num == 0) { // number of items required has been reached -> return empty array
        return array();
    }
    // otherwise
    $item = array(array_shift($items));
    $temp = combinations($items, $num-1);
    $partA = array();
    if (sizeof($temp) == 0) {
        $partA = array($item);
    }
    foreach ($temp as $t) {
        if (is_array($t)) {
            $partA[] = array_merge($item, $t);
        } else {
            $partA[] = array_merge($item, array($t));
        }
    }
    $partB = combinations($items, $num);
    echo("Boop" . rand(1,100) . "\n");
    return array_merge($partA, $partB);
}

// the cull function
function cull($groups) {
    $results = array();
    foreach ($groups as $group) {
        $count = array();
        $pass = true;
        foreach ($group as $player) {
            $c = $count[(int)$player['club']];
            $count[(int)$player['club']] = ($c ? $c + 1 : 1);
        }
        for ($i=1; $i<=20; $i++) {
            if ($count[$i] && $count[$i] > MAX_PLAYERS) {
                $pass = false;
                break;
            }
        }
        if ($pass) {
            $results[] = $group;
        }
    }
    return $results;
}


// get all permutations of players of each kind to meet minumum number --> cull any permutation that has > 3 from one team
$gkCombos = combinations($goalkeepers, 2);
echo("Size of gk combo: " . sizeof($gkCombos) . "\n");

$fwCombos = combinations($forwards, 5);
echo("Size of fw combo: " . sizeof($fwCombos) . "\n");

$defCombos = combinations($defenders, 5);
echo("Size of def combo: " . sizeof($defCombos) . "\n");
exit();

$midCombos = combinations($midfielders, 5);
echo("Size of mid combo: " . sizeof($midCombos) . "\n");


exit();
// get all permutations of the 4 groups --> cull any with > 3 players from one team
function mergeCombos($gk, $df, $md, $fw) {
    $results = array();
    foreach ($gk as $g) {
        foreach ($df as $d) {
            foreach ($md as $m) {
                foreach ($fw as $f) {
                    $results[] = array_merge($g, $d, $m, $f);
                }
            }
        }
    }
}

// result sets
$f = fopen("data333.json", "a+");
fwrite($f, json_encode(mergeCombos($gkCombos, $defCombos, $midCombos, $fwCombos)));
fclose($f);
echo("Done lolz");
 ?>
