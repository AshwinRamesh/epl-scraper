<?php

class Season {


    function get_playerId() {
        return $this->playerId;
    }

    function get_season() {
        return $this->season;
    }

    function get_minutesPlayed() {
        return $this->minutesPlayed;
    }

    function get_goals() {
        return $this->goals;
    }

    function get_assists() {
        return $this->assists;
    }

    function get_cleanSheet() {
        return $this->cleanSheet;
    }

    function get_goalsConceded() {
        return $this->goalsConceded;
    }

    function get_ownGoals() {
        return $this->ownGoals;
    }

    function get_penaltiesSaved() {
        return $this->penaltiesSaved;
    }

    function get_penaltiesMissed() {
        return $this->penaltiesMissed;
    }

    function get_yellowCard() {
        return $this->yellowCard;
    }

    function get_redCard() {
        return $this->redCard;
    }

    function get_saves() {
        return $this->saves;
    }

    function get_bonus() {
        return $this->bonus;
    }

    function get_esp() {
        return $this->esp;
    }

    function get_value() {
        return $this->value;
    }

    function get_points() {
        return $this->points;
    }

    function get_bps() {
        return $this->bps;
    }

    function set_bps($bps) {
        $this->bps = $bps;
    }

    function set_playerId($id) {
        $this->playerId = $id;
    }

    function set_season($season) {
        $this->season = $season;

    }

    function set_minutesPlayed($minutes) {
        $this->minutesPlayed = $minutes;
    }

    function set_goals($goals) {
        $this->goals = $goals;
    }

    function set_assists($assists) {
        $this->assists = $assists;
    }

    function set_cleanSheet($cleansheets) {
        $this->cleanSheet = $cleansheets;
    }

    function set_goalsConceded($concended) {
        $this->goalsConceded = $concended;
    }

    function set_ownGoals($goals) {
        $this->ownGoals = $goals;
    }

    function set_penaltiesSaved($saved) {
        $this->penaltiesSaved = $saved;
    }

    function set_penaltiesMissed($missed) {
        $this->penaltiesMissed = $missed;
    }

    function set_yellowCard($cards) {
        $this->yellowCard = $cards;
    }

    function set_redCard($cards) {
        $this->redCard = $cards;
    }

    function set_saves($saves) {
        $this->saves = $saves;
    }

    function set_bonus($bonus) {
        $this->bonus = $bonus;
    }

    function set_esp($esp) {
        $this->esp = $esp;
    }

    function set_value($value) {
        $this->value = $value;
    }

    function set_points($points) {
        $this->points = $points;
    }

    function save() {
        DB::insertUpdate('player_history', array(
            "player_id" => $this->get_playerId(),
            "season" => $this->get_season(),
            "minutes_played" => $this->get_minutesPlayed(),
            "goals" => $this->get_goals(),
            "assists" => $this->get_assists(),
            "clean_sheet" => $this->get_cleanSheet(),
            "goals_conceded" => $this->get_goalsConceded(),
            "own_goals" => $this->get_ownGoals(),
            "penalties_saved" => $this->get_penaltiesSaved(),
            "penalties_missed" => $this->get_penaltiesMissed(),
            "yellow_card" => $this->get_yellowCard(),
            "red_card" => $this->get_redCard(),
            "saves" => $this->get_saves(),
            "bonus" => $this->get_bonus(),
            "esp" => $this->get_esp(),
            "bps" => $this->get_bps(),
            "value" => $this->get_value(),
            "points" => $this->get_points()
        ));
    }

}


 ?>
