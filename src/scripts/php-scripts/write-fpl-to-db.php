<?php
    include_once("../../public/config/config.php");
    /* Given a json file with player data. This file will write the data to the database. */

    $fixturesAdded = array(); // keeps track of teams which have had fixtures updated

    // Set injury status types -- Ensure this matches DB
    $injuryStatus = array("a" => 6, "d" => 1, "n" => 3, "i" => 4, "u" => 5, "s" => 7);

    // Month Array
    $months = array(
            "Jan" => 1,
            "Feb" => 2,
            "Mar" => 3,
            "Apr" => 4,
            "May" => 5,
            "Jun" => 6,
            "Jul" => 7,
            "Aug" => 8,
            "Sep" => 9,
            "Oct" => 10,
            "Nov" => 11,
            "Dec" => 12
        );

    // Set team to id array
    $clubs = array();
    $clubs_short = array();
    $query = DB::query("SELECT id, name, short_name FROM club");
    foreach ($query as $club) {
        $clubs[$club['name']] = (int) $club['id'];
        $clubs_short[$club['short_name']] = (int) $club['id'];
    }

    function convert_date($fpl_date) {
        global $months;
        $dateArray = explode(" ", $fpl_date);
        $year = (($months[$dateArray[1]] > 6) ? (int) date("Y") : ((int) date("Y")) + 1);
        $month = $months[$dateArray[1]];
        $date = "{$year}-{$month}-{$dateArray[0]} {$dateArray[2]}:00";
        return $date;
    }

    function write_player_to_db($player) {
        global $months, $injuryStatus, $fixturesAdded, $clubs, $clubs_short;
        var_dump($player->second_name."\n");

        /* Write to player table */
        $playerArray = array(
            "fpl_id" => $player->id,
            "fpl_code" => $player->code,
            "club_id" => $clubs[$player->team_name],
            "first_name" => $player->first_name,
            "last_name" => $player->second_name,
            "position" => $player->element_type_id,
            "status" => $injuryStatus[$player->status],
            "dreamteam" => ($player->in_dreamteam ? 1 : 0),
            "selected_percentage" => floatval($player->selected_by),
            "original_cost" => $player->original_cost * 0.1,
            "current_cost" => $player->now_cost * 0.1,
            "max_cost" => $player->max_cost * 0.1,
            "min_cost" => $player->min_cost * 0.1
        );
        DB::insertUpdate('player', $playerArray);

        /* Write to fixtures table */
        if (!array_key_exists("{$player->team_code}", $fixturesAdded)) { // only process if that team hasn't been processed
            $fixturesAdded["{$player->team_code}"] = TRUE;
            $fixtures = $player->fixtures->all;
            foreach ($fixtures as $fixture) {
                // Convert fixture to proper data formats
                $date = convert_date($fixture[0]);
                $opponentArray = explode(' ', $fixture[2]);

                $away = (strpos(end($opponentArray),"A") ? TRUE : FALSE);
                $opponent = implode(" ", array_slice($opponentArray, 0, -1));
                $gameweekArray = explode(" ", $fixture[1]);
                $gameweek = (int) $gameweekArray[1];
                $fixtureArray = array(
                    "gameweek" => $gameweek,
                    "kickoff_time" => $date,
                    "home_team" => ($away ? $clubs["{$opponent}"] : $clubs["{$player->team_name}"]),
                    "away_team" => ($away ? $clubs["{$player->team_name}"] : $clubs["{$opponent}"])
                );
                // take into account player who moved between prem teams
                if ($fixtureArray['home_team'] != $fixtureArray['away_team']) {
                    $exists = DB::queryFirstRow("SELECT * FROM fixture WHERE home_team = %i AND away_team = %i", $fixtureArray["home_team"], $fixtureArray["away_team"]);
                    if ($exists) {
                        DB::update('fixture',$fixtureArray,"home_team = %i AND away_team = %i",  $fixtureArray["home_team"], $fixtureArray["away_team"]);
                    } else {
                        DB::insert('fixture',$fixtureArray);
                    }
                }
            }
        }

        /* Write fixture history */
        $fixture_history = $player->fixture_history->all;
        foreach ($fixture_history as $fixture) {
            $date = convert_date($fixture[0]);
            $gameweek = $fixture[1];
            $result = explode(' ', $fixture[2]);
            $scores = explode('-',$result[1]);
            $opponent = explode('(', $result[0]);
            $away = ((strpos(end($opponent),"A") === 0) ? TRUE : FALSE);
            if (sizeof($scores) < 2) {
                $scores[0] = 0;
                $scores[1] = 0;
            }
            $fixtureArray = array(
                "gameweek" => $gameweek,
                "kickoff_time" => $date,
                "home_team" => ($away ? $clubs_short["{$opponent[0]}"]: $clubs["{$player->team_name}"]),
                "away_team" => ($away ? $clubs["{$player->team_name}"] : $clubs_short["{$opponent[0]}"]),
                "home_goals" => $scores[0],
                "away_goals" => $scores[1]
            );
            // take into account player who moved between prem teams -- write fixture to DB
            if ($fixtureArray['home_team'] != $fixtureArray['away_team']) {
                $exists = DB::queryFirstRow("SELECT * FROM fixture WHERE home_team = %i AND away_team = %i", $fixtureArray["home_team"], $fixtureArray["away_team"]);
                if ($exists) {
                    DB::update('fixture',$fixtureArray,"home_team = %i AND away_team = %i",  $fixtureArray["home_team"], $fixtureArray["away_team"]);
                } else {
                    DB::insert('fixture',$fixtureArray);
                }
            }

            /* Write fixture-player-data to DB */
            $playerQuery = DB::queryFirstRow("SELECT id FROM player WHERE fpl_id = %i", $player->id);
            $fixtureQuery = DB::queryFirstRow("SELECT id FROM fixture WHERE (home_team = %i OR away_team = %i) AND kickoff_time = %s ", $clubs["{$player->team_name}"], $clubs["{$player->team_name}"], $fixtureArray["kickoff_time"] );
            $playerFixtureArray = array(
                "player_id" => $playerQuery["id"],
                "fixture_id" => $fixtureQuery["id"],
                "minutes_played" => $fixture[3],
                "goals" => $fixture[4],
                "assists" => $fixture[5],
                "clean_sheet" => $fixture[6],
                "goals_conceded" => $fixture[7],
                "own_goals" => $fixture[8],
                "penalties_saved" => $fixture[9],
                "penalties_missed" => $fixture[10],
                "yellow_card" => $fixture[11],
                "red_card" => $fixture[12],
                "saves" => $fixture[13],
                "bonus" => $fixture[14],
                "esp" => $fixture[15],
                "bps" => $fixture[16],
                "net_transfers" => $fixture[17],
                "cost_value" => $fixture[18] * 0.1,
                "points" => $fixture[19]
            );
            DB::insertUpdate('player_fixture', $playerFixtureArray);
        }

        /* Write season history */
        $seasons = $player->season_history;
        foreach ($seasons as $season) {
            $playerSeasonArray = array(
                "player_id" => $playerQuery["id"],
                "season" => $season[0],
                "minutes_played" => $season[1],
                "goals" => $season[2],
                "assists" => $season[3],
                "clean_sheet" => $season[4],
                "goals_conceded" => $season[5],
                "own_goals" => $season[6],
                "penalties_saved" => $season[7],
                "penalties_missed" => $season[8],
                "yellow_card" => $season[9],
                "red_card" => $season[10],
                "saves" => $season[11],
                "bonus" => $season[12],
                "esp" => $season[13],
                "value" => $season[14] * 0.1,
                "points" => $season[15]
            );
            DB::insertUpdate('player_yearly_statistics', $playerSeasonArray);
        }

        /* Write to player_point_details */
        $pointArray = array(
            "id" => $playerQuery["id"],
            "last_fixture_cost" => $player->event_cost * 0.1,
            "transfers_in" => $player->transfers_in,
            "transfers_out" => $player->transfers_out,
            "last_fixture_transfers_in" => $player->transfers_in_event,
            "last_fixture_transfers_out" => $player->transfers_out_event,
            "last_fixture_points" => $player->event_points,
            "total_points" => $player->total_points,
            "selected" => $player->selected,
            "form" => $player->form,
            "points_per_game" => $player->points_per_game
        );
        DB::insertUpdate('player_point_details', $pointArray);
    }

    function process_data_file($datafile) {
        $f = fopen($datafile, "r");
        $data = fread($f, filesize($datafile));
        $data = json_decode($data);
        foreach ($data as $player) {
            write_player_to_db($player);
        }
        echo "Completed database write";
    }

    process_data_file("data3.json");
?>
