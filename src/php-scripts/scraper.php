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


/* Store all player data in a given file */
function get_all_data($filename) {
    $i = 1; // index of api
    $new_player = True; // check if returned item is infact in correct format
    $f = fopen($filename, "w+");
    fwrite($f, "[\n");
    while ($new_player == True) {
        $data = get_json_by_id($i);
        if ($data == False) {
            $new_plater = False;
            break;
        }
        fwrite($f, json_encode($data));
        fwrite($f, ",\n");
        echo "Processed id $i\n";
        $i = $i + 1;
    }
    fwrite($f, "{'end':true}]\n");
    fclose($f);
    echo("Collection Complete.");
}

/* Temp */
function writeData($filename) {
    $i = STARTING_ID;
    $new_player = true;
    $player_array = array();
    while ($new_player) {
        $data = get_json_by_id($i);
        if (!$data) {
            $new_player = false;
        }
        array_push($player_array, $data);
        echo "Processed id $i\n";
        $i = $i + 1;
        if ($i == 11) {
            break;
        }
    }
    $data_string = json_encode($player_array);
    $f = fopen($filename, "w+");
    fwrite($f, $data_string);
    fclose($f);
    echo "Player Scrape Completed.\n";
}


//get_all_data("data3.json");
    writeData("data3.json");
?>
