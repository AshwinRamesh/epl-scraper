<?php

/* Scrape all player data and store it */

const PLAYER_API_URL = "http://fantasy.premierleague.com/web/api/elements/"; // remember to add id and '/' after url
const STARTING_ID = 1; // starting id to scrape

// player url - http://fantasy.premierleague.com/web/api/elements/<id>

function get_json_by_id($id) {
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, PLAYER_API_URL."{$id}/");
    curl_setopt($curl, CURLOPT_HEADER, 0);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $data = curl_exec($curl);
    curl_close($curl);
    $data = json_decode($data);
    if (!$data) {
        return False;
    }
    return $data;
}

/* Temp */
function writeData($filename) {
    echo("Beginning Scraper\n");
    $i = STARTING_ID;
    $new_player = true;
    $player_array = array();
    while ($new_player) {
        $data = get_json_by_id($i);
        if (!$data) {
            $new_player = false;
        } else {
            array_push($player_array, $data);
            echo("Processed id $i\n");
            $i = $i + 1;
        }
    }
    $data_string = json_encode($player_array);
    $f = fopen($filename, "w+");
    fwrite($f, $data_string);
    fclose($f);
    echo "Player Scrape Completed.\n";
}

function main() {
    global $argc, $argv;
    if (sizeof($argv) == 1) {
        echo("Please specify a file to write to. \n");
        exit(1);
    }
    writeData($argv[1]);
    exit(0);
}

main();
?>
