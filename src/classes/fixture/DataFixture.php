<?php

include_once("Fixture.php");
include_once(__DIR__."/../../classes/club/Club.php");
include_once(__DIR__."/../../classes/playerfixture/DataPlayerFixture.php");

class DataFixture extends Fixture {

    function __construct($dataArray, $team) {
        $this->set_home_goals(NULL);
        $this->set_away_goals(NULL);
        $this->set_played(0);
        if ($dataArray) {
            $this->parseDataToObject($dataArray, $team);
        }
    }

    function set_kickoff($kickoff) {
        $this->kickoff = Fixture::convert_kickoff_time($kickoff);
    }

    function set_round($round) {
        $data = explode(" ", $round);
        $this->round = (int) $data[1];
    }

    function set_opponent($opponent, $team) {
        $data = explode(" (", $opponent);
        if (strpos($data[1], "H") !== false) { // home game
            $this->set_home_team($team);
            $this->set_away_team(Club::get_club_id($data[0]));
        } else {
            $this->set_home_team(Club::get_club_id($data[0]));
            $this->set_away_team($team);
        }
    }

    public function parseDataToObject($data, $team) {
        try {
            $this->set_kickoff($data[0]);
            $this->set_round($data[1]);
            $this->set_opponent($data[2], $team);
        } catch (Exception $e) {
            echo "$e";
        }
    }

    public function save() {
        DB::insertUpdate("fixture", array(
            "gameweek" => $this->get_round(),
            "kickoff_time" => $this->get_kickoff(),
            "home_team" => $this->get_home_team(),
            "away_team" => $this->get_away_team(),
            "home_goals" => $this->get_home_goals(),
            "away_goals" => $this->get_away_goals(),
            "played" => ($this->get_played() ? $this->get_played() : 0)
        ));
    }

}

?>
