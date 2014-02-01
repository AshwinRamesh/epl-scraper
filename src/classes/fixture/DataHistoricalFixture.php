<?php

include_once(__DIR__."/../../classes/fixture/DataFixture.php");


class DataHistoricalFixture extends DataFixture{

    function __construct($dataArray, $team) {
        if ($dataArray) {
            $this->parseDataToObject($dataArray, $team);
        }
    }

    function parseDataToObject($data, $team) {
        try {
            $this->set_kickoff($data[0]);
            $this->set_round((int)$data[1]);
            $this->set_opponent($data[2], $team);
        } catch (Exception $e) {
            echo($e);
        }
    }

    function set_round($round) {
        $this->round = $round;
    }

    function set_opponent($opponent, $team) {
        $data = explode(" ", $opponent);
        $opp = explode("(", $data[0]);
        if (strpos($opp[1], "H") !== false) { // home game
            $this->set_home_team($team);
            $this->set_away_team(Club::get_club_id_by_short($opp[0]));
        } else {
            $this->set_home_team(Club::get_club_id_by_short($opp[0]));
            $this->set_away_team($team);
        }
        // fucking retarded api have to do this shit...
        if (sizeof($data) == 2) { // fixture played
            $goals = explode("-", $data[1]);
            if (sizeof($goals) == 1) { // cant set goals since game hasnt been played for the round
                $this->set_played(0);
                $this->set_home_goals(NULL);
                $this->set_away_goals(NULL);
                return;
            } else {
                $this->set_played(1);
            }
            if ($this->get_home_team() == $team) { // 1-0 home win
                $this->set_home_goals((int)$goals[0]);
                $this->set_away_goals((int)$goals[1]);
            } else { //0-1 away loss
                $this->set_home_goals((int)$goals[1]);
                $this->set_away_goals((int)$goals[0]);
            }
        }
    }

    function save() {
        if (isset($this->homeGoals) && isset($this->awayGoals)) {
            DB::insertUpdate("fixture", array(
                "gameweek" => $this->get_round(),
                "kickoff_time" => $this->get_kickoff(),
                "home_team" => $this->get_home_team(),
                "away_team" => $this->get_away_team(),
                "home_goals" => $this->get_home_goals(),
                "away_goals" => $this->get_away_goals(),
                "played" => $this->get_played()
            ));
        } else {
            parent::save();
        }
    }

}

 ?>
