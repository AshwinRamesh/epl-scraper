<?php
include_once(__DIR__."/../../classes/club/Club.php");

function create_fixtures() {
    echo("Bootstraping Fixtures...\n");
    $clubs = Club::get_clubs();

    while (sizeof($clubs) > 1) {
        $club = array_pop($clubs);
        echo("Processing ". $club["name"] ."\n");
        foreach($clubs as $c) {
            DB::insertUpdate('fixture', array(
                "home_team" => $club["id"],
                "away_team" => $c["id"]
            ));
            DB::insertUpdate('fixture', array(
                "home_team" => $c["id"],
                "away_team" => $club["id"]
            ));
        }
    }
    echo("Processing " . $clubs[0]["name"] . "\n");
    echo("Initial fixtures created.\n");
}
 ?>
