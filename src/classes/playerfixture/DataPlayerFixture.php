<?php

include_once(__DIR__."/../../classes/playerfixture/PlayerFixture.php");
include_once(__DIR__."/../../classes/fixture/Fixture.php");
include_once(__DIR__."/../../classes/club/Club.php");

class DataPlayerFixture extends PlayerFixture {

    function __construct($dataArray, $player_id) {
        if ($dataArray) {
            $this->parseDataToObject($dataArray, $team);
        }
    }

    function parseDataToObject($data, $player_id) {
        try {
            $this->set_playerId($player_id);
            $this->set_fixtureId($this->get_fixture_id($dataArray[1], $dataArray[0], $dataArray[2]));
            $this->set_minutesPlayed($data[3]);
            $this->set_goals($data[4]);
            $this->set_assists($data[5]);
            $this->set_cleanSheet($data[6]);
            $this->set_goalsConceded($data[7]);
            $this->set_ownGoals($data[8]);
            $this->set_ownGoals($data[9]);
            $this->set_penaltiesSaved($data[10]);
            $this->set_penaltiesMissed($data[11]);
            $this->set_yellowCard($data[12]);
            $this->set_redCard($data[13]);
            $this->set_saves($data[14]);
            $this->set_bonus($data[15]);
            $this->set_eaSportsPPI($data[16]);
            $this->set_bonusPointSystem($data[17]);
            $this->set_netTransfers($data[18]);
            $this->set_costValue($data[19]);
            $this->set_points($data[20]);
        } catch (Exception $e) {
            echo "$e";
        }
    }

    public static function get_fixture_id($round, $date, $team) {
        $query = "SELECT id FROM fixture WHERE gameweek = %d AND kickoff_time = %s AND";
        $team = explode(" ", $team);
        $team = explode("(", $team[0]);
        $team_id = Club::get_club_id_by_short($team[0]);
        if (strpos($team[1], "A") === false) { // playing at home
            $query = $query . " away_team = %d";
        } else { // playing away
            $query = $query . " home_team = %d";
        }
        $query = $query . " LIMIT 1";
        $result = DB::query($query, $round, Fixture::convert_kickoff_time($date), $team_id);
        if (sizeof($result) == 1) {
            return (int) $result[0]['id'];
        }
        return false;
    }

}

 ?>
