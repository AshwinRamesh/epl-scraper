<?php
// This file is needed because the fpl data does not store what team a
// player played for when he got a result. Thus a selected amount of players have been chosen to write these fixtures to the database.

include_once(__DIR__."/../../classes/fixture/DataHistoricalFixture.php");

function parse_past_fixtures($data) {

    $players = array(
        59936, // Szczesny
        1882,  // Given
        66797, // Mignolet
        15144, // Marshall
        11334, // Cech
        11554, // Speroni
        15337, // Howard
        10318, // Stekelenburg
        12390, // McGregor
        15749, // Hart
        51940, // De Gea
        20480, // Krul
        19236, // Ruddy
        18726, // Boruc
        40349, // Stoke City
        20531, // Sunderland
        39215, // Vorm
        37915, // Lloris
        9089,  // Foster
        42525, // Henderson
    );
    if (in_array((int)$data->code, $players)) {
        $history = $data->fixture_history->all;
        foreach ($history as $game) {
            $fixture = new DataHistoricalFixture($game, Club::get_club_id($data->team_name));
            $fixture->save();
            echo("Parsed fixtures for {$data->team_name}");
        }
    }

}



 ?>
