<?php
	include_once("../../public/config/config.php");
	/* Given a json file with player data. This file will write the data to the database. */

	function write_player_to_db($player) {
		// Get type ids
		$types = DB::query("SELECT * FROM player_type;");
		$typeArray = array();
		foreach ($types as $type) {
			$typeArray[$type['type']] = $type['id'];
		}
		echo $typeArray;

		// Set status types -- Ensure this matches DB
		$status = array("a" => 4, "d" => 1, "n" => 3);

		echo($player->second_name."\n");
		if (DB::queryFirstRow("SELECT * FROM player WHERE fpl_id = %i", $player->id)) {
			//update
		} else {
			// insert
			DB::insert(array('player',
				"fpl_id" => $player->id,
				"fpl_code" => $player->code,
				"club_id" => $player->team_id,
				"first_name" => $player->web_name,
				"last_name" => $player->second_name,
				"position" => $player->$typeArray[$player->type_name],
				"status" => $status[$player->status],
				"dreamteam" => ($player->in_dreamteam ? 1 : 0),
				"selected_percentage" => floatval($player->selected_by),
				"original_cost" => $player->original_cost * 0.1,
				"current_cost" => $player->now_cost * 0.1,
				"max_cost" => $player->max_cost * 0.1,
				"min_cost" => $player->min_cost * 0.1
			));
		}



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
