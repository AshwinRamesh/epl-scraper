<?php
	include_once("../../public/config/config.php");
	/* Given a json file with player data. This file will write the data to the database. */

	$fixturesAdded = array(); // keeps track of teams which have had fixtures updated

	// Set injury status types -- Ensure this matches DB
	$injuryStatus = array("a" => 6, "d" => 1, "n" => 3, "i" => 4, "u" => 5);

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
			"club_id" => $player->team_id,
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
			// write fixture-player-data to DB TODO
			$playerFixtureArray array(
				"minutes_played" => $fixture[3],
				"goals" => $fixture[4],

			);
		}
		/* Write season history */



		return true;
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

	process_data_file("data.json");
?>
