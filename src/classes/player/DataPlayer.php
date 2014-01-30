<?php

/*
* @author Ashwin Ramesh
* This class represents one player in data form. This is done to insert player data into the database
*/

include_once(__DIR__."/Player.php");
include_once(__DIR__."/../../classes/fixture/DataFixture.php");
include_once(__DIR__."/../../classes/season/DataSeason.php");
include_once(__DIR__."/../../config/config.php");
include_once(__DIR__."/../../classes/club/Club.php");
include_once(__DIR__."/../../classes/playerfixture/DataPlayerFixture.php");


class DataPlayer extends Player {

    /* Takes an array of data (which has been converted from json and parses it into the object */
    function __construct($dataArray) {
        if ($dataArray) {
            $this->parseDataToObject($dataArray);
        }
    }

    public function parseDataToObject($data) {
        try {
            $this->set_transfersOut($data->transfers_out);
            $this->set_playerCode($data->code);
            $this->set_eventTotal($data->event_total);
            $this->set_lastSeasonPoints($data->last_season_points);
            $this->set_squadNumber($data->squad_number);
            $this->set_newsUpdated($data->news_updated);
            $this->set_eventCost($data->event_cost);
            $this->set_newsAdded($data->news_added);
            $this->set_webName($data->web_name);
            $this->set_inDreamTeam($data->in_dreamteam);
            $this->set_teamCode($data->team_code);
            $this->set_id($data->id);
            $this->set_shirtImageUrl($data->shirt_image_url);
            $this->set_firstName($data->first_name);
            $this->set_transfersOutEvent($data->transfers_out_event);
            $this->set_elementTypeId($data->element_type_id);
            $this->set_maxCost($data->max_cost);
            $this->set_eventExplain($data->event_explain);
            $this->set_selected($data->selected);
            $this->set_minCost($data->min_cost);
            $this->set_totalPoints($data->total_points);
            $this->set_typeName($data->type_name);
            $this->set_teamName($data->team_name);
            $this->set_status($data->status);
            $this->set_added($data->added);
            $this->set_form($data->form);
            $this->set_shirtMobileImageUrl($data->shirt_mobile_image_url);
            $this->set_currentFixture($data->current_fixture);
            $this->set_nowCost($data->now_cost);
            $this->set_pointsPerGame($data->points_per_game);
            $this->set_transfersIn($data->transfers_in);
            $this->set_news($data->news);
            $this->set_originalCost($data->original_cost);
            $this->set_eventPoints($data->event_points);
            $this->set_newsReturn($data->news_return);
            $this->set_nextFixture($data->next_fixture);
            $this->set_transfersInEvent($data->transfers_in_event);
            $this->set_selectedBy($data->selected_by);
            $this->set_teamId(Club::get_club_id($this->get_teamName()));
            $this->set_secondName($data->second_name);
            $this->set_photoMobileUrl($data->photo_mobile_url);
            $this->set_fixtures($data->fixtures->all, $this->get_teamId());
            $this->set_seasonHistory($data->season_history);
            $this->set_fixtureHistory($data->id, $data->fixture_history->all);
        } catch (Exception $e) {
            echo "Exception occured";
        }
    }

    public function set_fixtures($fixtures, $player_team) {
        $this->fixtures = array();
        foreach ($fixtures as $fixture) {
            $f = new DataFixture($fixture, $player_team);
            array_push($this->fixtures, $f);
        }
    }

    /* fix this to take player performance into account */
    public function set_fixtureHistory($player_id, $fixtures) {
        $this->fixtureHistory = array();
        foreach ($fixtures as $fixture) {
            $playerFixture = new DataPlayerFixture($fixture, $player_id);
            array_push($this->fixtureHistory, $playerFixture);
        }
    }

    public function set_seasonHistory($history) {
        $this->seasonHistory = array();
        foreach ($history as $season) {
            $s = new DataSeason($this->id, $season);
            array_push($this->seasonHistory, $s);
        }
    }
}

?>
