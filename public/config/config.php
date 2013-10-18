<?php

/* Config for the website */
    include_once(dirname(__FILE__)."/../lib/db.php"); // database library

    /* Database Library Config */
    DB::$user = 'ashwin';
    DB::$password = 'password';
    DB::$dbName = 'fpl_db';
    DB::$host = 'localhost'; //defaults to localhost if omitted
    DB::$encoding = 'utf8'; // defaults to latin1 if omitted

?>
