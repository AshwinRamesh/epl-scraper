<?php

include_once(__DIR__."/../../config/config.php");

class Club {

    // $club - string
    public function get_club_id($club) {
        $query = DB::query("SELECT id FROM club where name = %s", $club);
        if (sizeof($query) == 1) {
            return (int) $query[0]['id'];
        }
        return False;
    }

    public function get_club_id_by_short($club) {
        $query = DB::query("SELECT id FROM club where short_name = %s", $club);
        if (sizeof($query) == 1) {
            return (int) $query[0]['id'];
        }
        return False;
    }

    public function get_clubs() {
        return DB::query("SELECT * FROM club");
    }

}

 ?>
