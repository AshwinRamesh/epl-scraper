<?php

include_once(__DIR__."/Season.php");

class DataSeason extends Season {

    function __construct($player_id, $data) {
        $this->set_playerId($player_id);
        $this->set_season($data[0]);
        $this->set_minutesPlayed($data[1]);
        $this->set_goals($data[2]);
        $this->set_assists($data[3]);
        $this->set_cleanSheet($data[4]);
        $this->set_goalsConceded($data[5]);
        $this->set_ownGoals($data[6]);
        $this->set_penaltiesSaved($data[7]);
        $this->set_penaltiesMissed($data[8]);
        $this->set_yellowCard($data[9]);
        $this->set_redCard($data[10]);
        $this->set_saves($data[11]);
        $this->set_bonus($data[12]);
        $this->set_esp($data[13]);
        $this->set_bps($data[14]);
        $this->set_value($data[15]);
        $this->set_points($data[16]);
    }

}


 ?>
