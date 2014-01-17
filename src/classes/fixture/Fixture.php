<?php

class Fixture {

    function __construct() {}

    /* Setters/Getters */
    function get_id() {
        return $this->id;
    }

    function set_id($id) {
        if (is_int($id)) {
            $this->id = $id;
        }
    }

    function get_round() {
        return $this->round ;
    }

    function set_round($round) {
        if (is_int($round)) {
            $this->round = $round;
        }
    }

    function get_kickoff() {
        return $this->kickoff ;
    }

    function set_kickoff($ko) {
        $this->kickoff = $ko;
    }

    function get_home_team() {
        return $this->home ;
    }

    function set_home_team($home) {
        $this->home = $home;
    }

    function get_away_team() {
        return $this->away ;
    }

    function set_away_team($away) {
        $this->away = $away;
    }

    function get_home_goals() {
        return $this->homeGoals ;
    }

    function set_home_goals($homeGoals) {
        $this->homeGoals = $homeGoals;
    }

    function get_away_goals() {
        return $this->awayGoals ;
    }
    function set_away_goals($awayGoals) {
        $this->awayGoals = $awayGoals;
    }

    function get_result() {
        return $this->result ;
    }

    function set_result() { // array

    }

}


 ?>
