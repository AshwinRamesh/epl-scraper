<?php

include_once(__DIR__."/../../config/config.php");
include_once(__DIR__."/../../classes/club/Club.php");

class Player {

    function __construct() {

    }

    /* Getters and Setters */

    function get_transfersOut() {
        return $this->transfersOut;
    }

    function set_transfersOut($transfers) {
        if (is_int($transfers)) {
            $this->trasnfersOut = $transfers;
        }
    }

    function get_playerCode() {
        return $this->playerCode;
    }

    function set_playerCode($code) {
        if (is_int($code)) {
            $this->playerCode = $code;
        }
    }

    function get_eventTotal() {
        return $this->eventTotal;
    }

    function set_eventTotal($total) {
        if (is_int($total)) {
            $this->eventTotal = $total;
        }
    }

    function get_lastSeasonPoints() {
        return $this->lastSeasonPoints;
    }

    function set_lastSeasonPoints($points) {
        if (is_int($points)) {
            $this->lastSeasonPoints = $points;
        }
    }

    function get_squadNumber() {
        return $this->squadNumber;
    }

    function set_squadNumber($number) {
        if (is_int($number)) {
            $this->squadNumber = $number;
        } else {
            $this->squadNumber = null;
        }
    }

    function get_newsUpdated() {
        return $this->newsUpdated;
    }

    function set_newsUpdated($news) {
        $this->newsUpdated = $news;
    }

    function get_eventCost() {
        return $this->eventCost;
    }

    function set_eventCost($cost) {
        if (is_int($cost)) {
            $this->eventCost = $cost / 10.0;
        }
    }

    function get_newsAdded() {
        return $this->newsAdded;
    }

    function set_newsAdded($news) {
        $this->newsAdded = $news;
    }

    function get_webName() {
        return $this->webName;
    }

    function set_webName($name) {
        $this->webName = $name;
    }

    function get_inDreamTeam() {
        return $this->inDreamTeam;
    }

    function set_inDreamTeam($inTeam) {
        if (is_bool($inTeam)) {
            $this->inDreamTeam = $inTeam;
        }
    }

    function get_teamCode() {
        return $this->teamCode;
    }

    function set_teamCode($code) {
        if (is_int($code)) {
            $this->teamCode = $code;
        }
    }

    function get_id() {
        return $this->id;
    }

    function set_id($id) {
        if (is_int($id)) {
            $this->id = $id;
        }
    }

    function get_shirtImageUrl() {
        return $this->shirtImageUrl;
    }

    function set_shirtImageUrl($url) {
        $this->shirtImageUrl = $url;
    }

    function get_firstName() {
        return $this->firstName;
    }

    function set_firstName($name) {
        $this->firstName = $name;
    }

    function get_transfersOutEvent() {
        return $this->transfersOutEvent;
    }

    function set_transfersOutEvent($transfers) {
        if (is_int($transfers)) {
            $this->transfersOutEvent = $transfers;
        }
    }

    function get_elementTypeId() {
        return $this->elementTypeId;
    }

    function set_elementTypeId($type) {
        if (is_int($type)) {
            $this->elementTypeId = $type;
        }
    }

    function get_maxCost() {
        return $this->maxCost;
    }

    function set_maxCost($cost) {
        if (is_int($cost)) {
            $this->maxCost = $cost / 10.0;
        }
    }

    function get_eventExplain() {
        return $this->eventExplain;
    }

    function set_eventExplain($event) {
        $this->eventExplain = $event;
    }

    function get_selected() {
        return $this->selected;
    }
    function set_selected($selected) {
        if (is_int($selected)) {
            $this->selected = $selected;
        }
    }

    function get_minCost() {
        return $this->minCost;
    }

    function set_minCost($cost) {
        if (is_int($cost)) {
            $this->minCost = $cost / 10.0;
        }
    }

    function get_totalPoints() {
        return $this->totalPoints;
    }

    function set_totalPoints($points) {
        if (is_int($points)) {
            $this->totalPoints = $points;
        }
    }

    function get_typeName() {
        return $this->typeName;
    }

    function set_typeName($type) {
        $this->typeName = $type;
    }

    function get_teamName() {
        return $this->teamName;
    }

    function set_teamName($name) {
        $this->teamName = $name;
    }

    function get_status() {
        return $this->status;
    }

    function set_status($status) {
        $this->status = $status;
    }

    function get_added() {
        return $this->added;
    }

    function set_added($added) {
        $this->added = $added;
    }

    function get_form() {
        return $this->form;
    }

    function set_form($form) {
        $this->form = $form;
    }

    function get_shirtMobileImageUrl() {
        return $this->shirtMobileImageUrl;
    }

    function set_shirtMobileImageUrl($url) {
        $this->shirtMobileImageUrl = $url;
    }

    function get_currentFixture() {
        return $this->currentFixture;
    }

    function set_currentFixture($fixture) {
        $this->currentFixture = $fixture;
    }

    function get_nowCost() {
        return $this->nowCost;
    }
    function set_nowCost($cost) {
        if (is_int($cost)) {
            $this->nowCost = $cost / 10.0;
        }
    }

    function get_pointsPerGame() {
        return $this->pointsPerGame;
    }

    function set_pointsPerGame($points) {
        $this->pointsPerGame = $points;
    }

    function get_transfersIn() {
        return $this->transfersIn;
    }

    function set_transfersIn($transfers) {
        if (is_int($transfers)) {
            $this->transfersIn = $transfers;
        }
    }

    function get_news() {
        return $this->news;
    }

    function set_news($news) {
        $this->news =$news;
    }

    function get_originalCost() {
        return $this->originalCost;
    }

    function set_originalCost($cost) {
        if (is_int($cost)) {
            $this->originalCost = $cost / 10.0;
        }
    }

    function get_eventPoints() {
        return $this->eventPoints;
    }

    function set_eventPoints($points) {
        if (is_int($points)) {
            $this->eventPoints = $points;
        }
    }

    function get_newsReturn() {
        return $this->newsReturn;
    }

    function set_newsReturn($news) {
        $this->newsReturn = $news;
    }

    function get_nextFixture() {
        return $this->nextFixture;
    }

    function set_nextFixture($fixture) {
        $this->nextFixture = $fixture;
    }

    function get_transfersInEvent() {
        return $this->transfersInEvent;
    }

    function set_transfersInEvent($transfers) {
        if (is_int($transfers)) {
            $this->transfersInEvent = $transfers;
        }
    }

    function get_selectedBy() {
        return $this->selectedBy;
    }

    function set_selectedBy($selected) {
        if (is_int($selected)) {
            $this->selectedBy = $selected;
        }
    }

    function get_teamId() {
        return $this->teamId;
    }

    function set_teamId($id) {
        if (is_numeric($id)) {
            $this->teamId = (int) $id;
        }
    }

    function get_secondName() {
        return $this->secondName;
    }

    function set_secondName($name) {
        $this->secondName = $name;
    }

    function get_photoMobileUrl() {
        return $this->photoMobileUrl;
    }

    function set_photoMobileUrl($url) {
        $this->photoMobileUrl = $url;
    }

    function get_fixtures() { // upcoming fixtures
        return $this->fixtures;
    } // multiple

    function set_fixtures() {}

    function get_seasonHistory() {
        return $this->seasonHistory;
    } // multiple
    function set_seasonHistory() {}

    function get_fixtureHistory() {
        return $this->fixtureHistory;
    } // multiple
    function set_fixtureHistory() {}

    /* Additional Functions */

    /* Database Read/Write Functions */

    public function get_all_player_status() {

    }

    public function get_all_player_types() {
        return DB::query("SELECT * FROM player_type");
    }

    /* $type is a string which represents the player type. */
    public function get_player_type_id($type) {
        $query = DB::query("SELECT id FROM player_type WHERE type = %s", $type);
        if (sizeof($query) == 1) {
            return (int)$query[0]["id"];
        }
        return False;
    }

    public function save() {
        echo($this->get_firstName() . "\n");
        DB::insertUpdate('player',array(
                "fpl_id" => $this->get_id(),
                "fpl_code" => $this->get_playerCode(),
                "club_id" => $this->get_teamId(),
                "squad_number" => $this->get_squadNumber(),
                "first_name" => $this->get_firstName(),
                "second_name" => $this->get_secondName(),
                "web_name" => $this->get_webName(),
                "in_dreamteam" => $this->get_inDreamTeam(),
                "shirt_image_url" => $this->get_shirtImageUrl(),
                "shirt_mobile_image_url" => $this->get_shirtMobileImageUrl(),
                "photo_mobile_url" => $this->get_photoMobileUrl(),
                "type" => $this->get_player_type_id($this->get_typeName()),
                "total_points" => $this->get_totalPoints(),
                "points_per_game" => $this->get_pointsPerGame(),
                "last_season_points" => $this->get_lastSeasonPoints(),
                "fpl_added" => $this->get_lastSeasonPoints()
            ));

        DB::insertUpdate('player_news', array(
                "player_id" => $this->get_id(),
                "status" => $this->get_status(),
                "news_updated" => $this->get_newsUpdated(),
                "news_added" => $this->get_newsAdded(),
                "news" => $this->get_news(),
                "news_return" => $this->get_newsReturn()
            ));

        DB::insertUpdate('player_event', array(
                "player_id" => $this->get_id(),
                "event_total" => $this->get_eventTotal(),
                "event_points" => $this->get_eventPoints()
            ));

        DB::insertUpdate('player_cost', array(
                "player_id" => $this->get_id(),
                "event_cost" => $this->get_eventCost(),
                "max_cost" => $this->get_maxCost(),
                "min_cost" => $this->get_minCost(),
                "now_cost" => $this->get_nowCost(),
                "original_cost" => $this->get_originalCost()
            ));

        foreach ($this->get_seasonHistory() as $season) {
            $season->save();
        }

        foreach ($this->get_fixtures() as $fixture) {
            $fixture->save();
        }

        foreach ($this->get_fixtureHistory() as $playerFixture) {
            $playerFixture->save();
        }
    }
}

?>
