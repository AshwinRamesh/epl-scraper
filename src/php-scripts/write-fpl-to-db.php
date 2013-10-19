<?php
	include_once("../../public/config/config.php");
	/* Given a json file with player data. This file will write the data to the database. */

	$fixturesAdded = array(); // keeps track of teams which have had fixtures updated

	// Set injury status types -- Ensure this matches DB
	$injuryStatus = array("a" => 4, "d" => 1, "n" => 3);

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
	$query = DB::query("SELECT id, name FROM club");
	foreach ($query as $club) {
		$clubs[$club['name']] = (int) $club['id'];
	}
	var_dump($clubs);

	function write_player_to_db($player) {
		global $months, $injuryStatus, $fixturesAdded, $clubs;
		echo($player->second_name."\n");
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
				$dateArray = explode(" ", $fixture[0]);
				$year = (($months[$dateArray[1]] > 6) ? (int) date("Y") : ((int) date("Y")) + 1);
				$month = $months[$dateArray[1]];
				$date = "{$year}-{$month}-{$dateArray[0]} {$dateArray[2]}:00";
				$opponentArray = explode(' ', $fixture[2]);
				$away = (strpos($opponentArray[1],"A") ? TRUE : FALSE);
				$opponent = implode(" ", array_slice($opponentArray, 0, -1));
				$gameweekArray = explode(" ", $fixture[1]);
				$gameweek = (int) $gameweekArray[1];
				$fixtureArray = array(
					"gameweek" => $gameweek,
					"kickoff_time" => $date,
					"home_team" => (!$away ? $clubs["{$player->team_name}"] : $clubs["{$opponent}"]),
					"away_team" => ($away ? $clubs["{$player->team_name}"] : $clubs["{$opponent}"])
				);
				DB::insertUpdate('fixture',$fixtureArray);
			}
		}
		/* Write fixture history */

		/* Write season history */



		return true;
	}

	function process_data_file($datafile) {
		$f = fopen($datafile, "r");
		$data = fread($f, filesize($datafile));
		$data = json_decode($data);
		foreach ($data as $player) {
			write_player_to_db($player);
			return true;
		}
		echo "Completed database write";
	}

	process_data_file("data.json");
?>
