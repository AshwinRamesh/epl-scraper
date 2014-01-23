<?php

class Fixture {

    function __construct() {}

    /* Setters/Getters */
    function get_id() {
        return $this->id;
    }

    public static function convert_kickoff_time($kickoff) {
        $data = explode(" ", $kickoff);
        $month = Fixture::get_month_year_array();
        $timezone = Fixture::get_match_timezone();
        $timestamp = $month[$data[1]]["year"] . "-" . $month[$data[1]]["month"] . "-" . $data[0] . " {$data[2]}:00";
        $date = new DateTime($timestamp, $timezone);
        return $date->format("Y-m-d H:i:s");
    }

    public static function get_month_year_array() {
        return array( // change this according to season
            "Aug" => array("year" => 2013, "month" => 8),
            "Sep" => array("year" => 2013, "month" => 9),
            "Oct" => array("year" => 2013, "month" => 10),
            "Nov" => array("year" => 2013, "month" => 11),
            "Dec" => array("year" => 2013, "month" => 12),
            "Jan" => array("year" => 2014, "month" => 1),
            "Feb" => array("year" => 2014, "month" => 2),
            "Mar" => array("year" => 2014, "month" => 3),
            "Apr" => array("year" => 2014, "month" => 4),
            "May" => array("year" => 2014, "month" => 5)
        );
    }

    public static function get_match_timezone() {
        return new DateTimeZone("Europe/London");
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

    function get_played() {
        return $this->played;
    }

    function set_played($played) {
        $this->played = $played;
    }

    function get_result() {
        return array(
            "winner" => (($this->get_home_goals() != $this->get_away_goals() && $this->get_home_goals() > $this->get_away_goals()) ? $this->get_home_team() : $this->get_away_team()),
            "loser" => (($this->get_home_goals() != $this->get_away_goals() && $this->get_home_goals() > $this->get_away_goals()) ? $this->get_away_team() : $this->get_home_team()),
            "draw" => (($this->get_home_goals() == $this->get_away_goals())? true : false),
            "home_team" => $this->get_home_team(),
            "away_team" => $this->get_away_team(),
            "home_team_goals" => $this->get_home_goals(),
            "away_team_goals" => $this->get_away_goals()
            );
    }


}


 ?>
