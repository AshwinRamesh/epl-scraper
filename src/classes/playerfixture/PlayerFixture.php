<?php

include_once(__DIR__."/../../config/config.php");

class PlayerFixture {

    function get_playerId() {
        return $this->player_id;
    }

    function set_playerId($player_id) {
        $this->player_id = $player_id;
    }

    function get_fixtureId() {
        return $this->fixture_id;
    }

    function set_fixtureId($fixture_id) {
        $this->fixture_id = $fixture_id;
    }

    function get_minutesPlayed() {
        return $this->minutes_played;
    }

    function set_minutesPlayed($minutes_played) {
        $this->minutes_played = $minutes_played;
    }

    function get_goals() {
        return $this->goals;
    }

    function set_goals($goals) {
        $this->goals = $goals;
    }

    function get_assists() {
        return $this->assists;
    }

    function set_assists($assists) {
        $this->assists = $assists;
    }

    function get_cleanSheet() {
        return $this->clean_sheet;
    }

    function set_cleanSheet($clean_sheet) {
        $this->clean_sheet = $clean_sheet;
    }

    function get_goalsConceded() {
        return $this->goals_conceded;
    }

    function set_goalsConceded($goals_conceded) {
        $this->goals_conceded = $goals_conceded;
    }

    function get_ownGoals() {
        return $this->own_goals;
    }

    function set_ownGoals($own_goals) {
        $this->own_goals = $own_goals;
    }

    function get_penaltiesSaved() {
        return $this->penalties_saved;
    }

    function set_penaltiesSaved($penalties_saved) {
        $this->penalties_saved = $penalties_saved;
    }

    function get_penaltiesMissed() {
        return $this->penalties_missed;
    }

    function set_penaltiesMissed($penalties_missed) {
        $this->penalties_missed = $penalties_missed;
    }

    function get_yellowCard() {
        return $this->yellow_card;
    }

    function set_yellowCard($yellow_card) {
        $this->yellow_card = $yellow_card;
    }

    function get_redCard() {
        return $this->red_card;
    }

    function set_redCard($red_card) {
        $this->red_card = $red_card;
    }

    function get_saves() {
        return $this->saves;
    }

    function set_saves($saves) {
        $this->saves = $saves;
    }

    function get_bonus() {
        return $this->bonus;
    }

    function set_bonus($bonus) {
        $this->bonus = $bonus;
    }

    function get_eaSportsPPI() {
        return $this->ea_sports_ppi;
    }

    function set_eaSportsPPI($ea_sports_ppi) {
        $this->ea_sports_ppi = $ea_sports_ppi;
    }

    function get_bonusPointSystem() {
        return $this->bonus_point_system;
    }

    function set_bonusPointSystem($bonus_point_system) {
        $this->bonus_point_system = $bonus_point_system;
    }

    function get_netTransfers() {
        return $this->net_transfers;
    }

    function set_netTransfers($net_transfers) {
        $this->net_transfers = $net_transfers;
    }

    function get_costValue() {
        return $this->cost_value;
    }

    function set_costValue($cost_value) {
        $this->cost_value = $cost_value;
    }

    function get_points() {
        return $this->points;
    }

    function set_points($points) {
        $this->points = $points;
    }



}


 ?>
