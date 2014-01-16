<?php

/* Config for the website */
    include_once("base.php");
        var_dump($base);
    include_once("$base/lib/MeerkoDB/db.php"); // database library
    include_once("$base/classes/player/Player.php");
    include_once("$base/classes/player/DataPlayer.php");

    /* Database Library Config */
    DB::$user = 'ashwin';
    DB::$password = 'password';
    DB::$dbName = 'fpl_db';
    DB::$host = 'localhost'; //defaults to localhost if omitted
    DB::$encoding = 'utf8'; // defaults to latin1 if omitted

    // Injury Type Array
    $injuryStatus = array(

    );

    // Month name to number array
    $months = array(
        "Jan" => 1,
        "Feb" => 2,
        "Mar" => 3,
        "Apr" => 4,
        "May" => 5,
        "Jun" => 6,
        "Jul" => 7,
        "Aug" => 8,
        "Sep" => 9,
        "Oct" => 10,
        "Nov" => 11,
        "Dec" => 12
    );
?>
