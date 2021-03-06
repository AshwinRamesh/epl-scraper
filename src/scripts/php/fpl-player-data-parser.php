<?php
include_once(__DIR__."/bootstrap-fixtures.php");
include_once(__DIR__."/parse-past-fixtures.php");
include_once(__DIR__."/../../classes/player/DataPlayer.php");

function writeDataToDB($datafile) {
    $f = fopen($datafile, "r");
    $data = fread($f, filesize($datafile));
    $data = json_decode($data);
    parse_past_fixtures($data);
    foreach ($data as $player_data) {
        $player = new DataPlayer($player_data);
        $player->save();
    }
}


function main() {
    global $argc, $argv;
    if (sizeof($argv) == 1) {
        echo("Please specify a file to read. \n");
        exit(1);
    } else if (!file_exists($argv[1])) {
        echo("File does not exist. Aborting. \n");
        exit(1);
    }
    create_fixtures();
    writeDataToDB($argv[1]);
    echo("Finished write to DB");
    exit(0);
}

main();

?>
